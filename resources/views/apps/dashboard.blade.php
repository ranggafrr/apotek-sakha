@extends('layout.app-index')
@section('content')
    <div class="pt-5">
        <div class="mb-6 grid grid-cols-1 gap-6 text-white sm:grid-cols-2 xl:grid-cols-4">
            <!-- Users Visit -->
            <div class="p-5 bg-cyan-500/80 rounded-lg">
                <div class="flex justify-between">
                    <div class="text-md font-semibold ltr:mr-1 rtl:ml-1">Pendapatan</div>
                    <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        <a href="javascript:;" @click="toggle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70 hover:opacity-80">
                                <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                    stroke-width="1.5" />
                                <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                        <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                            class="text-black ltr:right-0 rtl:left-0 dark:text-white-dark">
                            <li><a href="javascript:;" @click="toggle">View Report</a></li>
                            <li><a href="javascript:;" @click="toggle">Edit Report</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-5 flex items-center">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">$170.46</div>
                    <div class="badge bg-white/30">+ 2.35%</div>
                </div>
                <div class="mt-5 flex items-center font-semibold">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                        <path opacity="0.5"
                            d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                            stroke="currentColor" stroke-width="1.5"></path>
                        <path
                            d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                            stroke="currentColor" stroke-width="1.5"></path>
                    </svg>
                    Last Week 44,700
                </div>
            </div>

            <!-- Sessions -->
            <div class="p-5 bg-violet-500/80 rounded-lg">
                <div class="flex justify-between">
                    <div class="text-md font-semibold ltr:mr-1 rtl:ml-1">Profit</div>
                    <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        <a href="javascript:;" @click="toggle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70 hover:opacity-80">
                                <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                    stroke-width="1.5" />
                                <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                        <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                            class="text-black ltr:right-0 rtl:left-0 dark:text-white-dark">
                            <li><a href="javascript:;" @click="toggle">View Report</a></li>
                            <li><a href="javascript:;" @click="toggle">Edit Report</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-5 flex items-center">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">74,137</div>
                    <div class="badge bg-white/30">- 2.35%</div>
                </div>
                <div class="mt-5 flex items-center font-semibold">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                        <path opacity="0.5"
                            d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                            stroke="currentColor" stroke-width="1.5"></path>
                        <path
                            d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                            stroke="currentColor" stroke-width="1.5"></path>
                    </svg>
                    Last Week 84,709
                </div>
            </div>

            <!-- Time On-Site -->
            <div class="p-5 bg-blue-500/80 rounded-lg">
                <div class="flex justify-between">
                    <div class="text-md font-semibold ltr:mr-1 rtl:ml-1">Pengeluaran</div>
                    <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        <a href="javascript:;" @click="toggle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70 hover:opacity-80">
                                <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                    stroke-width="1.5" />
                                <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                        <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                            class="text-black ltr:right-0 rtl:left-0 dark:text-white-dark">
                            <li><a href="javascript:;" @click="toggle">View Report</a></li>
                            <li><a href="javascript:;" @click="toggle">Edit Report</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-5 flex items-center">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">38,085</div>
                    <div class="badge bg-white/30">+ 1.35%</div>
                </div>
                <div class="mt-5 flex items-center font-semibold">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                        <path opacity="0.5"
                            d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                            stroke="currentColor" stroke-width="1.5"></path>
                        <path
                            d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                            stroke="currentColor" stroke-width="1.5"></path>
                    </svg>
                    Last Week 37,894
                </div>
            </div>

            <!-- Bounce Rate -->
            <div class="p-5 bg-fuchsia-500/80 rounded-lg">
                <div class="flex justify-between">
                    <div class="text-md font-semibold ltr:mr-1 rtl:ml-1">Total Transaksi</div>
                    <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        <a href="javascript:;" @click="toggle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70 hover:opacity-80">
                                <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                    stroke-width="1.5" />
                                <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                        <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                            class="text-black ltr:right-0 rtl:left-0 dark:text-white-dark">
                            <li><a href="javascript:;" @click="toggle">View Report</a></li>
                            <li><a href="javascript:;" @click="toggle">Edit Report</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-5 flex items-center">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">49.10%</div>
                    <div class="badge bg-white/30">- 0.35%</div>
                </div>
                <div class="mt-5 flex items-center font-semibold">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                        <path opacity="0.5"
                            d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                            stroke="currentColor" stroke-width="1.5"></path>
                        <path
                            d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                            stroke="currentColor" stroke-width="1.5"></path>
                    </svg>
                    Last Week 50.01%
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="panel h-full w-full">
                <div class="mb-5 flex items-center justify-between">
                    <h5 class="text-lg font-semibold dark:text-white-light">Transaksi Terbaru</h5>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th class="ltr:rounded-l-md rtl:rounded-r-md">No Transaksi</th>
                            <th>Total Bayar</th>
                            <th>Metode Bayar</th>
                            <th class="ltr:rounded-r-md rtl:rounded-l-md">Status</th>
                        </tr>
                    </thead>
                    <tbody class="space-y-2 h-full mt-5">
                        @forelse ($penjualan as $item)
                            <tr class="group text-white-dark hover:text-black dark:hover:text-white-light/90">
                                <td class="min-w-[150px] text-black dark:text-white py-2">
                                    <span class="whitespace-nowrap">{{ $item->kode_transaksi }}</span>
                                </td>
                                <td class="text-primary py-2">Rp {{ number_format($item->total_bayar) }}</td>
                                <td class="py-2 font-semibold text-zinc-700">CASH</td>
                                <td class="py-2">
                                    <span class="badge bg-success shadow-md dark:group-hover:bg-transparent">Lunas</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-500 py-4">
                                    Tidak ada data penjualan hari ini.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            <div class="panel h-80 max-h-80 w-full">
                <div class="mb-5 flex items-center justify-between">
                    <h5 class="text-lg font-semibold dark:text-white-light">Produk Terlaris</h5>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th class="ltr:rounded-l-md rtl:rounded-r-md">Kode Produk</th>
                            <th>Nama Barang</th>
                            <th class="text-center">Total Terjual</th>
                        </tr>
                    </thead>
                    <tbody class="space-y-2 h-full mt-5">
                        @forelse ($produk as $item)
                            <tr class="group text-white-dark hover:text-black dark:hover:text-white-light/90">
                                <td class="text-black dark:text-white py-2">
                                    <span class="whitespace-nowrap">{{ $item->kode_barang }}</span>
                                </td>
                                <td class="text-black font-semibold py-2 min-w-[150px]">{{ $item->nama_barang }}</td>
                                <td class="text-primary py-2 text-center">{{ number_format($item->total_terjual) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-500 py-4">
                                    Tidak ada data penjualan hari ini.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-6 grid gap-6 xl:grid-cols-3">
            <div class="panel h-full xl:col-span-2">
                <div class="mb-5 flex items-center dark:text-white-light">
                    <h5 class="text-lg font-semibold">Revenue</h5>
                    <div x-data="dropdown" @click.outside="open = false" class="dropdown ltr:ml-auto rtl:mr-auto">
                        <a href="javascript:;" @click="toggle">
                            <svg class="h-5 w-5 text-black/70 hover:!text-primary dark:text-white/70" viewBox="0 0 24 24"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                    stroke-width="1.5" />
                                <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                        <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                            class="ltr:right-0 rtl:left-0">
                            <li><a href="javascript:;" @click="toggle">Weekly</a></li>
                            <li><a href="javascript:;" @click="toggle">Monthly</a></li>
                            <li><a href="javascript:;" @click="toggle">Yearly</a></li>
                        </ul>
                    </div>
                </div>
                <p class="text-lg dark:text-white-light/90">Total Profit <span class="ml-2 text-primary">$10,840</span>
                </p>
                <div class="relative overflow-hidden">
                    <div x-ref="revenueChart" class="rounded-lg bg-white dark:bg-black">
                        <!-- loader -->
                        <div
                            class="grid min-h-[325px] place-content-center bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08]">
                            <span
                                class="inline-flex h-5 w-5 animate-spin rounded-full border-2 border-black !border-l-transparent dark:border-white"></span>
                        </div>
                    </div>
                </div>
            </div>
            {{--  --}}
        </div>
    </div>
@endsection
