<?php


$query = "select id, name, type from goods";
$queryL = mysqli_query($link, $query);

$query2 = "select id, name, type from goods";
$queryL2 = mysqli_query($link, $query2);

$queryMarkets = "select * from markets";
$runQM = mysqli_query($link, $queryMarkets);
?>
<div class="parent">
    <div class="block-center-addOrder">
        <form action="?act=addOrder" method="post" id="addOrder_form">
            <p class="input_registration">Тип товара:
                <select name="good_type">
                    <?php while ($row = mysqli_fetch_array($queryL)) { ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo mb_ucfirst($row['name']); ?></option>
                    <?php } ?>
                </select>
            </p>
            <p class="input_registration">Колличество: <input type="text" name="quantity"
                                                              placeholder="Сколько вам нужно киллограм"></p>
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 1) {
                    print "<p class='input_registration'><b style = 'color:#d10000;
                                       '>Минимальный заказ на 50кг</b></p>";
                }
            }
            ?>
            <p class="input_registration">Желаемая цена: <input type="text" name="price" placeholder="Минимальная цена">
            </p>
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 2) {
                    print "<p class='input_registration'><b style = 'color:#d10000;
                                       '>Минимальная цена не может быть отрицательной</b></p>";
                }
            }
            ?>
            <p class="input_registration">Способ оплаты:
                <select name="payment">
                    <option value="Наличные">Наличные</option>
                    <option value="WebMoney">Webmoney Transfer</option>
                    <option value="Yandex.Money">Яндекс.Деньги</option>
                    <option value="Visa">Visa, MasterCard</option>
                    <option value="Qiwi">QIWI</option>
                </select></p>
            <input style="display: none;" type="text" name="gid" value="<?php echo $_GET['mid']; ?>">

            <p><input class="button_addOrder" type="submit" value="Создать заказ"></p>

            <table class="simple-little-table" cellspacing='0'>

                <tr>
                    <th>Супермаркеты</th>
                        <?php while ($rowx = mysqli_fetch_array($queryL2)) { ?>
                    <th><?php echo mb_ucfirst($rowx['name']); ?></th>
                        <?php } ?>

                </tr><!-- Table Header -->
                <?php while($rowqm = mysqli_fetch_array($runQM)){
                        $queryMP = "select m.id, mp.id, mp.market_id, mp.good_id, mp.price, g.id, g.name
                                    from markets m, prices_in_markets mp, goods g
                                    where m.id = mp.market_id and mp.good_id=g.id and m.id=".$rowqm['id'];
                        $runMP = mysqli_query($link, $queryMP);
                        ?>
                <tr>
                    <td><?php echo $rowqm['name']; ?></td>
                        <?php while ($rowMP = mysqli_fetch_array($runMP)) {
                            echo "<td>".$rowMP['price']."тг</td>";
                        }?>
                </tr>
                <?php } ?>

            </table>
        </form>
    </div>
</div>
