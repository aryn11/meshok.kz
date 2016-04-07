<?php
$queryOrder = "select o.id as order_id, o.good_id, o.group_id, o.created_at, o.quantity, o.price, o.payment, g.id, g.name as group_name, g.created_user_id, u.id as user_id, u.fname, u.lname, u.email, u.phone, gs.id, gs.name as good_name
                from orders o, groups g, users u, goods gs where gs.id=o.good_id and o.group_id=g.id and g.created_user_id=u.id and o.id=".$_GET['oid'];
$queryOrders = mysqli_query($link, $queryOrder);
$rowOrder = mysqli_fetch_array($queryOrders);

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
            <p>Выставленная цена: <b><?php echo $rowOrder['price']; ?>тг </b>(<?php echo $rowOrder['price']*$rowOrder['quantity']; ?>тг)</p>
            <p>Желаемый способ оплаты: <b><?php echo $rowOrder['payment']; ?></b></p>
            <hr>
            <div class="response_buyer">
            <form action="?act=addBid" method="post" id="fromAddBit">
                <input id="hiden_input" type="text" name="order_id" value="<?php echo $rowOrder['order_id']; ?>">
                <a onclick="return addBidField()" href="#"><img id="img_add_bid" src="images/ic_add.png" alt="Подать заявку" /></a><a href="#"><img id="img_add_bid" src="images/ic_remove_.png" alt="Подать заявку" /></a>
                <div id="parentId">
                    <!--fields create here!-->
                </div>
            </form>
            </div>
            <p><a href=""></a></a></p>
        </div>
    </div>
</div>
