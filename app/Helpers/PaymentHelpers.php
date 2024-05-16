<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;

class PaymentHelpers
{
  private static $success = "Success";
  private static $pending = "Pending";
  private static $failed = "Failed";
  private static $online = "Online";
  private static $true = 1;
  private static $false = -1;

  public static function setPending($model)
  {
    $model->status = self::$pending;
  }

  public static function setSuccess($model)
  {
    $model->status = self::$success;
  }

  public static function setFailed($model)
  {
    $model->status = self::$failed;
  }

  public static function setOnline($model)
  {
    $model->jenis_pembayaran = self::$online;
  }

  public static function setTrue()
  {
    return self::$true;
  }

  public static function setFalse()
  {
    return self::$false;
  }

  public static function dateNow()
  {
    return Carbon::now();
  }
}
