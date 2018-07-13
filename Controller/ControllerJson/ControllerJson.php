<?php
include('../ControllerDB/ControllerDB.php');
class ControllerJson
{
    private $DB;

    function  __construct()
    {

        $this->DB = DataBaseController::getObject();
        switch($_GET['get']){
            case 'all':
                echo json_encode($this->DB->getAll());
                break;
        }
    }

}
$json=new ControllerJson();