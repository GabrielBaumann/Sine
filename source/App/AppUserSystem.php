<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\SystemUser;
use Source\Support\Message;

class AppUserSystem extends Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/". CONF_VIEW_APP ."/");

        if (!$this->user = Auth::user()) {
            $this->message->warning("Efetue login para acessar o sistema.")->flash();
            redirect("/");
        }
    }

     public function userSystem() : void
    {

        echo $this->view->render("/pageUserSystem", [
            "title" => "Usuarios",
            "users" => (new SystemUser())->find()->fetch(true),
            "userSystem" => (new SystemUser())->findById($this->user->id_user)
        ]);
    }

    public function formAddUser(?array $data) : void
    {   

        if(isset($data["idUserSystem"])) {
            $idUserSystem = $data["idUserSystem"];
            $userSystem = (new SystemUser())->find("id_user = :id","id={$idUserSystem}")->fetch();
        }

        if (!empty($data["csrf"])) {
            
            // Verificar csrf
            if(!csrf_verify($data)) {
                $json["message"] = messageHelpers()->warning("Use o fomulário!")->render();
                echo json_encode($json);
                return;
            }

            // Verificar campos obrigatórios e sanitizá-los
            $dataCleanCheck = cleanInputData($data);

            if(!$dataCleanCheck['valid']) {
                $json["message"] = messageHelpers()->warning("Preencha todos os campos!")->render();
                echo json_encode($json);
                return;
            }

            $dataClean = $dataCleanCheck["data"];

            // Verificar se é um email válido
            if(!is_email($dataClean["email"])) {
                $json["message"] = messageHelpers()->warning("Esse email não é válido!")->render();
                echo json_encode($json);
                return;
            }

            $SytemUser = new SystemUser();

            $SytemUser->bootstrap(
                1,
                $dataClean["name"],
                $dataClean["cpf"],
                $dataClean["email"],
                $dataClean["phone"],
                $dataClean["password"],
                $dataClean["type"]
            );

            // Reseta o formulario e atualiza lista
            $complete = [
                "resetForm" => true, 
                "updateList" => true
            ];

            // Para identiticar como edição do cadastro
            if(isset($idUserSystem)) {
                $SytemUser->id_user = $idUserSystem;
                $SytemUser->id_user_update = 2;
                $SytemUser->active = $dataClean["status"];
                // Não reseta o formulário e atualiza alista
                $complete = [
                "resetForm" => false, 
                "updateList" => true
                ];
            }

            // var_dump($complete);
            if($SytemUser->save()) {
                
                $html = $this->view->render("pageUserSytem/listUserSystem", [
                "users" => (new SystemUser())->find()->fetch(true)
                ]);

                $json["complete"] = $complete;
                $json["message"] = messageHelpers()->success("Registro salvo com sucesso!")->render();
                $json["html"] = $html;

                echo json_encode($json);
                return;
            }
        }

        $html = $this->view->render("/pageUserSystem/formNewUser", [
            "user" => $userSystem ?? null
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

    
    public function checkCpf($data) : void
    {
        $cpfuser = $data["cpf"];

        if(!validateCPF($cpfuser)){
            $json["message"] = messageHelpers()->warning("O CPF: " . formatCPF($cpfuser) . " não é válido!")->render();
            $json["erro"] = true;
            echo json_encode($json);
            return;
        }

        if(isset($data["idSystemUser"])) {
            $user = (new SystemUser())->find("cpf_user = :c AND id_user <> :i", "c={$cpfuser}&i={$data["idSystemUser"]}");
        } else {
            $user = (new SystemUser())->find("cpf_user = :c", "c={$cpfuser}");
        }

        if ($user->fetch()) {
            $json["message"] = messageHelpers()->warning("O CPF: " . formatCPF($cpfuser) . " já existe na base de dados!")->render();
            $json["erro"] = true;
            echo json_encode($json);
            return;
        }
        $json["message"] = "";
        $json["erro"] = false;
        echo json_encode($json);
        return;
    }

    public function logout()
    {
        (new Message())->success("Você saiu com sucesso " . Auth::user()->nome . ". Volte logo :)")->flash();    
        
        Auth::logout();
        redirect("/");
    }

}
