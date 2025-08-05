<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\SystemUser;
use Source\Models\Views\VwServicePhone;
use Source\Support\Message;

class AppWorkerPhone extends Controller
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

    public function pagePhone() : void
    {
        echo $this->view->render("/pageServicePhone", [
            "title" => "Atendimento",
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "worksPhone" => (new VwServicePhone())->find()->fetch(true)
        ]);    
    }

    public function logout()
    {
        (new Message())->success("Você saiu com sucesso " . Auth::user()->nome . ". Volte logo :)")->flash();    
        
        Auth::logout();
        redirect("/");
    }
}
