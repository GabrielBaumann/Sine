<?php

namespace Source\Models\Views;

use Source\Core\Model;

class VwServicePhone extends Model
{
    public function __construct()
    {
        parent::__construct(
        "vw_service_phone",
        ["id_worker"],
        [],
        "id_worker");   
    }
}
