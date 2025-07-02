<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\Enterprise;
use Source\Models\Service;
use Source\Models\Worker;
use Source\Models\SystemUser;
use Source\Models\Views\VwVacancy;
use Source\Support\Pager;

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

    public function startPage() : void
    {   
        // Gráfico de atendimentos
        $serve = new Service();
        $charServer = $serve->charService();

        // Painel de vagas
        $vwVacancy = new VwVacancy();
        $panelVancancy = $vwVacancy->find("total_vacancy_active <> :to","to=0")
            ->order("nomeclatura_vacancy")
            ->fetch(true);

        $pager = new Pager(url("/painelvagas/p/"));
        $pager->pager(count($panelVancancy ?? []), 7, 1);

        // Total de vagas ativas 
        $totalVacancyActive = $vwVacancy->find("total_vacancy_active <> :to","to=0", "(SELECT sum(total_vacancy_active)) AS total")->order("nomeclatura_vacancy")->fetch();

        echo $this->view->render("/pageStart", [
            "title" => "Início",
            "workerCount" => (new Worker())->find()->count(),
            "vavancysCount" => $totalVacancyActive->total,
            "enterprisesCount" => (new Enterprise())->find()->count(),
            "serviceCount" => (new Service())->find()->count(),
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "chartServiceLabel" => $charServer["label"],
            "chartServiceTotal" => $charServer["total"],
            "panelVacancy" =>  (new VwVacancy())
                ->find("total_vacancy_active <> :to","to=0")
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("name_enterprise")
                ->fetch(true),
            "paginator" => $pager->render()
        ]);
    }

    public function panelVacancy(?array $data) : void
    {
        $vwVacancy = new VwVacancy();
        $panelVancancy = $vwVacancy->find("total_vacancy_active <> :to","to=0")
            ->order("nomeclatura_vacancy")
            ->fetch(true);

        $page = (!empty($data["page"]) && filter_var($data["page"], FILTER_VALIDATE_INT) >= 1 ? $data["page"] : 1);
        $pager = new Pager(url("/painelvagas/p/"));
        $pager->pager(count($panelVancancy ?? []), 7, $page);

        $html = $this->view->render("/pageStart/panelVacancy", [
            "panelVacancy" =>  (new VwVacancy())
                ->find("total_vacancy_active <> :to","to=0")
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("name_enterprise")
                ->fetch(true),
            "paginator" => $pager->render()
        ]);
        
        $json["html"] = $html;
        $json["content"] = "panel-vacancy";
        echo json_encode($json);
        return;
    }

    public function printPanel(array $data) : void
    {
        $vwVacancy = new VwVacancy();
        $panelVancancy = $vwVacancy->find("total_vacancy_active <> :to","to=0")
            ->order("nomeclatura_vacancy")
            ->fetch(true);

        $page = (!empty($data["page"]) && filter_var($data["page"], FILTER_VALIDATE_INT) >= 1 ? $data["page"] : 1);
        $pager = new Pager(url("/painelvagas/p/"));
        $pager->pager(count($panelVancancy ?? []), 7, $page);

        $html = $this->view->render("/pageStart/panelVacancy", [
            "panelVacancy" =>  (new VwVacancy())
                ->find("total_vacancy_active <> :to","to=0")
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("name_enterprise")
                ->fetch(true),
            "paginator" => $pager->render()
        ]);
        
        $json["html"] = $html;
        $json["content"] = "panel-vacancy";
        echo json_encode($json);
        return;    
    }


}