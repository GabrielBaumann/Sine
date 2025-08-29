<?php

namespace Source\Models;

// use DateInvalidTimeZoneException;
use DateTime;
// use Exception;
use Source\Core\Model;
use Source\Models\VacancyWorker;
use Source\Models\Views\VwVacancy;
// use Source\Models\Views\VwVacancyActive;

class Vacancy extends Model
{   
    public function __construct()
    {
        parent::__construct(
            "vacancy", ["id_vacancy"], [],
            "id_vacancy"
        );
    }

    /**
     * Função para cadastrar vagas e criar vaga espelho e vaga fixas
     */
    public function createVacancy(array $data, int $userId) : bool
    {
        if (!isset($data["number-vacancy"]) || !is_numeric($data["number-vacancy"]) || $data["number-vacancy"] < 1 ) {
            return false;
        }
        $accepCurriculum = isset($data["curriculum-vacancy"]) ? $data["curriculum-vacancy"] : 0;

        $this->id_enterprise = $data["enterprise"];
        $this->id_cod_cbo = $data["cbo-occupation"];
        $this->apprentice_vacancy = $data["apprentice-vacancy"];
        $this->gender_vacancy = $data["gender"];
        $this->number_vacancy = $data["number-vacancy"];
        $this->pcd_vacancy = $data["pcd-vacancy"];
        $this->quantity_per_vacancy = $data["quantity-per-vacancy"];
        $this->date_open_vacancy = $data["date-open-vacancy"];
        $this->date_closed_vacancy = $data["date-close-vacancy"];
        $this->education_vacancy = $data["education-vacancy"];
        $this->age_min_vacancy = $data["age-min-vacancy"];
        $this->age_max_vacancy = $data["age-max-vacancy"];
        $this->exp_vacancy = $data["exp-vacancy"];
        $this->description_vacancy = $data["description-vacancy"];
        $this->nomeclatura_vacancy = $data["nomeclatura-vacancy"];
        $this->accept_curriculum = $accepCurriculum;
        $this->request_vacancy = $data["request-vacancy"];
        $this->version_panel = $data["version-panel"];
        $this->hide_panel = $data["hide-panel"];
        $this->id_user_register = $userId;

        $this->save();
        
        $idFixedVacancy = $this->id_vacancy;
        $totalNumberVacancy = $data["number-vacancy"];

        for($i = 1; $i < $totalNumberVacancy + 1 ; $i++) {

            $vacancy = new static();

            $vacancy->id_vacancy_fixed = $idFixedVacancy;
            $vacancy->id_enterprise = $data["enterprise"];
            $vacancy->id_cod_cbo = $data["cbo-occupation"];
            $vacancy->apprentice_vacancy = $data["apprentice-vacancy"];
            $vacancy->gender_vacancy = $data["gender"];
            $vacancy->number_vacancy = $i;
            $vacancy->pcd_vacancy = $data["pcd-vacancy"];
            $vacancy->quantity_per_vacancy = $data["quantity-per-vacancy"];
            $vacancy->date_open_vacancy = $data["date-open-vacancy"];
            $vacancy->date_closed_vacancy = $data["date-close-vacancy"];
            $vacancy->education_vacancy = $data["education-vacancy"];
            $vacancy->age_min_vacancy = $data["age-min-vacancy"];
            $vacancy->age_max_vacancy = $data["age-max-vacancy"];
            $vacancy->exp_vacancy = $data["exp-vacancy"];
            $vacancy->description_vacancy = $data["description-vacancy"];
            $vacancy->nomeclatura_vacancy = $data["nomeclatura-vacancy"];
            $vacancy->accept_curriculum = $accepCurriculum;
            $vacancy->request_vacancy = $data["request-vacancy"];
            $vacancy->version_panel = $data["version-panel"];
            $vacancy->hide_panel = $data["hide-panel"];
            $vacancy->id_user_register = $userId;
            $vacancy->save();
            }

        return true;
    }

    /**
     * Função para atualizar quantidade de vagas
     */
    public function updateVacancy(int $idVacancy, ?array $data = null, ?int $userId = null) : bool
    {   
        // Pesquisa a última vaga para calcular a quantidade de vaga e verificar se o valor solicitado é maior ou menor que o valor já cadastrado 
        $lastVacancy = $this->find("id_vacancy_fixed = :id","id={$idVacancy}")
        ->order("number_vacancy", "DESC")
        ->fetch();

        $accepCurriculum = isset($data["curriculum-vacancy"]) ? $data["curriculum-vacancy"] : 0;

        // Novas vagas (valor de alteração é maior que o valor cadastrado a primeira vez)
        if($data["number-vacancy"] >= $lastVacancy->number_vacancy) {

            // Atualiza as vagas que foram inseridas a primeira 
            $oldVacancy = $this->find("id_vacancy_fixed = :id","id={$idVacancy}")
                ->order("number_vacancy", "DESC")
                ->fetch(true);

            foreach($oldVacancy as $oldVacancyItem) {
                
                $oldVacancyUpdate = new static();

                $oldVacancyUpdate->id_vacancy = $oldVacancyItem->id_vacancy;
                $oldVacancyUpdate->id_enterprise = $data["enterprise"];
                $oldVacancyUpdate->id_cod_cbo = $data["cbo-occupation"];
                $oldVacancyUpdate->apprentice_vacancy = $data["apprentice-vacancy"];
                $oldVacancyUpdate->gender_vacancy = $data["gender"];
                $oldVacancyUpdate->pcd_vacancy = $data["pcd-vacancy"];
                $oldVacancyUpdate->quantity_per_vacancy = $data["quantity-per-vacancy"];
                $oldVacancyUpdate->date_open_vacancy = $data["date-open-vacancy"];
                $oldVacancyUpdate->date_closed_vacancy = $data["date-close-vacancy"];
                $oldVacancyUpdate->education_vacancy = $data["education-vacancy"];
                $oldVacancyUpdate->age_min_vacancy = $data["age-min-vacancy"];
                $oldVacancyUpdate->age_max_vacancy = $data["age-max-vacancy"];
                $oldVacancyUpdate->exp_vacancy = $data["exp-vacancy"];
                $oldVacancyUpdate->description_vacancy = $data["description-vacancy"];
                $oldVacancyUpdate->nomeclatura_vacancy = $data["nomeclatura-vacancy"];
                $oldVacancyUpdate->accept_curriculum = $accepCurriculum;
                $oldVacancyUpdate->request_vacancy = $data["request-vacancy"];
                $oldVacancyUpdate->version_panel = $data["version-panel"];
                $oldVacancyUpdate->hide_panel = $data["hide-panel"];
                $oldVacancyUpdate->hide_vacancy = $data["hide-vacancy"];
                $oldVacancyUpdate->id_user_update = $userId;

                $oldVacancyUpdate->save();

            }

                // Atualiza o espelho da vaga
                $this->id_vacancy = $idVacancy;
                $this->id_enterprise = $data["enterprise"];
                $this->id_cod_cbo = $data["cbo-occupation"];
                $this->apprentice_vacancy = $data["apprentice-vacancy"];
                $this->gender_vacancy = $data["gender"];
                $this->number_vacancy = $data["number-vacancy"];
                $this->pcd_vacancy = $data["pcd-vacancy"];
                $this->quantity_per_vacancy = $data["quantity-per-vacancy"];
                $this->date_open_vacancy = $data["date-open-vacancy"];
                $this->date_closed_vacancy = $data["date-close-vacancy"];
                $this->education_vacancy = $data["education-vacancy"];
                $this->age_min_vacancy = $data["age-min-vacancy"];
                $this->age_max_vacancy = $data["age-max-vacancy"];
                $this->exp_vacancy = $data["exp-vacancy"];
                $this->description_vacancy = $data["description-vacancy"];
                $this->nomeclatura_vacancy = $data["nomeclatura-vacancy"];
                $this->accept_curriculum = $accepCurriculum;
                $this->request_vacancy = $data["request-vacancy"];
                $this->version_panel = $data["version-panel"];
                $this->hide_panel = $data["hide-panel"];
                $this->hide_vacancy = $data["hide-vacancy"];
                $this->id_user_update = $userId;

                $this->save();

            // Caso a atualização implique em novas vagas, as que forem acrescentadas serão criadas nesse ponto
            for($i = $lastVacancy->number_vacancy + 1; $i <= $data["number-vacancy"]; $i++) {

                $vacancy = new static();
                $vacancy->id_vacancy_fixed = $idVacancy;
                $vacancy->id_enterprise = $data["enterprise"];
                $vacancy->id_cod_cbo = $data["cbo-occupation"];
                $vacancy->apprentice_vacancy = $data["apprentice-vacancy"];
                $vacancy->gender_vacancy = $data["gender"];
                $vacancy->number_vacancy = $i;
                $vacancy->pcd_vacancy = $data["pcd-vacancy"];
                $vacancy->quantity_per_vacancy = $data["quantity-per-vacancy"];
                $vacancy->date_open_vacancy = $data["date-open-vacancy"];
                $vacancy->date_closed_vacancy = $data["date-close-vacancy"];
                $vacancy->education_vacancy = $data["education-vacancy"];
                $vacancy->age_min_vacancy = $data["age-min-vacancy"];
                $vacancy->age_max_vacancy = $data["age-max-vacancy"];
                $vacancy->exp_vacancy = $data["exp-vacancy"];
                $vacancy->description_vacancy = $data["description-vacancy"];
                $vacancy->nomeclatura_vacancy = $data["nomeclatura-vacancy"];
                $vacancy->accept_curriculum = $accepCurriculum;
                $vacancy->request_vacancy = $data["request-vacancy"];
                $vacancy->version_panel = $data["version-panel"];
                $vacancy->hide_panel = $data["hide-panel"];
                $vacancy->hide_vacancy = $data["hide-vacancy"];
                $vacancy->id_user_register = $userId;
                $vacancy->save();
            }
        }

        // Quantidade de vagas de edição menor do que vagas cadastradas a primeira vez
        if($data["number-vacancy"] < $lastVacancy->number_vacancy) {

            // Atualiza as vagas que foram inseridas a primeira 
            $oldVacancy = $this->find("id_vacancy_fixed = :id","id={$idVacancy}")
                ->order("number_vacancy", "DESC")
                ->fetch(true);

            foreach($oldVacancy as $oldVacancyItem) {
                
                $oldVacancyUpdate = new static();

                $oldVacancyUpdate->id_vacancy = $oldVacancyItem->id_vacancy;
                $oldVacancyUpdate->id_enterprise = $data["enterprise"];
                $oldVacancyUpdate->id_cod_cbo = $data["cbo-occupation"];
                $oldVacancyUpdate->apprentice_vacancy = $data["apprentice-vacancy"];
                $oldVacancyUpdate->gender_vacancy = $data["gender"];
                $oldVacancyUpdate->pcd_vacancy = $data["pcd-vacancy"];
                $oldVacancyUpdate->quantity_per_vacancy = $data["quantity-per-vacancy"];
                $oldVacancyUpdate->date_open_vacancy = $data["date-open-vacancy"];
                $oldVacancyUpdate->date_closed_vacancy = $data["date-close-vacancy"];
                $oldVacancyUpdate->education_vacancy = $data["education-vacancy"];
                $oldVacancyUpdate->age_min_vacancy = $data["age-min-vacancy"];
                $oldVacancyUpdate->age_max_vacancy = $data["age-max-vacancy"];
                $oldVacancyUpdate->exp_vacancy = $data["exp-vacancy"];
                $oldVacancyUpdate->description_vacancy = $data["description-vacancy"];
                $oldVacancyUpdate->nomeclatura_vacancy = $data["nomeclatura-vacancy"];
                $oldVacancyUpdate->accept_curriculum = $accepCurriculum;
                $oldVacancyUpdate->request_vacancy = $data["request-vacancy"];
                $oldVacancyUpdate->version_panel = $data["version-panel"];
                $oldVacancyUpdate->hide_panel = $data["hide-panel"];
                $oldVacancyUpdate->hide_vacancy = $data["hide-vacancy"];
                $oldVacancyUpdate->id_user_update = $userId;

                $oldVacancyUpdate->save();

            }

                // Atualiza o espelho da vaga
                $this->id_vacancy = $idVacancy;
                $this->id_enterprise = $data["enterprise"];
                $this->id_cod_cbo = $data["cbo-occupation"];
                $this->apprentice_vacancy = $data["apprentice-vacancy"];
                $this->gender_vacancy = $data["gender"];
                $this->number_vacancy = $data["number-vacancy"];
                $this->pcd_vacancy = $data["pcd-vacancy"];
                $this->quantity_per_vacancy = $data["quantity-per-vacancy"];
                $this->date_open_vacancy = $data["date-open-vacancy"];
                $this->date_closed_vacancy = $data["date-close-vacancy"];
                $this->education_vacancy = $data["education-vacancy"];
                $this->age_min_vacancy = $data["age-min-vacancy"];
                $this->age_max_vacancy = $data["age-max-vacancy"];
                $this->exp_vacancy = $data["exp-vacancy"];
                $this->description_vacancy = $data["description-vacancy"];
                $this->nomeclatura_vacancy = $data["nomeclatura-vacancy"];
                $this->accept_curriculum = $accepCurriculum;
                $this->request_vacancy = $data["request-vacancy"];
                $this->version_panel = $data["version-panel"];
                $this->hide_panel = $data["hide-panel"];
                $this->hide_vacancy = $data["hide-vacancy"];
                $this->id_user_update = $userId;

                $this->save();

            for($i = $lastVacancy->number_vacancy; $i > $data["number-vacancy"]; $i--) {

                $vacancy = new static();
                $idVacancyNotFixed = $vacancy->find("id_vacancy_fixed = :id AND number_vacancy = :nu","id={$idVacancy}&nu={$i}")->fetch();

                $vacancyWorker = (new VacancyWorker())->find("id_vacancy = :id", "id={$idVacancyNotFixed->id_vacancy}")->fetch(true);

                if(count($vacancyWorker ?? []) > 0) {
                    
                } else {
                    $deleteVacancy = new static();
                    $del = $deleteVacancy->findById($idVacancyNotFixed->id_vacancy);
                    $del->destroy();
                }
            }

            // verifica se existem vagas ativas caso não existe encerra a vaga espelho
            $checkedVacancy = new static();
            $countChecked = count($checkedVacancy->find("id_vacancy_fixed = :id AND status_vacancy = :st","id={$idVacancy}&st=Ativa")->fetch(true) ?? []);

            if($countChecked === 0) {
                $checkedVacancy->id_vacancy = $idVacancy;
                $checkedVacancy->status_vacancy = "Encerrada";
                $checkedVacancy->save();
                $normalizeVacancy = (new VacancyWorker())->normalizeWorkerVacancy();
            }
        }
        return false;
    }

    /**
     * Lista de empresas filtradas somente por empresas que tenham vagas cadastradas
     */
    public function listEnterpriseVacancy() : array
    {
        $enterpriseVancacy = $this->find()->fetch(true);
        
        if(!$enterpriseVancacy) {
            return [];
        }
            foreach($enterpriseVancacy as $enterpriseVancacyItem) {
                if (empty($ids[$enterpriseVancacyItem->id_enterprise])) {

                    $enterprise = (new Enterprise())->findById($enterpriseVancacyItem->id_enterprise);

                    $enterpriseDistinct[] = 
                    [
                        "id_enterprise" => $enterprise->id_enterprise,    
                        "name_enterprise" => $enterprise->name_enterprise
                    ];

                    $ids[$enterpriseVancacyItem->id_enterprise] = true;
                }
            }

            usort($enterpriseDistinct, function($a, $b) {
                return strcmp($a["name_enterprise"], $b["name_enterprise"]);
            });

            $objetos = array_map(function($item) {
                return (object) $item;
            }, $enterpriseDistinct);

        return $objetos;
    }

    /**
     * Encerrar vagas e atualizar o espelho de vagas
     */
    public function closedVacancy(int $idVacancy, int $idFixedVacancy, string $reasonClose) : bool
    {   
       
        $vacancyClosed = new static();

        $vacancyClosed->id_vacancy = $idVacancy;
        $vacancyClosed->status_vacancy = "Encerrada";
        $vacancyClosed->reason_close = filter_var($reasonClose, FILTER_SANITIZE_SPECIAL_CHARS);
        $vacancyClosed->save();

        if($idFixedVacancy <> 0) {
            $vacancyTotal = (int)$this->findById($idFixedVacancy)->number_vacancy;
            
            $vacancyTotalClosed = count($this->find("id_vacancy_fixed = :id AND status_vacancy = :st", "id={$idFixedVacancy}&st=Encerrada")->fetch(true));

            if($vacancyTotal === $vacancyTotalClosed) {
                $this->id_vacancy = $idFixedVacancy;
                $this->reason_close = filter_var($reasonClose, FILTER_SANITIZE_SPECIAL_CHARS);
                $this->status_vacancy = "Encerrada";
                $this->save();
            }
        }
        return true;
    }

    /**
     * Reativar vaga após excluir encaminhamento para entrevista
     */
    public function reactiveVacancy(int $idVacancy) : bool
    {   
        // Reativar a propria vaga em si e limpar o reason_close
        $vacancy = new static();
        $vacancy->findById($idVacancy);

        $vacancy->id_vacancy = $idVacancy;
        $vacancy->status_vacancy = "Ativa";
        $vacancy->reason_close = null;
        $vacancy->save();

        // Verificar se o eseplho está ativo, se não, reativar e limpar o reason_close
        $idvacancyGlass = $vacancy->findById($idVacancy)->id_vacancy_fixed;
        $vacancyGlass = new static();
        $vacancyGlass->findById($idvacancyGlass);

        if($vacancyGlass->findById($idvacancyGlass)->status_vacancy === "Encerrada") {

            $vacancyGlass->id_vacancy = $idvacancyGlass;
            $vacancyGlass->status_vacancy = "Ativa";
            $vacancyGlass->reason_close = null;
            $vacancyGlass->save();
        };
        return true;       
    }

    /**
     * Cria um array com todos os horários de encerramento de vagas de hoje
     * @return array
     */
    public function todoClousureToday() : array {
        
        $vacancy = (new static())->find("id_vacancy_fixed = :id AND status_vacancy = :st", "id=0&st=Ativa")->fetch(true);

        $dateTodoToday = [];

        if($vacancy) {
            foreach($vacancy as $vacancyItem) {
                if(date_simple($vacancyItem->date_closed_vacancy) === date_simple()) {

                    $dateTodoToday[] = [
                        "timeTodo" => (new DateTime($vacancyItem->date_closed_vacancy))->format("c"),
                        "idVacancy" => $vacancyItem->id_vacancy
                    ];
                } 
            }
        }
        return $dateTodoToday;
    }   

    /**
     * Verificar se existe encerramentos que já passaram e encerra caso não tenha encerrado - inserir no arranque do sistema
     * @return void
     */
    public function checkdDateClousure() : void
    {
        $vacancy = (new static())->find("status_vacancy = :st AND (reason_close IS NULL OR reason_close = '')", "st=Ativa")->fetch(true);

        if($vacancy) {
            foreach($vacancy as $vacancyItem) {

                $closed = new DateTime($vacancyItem->date_closed_vacancy);
                $today = new DateTime();

                if($closed <= $today) {
                    $this->closedVacancy($vacancyItem->id_vacancy, $vacancyItem->id_vacancy_fixed, "Prazo encerrado");
                }
            }
        }
    }

    /**
     * Executa o encerramento a partir do agendamento feito no javascript
     * @return void
     */
    public function executeDateClousure($idFixedVacancy) : void
    {
        $vacancy = (new static())->find("id_vacancy_fixed = :id AND reason_close IS NULL", "id={$idFixedVacancy}")->fetch(true);

        foreach($vacancy as $vacancyItem) {
            $this->closedVacancy($vacancyItem->id_vacancy, $vacancyItem->id_vacancy_fixed, "Prazo encerrado");
        }
    }

    /**
     * Ocultar e mostrar painel total
     */
    public function hidePanel(bool $showPanel = false) : bool 
    {
        $vVacancyActive = (new VwVacancy())->find("status_vacancy = :id", "id=Ativa")->fetch(true);
        
        if(!$vVacancyActive) {
            return false;
        }
            foreach ($vVacancyActive as $vVacancyActiveItem) {

                $vacancy = (new static())->find("id_vacancy_fixed = :id","id={$vVacancyActiveItem->id_vacancy}")->fetch(true);

                // Muda os status das vagas para oculto
                foreach($vacancy as $vacancyItem) {

                    if ($showPanel === true) {
                        $vacancyItem->hide_panel = false;
                    }else {
                        $vacancyItem->hide_panel = true;
                    }

                    $vacancyItem->save();
                }

                // Muda o status dos espelhos das vagas para oculto
                $vacancyMirror = (new static())->findById($vVacancyActiveItem->id_vacancy);
                
                if ($showPanel === true) {                
                    $vacancyMirror->hide_panel = false;
                } else {
                    $vacancyMirror->hide_panel = true;
                }

                $vacancyMirror->save();
            }
        
        return true;
    }

    /**
     * Verificar se o painel está oculto, se existe vagas para ocultar e se não existe vagas ativas
     */
    public function checkHidePanel() : int 
    {
        $typeReturn = 0;

        // 01 - Retorna vagas ativas que podem ser ocultas
        $vacancyList = new VwVacancy();

        if($vacancyList->find("status_vacancy = :id AND hide_panel <> :nu", "id=Ativa&nu=1")->fetch(true)) {
            $typeReturn = 1;
        }

        // 02 - Existem vagas ocultas que podem ser desocultadas
        if($vacancyList->find("status_vacancy = :id AND hide_panel = :nu", "id=Ativa&nu=1")->fetch(true)) {
            $typeReturn = 2;
        }

        return $typeReturn;
    }

    /**
     * Ocultar e mostrar vaga no painel e na impressão true = reativar false = desativar
     */
    public function hideVacancy(string $idVacancy, bool $hideNo = false) : bool
    {
        $idVacancyFixed = (int)fncDecrypt($idVacancy);
        // Caso o id venha com erro ou seja vazio o retorno será false
        if(!$idVacancyFixed || empty($idVacancyFixed) || $idVacancyFixed == 0) {
            return false;
        }

        // Vaga espelho
        $vacancyMirror = (new static())->findById($idVacancyFixed);

        // Vaga Fixa
        $vacancyFixed = (new static())->find("id_vacancy_fixed = :id","id={$idVacancyFixed}")->fetch(true);

        foreach($vacancyFixed as $vacancyFixedItem) {
            
            // Mostra a vaga se hideNo for true
            if($hideNo === true) {
                $vacancyFixedItem->hide_vacancy = false;
            } else {
                $vacancyFixedItem->hide_vacancy = true;
            }    

            $vacancyFixedItem->save();
        }
        
        // Mostra a vaga se hideNo for true
        if($hideNo === true) {
            $vacancyMirror->hide_vacancy = false;
        } else {
            $vacancyMirror->hide_vacancy = true;
        }
    
        $vacancyMirror->save();
        return true;
    }

    /**
     * Verificar se a vaga está oculta
     */
    public function hideVacancyOnlyOne(int $idVacancy): bool
    {
        $vacancy = (new VwVacancy())->findById($idVacancy);

        if(!$vacancy) {
            return false;
        }

        // Vaga está oculta
        if($vacancy->hide_vacancy === 1) {
            return true;
        }

        // Vaga não está oculta
        if($vacancy->hide_vacancy === 0) {
            return false;
        }

        return false;
    }

    // Verificar se existe vaga no painel do dia
    

    /**
     * Exclui vagas
     */
    public function deleteVacancy(int $idVacancy) : bool
    {   
        $vacancyGlass = (new static())->findById($idVacancy);
        $vacancyDelete = (new static())->delete("id_vacancy_fixed = :id","id={$idVacancy}");
        
        $vacancyGlass->destroy();
        return true;    
    }

}