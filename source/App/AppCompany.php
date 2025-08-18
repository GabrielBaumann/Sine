<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\Enterprise;
use Source\Models\SystemUser;
use Source\Support\Pager;

class AppCompany extends Controller
{
    protected $user;

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" .CONF_VIEW_APP . "/");
        
        if (!$this->user = Auth::user()) {
            $this->message->warning("Efetue login para acessar o sistema!")->flash();
            redirect("/");
        }
    }

    public function startCompany(?array $data) : void
    {

        if(isset($data["page"])) {

            $searchCompany = filter_input(INPUT_GET, "search-company", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "search-company", FILTER_SANITIZE_SPECIAL_CHARS) : null;
            $searchAllStatus = filter_input(INPUT_GET, "search-all-status", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "search-all-status", FILTER_SANITIZE_SPECIAL_CHARS) : null;

            $conditions = [];
            $params = [];

            if(!empty($searchCompany)) {
                $conditions[] = "name_enterprise LIKE :co";
                $params["co"] = "%{$searchCompany}%";
            }

            if(!empty($searchAllStatus)) {
                $conditions[] = "active = :st";
                $params["st"] = $searchAllStatus;
            }

            $where = implode(" AND ", $conditions);

            $enterprise = (new Enterprise())->find()->count();
            $page = (!empty($data["page"]) && filter_var($data["page"], FILTER_VALIDATE_INT) >= 1 ? $data["page"] : 1); 
            $pager = new Pager(url("/pesquisarempresa/p/"));
            $pager->Pager($enterprise, 15, $page);

            $html = $this->view->render("/pageCompany/componentListCompany", [
                "listEnterprise" => (new Enterprise())->find($where, http_build_query($params))
                    ->limit($pager->limit())
                    ->offset($pager->offset())
                    ->order("name_enterprise")->fetch(true),
                "countEnterprise" => (new Enterprise())->find()->count(),
                "paginator" => $pager->render()
            ]);

            $json["html"] = $html;
            $json["content"] = "list-company";
            echo json_encode($json);
            return;
        }

        $enterprise = (new Enterprise())->find()->count(); 
        $pager = new Pager(url("/pesquisarempresa/p/"));
        $pager->Pager($enterprise, 15, 1);

        echo $this->view->render("/pageCompany", [
            "title" => "Empresas",
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "listEnterprise" => (new Enterprise())->find()
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("name_enterprise")->fetch(true),
            "countEnterprise" => (new Enterprise())->find()->count(),
            "paginator" => $pager->render()
        ]);
    }

    public function listCompany(?array $data) : void
    {

        if(isset($data["search-company"]) || isset($data["search-all-status"])) {

            $searchCompany = isset($data["search-company"]) ? filter_var($data["search-company"], FILTER_SANITIZE_SPECIAL_CHARS) : null;
            $searchStatus = isset($data["search-all-status"]) ? filter_var($data["search-all-status"], FILTER_SANITIZE_SPECIAL_CHARS) : null;

            $conditions = [];
            $params = [];

            if(!empty($searchCompany)) {
                $conditions[] = "name_enterprise LIKE :c";
                $params["c"] = "%{$searchCompany}%"; 
            }

            if(!empty($searchStatus)) {
                $conditions[] = "active = :a";
                $params["a"] = $searchStatus;
            }

            $where = implode(" AND ", $conditions);

            $company = (new Enterprise())->find($where, http_build_query($params))->fetch(true);
            
            $companyCount = count($company ?? []);

            $pager = new Pager(url("/pesquisarempresa/p/"));
            $pager->Pager($companyCount, 15, 1);

            $html = $this->view->render("/pageCompany/componentListCompany", [
                "listEnterprise" => (new Enterprise())
                    ->find($where, http_build_query($params))
                    ->limit($pager->limit())
                    ->offset($pager->offset())
                    ->order("name_enterprise")
                    ->fetch(true),
                "countEnterprise" => $companyCount,
                "paginator" => $pager->render()
            ]);

            $json["html"] = $html;
            echo json_encode($json);
            return;            
        }

        $enterprise = (new Enterprise())->find()->count(); 
        $pager = new Pager(url("/pesquisarempresa/p/"));
        $pager->Pager($enterprise, 15, 1);

        $html = $this->view->render("/pageCompany/listCompany", [
            "listEnterprise" => (new Enterprise())->find()
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("name_enterprise")->fetch(true),
            "countEnterprise" => (new Enterprise())->find()->count(),
            "paginator" => $pager->render()
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

    /**
     * Cadastrar empresa e editar
     */
    public function formCompany(?array $data) : void
    {   
        // Reativar empresa
        if(isset($data["btnform"]) && $data["btnform"] === "reactve") {
            $this->activeCompany($data);
            return;
        }

        if(!empty($data["csrf"])) {
            
            // Cancelar empresa
            if($data["btnform"] === "cancel") {
                $this->cancelCompany($data);
                return;
            }

            if(!csrf_verify($data)) {
                $json["message"] = messageHelpers()->warning("Erro ao enviar formulário! Atualize a página e tente novamente!")->render();
                echo json_encode($json);
                return;
            }

            $cleanInput = cleanInputData($data, ["email-enterprise", "phone-enterprise", "responsible-person", "observation"]);

            if(!$cleanInput["valid"]) {
                $json["message"] = messageHelpers()->error("Preencha todos os campos obrigatórios!!!")->render();
                echo json_encode($json);
                return;
            }

            $dataCleanInput = $cleanInput["data"];

            if(!is_email($dataCleanInput["email-enterprise"]) && !empty($dataCleanInput["email-enterprise"])) {
                $json["message"] = messageHelpers()->warning("Esse email não é válido!")->render();
                echo json_encode($json);
                return;
            }
            
            $enterprise = new Enterprise();

            if(isset($data["idcompany"]) && !empty($data["idcompany"])) {
                $idCompany = filter_var($data["idcompany"], FILTER_VALIDATE_INT);
                $enterprise->id_enterprise = $idCompany;
                $json["complete"] = false;
                $json["message"] = messageHelpers()->success("Dados atualizados com sucesso!")->render();
            } else {
                $json["complete"] = true;
                $json["message"] = messageHelpers()->success("Empresa cadastrada com sucesso!")->render();
            }

            $enterprise->name_enterprise = $dataCleanInput["new-enterprise"];
            $enterprise->name_fantasy_enterpise = $dataCleanInput["name-fantasy"];
            $enterprise->cnpj = cleanCPF($dataCleanInput["cnpj"]);
            $enterprise->email_enterprise = $dataCleanInput["email-enterprise"];
            $enterprise->responsible_enterprise = $dataCleanInput["responsible-person"];
            $enterprise->observation_enterprise = $dataCleanInput["observation"];
            $enterprise->phone_enterprise = str_replace(["(", ")", "-", " "], "", $dataCleanInput["phone-enterprise"]);
            $enterprise->id_user_register = $this->user->id_user;

            if(!$enterprise->save()) {
                $json["message"] = $enterprise->message()->render();
                echo json_encode($json);
                return;
            }

            echo json_encode($json);
            return;
        }

        $html = $this->view->render("/pageCompany/formNewCompany", [
            "userSystem" => $this->user
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

    public function editCompany(?array $data) : void
    {   
        $idCompany = filter_var($data["idCompany"], FILTER_VALIDATE_INT);

        $company = (new Enterprise())->findById($idCompany);

        $html = $this->view->render("/pageCompany/formNewCompany", [
            "company" => $company,
            "userSystem" => $this->user
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }
    
    public function cancelCompany(array $data) : void
    {
        $idCompany = filter_var($data["idcompany"], FILTER_VALIDATE_INT);
        $company = (new Enterprise())->findById($idCompany);
        $company->id_enterprise = $idCompany;
        $company->id_user_update =$this->user->id_user;
        $company->active = "Cancelada";

        if($company->save()) {

        $enterprise = (new Enterprise())->find()->count(); 
        $pager = new Pager(url("/pesquisarempresa/p/"));
        $pager->Pager($enterprise, 10, 1);

        $html = $this->view->render("/pageCompany/listCompany", [
            "listEnterprise" => (new Enterprise())->find()
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("name_enterprise")->fetch(true),
            "countEnterprise" => (new Enterprise())->find()->count(),
            "paginator" => $pager->render()
        ]);

        $json["message"] = messageHelpers()->success("Registro cancelado com sucesso!")->render();
        $json["html"] = $html;
        $json["content"] = "companiesView";
        echo json_encode($json);
        return;
        }

    }

    // Método para verificar validação do cnpj ou se ele já está cadastrado na base de dados
    public function verificCnpj(array $data) : void
    {   
        $enterprise = new Enterprise();

        $cnpj = filter_var($data["cnpj"], FILTER_VALIDATE_INT);

        if (!validateCNPJ($data["cnpj"])) {
            $json["message"] = messageHelpers()->warning("O número de CNPJ não é válido!")->render();
            echo json_encode($json);
            return;
        }
        
        if(isset($data["idCompany"]) && !empty($data["cnpj"])){
            
            $idCompany = filter_var($data["idCompany"], FILTER_VALIDATE_INT);
            $enterpriseCnpj = $enterprise->find("cnpj = :cn AND id_enterprise <> :id", "cn={$cnpj}&id={$idCompany}")->fetch();

            if ($enterpriseCnpj) {
                $json["message"] = messageHelpers()->warning("O CNPJ: ". maskCNPJ($cnpj) . " já está cadastrado na base!")->render();
                echo json_encode($json);
                return;
            }
            
            $json["message"] = "";
            $json["complete"] = true;
            echo json_encode($json);
            return;
        }
        
        if ($enterprise->getByCnpj($data["cnpj"])) {
            $json["message"] = messageHelpers()->warning("O CNPJ: ". maskCNPJ($data["cnpj"]) . " já está cadastrado na base!")->render();
            echo json_encode($json);
            return;
        }
        
        $json["message"] = "";
        $json["complete"] = true;
        echo json_encode($json);
        return;
    }

    // Reativar empresa
    public function activeCompany(array $data) : void
    {
        $idCompany = filter_var($data["idcompany"], FILTER_VALIDATE_INT);

        $company = (new Enterprise())->findById($idCompany);
        $company->id_enterprise = $idCompany;
        $company->id_user_update =$this->user->id_user;
        $company->active = "Ativa";

        if($company->save()) {

        $enterprise = (new Enterprise())->find()->count(); 
        $pager = new Pager(url("/pesquisarempresa/p/"));
        $pager->Pager($enterprise, 10, 1);

        $html = $this->view->render("/pageCompany/listCompany", [
            "listEnterprise" => (new Enterprise())->find()
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("name_enterprise")->fetch(true),
            "countEnterprise" => (new Enterprise())->find()->count(),
            "paginator" => $pager->render()
        ]);

        $json["message"] = messageHelpers()->success("Registro reativado com sucesso!")->render();
        $json["html"] = $html;
        $json["content"] = "companiesView";
        echo json_encode($json);
        return;
        }  
    }

}
