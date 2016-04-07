<?php
$queryOrder = "select o.id as order_id, o.good_id, o.group_id, o.created_at, o.quantity, o.price, o.payment, g.id, g.name as group_name, g.created_user_id, u.id as user_id, u.fname, u.lname, u.email, u.phone, gs.id, gs.name as good_name
                from orders o, groups g, users u, goods gs where gs.id=o.good_id and o.group_id=g.id and g.created_user_id=u.id and o.id=" . $_GET['oid'];
$queryOrders = mysqli_query($link, $queryOrder);
$rowOrder = mysqli_fetch_array($queryOrders);

$queryMyBid = "select b.id as bid_id, b.order_id, b.user_id, b.is_deleted, b.created_at, b.price, u.id as user_id, u.login, u.phone, u.email
                                    from users u, bids b where b.order_id=".$_GET['oid']." and b.is_deleted=0 and b.user_id=u.id and b.user_id=".$_SESSION['user_id']." order by b.price asc";
$queryMyBids = mysqli_query($link, $queryMyBid);
$rowMyBids = mysqli_fetch_array($queryMyBids);


//$order_type = right_case(trim($_GET['oname']));
?>
<div class="parent">
    <div class="block-center-order">
        <div class="a4list">
            <h2>Заказ на <b><?php echo right_case($rowOrder['good_name']); ?></b></h2>
            <hr>
            <p>Ф.И.О заказчика <b><?php echo $rowOrder['fname']; ?> <?php echo $rowOrder['lname']; ?></b></p>
            <p>Телефон: <b>+7 <?php echo $rowOrder['phone']; ?></b></p>
            <p>E-mail: <b><?php echo $rowOrder['email']; ?></b></p>
            <p>Название группы/фирмы/компании: <b><?php echo $rowOrder['group_name']; ?></b></p>
            <p>Дата выставления заказа: <b><?php echo $rowOrder['created_at']; ?></b></p>
            <p>Вид продукции: <b><?php echo $rowOrder['good_name']; ?></b></p>
            <p>Количество: <b><?php echo $rowOrder['quantity']; ?>кг</b></p>
            <p>Выставленная цена: <b><?php echo $rowOrder['price']; ?>
                    тг </b>(<?php echo $rowOrder['price'] * $rowOrder['quantity']; ?>тг)</p>
            <p>Желаемый способ оплаты: <b><?php echo $rowOrder['payment']; ?></b></p>
            <hr>
            <?php if($_SESSION['user_type']==1){ ?>
            <div class="response_buyer">
                <form action="?act=addBid" method="post" id="fromAddBit">
                    <input id="hiden_input" type="text" name="order_id" value="<?php echo $rowOrder['order_id']; ?>">
                    <?php
                    if($_SESSION['user_id']!=$rowMyBids['user_id']){?>
                        <a onclick="return addBidField()" href="#"><img id="img_add_bid" src="images/ic_add.png" alt="Подать заявку"/></a>
                    <?php } else { ?>
                        <a href="?act=removeBid&bid=<?php echo $rowMyBids['bid_id']; ?>&oid=<?php echo $_GET['oid']; ?>"><img id="img_add_bid" src="images/ic_remove_.png" alt="Подать заявку"/></a>
                    <?php } ?>
                    <div id="parentId">
                        <!--fields create here!-->
                    </div>
                    <div id="parentHint"><img src="images/arrow.png" height="100" style="margin-left: 6px;"></div>
                </form>

            </div>
            <hr>
                <div>
                    <p><?php

                        if($_SESSION['user_id']==$rowMyBids['user_id']){
                            echo "Заявка на этот товара подана";
                        }
                        ?></p>
                </div>
            <?php } else if($_SESSION['user_type']==2){ ?>
            <div>
                <?php
                    $queryBid = "select b.id bid_id, b.order_id, b.user_id, b.is_deleted, b.created_at, b.price, u.id as user_id, u.login, u.phone, u.email
                                    from users u, bids b where b.is_deleted=0 and b.order_id=".$_GET['oid']." and b.user_id=u.id order by b.price asc";
                    $queryBids = mysqli_query($link, $queryBid);
                    $count = 1;
                ?>
                <h3>Заявки</h3>
                    <p></p>
                    <table>
                        <tr><?php while($rowBids=mysqli_fetch_array($queryBids)){ ?>
                            <td><?php echo $count++; ?>.</td>
                            <td id="a4table_td"><a href="?page=user&uid=<?php echo $rowBids['user_id']; ?>"><?php echo $rowBids['login']; ?></a></td>
                            <td id="a4table_td"><?php echo $rowBids['price']; ?>тг/кг</td>
                            <td id="a4table_td_phone">+7 <?php echo $rowBids['phone']; ?></td>
                            <td ><?php echo $rowBids['email']; ?></td>
                        </tr><?php } ?>
                    </table>

            </div> <?php } ?>

        </div>
    </div>
</div>
