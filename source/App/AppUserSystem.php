<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\SystemUser;
use Source\Support\Message;
use Source\Support\Pager;

class AppUserSystem extends Controller
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

    public function userSystem(?array $data) : void
    {   
        if(isset($data["page"])) {
            $userSytemCount = (new SystemUser())->find()->count();
            $page = (!empty($data["page"]) && filter_var($data["page"], FILTER_VALIDATE_INT) >= 1 ? $data["page"] : 1); 
            $pager = new Pager(url("/usuarios/p/"));
            $pager->Pager($userSytemCount, 10, $page);

            $html = $this->view->render("/pageUserSystem/componentListUserSystem", [
                "userCount" => $userSytemCount,
                "users" => (new SystemUser())->find()
                    ->limit($pager->limit())
                    ->offset($pager->offset())
                    ->order("name_user")
                    ->fetch(true),
                "paginator" => $pager->render()
            ]);

            $json["html"] = $html;
            $json["content"] = "list-user-system";
            echo json_encode($json);
            return;
        }

        $userSytemCount = (new SystemUser())->find()->count();
        $pager = new Pager(url("/usuarios/p/"));
        $pager->Pager($userSytemCount, 10, 1);

        echo $this->view->render("/pageUserSystem", [
            "title" => "Usuarios",
            "userCount" => (new SystemUser())->find()->count(),
            "users" => (new SystemUser())->find()
                ->order("name_user")
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->fetch(true),
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "paginator" => $pager->render()
        ]);
    }

    public function listUserSystem(?array $data) : void
    {

        if(isset($data["search-user-system"]) || isset($data["search-function-user"]) || isset($data["search-all-status"])) {
            // var_dump($data);
            $searchUser = isset($data["search-user-system"]) ? filter_var($data["search-user-system"], FILTER_SANITIZE_SPECIAL_CHARS) : null;
            $searcFunction = isset($data["search-function-user"]) ? filter_var($data["search-function-user"], FILTER_SANITIZE_SPECIAL_CHARS) : null;
            $searchStatus = isset($data["search-all-status"]) ? filter_var($data["search-all-status"], FILTER_SANITIZE_SPECIAL_CHARS) : null;

            // var_dump($searchStatus);
            $conditions = [];
            $params = [];

            if(!empty($searchUser)) {
                $conditions[] = "name_user LIKE :n";
                $params["n"] = "%{$searchUser}%";
            }

            if(!empty($searcFunction)) {
                $conditions[] = "type_user = :t";
                $params["t"] = $searcFunction;
            }

            if(!empty($searchStatus)) {
                $conditions[] = "active = :s";
                $params["s"] = $searchStatus;
            }

            $where = implode(" AND ", $conditions);

            $userSystem = (new SystemUser())
                ->find($where, http_build_query($params))
                ->fetch(true);

            $userSystemCount = count($userSystem ?? []);

            $pager = new Pager(url("/usuarios/p/"));
            $pager->Pager($userSystemCount, 10, 1);

            $html = $this->view->render("/pageUserSystem/componentListUserSystem", [
                "users" => (new SystemUser())
                    ->find($where, http_build_query($params))
                    ->limit($pager->limit())
                    ->offset($pager->offset())
                    ->fetch(true),
                "userCount" => $userSystemCount,
                "paginator" => $pager->render()
            ]);

            $json["html"] = $html;
            echo json_encode($json);
            return;
            // var_dump($userSystem, count($userSystem));
        }

        $html = $this->view->render("/pageUserSystem/listUserSystem", [
            "users" => (new SystemUser())->find()->fetch(true)
        ]);
        
        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

    public function formAddUser(?array $data) : void
    {   

        if(isset($data["idUserSystem"])) {
            $idUserSystem = $data["idUserSystem"];
            $userSystem = (new SystemUser())->find("id_user = :id","id={$idUserSystem}")->fetch();
        }

        if (!empty($data["csrf"])) {

            // Verificar csrf
            if(!csrf_verify($data)) {
                $json["message"] = messageHelpers()->warning("Use o fomulário!")->render();
                echo json_encode($json);
                return;
            }

            // Verificar campos obrigatórios e sanitizá-los
            $dataCleanCheck = cleanInputData($data);

            if(!$dataCleanCheck['valid']) {
                $json["message"] = messageHelpers()->warning("Preencha todos os campos!")->render();
                echo json_encode($json);
                return;
            }

            $dataClean = $dataCleanCheck["data"];

            // Verificar se é um email válido
            if(!is_email($dataClean["email"])) {
                $json["message"] = messageHelpers()->warning("Esse email não é válido!")->render();
                echo json_encode($json);
                return;
            }

            $SytemUser = new SystemUser();

            $SytemUser->bootstrap(
                1,
                $dataClean["name"],
                $dataClean["cpf"],
                $dataClean["email"],
                $dataClean["phone"],
                $dataClean["password"],
                $dataClean["type"]
            );


            // Para identiticar como edição do cadastro
            if(isset($idUserSystem)) {
                $SytemUser->id_user = $idUserSystem;
                $SytemUser->id_user_update = 2;
                $SytemUser->active = $dataClean["status"];
            }

            if($SytemUser->save()) {

                $json["complete"] = true;
                $json["message"] = messageHelpers()->success("Registro salvo com sucesso!")->render();
                echo json_encode($json);
                return;
            }
        }

        $html = $this->view->render("/pageUserSystem/formNewUser", [
            "user" => $userSystem ?? null
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

    
    public function checkCpf($data) : void
    {
        $cpfuser = $data["cpf"];

        if(!validateCPF($cpfuser)){
            $json["message"] = messageHelpers()->warning("O CPF: " . formatCPF($cpfuser) . " não é válido!")->render();
            $json["erro"] = true;
            echo json_encode($json);
            return;
        }

        if(isset($data["idSystemUser"])) {
            $user = (new SystemUser())->find("cpf_user = :c AND id_user <> :i", "c={$cpfuser}&i={$data["idSystemUser"]}");
        } else {
            $user = (new SystemUser())->find("cpf_user = :c", "c={$cpfuser}");
        }

        if ($user->fetch()) {
            $json["message"] = messageHelpers()->warning("O CPF: " . formatCPF($cpfuser) . " já existe na base de dados!")->render();
            $json["erro"] = true;
            echo json_encode($json);
            return;
        }
        $json["message"] = "";
        $json["erro"] = false;
        echo json_encode($json);
        return;
    }

    public function logout()
    {
        (new Message())->success("Você saiu com sucesso " . Auth::user()->nome . ". Volte logo :)")->flash();    
        
        Auth::logout();
        redirect("/");
    }

}
