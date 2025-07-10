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
        $searchNameUser = filter_input(INPUT_GET, "search-user-system", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "search-user-system", FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $searchFunction = filter_input(INPUT_GET, "search-function-user", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "search-function-user", FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $searchStatus = filter_input(INPUT_GET, "search-all-status", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "search-all-status", FILTER_SANITIZE_SPECIAL_CHARS) : null;

        if(isset($data["page"]) || isset($searchNameUser) || isset($searchFunction) || isset($searchStatus)) {

            $conditions = [];
            $params = [];

            if(!empty($searchUser)) {
                $conditions[] = "name_user LIKE :n";
                $params["n"] = "%{$searchNameUser}%";
            }

            if(!empty($searchFunction)) {
                $conditions[] = "type_user = :t";
                $params["t"] = $searchFunction;
            }

            if(!empty($searchStatus)) {
                $conditions[] = "active = :s";
                $params["s"] = $searchStatus;
            }

            if($this->user->type_user != "dev") {
                $conditions[] = "type_user <> :ty";
                $params["ty"] = "dev";
            }

            $where = implode(" AND ", $conditions);

            $userSytemCount = (new SystemUser())->find($where, http_build_query($params))->count();
            $page = (!empty($data["page"]) && filter_var($data["page"], FILTER_VALIDATE_INT) >= 1 ? $data["page"] : 1);

            $pager = new Pager(url("/usuarios/p/"));
            $pager->Pager($userSytemCount, 10, $page);

            $html = $this->view->render("/pageUserSystem/componentListUserSystem", [
                "userCount" => $userSytemCount,
                "users" => (new SystemUser())->find($where, http_build_query($params))
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

        $conditions = [];
        $params = [];

        if($this->user->type_user != "dev") {
            $conditions[] = "type_user <> :ty";
            $params["ty"] = "dev";
        }

        $where = implode(" AND ", $conditions);

        $userSytemCount = (new SystemUser())->find($where, http_build_query($params))->count();
        $pager = new Pager(url("/usuarios/p/"));
        $pager->Pager($userSytemCount, 10, 1);

        echo $this->view->render("/pageUserSystem", [
            "title" => "Usuarios",
            "userCount" => (new SystemUser())->find($where, http_build_query($params))->count(),
            "users" => (new SystemUser())
                ->find($where, http_build_query($params))
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("name_user")
                ->fetch(true),
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "paginator" => $pager->render()
        ]);
    }

    public function listUserSystem(?array $data) : void
    {
        $params = [];
        $conditions = [];
        
        if($this->user->type_user != "dev") {
            $conditions[] = "type_user <> :ty";
            $params["ty"] = "dev";
        }
        
        $where = implode(" AND ", $conditions);

        $userCount = count((new SystemUser())->find()->fetch(true) ?? []);

        $pager = new Pager(url("/usuarios/p/"));
        $pager->Pager($userCount, 10, 1);

        $html = $this->view->render("/pageUserSystem/listUserSystem", [
            "users" => (new SystemUser())->find($where, http_build_query($params))
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("name_user")
                ->fetch(true),
            "userSystem" => $this->user,
            "userCount" => $userCount,
            "paginator" => $pager->render()
        ]);
        
        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

    public function searchUsers(array $data) : void
    {
        $searchUser = isset($data["search-user-system"]) ? filter_var($data["search-user-system"], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $searcFunction = isset($data["search-function-user"]) ? filter_var($data["search-function-user"], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $searchStatus = isset($data["search-all-status"]) ? filter_var($data["search-all-status"], FILTER_SANITIZE_SPECIAL_CHARS) : null;

        $conditions = [];
        $params = [];

        if($this->user->type_user != "dev") {
            $conditions[] = "type_user <> :ty";
            $params["ty"] = "dev";
        }

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
                ->order("name_user")
                ->fetch(true),
            "userCount" => $userSystemCount,
            "paginator" => $pager->render()
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

    public function formAddUser(?array $data) : void
    {   
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
                $this->user->id_user,
                $dataClean["name"],
                $dataClean["cpf"],
                $dataClean["email"],
                $dataClean["phone"],
                passwd($dataClean["password"]),
                $dataClean["type"]
            );
            
            if($SytemUser->save()) {
                $json["complete"] = true;
                $json["message"] = messageHelpers()->success("Registro salvo com sucesso!")->render();
                echo json_encode($json);
                return;
            }
        }

        $html = $this->view->render("/pageUserSystem/formNewUser", [
            "user" => $userSystem ?? null,
            "userSystem" => $this->user
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }
    
    public function editUser(array $data) : void
    {
        $idUserSystem = filter_var($data["idUserSystem"], FILTER_VALIDATE_INT);
        $userSystem = (new SystemUser())->find("id_user = :id","id={$idUserSystem}")->fetch();

        // Para identiticar como edição do cadastro
        if (!empty($data["csrf"])) {

            // Verificar csrf
            if(!csrf_verify($data)) {
                $json["message"] = messageHelpers()->warning("Atualize a página e tente novamente!")->render();
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
            
            $SytemUser->id_user = $dataClean["idUserSystem"];
            $SytemUser->name_user = $dataClean["name"];
            $SytemUser->cpf_user = $dataClean["cpf"];
            $SytemUser->email_user = $dataClean["email"];
            $SytemUser->phone_user = $dataClean["phone"];
            $SytemUser->password_user = passwd($dataClean["password"]);
            $SytemUser->id_user_update = $this->user->id_user;
            $SytemUser->type_user = $dataClean["type"];

            if($SytemUser->save()) {
                $json["complete"] = false;
                $json["message"] = messageHelpers()->success("Registro atualizado com sucesso!")->render();
                echo json_encode($json);
                return;
            }
        }

        $html = $this->view->render("/pageUserSystem/formNewUser", [
            "user" => $userSystem ?? null,
            "userSystem" => $this->user
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
        } 
        else {
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

    public function cancelUser(array $data) : void
    {
        $iduser = filter_var($data["iduser"], FILTER_VALIDATE_INT);

        $systemUser = (new SystemUser())->findById($iduser);
        $systemUser->id_user = $iduser;
        $systemUser->active = 2;
        $systemUser->id_user_update = $this->user->id_user;

        if(!$systemUser->save()) {
            $json["message"] = messageHelpers()->warning("Erro, atualize a página e tente novamente!")->render();
            echo json_encode($json);
            return;
        }

        $conditions = [];
        $params = [];

        if($this->user->type_user != "dev") {
            $conditions[] = "type_user <> :ty";
            $params["ty"] = "dev";
        }

        $where = implode(" AND ", $conditions);


        $userSytemCount = (new SystemUser())->find($where, http_build_query($params))->count();
        $pager = new Pager(url("/usuarios/p/"));
        $pager->Pager($userSytemCount, 10, 1);

        $html = $this->view->render("/pageUserSystem/listUserSystem", [
            "userCount" => (new SystemUser())->find($where, http_build_query($params))->count(),
            "users" => (new SystemUser())->find($where, http_build_query($params))
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("name_user")
                ->fetch(true),
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "paginator" => $pager->render()
        ]);

        $json["message"] = messageHelpers()->success("Registro cancelado com sucesso")->render();
        $json["content"] = "usersView";
        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

    public function reactiveUser(array $data) : void
    {
        $iduser = filter_var($data["iduser"], FILTER_VALIDATE_INT);

        $systemUser = (new SystemUser())->findById($iduser);
        $systemUser->id_user = $iduser;
        $systemUser->active = 1;
        $systemUser->id_user_update = $this->user->id_user;

        if(!$systemUser->save()) {
            $json["message"] = messageHelpers()->warning("Erro, atualize a página e tente novamente!")->render();
            echo json_encode($json);
            return;
        }

        $conditions = [];
        $params = [];

        if($this->user->type_user != "dev") {
            $conditions[] = "type_user <> :ty";
            $params["ty"] = "dev";
        }

        $where = implode(" AND ", $conditions);        

        $userSytemCount = (new SystemUser())->find($where, http_build_query($params))->count();
        $pager = new Pager(url("/usuarios/p/"));
        $pager->Pager($userSytemCount, 10, 1);

        $html = $this->view->render("/pageUserSystem/listUserSystem", [
            "userCount" => (new SystemUser())->find($where, http_build_query($params))->count(),
            "users" => (new SystemUser())->find($where, http_build_query($params))
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("name_user")
                ->fetch(true),
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "paginator" => $pager->render()
        ]);

        $json["message"] = messageHelpers()->success("Registro cancelado com sucesso")->render();
        $json["content"] = "usersView";
        $json["html"] = $html;
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
