<?php
class ControllerLogin
{
    public  $DB;
    function  __construct()
    {

        $this->DB = ControllerDB::getObject();
        if($this->login()){
            $_SESSION['login']='good';

        }else{
            header("HTTP/1.1 401 Unauthorized");
            header("Location: index.php?error=33");
        }
    }

    function login()
    {
        if ($this->DB->ifUserExist($_POST['user_login'])) {
            if ($_POST['password']) {
//            echo '<pre>';
////echo '<pre>';
//            var_dump($_POST);
//            echo '</pre>';
                $user_data = $this->clearValueArray($_POST);
                if($this->ifPassEquelByPass($user_data['user_login'], $user_data['password'])){
//                    var_dump(444);
                    return true;
                }
            }
        }
        return false;
    }
    function clearValueArray($array)
    {
        foreach ($array as $key => $value) {
            $array[$key] = trim($value);
        }
        return $array;
    }
    function ifPassEquelByPass($login, $pass)
    {
        $result = $this->DB->selectPassByLogin($login);
        if ($pass === $result['user_pass']) {
            return true;
        }
        return false;
//        var_dump($pass);
    }
}
$f=new ControllerLogin();