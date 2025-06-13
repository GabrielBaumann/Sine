<?php

namespace Source\Models;

use Source\Core\Model;

class Vacancy extends Model
{
    public function __construct()
    {
        parent::__construct(
            "vacancy", ["id_vacancy"], ["id_enterprise", "cbo_occupation", "pcd_vacancy", "apprentice_vacancy", "gender_vacancy",
            "number_vacancy", "quantity_per_vacancy", "date_open_vacancy", "education_vacancy", "age_min_vacancy", "age_max_vacancy", 
            "exp_vacancy", "nomeclatura_vacancy"],
            "id_vacancy"
        );
    }

    public function chartVacancy() : array
    {
        $chart = $this->find()->fetch(true);
        foreach($chart as $char) {
            $chartList[] = $char->status_vacancy;
        }

        $charCount =  array_count_values($chartList);

        foreach($charCount as $key => $value ) {
            $label[] = $key;
            $total[] = $value;
        }
        return ["label" => $label, "total" => $total];
    }
    
    public function chartVacancyGender() : array
    {
        $chart = $this->find()->fetch(true);
        foreach($chart as $char) {
            $chartList[] = $char->gender_vacancy;
        }

        $charCount =  array_count_values($chartList);

        foreach($charCount as $key => $value ) {
            $label[] = $key;
            $total[] = $value;
        }
        return ["label" => $label, "total" => $total];
    }
    
}