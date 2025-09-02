<?php

namespace Source\Models\Views;

use Source\Core\Model;

class VwBiService extends Model
{
    public function __construct()
    {
        parent::__construct(
        "bi_atendimentos",
        ["CPF"],
        [],
        "CPF");   
    }

    public function charGender() : array
    {
            
    }

}
