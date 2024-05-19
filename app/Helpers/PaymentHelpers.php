<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;
use App\Models\TransaksiTagihan;

class PaymentHelpers
{
  private static $success = "Success";
  private static $pending = "Pending";
  private static $failed = "Failed";
  private static $belum_dibayar = "belum_dibayar";
  private static $dibayar = "dibayar";
  private static $dibatalkan = "dibatalkan";
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

  public static function setBelumDibayar($model)
  {
    $model->status = self::$belum_dibayar;
  }

  public static function setDibayar($model)
  {
    $model->status = self::$dibayar;
  }

  public static function setDibatalkan($model)
  {
    $model->status = self::$dibatalkan;
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

  public static function setPaymentType($type)
  {
    $paymentTypes = [
      "credit_card" => "Credit card",
      "gopay" => "Gopay",
      "qris" => "Qris",
      "shopeepay" => "Shopeepay",
      "bank_transfer" => "Bank transfer",
      "echannel" => "Mandiri bill",
      "akulaku" => "Akulaku",
    ];
    return $paymentTypes[$type] ?? "Alfamart / Indomaret";
  }

  public static function setNoTransaction()
  {
    $tanggal = Carbon::now()->format('Ymd');
    $last_record = TransaksiTagihan::select('no_transaksi')
      ->whereDate('created_at', Carbon::today())->latest('no_transaksi')->first();
    if ($last_record) {
      $last_number = intval(substr($last_record->no_transaksi, -4));
      $count = $last_number + 1;
      $nomor_urut = str_pad($count, 4, '0', STR_PAD_LEFT);
    } else {
      $nomor_urut = '0001';
    }

    return $tanggal . $nomor_urut;
  }
}
