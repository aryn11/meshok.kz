<?php   $runQuery = mysqli_query($link, "select * from groups group by created_at desc limit 1");
?>

<div class="parent">
    <div class="block-center-createGroup">
        <form action="?act=addGroup" method="post" id="registration_form">

            <p class="input_registration">Name of the group: <input type="text" id="createGroupLogin" name="cg_name" onfocus="this.select()"
                                      placeholder="for example: Group 22" value="Group<?php   $row=mysqli_fetch_array($runQuery); echo trim($row['id']+1); ?> "></p>

            <p class="input_registration">Добавить участника в группу:<a onclick="return addField()" id="addButton" href="#" style="padding: 12px 7px 2px 7px;"><img width=24 src="images/ic_bid_add.png"></a></p>
            <div id="parentIdGroup">
                <!--fields create here!-->
            </div>
            <input class="button_addGroup" id="create_group" type="submit" value="Создать группу">
        </form>


    </div>
