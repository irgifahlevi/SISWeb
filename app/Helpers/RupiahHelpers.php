<?php
function formatRupiah($nominal)
{
  return "Rp " . number_format($nominal, 2, ',', '.');
}

function formatGelombang($gelombang)
{
  if ($gelombang == "I") {
    return "I (Satu)";
  } else if ($gelombang == "II") {
    return "II (Dua)";
  } else if ($gelombang == "III") {
    return "III (Tiga)";
  } else if ($gelombang == "IV") {
    return "IV (Empat)";
  }
}

function formatNoTelpon($noTelpon)
{
  return "+62" . $noTelpon;
}
