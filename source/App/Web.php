<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\Vacancy;

class Web extends Controller
{
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_THEME . "/");        
    }

    public function login(?array $data) : void
    {
        if (!empty($data['csrf'])) {

            if(!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enivar, use o formulário!", "Erro de Envio")->render();
                echo json_encode($json);
                return;
            }

            if(empty($data['cpfuser']) || empty($data['password'])) {
                $json['message'] = $this->message->warning("Informe seu usuário e senha para entrar!")->render();
                echo json_encode($json);
                return;
            }

            $auth = (new Auth());

            if (!$auth->login(cleanCPF($data['cpfuser']), $data['password'])) {
                $json['message'] = $auth->message()->render();
                echo json_encode($json);
                return;
            }

            $json['redirected'] = url("/inicio");
            $vaca = (new Vacancy())->checkdDateClousure();
            echo json_encode($json);
            return;
        }

        echo $this->view->render("login", [
            "title" => "Login - Sine 360"
        ]);
    }

    public function error() : void
    {
        echo $this->view->render("/PageError/error", [
        ]);
    }
}