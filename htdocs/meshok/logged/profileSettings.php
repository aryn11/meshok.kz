<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.04.2016
 * Time: 11:19
 */
$queryUser = "select * from users where id=" . $_SESSION['user_id'] . " LIMIT 1";
$queryUsers = mysqli_query($link, $queryUser);
$userRow = mysqli_fetch_array($queryUsers);
?>

<div class="parent">
    <div class="block-center-registration">
        <form action="?act=changeUserData" method="post" id="registration_form">
            <p class="input_registration">Имя:        <input type="text" name="c_fname" placeholder="Введите свое имя" value="<?php echo $userRow['fname']; ?>"></p>
            <p class="input_registration">Фамилия:    <input type="text" name="c_lname" placeholder="Введите свою фамилию" value="<?php echo $userRow['lname']; ?>"></p>
            <p class="input_registration">E-mail:     <input type="text" name="c_email" placeholder="Введите сво email" value="<?php echo $userRow['email']; ?>"></p>
            <p class="input_registration">Адрес:      <input type="text" name="c_address" placeholder="Введите свой адресс" value="<?php echo $userRow['address']; ?>"></p>
            <p class="input_registration">Телефон: +7 <input type="text" name="c_phone" placeholder="Введите свой телефон" value="<?php echo $userRow['phone']; ?>"></p>
            <p><input class="input_changes" type="submit" value="Изменить данные"></p>
        </form>
    </div>

</div>
