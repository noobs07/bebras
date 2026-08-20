<div class="md:hidden hidden bg-bebrasDarkBlue shadow-lg rounded-md" id="mobile-menu">
    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
        <a href="{{ route('home') }}"
            class="text-white block px-3 py-2 rounded-md text-base font-medium nav-link">Home</a>

        <!-- Dropdown Utama: Tentang Bebras -->
        <div class="relative dropdown">
            <button
                class="dropdown-btn nav-link text-white px-3 py-2 rounded-md text-sm font-medium flex items-center hover:bg-bebrasDarkBlue transition"
                aria-expanded="false">
                Tentang Bebras
                <svg class="w-4 h-4 ml-1 transform transition duration-200 group-hover:rotate-180" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div class="dropdown-menu absolute left-0 hidden bg-white text-black mt-2 rounded-md shadow-lg w-48 z-50">
                <ul class="py-2 text-sm">
                    <li>
                        <a href="{{ route('tentangBebras.dd_1') }}"
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-100 {{ request()->routeIs('tentangBebras.dd_1') ? 'active' : '' }}">
                            Apa itu Berpikir Komputasional?
                        </a>
                    </li>
                    <li><a href="{{ route('tentangBebras.dd_2') }}"
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-100 {{ request()->routeIs('tentangBebras.dd_2') ? 'active' : '' }}">Apa
                            itu Bebras?</a></li>
                    <li><a href="{{ route('tentangBebras.dd_3') }}"
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-100 {{ request()->routeIs('tentangBebras.dd_3') ? 'active' : '' }}">Tujuan
                            Kami</a></li>
                    <li><a href="{{ route('tentangBebras.dd_4') }}"
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-100 {{ request()->routeIs('tentangBebras.dd_4') ? 'active' : '' }}">Ruang
                            Lingkup</a></li>
                    <li><a href="{{ route('tentangBebras.dd_5') }}"
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-100 {{ request()->routeIs('tentangBebras.dd_5') ? 'active' : '' }}">Kegiatan
                            Bebras</a></li>
                    <li><a href="{{ route('tentangBebras.dd_6') }}"
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-100 {{ request()->routeIs('tentangBebras.dd_6') ? 'active' : '' }}">Sejarah
                            Bebras Indonesia</a></li>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Dropdown Utama: Soal (dengan nested) -->
        <div class="relative dropdown">
            <button
                class="dropdown-btn nav-link text-white px-3 py-2 rounded-md text-sm font-medium flex items-center hover:bg-bebrasDarkBlue transition"
                aria-expanded="false">
                Soal
                <svg class="w-4 h-4 ml-1 transform transition duration-200 group-hover:rotate-180" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div class="dropdown-menu absolute left-0 hidden bg-white text-black mt-2 rounded-md shadow-lg w-56 z-50">
                <ul class="py-2 text-sm">
                    <li><a href="{{ route('soal.index-soal') }}" class="block px-4 py-2 hover:bg-gray-100">Apa itu Soal
                            Bebras?</a></li>

                    <!-- Nested: cukup jadikan LI ini juga .dropdown -->
                    <li class="relative dropdown">
                        <button
                            class="dropdown-btn w-full flex items-center justify-between px-4 py-2 hover:bg-gray-100"
                            aria-expanded="false">
                            Contoh Soal
                            <svg class="w-4 h-4 ml-1 transform transition duration-200 group-hover:rotate-180"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <ul
                            class="dropdown-menu absolute top-0 left-full ml-1 hidden bg-white shadow-lg rounded-md w-48 z-50">
                            <li><a href="{{ route('soal.siaga-sd') }}" class="block px-4 py-2 hover:bg-gray-100">Siaga
                                    Siswa SD</a></li>
                            <li><a href="{{ route('soal.penggalang-smp') }}"
                                    class="block px-4 py-2 hover:bg-gray-100">Penggalang Siswa SMP</a></li>
                            <li><a href="{{ route('soal.penegak-sma') }}"
                                    class="block px-4 py-2 hover:bg-gray-100">Penegak Siswa SMA</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ route('soal.pembahasan-soal') }}"
                            class="block px-4 py-2 hover:bg-gray-100">Pembahasan Soal</a></li>
                </ul>
            </div>





        </div>

        <!-- Dropdown Utama: Tentang Bebras -->
        <div class="relative dropdown">
            <button
                class="dropdown-btn nav-link text-white px-3 py-2 rounded-md text-sm font-medium flex items-center hover:bg-bebrasDarkBlue transition"
                aria-expanded="false">
                Kegiatan
                <svg class="w-4 h-4 ml-1 transform transition duration-200 group-hover:rotate-180" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div class="dropdown-menu absolute left-0 hidden bg-white text-black mt-2 rounded-md shadow-lg w-56 z-50">
                <ul class="py-2 text-sm">


                    <!-- Nested: cukup jadikan LI ini juga .dropdown -->
                    <li class="relative dropdown">
                        <button
                            class="dropdown-btn w-full flex items-center justify-between px-4 py-2 hover:bg-gray-100"
                            aria-expanded="false">
                            Workshop
                            <svg class="w-4 h-4 ml-1 transform transition duration-200 group-hover:rotate-180"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <ul
                            class="dropdown-menu absolute top-0 left-full ml-1 hidden bg-white shadow-lg rounded-md w-48 z-50">
                            <li><a href="{{ route('kegiatan.workshop-2017') }}" class="block px-4 py-2 hover:bg-gray-100">
                                    2017</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">
                                    2016</a></li>
                        </ul>
                    </li>

                    <li class="relative dropdown">
                        <button
                            class="dropdown-btn w-full flex items-center justify-between px-4 py-2 hover:bg-gray-100"
                            aria-expanded="false">
                            Bebras Challenge
                            <svg class="w-4 h-4 ml-1 transform transition duration-200 group-hover:rotate-180"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <ul
                            class="dropdown-menu absolute top-0 left-full ml-1 hidden bg-white shadow-lg rounded-md w-48 z-50">
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">
                                    BC 2017</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">
                                    BC 2016</a></li>
                        </ul>
                    </li>

                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Statistik Bebras Challenge</a>
                    </li>

                    <li class="relative dropdown">
                        <button
                            class="dropdown-btn w-full flex items-center justify-between px-4 py-2 hover:bg-gray-100"
                            aria-expanded="false">
                            Pengumuman Hasil
                            <svg class="w-4 h-4 ml-1 transform transition duration-200 group-hover:rotate-180"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <ul
                            class="dropdown-menu absolute top-0 left-full ml-1 hidden bg-white shadow-lg rounded-md w-48 z-50">
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">
                                    2024</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">
                                    2023</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">
                                    2022</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">
                                    2021</a></li>
                        </ul>
                    </li>

                    <li class="relative dropdown">
                        <button
                            class="dropdown-btn w-full flex items-center justify-between px-4 py-2 hover:bg-gray-100"
                            aria-expanded="false">
                            CT Challenge 2023 for Teachers
                            <svg class="w-4 h-4 ml-1 transform transition duration-200 group-hover:rotate-180"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <ul
                            class="dropdown-menu absolute top-0 left-full ml-1 hidden bg-white shadow-lg rounded-md w-48 z-50">
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">
                                    2024</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">
                                    2023</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">
                                    2022</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">
                                    2021</a></li>
                        </ul>
                    </li>
                    <li><a href="https://pandai.bebras.or.id/" target="_blank" class="block px-4 py-2 hover:bg-gray-100">Gerakan Pandai</a>
                    </li>
                </ul>
            </div>
        </div>

        <a href="{{ route('latihan') }}"
            class="text-white block px-3 py-2 rounded-md text-base font-medium nav-link">Latihan</a>
        <a href="{{ route('kontak') }}"
            class="text-white block px-3 py-2 rounded-md text-base font-medium nav-link">Kontak</a>
        <div class="relative mt-4 px-3">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400 ms-2"></i>
            </div>
            <input type="text"
                class="block w-full pl-10 pr-3 py-2 border border-transparent rounded-md leading-5 bg-white text-white placeholder-gray-200 focus:outline-none focus:bg-white focus:text-gray-900 focus:ring-0"
                placeholder="Cari...">
        </div>

    </div>
