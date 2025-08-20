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
                        onclick="toggleMobileMenu()">Request Demo</a>
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
                    <span>Request Demo</span>
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

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="benefit-card bg-white rounded-2xl p-6 md:p-8 text-center shadow-lg border border-gray-100">
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

                <div class="benefit-card bg-white rounded-2xl p-6 md:p-8 text-center shadow-lg border border-gray-100">
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

                <div class="benefit-card bg-white rounded-2xl p-6 md:p-8 text-center shadow-lg border border-gray-100">
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

                <div class="benefit-card bg-white rounded-2xl p-6 md:p-8 text-center shadow-lg border border-gray-100">
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

                <div class="benefit-card bg-white rounded-2xl p-6 md:p-8 text-center shadow-lg border border-gray-100">
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

                <div class="benefit-card bg-white rounded-2xl p-6 md:p-8 text-center shadow-lg border border-gray-100">
                    <div class="w-16 h-16 red-gradient rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">Ramah Lingkungan</h3>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                        Sistem paperless yang mendukung program go-green dan sustainability di lingkungan kampus.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="cta-section" class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-white rounded-3xl p-6 md:p-12 shadow-2xl">
                <div class="text-center mb-8">
                    <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">
                        Siap Bertransformasi?
                    </h2>
                    <p class="text-lg md:text-xl text-gray-600">
                        Bergabunglah dengan universitas terdepan yang telah mempercayai AutoLetter
                    </p>
                </div>

                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                placeholder="Masukkan nama lengkap">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Institusi</label>
                            <input type="email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                placeholder="nama@universitas.ac.id">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Institusi</label>
                            <input type="text"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                placeholder="Universitas Indonesia">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Posisi/Jabatan</label>
                            <select
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                <option>Pilih posisi Anda</option>
                                <option>Rektor/Wakil Rektor</option>
                                <option>Dekan/Wakil Dekan</option>
                                <option>Kepala Program Studi</option>
                                <option>Staff Akademik</option>
                                <option>Staff IT</option>
                                <option>Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pesan (Opsional)</label>
                        <textarea rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                            placeholder="Ceritakan kebutuhan spesifik institusi Anda..."></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit"
                            class="red-gradient text-white font-bold py-4 px-8 md:px-12 rounded-xl text-lg hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                            Request Demo Gratis
                        </button>
                        <p class="text-sm text-gray-500 mt-4">
                            Tim kami akan menghubungi Anda dalam 24 jam
                        </p>
                    </div>
                </form>
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
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-6">Produk</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Fitur Utama</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Keamanan</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Integrasi</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">API
                                Documentation</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-6">Dukungan</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Pusat
                                Bantuan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Kontak</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Status
                                System</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Kebijakan
                                Privasi</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">
                    © 2024 AutoLetter. Semua hak cipta dilindungi.
                </p>
                <div class="flex items-center space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Syarat &
                        Ketentuan</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Kebijakan
                        Privasi</a>
                </div>
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

        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();

            const notification = document.createElement('div');
            notification.className =
                'fixed top-6 right-6 bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg z-50 transform translate-x-full transition-transform duration-300 max-w-sm';
            notification.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm font-medium">Demo request berhasil dikirim! Tim kami akan menghubungi Anda dalam 24 jam.</span>
                </div>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 5000);

            this.reset();
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
