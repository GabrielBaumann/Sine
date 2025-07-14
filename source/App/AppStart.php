<?php

namespace Source\App;

use PhpOffice\PhpWord\Style\Cell;
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
        ob_start();
        $vwVacancy = (new VwVacancy())->find("total_vacancy_active <> :to","to=0")->order("nomeclatura_vacancy")->fetch(true);

        $newWord = new PhpWord();

        $section = $newWord->addSection([
            "marginTop" => 720,
            "marginBottom" => 720,
            "marginLeft" => 720,
            "marginRight" => 720,
        ]);


        // Logo


        // Título
        $section->addText(
            "Painel de Vagas",
            ["bold" => true, "size" => 18, "color" => "2e7d32"],
            ["alignment" => "center"]
        );

        // Tabela
        $newWord->addTableStyle("TabelaVagas", [
            "borderSize" => 6,
            "borderColor" => "999999",
            "callMargin" => 50,
        ]);

        $table = $section->addTable("TabelaVagas");

        // Estilos de célula
        $cellValignCenter = ["valign" => Cell::];

        // Estilo de parágrafo (alinhamento horizontal)
        $paraAlignCenter = ['alignment' => Jc::CENTER];

        // Cabeçalhos
        $table->addRow();
        $table->addCell(3000)->addText("Vaga", ["bold" => true], ["alignment" => "center"]);
        $table->addCell(1000)->addText("QT", ["bold" => true], ["alignment" => "center"]);
        $table->addCell(6000)->addText("Descrição da Vaga", ["bold" => true], ["alignment" => "center"]);

        // Dados
        foreach($vwVacancy as $vwVacancyItem) {
            $table->addRow();
            $table->addCell(3000)->addText($vwVacancyItem->nomeclatura_vacancy);
            $table->addCell(1000)->addText($vwVacancyItem->total_vacancy_active);
            $table->addCell(6000)->addText($vwVacancyItem->description_vacancy);
        }

        // Rodapé
        $section->addTextBreak(2);
        $section->addText(
            "Avenida JK, N° 104, Vale Dourado - CEP: 68.534-149\nTel. (94) 99123-5373\nCanaã dos Carajás - PA",
            ['italic' => true, 'size' => 10],
            ['alignment' => 'center']
        );

        // Enviar como download
        ob_clean();
        $fileName = "painel_de_vagas.docx";
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename={$fileName}");
        header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");

        $writer = IOFactory::createWriter($newWord, "Word2007");
        $writer->save("php://output");
        exit;
    }
}