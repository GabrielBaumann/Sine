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
  public function destroyToServiceVacancy(array $data, int $idUser, ?bool $question = null): bool
  {

      $idService = (int)filter_var(fncDecrypt($data["id-service"]), FILTER_SANITIZE_NUMBER_INT);
      $idWorker = (int)filter_var(fncDecrypt($data["id-worker"]), FILTER_SANITIZE_NUMBER_INT);
      $idVacancy = (int)filter_var(fncDecrypt($data["id-vacancy"]), FILTER_SANITIZE_NUMBER_INT);

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

      if($question === true) {
        // Muda status da tabela vacancy
        $vacancy = new Vacancy();
        $vacancy->reactiveVacancy($idVacancy);
        return true;
      }

    return true;
  }

  public function checkdVacancyStatus(int $idVacancy) : bool
  {
    $vacancy = (new Vacancy())->findById($idVacancy);
    
    // Se tiver ecerrada returna false e pergunta se deve reativar
    if($vacancy->status_vacancy === "Encerrada") {
      // A vaga espelho foi encerrada
      return false;
    }
    // Se tiver ativa retorna true
    return true;
  }
}