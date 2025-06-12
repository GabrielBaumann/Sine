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
        if(isset($data["page"])) {
            
            $countVacancy = (new Vacancy())->find()->count(); 
            $page = (!empty($data["page"]) && filter_var($data["page"], FILTER_VALIDATE_INT) >= 1 ? $data["page"] : 1);
            $pager = new Pager(url("/pesquisarvagas/p/"));
            $pager->Pager($countVacancy, 10, $page);

            $html = $this->view->render("/pageVacancy/componentListVacancy", [
                "totalVacancy" => (new Vacancy())
                    ->find()
                    ->limit($pager->limit())
                    ->offset($pager->offset())
                    ->order("nomeclatura_vacancy", "DESC")->fetch(true),
                "countVacancy"=> (new Vacancy())->find()->count(),
                "listEnterprise" => (new Enterprise())->find(),
                "paginator" => $pager->render()
            ]);   

            $json["html"] = $html;
            $json["content"] = "listVacancy";
            echo json_encode($json);
            return;
        }

        $vacancyCount = (new Vacancy())->find()->count(); 
        $pager = new Pager(url("/pesquisarvagas/p/"));
        $pager->Pager($vacancyCount, 10, 1);

        echo $this->view->render("/pageVacancy", [
            "title" => "Vagas",
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "totalVacancy" => (new Vacancy())
                ->find()                
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("nomeclatura_vacancy", "DESC")->fetch(true),
            "countVacancy"=> (new Vacancy())->find()->count(),
            "listEnterprise" => (new Enterprise())->find(),
            "paginator" => $pager->render()
        ]);
    }

    public function addVacancy(?array $data) : void
    {

        if(isset($data) && !empty($data)) {

            // var_dump($data);
            // if(empty($data["gender"])) {
            //     $json["message"] = messageHelpers()->warning("Atenção")->render();
            //     $json["complete"] = false;
            //     echo json_encode($json);
            //     return;
            // }

            // $json["message"] = messageHelpers()->success("OK")->render();
            // $json["complete"] = true;
            // echo json_encode($json);
            // return;

        }
        
        $html = $this->view->render("/pageVacancy/formsNewVacancy", [
            "title" => "Cadastrar vagas"
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }
}
