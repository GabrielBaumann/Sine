<?php

namespace Source\Models;

use Source\Core\Model;

class Vacancy extends Model
{
    public function __construct()
    {
        parent::__construct(
            "vacancy", ["id_vacancy"], ["id_enterprise", "cbo_occupation", "pcd_vacancy", "apprentice_vacancy", "gender_vacancy",
            "number_vacancy", "quantity_vacancy", "date_open_vacancy", "education_vacancy", "age_min_vacancy", "age_max_vacancy", 
            "exp_vacancy", "description_vacancy", "request_vacancy", "nomeclatura_vacancy", "status_vacancy"],
            "id_vacancy"
        );
    }
}