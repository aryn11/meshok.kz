<?php $queryOrderForB = "select o.id as order_id, o.good_id, o.group_id, o.created_at, o.quantity, o.price, o.is_deleted, g.id, g.created_user_id, g.name as group_name, u.id as leader_id, u.login, gs.id, gs.name as good_name, gs.type
from orders o, groups g, users u, goods gs
where o.good_id=gs.id and o.group_id=g.id and g.created_user_id=u.id and o.is_deleted=0 order by o.created_at desc";
$queryOrdersForB = mysqli_query($link, $queryOrderForB);
?>
<div class="parent">
    <div class="block-center-orders">
        <table class="simple-little-table" cellspacing='0'>

            <tr>
                <th style="min-width: 100px; text-align: center; ">Заказ</th>
                <th>Количество</th>
                <th>Цена</th>
                <th>Лидер группы</th>
                <th>Название группы</th>
                <th style="min-width: 100px;">Создан</th>
                <th>Подробнее</th>
            </tr><!-- Table Header -->
            <?php while ($rowOrdersB = mysqli_fetch_array($queryOrdersForB)) { ?>

                <tr>
                    <td><?php echo mb_ucfirst($rowOrdersB['good_name']); ?></td>
                    <td><?php echo $rowOrdersB['quantity']; ?>кг</td>
                    <td><?php echo $rowOrdersB['price']; ?>тг</td>
                    <td><a href="?page=user&uid=<?php echo $rowOrdersB['leader_id']; ?>"><?php echo $rowOrdersB['login']; ?></td>
                    <td><?php echo $rowOrdersB['group_name']; ?></td>
                    <td><?php echo $rowOrdersB['created_at']; ?></td>
                    <td ><a href="?page=order&oid=<?php echo $rowOrdersB['order_id']; ?>">
                            <img src="images/ic_content.png" id="ic_content"></a>
                    </td>
                </tr><!-- Table Row --><?php } ?>
        </table>
    </div>
</div>