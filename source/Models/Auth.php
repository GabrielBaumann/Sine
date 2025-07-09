<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Core\Session;

class Auth extends Model
{
    public function __construct()
    {
        parent::__construct("system_user",["id_user"],
        ["cpf_user", "password_user"], "id_user");
    }

    public static function user() : ?SystemUser
    {
        $session = new Session();
        
        if (!$session->has("authUser")){
            return null;
        }

        return (new SystemUser())->findById($session->authUser);    
    }

    public static function logout() : void
    {
        $session = new Session();
        $session->unset("authUser");
    }

    public function login(string $cpf, string $passwordUser) : bool
    {
        $instanciaUser = (new SystemUser())->find("cpf_user = :u", "u={$cpf}");
        $userData = $instanciaUser->fetch();
       
        if(!$userData) {
            $this->message->error("Usuário não cadastrado no sistema!");
            return false;
        }

        if ($userData->active === 2) {
            $this->message->error("Usuário desativado do sistema!");
            return false;
        }
        
        if (!$userData) {
            $this->message->error("O usuário informado não está cadastrado!");
            return false;
        }

        if (!password_verify($passwordUser, $userData->password_user)) {
            $this->message->error("A senha informada não confere!");
            return false;
        }

        // LOGIN

        (new Session())->set("authUser", $userData->id_user);
        $this->message->success("Login efetuado com sucesso")->flash();
        return true;
    }

}
 