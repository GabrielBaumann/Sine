<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\Enterprise;
use Source\Models\SystemUser;
use Source\Models\Vacancy;
use Source\Support\Pager;

class AppCompany extends Controller
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

    public function startCompany(?array $data) : void
    {

        echo $this->view->render("/pageCompany", [
            "title" => "Empresas",
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "listEnterprise" => new Enterprise()->find()->order("name_enterprise")->fetch(true),
            "countEnterprise" => new Enterprise()->find()->count()
        ]);
    }

    public function formCompany()
    {

        

        $html = $this->view->render("/pageCompany/formNewCompany", [

        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }
}
