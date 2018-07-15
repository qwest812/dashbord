<?php
if($_GET['error']){
    echo 'Нужна авторизация';
}
?>
<form method="post" action="/dashbord.php">
    <h1> Login and pass: demo</h1>
    <label>Login: </label><input type="text" name="user_login">
    <label>Pass: </label><input type="text" name="password">
    <input type="submit" name="log" value="Login">
</form>

