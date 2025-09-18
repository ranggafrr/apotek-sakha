    <div class="flex w-full justify-center">
        <div idclass="bg-white rounded-xl border shadow-sm w-1/3 p-3">
            <div class="invoice">
                <div class="header">
                    <h1>APOTEK SAKHA</h1>
                    <p>Jl.Ahmad Yani, Panembong, Subang</p>
                    <p>Telp: (021) 123-4567</p>
                </div>

                <div class="info">
                    <div><span>No. Transaksi:</span><span>{{ $transaksi->kode_transaksi }}</span></div>
                    <div><span>Tanggal:</span><span>{{ $transaksi->tanggal_bayar }}</span></div>
                    <div><span>Kasir:</span><span>{{ $transaksi->created_by }}</span></div>
                    <div><span>Metode Bayar:</span><span>{{ $transaksi->metode_bayar }}</span></div>
                </div>

                <div class="items">
                    @foreach ($barang as $item)
                        <div class="item">
                            <div>
                                <div>{{ $item->nama_barang }}</div>
                                <div>{{ $item->qty }} x Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</div>
                            </div>
                            <div>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="total">
                    <div style="display: flex; justify-content: space-between;">
                        <span>TOTAL:</span>
                        <span>Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="footer">
                    <p>Terima kasih atas kunjungan Anda</p>
                    <p>Semoga lekas sembuh</p>
                </div>
            </div>
            <div class="no-print" style="text-align: center; margin-top: 20px;">
                <button onclick="window.print()"
                    style="padding: 10px 20px; background: #dc2626; color: white; border: none; border-radius: 5px; cursor: pointer;">Print</button>
                <a href="{{ route('laporan-penjualan') }}">
                    <button
                        style="padding: 10px 20px; background: #6b7280; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">Kembali</button>
                </a>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            if (new URLSearchParams(window.location.search).get('auto_print') === '1') {
                setTimeout(() => window.print(), 500);
            }
        }
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            line-height: 1.4;
        }

        .invoice {
            max-width: 300px;
            margin: 20px auto;
            padding: 10px;
        }

        .header {
            text-align: center;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 16px;
            font-weight: bold;
        }

        .header p {
            font-size: 10px;
        }

        .info {
            margin-bottom: 10px;
        }

        .info div {
            display: flex;
            justify-content: space-between;
        }

        .items {
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2px;
        }

        .total {
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 10px;
        }

        @media print {
            body {
                margin: 0;
            }

            .invoice {
                margin: 0;
                max-width: none;
            }

            .no-print {
                display: none;
            }
        }
    </style>
