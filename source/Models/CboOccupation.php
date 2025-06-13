<?php

namespace Source\Models;

use Source\Core\Model;

class CboOccupation extends Model
{
  public function __construct()
  {
    parent::__construct(
      "cbo_list", ["code"], 
      [], 
      "code"
    );
  }
}