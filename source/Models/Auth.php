<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Core\Session;

class Auth extends Model
{
    public function __construct()
    {
        parent::__construct("usuarios",["id_usuarios", "id_entidade"],["nome", "email", "senha"]);
    }

    public static function user() : ?User
    {
        $session = new Session();
        
        if (!$session->has("authUser")){
            return null;
        }

        return (new User())->findById($session->authUser);    
    }

    public static function logout() : void
    {
        $session = new Session();
        $session->unset("authUser");
    }

    public function login(string $user, string $senha) : bool
    {
        $instanciaUser = (new User())->find("usuario = :u", "u={$user}");
        $user = $instanciaUser->fetch();

        if (!$user) {
            $this->message->error("O usuário informado não está cadastrado!");
            return false;
        }
        
        // Inserir a verificação de hash de senha
        if ($user->senha !== $senha) {
            $this->message->error("A senha informada não confere!");
            return false;
        }

        if ($user->ativo === 0) {
            $this->message->error("Usuário desativado do sistema!");
            return false;
        }

        // LOGIN

        (new Session())->set("authUser", $user->id_usuarios);
        $this->message->success("Login efetuado com sucesso")->flash();
        return true;
    }

}