<script>
    function check() {
        var pass = document.getElementById("n_pass");
        if (pass.type == "password") {
            pass.type = "text";
        } else {
            pass.type = "password";
        }
    }
</script>
<div class="parent">
    <div class="block-center-registration">
        <form action="?act=reg" method="post" id="registration_form">
            <p class="input_registration">Login:      <input type="text" name="n_login" placeholder="Login"></p>
            <p class="input_registration">Password:   <input type="password" id="n_pass" name="n_pass" placeholder=""></p>
            <p class="check_registration_buttons_2"><input type="checkbox" name="ckeck" onchange="check()"> Show Password</p>
            <p class="input_registration">Имя:        <input type="text" name="n_fname" placeholder="Введите свое имя"></p>
            <p class="input_registration">Фамилия:    <input type="text" name="n_lname" placeholder="Введите свою фамилию"></p>
            <p class="input_registration">E-mail:     <input type="text" name="n_email" placeholder="Введите сво email"></p>
            <p class="input_registration">Адрес:      <input type="text" name="n_address" placeholder="Введите свой адресс"></p>
            <p class="input_registration">Телефон: +7 <input type="text" name="n_phone" placeholder="Введите свой телефон"></p>
            <p class="check_registration_buttons"><input type="radio" name="n_user_type" value="1"> Продавец
                        <input type="radio" name="n_user_type" value="2"> Покупатель</p>
            <p><input class="input_reg" type="submit" value="Create my account!"></p>
        </form>
    </div>

</div>
