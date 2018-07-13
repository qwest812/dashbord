
<?php
include_once('Controller/ControllerDB/ControllerDB.php');


$d=DataBaseController::getObject();
echo '<pre>';

foreach($d->getAll() as$key=> $value){
    var_dump($key);
    var_dump($value);
}
echo '</pre>';


