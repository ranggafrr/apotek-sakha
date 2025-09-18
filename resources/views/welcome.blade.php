<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Apotek Sakha</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Development version -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <!-- Production version -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>
    <div class="flex min-h-full flex-col justify-center items-center px-6  h-screen lg:px-8">
        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif
        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto"
                src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
            <h2 class="mt-5 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Selamat Datang</h2>
            <h2 class="text-center text-lg font-semibold tracking-tight text-zinc-700">Sistem Informasi Apotek
                Sakha Farma</h2>
        </div>
        <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('loginAuth') }}" method="POST">
                @csrf
                <div>
                    <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>
                    <div class="mt-2">
                        <input type="text" name="username" id="username" value="{{ old('username') }}"
                            class="block w-full rounded-md px-3 py-1.5 text-base outline-1 -outline-offset-1  placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 {{ $errors->has('username') ? 'outline-red-500 bg-red-200  focus:bg-red-200 ' : 'outline-gray-300 bg-white text-gray-900' }}">
                        @error('username')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                    </div>
                    <div class="relative mt-2">
                        <input type="password" name="password" id="password" autocomplete="current-password"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 {{ $errors->has('password') ? 'outline-red-500 bg-red-200  focus:bg-red-200 ' : 'outline-gray-300 bg-white text-gray-900' }}">
                        <div onclick="togglePassword()"
                            class="absolute right-0.5 bottom-1 py-2 h-8 px-3 inline-flex justify-center cursor-pointer">
                            <i data-lucide="Eye" id="eyeIcon" class="h-5 text-zinc-600"></i>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button type="submit"
                        class=" cursor-pointer flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Masuk</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const eyeIcon = document.getElementById("eyeIcon");
            const isHidden = passwordInput.type === "password";
            passwordInput.type = isHidden ? "text" : "password";
            eyeIcon.setAttribute("data-lucide", isHidden ? "eye-off" : "eye");
            lucide.createIcons();
        }
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
