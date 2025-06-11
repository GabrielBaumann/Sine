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

    public function charService(?int $year = null): array
    {
        $year = $year ?? date('Y');
        $serviceChar = Connect::getInstance()->prepare("SELECT * FROM vw_char_service WHERE year = {$year}");
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

        foreach($datas as $data) {
 
            $monyt[] = $monthsAbbreviation[(int)$data["month"]];
            $total[] = $data["total"];
            $years[] = $data["year"];
        }

        $char = [ "month"=>$monyt, "years"=>$years ,"total"=>$total];
        return $char; 
    }

}