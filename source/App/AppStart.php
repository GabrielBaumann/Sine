<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Support\Message;


class AppStart extends Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/". CONF_VIEW_APP ."/");

        if (!$this->user = 31) {
            $this->message->warning("Efetue login para acessar o sistema.")->flash();
            redirect("/");
        }

    }

    public function initPage() : void
    {
        echo $this->view->render("/pageInit", [
            "title" => "Início",
        ]);    
    }
}