<?php

namespace Source\Models\Views;

use Source\Core\Model;

class VwVacancyActive extends Model
{
    public function __construct()
    {
        parent::__construct(
            "vw_vacancy_active",
            ["id_vacancy"],
            [],
            "id_vacancy"
        );
    }
}
