<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\Service;
use Source\Models\SystemUser;
use Source\Models\TypeService;
use Source\Models\Views\VwServicePhone;
use Source\Support\Message;
use Source\Support\Pager;

class AppWorkerPhone extends Controller
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

    // Página inicial e pesquisa por nome e status
    public function pagePhone(?array $data) : void
    {
        if(isset($data["name-search"]) || isset($data["search-all-status"])) {

            $nameSearch = isset($data["name-search"]) ? filter_var($data["name-search"], FILTER_SANITIZE_SPECIAL_CHARS) : null;
            $statusSearch = isset($data["search-all-status"]) ? filter_var($data["search-all-status"], FILTER_SANITIZE_SPECIAL_CHARS) : null;

            $conditions = [];
            $params = [];
            
            if(!empty($statusSearch)) {
                $conditions[] = "type_service = :w";
                $params["w"] = $statusSearch;
            }

            if(!empty($nameSearch)) {
                $conditions[] = "name_work_phone LIKE :n";
                $params["n"] = "%{$nameSearch}%";
            }

            $where = implode(" AND ", $conditions);

            $worker = (new VwServicePhone())->find($where, http_build_query($params))->order("name_work_phone")->limit(14)->fetch(true);
            $countWorker = (new VwServicePhone())->find($where, http_build_query($params))->count();

            $pager = new Pager(url("/pesquisatrabalhadortelefone/p/"));
            $pager->pager($countWorker, 14, 1);

            $html = $this->view->render("pageWorkerPhone/listWorkesPhone", [
                "countWorker" => $countWorker,
                "worksPhone" => $worker,
                "paginator" => $pager->render()
            ]);

            $json["html"] = $html;
            echo json_encode($json);
            return;
        }

        $workerPhone = (new VwServicePhone())->find()->count();
        $pager = new Pager(url("/pesquisatrabalhadortelefone/p/"));
        $pager->pager($workerPhone, 14, 1);
        $countWorker = (new VwServicePhone())->find()->count();

        echo $this->view->render("/pageWorkerPhone/pageServicePhone", [
            "title" => "Atendimento",
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "worksPhone" => (new VwServicePhone())
                ->find()
                ->order("name_work_phone")
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->fetch(true),
            "typeService" => (new TypeService())->find("group_type = :g","g=Atendimento Presencial")->fetch(true),
            "countWorker" => $countWorker,
            "paginator" => $pager->render()
        ]);    
    }

    // Pesquisar por nome e status com númerações de pagina
    public function startPagePaginator(array $data) : void
    {
        if (isset($data["page"]) && !empty($data["page"])) {
           
            $nameSearch = filter_input(INPUT_GET, "name-search", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "name-search", FILTER_SANITIZE_SPECIAL_CHARS) : null;
            $statusSearch = filter_input(INPUT_GET, "search-all-status", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "search-all-status", FILTER_SANITIZE_SPECIAL_CHARS) : null;

            $conditions = [];
            $params = [];
            
            if(!empty($statusSearch)) {
                $conditions[] = "type_service = :w";
                $params["w"] = $statusSearch;
            }

            if(!empty($nameSearch)) {
                $conditions[] = "name_work_phone LIKE :n";
                $params["n"] = "%{$nameSearch}%";
            }

            $where = implode(" AND ", $conditions);

            $worker = (new VwServicePhone())->find($where, http_build_query($params))
                ->order("name_work_phone")
                ->fetch(true);

            $countWorker = (count($worker ?? []));

            $page = (!empty($data["page"]) && filter_var($data["page"], FILTER_VALIDATE_INT) >= 1 ? $data["page"] : 1);
            $pager = new Pager(url("/pesquisatrabalhadortelefone/p/"));
            $pager->pager($countWorker, 14, $page);
            
            $html = $this->view->render("/pageWorkerPhone/listWorkesPhone", [
                "countWorker" => $countWorker,
                "worksPhone" => (new VwServicePhone())->find($where, http_build_query($params))
                    ->order("name_work_phone")
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

    // Editar formulário de atendimento
    public function editService(?array $data) : void
    {
        $sericePhone = (new VwServicePhone())->findById($data["idservice"]);

        $html = $this->view->render("/pageWorkerPhone/servicePhone", [
            "title" => "Atendimento",
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "servicePhone" => $sericePhone
        ]);

        $json["html"] = $html;
        $json["content"] = "listWorkes";
        echo json_encode($json);
        return;
    }

    // Voltar página para o início
    public function backWorker() : void
    {
        $workerPhone = (new VwServicePhone())->find()->count();
        $pager = new Pager(url("/pesquisatrabalhadortelefone/p/"));
        $pager->pager($workerPhone, 14, 1);
        $countWorker = (new VwServicePhone())->find()->count();

        $html = $this->view->render("/pageWorkerPhone/componentCompleteWorkerPhone", [
            "title" => "Atendimento",
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "worksPhone" => (new VwServicePhone())
                ->find()
                ->order("name_work_phone")
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->fetch(true),
            "typeService" => (new TypeService())->find("group_type = :g","g=Atendimento Presencial")->fetch(true),
            "countWorker" => $countWorker,
            "paginator" => $pager->render()
        ]);
    
        $json["html"] = $html;
        $json["content"] = "listWorkes";
        echo json_encode($json);
        return;
    }

    // Exlcuir atendimento por telefone
    public function deleteServicePhone(array $data) : void
    {
        if(!empty($data["csrf"])){
            
            if(!csrf_verify($data)) {
                $json["message"] = messageHelpers()->warning("Erro ao enivar! Atualize a página e tente novamente.")->render();
                $json["erro"] = true;
                echo json_encode($json);
                return;
            }

            $service = (new Service())->find("id_worker = :w AND id_type_service = :t","w={$data["id-worker"]}&t={$data["id-type-service"]}")->fetch();
            $service->destroy();

            if($service) {
                $json["message"] = messageHelpers()->success("Registro excluído com sucesso!")->flash();
                $json["redirect"] = url("/trabalhadortelefone");
                echo json_encode($json);
                return;
            }

        }
    }

    public function logout()
    {
        (new Message())->success("Você saiu com sucesso " . Auth::user()->nome . ". Volte logo :)")->flash();    
        
        Auth::logout();
        redirect("/");
    }
}
