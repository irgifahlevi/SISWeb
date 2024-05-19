<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Events\NewNotification;
use Illuminate\Support\Facades\Auth;

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

  public static function setRoleWali($model)
  {
    $model->role = "wali_calon";
  }

  public static function setRoleSiswa($model)
  {
    $model->role = "siswa";
  }

  public static function sendNewNotification($title, $username, $email)
  {
    $notificationData = [
      'title' => $title,
      'username' => $username,
      'email' => $email,
    ];
    event(new NewNotification($notificationData));
  }

  public static function generateRandomText($length)
  {
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomCode = '';
    for ($i = 0; $i < $length; $i++) {
      $randomCode .= $alphabet[rand(0, strlen($alphabet) - 1)];
    }
    return $randomCode;
  }

  public static function generateRandomNumber($length)
  {
    $result = '';
    for ($i = 0; $i < $length; $i++) {
      $result .= random_int(0, 9);
    }
    return $result;
  }

  public static function pendingStatusPayment($model)
  {
    $model->status = "Pending";
  }

  public static function successStatusPayment($model)
  {
    $model->status = "Success";
  }

  public static function failedStatusPayment($model)
  {
    $model->status = "Failed";
  }
}
