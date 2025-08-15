<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoLetter - Student Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }
        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .card-hover:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }
        .logo-text {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .status-pending { @apply bg-yellow-100 text-yellow-800; }
        .status-approved { @apply bg-green-100 text-green-800; }
        .status-rejected { @apply bg-red-100 text-red-800; }
        .status-draft { @apply bg-gray-100 text-gray-800; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Mobile Menu Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

    <!-- Sidebar -->
    <div id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform -translate-x-full lg:translate-x-0 sidebar-transition">
        <div class="flex items-center justify-between h-16 px-6 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <span class="text-xl font-bold logo-text">AutoLetter</span>
            </div>
            <button id="close-sidebar" class="lg:hidden text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <nav class="mt-6 px-3">
            <a href="#" class="flex items-center px-3 py-2 text-red-600 bg-red-50 rounded-lg mb-1 font-medium">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                </svg>
                Dashboard
            </a>
            <a href="#" onclick="showDemo()" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                New Request
            </a>
            <a href="#" onclick="showDemo()" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                My Letters
            </a>
            <a href="#" onclick="showDemo()" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Profile
            </a>
            <a href="#" onclick="showDemo()" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Settings
            </a>
        </nav>

        <div class="absolute bottom-0 w-full p-4 border-t border-gray-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                    <span class="text-red-600 font-semibold text-sm">JS</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">John Smith</p>
                    <p class="text-xs text-gray-500">Student ID: 12345</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Top Bar -->
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="flex items-center justify-between h-16 px-4 sm:px-6">
                <div class="flex items-center">
                    <button id="menu-button" class="lg:hidden text-gray-500 hover:text-gray-700 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-900">Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-gray-500 hover:text-gray-700 relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19h10a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="p-4 sm:p-6">
            <!-- Welcome Section -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Welcome back, John!</h2>
                <p class="text-gray-600">Manage your recommendation letters and track their progress.</p>
            </div>

            <!-- Request New Letter Button -->
            <div class="mb-8">
                <button onclick="openLetterModal()" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-red-200 card-shadow">
                    <div class="flex items-center justify-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Request New Letter
                    </div>
                </button>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-xl p-6 card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">8</p>
                            <p class="text-sm text-gray-600">Total Letters</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">3</p>
                            <p class="text-sm text-gray-600">Pending</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">4</p>
                            <p class="text-sm text-gray-600">Approved</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">1</p>
                            <p class="text-sm text-gray-600">Draft</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My Letter History -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">My Letter History</h3>
                    <button onclick="showDemo()" class="text-red-600 hover:text-red-700 font-medium text-sm">View All</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    <!-- Letter Card 1 -->
                    <div class="bg-white rounded-xl p-6 card-shadow card-hover transition-all duration-200 cursor-pointer" onclick="showDemo()">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-1">Graduate School Application</h4>
                                <p class="text-sm text-gray-600">Prof. Sarah Johnson</p>
                            </div>
                            <span class="status-approved px-2 py-1 rounded-full text-xs font-medium">Approved</span>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Requested:</span>
                                <span>Dec 15, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Deadline:</span>
                                <span>Jan 15, 2024</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Institution:</span>
                                <span>MIT</span>
                            </div>
                        </div>
                    </div>

                    <!-- Letter Card 2 -->
                    <div class="bg-white rounded-xl p-6 card-shadow card-hover transition-all duration-200 cursor-pointer" onclick="showDemo()">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-1">Research Internship</h4>
                                <p class="text-sm text-gray-600">Dr. Michael Chen</p>
                            </div>
                            <span class="status-pending px-2 py-1 rounded-full text-xs font-medium">Pending</span>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Requested:</span>
                                <span>Dec 20, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Deadline:</span>
                                <span>Feb 1, 2024</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Company:</span>
                                <span>Google Research</span>
                            </div>
                        </div>
                    </div>

                    <!-- Letter Card 3 -->
                    <div class="bg-white rounded-xl p-6 card-shadow card-hover transition-all duration-200 cursor-pointer" onclick="showDemo()">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-1">Scholarship Application</h4>
                                <p class="text-sm text-gray-600">Prof. Emily Davis</p>
                            </div>
                            <span class="status-approved px-2 py-1 rounded-full text-xs font-medium">Approved</span>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Requested:</span>
                                <span>Nov 30, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Deadline:</span>
                                <span>Dec 31, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Organization:</span>
                                <span>NSF Fellowship</span>
                            </div>
                        </div>
                    </div>

                    <!-- Letter Card 4 -->
                    <div class="bg-white rounded-xl p-6 card-shadow card-hover transition-all duration-200 cursor-pointer" onclick="showDemo()">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-1">Job Application</h4>
                                <p class="text-sm text-gray-600">Prof. Robert Wilson</p>
                            </div>
                            <span class="status-pending px-2 py-1 rounded-full text-xs font-medium">Pending</span>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Requested:</span>
                                <span>Dec 18, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Deadline:</span>
                                <span>Jan 30, 2024</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Company:</span>
                                <span>Microsoft</span>
                            </div>
                        </div>
                    </div>

                    <!-- Letter Card 5 -->
                    <div class="bg-white rounded-xl p-6 card-shadow card-hover transition-all duration-200 cursor-pointer" onclick="showDemo()">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-1">PhD Program</h4>
                                <p class="text-sm text-gray-600">Dr. Lisa Anderson</p>
                            </div>
                            <span class="status-draft px-2 py-1 rounded-full text-xs font-medium">Draft</span>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Requested:</span>
                                <span>Dec 22, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Deadline:</span>
                                <span>Mar 1, 2024</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Institution:</span>
                                <span>Stanford</span>
                            </div>
                        </div>
                    </div>

                    <!-- Letter Card 6 -->
                    <div class="bg-white rounded-xl p-6 card-shadow card-hover transition-all duration-200 cursor-pointer" onclick="showDemo()">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-1">Summer Program</h4>
                                <p class="text-sm text-gray-600">Prof. James Taylor</p>
                            </div>
                            <span class="status-approved px-2 py-1 rounded-full text-xs font-medium">Approved</span>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Requested:</span>
                                <span>Nov 25, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Deadline:</span>
                                <span>Dec 15, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Program:</span>
                                <span>REU Program</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- New Letter Request Modal -->
    <div id="letter-modal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50 px-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Formulir Permintaan Surat</h2>
                <button onclick="closeLetterModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form class="p-6 space-y-6" onsubmit="handleLetterSubmit(event)">
                <!-- Letter Type Dropdown -->
                <div>
                    <label for="letter-type" class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Jenis Surat <span class="text-red-500">*</span>
                    </label>
                    <select id="letter-type" name="letter-type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900">
                        <option value="">-- Pilih Jenis Surat --</option>
                        <option value="surat-aktif-kuliah">Surat Aktif Kuliah</option>
                        <option value="izin-penelitian">Izin Penelitian</option>
                        <option value="surat-rekomendasi">Surat Rekomendasi</option>
                        <option value="surat-keterangan">Surat Keterangan</option>
                        <option value="surat-magang">Surat Magang</option>
                        <option value="surat-cuti">Surat Cuti Akademik</option>
                    </select>
                </div>

                <!-- Auto-filled Fields Section -->
                <div class="bg-gray-50 rounded-lg p-4 space-y-4">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Data Mahasiswa (Otomatis Terisi)</h3>
                    
                    <!-- Full Name -->
                    <div>
                        <label for="full-name" class="block text-sm font-medium text-gray-600 mb-1">
                            Nama Lengkap
                        </label>
                        <input 
                            type="text" 
                            id="full-name" 
                            name="full-name" 
                            value="John Smith"
                            readonly
                            class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed"
                        >
                    </div>

                    <!-- Student ID -->
                    <div>
                        <label for="nim" class="block text-sm font-medium text-gray-600 mb-1">
                            NIM
                        </label>
                        <input 
                            type="text" 
                            id="nim" 
                            name="nim" 
                            value="12345678"
                            readonly
                            class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed"
                        >
                    </div>

                    <!-- Program Study -->
                    <div>
                        <label for="program-study" class="block text-sm font-medium text-gray-600 mb-1">
                            Program Studi
                        </label>
                        <input 
                            type="text" 
                            id="program-study" 
                            name="program-study" 
                            value="Teknik Informatika"
                            readonly
                            class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed"
                        >
                    </div>

                    <!-- Faculty -->
                    <div>
                        <label for="faculty" class="block text-sm font-medium text-gray-600 mb-1">
                            Fakultas
                        </label>
                        <input 
                            type="text" 
                            id="faculty" 
                            name="faculty" 
                            value="Fakultas Teknik"
                            readonly
                            class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed"
                        >
                    </div>

                    <!-- Semester -->
                    <div>
                        <label for="semester" class="block text-sm font-medium text-gray-600 mb-1">
                            Semester
                        </label>
                        <input 
                            type="text" 
                            id="semester" 
                            name="semester" 
                            value="7"
                            readonly
                            class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed"
                        >
                    </div>
                </div>

                <!-- Purpose Field -->
                <div>
                    <label for="purpose" class="block text-sm font-medium text-gray-700 mb-2">
                        Keperluan <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="purpose" 
                        name="purpose" 
                        rows="3" 
                        required
                        placeholder="Jelaskan keperluan surat yang diminta..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500 resize-none"
                    ></textarea>
                </div>

                <!-- Deadline -->
                <div>
                    <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Diperlukan <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        id="deadline" 
                        name="deadline" 
                        required
                        min="2024-01-01"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900"
                    >
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button 
                        type="button" 
                        onclick="closeLetterModal()"
                        class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-200"
                    >
                        Cancel
                    </button>
                    <button 
                        type="submit"
                        class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-200"
                    >
                        Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Demo Modal -->
    <div id="demo-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 px-4">
        <div class="bg-white rounded-xl p-6 max-w-sm w-full">
            <div class="text-center">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Demo Dashboard</h3>
                <p class="text-gray-600 text-sm mb-4">This is a demo interface. In a real application, this would connect to your university's letter management system.</p>
                <button onclick="closeModal()" class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                    Got it
                </button>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu functionality
        const menuButton = document.getElementById('menu-button');
        const sidebar = document.getElementById('sidebar');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const closeSidebar = document.getElementById('close-sidebar');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            mobileOverlay.classList.remove('hidden');
        }

        function closeSidebarFunc() {
            sidebar.classList.add('-translate-x-full');
            mobileOverlay.classList.add('hidden');
        }

        menuButton.addEventListener('click', openSidebar);
        closeSidebar.addEventListener('click', closeSidebarFunc);
        mobileOverlay.addEventListener('click', closeSidebarFunc);

        // Letter modal functionality
        function openLetterModal() {
            document.getElementById('letter-modal').classList.remove('hidden');
            document.getElementById('letter-modal').classList.add('flex');
            // Set minimum date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('deadline').setAttribute('min', today);
        }

        function closeLetterModal() {
            document.getElementById('letter-modal').classList.add('hidden');
            document.getElementById('letter-modal').classList.remove('flex');
            // Reset form
            document.querySelector('#letter-modal form').reset();
        }

        function handleLetterSubmit(event) {
            event.preventDefault();
            // Show success message
            closeLetterModal();
            showSuccessMessage();
        }

        function showSuccessMessage() {
            // Create temporary success notification
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';
            notification.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Permintaan surat berhasil dikirim!
                </div>
            `;
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);
            
            // Remove after 3 seconds
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Demo modal functionality
        function showDemo() {
            document.getElementById('demo-modal').classList.remove('hidden');
            document.getElementById('demo-modal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('demo-modal').classList.add('hidden');
            document.getElementById('demo-modal').classList.remove('flex');
        }

        // Close modals when clicking outside
        document.getElementById('letter-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeLetterModal();
            }
        });

        document.getElementById('demo-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close sidebar on window resize if mobile
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                closeSidebarFunc();
            }
        });
    </script>
    </body>
</html>
