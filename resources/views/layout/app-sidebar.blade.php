                <div class="h-full bg-white dark:bg-[#0e1726]">
                    <div class="flex items-center justify-between px-4 py-3">
                        <a href="{{ route('dashboard') }}" class="main-logo flex shrink-0 items-center">
                            <span
                                class="align-middle text-2xl font-semibold ltr:ml-1.5 rtl:mr-1.5 dark:text-white-light lg:inline">Apotek
                                Sakha</span>
                        </a>
                        <a href="javascript:;"
                            class="collapse-icon flex h-8 w-8 items-center rounded-full transition duration-300 hover:bg-gray-500/10 rtl:rotate-180 dark:text-white-light dark:hover:bg-dark-light/10"
                            @click="$store.app.toggleSidebar()">
                            <svg class="m-auto h-5 w-5" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                    <ul
                        class="perfect-scrollbar relative h-[calc(100vh-80px)] space-y-0.5 overflow-y-auto overflow-x-hidden p-4 py-0 font-semibold mt-5">
                        <li class="nav-item rounded {{ $menu === 'Dashboard' ? 'bg-gray-500/20' : '' }}">
                            <a href="{{ route('dashboard') }}" class="group">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="shrink-0 group-hover:!text-primary size-6 {{ $menu === 'Dashboard' ? '!text-primary' : '' }}">
                                        <path fill-rule="evenodd"
                                            d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
                                            clip-rule="evenodd" />
                                    </svg>

                                    <span
                                        class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark {{ $menu === 'Dashboard' ? '!text-primary' : '' }}">Dashboard</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" x-data="{ activeDropdown: null }">
                            <ul>
                                @php
                                    $isDataActive = in_array($menu, ['Master user', 'Master role']);
                                @endphp

                                <li class="menu nav-item" x-data="{ activeDropdown: '{{ $isDataActive ? 'data' : '' }}' }">
                                    <button type="button" class="nav-link group"
                                        :class="{ 'active': activeDropdown === 'data' }"
                                        @click="activeDropdown === 'data' ? activeDropdown = null : activeDropdown = 'data'">
                                        <div class="flex items-center">
                                            <!-- ikon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor"
                                                class="shrink-0 group-hover:!text-primary size-6 {{ $isDataActive ? '!text-primary' : '' }}"
                                                :class="{ '!text-primary': activeDropdown === 'data' }">
                                                <path
                                                    d="M19.5 21a3 3 0 0 0 3-3v-4.5a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3V18a3 3 0 0 0 3 3h15ZM1.5 10.146V6a3 3 0 0 1 3-3h5.379a2.25 2.25 0 0 1 1.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 0 1 3 3v1.146A4.483 4.483 0 0 0 19.5 9h-15a4.483 4.483 0 0 0-3 1.146Z" />
                                            </svg>

                                            <span
                                                class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark {{ $isDataActive ? '!text-primary' : '' }}">
                                                Master Data
                                            </span>
                                        </div>
                                        <div :class="activeDropdown === 'data' ? 'rotate-90' : ''"
                                            class="transition-transform duration-300">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </button>

                                    <ul x-cloak x-show="activeDropdown === 'data'" x-collapse
                                        class="sub-menu text-gray-500">
                                        <li>
                                            <a href="{{ route('users.index') }}"
                                                class="{{ $menu == 'Master user' ? 'bg-gray-500/10 text-primary' : '' }}">
                                                Data User
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('role.index') }}"
                                                class="{{ $menu == 'Master role' ? 'bg-gray-500/10 text-primary' : '' }}">
                                                Data Role
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @php
                                    $isProductActive = in_array($menu, ['Master satuan', 'Master barang']);
                                @endphp
                                <li class="nav-item rounded {{ $menu === 'Master barang' ? 'bg-gray-500/20' : '' }}">
                                    <a href="{{ route('master-barang.index') }}" class="group">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor"
                                                class="shrink-0 group-hover:!text-primary size-6 {{ $isProductActive ? '!text-primary' : '' }}"
                                                :class="{ '!text-primary': activeDropdown === 'product' }">
                                                <path
                                                    d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                                            </svg>

                                            <span
                                                class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark {{ $isProductActive ? '!text-primary' : '' }}">Master
                                                Barang</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <ul>
                                <li
                                    class="nav-item rounded {{ $menu === 'Transaksi penjualan' ? 'bg-gray-500/20' : '' }}">
                                    <a href="{{ route('transaksi-penjualan.index') }}" class="group">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor"
                                                class="shrink-0 group-hover:!text-primary size-6 {{ $menu === 'Transaksi penjualan' ? '!text-primary' : '' }}">
                                                <path d="M4.5 3.75a3 3 0 0 0-3 3v.75h21v-.75a3 3 0 0 0-3-3h-15Z" />
                                                <path fill-rule="evenodd"
                                                    d="M22.5 9.75h-21v7.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3v-7.5Zm-18 3.75a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 0 1.5h-6a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                            <span
                                                class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark {{ $menu === 'Transaksi penjualan' ? '!text-primary' : '' }}">Transaksi
                                                Penjualan</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- Apriori --}}
                        <li class="nav-item">
                            <ul>
                                <li class="nav-item rounded {{ $menu === 'Apriori' ? 'bg-gray-500/20' : '' }}">
                                    <a href="{{ route('apriori.analyze') }}" class="group">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor"
                                                class="shrink-0 group-hover:!text-primary size-6 {{ $menu === 'Apriori' ? '!text-primary' : '' }}">
                                                <path fill-rule="evenodd"
                                                    d="M6.32 1.827a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V19.5a3 3 0 0 1-3 3H6.75a3 3 0 0 1-3-3V4.757c0-1.47 1.073-2.756 2.57-2.93ZM7.5 11.25a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H8.25a.75.75 0 0 1-.75-.75v-.008Zm.75 1.5a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H8.25Zm-.75 3a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H8.25a.75.75 0 0 1-.75-.75v-.008Zm.75 1.5a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V18a.75.75 0 0 0-.75-.75H8.25Zm1.748-6a.75.75 0 0 1 .75-.75h.007a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.007a.75.75 0 0 1-.75-.75v-.008Zm.75 1.5a.75.75 0 0 0-.75.75v.008c0 .414.335.75.75.75h.007a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75h-.007Zm-.75 3a.75.75 0 0 1 .75-.75h.007a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.007a.75.75 0 0 1-.75-.75v-.008Zm.75 1.5a.75.75 0 0 0-.75.75v.008c0 .414.335.75.75.75h.007a.75.75 0 0 0 .75-.75V18a.75.75 0 0 0-.75-.75h-.007Zm1.754-6a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Zm.75 1.5a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75h-.008Zm-.75 3a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Zm.75 1.5a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V18a.75.75 0 0 0-.75-.75h-.008Zm1.748-6a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Zm.75 1.5a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75h-.008Zm-8.25-6A.75.75 0 0 1 8.25 6h7.5a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-7.5a.75.75 0 0 1-.75-.75v-.75Zm9 9a.75.75 0 0 0-1.5 0V18a.75.75 0 0 0 1.5 0v-2.25Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span
                                                class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark {{ $menu === 'Apriori' ? '!text-primary' : '' }}">
                                                Apriori</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- Laporan Penjualan --}}
                        <li class="nav-item">
                            <ul>
                                <li
                                    class="nav-item rounded {{ $menu === 'Laporan penjualan' ? 'bg-gray-500/20' : '' }}">
                                    <a href="{{ route('laporan-penjualan') }}" class="group">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor"
                                                class="shrink-0 group-hover:!text-primary size-6 {{ $menu === 'Laporan penjualan' ? '!text-primary' : '' }}">
                                                <path fill-rule="evenodd"
                                                    d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875ZM9.75 17.25a.75.75 0 0 0-1.5 0V18a.75.75 0 0 0 1.5 0v-.75Zm2.25-3a.75.75 0 0 1 .75.75v3a.75.75 0 0 1-1.5 0v-3a.75.75 0 0 1 .75-.75Zm3.75-1.5a.75.75 0 0 0-1.5 0V18a.75.75 0 0 0 1.5 0v-5.25Z"
                                                    clip-rule="evenodd" />
                                                <path
                                                    d="M14.25 5.25a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23 5.23 0 0 0 16.5 7.5h-1.875a.375.375 0 0 1-.375-.375V5.25Z" />
                                            </svg>
                                            <span
                                                class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark {{ $menu === 'Laporan penjualan' ? '!text-primary' : '' }}">Laporan
                                                Penjualan</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- Chatbot AI --}}
                        <li class="nav-item">
                            <ul>
                                <li class="nav-item rounded {{ $menu === 'AI Assistant' ? 'bg-gray-500/20' : '' }}">
                                    <a href="{{ route('chat.index') }}" class="group">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor"  class="shrink-0 group-hover:!text-primary size-6 {{ $menu === 'AI Assistant' ? '!text-primary' : '' }}">
                                                <path fill-rule="evenodd"
                                                    d="M4.848 2.771A49.144 49.144 0 0 1 12 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 0 1-3.476.383.39.39 0 0 0-.297.17l-2.755 4.133a.75.75 0 0 1-1.248 0l-2.755-4.133a.39.39 0 0 0-.297-.17 48.9 48.9 0 0 1-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97ZM6.75 8.25a.75.75 0 0 1 .75-.75h9a.75.75 0 0 1 0 1.5h-9a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H7.5Z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                            <span
                                                class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark {{ $menu === 'AI Assistant' ? '!text-primary' : '' }}">AI
                                                Assistant</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
