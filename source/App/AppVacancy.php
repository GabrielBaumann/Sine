<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\Enterprise;
use Source\Models\SystemUser;
use Source\Models\Vacancy;
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
    
    }

    public function startVacancy(?array $data) : void
    {

        $pager = new Pager(url("/pesquisarvagas/p/"));
        $pager->Pager((new Vacancy())->find()->count(),3, 1);

        echo $this->view->render("/pageVacancy", [
            "title" => "Vagas",
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "totalVacancy" => (new Vacancy())->find()->fetch(true),
            "countVacancy"=> (new Vacancy())->find()->count(),
            "listEnterprise" => (new Enterprise())->find()
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("name_enterprise", "DESC")->fetch(true),
            "paginator" => $pager->render()
        ]);
    }
}
