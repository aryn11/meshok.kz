<?php if(isset($_GET['sort'])){
    $sort=$_GET['sort'];
    $type=$_GET['type'];

}else{
    $sort="o.created_at";
    $type="desc";
}

$queryOrderForB = "select o.id as order_id, o.good_id, o.group_id, o.created_at, o.quantity, o.price, o.is_deleted, g.id, g.created_user_id, g.is_deleted, g.name as group_name, u.id as leader_id, u.login, gs.id, gs.name as good_name, gs.type
from orders o, groups g, users u, goods gs
where g.is_deleted=0 and o.good_id=gs.id and o.group_id=g.id and g.created_user_id=u.id and o.is_deleted=0 order by ".$sort." ".$type;
$queryOrdersForB = mysqli_query($link, $queryOrderForB);
?>
<div class="parent">
    <div class="block-center-orders">
        <table class="simple-little-table" cellspacing='0'>

            <tr>
                <th id="oth1"><div style="line-height: 30px;"> Заказ <a id="arrow_img_a" href="?page=orders&sort=gs.name&type=asc"><img id="arrows_img" src="images/arrow_up.png"/></a><a href="?page=orders&sort=gs.name&type=desc"><img id="arrows_img" src="images/arrow_down.png"/></a></div></th>
                <th id="oth2"><div style="line-height: 30px;"> Количество <a id="arrow_img_a" href="?page=orders&sort=o.quantity&type=asc"><img id="arrows_img" src="images/arrow_up.png"/></a><a href="?page=orders&sort=o.quantity&type=desc"><img id="arrows_img" src="images/arrow_down.png"/></a></div></th>
                <th id="oth1"><div style="line-height: 30px;"> Цена <a id="arrow_img_a" href="?page=orders&sort=o.price&type=asc"><img id="arrows_img" src="images/arrow_up.png"/></a><a href="?page=orders&sort=o.price&type=desc"><img id="arrows_img" src="images/arrow_down.png"/></a></div></th>

                <th id="oth1"><div style="line-height: 30px;"> Лидер <a id="arrow_img_a" href="?page=orders&sort=u.login&type=asc"><img id="arrows_img" src="images/arrow_up.png"/></a><a href="?page=orders&sort=u.login&type=desc"><img id="arrows_img" src="images/arrow_down.png"/></a></div></th>
                <th id="oth1"><div style="line-height: 30px;"> Группа <a id="arrow_img_a" href="?page=orders&sort=g.name&type=asc"><img id="arrows_img" src="images/arrow_up.png"/></a><a href="?page=orders&sort=g.name&type=desc"><img id="arrows_img" src="images/arrow_down.png"/></a></div></th>
                <th id="oth1"><div style="line-height: 30px;"> Создан <a id="arrow_img_a" href="?page=orders&sort=o.created_at&type=asc"><img id="arrows_img" src="images/arrow_up.png"/></a><a href="?page=orders&sort=o.created_at&type=desc"><img id="arrows_img" src="images/arrow_down.png"/></a></div></th>
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