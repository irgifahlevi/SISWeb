<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Siswa;
use App\Models\Pendaftaran;
use App\Models\TagihanSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Helpers\GeneralHelpers;
use App\Helpers\PaymentHelpers;
use App\Helpers\ResponseHelpers;
use App\Models\TransaksiTagihan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HandleAfterPaymentController extends Controller
{
    public function handleTransaction(Request $request)
    {
        $serverKey = config('midtrans.midtrans_server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            $trans = substr($request->order_id, 0, strpos($request->order_id, '-'));
            if ($trans == "REG") {
                $data = Pendaftaran::where('kode_pendaftaran', $request->order_id)
                    ->where('row_status', 0)
                    ->first();
                if ($request->transaction_status == 'capture') {
                    if ($request->payment_type == 'credit_card') {
                        if ($request->fraud_status == 'accept') {

                            $data->is_bayar = PaymentHelpers::setTrue();
                            $data->channel_pembayaran = PaymentHelpers::setPaymentType($request->payment_type);
                            PaymentHelpers::setSuccess($data);
                            GeneralHelpers::setUpdatedAt($data);
                            $data->save();
                            return ResponseHelpers::SuccessResponse('Pembayaran berhasil', '', 200);
                        }
                    }
                } else if ($request->transaction_status == 'settlement') {
                    $data->is_bayar = PaymentHelpers::setTrue();
                    $data->channel_pembayaran = PaymentHelpers::setPaymentType($request->payment_type);
                    PaymentHelpers::setSuccess($data);
                    GeneralHelpers::setUpdatedAt($data);
                    $data->save();
                    return ResponseHelpers::SuccessResponse('Pembayaran berhasil', '', 200);
                } else if ($request->transaction_status == 'pending') {
                    $data->is_bayar = PaymentHelpers::setFalse();
                    PaymentHelpers::setPending($data);
                    $data->save();
                    return ResponseHelpers::SuccessResponse('Pembayaran pending', '', 201);
                } else if ($request->transaction_status == 'deny') {
                    $data->is_bayar = PaymentHelpers::setFalse();
                    PaymentHelpers::setFailed($data);
                    $data->save();
                    return ResponseHelpers::SuccessResponse('Pembayaran failed', '', 201);
                } else if ($request->transaction_status == 'expire') {
                    $data->is_bayar = PaymentHelpers::setFalse();
                    PaymentHelpers::setExpired($data);
                    $data->save();
                    return ResponseHelpers::SuccessResponse('Pembayaran failed', '', 201);
                } else if ($request->transaction_status == 'cancel') {
                    $data->is_bayar = PaymentHelpers::setFalse();
                    PaymentHelpers::setFailed($data);
                    $data->save();
                    return ResponseHelpers::SuccessResponse('Pembayaran failed', '', 201);
                } else if ($request->transaction_status == 'failure') {
                    $data->is_bayar = PaymentHelpers::setFalse();
                    PaymentHelpers::setFailed($data);
                    $data->save();
                    return ResponseHelpers::SuccessResponse('Pembayaran failed', '', 201);
                } else {
                    return ResponseHelpers::ErrorResponse("Internal Server Error", 500);
                }
            } else if ($trans == "BILL") {
                $data = TagihanSiswa::where('kode_tagihan', $request->order_id)
                    ->where('row_status', 0)
                    ->first();
                if ($data) {
                    $users = Siswa::select('nama_lengkap')->where('id', $data->siswa_id)->firstOrFail();
                    if ($request->transaction_status == 'capture') {
                        if ($request->payment_type == 'credit_card') {
                            if ($request->fraud_status == 'accept') {
                                DB::beginTransaction();
                                try {

                                    // Update tagihan siswa
                                    PaymentHelpers::setDibayar($data);
                                    GeneralHelpers::setUpdatedAt($data);
                                    $data->save();

                                    // Create new transaksi
                                    $transaksi = new TransaksiTagihan();
                                    $transaksi->no_transaksi = PaymentHelpers::setNoTransaction();
                                    $transaksi->tagihan_siswa_id = $data->id;
                                    $transaksi->siswa_id = $data->siswa_id;
                                    $transaksi->is_bayar = PaymentHelpers::setTrue();
                                    $transaksi->waktu_transaksi = $request->transaction_time;
                                    $transaksi->waktu_pembayaran = $request->transaction_time;
                                    // $transaksi->waktu_pembayaran = $request->settlement_time;
                                    $transaksi->total_pembayaran = $data->nominal_tagihan;
                                    $transaksi->channel_pembayaran = PaymentHelpers::setPaymentType($request->payment_type);
                                    $transaksi->created_by = $users->nama_lengkap;
                                    GeneralHelpers::setCreatedAt($transaksi);
                                    GeneralHelpers::setRowStatusActive($transaksi);

                                    $transaksi->save();
                                    DB::commit();
                                } catch (Exception $ex) {
                                    return ResponseHelpers::ErrorResponse("Internal Server Error " . $ex, 500);
                                    DB::rollBack();
                                }
                                return ResponseHelpers::SuccessResponse('Pembayaran berhasil', '', 200);
                            }
                        }
                    } else if ($request->transaction_status == 'settlement') {
                        DB::beginTransaction();
                        try {

                            // Update tagihan siswa
                            PaymentHelpers::setDibayar($data);
                            GeneralHelpers::setUpdatedAt($data);
                            $data->save();

                            // Create new transaksi
                            $transaksi = new TransaksiTagihan();
                            $transaksi->no_transaksi = PaymentHelpers::setNoTransaction();
                            $transaksi->tagihan_siswa_id = $data->id;
                            $transaksi->siswa_id = $data->siswa_id;
                            $transaksi->is_bayar = PaymentHelpers::setTrue();
                            $transaksi->waktu_transaksi = $request->transaction_time;
                            $transaksi->waktu_pembayaran = $request->settlement_time;
                            $transaksi->total_pembayaran = $data->nominal_tagihan;
                            $transaksi->channel_pembayaran = PaymentHelpers::setPaymentType($request->payment_type);
                            $transaksi->created_by = $users->nama_lengkap;
                            GeneralHelpers::setCreatedAt($transaksi);
                            GeneralHelpers::setRowStatusActive($transaksi);

                            $transaksi->save();
                            DB::commit();
                        } catch (Exception $ex) {
                            return ResponseHelpers::ErrorResponse("Internal Server Error ", 500);
                            DB::rollBack();
                        }
                        return ResponseHelpers::SuccessResponse('Pembayaran berhasil', '', 200);
                    } else if ($request->transaction_status == 'pending') {
                        PaymentHelpers::setBelumDibayar($data);
                        GeneralHelpers::setUpdatedAt($data);
                        $data->save();
                        return ResponseHelpers::SuccessResponse('Pembayaran pending', '', 201);
                    } else if ($request->transaction_status == 'deny') {
                        PaymentHelpers::setDibatalkan($data);
                        GeneralHelpers::setUpdatedAt($data);
                        $data->save();
                        return ResponseHelpers::SuccessResponse('Pembayaran failed', '', 201);
                    } else if ($request->transaction_status == 'expire') {
                        PaymentHelpers::setExpired($data);
                        GeneralHelpers::setUpdatedAt($data);
                        $data->save();
                        return ResponseHelpers::SuccessResponse('Pembayaran failed', '', 201);
                    } else if ($request->transaction_status == 'cancel') {
                        PaymentHelpers::setFailed($data);
                        GeneralHelpers::setUpdatedAt($data);
                        $data->save();
                        return ResponseHelpers::SuccessResponse('Pembayaran failed', '', 201);
                    } else if ($request->transaction_status == 'failure') {
                        PaymentHelpers::setFailed($data);
                        GeneralHelpers::setUpdatedAt($data);
                        $data->save();
                        return ResponseHelpers::SuccessResponse('Pembayaran failed', '', 201);
                    } else {
                        return ResponseHelpers::ErrorResponse("Internal Server Error", 500);
                    }
                }
            } else {
                return ResponseHelpers::ErrorResponse("Internal Server Error", 500);
            }
        } else {

            return ResponseHelpers::ErrorResponse("Internal Server Error", 500);
        }
    }
}
