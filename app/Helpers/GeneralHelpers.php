<?php

namespace App\Helpers;

use Carbon\Carbon;
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
}
