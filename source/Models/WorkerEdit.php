<?php

namespace Source\Models;

use Source\Core\Model;

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

}