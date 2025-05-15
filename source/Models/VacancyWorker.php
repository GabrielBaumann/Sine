<?php

namespace Source\Models;

use Source\Core\Model;

class VacancyWorker extends Model
{
    public function __construct()
    {
        parent::__construct(
            "vacancy_worker", ["id_vacancy_worker"], ["id_vacancy", "id_worker"],
            "id_vacancy_worker"
        );
    }
}