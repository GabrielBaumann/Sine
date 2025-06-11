<?php

namespace Source\Models;

use Source\Core\Model;

class Worker extends Model
{
  public function __construct()
  {
    parent::__construct(
      "worker", ["id_worker"], 
      ["name_worker", "date_birth_worker", "cpf_worker", "gender_worker", "pcd_worker", "ethnicity_worker", "apprentice_worker", "cterc"], 
      "id_worker"
    );
  }

  public function chartWorker(): array
  {
    $chartWork = $this->find()->fetch(true);

    foreach($chartWork as $work) {
      $status[] = $work->status_work;
    };

    $countStatus = array_count_values($status);

    foreach($countStatus as $key => $value) {
      $label[] = $key;
      $total[] = $value;
    }
    return ["label" => $label, "total" => $total];
  }
}