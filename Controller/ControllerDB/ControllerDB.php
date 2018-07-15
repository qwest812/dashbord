<?php

/**
 * Class DataBaseController
 */
class ControllerDB
{
    protected $host = '127.0.0.1';
    protected $db = 'dashbord';
    protected $user = 'root';
    protected $pass = '';
    protected $charset = 'utf8';
    protected static $dbObject;
    protected static $DB = '';
    protected $pdo = '';

    private function  __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }
    }

    /**
     * @return DataBaseController|string
     *
     */
    static function getObject()
    {
        if (!self::$DB) {
            self::$DB = new self;
        }
        return self::$DB;
    }

    /**
     * @param $email
     * @return string
     *
     */
    function ifUserExist($login)
    {
//        var_dump($login);
        $sql = "SELECT * FROM `user` WHERE `user_login`=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$login]);
        return $stmt->fetchColumn();
    }

    function selectPassByLogin($login)
    {
//        $email = 'rybachuk.iaroslav@gmail.com1';
//var_dump($email);
        $sql = "SELECT `id`,`user_pass` FROM `user` WHERE user_login= ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$login]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param $userData
     * @return mixed
     */
    function addUser($userData)
    {
//        var_dump($userData);
//    function addUser(){
//            $sql="INSERT INTO `users` (`id`, `user_name`, `user_sname`, `user_email`, `user_phone`, `user_pass`, `user_birthday`, `user_sex`, `reg_date`)
//                  VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?);";
        $sql = "INSERT INTO `users`(`id`, `user_name`, `user_sname`, `user_email`, `user_phone`, `user_pass`, `user_birthday`, `user_sex`, `reg_date`) VALUES (NULL,?,?,?,?,?,?,?,?);";
//        var_dump($sql);
        $stmt = $this->pdo->prepare($sql);
//        var_dump($stmt->execute([
//            $userData['user_name'],
//            $userData['user_sname'],
//            $userData['user_email'],
//            $userData['user_phone'],
//            $userData['user_pass'],
//            $userData['user_birthday'],
//            $userData['user_sex'],
//            $userData['user_reg_date'],
//        ]));
        return $stmt->execute([
            $userData['user_name'],
            $userData['user_sname'],
            $userData['user_email'],
            $userData['user_phone'],
            $userData['user_pass'],
            $userData['user_birthday'],
            $userData['sex'],
            $userData['user_reg_date'],
        ]);
    }

//    /**
//     * @return array
//     */
//    function  selectAll()
//    {
//        $sql = "SELECT `name`, `name_eng`, `name_righter` FROM `book`, `righter` WHERE book.id_righter=righter.id";
//        $result = array();
//        $stmt = $this->pdo->query($sql);
//        $result = array();
//        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//            $result[] = $row;
//        }
//        return $result;
//
//    }

    /**
     * @param $table
     * @return bool
     */
    function ifTableExist($table)
    {
        $sql = "SHOW TABLES LIKE ?";

        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute(array($table))) {
            $isTable = $stmt->fetch();
            return $isTable != false;

        }
        return false;
    }

    /**
     * create users table
     * @return bool
     */
    function createTable()
    {
        if (!$this->ifTableExist('users')) {
            $sql = "CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(30) NOT NULL,
    user_sname VARCHAR(30) NOT NULL,
    user_email VARCHAR(50) NOT NULL,
    user_phone VARCHAR(30) NOT NULL,
    user_pass VARCHAR(30) NOT NULL,
    user_birthday DATE NOT NULL,
    user_sex VARCHAR(6) NOT NULL,
    reg_date TIMESTAMP
    )";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute();

        }
        return false;
    }


    /**
     * @param $data
     * @return bool
     */
    function clietnToDB($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        $sql = 'INSERT INTO `client`(`ID_CLIENT`, `FORMA`) VALUES (?,?)';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['0'],
            $data['1'],
        ]);
    }


    /**
     * @param $data
     * @return bool
     */

    function  accoutnToDB($data)
    {
var_dump($data);
//  "0--ACC_NUMBER
//"  "1--ID_CLID
//" "2--DATEOPEN
//"  "3--DATECLOSE
//"  "4--SOURCE_OPEN

        $sql = "INSERT INTO `account`
(`ACC_NUMBER`, `ID_CLID`, `DATEOPEN`, `DATECLOSE`, `SOURCE_OPEN`)
 VALUES (?,?,?,?,?) ";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['0'],
            $data['1'],
            $data['2'],
            $data['3'],
            $data['4'],
        ]);

    }
    function  getAll(){
        $sql="SELECT `ACC_NUMBER`,`ID_CLID`,`DATEOPEN`,`DATECLOSE`,`SOURCE_OPEN`,`FORMA` FROM `account`,`client` WHERE account.ID_CLID =client.ID_CLIENT" ;
        $stmt = $this->pdo->query($sql);
        $result = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }
}




//$f = DataBaseController::getObject()->createTable();
//var_dump($f);