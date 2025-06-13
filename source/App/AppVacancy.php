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
                "listEnterprise" => (new Enterprise())->find()->fetch(true),
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
            "listEnterprise" => (new Enterprise())->find()->order("name_enterprise")->fetch(true),
            "paginator" => $pager->render()
        ]);
    }

    public function addVacancy(?array $data) : void
    {
        if(!empty($data["csrf"])) {

            if(!csrf_verify($data)) {
                $json["message"] = messageHelpers()->warning("Use o formulário!")->render();
                $json["complete"] = false;
                echo json_encode($json);
                return;
            }

            // Verificar e sanitizar campos obrigatórios e não obrigatórios
            $dataClean = cleanInputData($data, ["description-vacancy"]);

            if (!$dataClean["valid"]) {
                $json["message"] = messageHelpers()->warning("Preencha todos os campos obrigatórios!")->render();
                $json["complete"] = false;
                echo json_encode($json);
                return;
            }

            $dataCleanOk = $dataClean["data"];

            $vacancy = new Vacancy();

            $vacancy->id_enterprise = $dataCleanOk["enterprise"];
            $vacancy->cbo_occupation = $dataCleanOk["cbo-occupation"];
            $vacancy->apprentice_vacancy = $dataCleanOk["apprentice-vacancy"];
            $vacancy->gender_vacancy = $dataCleanOk["gender"];
            $vacancy->number_vacancy = $dataCleanOk["number-vacancy"];
            $vacancy->pcd_vacancy = $dataCleanOk["pcd-vacancy"];
            $vacancy->quantity_per_vacancy = $dataCleanOk["quantity-per-vacancy"];
            $vacancy->date_open_vacancy = $dataCleanOk["date-open-vacancy"];
            $vacancy->education_vacancy = $dataCleanOk["education-vacancy"];
            $vacancy->age_min_vacancy = $dataCleanOk["age-min-vacancy"];
            $vacancy->age_max_vacancy = $dataCleanOk["age-max-vacancy"];
            $vacancy->exp_vacancy = $dataCleanOk["exp-vacancy"];
            $vacancy->description_vacancy = $dataCleanOk["description-vacancy"];
            $vacancy->nomeclatura_vacancy = $dataCleanOk["nomeclatura-vacancy"];
            $vacancy->id_user_register = $this->user->id_user;

            if(!$vacancy->save()) {
                $json["message"] = $vacancy->message()->render();
                $json["complete"] = false;
                echo json_encode($json);
                return;
            }
            
            $json["message"] = messageHelpers()->success("Registro salvo com sucesso!")->render();
            $json["complete"] = true;
            echo json_encode($json);
            return;
        }
        
        $html = $this->view->render("/pageVacancy/formsNewVacancy", [
            "title" => "Cadastrar vagas"
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }
}
