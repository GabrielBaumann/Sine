<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\Enterprise;
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

    public function startHistory(?array $data) : void
    {
        var_dump($data);
        echo $this->view->render("/pageStart/historyService", [
            "title" => "Histórico de atendimento"
        ]);

        // $json["html"] = $html;
        // echo json_encode($json);
        // return;
    }

}