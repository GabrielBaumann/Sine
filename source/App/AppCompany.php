<?php

namespace Source\App;

use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

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

    // Página principal de empresas no sidebar
    public function startCompany(?array $data) : void
    {
        if(isset($data["page"])) {
            
            $searchCompany = filter_input(INPUT_GET, "search-company", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "search-company", FILTER_SANITIZE_SPECIAL_CHARS) : null;
            $searchAllStatus = filter_input(INPUT_GET, "search-all-status", FILTER_SANITIZE_SPECIAL_CHARS) ? filter_input(INPUT_GET, "search-all-status", FILTER_SANITIZE_SPECIAL_CHARS) : null;

            $conditions = [];
            $params = [];

            if(!empty($searchCompany)) {
                $conditions[] = "name_enterprise LIKE :co OR name_fantasy_enterpise LIKE :co OR cnpj_cpf LIKE :co";
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
            $pager->Pager($enterprise, 12, $page);

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
        $pager->Pager($enterprise, 12, 1);

        echo $this->view->render("/pageCompany/pageCompany", [
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

    //Pesquisa de empresas renderizando Lista de empresas na página inicial
    public function listCompany(?array $data) : void
    {
        if(isset($data["search-company"]) || isset($data["search-all-status"])) {

            $searchCompany = isset($data["search-company"]) ? filter_var($data["search-company"], FILTER_SANITIZE_SPECIAL_CHARS) : null;
            $searchStatus = isset($data["search-all-status"]) ? filter_var($data["search-all-status"], FILTER_SANITIZE_SPECIAL_CHARS) : null;

            $conditions = [];
            $params = [];

            if(!empty($searchCompany)) {
                $conditions[] = "name_enterprise LIKE :co OR name_fantasy_enterpise LIKE :co OR cnpj_cpf LIKE :co";
                $params["co"] = "%{$searchCompany}%";
            }
            
            if(!empty($searchStatus)) {
                $conditions[] = "active = :a";
                $params["a"] = $searchStatus;
            }

            $where = implode(" AND ", $conditions);

            $company = (new Enterprise())->find($where, http_build_query($params))->fetch(true);
            
            $companyCount = count($company ?? []);

            $pager = new Pager(url("/pesquisarempresa/p/"));
            $pager->Pager($companyCount, 12, 1);

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
        $pager->Pager($enterprise, 12, 1);

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

            if(isset($data["type_document"])) {
                unset($data["cnpj"]);
            } else {
                unset($data["cpf"]);
                $data["type_document"] = "cnpj";
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

            if($dataCleanInput["type_document"] == "CPF") {
                $document = cleanCPF($dataCleanInput["cpf"]);
            } else {
                $document = cleanCPF($dataCleanInput["cnpj"]);
            }            

            $enterprise->name_enterprise = $dataCleanInput["new-enterprise"];
            $enterprise->name_fantasy_enterpise = $dataCleanInput["name-fantasy"];
            $enterprise->cnpj_cpf = $document;
            $enterprise->type_document = $dataCleanInput["type_document"];
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
        $pager->Pager($enterprise, 12, 1);

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

        if(isset($data["cnpj"]) && !empty($data["cnpj"])) {
            // Verificação para CNPJ
            $cnpj = filter_var($data["cnpj"], FILTER_VALIDATE_INT);

            if (!validateCNPJ($data["cnpj"])) {
                $json["message"] = messageHelpers()->warning("O número de CNPJ não é válido!")->render();
                echo json_encode($json);
                return;
            }
            
            if(isset($data["idCompany"]) && !empty($data["cnpj"])){
                
                $idCompany = filter_var($data["idCompany"], FILTER_VALIDATE_INT);
                $enterpriseCnpj = $enterprise->find("cnpj_cpf = :cn AND id_enterprise <> :id", "cn={$cnpj}&id={$idCompany}")->fetch();

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
        } else {
            // Verificação para CPF
            $cpf = filter_var($data["cpf"], FILTER_VALIDATE_INT);

            if (!validateCPF($data["cpf"])) {
                $json["message"] = messageHelpers()->warning("O número de CPF não é válido!")->render();
                echo json_encode($json);
                return;
            }
            
            if(isset($data["idCompany"]) && !empty($data["cpf"])){
                
                $idCompany = filter_var($data["idCompany"], FILTER_VALIDATE_INT);
                $enterpriseCpf = $enterprise->find("cnpj_cpf = :cn AND id_enterprise <> :id AND type_document = :ty", "cn={$cpf}&id={$idCompany}&ty=CPF")->fetch();

                if ($enterpriseCpf) {
                    $json["message"] = messageHelpers()->warning("O CPF: ". formatCPF($cpf) . " já está cadastrado na base!")->render();
                    echo json_encode($json);
                    return;
                }
                
                $json["message"] = "";
                $json["complete"] = true;
                echo json_encode($json);
                return;
            }
            
            if ($enterprise->getByCnpj($data["cpf"])) {
                $json["message"] = messageHelpers()->warning("O CPF: ". formatCPF($data["cpf"]) . " já está cadastrado na base!")->render();
                echo json_encode($json);
                return;
            }
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
        $pager->Pager($enterprise, 12, 1);

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

    // Baixar lista de empresas
    public function downloadExcelCompany() : void
    {
        $forgetcterc = new Enterprise();
        $dataCterc = $forgetcterc->find()->fetch(true);


        if(!$dataCterc) {
            header("Content-Type: application/json; charset=UTF-8");
            $json["message"] = messageHelpers("Não há dados para baixar!")->render();
            echo json_encode($json);
            return;
        }

        // // Criar planilha
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle("Empresas");

        // Mesclar células da primeira linha
        $sheet->mergeCells("A1:G1");

        // Definir título
        $sheet->setCellValue("A1", "PLANILHA DE EMPRESAS CADASTRADAS");
        $sheet->getStyle("A1")->applyFromArray([
            "font" => [
                "bold" => true,
                "size" => 14,
            ],
            "alignment" => [
                "horizontal" => Alignment::HORIZONTAL_CENTER,
                "vertical" => Alignment::VERTICAL_CENTER,
            ],
            "fill" => [
                "fillType" => Fill::FILL_SOLID,
                "startColor" => ["rgb" => "B0C4DE"],
            ],
        ]);

        // Cabeçalhos
        $sheet->setCellValue("A2", "RAZÃO SOCIAL");
        $sheet->setCellValue("B2", "NOME FANTASIA");
        $sheet->setCellValue("C2", "CNPJ");
        $sheet->setCellValue("D2", "RESPONSÁVEL");
        $sheet->setCellValue("E2", "EMAIL");
        $sheet->setCellValue("F2", "TELEFONE");
        $sheet->setCellValue("G2", "OBSERVAÇÃO");

        $sheet->getStyle("A2:G2")->applyFromArray([
            "font" => [
                "bold" => true,
                "size" => 12,
            ],
            "alignment" => [
                "horizontal" => Alignment::HORIZONTAL_CENTER,
                "vertical" => Alignment::VERTICAL_CENTER,
            ],
            "fill" => [
                "fillType" => Fill::FILL_SOLID,
                "startColor" => ["rgb" => "EEEEEE"]
            ]
        ]);

        // Dados
        $cont = 3;
        foreach($dataCterc as $dataCtercItem) {

            $sheet->setCellValue("A{$cont}", $dataCtercItem->name_enterprise);
            $sheet->setCellValue("B{$cont}", $dataCtercItem->name_fantasy_enterpise);
            $sheet->setCellValueExplicit("C{$cont}", $dataCtercItem->cnpj_cpf, DataType::TYPE_STRING);
            $sheet->setCellValue("D{$cont}", $dataCtercItem->responsible_enterprise);
            $sheet->setCellValue("E{$cont}", $dataCtercItem->email_enterprise);
            $sheet->setCellValue("F{$cont}", mask_phone($dataCtercItem->phone_enterprise));
            $sheet->setCellValue("G{$cont}", $dataCtercItem->observation_enterprise);
            $cont ++;
        }

        $lastLine = $cont - 1;
        $step = "A1:G{$lastLine}";

        $sheet->getStyle($step)->applyFromArray([
            "borders" => [
                "allBorders" => [
                    "borderStyle" => Border::BORDER_THIN,
                    "color" => ["rgb" => "000000"],
                ],
            ],
        ]);

        // Ajuste automático de largura
        foreach(range("A", "G") as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Preparar download
        $filename = "Empresas Cadastradas_" . date_simple(date("Y-m-d")) . ".xlsx";

        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Cache-Control: max-age=0");
        
        // Enviar arquivo
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
        return; 
    }

}
