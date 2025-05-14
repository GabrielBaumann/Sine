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
            "usuarios" => (new User())->find()->fetch(true)
        ]);
    }

    public function modelAddUser(?array $data) : void
    {   

        if (!empty($data['csrf'])) {

            if(!csrf_verify($data)) {
                $json['message'] = messageHelpers()->warning("Use o fomulário!")->render();
                echo json_encode($json);
                return;
            }

            

            return;
        }

        echo $this->view->render("/user/modalForm", [

        ]);
    }


    public function logout()
    {
        (new Message())->success("Você saiu com sucesso " . Auth::user()->nome . ". Volte logo :)")->flash();    
        
        Auth::logout();
        redirect("/");
    }

}
