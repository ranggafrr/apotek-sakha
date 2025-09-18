@extends('layout.app-index')
@section('content')
    <div class="panel mt-10">
        <h5 class="mb-5 text-lg font-semibold dark:text-white-light md:top-[25px] md:mb-0">{{ $menu }}</h5>
        <!-- Date Range Filter -->
        <div class="mb-6 ">
            <div class="flex items-center gap-4 w-1/2 mt-3">
                <input type="text" id="dateRange" class="form-input w-64" placeholder="Pilih rentang tanggal"
                    autocomplete="new-password"
                    value="@if (request('start_date') && request('end_date')) {{ request('start_date') }} - {{ request('end_date') }} @endif">
                <button id="filterBtn" class="btn btn-primary">Filter</button>
                <button id="resetBtn" class="btn btn-secondary">Reset</button>
            </div>
        </div>
        <!-- hover table -->
        <!-- basic table -->
        <div class=" mt-10">
            <table class="sticky-header w-full text-sm">
                <thead class="bg-red-600">
                    <tr class="space-y-2">
                        <th class="px-2 py-3">No</th>
                        <th class="px-2 py-3">Kode Transaksi</th>
                        <th class="px-2 py-3 text-center">Total Bayar</th>
                        <th class="px-2 py-3 text-center">Metode Bayar</th>
                        <th class="px-2 py-3 text-center">Tanggal bayar</th>
                        <th class="px-2 py-3 text-center">Kasir</th>
                        <th class="px-2 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->isNotEmpty())
                        @foreach ($data as $item)
                            <tr>
                                <td class="px-2 py-5">{{ $loop->iteration }}</td>
                                <td class="px-2 py-5 font-semibold hover:underline hover:text-sky-700"> <a
                                        href="{{ route('laporan-penjualan-detail', ['kode_transaksi' => $item->kode_transaksi]) }}">
                                        {{ $item->kode_transaksi }} </a></td>
                                <td class="px-2 py-5 text-center">Rp {{ number_format($item->total_bayar, 0, ',', '.') }}
                                </td>
                                <td class="px-2 py-5 text-center">{{ $item->metode_bayar }}</td>
                                <td class="px-2 py-5 text-center">{{ $item->tanggal_bayar }}</td>
                                <td class="px-2 py-5 text-center">{{ $item->created_by }}</td>
                                <td class="px-2 py-5 text-center flex items-center justify-center gap-x-2">
                                    {{-- button delete --}}
                                    <div x-data="{ open: false }" x-init="window.addEventListener('open-delete-modal', e => {
                                        open = true;
                                        const form = $refs.deleteForm;
                                        const action = '{{ route('transaksi-penjualan.destroy', ':id') }}'.replace(':id', e.detail.dataId);
                                        form.setAttribute('action', action);
                                    })">
                                        <!-- Tombol Print -->
                                        <a
                                            href="{{ route('invoice-print', ['kode_transaksi' => $item->kode_transaksi]) }}">
                                            <i data-lucide="printer" class="h-5 text-yellow-600/80"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center text-sm py-3">Data tidak ditemukan</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Initialize Flatpickr
            const fp = flatpickr("#dateRange", {
                mode: "range",
                dateFormat: "Y-m-d",
                locale: {
                    rangeSeparator: " - "
                }
            });

            // Filter button click
            $('#filterBtn').click(function() {
                const dateRange = $('#dateRange').val();
                if (dateRange) {
                    const dates = dateRange.split(' - ');
                    const startDate = dates[0];
                    const endDate = dates[1] || dates[0];

                    window.location.href =
                        `{{ route('laporan-penjualan') }}?start_date=${startDate}&end_date=${endDate}`;
                }
            });

            // Reset button click
            $('#resetBtn').click(function() {
                fp.clear();
                window.location.href = `{{ route('laporan-penjualan') }}`;
            });
        });

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
