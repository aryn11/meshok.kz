<?php
$queryOrder = "select o.id, o.good_id, o.group_id, o.created_at, o.quantity, o.price, o.payment, g.id, g.name as group_name, g.created_user_id, u.id, u.fname, u.lname
                from orders o, groups g, users u where o.group_id=g.id and g.created_user_id=u.id and o.id=".$_GET['oid'];
$queryOrders = mysqli_query($link, $queryOrder);
$rowOrder = mysqli_fetch_array($queryOrders);

$order_type = right_case(trim($_GET['oname']));
?>
<div class="parent">
    <div class="block-center-order">
        <div class="a4list">
            <h2>Заказ на <b><?php echo $order_type; ?></b></h2>
            <hr>
            <p>Ф.И.О заказчика <b><?php echo $rowOrder['fname']; ?> <?php echo $rowOrder['lname']; ?></b></p>
            <p>Название группы/фирмы/компании: <b><?php echo $rowOrder['group_name']; ?></b></p>
            <p>Дата выставления заказа: <b><?php echo $rowOrder['created_at']; ?></b></p>
            <p>Вид продукции: <b><?php echo $_GET['oname']; ?></b></p>
            <p>Количество: <b><?php echo $rowOrder['quantity']; ?>кг</b></p>
            <p>Выставленная цена: <b><?php echo $rowOrder['price']; ?>тг </b>(<?php echo $rowOrder['price']*$rowOrder['quantity']; ?>тг)</p>
            <p>Желаемый способ оплаты: <b><?php echo $rowOrder['payment']; ?></b></p>
            <hr>
            <div class="response_buyer"></div>
        </div>
    </div>
</div>
