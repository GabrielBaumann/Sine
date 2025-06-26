<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\Service;
use Source\Models\SystemUser;
use Source\Models\VacancyWorker;
use Source\Models\Views\VwService;
use Source\Models\Worker;
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
            "worker" => (new Worker())->find()->order("name_worker")->limit($pager->limit())->offset($pager->offset())->fetch(true),
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
        $idWorker = $data["idWorker"];

        $count = (new Service())->where("service.id_worker","=",$idWorker)->join('worker', 'service.id_worker = worker.id_worker');
        $page = (!empty($data["page"]) && filter_var($data["page"], FILTER_VALIDATE_INT) >= 1 ? $data["page"] : 1);
        $pager = new Pager(url("/inicio/p/"));
        $pager->pager($count->countJoin(), 7, $page);
        $totHistory = $count->countJoin();

        $vwService = new VwService();
        $data = $vwService->find("id_worker = :id", "id={$idWorker}")->fetch(true);

        $html = $this->view->render("/pageWorker/historyService", [
            "worker" => (new Worker())->findById($idWorker),
            "history" => $data,
            "countService" => $totHistory,
            "paginator" => $pager->render()
        ]);

        $json["html"] = $html;
        $json["content"] = "content";
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
        if(isset($data["typeService"])) {

            $vacancy = (new VacancyWorker())->updateOfWorkerVacancy($data, $this->user->id_user);

            if(!$vacancy) {
                $json["message"] = messageHelpers()->warning("Erro não esperado, tente novamente!")->render();
                echo json_encode($json);
                return;
            }

            // $data = $vwService->find("id_worker = :id", "id={$idWorker}")->fetch(true);

            // $html = $this->view->render("/pageWorker/historyService", [
            //     "worker" => (new Worker())->findById($idWorker),
            //     "history" => $data,
            //     "countService" => $totHistory,
            //     "paginator" => $pager->render()
            // ]);

            $json["contentajax"] = "content"; //id do elemento html que vai receber o counteúdo do ajax
            $json["html"] = $html;
            echo json_encode($json);
            return;
        }

        $idService = (int)filter_var($data["idService"], FILTER_SANITIZE_NUMBER_INT);
        
        $vwService = new VwService();
        $data = $vwService->find("id_service = :id", "id={$idService}")->fetch();

        $html = $this->view->render("pageWorker/service", [
            "service" => $data
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

}
