<?php
require_once '../../PHPExcel-1.8/Classes/PHPExcel.php';
require_once '../ControllerDB/ControllerDB.php';

class ControllerExel
{

    public $exel;
    private $DB;

    function  __construct()
    {
        $this->DB = ControllerDB::getObject();
        $this->exel = PHPExcel_IOFactory::load('../../doc.xlsx');
        $list = $this->createList();
        $this->addUserExcelToDb($list);
    }

    function addUserExcelToDb($lists)
    {
        $account = array_shift($lists['account']);
        $client = array_shift($lists['client']);

//        for ($i = 0; $i <= count($lists['client']);$i++){
//            echo '<pre>';
//            var_dump($this->DB->clietnToDB($lists['client'][$i]));
//            echo '</pre>';
//        }
        $data = [
            '2600123456789',
            1111,
            '2017-07-01',
            NULL,
            'SITE'
        ];
//        $this->DB->accoutnToDB($data);
        for ($i = 0; $i <= count($lists['account']);$i++){

            $lists['account'][$i][2]=$this->correctData($lists['account'][$i][2]);
            $lists['account'][$i][3]=$this->correctData($lists['account'][$i][3]);
            echo '<pre>';
            var_dump($this->DB->accoutnToDB($lists['account'][$i]));
            echo '</pre>';
        }
    }

    /**
     * @param $data
     * @return string
     */
    public function correctData($data)
    {
        if ($data !== NULL) {
            $array = explode('.', $data);
            return $array[2] . '-' . $array[1] . '-' . $array[0];
        }
        return NuLL;

    }

    function  createList()
    {
        $lists = [];
        $newlists = [];
        foreach ($this->exel->getWorksheetIterator() as $key => $worksheet) {
            $lists[] = $worksheet->toArray();
        }

        foreach ($lists as $list) {
            // Перебор строк
            foreach ($list as $key => $row) {
                $count = count($row);
                if ($count == 5) {
                    $newlists['account'][$key] = $row;

                } elseif ($count == 2) {
                    $newlists['client'][$key] = $row;
                }
            }
        }
        return $newlists;
    }
}

$f = new ControllerExel();

//var_dump($f->correctData('01.07.2017'));
//            echo '<pre>';
//            var_dump($lists);
//            echo '</pre>';
