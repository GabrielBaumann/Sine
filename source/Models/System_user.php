<?php

namespace Source\Models;

use Source\Core\Model;

class System_user extends Model
{
    public function __construct()
    {
        parent::__construct(
            "system_user", ["id_user"], ["name_user", "email_user", "email_user", "phone_user", "password_user", "type_user"],
            "id_user"
        );
    }
}