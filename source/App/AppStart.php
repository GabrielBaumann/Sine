<?php

namespace Source\App;

use DateTime;
use IntlDateFormatter;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\Enterprise;
use Source\Models\Service;
use Source\Models\Worker;
use Source\Models\SystemUser;
use Source\Models\Views\VwVacancy;
use Source\Support\Pager;

use Source\Models\CboOccupation;
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

    public function startPage() : void
    {   
        // Gráfico de atendimentos
        $serve = new Service();
        $charServer = $serve->charService();

        // Painel de vagas
        $vwVacancy = new VwVacancy();
        $panelVancancy = $vwVacancy->find("total_vacancy_active <> :to","to=0")
            ->order("nomeclatura_vacancy")
            ->fetch(true);

        $pager = new Pager(url("/painelvagas/p/"));
        $pager->pager(count($panelVancancy ?? []), 7, 1);

        // Total de vagas ativas 
        $totalVacancyActive = $vwVacancy->find("total_vacancy_active <> :to","to=0", "(SELECT sum(total_vacancy_active)) AS total")->order("nomeclatura_vacancy")->fetch();

        echo $this->view->render("/pageStart", [
            "title" => "Início",
            "workerCount" => (new Worker())->find()->count(),
            "vavancysCount" => $totalVacancyActive->total,
            "enterprisesCount" => (new Enterprise())->find()->count(),
            "serviceCount" => (new Service())->find()->count(),
            "userSystem" => (new SystemUser())->findById($this->user->id_user),
            "chartServiceLabel" => $charServer["label"],
            "chartServiceTotal" => $charServer["total"],
            "panelVacancy" =>  (new VwVacancy())
                ->find("total_vacancy_active <> :to","to=0")
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("name_enterprise")
                ->fetch(true),
            "paginator" => $pager->render()
        ]);
    }

    public function panelVacancy(?array $data) : void
    {
        $vwVacancy = new VwVacancy();
        $panelVancancy = $vwVacancy->find("total_vacancy_active <> :to","to=0")
            ->order("nomeclatura_vacancy")
            ->fetch(true);

        $page = (!empty($data["page"]) && filter_var($data["page"], FILTER_VALIDATE_INT) >= 1 ? $data["page"] : 1);
        $pager = new Pager(url("/painelvagas/p/"));
        $pager->pager(count($panelVancancy ?? []), 7, $page);

        $html = $this->view->render("/pageStart/panelVacancy", [
            "panelVacancy" =>  (new VwVacancy())
                ->find("total_vacancy_active <> :to","to=0")
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("name_enterprise")
                ->fetch(true),
            "paginator" => $pager->render()
        ]);
        
        $json["html"] = $html;
        $json["content"] = "panel-vacancy";
        echo json_encode($json);
        return;
    }

    public function printPanel() : void
    {
        $vwVacancy = (new VwVacancyActive())->find()->fetch(true);

        if(!$vwVacancy) {
            $json["message"] = messageHelpers()->warning("Não há vagas no painél!")->render();
            echo json_encode($json);            
            return;
        }

        $html = $this->view->render("/layout_printing", [
            "panelVacancy" =>  (new VwVacancy())
                ->find("total_vacancy_active <> :to","to=0")
                ->order("nomeclatura_vacancy")
                ->fetch(true)
        ]);
        
        $json["html"] = $html;
        $json["content"] = "panel-vacancy";
        echo json_encode($json);
        return;    
    }

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

        ob_start();
        $vwVacancy = (new VwVacancy())->find("total_vacancy_active <> :to","to=0")->order("nomeclatura_vacancy")->fetch(true);

        $newWord = new PhpWord();
        
        // ========= Margens ============
        $section = $newWord->addSection([
            "marginTop" => 238,
            "marginBottom" => 238,
            "marginLeft" => 238,
            "marginRight" => 244,
            "color" => "red"
        ]);

        // ========= CABEÇALHO SUPERIOR =========
        $header = $section->addTextRun(['alignment' => Jc::CENTER]);
        $header->addText("CANAÃ DOS CARAJÁS", ["bold" => true, "color" => "2e7d32", "size" =>14]);
        $header->addText(strtoupper('           ' . $dataFormated), ["bold" => true, "color" => "2e7d32", "size" => 14]);


        // ========== LOGO linha colorida ================
        $logoLine = __DIR__ . "/../../themes/sineapp/assets/images/line-sine.png";

        if (file_exists($logoLine)) {
            $section->addImage($logoLine, [
                "width" => 500,
                "alignment" => Jc::CENTER
            ]);
        }

        // ========== LOGO SINE E TÍTULO ================
        $logoPath = __DIR__ . "/../../themes/sineapp/assets/images/logo-nacional.png";

        if (file_exists($logoPath)) {
            $section->addImage($logoPath, [
                "width" => 200,
                "alignment" => Jc::CENTER
            ]);
        }

        $section->addText("Painel de vagas", ["bold" => true, "size" => 14, "color" => "2e7d32"], ["alignment" => Jc::CENTER]);
        $section->addTextBreak(1);        


        // ========== Tabela =========
        $newWord->addTableStyle("PainelVagas", [
            "borderSize" => 6,
            "borderColor" => "999999",
            "cellMargin" => 80,
            "valign" => "center"
        ]);

        $table = $section->addTable("PainelVagas");

        // Estilo de célula
        $cellHeaderStyle = ["bgColor" => "2e7d32", "valign" => "center"];
        $cellBodyStyle = ["valign" => "center"];

        $center = ["alignment" => Jc::CENTER];
        $justify = ["alignment" => Jc::BOTH];
        $whiteText = ["bold" => true, "color" => "ffffff"];

        // Cabeçalho da tabela
        $table->addRow();
        $table->addCell(3000, $cellHeaderStyle)->addText("VAGA", $whiteText, $center);
        $table->addCell(1000, $cellHeaderStyle)->addText("QT", $whiteText, $center);
        $table->addCell(6000, $cellHeaderStyle)->addText("DESCRIÇÃO DA VAGA", $whiteText, $center);


        foreach ($vwVacancy as $vwVacancyItem) {
            $table->addRow();
            $table->addCell(3000, $cellBodyStyle)->addText(
                mb_strtoupper($vwVacancyItem->nomeclatura_vacancy),
                ["bold" => true],
                $center
            );
            $table->addCell(1000, $cellBodyStyle)->addText(
                (string)$vwVacancyItem->total_vacancy_active,
                [],
                $center
            );
            $table->addCell(6000, $cellBodyStyle)->addText(
                $vwVacancyItem->description_vacancy,
                [],
                $justify
            );
        }

        $section->addTextBreak(2);

        // =========== RODAPÉ ============
        $footer = $section->addTextRun(['alignment' => Jc::CENTER]);
        $footer->addText("Avenida JK, N° 104, Vale Dourado - CEP: 68.534-149\n", ['size' => 10, 'color' => '666666']);
        $footer->addText("Tel. (94) 99123-5373\n", ['size' => 10, 'color' => '666666']);
        $footer->addText("Canaã dos Carajás - PA", ['size' => 10, 'color' => '666666']);

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