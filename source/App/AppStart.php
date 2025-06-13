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
        // Gráfico de atendimentos
        $serve = new Service();
        $charServer = $serve->charService();

        // Gráfico de status dos trabalhadores
        $worker = new Worker();
        $chartWorker = $worker->chartWorker();

        // Gráfico de status das vagas
        $vacancy = new Vacancy();
        $charVacancy = $vacancy->chartVacancy();

        // Gráfico de vagas por gênero
        $vacancyGender = new Vacancy();
        $chartVacancyGender = $vacancyGender->chartVacancyGender();

        echo $this->view->render("/pageStart", [
            "title" => "Início",
            "workerCount" => (new Worker())->find()->count(),
            "vavancysCount" => (new Vacancy())->find("id_vacancy_fixed <> :id", "id=0")->count(),
            "enterprisesCount" => (new Enterprise())->find()->count(),
            "serviceCount" => (new Service())->find()->count(),
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "chartServiceLabel" => $charServer["label"],
            "chartServiceTotal" => $charServer["total"],
            "chartWorkerLabel" => $chartWorker["label"],
            "chartWorkerTotal" => $chartWorker["total"],
            "chartVacancyLabel" => $charVacancy["label"],
            "chartVacancyTotal" => $charVacancy["total"],
            "chartVacancyGenderLabel" => $chartVacancyGender["label"],
            "chartVacancyGenderTotal" => $chartVacancyGender["total"]
        ]);
    }
}