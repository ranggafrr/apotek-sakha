@extends('layout.app-index')

@section('content')
    <div class="panel mt-10">
        <form method="POST" action="{{ route('master-barang.update', ['master_barang' => $data->kode_barang]) }}">
            @csrf
            @method('PUT')
            <div class="flex items-center justify-between">
                <h5 class="mb-5 text-lg font-semibold dark:text-white-light">{{ $page }}</h5>
                <div class="flex items-center gap-2">
                    <a href="{{ route('master-barang.index') }}" class="btn btn-outline-dark btn-sm py-2.5">
                        <i data-lucide="Undo2" class="h-4"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm py-2.5">
                        <i data-lucide="Plus" class="h-4"></i> Update data
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-5 mt-8">
                <div class="@error('nama_barang') has-error @enderror">
                    <p class="font-semibold mb-1">Nama barang</p>
                    <input type="text" name="nama_barang" placeholder="Masukan nama satuan" class="form-input"
                        value="{{ old('nama_barang', $data->nama_barang) }}" />
                    @error('nama_barang')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="@error('stok') has-error @enderror">
                    <p class="font-semibold mb-1">Stok barang</p>
                    <input type="number" name="stok" placeholder="Masukan stok barang" class="form-input"
                        value="{{ old('stok', $data->stok) }}" />
                    @error('stok')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="@error('harga_beli') has-error @enderror">
                    <p class="font-semibold mb-1">Harga beli</p>
                    <input type="number" name="harga_beli" placeholder="Masukan harga beli" class="form-input"
                        value="{{ old('harga_beli', $data->harga_beli) }}" />
                    @error('harga_beli')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="@error('harga_jual') has-error @enderror">
                    <p class="font-semibold mb-1">Harga Jual</p>
                    <input type="number" name="harga_jual" placeholder="Masukan harga jual" class="form-input"
                        value="{{ old('harga_jual', $data->harga_jual) }}" />
                    @error('harga_jual')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            var options = {
                searchable: true,
                placeholder: 'Pilih status',
                searchtext: 'Cari data...',
            };
            NiceSelect.bind($("#seachable-select")[0], options);
        });
    </script>
@endsection
