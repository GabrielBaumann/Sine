<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\CboOccupation;
use Source\Models\Enterprise;
use Source\Models\SystemUser;
use Source\Models\Vacancy;
use Source\Models\VacancyWorker;
use Source\Models\Views\VwVacancy;
use Source\Support\Pager;

class AppVacancy extends Controller
{
    protected $user;

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" .CONF_VIEW_APP . "/");
        
        if (!$this->user = Auth::user()) {
            $this->message->warning("")->flash();
            redirect("/");
        }

        $normalizeWorker = (new VacancyWorker())->normalizeWorkerVacancy();
    }

    public function startVacancy(?array $data) : void
    {   

        if(isset($data["page"]) && !empty($data["page"])) {

            $searchVacancy = filter_input(INPUT_GET, "search-vacancy", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "search-vacancy", FILTER_SANITIZE_SPECIAL_CHARS) : null;
            $searchEnterprise = filter_input(INPUT_GET, "search-enterprise", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "search-enterprise", FILTER_SANITIZE_SPECIAL_CHARS) : null;
            $searchStatus = filter_input(INPUT_GET, "search-status", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "search-status", FILTER_SANITIZE_SPECIAL_CHARS) : null;

            $conditions = [];   
            $params = [];

            if(!empty($searchEnterprise)) {
                $conditions[] = "id_enterprise = :in";
                $params["in"] = $searchEnterprise; 
            }

            if(!empty($searchVacancy)) {
                $conditions[] = "nomeclatura_vacancy LIKE :n";
                $params["n"] = "%{$searchVacancy}%";
            }

            if(!empty($searchStatus)) {
                $conditions[] = "status_vacancy = :s";
                $params["s"] = $searchStatus;
            }

            $where = implode(" AND ", $conditions);

            $vacancy = (new VwVacancy())
                ->find($where, http_build_query($params))
                ->order("nomeclatura_vacancy")
                ->fetch(true);

            $vacancyCount = count($vacancy ?? []);

            $page = (!empty($data["page"]) && filter_var($data["page"], FILTER_VALIDATE_INT) >= 1 ? $data["page"] : 1);
            $pager = new Pager(url("/pesquisarvagas/p/"));
            $pager->Pager($vacancyCount, 10, $page);

            $html = $this->view->render("/pageVacancy/componentListVacancy", [
                "totalVacancy" => (new VwVacancy())
                    ->find($where, http_build_query($params))
                    ->limit($pager->limit())
                    ->offset($pager->offset())
                    ->order("nomeclatura_vacancy", "DESC")->fetch(true),
                "countVacancy"=> $vacancyCount,
                "listEnterprise" => (new Vacancy())->listEnterpriseVacancy(),
                "paginator" => $pager->render()
            ]);   

            $json["html"] = $html;
            $json["content"] = "listVacancy";
            echo json_encode($json);
            return;
        }

        $vacancyCount = (new VwVacancy())->find()->count(); 
        $pager = new Pager(url("/pesquisarvagas/p/"));
        $pager->Pager($vacancyCount, 10, 1);

        echo $this->view->render("/pageVacancy", [
            "title" => "Vagas",
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "totalVacancy" => (new VwVacancy())
                ->find()                
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("nomeclatura_vacancy", "DESC")->fetch(true),
            "countVacancy"=> $vacancyCount,
            "listEnterprise" => (new Vacancy())->listEnterpriseVacancy(),
            "paginator" => $pager->render()
        ]);
    }

    public function listVacancy(?array $data) : void
    {   
        if(isset($data["search-vacancy"]) || isset($data["search-enterprise"]) || isset($data["search-status"])) {
            
            $searchVacancy = isset($data["search-vacancy"]) ? filter_var($data["search-vacancy"], FILTER_SANITIZE_SPECIAL_CHARS) : null;
            $searchEnterprise = isset($data["search-enterprise"]) ? filter_var($data["search-enterprise"], FILTER_SANITIZE_SPECIAL_CHARS) : null;
            $searchStatus = isset($data["search-status"]) ? filter_var($data["search-status"], FILTER_SANITIZE_SPECIAL_CHARS) : null;

            $conditions = [];   
            $params = [];

            if(!empty($searchEnterprise)) {
                $conditions[] = "id_enterprise = :in";
                $params["in"] = $searchEnterprise; 
            }

            if(!empty($searchVacancy)) {
                $conditions[] = "nomeclatura_vacancy LIKE :n";
                $params["n"] = "%{$searchVacancy}%";
            }

            if(!empty($searchStatus)) {
                $conditions[] = "status_vacancy = :s";
                $params["s"] = $searchStatus;
            }

            $where = implode(" AND ", $conditions);

            $vacancy = (new VwVacancy())
                ->find($where, http_build_query($params))
                ->order("nomeclatura_vacancy")
                ->fetch(true);

            $vacancyCount = count($vacancy ?? []);

            $pager = new Pager(url("/pesquisarvagas/p/"));
            $pager->Pager($vacancyCount, 10, 1);

            $html = $this->view->render("/pageVacancy/componentListVacancy", [
                "totalVacancy" => (new VwVacancy())
                    ->find($where, http_build_query($params))
                    ->order("nomeclatura_vacancy")
                    ->limit($pager->limit())
                    ->offset($pager->offset())
                    ->fetch(true),
                "countVacancy" => $vacancyCount,
                "paginator" => $pager->render()
            ]);

            $json["html"] = $html;
            echo json_encode($json);     
            return;
        }

        $vacancyCount = (new VwVacancy())->find()->count(); 
        $pager = new Pager(url("/pesquisarvagas/p/"));
        $pager->Pager($vacancyCount, 10, 1);

        $html = $this->view->render("/pageVacancy/listVacancy", [
            "totalVacancy" => (new VwVacancy())
                ->find()                
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("nomeclatura_vacancy", "DESC")->fetch(true),
            "countVacancy"=> $vacancyCount,
            "listEnterprise" => (new Vacancy())->listEnterpriseVacancy(),
            "paginator" => $pager->render()
        ]);
        
        $json["html"] = $html;
        echo json_encode($json);
        return;        
    }

    public function addVacancy(?array $data) : void
    {

        if(!empty($data["csrf"])) {
         
            if(!csrf_verify($data)) {
                $json["message"] = messageHelpers()->warning("Use o formulário!")->render();
                $json["complete"] = false;
                echo json_encode($json);
                return;
            }

            // Verificar e sanitizar campos obrigatórios e não obrigatórios
            $dataClean = cleanInputData($data, ["description-vacancy", "request-vacancy"]);

            if (!$dataClean["valid"]) {
                $json["message"] = messageHelpers()->warning("Preencha todos os campos obrigatórios!")->render();
                $json["complete"] = false;
                echo json_encode($json);
                return;
            }

            $dataCleanOk = $dataClean["data"];

            if (!isset($data["number-vacancy"]) || !is_numeric($data["number-vacancy"]) || $data["number-vacancy"] < 1 ) {
                $json["message"] = messageHelpers()->warning("Verifique o campo número de vagas!")->render();
                $json["complete"] = false;
                echo json_encode($json);
                return;
            }
            
            if (!isset($data["quantity-per-vacancy"]) || !is_numeric($data["quantity-per-vacancy"]) || $data["quantity-per-vacancy"] < 1 ) {
                $json["message"] = messageHelpers()->warning("Verifique se a quantidades por vaga é válida!")->render();
                $json["complete"] = false;
                echo json_encode($json);
                return;
            }

            // Atualização de vagas
            if(isset($data["idvacancy"]) && !empty($data["idvacancy"])) {
                
                // Caso o usuário tente diminuir a quantidade de vagas, mas já tenha sido vínculados encaminhamentos a ela, impede a ação.
                $checkVacancyWorker = (new VacancyWorker())->checkVacancyWorker($dataCleanOk, true);
                if(!$checkVacancyWorker) {
                    $json["message"] = messageHelpers()->warning("A quantidade de vagas não pode ser menor que a quantidade já vínculada a trabalhadores!")->render();
                    echo json_encode($json);
                    return;
                }

                // Verifica se a quantidade de encaminhamentos por vagas é menor do que a quantidade de ecaminhamentos já solicitados
                $checkWorker = (new VacancyWorker())->checkVacancyWorker($dataCleanOk);
                if(!$checkWorker) {
                    $json["message"] = messageHelpers()->warning("A quantidade por vagas não pode ser menor do que a quantidade já vínculada a trabalhadores")->render();
                    echo json_encode($json);
                    return;
                }

                $updateVacancy = (new Vacancy())->updateVacancy($dataCleanOk["idvacancy"], $dataCleanOk ,$this->user->id_user);

                $json["message"] = messageHelpers()->success("Registro atualizado com sucesso!")->render();
                $json["complete"] = false;
                echo json_encode($json);
                return;
            }

            // Criar vagas
            $vacancy = new Vacancy();
            $createVacancys = $vacancy->createVacancy($dataCleanOk, $this->user->id_user);

            if(!$createVacancys){
                $json["message"] = messageHelpers()->warning("Verifique se o campo Nº de Vagas é válido!")->render();
                $json["complete"] = false;
                echo json_encode($json);
                return;
            }


            
            $json["message"] = messageHelpers()->success("Registro salvo com sucesso!")->render();
            $json["complete"] = true;
            echo json_encode($json);
            return;
        }

        if(isset($data["idvacancy"])) {
            $idVacancy = $data["idvacancy"];
        } else {
            $idVacancy = null;
        }

        $html = $this->view->render("/pageVacancy/formsNewVacancy", [
            "vacancy" => (new Vacancy())
                    ->find("id_vacancy = :id", "id={$idVacancy}")
                    ->fetch(),
            "companys" => (new Enterprise())
                ->find()
                ->order("name_enterprise")
                ->fetch(true),
            "cbos_occupations" => (new CboOccupation())
                ->find()
                ->order("occupation")
                ->fetch(true)
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

    public function infoVacancy(?array $data) : void
    {   
        // Encerrar vagas
        if(isset($data["csrf"])) {

            $vacancyClosed = new Vacancy();
            $idFixed = filter_var($data["id-vacancy-fixed"], FILTER_SANITIZE_NUMBER_INT);

            if(empty($data["reason-closed"])) {
                $json["message"] = messageHelpers()->warning("Preenchao o motivo do encerramento!")->render();
                $json["complete"] = false;
                echo json_encode($json);
                return;
            }

            $count = 0;

            foreach($data as $key => $value) {
                if(str_contains($key, "check-vacancy-")) {
                    $vacancyClosed->closedVacancy((int)$value, (int)$idFixed, $data["reason-closed"]);
                    $count++;
                }                
            }

            $plur = $count > 1 ? "s" : "";

            $json["message"] = messageHelpers()->success("Vaga". $plur ."  encerrada". $plur ." com sucesso!")->render();

            $vacancyList = (new Vacancy())->find("id_vacancy_fixed = :id", "id={$data["id-vacancy-fixed"]}")->fetch(true);
            $vacancyInfo = (new VwVacancy())->find("id_vacancy = :id", "id={$data["id-vacancy-fixed"]}")->fetch();

            $html = $this->view->render("/pageVacancy/componentListInfoVacancy", [
                "vacancyList" => $vacancyList,
                "vacancyInfo" => $vacancyInfo
            ]);

            $json["html"] = $html;
            echo json_encode($json);
            return;
        }

        // Paginar conteúdo
        if(isset($data["page"]) && !empty($data["page"])) {

        $searchStatus = filter_input(INPUT_GET, "search-status", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "search-status", FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $idVacancy = (int)filter_var($data["idvacancy"], FILTER_VALIDATE_INT);

        $conditions = [];
        $params = [];

        if(!empty($searchStatus)) {
            $conditions[] = "status_vacancy = :st";
            $params["st"] = $searchStatus;
        }

        $conditions[] = "id_vacancy_fixed = :id";
        $params["id"] = $idVacancy;

        $where = implode(" AND ", $conditions);

        
        $page = (!empty($data["page"]) && filter_var($data["page"], FILTER_VALIDATE_INT) >= 1 ? $data["page"] : 1);


        $vacancyListCount = count((new Vacancy())
            ->find($where, http_build_query($params))
            ->fetch(true)
            ?? []);
        
        $pager = new Pager(url("/paginarvagas/p/{$idVacancy}/"));
        $pager->Pager($vacancyListCount, 7, $page);
            
        $vacancyInfo = (new VwVacancy())->find("id_vacancy = :id", "id={$idVacancy}")->fetch();

        $html = $this->view->render("/pageVacancy/componentListInfoVacancy", [
            "vacancyList" => (new Vacancy())
                ->find($where, http_build_query($params))
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->fetch(true),
            "vacancyInfo" => $vacancyInfo,
            "countVacancy" => $vacancyListCount,
            "paginator" => $pager->render()
        ]);

        $json["html"] = $html;
        $json["content"] = "list-info-vacancy";
        echo json_encode($json);
        return;
        }

        $idVacancy = (int)filter_var($data["idvacancy"], FILTER_VALIDATE_INT);

        $vacancyListCount = count((new Vacancy())
            ->find("id_vacancy_fixed = :id", "id={$idVacancy}")
            ->fetch(true)
            ?? []);
        
        $pager = new Pager(url("/paginarvagas/p/{$idVacancy}/"));
        $pager->Pager($vacancyListCount, 7, 1);
            
        $vacancyInfo = (new VwVacancy())->find("id_vacancy = :id", "id={$idVacancy}")->fetch();

        $html = $this->view->render("/pageVacancy/infoVacancy", [
            "vacancyList" => (new Vacancy())
                ->find("id_vacancy_fixed = :id", "id={$idVacancy}")
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->fetch(true),
            "vacancyInfo" => $vacancyInfo,
            "countVacancy" => $vacancyListCount,
            "paginator" => $pager->render()
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

    public function searchVacancy(array $data) : void
    {
        $status = filter_var($data["search-status"], FILTER_SANITIZE_SPECIAL_CHARS) ? filter_var($data["search-status"], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $idVacancy = filter_var($data["idvacancy"], FILTER_VALIDATE_INT);

        $conditions = [];
        $params = [];

        if(!empty($status)) {
            $conditions[] = "status_vacancy = :st";
            $params["st"] = $status;
        }

        $conditions[] = "id_vacancy_fixed = :id";
        $params["id"] = $idVacancy;

        $where = implode(" AND ", $conditions);

        
        $page = (!empty($data["page"]) && filter_var($data["page"], FILTER_VALIDATE_INT) >= 1 ? $data["page"] : 1);

        $vacancyListCount = count((new Vacancy())
            ->find($where, http_build_query($params))
            ->fetch(true)
            ?? []);
        
        $pager = new Pager(url("/paginarvagas/p/{$idVacancy}/"));
        $pager->Pager($vacancyListCount, 7, $page);
            
        $vacancyInfo = (new VwVacancy())->find("id_vacancy = :id", "id={$idVacancy}")->fetch();

        $html = $this->view->render("/pageVacancy/componentListInfoVacancy", [
            "vacancyList" => (new Vacancy())
                ->find($where, http_build_query($params))
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->fetch(true),
            "vacancyInfo" => $vacancyInfo,
            "countVacancy" => $vacancyListCount,
            "paginator" => $pager->render()
        ]);

        $json["html"] = $html;
        $json["content"] = "list-info-vacancy";
        echo json_encode($json);
        return;
    }
}
