<?php

namespace Source\Models\Views;

use Source\Core\Model;

class VwForwardingWorker extends Model
{
    public function __construct()
    {
        parent::__construct(
        "vw_forwarding_worker",
        ["id_vacancy_worker"],
        [],
        "id_vacancy_worker");   
    }
}
