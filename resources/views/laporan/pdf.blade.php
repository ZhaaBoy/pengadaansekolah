<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 6px;
        }

        th {
            background: #f0f0f0;
            text-align: center;
        }

        h3 {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h3>Laporan Pembayaran (Status Selesai)</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Staff</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th>Vendor</th>
                <th>Invoice</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                @foreach ($row->detail as $d)
                    <tr>
                        <td>{{ $loop->parent->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('d/m/Y') }}</td>
                        <td>{{ $row->staff->name }}</td>
                        <td>{{ $d->barang->nama_barang }}</td>
                        <td style="text-align:center">{{ $d->qty }}</td>
                        <td style="text-align:right">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                        <td>{{ $d->nama_vendor }}</td>
                        <td style="text-align:center">
                            {{ $row->pembayaran && $row->pembayaran->invoice_path ? 'Ada' : '-' }}
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>

</html>
