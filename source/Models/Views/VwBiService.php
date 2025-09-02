<?php

namespace Source\Models\Views;

use Source\Core\Model;

class VwBiService extends Model
{
    public function __construct()
    {
        parent::__construct(
        "bi_atendimentos",
        ["CPF"],
        [],
        "CPF");   
    }

    public function charGender() : array
    {
        $dataGender = $this->find()->fetch(true);
        $arrayValuesGender = [];

        foreach($dataGender as $dataGenderItem) {
            $arrayValuesGender[] = $dataGenderItem->SEXO;
        }

        $countArrayGender = array_count_values($arrayValuesGender); 

        foreach($countArrayGender as $genderItem => $key) {
            $label[] = $genderItem;
            $total[] = $key;
        }

        $charGender = ["label"=>$label ?? 0,"total"=>$total ?? 0];
        return $charGender;
    }

    public function charColor() : array
    {
        $dataColor = $this->find()->fetch(true);
        $arrayValuesColor = [];
        
        foreach($dataColor as $dataColorItem) {
            $arrayValuesColor[] = $dataColorItem->COR;
        }

        $countArrayColor = array_count_values($arrayValuesColor);

        foreach($countArrayColor as $colorItem => $key) {
            $label[] =  $colorItem;
            $total[] = $key;
        }

        $charColor = ["label"=>$label ?? 0, "total"=>$total ?? 0];
        return $charColor;
    }

}
