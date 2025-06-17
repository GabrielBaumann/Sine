<?php

namespace Source\Models\Views;

use Source\Core\Model;

class VwVacancy extends Model
{
    public function __construct()
    {
        parent::__construct(
            "vw_vacancy_list",
            ["id_vacancy"],
            [],
            "id_vacancy"
        );        
    }
}