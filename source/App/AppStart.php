<?php

namespace Source\App;

use DateTime;
use IntlDateFormatter;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\CboOccupation;
use Source\Models\Enterprise;
use Source\Models\Service;
use Source\Models\Worker;
use Source\Models\SystemUser;
use Source\Models\Views\VwVacancy;
use Source\Support\Pager;

use Source\Models\Vacancy;
use Source\Models\Views\VwVacancyActive;

class AppStart extends Controller
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

    // Página principal de vagas no sidebar
    public function startPage() : void
    {   
        // Encerrar vagas já passadas
        $closetVacancyOld = new Vacancy();
        $closetVacancyOld->checkdDateClousure();

        // Gráfico de atendimentos
        $serve = new Service();
        $charServer = $serve->charService();
        // $charServer = $serve->charDay();

        // Painel de vagas
        $vwVacancy = new VwVacancy();
        $panelVancancy = $vwVacancy->find("total_vacancy_active <> :to AND hide_panel <> :hi","to=0&hi=1")
            ->order("date_open_vacancy", "DESC")
            ->fetch(true);

        $pager = new Pager(url("/painelvagas/p/"));
        $pager->pager(count($panelVancancy ?? []), 12, 1);

        // Total de vagas ativas 
        $totalVacancyActive = $vwVacancy->find("number_vacancy <> :to AND hide_panel <> :hi","to=0&hi=1", "(SELECT sum(number_vacancy)) AS total")->order("nomeclatura_vacancy")->fetch();

        echo $this->view->render("/pageStart/pageStart", [
            "title" => "Início",
            "workerCount" => (new Worker())->find()->count(),
            "vavancysCount" => $totalVacancyActive->total,
            "enterprisesCount" => (new Enterprise())->find()->count(),
            "serviceCount" => (new Service())->find()->count(),
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "chartServiceLabel" => $charServer["label"],
            "chartServiceTotal" => $charServer["total"],
            "panelVacancy" =>  (new VwVacancy())
                ->find("total_vacancy_active <> :to AND hide_panel <> :hi","to=0&hi=1")
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("date_open_vacancy", "DESC")
                ->fetch(true),
            "paginator" => $pager->render()
        ]);
    }

    // Painél direito de vagas na página principal
    public function panelVacancy(?array $data) : void
    {
        $versionPanel = (int)$data["versionpanel"];

        if($versionPanel === 0) {

        } else {

        }

        $vwVacancy = new VwVacancy();
        $panelVancancy = $vwVacancy->find("total_vacancy_active <> :to AND hide_panel <> :hi","to=0&hi=1")
            ->order("date_open_vacancy")
            ->fetch(true);

        $page = (!empty($data["page"]) && filter_var($data["page"], FILTER_VALIDATE_INT) >= 1 ? $data["page"] : 1);
        $pager = new Pager(url("/painelvagas/p/"));
        $pager->pager(count($panelVancancy ?? []), 12, $page);

        $html = $this->view->render("/pageStart/panelVacancy", [
            "panelVacancy" =>  (new VwVacancy())
                ->find("total_vacancy_active <> :to AND hide_panel <> :hi","to=0&hi=1")
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("date_open_vacancy", "DESC")
                ->fetch(true),
            "paginator" => $pager->render()
        ]);
        
        $json["html"] = $html;
        $json["content"] = "panel-vacancy";
        echo json_encode($json);
        return;
    }

    // Download do painél de vagas em PDF e JPG
    public function printPanel(?array $data) : void
    {
        $vwVacancy = (new VwVacancyActive())->find()->fetch(true);

        // Quando não existir vagas ativas
        if(!$vwVacancy) {
            $json["message"] = messageHelpers()->warning("Não há vagas no painel!")->render();
            echo json_encode($json);            
            return;
        }

        // Verifica se o painel está oculto
        $checkHidePanel = (new Vacancy())->checkHidePanel();

        if($checkHidePanel == 2) {
            $json["message"] = messageHelpers()->warning("O painel está oculto!")->render();
            echo json_encode($json);            
            return;
        }

        // Versão do painel de vaga, se for igual a 0 pega todas as vagas ativas de dias passados, se for 01 em diante as vagas do dia atual
        $versionPanel = (int)$data["versionPainel"];
        
        if($versionPanel === 0) {
        
            $today = new DateTime();
            $panelVacancy = (new VwVacancy())
                ->find("total_vacancy_active <> :to AND DATE(date_register) < :date","to=0&date={$today->format('Y-m-d')}")
                ->order("date_open_vacancy", "DESC")
                ->fetch(true);
        } else {

            $today = new DateTime();
            $panelVacancy = (new VwVacancy())
            ->find("total_vacancy_active <> :to AND version_panel = :ve AND DATE(date_register) = :date","to=0&ve={$versionPanel}&date={$today->format('Y-m-d')}")
            ->order("date_open_vacancy", "DESC")
            ->fetch(true);

            if(!$panelVacancy) {
                $json["message"] = messageHelpers()->warning("Não há vagas para essa versão do painel!")->render();
                echo json_encode($json);            
                return;
            }

        }

        $html = $this->view->render("/pageStart/printingPainel", [
            "panelVacancy" =>  $panelVacancy
        ]);
        
        $json["html"] = $html;
        $json["content"] = "panel-vacancy";
        echo json_encode($json);
        return;    
    }

    // Download do painél interno
    public function printPanelInternal(?array $data) : void
    {
        $vwVacancy = (new VwVacancyActive())->find()->fetch(true);

        // Quando não existir vagas ativas
        if(!$vwVacancy) {
            $json["message"] = messageHelpers()->warning("Não há vagas no painél!")->render();
            echo json_encode($json);            
            return;
        }

        // Verifica se o painel está oculto
        $checkHidePanel = (new Vacancy())->checkHidePanel();

        if($checkHidePanel == 2) {
            $json["message"] = messageHelpers()->warning("O painel está oculto!")->render();
            echo json_encode($json);            
            return;
        }

        // Versão do painel de vaga, se for igual a 0 pega todas as vagas ativas de dias passados, se for 01 em diante as vagas do dia atual
        $versionPanel = (int)$data["versionPainel"];
        
        if($versionPanel === 0) {
        
        $today = new DateTime();
        
        $panelVacancy = (new VwVacancy())
            ->find("total_vacancy_active <> :to AND DATE(date_register) < :date","to=0&date={$today->format('Y-m-d')}")
            ->order("date_open_vacancy", "DESC")
            ->fetch(true);
        } else {

            $today = new DateTime();
            $panelVacancy = (new VwVacancy())
            ->find("total_vacancy_active <> :to AND version_panel = :ve AND DATE(date_register) = :date","to=0&ve={$versionPanel}&date={$today->format('Y-m-d')}")
            ->order("date_open_vacancy", "DESC")
            ->fetch(true);

            if(!$panelVacancy) {
                $json["message"] = messageHelpers()->warning("Não há vagas para essa versão do painel!")->render();
                echo json_encode($json);            
                return;
            }

        }

        $html = $this->view->render("/pageStart/printingInternalVacancy", [
            "panelVacancy" =>  $panelVacancy
        ]);
        
        $json["html"] = $html;
        $json["content"] = "panel-vacancy";
        echo json_encode($json);
        return;    
    }

    // Baixar o painél de vagas em word
    public function reportDownloadWord($data) : void
    {
        $formatterDate = new IntlDateFormatter(
            'pt_BR',
            IntlDateFormatter::FULL,
            IntlDateFormatter::SHORT,
            null,
            IntlDateFormatter::GREGORIAN,
            "EEEE, dd/MM/yyyy - HH:mm a"
        );

        $dataFormated = $formatterDate->format(new DateTime());

        $dataFormatCorrect = preg_replace_callback('/([ap]m)$/i', function ($m) {
            return mb_strtoupper($m[1]); // transforma em AM ou PM
        }, ucwords(str_replace('-feira', '-Feira', $dataFormated)));

        ob_start();
        $vwVacancy = (new VwVacancy())
            ->find("total_vacancy_active <> :to","to=0")
            ->order("nomeclatura_vacancy")
            ->fetch(true);

        $newWord = new PhpWord();
        
        // ========= Margens ============
        $section = $newWord->addSection([
            "marginTop" => 2500,
            "marginBottom" => 1000,
            "marginLeft" => 238,
            "marginRight" => 244,
            "headerHeight" => 350,
            "distanceHeader" => 0,
            "footerHeight" => 100,
            "distanceFooter" => 0
        ]);

        // ========= CABEÇALHO SUPERIOR =========
        $header = $section->addHeader();

        $headerText = $header->addTextRun(['alignment' => Jc::CENTER]);
        $headerText->addText("Canaã dos Carajás-PA", ["bold" => true, "color" => "2e7d32", "size" =>14]);
        $headerText->addText('                                '. $dataFormatCorrect, ["bold" => true, "color" => "2e7d32", "size" => 14]);

        // ========== LOGO linha colorida ================
        $logoLine = __DIR__ . "/../../themes/sineapp/assets/images/line-sine.png";

        if (file_exists($logoLine)) {
            $header->addImage($logoLine, [
                "width" => 550,
                "alignment" => Jc::CENTER,
            ]);
        }

        // ========== LOGO SINE E TÍTULO ================
        $logoPath = __DIR__ . "/../../themes/sineapp/assets/images/logo-nacional.png";

        if (file_exists($logoPath)) {
            $header->addImage($logoPath, [
                "width" => 150,
                "alignment" => Jc::CENTER
            ]);
        }

        // =========== RODAPÉ ============
        $foot = $section->addFooter();

        $footer = $foot->addTextRun(['alignment' => Jc::CENTER]);
        $footer->addText("Avenida JK, N° 104, Vale Dourado - CEP: 68.534-149\n", ['size' => 10, 'color' => '666666']);
        $footer->addTextBreak(1);
        $footer->addText("Tel. (94) 99123-5373\n", ['size' => 10, 'color' => '666666']);
        $footer->addTextBreak(1);
        $footer->addText("Canaã dos Carajás - PA", ['size' => 10, 'color' => '666666']);

        // Corpo do texto
        $section->addText("Painel de vagas", ["bold" => true, "size" => 14, "color" => "2e7d32"], ["alignment" => Jc::CENTER]);
   
        // ========== Tabela =========
        $newWord->addTableStyle("PainelVagas", [
            "borderSize" => 6,
            "borderColor" => "#e7dfdf",
            "cellMargin" => 80,
            "alignment" => JC::CENTER
        ]);

        $table = $section->addTable("PainelVagas");

        // Estilo de célula
        $cellHeaderStyle = ["bgColor" => "6fac45", "valign" => "center"];
        $cellBodyStyle = ["valign" => "center"];

        $center = [
            "alignment" => Jc::CENTER,
            "spaceAfter" => 0,
            "spaceBefore" => 0,
            "lineSpacing" => 1.0
        ];

        $justify = [
            "alignment" => Jc::BOTH,
            "spaceAfter" => 0,
            "spaceBefore" => 0,
            "lineSpacing" => 1.0
        ];

        $whiteText = ["bold" => true, "color" => "ffffff"];

        $heightPage = 13088;
        $heightCurrent = 800;

        $table->addRow(650);
        $table->addCell(3000, $cellHeaderStyle)->addText("VAGA", $whiteText, $center);
        $table->addCell(1000, $cellHeaderStyle)->addText("QT", $whiteText, $center);
        $table->addCell(6000, $cellHeaderStyle)->addText("DESCRIÇÃO DA VAGA", $whiteText, $center);

        foreach ($vwVacancy as $vwVacancyItem) {
            $lineHeight = estimateHeightLine($vwVacancyItem->description_vacancy);

            // Se ultrapassar altura útil da página, cria nova seção e reinicia a tabela
            if ($heightCurrent + $lineHeight > $heightPage) {
                
                $section = $newWord->addSection([
                    "marginTop" => 2500,
                    "marginBottom" => 1000,
                    "marginLeft" => 238,
                    "marginRight" => 244,
                    "headerHeight" => 350,
                    "distanceHeader" => 0,
                    "footerHeight" => 100,
                    "distanceFooter" => 0
                ]);

                // Corpo do texto
                $section->addText("Painel de vagas", ["bold" => true, "size" => 14, "color" => "2e7d32"], ["alignment" => Jc::CENTER]);

                // Recria o cabeçalho da tabela
                $table = $section->addTable("PainelVagas");
                $table->addRow(650);
                $table->addCell(3000, $cellHeaderStyle)->addText("VAGA", $whiteText, $center);
                $table->addCell(1000, $cellHeaderStyle)->addText("QT", $whiteText, $center);
                $table->addCell(6000, $cellHeaderStyle)->addText("DESCRIÇÃO DA VAGA", $whiteText, $center);
                $heightCurrent = 800;
            }

            // Adicionar linha da vaga
            $table->addRow();
            $heightCurrent += $lineHeight;

            $table->addCell(3000, $cellBodyStyle)->addText(
                mb_strtoupper($vwVacancyItem->nomeclatura_vacancy),
                ["bold" => true],
                $center
            );
            $table->addCell(1000, $cellBodyStyle)->addText(
                (string)$vwVacancyItem->total_vacancy_active,
                ["bold" => true],
                $center
            );
            $table->addCell(6000, $cellBodyStyle)->addText(
                $vwVacancyItem->description_vacancy,
                [],
                $justify
            );
        }

        // ==== DOWNLOAD ====
        ob_clean();
        
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="painel_de_vagas.docx"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        $writer = IOFactory::createWriter($newWord, 'Word2007');
        $writer->save("php://output");
        exit;
    }
}