<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.04.2016
 * Time: 11:19
 */
$queryGroup = "select * from groups where id=" . $_GET['gid'] . " and created_user_id=". $_SESSION['user_id']." LIMIT 1";
$queryGroups = mysqli_query($link, $queryGroup);
$groupRow = mysqli_fetch_array($queryGroups);
?>

<div class="parent">
    <div class="block-center-registration">

        <form action="?act=changeGroupData" method="post" id="registration_form">
            <input id="hiden_input" type="text" name="c_gid" value="<?php echo $_GET['gid']; ?>">
            <p class="input_registration">Название:        <input type="text" name="c_gname" placeholder="Введите название группы" value="<?php echo $groupRow['name']; ?>"></p>
            <p style="margin-top:7px;"><input class="input_changes" type="submit" value="Изменить данные"></p>
        </form>
        <div id="delete_group_div">
            <p class="delete_group_text">Удалить группу</p><p class="delete_group"><a href="?act=removeGroup&gid=<?php echo $groupRow['id']; ?>&uid=<?php echo $groupRow['created_user_id']; ?>"><img src="images/ic_delete_forever.png"</a></p>
        </div>
    </div>

</div>
