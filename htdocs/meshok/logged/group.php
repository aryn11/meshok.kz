<?php
$gid = $_GET['gid'];
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.04.2016
 * Time: 14:14
 */
$queryGroup = "select g.id, g.created_user_id, g.name, g.created_at, g.is_deleted, u.id, u.login, u.email, u.phone
                from groups g, users u
                where g.created_user_id=u.id and g.id=$gid";
$queryGroups = mysqli_query($link, $queryGroup);
$rowGroup=mysqli_fetch_array($queryGroups);
?>
<div class="parent">
    <div class="block-center-group">
        <div class="profile_info">
            <h2>Группа <?php if($rowGroup['created_user_id']==$_SESSION['user_id']){?><a href="?page=groupSettings&gid=<?php echo $gid; ?>"><img id="ic_settings" src="images/ic_settings.png"></a><?php } ?></h2>
            <table class="profile_table">
                <tr>
                    <td>Название:</td>
                    <td><?php echo $rowGroup['name']; ?></td>
                </tr>
                <tr>
                    <td>Cоздана:</td>
                    <td><?php echo $rowGroup['created_at']; ?></td>
                </tr>
                <tr>
                    <td>Лидер: </td>
                    <td><?php echo $rowGroup['login']; ?></td>
                </tr>

                <tr>
                    <td>Email лидера:</td>
                    <td><?php echo $rowGroup['email']; ?></td>
                </tr>
                <tr>
                    <td>Телефон:</td>
                    <td><?php echo "+7 " . $rowGroup['phone']; ?></td>
                </tr>

            </table>
        </div>
    </div>
</div>
