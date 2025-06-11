<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\Enterprise;
use Source\Models\Service;
use Source\Models\Vacancy;
use Source\Models\Worker;
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

        // $service = (new Service())->findAll(
        //     "(SELECT YEAR(data_register) as y, MONTH(data_register) as m, COUNT(*) AS total
        //     FROM service
        //     GROUP BY y, m
        //     ORDER BY y, m)"
        // )->fetch(true);

        // var_dump($service);

        echo $this->view->render("/pageStart", [
            "title" => "Início",
            "workerCount" => (new Worker())->find()->count(),
            "cavancysCount" => (new Vacancy())->find()->count(),
            "enterprisesCount" => (new Enterprise())->find()->count(),
            "serviceCount" => (new Service())->find()->count(),
            "userSystem" => (new SystemUser())->findById($this->user->id_user)
        ]);    
    }
}