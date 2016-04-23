<?php

session_start();
include 'db/db.php';

$logged = false;

if (isset($_SESSION['user_id'])) {
    $logged = true;
}
if ($logged) {

    if (isset($_GET['act'])) {
        if ($_GET['act'] == 'logout') {

            unset($_SESSION['user_id']);
            unset($_SESSION['user_login']);
            unset($_SESSION['user_type']);


            header("Location:?page=home");


        }
        if ($_GET['act'] == 'addOrder') {

            $good_id = $_POST['good_type'];
            $quantity = $_POST['quantity'];
            $gid = $_POST['gid'];
            if ($quantity < 50) {
                header("Location:?page=addOrder&mid=$gid&error=1");
            }
            $price = $_POST['price'];
            if ($price < 1) {
                header("Location:?page=addOrder&mid=$gid&error=2");
            }
            $payment = $_POST['payment'];
            $query = "INSERT into orders values(NULL, $good_id, $gid, SYSDATE(), $quantity, $price, '$payment', 0)";
            mysqli_query($link, $query);
            header("Location:?page=profile");
        }
        if ($_GET['act'] == 'addBid') {

            $order_id = $_POST['order_id'];
            $user_id = $_SESSION['user_id'];
            $price = $_POST['price_1'];
            $query = "INSERT into bids values(NULL, $order_id, $user_id, $price, SYSDATE(), 0)";
            mysqli_query($link, $query);
            header("Location:?page=order&oid=$order_id#fromAddBit");
        }
        if($_GET['act'] == 'removeBid'){
            mysqli_query($link, "UPDATE bids SET is_deleted = 1 WHERE id = " . $_GET['bid']);
            header("Location:?page=order&oid=".$_GET['oid']."#fromAddBit");
        }
        if($_GET['act']== 'changeUserData'){
            $fname = $_POST['c_fname'];
            $lname = $_POST['c_lname'];
            $email = $_POST['c_email'];
            $address = $_POST['c_address'];
            $phone = $_POST['c_phone'];

            mysqli_query($link, "UPDATE users SET fname=\"".$fname."\", 
                                                  lname=\"".$lname."\", 
                                                  email=\"".$email."\",
                                                  address=\"".$address."\",
                                                  phone=\"".$phone."\" WHERE id =". $_SESSION['user_id']);
            header("Location:?page=profile");
        }if($_GET['act'] == 'changeGroupData'){
            $c_name = $_POST['c_gname'];
            $c_gid = $_POST['c_gid'];
            mysqli_query($link, "UPDATE groups SET name=\"".$c_name."\" WHERE id =". $c_gid);
            header("Location:?page=group&gid=".$c_gid);
        } if($_GET['act']=='removeGroup'){
            mysqli_query($link, "UPDATE groups SET is_deleted=1 WHERE id =".$_GET['gid']." and created_user_id=".$_GET['uid']);
        }
        if ($_GET['act'] == 'addGroup') {
            $ag_name = $_POST['cg_name'];
            $qAddingGroup = "INSERT into groups values(NULL, " . $_SESSION['user_id'] . ", '$ag_name', SYSDATE(), 0)";

            $q = mysqli_query($link, $qAddingGroup);
            sleep(0.1);
            $qSelectGroup = "select id, created_user_id from groups where created_user_id = " . $_SESSION['user_id'] . " order by created_at desc LIMIT 1";
            $q233 = mysqli_query($link, $qSelectGroup);
            while ($row = mysqli_fetch_array($q233)) {
                $qAddingGroupUsersLeader = "INSERT into users_in_groups values(NULL, " . $row['id'] . ", " . $_SESSION['user_id'] . ", \"" . $_SESSION['user_login'] . "\")";

                mysqli_query($link, $qAddingGroupUsersLeader);

                if (isset($_POST['name_1'])) {
                    $ag_login_1 = $_POST['name_1'];

                    //запрос в базу чтобы вытащить user_id
                    $qSelectGroupForID = "select id, login from users where login = '" . $ag_login_1 . "' LIMIT 1";
                    $querySelectGroupForID = mysqli_query($link, $qSelectGroupForID);
                    $row_id1 = mysqli_fetch_array($querySelectGroupForID);

                    //ввод в базу group_id и user_id
                    $qAddingGroupUsers1 = "INSERT into users_in_groups values(NULL," . $row['id'] . " ," . $row_id1['id'] . " , \"" . $row_id1['login'] . "\")";

                    mysqli_query($link, $qAddingGroupUsers1);

                    if (isset($_POST['name_2'])) {
                        $ag_login_2 = $_POST['name_2'];

                        $qSelectGroupForID2 = "select id, login from users where login = '" . $ag_login_2 . "' LIMIT 1";
                        $querySelectGroupForID2 = mysqli_query($link, $qSelectGroupForID2);
                        $row_id2 = mysqli_fetch_array($querySelectGroupForID2);

                        $qAddingGroupUsers2 = "INSERT into users_in_groups values(NULL," . $row['id'] . " ," . $row_id2['id'] . "  , \"" . $row_id2['login'] . "\")";
                        mysqli_query($link, $qAddingGroupUsers2);
                    }
                    if (isset($_POST['name_3'])) {
                        $ag_login_3 = $_POST['name_3'];
                        $qSelectGroupForID3 = "select id, login from users where login = '" . $ag_login_3 . "' LIMIT 1";
                        $querySelectGroupForID3 = mysqli_query($link, $qSelectGroupForID3);
                        $row_id3 = mysqli_fetch_array($querySelectGroupForID3);

                        $qAddingGroupUsers3 = "INSERT into users_in_groups values(NULL," . $row['id'] . " ," . $row_id3['id'] . " , \"" . $row_id3['login'] . "\")";
                        mysqli_query($link, $qAddingGroupUsers3);
                    }
                    if (isset($_POST['name_4'])) {
                        $ag_login_4 = $_POST['name_4'];

                        $qSelectGroupForID4 = "select id, login from users where login = '" . $ag_login_4 . "' LIMIT 1";
                        $querySelectGroupForID4 = mysqli_query($link, $qSelectGroupForID4);
                        $row_id4 = mysqli_fetch_array($querySelectGroupForID4);

                        $qAddingGroupUsers4 = "INSERT into users_in_groups values(NULL," . $row['id'] . " ," . $row_id4['id'] . " , \"" . $row_id4['login'] . "\") ";
                        mysqli_query($link, $qAddingGroupUsers4);
                    }
                    if (isset($_POST['name_5'])) {
                        $ag_login_5 = $_POST['name_5'];
                        $qSelectGroupForID5 = "select id, login from users where login = '" . $ag_login_5 . "' LIMIT 1";
                        $querySelectGroupForID5 = mysqli_query($link, $qSelectGroupForID5);
                        $row_id5 = mysqli_fetch_array($querySelectGroupForID5);

                        $qAddingGroupUsers5 = "INSERT into users_in_groups values(NULL," . $row['id'] . " ," . $row_id5['id'] . " , \"" . $row_id5['login'] . "\")";
                        mysqli_query($link, $qAddingGroupUsers5);
                    }
                    if (isset($_POST['name_6'])) {
                        $ag_login_6 = $_POST['name_6'];

                        $qSelectGroupForID6 = "select id, login from users where login = '" . $ag_login_6 . "' LIMIT 1";
                        $querySelectGroupForID6 = mysqli_query($link, $qSelectGroupForID6);
                        $row_id6 = mysqli_fetch_array($querySelectGroupForID6);

                        $qAddingGroupUsers6 = "INSERT into users_in_groups values(NULL," . $row['id'] . " ," . $row_id6['id'] . " , \"" . $row_id6['login'] . "\")";
                        mysqli_query($link, $qAddingGroupUsers6);
                    }
                    if (isset($_POST['name_7'])) {
                        $ag_login_7 = $_POST['name_7'];

                        $qSelectGroupForID7 = "select id, login from users where login = '" . $ag_login_7 . "' LIMIT 1";
                        $querySelectGroupForID7 = mysqli_query($link, $qSelectGroupForID7);
                        $row_id7 = mysqli_fetch_array($querySelectGroupForID7);

                        $qAddingGroupUsers7 = "INSERT into users_in_groups values(NULL," . $row['id'] . " ," . $row_id7['id'] . " , \"" . $row_id7['login'] . "\")";
                        mysqli_query($link, $qAddingGroupUsers7);
                    }
                    if (isset($_POST['name_8'])) {
                        $ag_login_8 = $_POST['name_8'];
                        $qSelectGroupForID8 = "select id, login from users where login = '" . $ag_login_8 . "' LIMIT 1";
                        $querySelectGroupForID8 = mysqli_query($link, $qSelectGroupForID8);
                        $row_id8 = mysqli_fetch_array($querySelectGroupForID8);

                        $qAddingGroupUsers8 = "INSERT into users_in_groups values(NULL," . $row['id'] . " ," . $row_id8['id'] . " , \"" . $row_id8['login'] . "\")";
                        mysqli_query($link, $qAddingGroupUsers8);
                    }
                    if (isset($_POST['name_9'])) {
                        $ag_login_9 = $_POST['name_9'];
                        $qSelectGroupForID9 = "select id, login from users where login = '" . $ag_login_9 . "' LIMIT 1";
                        $querySelectGroupForID9 = mysqli_query($link, $qSelectGroupForID9);
                        $row_id9 = mysqli_fetch_array($querySelectGroupForID9);

                        $qAddingGroupUsers9 = "INSERT into users_in_groups values(NULL," . $row['id'] . " ," . $row_id9['id'] . " , \"" . $row_id9['login'] . "\")";
                        mysqli_query($link, $qAddingGroupUsers9);
                    }

                }
                header("Location:?page=profile");
            }


        }

        /*if ($_GET['act'] == 'blog') {
            $title = $_POST['title'];
            $text = $_POST['text'];
            $uid = $_SESSION['user_id'];
            $q = mysql_query("INSERT into blog values(NULL, '$title', '$text', SYSDATE(), 0, '$uid')");

        }
        if ($_GET['act'] == 'send_message') {

            $login = $_POST['login'];
            $text = $_POST['text'];

            $query = mysql_query("SELECT * FROM users WHERE login = \"" . $login . "\" LIMIT 1");
            if ($row = mysql_fetch_array($query)) {

                $uid = $row['id'];
                $sid = $_SESSION['user_id'];

                $sss = "INSERT INTO inbox VALUES (NULL,$uid,$sid,\"" . $text . "\",SYSDATE(),0,0,0)";
                mysql_query($sss);

                header("Location:?page=messages");

            } else {

                header("Location:?page=messages&error=1");

            }

        }
        if ($_GET['act'] == 'delete_inbox') {

            $mid = $_GET['mid'];

            mysql_query(" UPDATE inbox SET i_deleted = 1 WHERE id = " . $mid);

            header("Location:?page=inbox");
        }
        if ($_GET['act'] == 'delete_outbox') {

            $mid = $_GET['mid'];

            mysql_query(" UPDATE inbox SET o_deleted = 1 WHERE id = " . $mid);

            header("Location:?page=outbox");
        }*/
    }
} else {
    if (isset($_GET['act'])) {
        if ($_GET['act'] == 'login') {

            $login = $_POST['l_login'];
            $pass = $_POST['l_pass'];

            $qqq = "SELECT * FROM users WHERE login = \"" . $login . "\" AND password = \"" . $pass . "\" LIMIT 1";
            //print $qqq;
            $query = mysqli_query($link, $qqq); 

            if ($row = mysqli_fetch_array($query)) {

                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_login'] = $row['login'];
                $_SESSION['user_type'] = $row['role'];

                header("Location:?page=profile");

            } else {

                header("Location:?error=1");

            }

        }
        if ($_GET['act'] == 'reg') {

            $login = $_POST['n_login'];
            $pass = $_POST['n_pass'];
            $fname = $_POST['n_fname'];
            $lname = $_POST['n_lname'];
            $email = $_POST['n_email'];
            $address = $_POST['n_address'];
            $phone = $_POST['n_phone'];
            $user_type = $_POST['n_user_type'];

            $qqq2 = "insert into users values (NULL, '$login', '$pass', $user_type, SYSDATE(), '$fname', '$lname', '$email', '$address', '$phone', 0, 0, 0)";

            mysqli_query($link, $qqq2);
            header("Location:?page=home#login_block");

        }
    }

}

////////////////////////////////////////////////

$page = null;

if ($logged) {

    $page = "profile";

    if (isset($_GET['page'])) {
        if ($_GET['page'] == 'profile') {
            $page = $_GET['page'];
            $pageTitle = "Мой профиль • Meshok";
        } else if ($_GET['page'] == 'createGroup') {
            $page = $_GET['page'];
            $pageTitle = "Cоздай свою группу для закупки • Meshok";
        } else if ($_GET['page'] == 'addOrder') {
            $page = $_GET['page'];
            $pageTitle = "Создание заказа • Meshok";
        } else if ($_GET['page'] == 'order') {
            $page = $_GET['page'];
            $pageTitle = "Заказ • Meshok";
        } else if ($_GET['page'] == 'orders') {
            $page = $_GET['page'];
            $pageTitle = "Заказы • Meshok ";
        } else if ($_GET['page'] == 'user') {
            $page = $_GET['page'];
            $pageTitle = "Пользователь • Meshok ";
        } else if ($_GET['page'] == 'contacts'){
            $page = $_GET['page'];
            $pageTitle = "Контакты • Meshok ";
        } else if ($_GET['page'] == 'profileSettings'){
            $page = $_GET['page'];
            $pageTitle = "Изменение профиля ".$_SESSION['user_login']." • Meshok ";
        } else if ($_GET['page'] == 'group'){
            $page = $_GET['page'];
            $pageTitle = "Группа • Meshok ";
        } else if ($_GET['page'] == 'groupSettings'){
            $page = $_GET['page'];
            $pageTitle = "Настройка группы • Meshok ";
        }
        /* else if ($_GET['page'] == 'messages') {
            $page = $_GET['page'];
        } else if ($_GET['page'] == 'inbox') {
            $page = $_GET['page'];
        } else if ($_GET['page'] == 'read_inbox') {
            $page = $_GET['page'];
        } else if ($_GET['page'] == 'outbox') {
            $page = $_GET['page'];
        } else if ($_GET['page'] == 'read_outbox') {
            $page = $_GET['page'];
        }*/

    }

    /*$m_counter = 0;

    $query = mysql_query(" SELECT COUNT(id) r_size FROM inbox WHERE readen = 0 AND u_id = " . $_SESSION['user_id'] . " AND i_deleted = 0");

    if ($row = mysql_fetch_array($query)) {
        $m_counter = $row['r_size'];
    }*/


} else {

    $page = "home";
    $pageTitle = "Оптовые заказы • Meshok";
    if (isset($_GET['page'])) {
        if ($_GET['page'] == 'home') {
            $page = $_GET['page'];
            $pageTitle = "Оптовые заказы • Meshok";
        } else if ($_GET['page'] == 'registration') {
            $page = $_GET['page'];
            $pageTitle = "Добавляйся в сообщество • Meshok";
        }
    }

}

//функция изменющая начальную букву строки на заглавную для кирилицы
function mb_ucfirst($str)
{
    $str = mb_strtoupper(mb_substr($str, 0, 1, 'UTF-8'), 'UTF-8') .
        mb_strtolower(mb_substr($str, 1, mb_strlen($str), 'UTF-8'), 'UTF-8');
    return $str;
}

//функция на вывод типа пользователя
function user_type($str)
{
    $buyer = "Покупатель";
    $seller = "Продавец";
    $admin = "Администратор";
    if($str == 1){
        return $seller;
    } else if ($str == 2) {
        return $buyer;
    } else if ($str == 3) {
        return $admin;
    } else {
        return null;
    }
}
function right_case($str_right_case){
    if($str_right_case == "картошка"){
        return "картошку";
    }
    return $str_right_case;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php
        //отображение титула страницы
        if(isset($pageTitle)){
            echo $pageTitle;
        }else {
            echo "Meshok.kz";
        }
        ?></title>
    <link href="css/stylesheet.css" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/png">
    <style type="text/css">

        
    </style>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.cookies.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
        <?php  ?>
        $(document).ready(function(){
            total_reiting = 4.2; // итоговый ретинг
            id_arc = 55; // id статьи
            var star_widht = total_reiting*17 ;
            $('#raiting_votes').width(star_widht);
            $('#raiting_info h5').append(total_reiting);
            he_voted = $.cookies.get('article'+id_arc); // проверяем есть ли кука?
            if(he_voted == null){
                $('#raiting').hover(function() {
                        $('#raiting_votes, #raiting_hover').toggle();
                    },
                    function() {
                        $('#raiting_votes, #raiting_hover').toggle();
                    });
                var margin_doc = $("#raiting").offset();
                $("#raiting").mousemove(function(e){
                    var widht_votes = e.pageX - margin_doc.left;
                    if (widht_votes == 0) widht_votes =1 ;
                    user_votes = Math.ceil(widht_votes/17);
// обратите внимание переменная  user_votes должна задаваться без var, т.к. в этом случае она будет глобальной и мы сможем к ней обратиться из другой ф-ции (нужна будет при клике на оценке.
                    $('#raiting_hover').width(user_votes*17);
                });
// отправка
                $('#raiting').click(function(){
                    $('#raiting_info h5, #raiting_info img').toggle();
                    $.get(
                        "logged/raiting.php",
                        {id_arc: id_arc, user_votes: user_votes},
                        function(data){
                            $("#raiting_info h5").html(data);
                            $('#raiting_votes').width((total_reiting + user_votes)*17/2);
                            $('#raiting_info h5, #raiting_info img').toggle();
                            /*$.cookies.set('article'+id_arc, 123, {hoursToLive: 1}); // создаем куку*/
                            $("#raiting").unbind();

                        }
                    )
                });
            }
        });
    </script>
</head>

<body>
<div id="top_bar_black">
    <div id="logo_container">
        <a href="<?php print ($logged ? "?page=profile" : "?page=home"); ?>">
            <div id="logo_image"><img src="images/logo.png" width="240"></div>
        </a>
        <div id="nav_block">
            <?php if ($logged) { ?>
                <a href="?page=profile">
                    <div class="nav_button">Мой Профиль</div>
                </a>

                <!--видит только продавец-->
                <?php if ($_SESSION['user_type'] == 1) { ?>
                    <a href="?page=orders">
                        <div class="nav_button">Заказы</div>
                    </a>

                    <!--видит только покупатель-->
                <?php } else if ($_SESSION['user_type'] == 2) { ?>
                    <a href="?page=createGroup">
                        <div class="nav_button">Создать группу</div>
                    </a>
                <?php } ?>

                <a href="?page=contacts">
                    <div class="nav_button">Контакты</div>
                </a>
                <a href="?act=logout">
                    <div class="nav_button">Выход</div>  
                </a>
            <?php } else if ($logged != true) { ?>
                <a href="?page=home#login_block">
                    <div class="nav_button_reg" style="margin-left: 50%">SIGN IN</div>
                </a>
                <a href="?page=registration">
                    <div class="nav_button_reg">SIGN UP</div>
                </a> 
            <?php } ?>
        </div>
    </div>

    <div id="content_container">
        <!-- BODY HERE!! -->
        <?php
            include ($logged ? "logged" : "notlogged") . "/" . $page . ".php";
        ?>
    </div>


    <div id="bottom_bar_black">
        <div id="main_container">
            <div id="header_lower">
                <div id="header_content_lowerline">
                    <div id="header_content_lowerboxcontent">
                    </div>
                </div>
            </div>

            <div id="header_lower">
                <div id="header_content_lowerline">Contacts
                    <div id="header_content_lowerboxcontent"> Короткова Мария <br/>
                        +7(708) 903 0888<br/>
                        favourite-best@mail.ru
						<?php $b=3;
								$a=$b++;
								echo $a.$b;?>
                    </div>
                </div>
            </div>


        </div>
    </div>

</body>
<script>
    function check() {
        var pass = document.getElementById("n_pass");
        if (pass.type == "password") {
            pass.type = "text";
        } else {
            pass.type = "password";
        }
    }
    var countOfFields = 0; // Текущее число полей
    var curFieldNameId = 0; // Уникальное значение для атрибута name
    var maxFieldLimit = 9;
    var maxBidFieldLimit = 1;// Максимальное число возможных полей
    function deleteField(a) {
        // Получаем доступ к ДИВу, содержащему поле
        var contDiv = a.parentNode;
        // Удаляем этот ДИВ из DOM-дерева
        contDiv.parentNode.removeChild(contDiv);
        // Уменьшаем значение текущего числа полей
        countOfFields--;

        // Возвращаем false, чтобы не было перехода по сслыке
        return false;
    }
    function deleteBidField(a) {
        // Получаем доступ к ДИВу, содержащему поле
        var contDiv = a.parentNode;
        var contDiv2 = document.getElementById("button_addBid").parentNode.removeChild(document.getElementById('button_addBid'));
        // Удаляем этот ДИВ из DOM-дерева
        var img = document.getElementById("parentHint").style.display='block';
        var rep = document.getElementById("parentId").style.display='none';
        contDiv.parentNode.removeChild(contDiv);
        // Уменьшаем значение текущего числа полей
        countOfFields--;

        // Возвращаем false, чтобы не было перехода по сслыке
        return false;
    }
    function addField() {
        // Проверяем, не достигло ли число полей максимума
        if (countOfFields >= maxFieldLimit) {
            alert("Число полей достигло своего максимума = " + maxFieldLimit);
            return false;
        }
        // Увеличиваем текущее значение числа полей
        countOfFields++;
        // Увеличиваем ID
        curFieldNameId++;
        // Создаем элемент ДИВ
        var div = document.createElement("div");
        // Добавляем HTML-контент с пом. свойства innerHTML
        div.innerHTML = "<div class='input_add_member'><input name=\"name_" + curFieldNameId + "\" type=\"text\" placeholder=\"type user login\" /> <a onclick=\"return deleteField(this)\" href=\"#\"><img src=\"images\\ic_clear.png\"></a></div>";
        // Добавляем новый узел в конец списка полей
        document.getElementById("parentIdGroup").appendChild(div);
        // Возвращаем false, чтобы не было перехода по сслыке
        return false;
    }
    function addBidField() {
        // Проверяем, не достигло ли число полей максимума
        if (countOfFields >= maxBidFieldLimit) {

            return false;
        }
        // Увеличиваем текущее значение числа полей
        countOfFields++;
        // Увеличиваем ID
        curFieldNameId++;
        // Создаем элемент ДИВ
        var div = document.createElement("div");

        var img = document.getElementById("parentHint").style.display='none';
        var rep = document.getElementById("parentId").style.display='block';
        // Добавляем HTML-контент с пом. свойства innerHTML
        div.innerHTML = "<div class='input_add_bid'><input name=\"price_" + curFieldNameId + "\" type=\"text\" placeholder=\"Введите свою цену за кг\" /> <a onclick=\"return deleteBidField(this)\" href=\"#\"><img src=\"images\\ic_clear.png\"></a></div>" +
                        "<input id=\"button_addBid\" type=\"submit\" value=\"Подать заявку\">";
        // Добавляем новый узел в конец списка полей
        document.getElementById("parentId").appendChild(div);
        // Возвращаем false, чтобы не было перехода по сслыке
        return false;
    }
    function selectText() {
        var oTextBox = document.getElementById('createGroupLogin');
        oTextBox.focus();
        oTextBox.select();
    }
    function demo() {
        document.getElementById("login_registration").value="Oleg";
        document.getElementById("n_pass").value="Oleg";
        document.getElementById("name_registration").value="Олег";
        document.getElementById("sname_registration").value="Фомин";
        document.getElementById("email_registration").value="oleg@mail.ru";
        document.getElementById("address_registration").value="Тлендиева 52";
        document.getElementById("phone_registration").value="77778546517";

    }
</script>


</html>
