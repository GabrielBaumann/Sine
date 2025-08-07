<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\Service;
use Source\Models\SystemUser;
use Source\Models\TypeService;
use Source\Models\VacancyWorker;
use Source\Models\Views\VwVacancyActive;
use Source\Models\Worker;
use Source\Models\WorkerEdit;
use Source\Models\WorkerPhone;
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
        // Encaminhar dados quando for por telefone
        if(isset($data["typeService"]) && $data["typeService"] === "telefone") {

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
                $woker = (new WorkerPhone());

                $woker->id_user_register = $this->user->id_user;
                $woker->name_work_phone = $dataClean["nome"];
                $woker->contact_ddd_work = $dataClean["contact-ddd-work"];
                $woker->contact_work = str_replace("-", "", $dataClean["contact-work"]);
                $woker->save();
                
                $idWoker = $woker->id_work_phone;
                $service = (new Service());
                
                $service->id_worker = $idWoker;
                $service->id_user_register = $this->user->id_user;
                $service->id_type_service = $data["idServiceType"];
                $service->detail = $data["observation"];
                $service->save();

                $html = $this->view->render("/pageService/sucessService", [
                    "title" => "Atendimento",
                    "type" => (new TypeService())->findById($data["idServiceType"]) ?? null,
                    "candidate" => (new WorkerPhone())->findById($idWoker) ?? null
                ]);

                $json["html"] = $html;
                $json["erro"] = false;
                echo json_encode($json);
                return;

            }
        }

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

                // Atualização
                if(isset($idWoker)) {
                    $woker->id_worker = $idWoker;
                    $woker->id_user_update = $this->user->id_user;
                    $woker->name_worker = $dataClean["nome"];
                    $woker->date_birth_worker = $dataClean["date-birth-worker"];
                    $woker->cpf_worker = $dataClean["cpf"];
                    $woker->pcd_worker = $dataClean["pcd"];
                    $woker->gender_worker = $dataClean["gender"];
                    $woker->ethnicity_worker = $dataClean["gender"];
                    $woker->contact_ddd_work = $dataClean["contact-ddd-work"];
                    $woker->contact_work = $dataClean["contact-work"];
                    $woker->apprentice_worker = $dataClean["apprentice"];
                    $woker->cterc = $dataClean["cterc"];
                    $woker->status_work = "Atendimento Realizado";
                    $woker->save();

                    $service = (new Service());
                    $service->id_worker = $idWoker;
                    $service->id_user_register = $this->user->id_user;
                    $service->id_type_service = $data["idServiceType"];
                    $service->detail = $data["observation"];
                    $service->save();

                // Cadastro
                } else {
                    $woker->id_user_register = $this->user->id_user;
                    $woker->name_worker = $dataClean["nome"];
                    $woker->date_birth_worker = $dataClean["date-birth-worker"];
                    $woker->cpf_worker = $dataClean["cpf"];
                    $woker->pcd_worker = $dataClean["pcd"];
                    $woker->gender_worker = $dataClean["gender"];
                    $woker->contact_ddd_work = $dataClean["contact-ddd-work"];
                    $woker->contact_work = $dataClean["contact-work"];
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

                // Encaminhamento para entrevista, -- obs --> Esse código deve ser executado antes de enviar os dados para o banco de dados.
                if(isset($data["idServiceType"]) && in_array($data["idServiceType"], ["4", "56"])) {

                    $idVacancy = (int)$data["occupation-id-vacancy"];
                    $vacancyCheck = (new VacancyWorker())->checkVacancyQuantity($idVacancy, $this->user->id_user);
                    
                    if(!$vacancyCheck) {
                        $json["message"] = messageHelpers()->warning("Encaminhamentos já preenchidos para essa vaga.")->render();
                        echo json_encode($json);
                        return;
                    }  
                }


                $serviceRetorn = (new TypeService())->findById($data["idServiceType"]);

                if ($serviceRetorn->group_type === "Telefone") {
                    $group = 16;
                }

                if ($serviceRetorn->group_type === "Atendimento Presencial") {
                    $group = 1;
                }

            $dataClean = $dataArray["data"];
            $woker = (new Worker());

            if(isset($data["idWorker"])) {
                $idWoker = $data["idWorker"];
                // Testar atualização
                // $wokerEdit = (new WorkerEdit());
                // $wokerEdit->id_worker = $idWoker;
                // $wokerEdit->status_work = "Atendimento Realizado";
                // $wokerEdit->save();

                if (in_array($data["idServiceType"], ["4", "56"])) {
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

                if(in_array($data["idServiceType"], ["4", "56"])) {
                    $vacancyToWorker = (new VacancyWorker())->addVacancyToWoker($dataClean, $service->id_service, $this->user->id_user);
                }

            } else {
                $woker->id_user_register = $this->user->id_user;
                $woker->name_worker = $dataClean["nome"];
                $woker->date_birth_worker = $dataClean["date-birth-worker"];
                $woker->cpf_worker = $dataClean["cpf"];
                $woker->pcd_worker = $dataClean["pcd"];
                $woker->gender_worker = $dataClean["gender"];
                $woker->contact_ddd_work = $dataClean["contact-ddd-work"];
                $woker->contact_work = $dataClean["contact-work"];
                $woker->ethnicity_worker = "rosa";
                $woker->apprentice_worker = $dataClean["apprentice"];
                $woker->cterc = $dataClean["cterc"];
                $woker->status_work = "Atendimento Realizado";

                    if(in_array($data["idServiceType"], ["4", "56"])) {
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

                if(in_array($data["idServiceType"], ["4", "56"])) {
                    $vacancyToWorker = (new VacancyWorker())->addVacancyToWoker($dataClean, $service->id_service, $this->user->id_user, $idWoker);
                }

                $serviceAddWork = (new Service());
                $serviceAddWork->id_worker = $idWoker;
                $serviceAddWork->id_user_register = $this->user->id_user;
                $serviceAddWork->id_type_service = $group;
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
            "url" => $url ?? null,
            "idServiceType" => $data["idServiceType"] ?? null,
            "idInterview" => $data["interview"] ?? null,
            "typeService" => $data["typeservice"] ?? null
        ]);        
    }

    public function listSelectEnterprise(array $data) : void
    {   

        $enterprise = (new VwVacancyActive())->find()->fetch(true) ?? [];

        $company = [];
        $ocup = [];

        foreach($enterprise as $enterpriseItem) {
            if(empty($enter[$enterpriseItem->id_enterprise])) {
                $company[] = 
                [
                    "id_enterprise" => $enterpriseItem->id_enterprise,
                    "name_enterprise" => $enterpriseItem->name_enterprise
                ];

                $enter[$enterpriseItem->id_enterprise] = true;
            }
        }
        
        if(isset($data["idcompany"])) {

            $idEnterprise = (int)$data["idcompany"];
            $occupation = (new VwVacancyActive())
                ->find("id_enterprise = :id","id={$idEnterprise}")
                ->order("number_vacancy")
                ->fetch(true);

            foreach($occupation as $occupationItem) {
                $ocup[] = (array)$occupationItem->data();
                
            }

            echo json_encode($ocup);
            return;
        }

        echo json_encode($company);
        return;
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
                "worker" => $worker->fetch(),
                "titleForm" => $titleForm,
                "url" => $url,
                "idServiceType" => $idServiceType ?? null,
                "idInterview" => $idServiceType ?? null,
                "typeService" => $data["idServiceType"] ?? null
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
