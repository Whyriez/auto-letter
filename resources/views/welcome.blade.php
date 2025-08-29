<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoLetter - Revolusi Administrasi Akademik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 25%, #334155 50%, #475569 75%, #64748b 100%);
        }

        .text-gradient {
            background: linear-gradient(135deg, #c06c6c 0%, #eb3211 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .red-gradient {
            background: linear-gradient(135deg, #E53935 0%, #d32f2f 50%, #c62828 100%);
        }

        .red-gradient:hover {
            background: linear-gradient(135deg, #d32f2f 0%, #c62828 50%, #b71c1c 100%);
        }

        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }

        .mobile-menu.open {
            transform: translateX(0);
        }

        .hamburger {
            cursor: pointer;
            z-index: 60;
        }

        .hamburger span {
            display: block;
            width: 25px;
            height: 3px;
            background: black;
            margin: 5px 0;
            transition: 0.3s;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }

        .network-node {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(229, 57, 53, 0.6);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        .network-line {
            position: absolute;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(229, 57, 53, 0.3), transparent);
            animation: flow 3s infinite linear;
        }

        .data-particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: rgba(59, 130, 246, 0.8);
            border-radius: 50%;
            animation: float 4s infinite ease-in-out;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0.4;
                transform: scale(1);
            }

            50% {
                opacity: 1;
                transform: scale(1.5);
            }
        }

        @keyframes flow {
            0% {
                transform: translateX(-100%);
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) translateX(0px);
                opacity: 0.7;
            }

            25% {
                transform: translateY(-20px) translateX(10px);
                opacity: 1;
            }

            50% {
                transform: translateY(-10px) translateX(-5px);
                opacity: 0.8;
            }

            75% {
                transform: translateY(-30px) translateX(15px);
                opacity: 1;
            }
        }

        .hero-button {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 25px rgba(229, 57, 53, 0.3);
        }

        .hero-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(229, 57, 53, 0.4);
        }

        .step-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .step-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .step-number {
            background: linear-gradient(135deg, #E53935 0%, #d32f2f 100%);
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            position: absolute;
            top: -16px;
            left: 50%;
            transform: translateX(-50%);
            box-shadow: 0 4px 12px rgba(229, 57, 53, 0.3);
        }

        .connecting-line {
            position: absolute;
            top: 50%;
            left: 100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #E53935, #f3f4f6);
            transform: translateY(-50%);
            z-index: -1;
        }

        .connecting-line::after {
            content: '';
            position: absolute;
            right: -8px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 8px solid #E53935;
            border-top: 4px solid transparent;
            border-bottom: 4px solid transparent;
        }

        .benefit-card {
            transition: all 0.3s ease;
        }

        .benefit-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .tech-bg {
            background-image:
                radial-gradient(circle at 20% 80%, rgba(229, 57, 53, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(16, 185, 129, 0.05) 0%, transparent 50%);
        }

        .grid-pattern {
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        .scan-animation {
            animation: scan 2s infinite;
        }

        @keyframes scan {

            0%,
            100% {
                transform: translateY(0);
                opacity: 0.7;
            }

            50% {
                transform: translateY(-10px);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .connecting-line {
                display: none;
            }

            .step-number {
                position: relative;
                top: 0;
                left: 0;
                transform: none;
                margin: 0 auto 1rem auto;
            }

            .hero-gradient {
                padding-top: 80px;
            }
        }
    </style>
</head>

<body class="overflow-x-hidden">
    <section
        class="relative min-h-screen hero-gradient tech-bg grid-pattern flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="network-node" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
            <div class="network-node" style="top: 30%; left: 80%; animation-delay: 0.5s;"></div>
            <div class="network-node" style="top: 60%; left: 15%; animation-delay: 1s;"></div>
            <div class="network-node" style="top: 70%; left: 85%; animation-delay: 1.5s;"></div>
            <div class="network-node" style="top: 40%; left: 50%; animation-delay: 2s;"></div>

            <div class="network-line" style="top: 25%; left: 0; width: 300px; animation-delay: 0s;"></div>
            <div class="network-line" style="top: 45%; right: 0; width: 250px; animation-delay: 1s;"></div>
            <div class="network-line" style="top: 65%; left: 0; width: 400px; animation-delay: 2s;"></div>

            <div class="data-particle" style="top: 15%; left: 25%; animation-delay: 0s;"></div>
            <div class="data-particle" style="top: 35%; left: 70%; animation-delay: 1s;"></div>
            <div class="data-particle" style="top: 55%; left: 30%; animation-delay: 2s;"></div>
            <div class="data-particle" style="top: 75%; left: 60%; animation-delay: 3s;"></div>
        </div>

        <nav class="fixed top-0 left-0 right-0 z-50 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 red-gradient rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-gray-600">AutoLetter</span>
                    </div>

                    <div class="hidden md:flex items-center space-x-8">
                        <a href="/"
                            class="text-gray-600 hover:text-red-400 transition-colors font-medium">Home</a>
                        @if (Auth::check())
                            @php
                                $dashboardRoute = 'dashboard';

                                switch (Auth::user()->role) {
                                    case 'super_admin':
                                        $dashboardRoute = 'super_admin.dashboard';
                                        break;
                                    case 'admin_jurusan':
                                        $dashboardRoute = 'admin_jurusan.dashboard';
                                        break;
                                    case 'kajur':
                                        $dashboardRoute = 'kajur.index';
                                        break;
                                    case 'kaprodi':
                                        $dashboardRoute = 'kaprodi.index';
                                        break;
                                    case 'mahasiswa':
                                        $dashboardRoute = 'mahasiswa.index';
                                        break;
                                }
                            @endphp
                            <a href="{{ route($dashboardRoute) }}"
                                class="text-gray-600 hover:text-red-400 transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-gray-600 hover:text-red-400 transition-colors font-medium">Login</a>
                        @endif

                    </div>

                    <div class="md:hidden flex items-center">
                        <button id="mobile-menu-button" type="button" onclick="toggleMobileMenu()"
                            class="text-gray-400 hover:text-white focus:outline-none focus:text-white transition-colors">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16m-7 6h7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div id="mobileMenu" class="mobile-menu fixed top-0 right-0 w-full h-screen bg-gray-100 z-40 md:hidden">
                <div class="flex flex-col items-center justify-center h-full space-y-8">
                    <a href="/" class="text-gray-600 text-xl font-medium hover:text-red-400 transition-colors"
                        onclick="toggleMobileMenu()">Home</a>
                    @if (Auth::check())
                        @php
                            $dashboardRoute = 'dashboard';

                            switch (Auth::user()->role) {
                                case 'super_admin':
                                    $dashboardRoute = 'super_admin.dashboard';
                                    break;
                                case 'admin_jurusan':
                                    $dashboardRoute = 'admin_jurusan.dashboard';
                                    break;
                                case 'kajur':
                                    $dashboardRoute = 'kajur.index';
                                    break;
                                case 'kaprodi':
                                    $dashboardRoute = 'kaprodi.index';
                                    break;
                                case 'mahasiswa':
                                    $dashboardRoute = 'mahasiswa.index';
                                    break;
                            }
                        @endphp
                        <a href="{{ route($dashboardRoute) }}"
                            class="text-gray-600 text-xl font-medium hover:text-red-400 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-gray-600 text-xl font-medium hover:text-red-400 transition-colors">Login</a>
                    @endif

                    <a href="#cta-section"
                        class="red-gradient text-white font-semibold py-3 px-6 rounded-lg hover:shadow-lg transition-all duration-200"
                        onclick="toggleMobileMenu()">Coba Sekarang</a>
                </div>
            </div>
        </nav>

        <div class="relative z-10 max-w-7xl mx-auto px-6 text-center">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-7xl font-black text-gradient mb-6">
                    Revolusi Administrasi Akademik
                </h1>

                <p class="text-lg md:text-2xl text-gray-400 mb-8 max-w-3xl mx-auto">
                    Otomatisasi surat mahasiswa yang cepat, aman, dan terverifikasi blockchain
                </p>

                <div
                    class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-8 mb-12">
                    <div class="flex items-center space-x-2 text-gray-400">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <span class="text-sm font-medium">Cepat</span>
                    </div>
                    <div class="flex items-center space-x-2 text-gray-400">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                        <span class="text-sm font-medium">Aman</span>
                    </div>
                    <div class="flex items-center space-x-2 text-gray-400">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-medium">Terverifikasi</span>
                    </div>
                </div>

                <a href="#cta-section"
                    class="hero-button red-gradient text-white font-bold py-4 px-8 rounded-xl text-lg inline-flex items-center space-x-3 group">
                    <span>Coba Sekarang</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>

            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">
                    Cukup 3 Langkah Mudah
                </h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto">
                    Proses administrasi akademik yang revolusioner dengan teknologi blockchain
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 relative">
                <div
                    class="step-card bg-white rounded-2xl p-6 md:p-8 text-center relative shadow-lg border border-gray-100">
                    <div class="step-number">1</div>
                    <div class="connecting-line hidden md:block"></div>

                    <div class="mb-6">
                        <svg class="w-16 md:w-24 h-16 md:h-24 mx-auto text-gray-700" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <rect x="2" y="14" width="20" height="6" rx="2" ry="2" />
                            <rect x="4" y="4" width="16" height="10" rx="1" ry="1" />
                            <rect x="5" y="5" width="14" height="8" rx="0.5" ry="0.5"
                                fill="none" />
                            <circle cx="12" cy="8" r="1.5" fill="none" />
                            <path d="M9 11c0-1.5 1.5-2 3-2s3 0.5 3 2" fill="none" />
                        </svg>
                    </div>

                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">Mahasiswa Request</h3>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                        Mahasiswa mengajukan permohonan surat melalui platform digital dengan mudah
                    </p>
                </div>

                <div
                    class="step-card bg-white rounded-2xl p-6 md:p-8 text-center relative shadow-lg border border-gray-100">
                    <div class="step-number">2</div>
                    <div class="connecting-line hidden md:block"></div>

                    <div class="mb-6">
                        <svg class="w-16 md:w-24 h-16 md:h-24 mx-auto text-gray-700" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14,2 14,8 20,8" />
                            <path d="M15 12l-3 3-2-2" />
                            <circle cx="18" cy="18" r="3" fill="none" />
                            <path d="M16.5 18l1 1 2-2" />
                        </svg>
                    </div>

                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">Approval Digital</h3>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                        Pihak berwenang memberikan persetujuan digital dengan tanda tangan elektronik
                    </p>
                </div>

                <div
                    class="step-card bg-white rounded-2xl p-6 md:p-8 text-center relative shadow-lg border border-gray-100">
                    <div class="step-number">3</div>

                    <div class="mb-6">
                        <svg class="w-16 md:w-24 h-16 md:h-24 mx-auto text-gray-700" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path d="M12 2l8 3v7c0 5-4 9-8 11-4-2-8-6-8-11V5l8-3z" />
                            <rect x="8" y="7" width="8" height="8" fill="none" stroke="currentColor"
                                stroke-width="1" />
                            <rect x="9" y="8" width="1" height="1" fill="currentColor" />
                            <rect x="11" y="8" width="1" height="1" fill="currentColor" />
                            <rect x="14" y="8" width="1" height="1" fill="currentColor" />
                            <rect x="9" y="10" width="1" height="1" fill="currentColor" />
                            <rect x="12" y="10" width="1" height="1" fill="currentColor" />
                            <rect x="14" y="10" width="1" height="1" fill="currentColor" />
                        </svg>
                    </div>

                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">Verifikasi Blockchain</h3>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                        Surat disimpan dalam blockchain dan dilengkapi QR code untuk verifikasi
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6">
                        Verifikasi Instan dengan QR Code
                    </h2>
                    <p class="text-lg md:text-xl text-gray-600 mb-8">
                        Setiap dokumen yang dihasilkan dilengkapi dengan QR code yang terhubung langsung ke blockchain.
                        Verifikasi keaslian dokumen dapat dilakukan kapan saja, di mana saja, hanya dalam hitungan
                        detik.
                    </p>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-6 h-6 red-gradient rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium">Verifikasi real-time 24/7</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-6 h-6 red-gradient rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium">Tidak dapat dipalsukan atau dimanipulasi</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-6 h-6 red-gradient rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium">Akses mudah melalui smartphone</span>
                        </div>
                    </div>

                    <button
                        class="red-gradient text-white font-semibold py-3 px-6 rounded-lg hover:shadow-lg transition-all duration-200">
                        Pelajari Lebih Lanjut
                    </button>
                </div>

                <div class="relative order-1 lg:order-2">
                    <div class="bg-white rounded-3xl p-6 md:p-8 shadow-2xl">
                        <div class="bg-gray-50 rounded-xl p-4 md:p-6 mb-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 red-gradient rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-gray-900 text-sm md:text-base">Surat Keterangan
                                        Aktif</span>
                                </div>
                                <div class="text-xs text-gray-500">ID: #AL2024001</div>
                            </div>

                            <div class="space-y-2 text-xs md:text-sm text-gray-600 mb-4">
                                <div>Nama: Ahmad Rizki Pratama</div>
                                <div>NIM: 2021110001</div>
                                <div>Program Studi: Teknik Informatika</div>
                                <div>Semester: 6 (Enam)</div>
                            </div>

                            <div class="flex justify-center">
                                <div
                                    class="w-20 h-20 md:w-24 md:h-24 bg-white border-2 border-gray-300 rounded-lg flex items-center justify-center">
                                    <svg class="w-12 h-12 md:w-16 md:h-16 text-gray-800" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <rect x="1" y="1" width="6" height="6" fill="currentColor" />
                                        <rect x="17" y="1" width="6" height="6" fill="currentColor" />
                                        <rect x="1" y="17" width="6" height="6" fill="currentColor" />
                                        <rect x="3" y="3" width="2" height="2" fill="white" />
                                        <rect x="19" y="3" width="2" height="2" fill="white" />
                                        <rect x="3" y="19" width="2" height="2" fill="white" />
                                        <rect x="9" y="1" width="2" height="2" fill="currentColor" />
                                        <rect x="13" y="1" width="2" height="2" fill="currentColor" />
                                        <rect x="9" y="5" width="2" height="2" fill="currentColor" />
                                        <rect x="11" y="7" width="2" height="2" fill="currentColor" />
                                        <rect x="15" y="9" width="2" height="2" fill="currentColor" />
                                        <rect x="9" y="11" width="2" height="2" fill="currentColor" />
                                        <rect x="13" y="13" width="2" height="2" fill="currentColor" />
                                        <rect x="17" y="15" width="2" height="2" fill="currentColor" />
                                        <rect x="9" y="17" width="2" height="2" fill="currentColor" />
                                        <rect x="13" y="19" width="2" height="2" fill="currentColor" />
                                        <rect x="17" y="21" width="2" height="2" fill="currentColor" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="relative">
                            <div
                                class="w-32 h-56 bg-gray-900 rounded-2xl mx-auto relative overflow-hidden scan-animation">
                                <div
                                    class="absolute top-2 left-1/2 transform -translate-x-1/2 w-12 h-1 bg-gray-700 rounded-full">
                                </div>
                                <div class="p-4 h-full flex flex-col">
                                    <div
                                        class="flex-1 bg-gray-800 rounded-lg p-3 flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 border-2 border-red-500 rounded-lg mb-2 relative">
                                            <div
                                                class="absolute inset-0 border-2 border-red-500 rounded-lg animate-pulse">
                                            </div>
                                            <div
                                                class="absolute top-1 left-1 w-2 h-2 border-l-2 border-t-2 border-red-500">
                                            </div>
                                            <div
                                                class="absolute top-1 right-1 w-2 h-2 border-r-2 border-t-2 border-red-500">
                                            </div>
                                            <div
                                                class="absolute bottom-1 left-1 w-2 h-2 border-l-2 border-b-2 border-red-500">
                                            </div>
                                            <div
                                                class="absolute bottom-1 right-1 w-2 h-2 border-r-2 border-b-2 border-red-500">
                                            </div>
                                        </div>
                                        <div class="text-xs text-white text-center">Scanning QR Code...</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -bottom-4 -right-4 bg-green-500 text-white rounded-full p-3 md:p-4 shadow-lg">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 md:w-6 md:h-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="font-bold text-xs md:text-sm">VERIFIED</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">
                    Mengapa Memilih AutoLetter?
                </h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto">
                    Solusi terdepan untuk administrasi akademik yang efisien dan terpercaya
                </p>
            </div>

            <div class="flex flex-wrap gap-8 justify-center">
                <div
                    class="benefit-card bg-white rounded-2xl p-6 md:p-8 text-center shadow-lg border border-gray-100 lg:w-1/4">
                    <div class="w-16 h-16 red-gradient rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">Bebas Birokrasi</h3>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                        Tidak perlu lagi mengantri atau menunggu berhari-hari. Proses administrasi selesai dalam
                        hitungan menit.
                    </p>
                </div>

                <div
                    class="benefit-card bg-white rounded-2xl p-6 md:p-8 text-center shadow-lg border border-gray-100 lg:w-1/4">
                    <div class="w-16 h-16 red-gradient rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">Keamanan Terjamin</h3>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                        Teknologi blockchain memastikan dokumen tidak dapat dipalsukan dan selalu dapat diverifikasi
                        keasliannya.
                    </p>
                </div>

                <div
                    class="benefit-card bg-white rounded-2xl p-6 md:p-8 text-center shadow-lg border border-gray-100 lg:w-1/4">
                    <div class="w-16 h-16 red-gradient rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">Efisien & Cepat</h3>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                        Otomatisasi penuh mengurangi kesalahan manusia dan mempercepat seluruh proses administrasi
                        akademik.
                    </p>
                </div>

                <div
                    class="benefit-card bg-white rounded-2xl p-6 md:p-8 text-center shadow-lg border border-gray-100 lg:w-1/4">
                    <div class="w-16 h-16 red-gradient rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">Hemat Biaya</h3>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                        Mengurangi biaya operasional dengan otomatisasi proses dan eliminasi penggunaan kertas.
                    </p>
                </div>

                <div
                    class="benefit-card bg-white rounded-2xl p-6 md:p-8 text-center shadow-lg border border-gray-100 lg:w-1/4">
                    <div class="w-16 h-16 red-gradient rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">Analytics Lengkap</h3>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                        Dashboard analitik memberikan insight mendalam tentang pola dan tren administrasi akademik.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section id="cta-section" class="py-20 bg-gray-50">
        <div class=" mx-auto px-6">
            <div class="rounded-3xl p-10 md:p-16 text-center">

                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">
                    Mulai Gunakan AutoLetter Hari Ini
                </h2>

                <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto mb-10">
                    Daftar dalam hitungan menit dan rasakan langsung kemudahan administrasi akademik yang modern,
                    efisien, dan bebas birokrasi.
                </p>

                <div>
                    @if (Auth::check())
                        @php
                            $dashboardRoute = 'dashboard';

                            switch (Auth::user()->role) {
                                case 'super_admin':
                                    $dashboardRoute = 'super_admin.dashboard';
                                    break;
                                case 'admin_jurusan':
                                    $dashboardRoute = 'admin_jurusan.dashboard';
                                    break;
                                case 'kajur':
                                    $dashboardRoute = 'kajur.index';
                                    break;
                                case 'kaprodi':
                                    $dashboardRoute = 'kaprodi.index';
                                    break;
                                case 'mahasiswa':
                                    $dashboardRoute = 'mahasiswa.index';
                                    break;
                            }
                        @endphp
                        <a href="{{ route($dashboardRoute) }}"
                            class="red-gradient inline-block text-white font-bold py-4 px-8 md:px-12 rounded-xl text-lg hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                            Daftar Gratis Sekarang
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="red-gradient inline-block text-white font-bold py-4 px-8 md:px-12 rounded-xl text-lg hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                            Daftar Gratis Sekarang
                        </a>
                    @endif

                    <p class="text-sm text-gray-500 mt-4">
                        Proses pendaftaran cepat dan mudah.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 red-gradient rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold">AutoLetter</span>
                    </div>
                    <p class="text-gray-400 mb-6 max-w-md">
                        Revolusi administrasi akademik dengan teknologi blockchain untuk masa depan pendidikan yang
                        lebih efisien dan terpercaya.
                    </p>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">
                    © 2025 AutoLetter. Semua hak cipta dilindungi.
                </p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const hamburger = document.querySelector('.hamburger');

            mobileMenu.classList.toggle('open');
            hamburger.classList.toggle('active');
        }

        document.addEventListener('click', function(e) {
            const mobileMenu = document.getElementById('mobileMenu');
            const hamburger = document.querySelector('.hamburger');

            if (!hamburger.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.remove('open');
                hamburger.classList.remove('active');
            }
        });

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });


        function createParticle() {
            const particle = document.createElement('div');
            particle.className = 'data-particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 4 + 's';

            document.querySelector('.hero-gradient').appendChild(particle);

            setTimeout(() => {
                particle.remove();
            }, 4000);
        }

        setInterval(createParticle, 3000);

        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('bg-gray-50/95');
                nav.classList.remove('bg-gray-50/90');
            } else {
                nav.classList.add('bg-gray-50/90');
                nav.classList.remove('bg-gray-50/95');
            }
        });
    </script>

</html>
