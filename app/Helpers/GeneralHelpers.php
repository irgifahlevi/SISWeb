<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Events\NewNotification;
use App\Models\BiayaPendaftaran;
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

  public static function generateKodeBiaya($nama_biaya)
  {
    $inisial = strtoupper(substr($nama_biaya, 0, 2));
    $spasiPosition = strpos($nama_biaya, ' ');
    if ($spasiPosition !== false) {
      $inisial .= strtoupper(substr($nama_biaya, $spasiPosition + 1, 1));
    } else {
      $inisial = strtoupper(substr($nama_biaya, 0, 3));
    }

    $tanggal = Carbon::now()->format('Y');

    $random_number = self::generateRandomNumber(4);
    return $inisial . "-" . $random_number . "-" . $tanggal;
  }

  public static function generateDocumentName($key, $code)
  {
    $documentNames = [
      'pas_foto' => 'PAS-FOTO-',
      'skhun' => 'SKHUN-',
      'raport_terakhir' => 'RAPORT-',
    ];

    return $documentNames[$key] . $code;
  }

  public static function setInvalidDocument($model)
  {
    $model->status = "invalid";
  }

  public static function setValidDocument($model)
  {
    $model->status = "valid";
  }

  public static function setStatusSeleksi($key)
  {
    $statusSeleksi = [
      0 => "lolos",
      1 => "tidak_lolos",
      2 => "belum_dinilai",
      3 => "review_document",
    ];

    return isset($statusSeleksi[$key]) ? $statusSeleksi[$key] : null;
  }

  public static function setTrueDocument($model)
  {
    $model->is_document = 1;
  }

  public static function setFalseDocument($model)
  {
    $model->is_document = 0;
  }
}
