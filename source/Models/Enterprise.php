<?php

namespace Source\Models;

use Source\Core\Model;

class Enterprise extends Model
{
    public function __construct()
    {
        parent::__construct(
            "enterprise", ["id_enterprise"], ["name_enterprise", "email_enterprise", "responsible_enterprise", "phone_enterprise","observation_enterprise"],
            "id_enterprise"
        );
    }
}