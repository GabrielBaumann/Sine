<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\Enterprise;
use Source\Models\Service;
use Source\Models\Vacancy;
use Source\Models\Worker;
use Source\Support\Message;
use Source\Models\SystemUser;


class AppStart extends Controller
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

    public function startPage(?array $data) : void
    {   
        if(isset($data["name-search"])) {

            $nameSearch = filter_var($data["name-search"], FILTER_SANITIZE_SPECIAL_CHARS);

            $conditions = [];
            $params = [];

            if(!empty($nameSearch)) {
                $conditions[] = "name_worker LIKE :n OR cpf_worker LIKE :n";
                $params["n"] = "%{$nameSearch}%";
            }

            $where = implode(" AND ", $conditions);

            $worker = (new Worker())->find($where, http_build_query($params))->order("name_worker")->limit(8)->fetch(true);
            
            $html = $this->view->render("pageStart/listWorkes", [
                "workers" => $worker
            ]);

            $json["html"] = $html;
            echo json_encode($json);
            return;
        }

        echo $this->view->render("/pageStart", [
            "title" => "Início",
            "worker" => (new Worker())->find()->order("name_worker")->limit(8)->fetch(true),
            "workerCount" => (new Worker())->find()->count(),
            "cavancysCount" => (new Vacancy())->find()->count(),
            "enterprisesCount" => (new Enterprise())->find()->count(),
            "userSystem" => (new SystemUser())->findById($this->user->id_user)
        ]);    
    }

    public function startHistory(array $data) : void
    {
        
        $idWorker = $data["idWorker"];


        $service = new Service();
        $data = $service->select(
            ['service.*',
            'worker.name_worker AS worker_name',
            'worker.cpf_worker AS worker_cpf',
            'system_user.name_user AS user_name',
            'type_service.group AS group_service',
            'type_service.type_service AS service_type',
            'type_service.detail AS service_detail',
            ])
            ->join('worker', 'service.id_worker = worker.id_worker')
            ->join('system_user', 'service.id_user_register = system_user.id_user')
            ->join('type_service', 'service.id_type_service = type_service.id_type_service')
            ->where("service.id_worker","=",$idWorker)
            ->orderBy("date_register","DESC")
            ->limitJoin(2)
            ->get();


        $html = $this->view->render("/pageStart/historyService", [
            "worker" => (new Worker())->findById($idWorker),
            "history" => $data
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

}