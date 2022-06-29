<?php

namespace App\Enums;

enum MovieStatusEnum: string
{
  case DESIRED = 'desired';
  case FINISHED = 'finished';
  case ONGOING = 'ongoing';
}
