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

    public function charService(int $type = 1)
    {   
        // Cada número é um tipo de filtro para o gráfico
        // 01 - filtro de dia
        // 02 - filtro de mês
        // 03 - filtro de ano

        if($type === 1) {

            $serviceChar = Connect::getInstance()->prepare("SELECT * FROM vw_char_day WHERE month = MONTH(CURDATE()) AND year = YEAR(CURDATE())");
            $serviceChar->execute();
            $datas = $serviceChar->fetchAll(PDO::FETCH_ASSOC);

            foreach($datas as $datasItem) {
                $label[] = $datasItem["day"];
                $total[] = $datasItem["total"];
            }
            
            $char = ["label"=>$label ?? 0,"total"=>$total ?? 0];
            return $char;            
        } 

        if($type === 2) {

            $serviceChar = Connect::getInstance()->prepare("SELECT * FROM vw_char_date WHERE year = YEAR(CURDATE())");
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

                $listData[] = $monthsAbbreviation[(int)$data["month"]];

            }

            $dataCount = array_count_values($listData ?? []);

            if($type) {
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
            
            $char = ["label"=>$label ?? 0,"total"=>$total ?? 0];
            return $char;
        }

        if($type === 3) {

            $serviceChar = Connect::getInstance()->prepare("SELECT * FROM vw_char_year");
            $serviceChar->execute();
            $datas = $serviceChar->fetchAll(PDO::FETCH_ASSOC);

            foreach($datas as $datasItem) {
                $label[] = $datasItem["year"];
                $total[] = $datasItem["total"];
            }
            
            $char = ["label"=>$label ?? 0,"total"=>$total ?? 0];
            return $char;    
        }

    }
}