<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\Service;
use Source\Models\SystemUser;
use Source\Models\TypeService;
use Source\Models\Worker;
use Source\Support\Message;

class AppServer extends Controller
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

    public function servicePage() : void
    {
        echo $this->view->render("/pageService", [
            "title" => "Atendimento",
            "userSystem" => (new SystemUser())->findById($this->user->id_user)
        ]);    
    }

    public function serviceType() : void
    {
        echo $this->view->render("/pageService/initService", [
            "title" => "Atendimento"
        ]);
    }

    public function serviceReason(array $data) : void
    {

        $type = $data["type"];

        echo $this->view->render("/pageService/reasonService", [
            "title" => "Atendimento",
            "type" => $type            
        ]);
    }

    public function formService(array $data) : void
    {

        // Cadastro e atualização
        if(isset($data["idServiceType"]) && $data["idServiceType"] == "1") {
            if(isset($data["idWorker"])) {
                $idWoker = $data["idWorker"];
            }

            if(!empty($data["csrf"])){

                if(!csrf_verify($data)) {
                    $json["message"] = messageHelpers()->warning("Erro ao enivar, use o formulário! Atualize a página e tente novamente.")->render();
                    $json["erro"] = true;
                    echo json_encode($json);
                    return;
                }

                $dataArray = cleanInputData($data, $data["observation"]);

                if(!$dataArray["valid"]) {
                    $json["message"] = messageHelpers()->error("Preencha os campos obrigatórios!")->render();
                    $json["erro"] = true;
                    echo json_encode($json);
                    return;
                }

                $dataClean = $dataArray["data"];
                $woker = (new Worker());

                if(isset($idWoker)) {
                    $woker->id_worker = $idWoker;
                    $woker->id_user_update = $this->user->id_user;
                    $woker->name_worker = $dataClean["nome"];
                    $woker->date_birth_worker = $dataClean["date-birth-worker"];
                    $woker->cpf_worker = $dataClean["cpf"];
                    $woker->pcd_worker = $dataClean["pcd"];
                    $woker->gender_worker = "M";
                    $woker->ethnicity_worker = "rosa";
                    $woker->apprentice_worker = $dataClean["apprentice"];
                    $woker->cterc = $dataClean["cterc"];
                    $woker->save();

                    $service = (new Service());
                    $service->id_worker = $idWoker;
                    $service->id_user_register = $this->user->id_user;
                    $service->id_type_service = $data["idServiceType"];
                    $service->save();

                } else {
                    $woker->id_user_register = $this->user->id_user;
                    $woker->name_worker = $dataClean["nome"];
                    $woker->date_birth_worker = $dataClean["date-birth-worker"];
                    $woker->cpf_worker = $dataClean["cpf"];
                    $woker->pcd_worker = $dataClean["pcd"];
                    $woker->gender_worker = "M";
                    $woker->ethnicity_worker = "rosa";
                    $woker->apprentice_worker = $dataClean["apprentice"];
                    $woker->cterc = $dataClean["cterc"];
                    $woker->save();

                    $idWoker = $woker->id_worker;

                    $service = (new Service());
                    $service->id_worker = $idWoker;
                    $service->id_user_register = $this->user->id_user;
                    $service->id_type_service = $data["idServiceType"];
                    $service->save();
                }


                $html = $this->view->render("/pageService/sucessService", [
                    "title" => "Atendimento",
                    "type" => (new TypeService())->findById($data["idServiceType"]) ?? null,
                    "candidate" => (new Worker())->findById($idWoker) ?? null
                ]);

                $json["html"] = $html;
                $json["erro"] = false;
                echo json_encode($json);

                return;
            }
        }

        // Somente cadastro e vinculação de todos os outros serviços
        if(!empty($data["csrf"])){
            if(!csrf_verify($data)) {
                $json["message"] = messageHelpers()->warning("Erro ao enivar, use o formulário! Atualize a página e tente novamente.")->render();
                $json["erro"] = true;
                echo json_encode($json);
                return;
            }

            $dataArray = cleanInputData($data, $data["observation"]);

            if(!$dataArray["valid"]) {
                $json["message"] = messageHelpers()->error("Preencha os campos obrigatórios!")->render();
                $json["erro"] = true;
                echo json_encode($json);
                return;
            }

            $dataClean = $dataArray["data"];
            $woker = (new Worker());

            if(isset($data["idWorker"])) {
                $idWoker = $data["idWorker"];
                $service = (new Service());
                $service->id_worker = $idWoker;
                $service->id_user_register = $this->user->id_user;
                $service->id_type_service = $data["idServiceType"];
                $service->save();
            } else {
                $woker->id_user_register = $this->user->id_user;
                $woker->name_worker = $dataClean["nome"];
                $woker->date_birth_worker = $dataClean["date-birth-worker"];
                $woker->cpf_worker = $dataClean["cpf"];
                $woker->pcd_worker = $dataClean["pcd"];
                $woker->gender_worker = "M";
                $woker->ethnicity_worker = "rosa";
                $woker->apprentice_worker = $dataClean["apprentice"];
                $woker->cterc = $dataClean["cterc"];
                $woker->save();
                $idWoker = $woker->id_worker;

                $service = (new Service());
                $service->id_worker = $idWoker;
                $service->id_user_register = $this->user->id_user;
                $service->id_type_service = $data["idServiceType"];
                $service->save();

                $serviceAddWork = (new Service());
                $serviceAddWork->id_worker = $idWoker;
                $serviceAddWork->id_user_register = $this->user->id_user;
                $serviceAddWork->id_type_service = 1;
                $serviceAddWork->save();
            }

            $html = $this->view->render("/pageService/sucessService", [
                "title" => "Atendimento",
                "type" => (new TypeService())->findById($data["idServiceType"]) ?? null,
                "candidate" => (new Worker())->findById($idWoker) ?? null
            ]);

            $json["html"] = $html;
            $json["erro"] = false;
            echo json_encode($json);

            return;
        }

        // Tipo de rota para voltar dependendo de onde o formulário foi chamado
        if(isset($data["type"])) {
            
            $typeService = $data["typeservice"];
            $type = $data["type"];

            if($type === "atendimento") {
                $url = url("/atendimentomotivo/{$typeService}");
            }

            if($type === "desemprego") {
                $url = url("/segurodesemprego/{$typeService}");
            }

            if($type === "especial") {
                $url = url("/requerimentoEspecial/{$typeService}");
            }
        }


        echo $this->view->render("/forms/formsService", [
            "title" => "Atendimento",
            "url" => $url ?? null,
            "idServiceType" => $data["idServiceType"] ?? null
        ]);        

    }

    public function formCpfCheck(array $data) : void
    {

        $cpfuser = $data["cpf"];
        $url = $data["url"];
        $titleForm = $data["titleForm"];
        $idServiceType = $data["idServiceType"];

        if(!validateCPF($cpfuser)){
            $json["message"] = messageHelpers()->warning("O CPF: " . formatCPF($cpfuser) . " não é válido!")->render();
            $json["erro"] = true;
            echo json_encode($json);
            return;
        }

        $worker = (new Worker())->find("cpf_worker = :c", "c={$cpfuser}");

        if ($worker->fetch()) {

            $html = $this->view->render("/forms/formsService", [
                "titel" => "Atendimento",
                "worker" => $worker->fetch(),
                "titleForm" => $titleForm,
                "url" => $url,
                "idServiceType" => $idServiceType ?? null
            ]);  

            $json["html"] = $html;
            $json["message"] = "";
            $json["erro"] = false;
            echo json_encode($json);
            return;
        }

        if(!$worker->fetch()) {
            $json["erro"] = false;
            $json["message"] = "";
            $json["freeCpf"] = true;
            echo json_encode($json);
            return;
        }

    }

    public function serviceInsurance(array $data) : void
    {
        $type = $data["type"];

        echo $this->view->render("/pageService/insuranceService", [
            "title" => "Atendimento",
            "type" => $type 
        ]);
    }

    public function serviceRequired(array $data) : void
    {
        $type = $data["type"];
        echo $this->view->render("/pageService/requiredService", [
            "title" => "Atendimento",
            "type" => $type 
        ]);  
    }

    public function serviceSucess() : void
    {
        echo $this->view->render("/pageService/sucessService", [
            "title" => "Atendimento"
        ]); 
    }

    public function userSystem() : void
    {
        echo $this->view->render("/usuario", [
            "title" => "Usuarios",
            "users" => (new SystemUser())->find()->fetch(true)
        ]);
    }

    public function modelAddUser(?array $data) : void
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
                
                $html = $this->view->render("user/listUserSystem", [
                "users" => (new SystemUser())->find()->fetch(true)
                ]);

                $json["complete"] = $complete;
                $json["message"] = messageHelpers()->success("Registro salvo com sucesso!")->render();
                $json["html"] = $html;

                echo json_encode($json);
                return;
            }
        }

        echo $this->view->render("/user/modalForm", [
            "user" => $userSystem ?? null
        ]);
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
