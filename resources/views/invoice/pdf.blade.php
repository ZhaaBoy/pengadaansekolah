<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $pengadaan->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #333;
            position: relative;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 6px 8px;
        }

        th {
            background: #f5f5f5;
            text-align: left;
        }

        tfoot td {
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #555;
        }

        /* === STAMPEL LUNAS === */
        .stamp {
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-15deg);
            color: rgba(255, 0, 0, 0.25);
            font-size: 100px;
            font-weight: 900;
            text-transform: uppercase;
            border: 6px solid rgba(255, 0, 0, 0.35);
            padding: 20px 50px;
            border-radius: 12px;
            letter-spacing: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        {{-- STAMPEL --}}
        <div class="stamp">LUNAS</div>

        {{-- HEADER --}}
        <h2>Invoice Pembayaran</h2>

        <div class="info">
            <p><strong>No. Invoice:</strong> INV-{{ str_pad($pengadaan->id, 4, '0', STR_PAD_LEFT) }}</p>
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
            <p><strong>Staff:</strong> {{ $pengadaan->staff->name }}</p>
        </div>

        {{-- TABEL BARANG --}}
        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th style="text-align:center;">Qty</th>
                    <th style="text-align:right;">Harga</th>
                    <th style="text-align:right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengadaan->detail as $d)
                    <tr>
                        <td>{{ $d->barang->nama_barang }}</td>
                        <td style="text-align:center;">{{ $d->qty }}</td>
                        <td style="text-align:right;">Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
                        <td style="text-align:right;">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align:right;">Total</td>
                    <td style="text-align:right;">Rp {{ number_format($pengadaan->total_harga, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        {{-- INFORMASI VENDOR --}}
        <div style="margin-top:20px;">
            <p><strong>Vendor:</strong> {{ $pengadaan->detail->first()->nama_vendor }}</p>
            <p><strong>Rekening:</strong> {{ $pengadaan->detail->first()->nama_rekening }}
                ({{ $pengadaan->detail->first()->no_rekening }})</p>
        </div>

        <div class="footer">
            <p>Terima kasih atas kepercayaan Anda 🙏</p>
            <p><em>Dokumen ini dicetak secara otomatis oleh sistem pada {{ now()->format('d/m/Y H:i') }}</em></p>
        </div>
    </div>
</body>

</html>
