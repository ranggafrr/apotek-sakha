@extends('layout.app-index')

@section('content')
    <div class="panel mt-10">
        <form method="POST" action="{{ route('transaksi-penjualan.store') }}">
            @csrf
            <div class="flex items-center justify-between">
                <h5 class="mb-5 text-lg font-semibold dark:text-white-light">{{ $page }}</h5>
                <div class="flex items-center gap-2">
                    <a href="{{ route('transaksi-penjualan.index') }}" class="btn btn-outline-dark btn-sm py-2.5">
                        <i data-lucide="Undo2" class="h-4"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm py-2.5">
                        <i data-lucide="Plus" class="h-4"></i> Tambah data
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-5 mt-8">
                <div class="@error('kode_transaksi') has-error @enderror">
                    <p class="font-semibold mb-1">No transaksi</p>
                    <input type="text" name="kode_transaksi" value="{{ $noTrans }}" readonly
                        placeholder="Masukan kode transaksi" class="form-input" value="{{ old('kode_transaksi') }}" />
                    @error('kode_transaksi')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="@error('kode_barang') has-error @enderror">
                    <p class="font-semibold mb-1">Nama barang</p>
                    <select id="seachable-select" name="kode_barang" class="absolute top-1">
                        <option value="">Pilih produk</option>
                        @foreach ($produk as $item)
                            <option value="{{ $item->kode_barang }}"
                                {{ old('kode_barang') == $item->kode_barang ? 'selected' : '' }}>{{ $item->nama_barang }}
                            </option>
                        @endforeach
                    </select>
                    @error('kode_barang')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="@error('qty') has-error @enderror">
                    <p class="font-semibold mb-1">QTY</p>
                    <input type="number" name="qty" placeholder="Masukan QTY" class="form-input"
                        value="{{ old('qty') }}" />
                    @error('qty')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </form>

        <div class="mt-5">
            <div class=" mt-10">
                <table class="sticky-header w-full text-sm">
                    <thead class="bg-red-600">
                        <tr class="space-y-2">
                            <th class="px-2 py-3">No</th>
                            <th class="px-2 py-3">Nama barang</th>
                            <th class="px-2 py-3 text-center">QTY</th>
                            <th class="px-2 py-3 text-right">Harga jual</th>
                            <th class="px-2 py-3 text-center">Action</th>
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
                                <td class="px-2 py-3 text-center"> {{-- button delete --}}
                                    <div x-data="{ open: false }" x-init="window.addEventListener('open-delete-modal', e => {
                                        open = true;
                                        const form = $refs.deleteForm;
                                        const action = '{{ route('transaksi-penjualan.destroy-produk', ':id') }}'.replace(':id', e.detail.dataId);
                                        form.setAttribute('action', action);
                                    })">
                                        <!-- Tombol Hapus -->
                                        <button type="button" x-tooltip="Delete"
                                            @click="$dispatch('open-delete-modal', { dataId: '{{ $item->id }}' })">
                                            <i data-lucide="trash-2" class="h-5 text-red-500/80"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="fixed inset-0 bg-[black]/60 z-[999] overflow-y-auto"
                                            :class="open ? '!block' : 'hidden'" x-cloak>
                                            <div class="flex items-start justify-center min-h-screen px-4"
                                                @click.self="open = false">
                                                <div x-show="open" x-transition x-transition.duration.300
                                                    class="panel border-0 p-0 rounded-lg overflow-hidden my-auto w-full max-w-lg">
                                                    <div
                                                        class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
                                                        <div class="flex flex-col items-center">
                                                            <h3 class="text-zinc-700 font-bold text-xl py-3 px-4">Apa kamu
                                                                yakin?</h3>
                                                            <div class="bg-red-100 rounded-full py-2 px-4">
                                                                <i data-lucide="trash-2" class="h-10 text-red-500"></i>
                                                            </div>
                                                        </div>
                                                        <div class="p-4 overflow-y-auto">
                                                            <p class="mt-1 text-zinc-800 text-base font-medium">
                                                                Tindakan ini tidak dapat dibatalkan. Ini akan menghapus data
                                                                secara permanen.
                                                            </p>
                                                        </div>
                                                        <div class="flex justify-end items-center gap-x-2 py-3 px-4">
                                                            <button type="button"
                                                                class="rounded-lg border border-dark text-dark px-4 py-2 font-bold"
                                                                @click="open = false">
                                                                Batalkan
                                                            </button>
                                                            <form method="POST" action="" x-ref="deleteForm">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn-danger px-4 py-2 rounded-lg font-bold">
                                                                    Hapus Data
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
