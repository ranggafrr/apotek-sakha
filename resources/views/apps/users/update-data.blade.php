@extends('layout.app-index')

@section('content')
    <div class="panel mt-10">
        <form method="POST" action="{{ route('users.update', ['user' => $data->user_id]) }}">
            @csrf
            @method('PUT')
            <div class="flex items-center justify-between">
                <h5 class="mb-5 text-lg font-semibold dark:text-white-light">{{ $page }}</h5>
                <div class="flex items-center gap-2">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-dark btn-sm py-2.5">
                        <i data-lucide="Undo2" class="h-4"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm py-2.5">
                        <i data-lucide="Plus" class="h-4"></i> Update data
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-5 mt-8">
                {{-- Nama Lengkap --}}
                <div class="@error('nama_lengkap') has-error @enderror">
                    <p class="font-semibold mb-1">Nama lengkap <span class="text-red-500">*</span></p>
                    <input type="text" name="nama_lengkap" placeholder="Masukan nama lengkap" class="form-input"
                        value="{{ old('nama_lengkap', $data->nama_lengkap) }}" />
                    @error('nama_lengkap')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Username --}}
                <div class="@error('username') has-error @enderror">
                    <p class="font-semibold mb-1">Username <span class="text-red-500">*</span></p>
                    <input type="text" name="username" placeholder="Masukan username" class="form-input"
                        value="{{ old('username', $data->username) }}" />
                    @error('username')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="@error('password') has-error @enderror">
                    <p class="font-semibold mb-1">Password</p>
                    <div class="relative">
                        <input id="passwordInput" name="password" type="password" placeholder="Masukan password"
                            autocomplete="new-password" class="form-input" />
                        <div onclick="togglePassword()"
                            class="absolute right-0.5 bottom-1 py-2 h-8 px-3 inline-flex justify-center cursor-pointer">
                            <i data-lucide="Eye" id="eyeIcon" class="h-5 text-zinc-600"></i>
                        </div>
                    </div>
                    <p class="text-xs text-red-600">*) Kosongkan password jika tidak ingin diubah</p>
                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Role --}}
                <div class="relative @error('role') has-error @enderror">
                    <p class="font-semibold">Role <span class="text-red-500">*</span></p>
                    <select id="seachable-select" name="role" class="absolute top-1">
                        <option value="">Pilih role</option>
                        @foreach ($role as $item)
                            <option value="{{ $item->nama }}" {{ $data->role == $item->nama ? 'selected' : '' }}>
                                {{ $item->nama }}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </form>
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("passwordInput");
            const eyeIcon = document.getElementById("eyeIcon");
            const isHidden = passwordInput.type === "password";
            passwordInput.type = isHidden ? "text" : "password";
            eyeIcon.setAttribute("data-lucide", isHidden ? "eye-off" : "eye");
            lucide.createIcons();
        }

        $(document).ready(function() {
            var options = {
                searchable: true,
                placeholder: 'Pilih role',
                searchtext: 'Cari data...',
            };
            NiceSelect.bind($("#seachable-select")[0], options);
        });
    </script>
@endsection
