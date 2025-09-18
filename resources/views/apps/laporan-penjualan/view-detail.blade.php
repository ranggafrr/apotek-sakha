@extends('layout.app-index')

@section('content')
    <div class="panel mt-10">
        <div class="flex items-center justify-between">
            <h5 class="mb-5 text-lg font-semibold dark:text-white-light">{{ $noTrans }}</h5>
            <div class="flex items-center gap-2">
                <a href="{{ route('laporan-penjualan') }}" class="btn btn-outline-dark btn-sm py-2.5">
                    <i data-lucide="Undo2" class="h-4"></i> Kembali
                </a>
            </div>
        </div>

        <div class="mt-5">
            <div class=" mt-10">
                <table class="sticky-header w-full text-sm">
                    <thead class="bg-red-600">
                        <tr class="space-y-2">
                            <th class="px-2 py-3">No</th>
                            <th class="px-2 py-3">Nama barang</th>
                            <th class="px-2 py-3 text-center">QTY</th>
                            <th class="px-2 py-3 text-right">Harga jual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produkList as $item)
                            <tr>
                                <td class="px-2 py-3">{{ $loop->iteration }}</td>
                                <td class="px-2 py-3">{{ $item->nama_barang }}</td>
                                <td class="px-2 py-3 text-center">{{ $item->qty }}</td>
                                <td class="px-2 py-3 text-right">Rp {{ number_format($item->qty * $item->harga_jual) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-zinc-500">
                                    <div class="flex flex-col items-center justify-center space-y-2">
                                        <i data-lucide="shopping-cart" class="h-10 text-zinc-400"></i>
                                        <p class="font-medium">Belum ada produk ditambahkan</p>
                                        <p class="text-sm">Tambahkan produk terlebih dahulu untuk melanjutkan transaksi</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var options = {
                searchable: true,
                placeholder: 'Pilih barang',
                searchtext: 'Cari data...',
            };
            NiceSelect.bind($("#seachable-select")[0], options);
        });
    </script>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("modal", (initialOpenState = false) => ({
                open: initialOpenState,

                toggle() {
                    this.open = !this.open;
                },
            }));
        });
    </script>
@endsection
