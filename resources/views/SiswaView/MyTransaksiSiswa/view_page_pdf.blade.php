<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tagihan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {

            max-width: 100%; /* Mengatur lebar maksimal container */
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center; /* Memastikan konten di tengah */
            overflow-x: auto; /* Mengizinkan pengguliran horizontal jika perlu */
            
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 60px;
            height: 60px;
        }

        .school-info {
            text-align: left;
        }

        .school-info h2, .school-info p {
            margin: 0;
            font-size: 10px;
        }

        .student-details {
            text-align: right;
        }

        .student-details p {
            margin: 0;
            font-size: 10px;
        }

        .title {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        table {
            max-width: 90%; /* Mengatur lebar maksimal container */
            padding: 20px;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 5px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 10px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="school-info">
                <h2>MTs. Al-Quraniyah</h2>
                <p>Jl. H. Ridi Jl. Swadarma Raya No.49, RT 015 RW 003</p>
                <p>012-345-6789</p>
            </div>
            <div class="student-details">
                <p>Nama : {{$siswa->nama_lengkap}}</p>
                <p>No Induk : {{$siswa->no_nisn}}</p>
                <p>Kelas : {{$siswa->KelasSiswa->kelas}}</p>
            </div>
        </div>
        <div class="title">Transaksi tagihan semester {{$semester}}</div>
        @if ($transaksi)
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>No transaksi</th>
                    <th>Kode tagihan</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Nominal tagihan</th>
                    <th>Nama tagihan</th>
                    <th>Semester</th>
                    <th>Waktu transaksi</th>
                    <th>Waktu pembayaran</th>
                    <th>Status</th>
                    <th>Channel pembayaran</th>
                    <th>Jenis pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $nomor = 1;
                @endphp
                @foreach($transaksi as $item)
                <tr>
                    <td>{{ $nomor++ }}</td>
                    <td>{{ $item->no_transaksi }}</td>
                    <td>{{ $item->TransaksiTagihan->kode_tagihan }}</td>
                    <td>{{ $item->TransaksiTagihanSiswa->nama_lengkap }}</td>
                    <td>{{ $item->TransaksiTagihan->TagihanKelas->kelas }}</td>
                    <td>{{ formatRupiah($item->total_pembayaran) }}</td>
                    <td>{{ $item->TransaksiTagihan->nama_tagihan }}</td>
                    <td>{{ formatSemester($item->TransaksiTagihan->semester) }}</td>
                    <td>{{ $item->waktu_transaksi }}</td>
                    <td>{{ $item->waktu_pembayaran }}</td>
                    <td>
                        @if ($item->is_bayar == 1)
                        <span class="badge bg-success">Lunas</span>
                        @endif
                    </td>
                    <td>{{ $item->channel_pembayaran }}</td>
                    <td>{{ $item->TransaksiTagihan->jenis_pembayaran }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</body>
</html>
