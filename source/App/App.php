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

        if (!$this->user = Auth::user()) {
            $this->message->warning("Efetue login para acessar o sistema.")->flash();
            redirect("/");
        }

    }

    public function recipientWork(): void
    {

        echo $this->view->render("works", [
            "title" => "OrçaFácil - Obras",
            "usuario" => Auth::user()->nome,
            "typeAccess" => Auth::user()->type_access,
            "recipients" => (new RecipientWork())->find("id_user = :u", "u={$this->user->id_usuarios}")->fetch(true)
        ]);
    }

    public function addRecipient(?array $data) : void
    {

        if(!empty($data['csrf'])) {

            if(!csrf_verify($data)) {
                $json['message'] = (new Message())->warning("Erro ao enivar, use o formulário!")->render();
                echo json_encode($json);
                return;
            }

            $cleanArray = cleanInputData($data);

            if(!$cleanArray['valid']) {
                $json["message"] = (new Message())->error("Preencha os campos obrigatórios!")->render();
                echo json_encode($json);
                return;
            }

            $dataClean = $cleanArray['data'];
            
            $newRecipientWork = (new RecipientWork());
            $newRecipientWork->bootstrap(
                $this->user->id_usuarios,
                $dataClean["name"],
                $dataClean["cpf"],
                $dataClean["address"],
                $dataClean["telephone"],
                $dataClean["email"],
                $dataClean["gender"],
                $dataClean["observation"],
                $dataClean["date-birth"],
                $dataClean["date-start-work"],
                $dataClean["cit"],
                $dataClean["state"] 
            );

            if($newRecipientWork->save()){
                $json['message'] = $this->message->success("Registro salvo com sucesso!")->render();
                echo json_encode($json);
                return;
            }

            $json['message'] = $newRecipientWork->message;
            echo json_encode($json);
            return;
        }
      
        $defaultForms = [
            "title" => "OrçaFácil - Cadastro Obras",
            "url" => url("/recipient"),
            "titleForms" => "Novo Beneficiário",
            "textForms" => "Preencha os dados abaixo para cadastrar um novo eneficiário",
        ];

        echo $this->view->render("/forms/formRecipient", [
            "default" => $defaultForms
        ]);
        
    }

    public function seeDetails(?array $data) : void
    {
        $materialWorks = (new MaterialWork())->find("id_work = :id", "id={$data['idWork']}")->order("material")->fetch(true);
        $totalSpent = (new MaterialWork())->find("id_work = :id", "id={$data['idWork']}","(SELECT SUM(total_value)) AS total")->fetch();
        $materialCount = (new MaterialWork())->find("id_work = :id", "id={$data['idWork']}")->count();

        echo $this->view->render("modal/modalViewDetails", [
            "recipient" => (new RecipientWork())->findById($data['idWork']),
            "materialWorks" => $materialWorks,
            "totalSpent" => $totalSpent,
            "materialCount" => $materialCount
        ]);
    }

    public function filterSee(array $data) : void
    {   

        $nameSearch = $data['inputSearch'] ?? null;
        $idRecipient = $data['idRecipient'];

        $conditions = [];
        $params = [];

        if (!empty($nameSearch)) {
            $conditions[] = "material LIKE :n";
            $params['n'] = "%{$nameSearch}%";
        }

        $conditions[] = "id_work = :w";
        $params['w'] = $idRecipient;

        $where = implode(" AND ", $conditions);

        $materialWorks = (new MaterialWork())->find($where, http_build_query($params))->order("material")->fetch(true);

        if(!$materialWorks){
            $json['erro'] = true;
            $json['message'] = (new Message())->info("Não existe dados para esse filtro: {$nameSearch}!")->render();
            echo json_encode($json);
            return;
        }

        $html = $this->view->render("/updateAjax/listViewMaterial", [
            "materialWorks" => $materialWorks
        ]);

        $json['erro'] = false;
        $json['message'] = $html;
        
        echo json_encode($json); 
    }

    public function registerMaterial(?array $data) : void
    {   

        if (isset($data['idWork'])) {
            $idWork = $data['idWork'];
            $user = (new RecipientWork())->findById($idWork);
        }

        if(!empty($data['csrf'])){

            if(!csrf_verify($data)) {
                $json['message'] = (new Message())->warning("Erro ao enivar, use o formulário!")->render();
                echo json_encode($json);
                return;
            }

            $removerKeys = ["description"];
            $cleanArray = cleanInputData($data, $removerKeys);

            if(!$cleanArray['valid']) {
                $json["message"] = (new Message())->error("Preencha os campos obrigatórios!")->render();
                echo json_encode($json);
                return;
            }

            $dataClean = $cleanArray['data'];

            $materialWork = new MaterialWork();

            $materialWork->id_user = $this->user->id_usuarios;
            $materialWork->id_work = $dataClean['idWork'];
            $materialWork->material = $dataClean["material"];
            $materialWork->description_material = $data["description"];
            $materialWork->unit = $dataClean["selectAmount"];
            $unit_price = str_replace([".", "."], ["", "."], $dataClean["unitPrice"]);
            $amount = str_replace([".", "."], ["", "."], $dataClean["amount"]);

            $materialWork->unit_price = floatval($unit_price);
            $materialWork->amount = floatval($amount);
            $materialWork->total_value = floatval($unit_price) * floatval($amount);
            
            if($materialWork->save()){
                $json['message'] = $this->message->success("Registro salvo com sucesso!")->render();
                echo json_encode($json);
                return;
            }
        }

        echo $this->view->render("modal/modalRegistrationMaterial", [
            "idWork" => $idWork,
            "user" => $user,
            "units" => (new Unit())->find()->order("unit")->fetch(true)
        ]);    
    }

    public function user(?array $data) : void
    {
        $user = (new User())->find();
        $page = (!empty($data['page']) && filter_var($data['page'], FILTER_VALIDATE_INT) >= 1 ? $data['page'] : 1);
        $pager = new Pager(url("/user/p/"));
        $pager->pager($user->count(), 10, $page);


        echo $this->view->render("setingUser", [
            "title" => "OrçaFácil Usuários",
            "usuario" => Auth::user()->nome,
            "typeAccess" => Auth::user()->type_access,
            "usuarios" => $user
                    ->limit($pager->limit())
                    ->offset($pager->offset())
                    ->order("nome")
                    ->fetch(true),
            "paginator" => $pager->render()
        ]);
    }

    public function filterUser(array $data) : void
    {
        $nameSearch = $data['s'] ?? null;
        $status = $data['status'] === "2" ? null : $data['status'];

        $conditions = [];
        $params = [];

        if (!empty($nameSearch)) {
            $conditions[] = "nome LIKE :n";
            $params['n'] = "%{$nameSearch}%";
        }

        if (!is_null($status)) {
            $conditions[] = "ativo = :a";
            $params['a'] = $status;
        }

        $where = implode(" AND ", $conditions);

        $user = (new User())->find($where, http_build_query($params))->order("nome")->limit(10)->fetch(true);

        if(!$user){
            $json['erro'] = true;
            $json['message'] = (new Message())->info("Não existe dados para esse filtro: {$nameSearch}!")->render();
            echo json_encode($json);
            return;
        }

        $html = $this->view->render("/updateAjax/listSetingUser", [
            "usuarios" => $user
        ]);

        $json['erro'] = false;
        $json['message'] = $html;
        
        echo json_encode($json);
    }

    public function newUser(?array $data) : void
    {

        
        if(isset($data['idUser'])) {
            $id = filter_var($data['idUser'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $userId = (new User())->findById($id);
        }

        if (!empty($data['csrf'])){           

            if(!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enivar, use o formulário!", "Erro de Envio")->render();
                echo json_encode($json);
                return;
            }

            $resultado = cleanInputData($data);

            if(!$resultado['valid']) {
               $json['message'] = (new Message())->error("Preencha todos os campos!")->render();
               echo json_encode($json);
               return;
            }
            
            $dataClear = $resultado['data'];
           
            $user = new User();
            $user->bootstrap(
                $dataClear['idEntidade'],
                $dataClear['nome'],
                $dataClear['telefone'],
                $dataClear['usuario'],
                $dataClear['email'],
                $dataClear['senha'],
                $dataClear['typeAccess'],
                $dataClear['status']
            );

            if(isset($userId)) {
                $user->id_usuarios = $userId->id_usuarios;
            }

            if($user->save()) {
                $json['message'] = (new Message)->success("Cadastro feito com sucesso")->render();
                $json['redirected'] = url("/user");
                echo json_encode($json);
                return;
            };

            $json['message'] = (new Message)->error("Erro vamos investigar", "Desculpe")->render();
            echo json_encode($json);
            return;
        }

        echo $this->view->render("modal/modalNewUser", [
            "user" => $userId ?? null
        ]);    
    }

    public function logout()
    {
        (new Message())->success("Você saiu com sucesso " . Auth::user()->nome . ". Volte logo :)")->flash();    
        
        Auth::logout();
        redirect("/");
    }

}
