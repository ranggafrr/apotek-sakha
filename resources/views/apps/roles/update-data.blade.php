@extends('layout.app-index')

@section('content')
    <div class="panel mt-10">
        <form method="POST" action="{{ route('role.update', ['role' => $data->role_id]) }}">
            @csrf
            @method('PUT')
            <div class="flex items-center justify-between">
                <h5 class="mb-5 text-lg font-semibold dark:text-white-light">{{ $page }}</h5>
                <div class="flex items-center gap-2">
                    <a href="{{ route('role.index') }}" class="btn btn-outline-dark btn-sm py-2.5">
                        <i data-lucide="Undo2" class="h-4"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm py-2.5">
                        <i data-lucide="Plus" class="h-4"></i> Update data
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-5 mt-8">
                {{-- Username --}}
                <div class="@error('nama') has-error @enderror">
                    <p class="font-semibold mb-1">Nama role <span class="text-red-500">*</span></p>
                    <input type="text" name="nama" placeholder="Masukan nama role" class="form-input"
                        value="{{ old('nama', $data->nama) }}" />
                    @error('nama')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </form>
    </div>
@endsection
