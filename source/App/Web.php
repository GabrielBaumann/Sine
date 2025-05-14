<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Core\Session;
use Source\Models\Auth;

class Web extends Controller
{
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_THEME . "/");        
    }

    public function login(?array $data) : void
    {

        if (!empty($data['csrf'])) {

            var_dump($data);

            if(!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enivar, use o formulário!", "Erro de Envio")->render();
                echo json_encode($json);
                return;
            }

            if(empty($data['user']) || empty($data['password'])) {
                $json['message'] = $this->message->warning("Informe seu usuário e senha para entrar!")->render();
                echo json_encode($json);
                return;
            }

            $auth = (new Auth());

            if (!$auth->login($data['user'], $data['password'])) {
                $json['message'] = $auth->message()->render();
                echo json_encode($json);
                return;
            }

            $json['redirected'] = url("/recipient");
            echo json_encode($json);
            return;
        }

        echo $this->view->render("login", [
            "title" => "Login - OrçaFácil"
        ]);
    }

    public function error() : void
    {
        echo "<h1>404</h1>";    
    }

}