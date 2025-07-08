<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Models\VacancyWorker;

class WorkerEdit extends Model
{
  public function __construct()
  {
    parent::__construct(
      "worker", ["id_worker"], 
      [], 
      "id_worker"
    );
  }

  /**
   * Função para excluir entrevista de emprego e atualizar os dados das tabelas relacionadas
   */
  public function destroyToServiceVacancy(array $data, int $idUser): bool
  {

    $idService = (int)filter_var($data["id-service"], FILTER_SANITIZE_NUMBER_INT);
    $idWorker = (int)filter_var($data["id-worker"], FILTER_SANITIZE_NUMBER_INT);
    $idVacancy = (int)filter_var($data["id-vacancy"], FILTER_SANITIZE_NUMBER_INT);

    if(!$this->checkdVacancy($idVacancy)) {
      // Vagas encerradas perguntar se vai ou não reativar a vaga
      // var_dump("Vagas encerradas perguntar se vai ou não reativar a vaga");
      return false;
    };

      // Excluir registro da tabela vacancy_worker
      $vacancyWorker = (new VacancyWorker())->find("id_service = :id", "id={$idService}")->fetch();
      $vacancyWorker->destroy();

      // Se o trabalhador tiver outros encaminhamentos de vagas com o status aguardando resposta então não muda o status para Atendimento Realizado;
      $workerVacancyToResponse = count((new VacancyWorker())->find("id_worker = :id AND status_vacancy_worker = :st","id={$idWorker}&st=Aguardando resposta")->fetch(true) ?? []);

      // Muda o status da tabela worker 
      $worker = (new static())->findById($idWorker);

      if($workerVacancyToResponse === 0) {
        $worker->status_work = "Atendimento Realizado";
      }
      $worker->id_user_update = $idUser;
      $worker->save();

      // Excluir registro da tabela service
      $service = (new Service())->findById($idService);
      $service->destroy();

      // Muda status da tabela vacancy
      $vacancyWorker->normalizeWorkerVacancy();

    return true;
  }

  private function checkdVacancy(int $idVacancy) : bool
  {
    $vacancy = (new Vacancy())->findById($idVacancy);
   
    if($vacancy->status_vacancy === "Encerrada") {
      // A vaga espelho foi encerrada
      return false;
    }
    return true;
  }

}