<?php

namespace Source\App;

use DateTime;
use Source\Support\Message;
use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\CboOccupation;
use Source\Models\Enterprise;
use Source\Models\SystemUser;
use Source\Models\Vacancy;
use Source\Models\VacancyWorker;
use Source\Models\Views\VwForwardingWorker;
use Source\Models\Views\VwVacancy;
use Source\Support\Pager;

class AppVacancy extends Controller
{
    protected $user;

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" .CONF_VIEW_APP . "/");
        
        if (!$this->user = Auth::user()) {
            $this->message->warning("Efetue login para acessar o sistema!")->flash();
            redirect("/");
        }

        $normalizeWorker = (new VacancyWorker())->normalizeWorkerVacancy();
    }

    // Página Inicial e dados do sidebar
    public function startVacancy(?array $data) : void
    {   

        if(isset($data["page"]) && !empty($data["page"])) {

            $searchVacancy = filter_input(INPUT_GET, "search-vacancy", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "search-vacancy", FILTER_SANITIZE_SPECIAL_CHARS) : null;
            $searchEnterprise = filter_input(INPUT_GET, "search-enterprise", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "search-enterprise", FILTER_SANITIZE_SPECIAL_CHARS) : null;
            $searchStatus = filter_input(INPUT_GET, "search-status", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "search-status", FILTER_SANITIZE_SPECIAL_CHARS) : null;

            $conditions = [];   
            $params = [];

            if(!empty($searchEnterprise)) {
                $conditions[] = "id_enterprise = :in";
                $params["in"] = $searchEnterprise; 
            }

            if(!empty($searchVacancy)) {
                $conditions[] = "nomeclatura_vacancy LIKE :n";
                $params["n"] = "%{$searchVacancy}%";
            }

            if($searchStatus === "Oculta") {
                if(!empty($searchStatus)) {
                    $conditions[] = "hide_vacancy = :s";
                    $params["s"] = 1;
                }
            } else {
                if(!empty($searchStatus)) {
                    $conditions[] = "status_vacancy = :s AND hide_vacancy <> 1";
                    $params["s"] = $searchStatus;
                }
            }

            $where = implode(" AND ", $conditions);

            $vacancy = (new VwVacancy())
                ->find($where, http_build_query($params))
                ->order("date_open_vacancy", "DESC")
                ->fetch(true);

            $vacancyCount = count($vacancy ?? []);

            $page = (!empty($data["page"]) && filter_var($data["page"], FILTER_VALIDATE_INT) >= 1 ? $data["page"] : 1);
            $pager = new Pager(url("/pesquisarvagas/p/"));
            $pager->Pager($vacancyCount, 14, $page);

            $html = $this->view->render("/pageVacancy/componentListVacancy", [
                "userSystem" => (new SystemUser())->findById($this->user->id_user),
                "totalVacancy" => (new VwVacancy())
                    ->find($where, http_build_query($params))
                    ->limit($pager->limit())
                    ->offset($pager->offset())
                    ->order("date_open_vacancy", "DESC")->fetch(true),
                "countVacancy"=> $vacancyCount,
                "listEnterprise" => (new Vacancy())->listEnterpriseVacancy(),
                "paginator" => $pager->render()
            ]);   

            $json["html"] = $html;
            $json["content"] = "listVacancy";
            echo json_encode($json);
            return;
        }

        // Verifica se existe painel oculto ou não
        $checkPanelVacancy = (new Vacancy())->checkHidePanel();

        $vacancyCount = (new VwVacancy())->find()->count(); 
        $pager = new Pager(url("/pesquisarvagas/p/"));
        $pager->Pager($vacancyCount, 14, 1);

        echo $this->view->render("/pageVacancy/pageVacancy", [
            "title" => "Vagas",
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "totalVacancy" => (new VwVacancy())
                ->find()                
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("date_open_vacancy", "DESC")->fetch(true),
            "countVacancy"=> $vacancyCount,
            "listEnterprise" => (new Vacancy())->listEnterpriseVacancy(),
            "paginator" => $pager->render(),
            "checkPanelVacancy" => $checkPanelVacancy
        ]);
    }

    // Lista de vagas no painel de vagas do sidebar
    public function listVacancy(?array $data) : void
    {   
        if(isset($data["search-vacancy"]) || isset($data["search-enterprise"]) || isset($data["search-status"])) {
            
            $searchVacancy = isset($data["search-vacancy"]) ? filter_var($data["search-vacancy"], FILTER_SANITIZE_SPECIAL_CHARS) : null;
            $searchEnterprise = isset($data["search-enterprise"]) ? filter_var($data["search-enterprise"], FILTER_SANITIZE_SPECIAL_CHARS) : null;
            $searchStatus = isset($data["search-status"]) ? filter_var($data["search-status"], FILTER_SANITIZE_SPECIAL_CHARS) : null;

            $conditions = [];   
            $params = [];

            if(!empty($searchEnterprise)) {
                $conditions[] = "id_enterprise = :in";
                $params["in"] = $searchEnterprise; 
            }

            if(!empty($searchVacancy)) {
                $conditions[] = "nomeclatura_vacancy LIKE :n";
                $params["n"] = "%{$searchVacancy}%";
            }

            if($searchStatus === "Oculta") {
                if(!empty($searchStatus)) {
                    $conditions[] = "hide_vacancy = :s";
                    $params["s"] = 1;
                }
            } else {
                if(!empty($searchStatus)) {
                    $conditions[] = "status_vacancy = :s AND hide_vacancy <> 1";
                    $params["s"] = $searchStatus;
                }
            }


            $where = implode(" AND ", $conditions);

            $vacancy = (new VwVacancy())
                ->find($where, http_build_query($params))
                ->order("date_open_vacancy", "DESC")
                ->fetch(true);

            $vacancyCount = count($vacancy ?? []);

            $pager = new Pager(url("/pesquisarvagas/p/"));
            $pager->Pager($vacancyCount, 14, 1);

            $html = $this->view->render("/pageVacancy/componentListVacancy", [
                "userSystem" => (new SystemUser())->findById($this->user->id_user),
                "totalVacancy" => (new VwVacancy())
                    ->find($where, http_build_query($params))
                    ->order("date_open_vacancy", "DESC")
                    ->limit($pager->limit())
                    ->offset($pager->offset())
                    ->fetch(true),
                "countVacancy" => $vacancyCount,
                "paginator" => $pager->render()
            ]);

            $json["html"] = $html;
            echo json_encode($json);     
            return;
        }

        // Verifica se existe painel oculto ou não
        $checkPanelVacancy = (new Vacancy())->checkHidePanel();

        $vacancyCount = (new VwVacancy())->find()->count(); 
        $pager = new Pager(url("/pesquisarvagas/p/"));
        $pager->Pager($vacancyCount, 14, 1);

        $html = $this->view->render("/pageVacancy/listVacancy", [
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "totalVacancy" => (new VwVacancy())
                ->find()                
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("date_open_vacancy", "DESC")->fetch(true),
            "countVacancy"=> $vacancyCount,
            "listEnterprise" => (new Vacancy())->listEnterpriseVacancy(),
            "paginator" => $pager->render(),
            "checkPanelVacancy" => $checkPanelVacancy
        ]);
        
        $json["html"] = $html;
        echo json_encode($json);
        return;        
    }

    // Salvar e atualizar vaga
    public function addVacancy(?array $data) : void
    {

        if(!empty($data["csrf"])) {
         
            if(!csrf_verify($data)) {
                $json["message"] = messageHelpers()->warning("Use o formulário!")->render();
                $json["complete"] = false;
                echo json_encode($json);
                return;
            }

            // Verifica se o painel está oculto ou não
            $panelHide = (new Vacancy())->checkHidePanel() === 2 ? 1 : 0;

            // Verificar e sanitizar campos obrigatórios e não obrigatórios
            $dataClean = cleanInputData($data, ["description-vacancy", "request-vacancy"]);

            if (!$dataClean["valid"]) {
                $json["message"] = messageHelpers()->warning("Preencha todos os campos obrigatórios!")->render();
                $json["complete"] = false;
                echo json_encode($json);
                return;
            }

            $dataCleanOk = $dataClean["data"];

            if (!isset($data["number-vacancy"]) || !is_numeric($data["number-vacancy"]) || $data["number-vacancy"] < 1 ) {
                $json["message"] = messageHelpers()->warning("Verifique o campo número de vagas!")->render();
                $json["complete"] = false;
                echo json_encode($json);
                return;
            }
            
            if (!isset($data["quantity-per-vacancy"]) || !is_numeric($data["quantity-per-vacancy"]) || $data["quantity-per-vacancy"] < 1 ) {
                $json["message"] = messageHelpers()->warning("Verifique se a quantidades por vaga é válida!")->render();
                $json["complete"] = false;
                echo json_encode($json);
                return;
            }

            // Atualização de vagas
            if(isset($data["idvacancy"]) && !empty($data["idvacancy"])) {
                
                // Caso o usuário tente diminuir a quantidade de vagas, mas já tenha sido vínculados encaminhamentos a ela, impede a ação.
                $checkVacancyWorker = (new VacancyWorker())->checkVacancyWorker($dataCleanOk, true);
                if(!$checkVacancyWorker) {
                    $json["message"] = messageHelpers()->warning("A quantidade de vagas não pode ser menor que a quantidade já vínculada a trabalhadores!")->render();
                    echo json_encode($json);
                    return;
                }

                // Verifica se a quantidade de encaminhamentos por vagas é menor do que a quantidade de ecaminhamentos já solicitados
                $checkWorker = (new VacancyWorker())->checkVacancyWorker($dataCleanOk);
                if(!$checkWorker) {
                    $json["message"] = messageHelpers()->warning("A quantidade por vagas não pode ser menor do que a quantidade já vínculada a trabalhadores")->render();
                    echo json_encode($json);
                    return;
                }

                // Verifica se a vaga está oculto ou não
                $vacancyHide = (new Vacancy())->hideVacancyOnlyOne($data["idvacancy"]) === true ? 1 : 0;

                $dataCleanOk["hide-panel"] = $panelHide;
                $dataCleanOk["hide-vacancy"] = $vacancyHide;
                
                $updateVacancy = (new Vacancy())->updateVacancy($dataCleanOk["idvacancy"], $dataCleanOk ,$this->user->id_user);

                $json["message"] = messageHelpers()->success("Registro atualizado com sucesso!")->render();
                $json["complete"] = false;
                $json["updatetodo"] = true;
                echo json_encode($json);
                return;
            }

            // Criar vagas
            $vacancy = new Vacancy();
            $dataCleanOk["hide-panel"] = $panelHide;
            $createVacancys = $vacancy->createVacancy($dataCleanOk, $this->user->id_user);

            if(!$createVacancys){
                $json["message"] = messageHelpers()->warning("Verifique se o campo Nº de Vagas é válido!")->render();
                $json["complete"] = false;
                echo json_encode($json);
                return;
            }

            $json["message"] = messageHelpers()->success("Registro salvo com sucesso!")->render();
            $json["complete"] = true;
            echo json_encode($json);
            return;
        }

        if(isset($data["idvacancy"])) {
            $idVacancy = $data["idvacancy"];
        } else {
            $idVacancy = null;
        }


        $html = $this->view->render("/pageVacancy/formsNewVacancy", [
            "vacancy" => (new Vacancy())
                    ->find("id_vacancy = :id", "id={$idVacancy}")
                    ->fetch(),
            "companys" => (new Enterprise())
                ->find("active = :ac", "ac=Ativa")
                ->order("name_enterprise")
                ->fetch(true),
            "cbos_occupations" => (new CboOccupation())
                ->find()
                ->order("id_code")
                ->fetch(true)
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

    // Página de detalhe da vaga
    public function infoVacancy(?array $data) : void
    {   
        // Encerrar vagas
        if(isset($data["csrf"])) {

            $vacancyClosed = new Vacancy();
            $idFixed = filter_var($data["id-vacancy-fixed"], FILTER_SANITIZE_NUMBER_INT);

            if(empty($data["reason-closed"])) {
                $json["message"] = messageHelpers()->warning("Preenchao o motivo do encerramento!")->render();
                $json["complete"] = false;
                echo json_encode($json);
                return;
            }

            $count = 0;

            foreach($data as $key => $value) {
                if(str_contains($key, "check-vacancy-")) {
                    $vacancyClosed->closedVacancy((int)$value, (int)$idFixed, $data["reason-closed"]);
                    $count++;
                }                
            }

            $plur = $count > 1 ? "s" : "";

            $json["message"] = messageHelpers()->success("Vaga". $plur ."  encerrada". $plur ." com sucesso!")->render();

            $vacancyList = (new Vacancy())->find("id_vacancy_fixed = :id", "id={$idFixed}")->fetch(true);
            $vacancyInfo = (new VwVacancy())->find("id_vacancy = :id", "id={$idFixed}")->fetch();

            $pager = new Pager(url("/paginarvagas/p/{$idFixed}/"));
            $pager->Pager(count($vacancyList ?? []), 5, 1);

            $html = $this->view->render("/pageVacancy/componentListInfoVacancy", [
                "vacancyList" => (new Vacancy())
                    ->find("id_vacancy_fixed = :id", "id={$idFixed}")
                    ->limit($pager->limit())
                    ->offset($pager->offset())
                    ->fetch(true),
                "vacancyInfo" => $vacancyInfo,
                "countVacancy" => count($vacancyList ?? []),
                "paginator" => $pager->render()
            ]);

            $json["html"] = $html;
            echo json_encode($json);
            return;
        }

        // Paginar conteúdo
        if(isset($data["page"]) && !empty($data["page"])) {

        $searchStatus = filter_input(INPUT_GET, "search-status", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "search-status", FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $idVacancy = (int)filter_var($data["idvacancy"], FILTER_VALIDATE_INT);

        $conditions = [];
        $params = [];

        if(!empty($searchStatus)) {
            $conditions[] = "status_vacancy = :st";
            $params["st"] = $searchStatus;
        }

        $conditions[] = "id_vacancy_fixed = :id";
        $params["id"] = $idVacancy;

        $where = implode(" AND ", $conditions);

        
        $page = (!empty($data["page"]) && filter_var($data["page"], FILTER_VALIDATE_INT) >= 1 ? $data["page"] : 1);


        $vacancyListCount = count((new Vacancy())
            ->find($where, http_build_query($params))
            ->fetch(true)
            ?? []);
        
        $pager = new Pager(url("/paginarvagas/p/{$idVacancy}/"));
        $pager->Pager($vacancyListCount, 5, $page);
            
        $vacancyInfo = (new VwVacancy())->find("id_vacancy = :id", "id={$idVacancy}")->fetch();

        $html = $this->view->render("/pageVacancy/componentListInfoVacancy", [
            "vacancyList" => (new Vacancy())
                ->find($where, http_build_query($params))
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->fetch(true),
            "vacancyInfo" => $vacancyInfo,
            "countVacancy" => $vacancyListCount,
            "paginator" => $pager->render()
        ]);

        $json["html"] = $html;
        $json["content"] = "list-info-vacancy";
        echo json_encode($json);
        return;
        }

        $idVacancy = (int)filter_var($data["idvacancy"], FILTER_VALIDATE_INT);

        $vacancyListCount = count((new Vacancy())
            ->find("id_vacancy_fixed = :id", "id={$idVacancy}")
            ->fetch(true)
            ?? []);
        
        $pager = new Pager(url("/paginarvagas/p/{$idVacancy}/"));
        $pager->Pager($vacancyListCount, 5, 1);
            
        $vacancyInfo = (new VwVacancy())->find("id_vacancy = :id", "id={$idVacancy}")->fetch();

        $html = $this->view->render("/pageVacancy/infoVacancy", [
            "vacancyList" => (new Vacancy())
                ->find("id_vacancy_fixed = :id", "id={$idVacancy}")
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->fetch(true),
            "vacancyInfo" => $vacancyInfo,
            "countVacancy" => $vacancyListCount,
            "paginator" => $pager->render()
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

    // Pesquisar vaga no painel principal da página de vagas
    public function searchVacancy(array $data) : void
    {
        $status = filter_var($data["search-status"], FILTER_SANITIZE_SPECIAL_CHARS) ? filter_var($data["search-status"], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $idVacancy = filter_var($data["idvacancy"], FILTER_VALIDATE_INT);

        $conditions = [];
        $params = [];

        if(!empty($status)) {
            $conditions[] = "status_vacancy = :st";
            $params["st"] = $status;
        }

        $conditions[] = "id_vacancy_fixed = :id";
        $params["id"] = $idVacancy;

        $where = implode(" AND ", $conditions);

        
        $page = (!empty($data["page"]) && filter_var($data["page"], FILTER_VALIDATE_INT) >= 1 ? $data["page"] : 1);

        $vacancyListCount = count((new Vacancy())
            ->find($where, http_build_query($params))
            ->fetch(true)
            ?? []);
        
        $pager = new Pager(url("/paginarvagas/p/{$idVacancy}/"));
        $pager->Pager($vacancyListCount, 7, $page);
            
        $vacancyInfo = (new VwVacancy())->find("id_vacancy = :id", "id={$idVacancy}")->fetch();

        $html = $this->view->render("/pageVacancy/componentListInfoVacancy", [
            "vacancyList" => (new Vacancy())
                ->find($where, http_build_query($params))
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->fetch(true),
            "vacancyInfo" => $vacancyInfo,
            "countVacancy" => $vacancyListCount,
            "paginator" => $pager->render()
        ]);

        $json["html"] = $html;
        $json["content"] = "list-info-vacancy";
        echo json_encode($json);
        return;
    }
    
    /**
     * Enviar dados para javascript agendamento do dia e encerra no horário
     */
    public function todoClousureToday(?array $data) : void
    {
        if(isset($data) && !empty($data)) {
            $idFixedVacancy = filter_var($data["id"], FILTER_SANITIZE_NUMBER_INT);
            $executeClosedVacancy = (new Vacancy())->executeDateClousure($idFixedVacancy);
            return;
        }

        $checkDateClousure = (new Vacancy())->todoClousureToday();
        $arrayDateClousure = [];

        if($checkDateClousure) {
            $arrayDateClousure =  $checkDateClousure;
        }

        echo json_encode($arrayDateClousure);
    }

    /**
     * Modal para confirmar exclusão de vaga
     */
    public function questDeleteVacancy(array $data) : void
    {
        $idVacancy = (int)fncDecrypt($data["idvacancy"]);

        $vacancy = new Vacancy();
        $allVacancy = $vacancy->find("id_vacancy_fixed = :id","id={$idVacancy}")->fetch(true);

        $vacancyWorker = new VacancyWorker();
        $totalForWarfing = 0;

        // Verifica se existe encaminhamento para essa vaga, se retornar 0 não tem encaminhamento, se retorna mais de 0 então existe
        if(!$allVacancy) {
            $json["message"] = messageHelpers()->error("Error entre em contato com o administrador do sistema!")->render();
            echo json_encode($json);
            return;
        }
        
        foreach ($allVacancy as $allVacancyItem) {           
            $vacancyCount = $vacancyWorker->find("id_vacancy = :id", "id={$allVacancyItem->id_vacancy}")->fetch(true);
            $totalForWarfing += count($vacancyCount ?? []);
        }

        if($totalForWarfing > 0) {
            // Não pode excluir a vaga
            $delete = false;
            $textMessage = "Impossível excluir essa vaga, existem encaminhamentos destinados para ela!";
        } else {
            // Pode excluir a vaga
            $delete = true;
            $textMessage = "Tem certeza que deseja excluir essa vaga?";
        }
        
        $html = $this->view->render("/pageVacancy/questionDeleteVacancy", [
            "delete" => $delete,
            "textMessage" => $textMessage,
            "idVacancy" => $idVacancy
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

    // Confirmação de exclusão de vaga
    public function deleteVacancy(array $data) : void
    {
        $idVacancy = (int)fncDecrypt($data["idvacancy"]);

        if(empty($idVacancy) || $idVacancy === 0) {
            $json["message"] = messageHelpers()->warning("Erro de validação, atualize a página e tente novamente!")->render();
            echo json_encode($json);
            return;
        }
        
        $deleteVacancy = (new Vacancy())->deleteVacancy($idVacancy);
        if($deleteVacancy) {
            $json["message"] = messageHelpers()->success("Vagas excluída com sucesso!")->flash();
            $json["redirect"]= url("/vagas");
            echo json_encode($json);
            return;
        }

        $json["message"] = messageHelpers()->warning("Erro de exclusão!")->render();
        echo json_encode($json);
        return;
    }

    // Modal quest para ocultar e desocultar painel
    public function questHidePainel(array $data) : void
    {
        if((int)$data["hideyesno"] == 1) {
            $title = "Atenção!!!";
            $textMessage = "As vagas não serão vistas no painel impresso, na página inicial e nem será possível encaminhar trabalhadores para vagas!";
            $urlYes = url("/ocultarpainel");
        }

        if((int)$data["hideyesno"] == 2) {
            $title = "Atenção!!!";
            $textMessage = "As vagas serão vistas no painel de impressão, na página inicial e poderá ser encaminhado usuários para elas!";
            $urlYes = url("/mostrarpainel");
        }

        $html = $this->view->render("/modalQuest/modalQuestYesNo", [
            "title" => $title,
            "textMessage" => $textMessage,
            "urlYes" => $urlYes,
            "urlNo" => null,
            "cancel" => true
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

    // Confirmar ocultação do painel
    public function hidePanel() : void
    {
        $vacancy = new Vacancy();
        $vacancyHide = $vacancy->hidePanel();

        if(!$vacancyHide){
            $json["message"] = messageHelpers()->warning("Erro! Atualize a página e tente novamente!")->render();
            echo json_encode($json);
            return;
        }

        $json["message"] = messageHelpers()->success("Painel oculto com sucesso!")->flash();
        $json["redirect"] = url("/vagas");
        echo json_encode($json);
        return;
    }

    // Confirmar mostrar do painel
    public function noHidePanel() : void
    {
        $vacancy = new Vacancy();
        $vacancyHide = $vacancy->hidePanel(true);

        if(!$vacancyHide){
            $json["message"] = messageHelpers()->warning("Erro! Atualize a página e tente novamente!")->render();
            echo json_encode($json);
            return;
        }

        $json["message"] = messageHelpers()->success("Painel reativado com sucesso!")->flash();
        $json["redirect"] = url("/vagas");
        echo json_encode($json);
        return;
    }

    // Modal quest para ocultar e desocultar painel
    public function questHideVacancy(array $data) : void
    {
        // Modal para ocultar "tipo" = 1, modal para reativar "tipo" = 2
        if((int)$data["type"] == 1) {
            $title = "Atenção!!!";
            $textMessage = "A vaga não será vista no painel de impressão, na página inicial e não poderá ser encaminhada para trabalhadores.";
            $urlYes = url("/ocultarvaga/") . $data["idvacancy"];
        }

        if((int)$data["type"] == 2) {
            $title = "Atenção!!!";
            $textMessage = "A vaga será vista no painel de impressão, na página inicial e poderá ser encaminhada para trabalhadores.";
            $urlYes = url("/mostrarvaga/") . $data["idvacancy"];
        }

        $html = $this->view->render("/modalQuest/modalQuestYesNo", [
            "title" => $title,
            "textMessage" => $textMessage,
            "urlYes" => $urlYes,
            "urlNo" => null,
            "cancel" => true
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

    // Confirmar ocultação da vaga
    public function hideVacancy(array $data) : void
    {
        $vacancy = new Vacancy();
        $vacancyHide = $vacancy->hideVacancy($data["idvacancy"]);
        
        if(!$vacancyHide){
            $json["message"] = messageHelpers()->warning("Erro! Atualize a página e tente novamente!")->render();
            echo json_encode($json);
            return;
        }

        $json["message"] = messageHelpers()->success("Vaga oculta com sucesso!")->flash();
        $json["redirect"] = url("/vagas");
        echo json_encode($json);
        return;    
    }

    // Confirmar mostrar vaga
    public function noHideVacancy(array $data) 
    {
        $vacancy = new Vacancy();
        $vacancyHide = $vacancy->hideVacancy($data["idvacancy"], true);
        
        if(!$vacancyHide){
            $json["message"] = messageHelpers()->warning("Erro! Atualize a página e tente novamente!")->render();
            echo json_encode($json);
            return;
        }

        $json["message"] = messageHelpers()->success("Vaga reativada com sucesso!")->flash();
        $json["redirect"] = url("/vagas");
        echo json_encode($json);
        return;
    }

    // Modal de detalhe de encaminhamento de tralhador por vaga
    public function detailVacancyWorker(array $data) : void
    {
        $idVacancy = (int)fncDecrypt($data["idvacancy"]);
        $vwForwardingWorker = (new VwForwardingWorker())->find("id_vacancy = :id","id={$idVacancy}")->fetch(true);

        if(!$vwForwardingWorker) {
            $json["message"] = messageHelpers()->warning("Não há encaminhamentos de trabalhador para essa vaga!")->render();
            echo json_encode($json);
            return;
        }

        $totalVacancy = (new VwVacancy())->findById($vwForwardingWorker[0]->id_vacancy_fixed);
        $numberVacancy = $vwForwardingWorker[0]->number_vacancy;

        $orderVacancy = $numberVacancy . "/" . $totalVacancy->number_vacancy;
        $quantityPerVacancy = $totalVacancy->quantity_per_vacancy;
        $totalPerVacancy = count($vwForwardingWorker);

        $html = $this->view->render("/modalQuest/modalDetailVacancy", [
            "title" => " Detalhe de Encaminhamentos",
            "orderVacancy" => $orderVacancy,
            "quantityPerVacancy" => $quantityPerVacancy,
            "totalPerVacancy" => $totalPerVacancy,
            "vwForwardingWorker" => $vwForwardingWorker,
            "urlYes" => true,
            "urlNo" => true,
            "cancel" => true
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;   
    }

    // Modal de confirmação para reativar vaga
    public function questReactiveVacancy(array $data) : void 
    {
        $dataVacancyClosed = (new Vacancy())->findById(fncDecrypt($data["idvacancy"]));
        $dataClosed = new DateTime($dataVacancyClosed->date_closed_vacancy);
        $dataToday = new DateTime();
        $dataClosedUpdate =  false;
        $textMessage = "Você vai reativar uma vaga!";

        if($dataClosed <= $dataToday) { 
            $dataClosedUpdate = true;
            $textMessage = "Você precisa cadastrar uma data de encerramento maior que hoje!";
        }

        $html = $this->view->render("/modalQuest/modalReactiveVacancy", [
            "title" => "Atenção!!!",
            "textMessage" => $textMessage,
            "urlYes" => url("/confirmarreativarvagas/{$data["idvacancy"]}"),
            "dataClosedUpdate" => $dataClosedUpdate,
            "urlNo" => null,
            "cancel" => true
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

    // Confimar reativação da vaga
    public function reactiveVacancy(array $data) : void
    {   
        $date = null;
        if(isset($data["date-closed-new"])) {
            if(empty($data["date-closed-new"])) {
                $json["message"] = messageHelpers()->warning("Preencha o campo obrigatório (*) !")->render();
                echo json_encode($json);
                return;
            }

            $dateClosed = new DateTime($data["date-closed-new"]);
            $today =  new DateTime();

            if($dateClosed <= $today) {
                $json["message"] = messageHelpers()->warning("A data de encerramento deve ser maior que a data de hoje!")->render();
                echo json_encode($json);
                return;
            }

            $date = $data["date-closed-new"];
        }

        $idVacancy = (int)fncDecrypt($data["idvacancy"]);
        $vacancy = (new Vacancy())->reactiveAllVacancy($idVacancy, $date);

        if(!$vacancy) {
            $json["message"] = messageHelpers()->error("Atualize a página e tente novamente!", "Erro Crítico!!!")->render();
            echo json_encode($json);
            return;            
        }

        $json["message"] = messageHelpers()->success("Vaga reativada com sucesso!")->flash();
        $json["redirect"] = url("/vagas");
        echo json_encode($json);
        return;
    }

    // Sair do sistema
    public function logout()
    {
        (new Message())->success("Você saiu com sucesso " . Auth::user()->nome . ". Volte logo :)")->flash();    
        Auth::logout();
        redirect("/");
    }
}
