<?php

namespace Source\Models;

use Source\Core\Model;

class User extends Model
{
    public function __construct()
    {
        parent::__construct(
            "system_user", ["id_user"], ["name_user","email_user","cpf_user","password_user","type_user"], "id_user"
        );
    }

    public function bootstrap(
        int $idUserRegister,
        string $name,
        string $cpf,
        string $email,
        string $phone,
        string $password,
        string $type,
        int $active
    ) : User {
        $this->id_user_register = $idUserRegister;
        $this->name_user = $name;
        $this->cpf_user = $cpf;
        $this->email_user = $email;
        $this->phone_user = $phone;
        $this->password_user = $password;
        $this->type_user = $type;
        $this->active = $active;
        return $this;
    }
}