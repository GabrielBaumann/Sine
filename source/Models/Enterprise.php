<?php

namespace Source\Models;

use Source\Core\Model;

class Enterprise extends Model
{
    public function __construct()
    {
        parent::__construct(
            "enterprise", ["id_enterprise"], ["name_enterprise", "cnpj_cpf"],
            "id_enterprise"
        );
    }

    // verificar se o CNPJ já existe no banco de dados
    public function getByCnpj(string $cnpj) : bool
    {
        $cnpjEnterprise = $this->find("cnpj_cpf = :c", "c={$cnpj}")->fetch();

        if (!$cnpjEnterprise) {
            return false;
        }
        return true;
    }

}