<?php
if(isset($_GET['sort'])){
    $sort=$_GET['sort'];
    $type=$_GET['type'];

}else{
    $sort="b.created_at";
    $type="desc";
}
if(isset($_GET['sortB'])){
    $sortB=$_GET['sortB'];
    $typeB=$_GET['type'];

}else{
    $sortB="g.created_at";
    $typeB="desc";
}

$qqq = "SELECT g.id as group_id, g.created_user_id, g.name, g.created_at, g.created_user_id, u.id, u.login 
                          FROM groups g, users u
						  WHERE g.is_deleted=0 and g.created_user_id=u.id and g.created_user_id = " . $_SESSION['user_id']." order by ".$sortB." ".$typeB;
$query = mysqli_query($link, $qqq);


$queryUser = "select * from users where id=" . $_SESSION['user_id'] . " LIMIT 1";
$queryUsers = mysqli_query($link, $queryUser);
$userRow = mysqli_fetch_array($queryUsers);

?>
<div class="parent">
    <div class="block-center-profile">
        <div class="profile_info">
            <h2>Мой профиль <a href="?page=profileSettings&uid=<?php echo $_SESSION['user_id']; ?>"><img id="ic_settings" src="images/ic_settings.png"></a></h2>
            <table class="profile_table">
                <tr>
                    <td>Фамилия:</td>
                    <td><?php echo $userRow['lname']; ?></td>
                </tr>
                <tr>
                    <td>Имя:</td>
                    <td><?php echo $userRow['fname']; ?></td>
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
                        <td>
                            <div id="raiting_star">
                                <div id="raiting">
                                    <div id="raiting_blank"></div>
                                    <div id="raiting_hover"></div>
                                    <div id="raiting_votes"></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="profile_list">
            <?php if ($_SESSION['user_type'] == 2) { ?>
                <h2>Управление</h2>
                <table class="simple-little-table" cellspacing='0'>

                    <tr>
                        <th id="oth4"><div style="line-height: 30px;"> Название <a id="arrow_img_a" href="?page=profile&sortB=g.name&type=asc"><img id="arrows_img" src="images/arrow_up.png"/></a><a href="?page=profile&sortB=g.name&type=desc"><img id="arrows_img" src="images/arrow_down.png"/></a></div></th>
                        <th id="oth4"><div style="line-height: 30px;"> Название <a id="arrow_img_a" href="?page=profile&sortB=g.created_at&type=asc"><img id="arrows_img" src="images/arrow_up.png"/></a><a href="?page=profile&sortB=g.created_at&type=desc"><img id="arrows_img" src="images/arrow_down.png"/></a></div></th>
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
                            <td><a href="?page=group&gid=<?php echo $row['group_id']; ?>"><?php echo $row['name']; ?></a></td>
                            <td><?php
                                $date = new DateTime($row['created_at']);
                                echo $date->Format('j F H:i');
                                ?></td>
                            <td style="text-align: left; "><?php while ($row2 = mysqli_fetch_array($query2)) {
                                    if ($row2['user_login'] != $_SESSION['user_login']) {
                                        echo "<a href=\"?page=user&uid=" . $row2['user_id'] . "\">" . $row2['user_login'] . "</a><br> ";
                                    }
                                } ?></td>
                            <td style="text-align: left; padding-top: 35px;"><?php $queryOrders = "select o.id as order_id, o.good_id, o.group_id, o.quantity, o.price, o.payment, o.is_deleted, gs.id, gs.name as good_name 
                                              from orders o, goods gs 
                                              where o.is_deleted = 0 and gs.id = o.good_id and o.group_id=" . $row['group_id'];
                                $runQueryOrders = mysqli_query($link, $queryOrders);
                                while ($rowOrders = mysqli_fetch_array($runQueryOrders)){ ?>
                                <a href="?page=order&oid=<?php echo $rowOrders['order_id']; ?>"><?php
                                    echo mb_ucfirst($rowOrders['good_name']) . " " . $rowOrders['quantity'] . "кг/" . $rowOrders['price'] . "тг</br></br>";
                                    ?> </a> <?php }
                                ?></a></td>
                            <td><a id="addOrderButton" href="?page=addOrder&mid=<?php print $row['group_id']; ?>">+</a>
                            </td>
                        </tr><!-- Table Row -->
                        <?php
                    }
                    ?><?php
                    $queryMyGroup = "SELECT g.id as group_id, g.created_user_id, g.name, g.is_deleted, g.created_at, u.id, u.login, ug.group_id, ug.user_id 
                          FROM groups g, users u, users_in_groups ug
						  WHERE g.is_deleted=0 and g.id=ug.group_id and ug.user_id=u.id and g.created_user_id<>" . $_SESSION['user_id'] . " and ug.user_id=" . $_SESSION['user_id'];
                    $queryMyGroups = mysqli_query($link, $queryMyGroup);

                    ?>
                    <?php while ($rowMyGroups = mysqli_fetch_array($queryMyGroups)) {
                        ?>
                        <tr>
                            <td><a href="?page=group&gid=<?php echo $rowMyGroups['group_id']; ?>"><?php echo $rowMyGroups['name']; ?></a></td>
                            <td><?php $date = new DateTime($rowMyGroups['created_at']);
                                echo $date->Format('F j H:i'); ?></td>
                            <td style="text-align: left;"><?php
                                $queryMyGroupsUser = "SELECT g.id as group_id, g.created_user_id, g.name, g.created_at, g.is_deleted, u.id as user_id, u.login, ug.group_id, ug.user_id 
                                                      FROM groups g, users u, users_in_groups ug
						                              WHERE ug.group_id = " . $rowMyGroups['group_id'] . " and g.is_deleted=0 and u.id=ug.user_id and g.id=ug.group_id";
                                $queryMyGroupsUsers = mysqli_query($link, $queryMyGroupsUser);
                                while ($rowMyGroupsUser = mysqli_fetch_array($queryMyGroupsUsers)) {
                                    if ($rowMyGroupsUser['login'] != $_SESSION['user_login']) {
                                        if ($rowMyGroupsUser['created_user_id'] == $rowMyGroupsUser['user_id']) {
                                            echo "<a href=\"?page=user&uid=" . $rowMyGroupsUser['user_id'] . "\">" . $rowMyGroupsUser['login'] . " (L)</a></br>";
                                            continue;
                                        }
                                        echo "<a href=\"?page=user&uid=" . $rowMyGroupsUser['user_id'] . "\">" . $rowMyGroupsUser['login'] . "</a></br>";
                                    }
                                }

                                ?>
                            </td>
                            <td style="text-align: left; padding-top: 35px;"><?php $queryOrders = "select o.id as order_id, o.good_id, o.group_id, o.quantity, o.price, o.payment, o.is_deleted, gs.id, gs.name as good_name 
                                              from orders o, goods gs 
                                              where o.is_deleted = 0 and gs.id = o.good_id and o.group_id=" . $rowMyGroups['group_id'];
                                $runQueryOrders = mysqli_query($link, $queryOrders);
                                while ($rowOrders = mysqli_fetch_array($runQueryOrders)){ ?>
                                <a href="?page=order&oid=<?php echo $rowOrders['order_id']; ?>"><?php
                                    echo mb_ucfirst($rowOrders['good_name']) . " " . $rowOrders['quantity'] . "кг/" . $rowOrders['price'] . "тг</br></br>";
                                    ?> </a> <?php }
                                ?></a>
                            </td>
                            <td>Вы участник</td>
                        </tr><!-- Table Row -->
                    <?php } ?>
                </table>
            <?php } else if ($_SESSION['user_type'] == 1) {
                $queryMyBid = "select b.id, b.order_id, b.user_id, b.price as bid_price, b.created_at, b.is_deleted, u.id as leader_id, u.login, o.id as order_id, o.good_id, o.group_id, o.quantity, o.price, gs.id, gs.name as goods_name, gp.id as group_id, gp.name as group_name, gp.created_user_id, gp.is_deleted
                from bids b, orders o, users u, goods gs, groups gp 
                where gp.is_deleted=0 and b.user_id=" . $_SESSION['user_id'] . " and b.order_id=o.id and o.good_id=gs.id and o.group_id=gp.id and gp.created_user_id=u.id and b.is_deleted=0 order by ".$sort." ".$type;
                $queryMyBids = mysqli_query($link, $queryMyBid);

                ?>
                <table class="simple-little-table" cellspacing='0'>

                    <tr>
                        <th id="oth1"><div style="line-height: 30px;"> Заказ <a id="arrow_img_a" href="?page=profile&sort=gs.name&type=asc"><img id="arrows_img" src="images/arrow_up.png"/></a><a href="?page=profile&sort=gs.name&type=desc"><img id="arrows_img" src="images/arrow_down.png"/></a></div></th>
                        <th id="oth2"><div style="line-height: 30px;"> Количество <a id="arrow_img_a" href="?page=profile&sort=o.quantity&type=asc"><img id="arrows_img" src="images/arrow_up.png"/></a><a href="?page=profile&sort=o.quantity&type=desc"><img id="arrows_img" src="images/arrow_down.png"/></a></div></th>
                        <th id="oth3">Предложенная<a id="arrow_img_a" href="?page=profile&sort=b.price&type=asc"><img id="arrows_img" src="images/arrow_up.png"/></a><a href="?page=profile&sort=b.price&type=desc"><img id="arrows_img" src="images/arrow_down.png"/></a><br>цена</th>
                        <th id="oth1"><div style="line-height: 30px;"> Лидер <a id="arrow_img_a" href="?page=profile&sort=u.login&type=asc"><img id="arrows_img" src="images/arrow_up.png"/></a><a href="?page=profile&sort=u.login&type=desc"><img id="arrows_img" src="images/arrow_down.png"/></a></div></th>
                        <th id="oth1"><div style="line-height: 30px;"> Группа <a id="arrow_img_a" href="?page=profile&sort=gp.name&type=asc"><img id="arrows_img" src="images/arrow_up.png"/></a><a href="?page=profile&sort=gp.name&type=desc"><img id="arrows_img" src="images/arrow_down.png"/></a></div></th>
                        <th>Подробнее</th>
                    </tr><!-- Table Header -->
                    <?php ?>

                    <tr><?php while ($rowMyBids = mysqli_fetch_array($queryMyBids)){ ?>
                        <td><?php echo mb_ucfirst($rowMyBids['goods_name']); ?></td>
                        <td><?php echo $rowMyBids['quantity']; ?>кг</td>
                        <td><?php echo $rowMyBids['bid_price']; ?>тг</td>
                        <td>
                            <a href="?page=user&uid=<?php echo $rowMyBids['leader_id']; ?>"><?php echo $rowMyBids['login']; ?>
                        </td>
                        <td><a href="?page=group&gid=<?php echo $rowMyBids['group_id']; ?>"><?php echo $rowMyBids['group_name']; ?></a></td>
                        <td><a href="?page=order&oid=<?php echo $rowMyBids['order_id']; ?>">
                                <img src="images/ic_content.png" id="ic_content"></a>
                        </td>
                    </tr><!-- Table Row --><?php } ?>
                </table>
            <?php } ?>
        </div>
    </div>
</div>