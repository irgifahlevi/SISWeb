<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class GeneralHelpers
{
  public static function setCreatedAt($model)
  {
    $model->created_at = Carbon::now();
  }

  public static function setCreatedBy($model)
  {
    $model->created_by = Auth::user()->username;
  }

  public static function setUpdatedAt($model)
  {
    $model->updated_at = Carbon::now();
  }

  public static function setUpdatedAtNull($model)
  {
    $model->updated_at = null;
  }

  public static function setRowStatusActive($model)
  {
    $model->row_status = 0;
  }

  public static function setRowStatusInActive($model)
  {
    $model->row_status = -1;
  }
}
