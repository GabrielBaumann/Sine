<?php

namespace Source\Models;

use Source\Core\Model;

class Service extends Model
{
    public function __construct()
    {
        parent::__construct(
            "service", ["id_service"], ["id_worker", "customer_service"],
            "id_service"
        );
    }
}