<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Models\Vacancy;

class VacancyWorker extends Model
{
    public function __construct()
    {
        parent::__construct(
            "vacancy_worker", ["id_vacancy_worker"], [],
            "id_vacancy_worker"
        );
    }

    public function addVacancyToWoker(array $data, int $idService, int $idUserSystem, ?int $idWorker = null) : bool
    {   
        $idVacancy = (int)$data["occupation-id-vacancy"];     
        $addVacancyToWorker = new static();
        
        if(!isset($data["idWorker"])){
            $idWorkerVacancy = $idWorker;
        } else {
            $idWorkerVacancy = $data["idWorker"];
        }
       
        // Salvar id da vaga com id do trabalhador encaminhado
        $addVacancyToWorker->id_vacancy = $data["occupation-id-vacancy"];
        $addVacancyToWorker->id_worker = $idWorkerVacancy;
        $addVacancyToWorker->id_user_register = $idUserSystem;
        $addVacancyToWorker->id_service = $idService;
        $addVacancyToWorker->status_vacancy_worker = "Aguardando resposta";

        $addVacancyToWorker->save();

        $this->checkVacancyQuantity($idVacancy, $idUserSystem);
        return true;
    }

    // Função para atualizar a tabela de vagas
    public function checkVacancyQuantity(int $idVacancy, int $idUserSystem) : bool
    {
        $viewVacancyToWorker = (new VacancyWorker())->find("id_vacancy = :id","id={$idVacancy}")->fetch(true);
        $idVacancyFixedAll = (new Vacancy())->findById($idVacancy);
        $idVacancyFixed = $idVacancyFixedAll->quantity_per_vacancy;

        // Se o total de encaminhamentos para a vaga já tiver preenchido então ele encerra e não deixa continuar
        if($idVacancyFixed === count($viewVacancyToWorker ?? [])) {
            $vacancyFinish = (new Vacancy())->findById($idVacancy);
            $vacancyFinish->status_vacancy = "Encerrada";
            $vacancyFinish->id_user_update = $idUserSystem;
            $vacancyFinish->reason_close = "Total preenchido";
            $vacancyFinish->save();

            // Verifica se todas as vagas estão encerradas e se tiverem encerra também encerra a vaga espelho
            $countVacancyActive = count((new Vacancy())->find("id_vacancy_fixed = :id AND status_vacancy = :st","id={$idVacancyFixedAll->id_vacancy_fixed}&st=Ativa")->fetch(true) ?? []);

            if($countVacancyActive === 0) {
                $updateToStatusVacancy = (new Vacancy())->findById($idVacancyFixedAll->id_vacancy_fixed);
                $updateToStatusVacancy->status_vacancy = "Encerrada";
                $updateToStatusVacancy->reason_close = "Total preenchido";
                $updateToStatusVacancy->save();
            }
            return false;
        }
        return true;
    }

    // Função para normalizar a quantidade permitida de encaminhamento por vagas
    public function normalizeWorkerVacancy()
    {
        // Verifica a quantidade de vagas na tabela worker_vacancy e atualiza as vagas na tabela vacancy
        $totalVagas = (new Vacancy())->find("id_vacancy_fixed <> :id AND reason_close IS NULL OR reason_close = ''","id=0")->fetch(true);
        
        if($totalVagas) {
            foreach($totalVagas as $totalVagasItem) {
                $vacancyWorker = (new VacancyWorker())->find("id_vacancy = :id","id={$totalVagasItem->id_vacancy}")->fetch(true);
                
                if($vacancyWorker) {

                    if($totalVagasItem->quantity_per_vacancy > count($vacancyWorker ?? [])) {
                        $vacancyUpadte = new Vacancy();
                        $vacancyUpadte->id_vacancy = $totalVagasItem->id_vacancy;
                        $vacancyUpadte->reason_close = "";
                        $vacancyUpadte->status_vacancy = "Ativa";
                        $vacancyUpadte->save();
                    }

                    if($totalVagasItem->quantity_per_vacancy === count($vacancyWorker ?? [])) {
                        $vacancyUpadte = new Vacancy();
                        $vacancyUpadte->id_vacancy = $totalVagasItem->id_vacancy;
                        $vacancyUpadte->reason_close = "Total Preenchido";
                        $vacancyUpadte->status_vacancy = "Encerrada";
                        $vacancyUpadte->save();
                    }

                }
            }
        }

        // Atualiza o espelho da vaga para ativa
        $vacancy = new Vacancy();
        $vacancyGlass = $vacancy->find("id_vacancy_fixed = :id", "id=0")->fetch(true) ?? [];

        foreach ($vacancyGlass as $vacancyGlassItem) {
            
            $vacancyGeneral = count((new Vacancy())->find("id_vacancy_fixed = :id AND status_vacancy = :st","id={$vacancyGlassItem->id_vacancy}&st=Ativa")->fetch(true) ?? []);

            // Se existe ao menos uma ocorrência de vaga ativa então o espelho de vaga fica ativo;
            if($vacancyGeneral > 0) {
                $vacancyGlassEdit = $vacancy->find("id_vacancy = :id","id={$vacancyGlassItem->id_vacancy}")->fetch();
                $vacancyGlassEdit->status_vacancy = "Ativa";
                $vacancyGlassEdit->save();
            }
        }
    }

    /**
     * Verificar se existe vagas vínculadas a trabalhadores (se o valor for true então verifica a quantidade de vagas se for false verifica a quantiade por vagas)
     */
    public function checkVacancyWorker(?array $data = null, ?bool $type = null): bool
    {   
        $idVacancyFixed = $data["idvacancy"];
        $numberVacancy = (int)$data["number-vacancy"];
        $quantityPerVacancy = (int)$data["quantity-per-vacancy"];
        
        // Retorna todas as vagas fixas
        $vacanyGeneral = (new Vacancy())->find("id_vacancy_fixed = :id", "id={$idVacancyFixed}")->fetch(true);
        
        // Retorna as vagas vínculadas aos trabalhadores
        $vacancyToWorker = new static();
    
        // Variável que recebe a quantidade de vagas vínculadas a trabalhadores
        $amountOfVacancyWorker = 0;

        // Variável que recebe a quantidade de vínculos por vaga
        $amountOfBondVacancy = [];

        foreach($vacanyGeneral as $vacanyGeneralItem) {           
            $vacancy = count($vacancyToWorker->find("id_vacancy = :id", "id={$vacanyGeneralItem->id_vacancy}")->fetch(true) ?? []);
            if($vacancy) {
                $amountOfVacancyWorker++;
                $amountOfBondVacancy[] = $vacancy;
            }
        }

        // Verifica se a quantidade de vagas solicitadas e menor que a quantiade de vagas já vínculada a trabalhadores
        if($type) {
            if($amountOfVacancyWorker > $numberVacancy) {
                return false;
            }
        }

        // Verifica se a quantidade de encaminhamentos por vagas é menor do que a quantidade de ecaminhamentos já solicitados
        if(!$type && !empty($amountOfBondVacancy)) {
            if(max($amountOfBondVacancy) > $quantityPerVacancy) {
                return false;
            }
        }
        return true;
    }

    /**
     * Atualizar o status do trbalhador e o status da vaga na tabela vacancy_worker baseado na resposta do empregador 
     */
    public function updateOfWorkerVacancy(array $data, int $idUser) : bool
    {   
        $idService = (int)filter_var(fncDecrypt($data["id-service"]), FILTER_SANITIZE_NUMBER_INT); 
        $souceServiceVacancy = filter_var($data["source-service-vacancy"], FILTER_SANITIZE_SPECIAL_CHARS);
        $newVacancyWorker = $this->find("id_service = :id", "id={$idService}")->fetch();

        if (in_array($souceServiceVacancy,["Na ocupação","Em outra ocupação"])) {

            $editNewVacancyWork = (new static())->find("id_service = :id", "id={$idService}")->fetch();
            $editNewVacancyWork->status_vacancy_worker = $souceServiceVacancy;
            $editNewVacancyWork->detail_response = $data["detail-response-company"];
            $editNewVacancyWork->date_response_company = $data["date-response-company"];
            $editNewVacancyWork->id_user_update = $idUser;
            $editNewVacancyWork->save();

            $work = (new Worker())->find("id_worker = :id","id={$newVacancyWorker->id_worker}")->fetch();
            $work->status_work = "Atendimento Realizado";
            $work->save();

            return true;

        } else {

            $editNewVacancyWork = (new static())->find("id_service = :id", "id={$idService}")->fetch();
            $editNewVacancyWork->status_vacancy_worker = $souceServiceVacancy;
            $editNewVacancyWork->detail_response = $data["detail-response-company"];
            $editNewVacancyWork->date_response_company = $data["date-response-company"];
            $editNewVacancyWork->id_user_update = $idUser;
            $editNewVacancyWork->save();

            $work = (new Worker())->find("id_worker = :id","id={$newVacancyWorker->id_worker}")->fetch();
            $work->status_work = "Reprovado";
            $work->save();
            return true;
        }

        return false;
    }

    /**
     * Verificar se existe encaminhamento para entrevista de emprego não finalizado
     */
    public function checkForWardingWork($cpf) : bool
    {
        // Pega o CPF e retorna o ID do usuário
        $cpfWorker = new Worker();
        $idWorker = $cpfWorker->find("cpf_worker = :id", "id={$cpf}")->fetch();

        if(!$idWorker) {
            return false;
        }

        // Retorna se o trabalhador tem ou não encaminhamento para entrevista de emprego não finalizada para o trabalhador
        $vacancyWork = new static();
        $allVacancyWork = $vacancyWork->find("id_worker = :id AND status_vacancy_worker = 'Aguardando resposta'","id={$idWorker->id_worker}")->fetch(true);

        if(count($allVacancyWork ?? []) >= 1) {
            return true;
        }

        // Retorna false caso o usuário tenha cadastro, mas não tenha nenhum encaminhamento sem finalizar
        return false;
    }
}