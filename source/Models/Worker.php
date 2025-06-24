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

}