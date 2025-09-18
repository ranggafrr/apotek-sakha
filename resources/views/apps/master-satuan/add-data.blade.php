@extends('layout.app-index')

@section('content')
    <div class="panel mt-10">
        <form method="POST" action="{{ route('master-satuan.store') }}">
            @csrf

            <div class="flex items-center justify-between">
                <h5 class="mb-5 text-lg font-semibold dark:text-white-light">{{ $page }}</h5>
                <div class="flex items-center gap-2">
                    <a href="{{ route('master-satuan.index') }}" class="btn btn-outline-dark btn-sm py-2.5">
                        <i data-lucide="Undo2" class="h-4"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm py-2.5">
                        <i data-lucide="Plus" class="h-4"></i> Tambah data
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-5 mt-8">
                <div class="@error('nama_satuan') has-error @enderror">
                    <p class="font-semibold mb-1">Nama satuan</p>
                    <input type="text" name="nama_satuan" placeholder="Masukan nama satuan" class="form-input"
                        value="{{ old('nama_satuan') }}" />
                    @error('nama_satuan')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="@error('stok_minimal') has-error @enderror">
                    <p class="font-semibold mb-1">Stok minimal</p>
                    <input type="number" name="stok_minimal" placeholder="Masukan stok minimal" class="form-input"
                        value="{{ old('stok_minimal') }}" />
                    @error('stok_minimal')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative @error('status') has-error @enderror">
                    <p class="font-semibold">Status</p>
                    <select id="seachable-select" name="status" class="absolute top-1">
                        <option value="">Pilih status</option>
                        <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif
                        </option>
                    </select>
                    @error('status')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <p class="font-semibold mb-1">Catatan</p>
                    <textarea rows="2" class="form-textarea" name="remark"></textarea>
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
