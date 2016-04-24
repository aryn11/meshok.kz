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
                    <tr>
                        <td>Рейтинг:</td>
                        <td><div id="raiting_star">
                                <div id="raiting">
                                    <div id="raiting_blank"></div>
                                    <div id="raiting_hover"></div>
                                    <div id="raiting_votes"></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;"><!--<a href="#" id="ratingButton">Оценить продовца</a>-->
                            
                        </td>
                    </tr>
            </table>
            <div class="comment-form">
                <form action="?act=comment" method="post">
                    <input type="text" name="text" placeholder="Оставить комментарии">
                    <input type="text" name="receiver_id" style="display: none;" value="<?php echo $_GET['uid']; ?>">
                    <button type="submit" value="Отправить"><img src="images/ic_message.png" /></button>
                </form>
            </div>

            <div class="comments">

                <table>
                    <?php
                    $queryCommentsOut = "select c.id, c.user_id, c.created_at, c.is_deleted, c.text, uc.id, uc.sender_id, uc.receiver_id, uc.comment_id, u.id as user_id, u.login
                                     from comments c, users u, users_comments uc
                                     where c.id=uc.comment_id and u.id=c.user_id and uc.receiver_id=".$_GET['uid']." order by created_at desc";
                    $runQCO = mysqli_query($link, $queryCommentsOut);
                    while($rowQCO = mysqli_fetch_array($runQCO)){
                    ?>
                    <tr >
                        <td id="comments_tr1"><a href="?page=user&uid=<?php echo $rowQCO['user_id']; ?>"><?php echo $rowQCO['login']; ?></a></td>
                    </tr>
                    <tr >
                        <td id="comments_tr2"><?php echo $rowQCO['created_at']; ?></td>
                    </tr>
                    <tr>
                        <td id="comments_tr3"><?php echo $rowQCO['text']; ?></td>
                    </tr>
                    <tr><td id="comments_hr"><hr></td></tr>
                    <?php }?>
                </table>
            </div>
        </div>
    </div>
</div>

