<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.04.2016
 * Time: 19:22
 */
$queryContact = "select * from users where role=3 LIMIT 1";
$queryContacts = mysqli_query($link, $queryContact);
$rowContact = mysqli_fetch_array($queryContacts);
?>
<div class="parent">
    <div class="block-center-contacts">
        <div class="profile_info">
            <h2>Контакты</h2>
            <table class="profile_table">
                <tr>
                    <td>Фамилия:</td>
                    <td><?php echo $rowContact['lname']; ?></td>
                </tr>
                <tr>
                    <td>Имя:</td>
                    <td><?php echo $rowContact['fname']; ?></td>
                </tr>
                <tr>
                    <td>Тип:</td>
                    <td><?php echo user_type($rowContact['role']); ?></td>
                </tr>
               
                <tr>
                    <td>Email:</td>
                    <td><?php echo $rowContact['email']; ?></td>
                </tr>
                <tr>
                    <td>Адресс:</td>
                    <td><?php echo $rowContact['address']; ?></td>
                </tr>
                <tr>
                    <td>Телефон:</td>
                    <td><?php echo "+7 " . $rowContact['phone']; ?></td>
                </tr>

            </table>
        </div>
    </div>
</div>
