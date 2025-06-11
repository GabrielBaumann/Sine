<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\Service;
use Source\Models\SystemUser;
use Source\Models\TypeService;
use Source\Models\Worker;
use Source\Models\WorkerEdit;
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
        if(isset($data["idServiceType"]) && in_array($data["idServiceType"], ["1", "16"])) {
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

                $dataArray = cleanInputData($data, ["observation"]);

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
                    $woker->gender_worker = $dataClean["gender"];
                    $woker->ethnicity_worker = "rosa";
                    $woker->apprentice_worker = $dataClean["apprentice"];
                    $woker->cterc = $dataClean["cterc"];
                    $woker->save();

                    $service = (new Service());
                    $service->id_worker = $idWoker;
                    $service->id_user_register = $this->user->id_user;
                    $service->id_type_service = $data["idServiceType"];
                    $service->detail = $data["observation"];
                    $service->save();

                } else {
                    $woker->id_user_register = $this->user->id_user;
                    $woker->name_worker = $dataClean["nome"];
                    $woker->date_birth_worker = $dataClean["date-birth-worker"];
                    $woker->cpf_worker = $dataClean["cpf"];
                    $woker->pcd_worker = $dataClean["pcd"];
                    $woker->gender_worker = $dataClean["gender"];
                    $woker->ethnicity_worker = "rosa";
                    $woker->apprentice_worker = $dataClean["apprentice"];
                    $woker->cterc = $dataClean["cterc"];
                    $woker->save();

                    $idWoker = $woker->id_worker;

                    $service = (new Service());
                    $service->id_worker = $idWoker;
                    $service->id_user_register = $this->user->id_user;
                    $service->id_type_service = $data["idServiceType"];
                    $service->detail = $data["observation"];
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

            $dataArray = cleanInputData($data, ["observation"]);

            if(!$dataArray["valid"]) {
                $json["message"] = messageHelpers()->error("Preencha os campos obrigatórios!")->render();
                $json["erro"] = true;
                echo json_encode($json);
                return;
            }

                $serviceRetorn = (new TypeService())->findById($data["idServiceType"]);
                    
                if ($serviceRetorn->group === "Telefone") {
                    $group = 16;
                }

                if ($serviceRetorn->group === "Atendimento Presencial") {
                    $group = 1;
                }

            $dataClean = $dataArray["data"];
            $woker = (new Worker());

            if(isset($data["idWorker"])) {
                $idWoker = $data["idWorker"];

                if($data["idServiceType"] === "56" || $data["idServiceType"] === "4") {
                    $wokerEdit = (new WorkerEdit());
                    
                    $wokerEdit->id_worker = $idWoker;
                    $wokerEdit->status_work = "Aguardando Resposta";
                    $wokerEdit->save();
                }
                
                $service = (new Service());
                $service->id_worker = $idWoker;
                $service->id_user_register = $this->user->id_user;
                $service->id_type_service = $data["idServiceType"];
                $service->detail = $data["observation"];
                $service->save();

            } else {
                $woker->id_user_register = $this->user->id_user;
                $woker->name_worker = $dataClean["nome"];
                $woker->date_birth_worker = $dataClean["date-birth-worker"];
                $woker->cpf_worker = $dataClean["cpf"];
                $woker->pcd_worker = $dataClean["pcd"];
                $woker->gender_worker = $dataClean["gender"];
                $woker->ethnicity_worker = "rosa";
                $woker->apprentice_worker = $dataClean["apprentice"];
                $woker->cterc = $dataClean["cterc"];

                    if($data["idServiceType"] === "56" || $data["idServiceType"] === "4") {
                        $woker->status_work = "Aguardando Resposta";
                    }

                $woker->save();
                $idWoker = $woker->id_worker;

                $service = (new Service());
                $service->id_worker = $idWoker;
                $service->id_user_register = $this->user->id_user;
                $service->id_type_service = $data["idServiceType"];
                $service->detail = $data["observation"];
                $service->save();

                $serviceAddWork = (new Service());
                $serviceAddWork->id_worker = $idWoker;
                $serviceAddWork->id_user_register = $this->user->id_user;
                $serviceAddWork->id_type_service = $group ;
                $serviceAddWork->detail = $data["observation"];
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

    public function logout()
    {
        (new Message())->success("Você saiu com sucesso " . Auth::user()->nome . ". Volte logo :)")->flash();    
        
        Auth::logout();
        redirect("/");
    }
}
