<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\Service;
use Source\Models\SystemUser;
use Source\Models\TypeService;
use Source\Models\VacancyWorker;
use Source\Models\Views\VwService;
use Source\Models\Worker;
use Source\Models\WorkerEdit;
use Source\Support\Pager;

class AppWorker extends Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_APP . "/");
    
        if (!$this->user = Auth::user()) {
            $this->message->warning("Efetue login para acessar o sistema!")->flash();
            redirect("/");
        }
    }

    public function startWorker(?array $data) : void
    {   
        
        if(isset($data["name-search"]) || isset($data["search-all-status"])) {

            $nameSearch = isset($data["name-search"]) ? filter_var($data["name-search"], FILTER_SANITIZE_SPECIAL_CHARS) : null;
            $statusSearch = isset($data["search-all-status"]) ? filter_var($data["search-all-status"], FILTER_SANITIZE_SPECIAL_CHARS) : null;

            $conditions = [];
            $params = [];
            
            if(!empty($statusSearch)) {
                $conditions[] = "status_work = :w";
                $params["w"] = $statusSearch;
            }

            if(!empty($nameSearch)) {
                $conditions[] = "name_worker LIKE :n OR cpf_worker LIKE :n";
                $params["n"] = "%{$nameSearch}%";
            }

            $where = implode(" AND ", $conditions);

            $worker = (new Worker())->find($where, http_build_query($params))->order("name_worker")->limit(10)->fetch(true);
            $countWorker = (new Worker())->find($where, http_build_query($params))->count();

            $pager = new Pager(url("/listatrabalhador/p/"));
            $pager->pager($countWorker, 10, 1);

            $html = $this->view->render("pageWorker/listWorkes", [
                "countWorker" => $countWorker,
                "workers" => $worker,
                "paginator" => $pager->render()
            ]);

            $json["html"] = $html;
            echo json_encode($json);
            return;
        }

        $worker = (new Worker())->find()->count();
        $pager = new Pager(url("/listatrabalhador/p/"));
        $pager->pager($worker, 10, 1);

        echo $this->view->render("/pageWorker", [
            "title" => "Trabalhador",
            "countWorker" => $worker,
            "worker" => (new Worker())
                ->find()
                ->order("name_worker")
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->fetch(true),
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "paginator" => $pager->render()
        ]);  
    }

    public function listtWorker() : void
    {
        $worker = (new Worker())->find()->count();
        $pager = new Pager(url("/listatrabalhador/p/"));
        $pager->pager($worker, 10, 1);

        $html = $this->view->render("pageWorker/componentCompleteWorker", [
            "countWorker" => $worker,
            "worker" => (new Worker())->find()
                ->order("name_worker")
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->fetch(true),
            "paginator" => $pager->render()
        ]);

        $json["html"] = $html;
        $json["content"] = "listWorkes";
        echo json_encode($json);
        return;
    }
    
    public function startHistory(?array $data) : void
    {
        $idWorker = (int)filter_var(fncDecrypt($data["idWorker"]), FILTER_VALIDATE_INT);
        $vWService = (new VwService())->find("id_worker = :id", "id={$idWorker}")->fetch(true);
        $pager = new Pager(url("/historicotrabalhador/p/{$idWorker}/"));
        $pager->pager(count($vWService ?? []), 7, 1);

        $html = $this->view->render("/pageWorker/historyService", [
            "worker" => (new Worker())->findById($idWorker),
            "history" => (new VwService())
                ->find("id_worker = :id", "id={$idWorker}")
                ->order("date_register", "DESC")
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->fetch(true),
            "countService" => count($vWService ?? []),
            "typeService" => (new TypeService())->find("group_type = :g","g=Atendimento Presencial")->fetch(true),
            "paginator" => $pager->render()
        ]);

        $json["html"] = $html;
        $json["content"] = "content";
        echo json_encode($json);
        return;
    }

    public function searchService(?array $data) : void
    {
        $idWorker = filter_var($data["idWorker"], FILTER_VALIDATE_INT);

        $conditions = [];
        $params = [];

        $conditions[] = "id_worker = :id";
        $params["id"] = $idWorker; 

        $page = 1;

        // Pesquisar por serviço do atendimento
        if(isset($data["search-enterprise"])) {
            $searchEnterprise = filter_var($data["search-enterprise"], FILTER_SANITIZE_SPECIAL_CHARS) ? filter_var($data["search-enterprise"], FILTER_SANITIZE_SPECIAL_CHARS) : null ;
            if(!empty($searchEnterprise)) {
                $conditions[] = "type_service = :ty";
                $params["ty"] = $searchEnterprise; 
            }
        }

        // Pesquisa por servico e número de pagina
        if(isset($data["page"]) && !empty($data["page"]) || isset($data["search-enterprise"])) {
            $page = (!empty($data["page"]) && filter_var($data["page"], FILTER_VALIDATE_INT) >= 1 ? $data["page"] : 1);
            $searchEnterprise = filter_input(INPUT_GET, "search-enterprise", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "search-enterprise", FILTER_SANITIZE_SPECIAL_CHARS) : null;
            if(!empty($searchEnterprise)) {
                $conditions[] = "type_service = :ty";
                $params["ty"] = $searchEnterprise; 
            }
        }

        $where = implode(" AND ", $conditions);

        $vWService = (new VwService())->find($where, http_build_query($params))->fetch(true);
        $pager = new Pager(url("/historicotrabalhador/p/{$idWorker}/"));
        $pager->pager(count($vWService ?? []), 7, $page);

        $html = $this->view->render("/pageWorker/listHistoryService", [
            "worker" => (new Worker())->findById($idWorker),
            "history" => (new VwService())
                ->find($where, http_build_query($params))
                ->order("date_register", "DESC")
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->fetch(true),
            "countService" => count($vWService ?? []),
            "paginator" => $pager->render()
        ]);

        $json["html"] = $html;
        $json["content"] = "content-history";
        echo json_encode($json);
        return;
    }

    public function startPagePaginator(array $data) : void
    {   
        if (isset($data["page"]) && !empty($data["page"])) {
           
            $nameSearch = filter_input(INPUT_GET, "name-search", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "name-search", FILTER_SANITIZE_SPECIAL_CHARS) : null;
            $statusSearch = filter_input(INPUT_GET, "search-all-status", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "search-all-status", FILTER_SANITIZE_SPECIAL_CHARS) : null;

            $conditions = [];
            $params = [];
            
            if(!empty($statusSearch)) {
                $conditions[] = "status_work = :w";
                $params["w"] = $statusSearch;
            }

            if(!empty($nameSearch)) {
                $conditions[] = "name_worker LIKE :n OR cpf_worker LIKE :n";
                $params["n"] = "%{$nameSearch}%";
            }

            $where = implode(" AND ", $conditions);

            $worker = (new Worker())->find($where, http_build_query($params))
                ->order("name_worker")
                ->fetch(true);

            $countWorker = (count($worker ?? []));

            $page = (!empty($data["page"]) && filter_var($data["page"], FILTER_VALIDATE_INT) >= 1 ? $data["page"] : 1);
            $pager = new Pager(url("/listatrabalhador/p/"));
            $pager->pager($countWorker, 10, $page);
            
            $html = $this->view->render("pageWorker/listWorkes", [
                "countWorker" => $countWorker,
                "workers" => (new Worker())->find($where, http_build_query($params))
                    ->order("name_worker")
                    ->limit($pager->limit())
                    ->offset($pager->offset())
                    ->fetch(true),
                "paginator" => $pager->render()
            ]);

            $json["html"] = $html;
            $json["content"] = "listWorkes";
            echo json_encode($json);
            return;
        }
    }

    public function serviceOfWorker(?array $data)
    {   
        // Exluir atendimentos
        if(isset($data["typeService"]) && $data["typeService"] === "atendimentosexcluir" ) {
            $idService = (int)filter_var($data["id-service"], FILTER_SANITIZE_NUMBER_INT);
            $service = (new Service())->findById($idService);
            $service->destroy();

            if(!$service) {
                $json["message"] = messageHelpers()->warning("Erro não esperado, tente novamente!")->render();
                $json["complete"] = false;
                echo json_encode($json);
                return;
            }

            $idWorker = (int)filter_var($data["id-worker"], FILTER_SANITIZE_NUMBER_INT);

            $data = (new VwService())->find("id_worker = :id", "id={$idWorker}")->fetch(true);

            $pager = new Pager(url("/historicotrabalhador/p/{$idWorker}/"));
            $pager->pager(count($data ?? []), 7, 1);

            $html = $this->view->render("/pageWorker/historyService", [
                "worker" => (new Worker())->findById($idWorker),
                "history" => (new VwService())->find("id_worker = :id", "id={$idWorker}")
                    ->order("date_register", "DESC")
                    ->limit($pager->limit())
                    ->offset($pager->offset())
                    ->fetch(true),
                "typeService" => (new TypeService())->find("group_type = :g","g=Atendimento Presencial")->fetch(true),
                "countService" => count($data ?? []),
                "paginator" => $pager->render()
            ]);

            $json["html"] = $html;
            $json["message"] = messageHelpers()->success("Registro excluído com sucesso!")->render();
            $json["contentajax"] = "content"; //id do elemento html que vai receber o counteúdo do ajax
            echo json_encode($json);

            return;
        }   

        $idService = (int)filter_var($data["idService"], FILTER_SANITIZE_NUMBER_INT);
        
        $vwService = new VwService();
        $data = $vwService->find("id_service = :id", "id={$idService}")->fetch();

        $html = $this->view->render("pageWorker/service", [
            "service" => $data,
            "userSystem" => $this->user
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

    // Confirmar exclusão de entrevista para vaga e reativar a vaga
    public function confirmedDeleteInterviewToWork(array $data) : void
    {
        $editWorker = new WorkerEdit();
        $deleteService = $editWorker->destroyToServiceVacancy($data, $this->user->id_user, true);

        $idWorker = (int)filter_var(fncDecrypt($data["id-worker"]), FILTER_SANITIZE_NUMBER_INT);
        $dataCount = (new VwService())->find("id_worker = :id", "id={$idWorker}")->fetch(true);
        
        $pager = new Pager(url("/historicotrabalhador/p/{$idWorker}/"));
        $pager->pager(count($dataCount ?? []), 7, 1);

        $html = $this->view->render("/pageWorker/historyService", [
            "worker" => (new Worker())->findById($idWorker),
            "history" => (new VwService())->find("id_worker = :id", "id={$idWorker}")
                ->order("date_register", "DESC")
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->fetch(true),
                "typeService" => (new TypeService())->find("group_type = :g","g=Atendimento Presencial")->fetch(true),
            "countService" => count($data ?? []),
            "paginator" => $pager->render()
        ]);

        $json["html"] = $html;
        $json["message"] = messageHelpers()->success("Registro excluído com sucesso!")->render();
        $json["contentajax"] = "content"; //id do elemento html que vai receber o counteúdo do ajax
        echo json_encode($json);

    }
    
    // Confirmar exclusão de entrevista e não reativar a vaga
    public function confirmedDeleteInterviewToWorkNot(array $data) : void
    {
        $editWorker = new WorkerEdit();
        $deleteService = $editWorker->destroyToServiceVacancy($data, $this->user->id_user);

        $idWorker = (int)filter_var(fncDecrypt($data["id-worker"]), FILTER_SANITIZE_NUMBER_INT);

        $data = (new VwService())->find("id_worker = :id", "id={$idWorker}")->fetch(true);

        $pager = new Pager(url("/historicotrabalhador/p/{$idWorker}/"));
        $pager->pager(count($data ?? []), 7, 1);

        $html = $this->view->render("/pageWorker/historyService", [
            "worker" => (new Worker())->findById($idWorker),
            "history" => (new VwService())->find("id_worker = :id", "id={$idWorker}")
                ->order("date_register", "DESC")
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->fetch(true),
                "typeService" => (new TypeService())->find("group_type = :g","g=Atendimento Presencial")->fetch(true),
            "countService" => count($data ?? []),
            "paginator" => $pager->render()
        ]);

        $json["html"] = $html;
        $json["message"] = messageHelpers()->success("Registro excluído com sucesso!")->render();
        $json["contentajax"] = "content"; //id do elemento html que vai receber o counteúdo do ajax
        echo json_encode($json);
    }

    // Finalizar encaminhamento de entrevista
    public function finishInterviewToWork(array $data) : void
    {
        // finalizar a entrevista com aprovado ou reprovado
        if(!empty($data["csrf"])){

            if(!csrf_verify($data)) {
                $json["message"] = messageHelpers()->warning("Erro ao enviar! Atualize a página e tente novamente.")->render();
                $json["erro"] = true;
                echo json_encode($json);
                return;
            }

            // Verifica se o botão pressionado foi o de deletar
            if(isset($data["actionbtn"]) && $data["actionbtn"] === "delete") {
                $destroyService = (new WorkerEdit());

                // Caso todas as vagas estejam encerradas
                if(!$destroyService->checkdVacancyStatus(fncDecrypt($data["id-vacancy"]))) {

                    $html = $this->view->render("/pageWorker/modalYesNo", [
                        "data" => $data
                    ]);
                    
                    $json["html"] = $html;
                    $json["modal"] = true;
                    $json["contentajax"] = "content";
                    echo json_encode($json);
                    return;
                }

                // Exlui a entrevista e reativa a vaga (caso não tenha encerrado todas as vagas)
                $destroyService->destroyToServiceVacancy($data, $this->user->id_user);
                $json["message"] = messageHelpers()->success("Registro excluído com sucesso!")->flash();

                $idWorker = (int)filter_var(fncDecrypt($data["id-worker"]), FILTER_VALIDATE_INT);
                $vWService = (new VwService())->find("id_worker = :id", "id={$idWorker}")->fetch(true);
                $pager = new Pager(url("/historicotrabalhador/p/{$idWorker}/"));
                $pager->pager(count($vWService ?? []), 7, 1);

                $html = $this->view->render("/pageWorker/historyService", [
                    "worker" => (new Worker())->findById($idWorker),
                    "history" => (new VwService())
                        ->find("id_worker = :id", "id={$idWorker}")
                        ->order("date_register", "DESC")
                        ->limit($pager->limit())
                        ->offset($pager->offset())
                        ->fetch(true),
                    "countService" => count($vWService ?? []),
                    "typeService" => (new TypeService())->find("group_type = :g","g=Atendimento Presencial")->fetch(true),
                    "paginator" => $pager->render()
                ]);

                $json["html"] = $html;
                $json["contentajax"] = "content";
                echo json_encode($json);
                return;
            }

            // Finaliza a entrevista com a resposta ou não do empregador

            $sanitizeData = cleanInputData($data, ["detail-response-company"]);

            if(!$sanitizeData["valid"]) {
                $json["message"] = messageHelpers()->warning("Preencha o campo obrigatório!")->render();
                $json["complete"] = false;
                echo json_encode($json);
                return;
            }
            
            $vacancy = (new VacancyWorker())->updateOfWorkerVacancy($data, $this->user->id_user);

            if(!$vacancy) {
                $json["message"] = messageHelpers()->warning("Erro não esperado, tente novamente!")->render();
                $json["complete"] = false;
                echo json_encode($json);
                return;
            }

            $idWorker = (int)filter_var(fncDecrypt($data["id-worker"]), FILTER_SANITIZE_NUMBER_INT);

            $dataCount = (new VwService())->find("id_worker = :id", "id={$idWorker}")->fetch(true);

            $pager = new Pager(url("/historicotrabalhador/p/{$idWorker}/"));
            $pager->pager(count($dataCount), 7, 1);

            $html = $this->view->render("/pageWorker/historyService", [
                "worker" => (new Worker())->findById($idWorker),
                "history" => (new VwService())->find("id_worker = :id", "id={$idWorker}")
                    ->order("date_register", "DESC")
                    ->limit($pager->limit())
                    ->offset($pager->offset())
                    ->fetch(true),
                "countService" => count($data),
                "typeService" => (new TypeService())->find("group_type = :g","g=Atendimento Presencial")->fetch(true),
                "paginator" => $pager->render()
            ]);

            $json["html"] = $html;
            $json["message"] = messageHelpers()->success("Registro salvo com sucesso!")->render();
            $json["contentajax"] = "content"; //id do elemento html que vai receber o counteúdo do ajax
            echo json_encode($json);
            return;
        }
    }
}
