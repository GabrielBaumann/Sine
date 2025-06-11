<?php

namespace Source\Models;

use Source\Core\Model;
use PDO;
use Source\Core\Connect;

class Service extends Model
{
    public function __construct()
    {
        parent::__construct(
            "service", ["id_service"], ["id_worker", "id_type_service"],
            "id_service"
        );
    }

    public function charService(?bool $year = null)
    {
        $where = "";

        if(!$year) {
            $yearNow = date('Y');
            $where = " WHERE year = {$yearNow}";
        }

        $serviceChar = Connect::getInstance()->prepare("SELECT * FROM vw_char_date" . $where);
        $serviceChar->execute();
        $datas = $serviceChar->fetchAll(PDO::FETCH_ASSOC);

        $monthsAbbreviation = [
            1 => 'Jan',
            2 => 'Fev',
            3 => 'Mar',
            4 => 'Abr',
            5 => 'Mai',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Ago',
            9 => 'Set',
            10 => 'Out',
            11 => 'Nov',
            12 => 'Dez'
        ];

        $mapOrdem = array_flip($monthsAbbreviation);

        foreach($datas as $data) {

            if ($year) {
                $listData[] = $data["year"];
            } else {
                $listData[] = $monthsAbbreviation[(int)$data["month"]];
            }
        }

        $dataCount = array_count_values($listData);

        if($year) {
            ksort($dataCount);
        } else {
            uksort($dataCount, function($a, $b) use ($mapOrdem) {
                return $mapOrdem[$a] - $mapOrdem[$b];
            });
        }

        foreach($dataCount as $key => $value) {
            $label[] = $key;
            $total[] = $value;
        }
        
        $char = ["label"=>$label,"total"=>$total];
        return $char; 
    }

}