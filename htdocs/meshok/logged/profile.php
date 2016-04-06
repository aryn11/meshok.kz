 <?php
$qqq = "SELECT g.id as group_id, g.created_user_id, g.name, g.created_at, u.id, u.login FROM groups g, users u
						  WHERE g.created_user_id=u.id and g.created_user_id = " . $_SESSION['user_id'];

//print $qqq;

$query = mysqli_query($link, $qqq);
?>
<div class="parent">
    <div class="block-center-profile" style="background-color: #9d9d9d">
        <div class="profile_info">
            <h1>Мой профиль</h1>
            <p></p>
        </div>
        <div class="profile_list">
            <p>My GROUPS</p>
            <table class="simple-little-table" cellspacing='0'>

                <tr>
                    <th>Название</th>
                    <th>Создана</th>
                    <th>Группа</th>
                    <th style="padding: 0 80px; ">Заказы</th>
                    <th>Создать заказ</th>
                </tr><!-- Table Header -->

                <?php while($row = mysqli_fetch_array($query)){
                            $qqq2 = "SELECT id, group_id, user_id, user_login FROM users_in_groups
						        WHERE group_id = ". $row['group_id'];
                            $query2 = mysqli_query($link, $qqq2);

                    ?>

                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td style="text-align: left; "><?php while($row2 = mysqli_fetch_array($query2)){
                                    if($row2['user_login'] != $_SESSION['user_login']){
                                        echo $row2['user_login']." ";
                                    }
                            }?></td>
                    <td style="text-align: left; "><?php $queryOrders = "select o.good_id, o.group_id, o.quantity, o.price, o.payment, o.is_deleted, gs.id, gs.name as good_name 
                                              from orders o, goods gs 
                                              where o.is_deleted = 0 and gs.id = o.good_id and o.group_id=".$row['group_id'];
                        $runQueryOrders = mysqli_query($link, $queryOrders);
                        while($rowOrders = mysqli_fetch_array($runQueryOrders)){
                                    echo mb_ucfirst($rowOrders['good_name'])." ".$rowOrders['quantity']."кг/".$rowOrders['price']."тг</br></br>";
                        }
                        ?></td>
                    <td> <a id="addOrderButton" href="?page=addOrder&mid=<?php print $row['group_id'];?>">+</a></td>
                </tr><!-- Table Row -->
                <?php
                        }
                ?>
            </table>
        </div>
    </div>
</div>