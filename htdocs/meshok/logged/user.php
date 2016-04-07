<?php
$queryUser = "select * from users where id=" . $_GET['uid'] . " LIMIT 1";
$queryUsers = mysqli_query($link, $queryUser);
$rowUser = mysqli_fetch_array($queryUsers);
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.04.2016
 * Time: 16:16
 */ ?>

<div class="parent">
    <div class="block-center-user">
        <div class="profile_info">
            <h2>Профиль аккаунта <b><?php echo $rowUser['login']; ?></b></h2>
            <table class="profile_table">
                <tr>
                    <td>Фамилия:</td>
                    <td><?php echo $rowUser['lname']; ?></td>
                </tr>
                <tr>
                    <td>Имя:</td>
                    <td><?php echo $rowUser['fname']; ?></td>
                </tr>
                <tr>
                    <td>Тип:</td>
                    <td><?php echo user_type($rowUser['role']); ?></td>
                </tr>
                <tr>
                    <td>Создан:</td>
                    <td><?php
                        $date = new DateTime($rowUser['created_at']);
                        echo $date->Format('d/m/Y');
                        ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?php echo $rowUser['email']; ?></td>
                </tr>
                <tr>
                    <td>Адресс:</td>
                    <td><?php echo $rowUser['address']; ?></td>
                </tr>
                <tr>
                    <td>Телефон:</td>
                    <td><?php echo "+7 " . $rowUser['phone']; ?></td>
                </tr>
                <?php if ($rowUser['role'] == 1) { ?>
                    <tr>
                        <td>Рейтинг:</td>
                        <td></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
