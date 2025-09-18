@extends('layout.app-index')
@section('content')
    <div class="panel mt-10">
        <div class="flex items center justify-between">
            <h5 class="mb-5 text-lg font-semibold dark:text-white-light md:top-[25px] md:mb-0">{{ $menu }}</h5>
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm py-2.5"><i data-lucide="Plus" class="h-4"></i>Tambah
                data</a>
        </div>
        <!-- hover table -->
        <!-- basic table -->
        <div class=" mt-10">
            <table class="sticky-header w-full text-sm">
                <thead class="bg-red-600">
                    <tr class="space-y-2">
                        <th class="px-2 py-3">No</th>
                        <th class="px-2 py-3">Nama</th>
                        <th class="px-2 py-3">Username</th>
                        <th class="px-2 py-3 text-center">Role</th>
                        <th class="px-2 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td class="px-2 py-5">{{ $loop->iteration }}</td>
                            <td class="px-2 py-5">{{ $item->nama_lengkap }}</td>
                            <td class="px-2 py-5">{{ $item->username }}</td>
                            <td class="px-2 py-5 text-center">{{ $item->role }}</td>
                            <td class="px-2 py-5 text-center flex items-center justify-center gap-x-2">
                                <a href="{{ route('users.edit', ['user' => $item->user_id]) }}" x-tooltip="Edit"
                                    class="mb-1">
                                    <i data-lucide="square-pen" class="h-5 text-zinc-600"></i>
                                </a>
                                {{-- button delete --}}
                                <div x-data="{ open: false }" x-init="window.addEventListener('open-delete-modal', e => {
                                    open = true;
                                    const form = $refs.deleteForm;
                                    const action = '{{ route('users.destroy', ':id') }}'.replace(':id', e.detail.userId);
                                    form.setAttribute('action', action);
                                })">
                                    <!-- Tombol Hapus -->
                                    <button type="button" x-tooltip="Delete"
                                        @click="$dispatch('open-delete-modal', { userId: '{{ $item->user_id }}' })">
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
