<?php
$qqq = "SELECT g.id as group_id, g.created_user_id, g.name, g.created_at, u.id, u.login FROM groups g, users u
						  WHERE g.created_user_id=u.id and g.created_user_id = " . $_SESSION['user_id'];
$queryUser = "select * from users where id=" . $_SESSION['user_id'] . " LIMIT 1";

//print $qqq;

$query = mysqli_query($link, $qqq);
$queryUsers = mysqli_query($link, $queryUser);
$userRow = mysqli_fetch_array($queryUsers);

?>
<div class="parent">
    <div class="block-center-profile">
        <div class="profile_info">
            <h2>Мой профиль</h2>
            <table class="profile_table">
                <tr>
                    <td>Фамилия:</td>
                    <td><?php echo $userRow['fname']; ?></td>
                </tr>
                <tr>
                    <td>Имя:</td>
                    <td><?php echo $userRow['lname']; ?></td>
                </tr>
                <tr>
                    <td>Тип:</td>
                    <td><?php echo user_type($userRow['role']); ?></td>
                </tr>
                <tr>
                    <td>Создан:</td>
                    <td><?php
                        $date = new DateTime($userRow['created_at']);
                        echo $date->Format('d/m/Y');
                        ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?php echo $userRow['email']; ?></td>
                </tr>
                <tr>
                    <td>Адресс:</td>
                    <td><?php echo $userRow['address']; ?></td>
                </tr>
                <tr>
                    <td>Телефон:</td>
                    <td><?php echo "+7 " . $userRow['phone']; ?></td>
                </tr>
                <?php if ($userRow['role'] == 1) { ?>
                    <tr>
                        <td>Рейтинг:</td>
                        <td></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="profile_list">
            <h2>Управление</h2>
            <table class="simple-little-table" cellspacing='0'>

                <tr>
                    <th>Название</th>
                    <th>Создана</th>
                    <th>Участники</th>
                    <th style="padding: 0 80px; ">Заказы</th>
                    <th>Создать заказ</th>
                </tr><!-- Table Header -->

                <?php while ($row = mysqli_fetch_array($query)) {
                    $qqq2 = "SELECT id, group_id, user_id, user_login FROM users_in_groups
						        WHERE group_id = " . $row['group_id'];
                    $query2 = mysqli_query($link, $qqq2);

                    ?>

                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php
                            $date = new DateTime($row['created_at']);
                            echo $date->Format('F j H:i');
                            ?></td>
                        <td style="text-align: left; "><?php while ($row2 = mysqli_fetch_array($query2)) {
                                if ($row2['user_login'] != $_SESSION['user_login']) {
                                    echo $row2['user_login'] . " ";
                                }
                            } ?></td>
                        <td style="text-align: left; "><?php $queryOrders = "select o.id as order_id, o.good_id, o.group_id, o.quantity, o.price, o.payment, o.is_deleted, gs.id, gs.name as good_name 
                                              from orders o, goods gs 
                                              where o.is_deleted = 0 and gs.id = o.good_id and o.group_id=" . $row['group_id'];
                            $runQueryOrders = mysqli_query($link, $queryOrders);
                            while ($rowOrders = mysqli_fetch_array($runQueryOrders)){ ?>
                            <a href="?page=order&oid=<?php echo $rowOrders['order_id']; ?>&oname=<?php echo $rowOrders['good_name'] ?>"><?php
                                echo mb_ucfirst($rowOrders['good_name']) . " " . $rowOrders['quantity'] . "кг/" . $rowOrders['price'] . "тг</br></br>";
                                ?> </a> <?php }
                            ?></a></td>
                        <td><a id="addOrderButton" href="?page=addOrder&mid=<?php print $row['group_id']; ?>">+</a></td>
                    </tr><!-- Table Row -->
                    <?php
                }
                ?>
            </table>

            <?php
            $queryMyGroup = "SELECT g.id as group_id, g.created_user_id, g.name, g.created_at, u.id, u.login, ug.group_id, ug.user_id FROM groups g, users u, users_in_groups ug
						  WHERE g.id=ug.group_id and ug.user_id=u.id and g.created_user_id<>".$_SESSION['user_id']." and ug.user_id=".$_SESSION['user_id'];
            $queryMyGroups = mysqli_query($link, $queryMyGroup);

            ?>
            <h2>Группы</h2>
            <table class="simple-little-table" cellspacing='0'>
                <tr>
                    <th>Название</th>
                    <th>Создана</th>
                    <th>Лидер/Участники</th>
                    <th style="padding: 0 80px; ">Заказы</th>
                </tr><!-- Table Header -->
                <?php while($rowMyGroups = mysqli_fetch_array($queryMyGroups)){
                ?>
                <tr>
                    <td><?php echo $rowMyGroups['name']; ?></td>
                    <td><?php $date = new DateTime($rowMyGroups['created_at']);
                        echo $date->Format('F j H:i');?></td>
                    <td></td>
                    <td></td>
                </tr><!-- Table Row -->
                <?php } ?>
            </table>
        </div>
    </div>
</div>