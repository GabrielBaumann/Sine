<?php

namespace Source\Models\Views;

use Source\Core\Model;

class VwService extends Model
{
    public function __construct()
    {
        parent::__construct(
        "vw_service",
        ["id_service"],
        [],
        "id_service");   
    }
}
