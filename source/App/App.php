<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Core\Session;
use Source\Models\Auth;
use Source\Models\MaterialWork;
use Source\Models\RecipientWork;
use Source\Models\Unit;
use Source\Models\User;
use Source\Support\Message;
use Source\Support\Pager;

class App extends Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/". CONF_VIEW_APP ."/");

        // if (!$this->user = Auth::user()) {
        //     $this->message->warning("Efetue login para acessar o sistema.")->flash();
        //     redirect("/");
        // }

    }

    public function initPage() : void
    {
        echo $this->view->render("page", [

        ]);    
    }

    public function userSystem() : void
    {
        echo $this->view->render("/usuario", [
            "users" => (new User())->find()->fetch(true)
        ]);
    }

    public function modelAddUser(?array $data) : void
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

            var_dump($dataClean);

            return;
        }

        echo $this->view->render("/user/modalForm", [

        ]);
    }

    public function checkCpf($data) : void
    {
        $cpfuser = $data["cpfuser"];

        if(!validateCPF($cpfuser)){
            $json["message"] = messageHelpers()->warning("O CPF: " . formatCPF($cpfuser) . " não é válido!")->render();
            $json["erro"] = true;
            echo json_encode($json);
            return;
        }

        $user = (new User())->find("cpf_user = :c", "c={$cpfuser}");

        // var_dump($user->fetch());

        if ($user->fetch()) {
            $json["message"] = messageHelpers()->warning("O CPF: " . formatCPF($cpfuser) . " já existe na base de dados!")->render();
            $json["erro"] = true;
            echo json_encode($json);
            return;
        }

    }

    public function logout()
    {
        (new Message())->success("Você saiu com sucesso " . Auth::user()->nome . ". Volte logo :)")->flash();    
        
        Auth::logout();
        redirect("/");
    }

}
