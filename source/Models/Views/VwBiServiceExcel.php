<?php

namespace Source\Models\Views;

use Source\Core\Model;

class VwBiServiceExcel extends Model
{
    public function __construct()
    {
        parent::__construct(
        "bi_service",
        ["id_service"],
        [],
        "id_service");   
    }
}