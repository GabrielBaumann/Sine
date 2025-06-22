<?php

namespace Source\Models;

use Source\Core\Model;

class VacancyWorker extends Model
{
    public function __construct()
    {
        parent::__construct(
            "vacancy_worker", ["id_vacancy_worker"], ["id_vacancy", "id_worker"],
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

    public function checkVacancyQuantity(int $idVacancy, int $idUserSystem) : bool
    {

        $viewVacancyToWorker = (new VacancyWorker())->find("id_vacancy = :id","id={$idVacancy}")->fetch(true);
        $idVacancyFixedAll = (new Vacancy())->findById($idVacancy);
        $idVacancyFixed = $idVacancyFixedAll->quantity_per_vacancy;

        // Se o total de encaminhamentos para a vaga já tiver preenchido então ele encerra e não deixa continuar;
        if($idVacancyFixed === count($viewVacancyToWorker ?? [])) {
            $vacancyFinish = (new Vacancy())->findById($idVacancy);
            $vacancyFinish->status_vacancy = "Encerrada";
            $vacancyFinish->id_user_update = $idUserSystem;
            $vacancyFinish->save();


            // Verifica se todas as vagas estão encerradas e se tiverem encerra também a vaga espelho
            $countVacancyActive = count((new Vacancy())->find("id_vacancy_fixed = :id AND status_vacancy = :st","id={$idVacancyFixedAll->id_vacancy_fixed}&st=Ativa")->fetch(true) ?? []);

            if($countVacancyActive === 0) {
                $updateToStatusVacancy = (new Vacancy())->findById($idVacancyFixedAll->id_vacancy_fixed);
                $updateToStatusVacancy->status_vacancy = "Encerrada";
                $updateToStatusVacancy->save();
            
            }

            return false;
        }
        return true;
    }

}