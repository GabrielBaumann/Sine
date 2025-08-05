<?php

namespace Source\Models;

use Source\Core\Model;

class WorkerPhone extends Model
{
  public function __construct()
  {
    parent::__construct(
      "work_phone", ["id_work_phone"], 
      ["name_work_phone"], 
      "id_work_phone"
    );
  }

}