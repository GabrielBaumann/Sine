<?php

namespace Source\Models;

use Source\Core\Model;

class TypeService extends Model
{
    public function __construct()
    {
        parent::__construct(
            "type_service", ["id_type_service"],["group"], "id_type_service"
        );
    }
}