<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoLetter - HOD Approval Dashboard</title>
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
        .status-urgent { @apply bg-orange-100 text-orange-800; }
        
        /* Mobile card styles */
        @media (max-width: 768px) {
            .desktop-table { display: none; }
            .mobile-cards { display: block; }
        }
        
        @media (min-width: 769px) {
            .desktop-table { display: table; }
            .mobile-cards { display: none; }
        }
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                Approval Dashboard
            </a>
            <a href="#" onclick="showDemo()" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Analytics
            </a>
            <a href="#" onclick="showDemo()" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
                Students
            </a>
            <a href="#" onclick="showDemo()" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Letter Templates
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
                    <span class="text-red-600 font-semibold text-sm">DR</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">Dr. Robert Chen</p>
                    <p class="text-xs text-gray-500">Head of Department</p>
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
                    <h1 class="text-xl font-semibold text-gray-900">Approval Dashboard</h1>
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
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Welcome, Dr. Chen!</h2>
                <p class="text-gray-600">Review and approve pending letter requests from your department.</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-xl p-6 card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">12</p>
                            <p class="text-sm text-gray-600">Pending Requests</p>
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
                            <p class="text-2xl font-bold text-gray-900">28</p>
                            <p class="text-sm text-gray-600">Approved Today</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">3</p>
                            <p class="text-sm text-gray-600">Urgent</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">156</p>
                            <p class="text-sm text-gray-600">Total This Month</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="bg-white rounded-xl p-4 sm:p-6 card-shadow mb-6">
                <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                    <div class="flex flex-col sm:flex-row gap-4 flex-1">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" placeholder="Search by student name..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 w-full sm:w-64">
                        </div>
                        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">All Letter Types</option>
                            <option value="surat-aktif-kuliah">Surat Aktif Kuliah</option>
                            <option value="izin-penelitian">Izin Penelitian</option>
                            <option value="surat-rekomendasi">Surat Rekomendasi</option>
                            <option value="surat-keterangan">Surat Keterangan</option>
                        </select>
                        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">All Priorities</option>
                            <option value="urgent">Urgent</option>
                            <option value="normal">Normal</option>
                        </select>
                    </div>
                    <button onclick="showDemo()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        Export Report
                    </button>
                </div>
            </div>

            <!-- Pending Approval Requests -->
            <div class="bg-white rounded-xl card-shadow overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 bg-red-50">
                    <h3 class="text-lg font-semibold text-red-900">Pending Approval Requests</h3>
                    <p class="text-sm text-red-700 mt-1">Review and approve letter requests from students</p>
                </div>

                <!-- Desktop Table -->
                <div class="desktop-table overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Letter Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Requested</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deadline</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-blue-600 font-semibold text-sm">AS</span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Ahmad Santoso</div>
                                            <div class="text-sm text-gray-500">NIM: 20210001</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Surat Aktif Kuliah</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dec 20, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dec 25, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-urgent px-2 py-1 rounded-full text-xs font-medium">Urgent</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="viewDetails('Ahmad Santoso')" class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">View Details</button>
                                    <button onclick="approveRequest('Ahmad Santoso')" class="text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 px-3 py-1 rounded-lg transition-colors">Approve</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-purple-600 font-semibold text-sm">SP</span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Sari Putri</div>
                                            <div class="text-sm text-gray-500">NIM: 20210002</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Izin Penelitian</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dec 19, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jan 5, 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-pending px-2 py-1 rounded-full text-xs font-medium">Normal</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="viewDetails('Sari Putri')" class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">View Details</button>
                                    <button onclick="approveRequest('Sari Putri')" class="text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 px-3 py-1 rounded-lg transition-colors">Approve</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-green-600 font-semibold text-sm">BW</span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Budi Wijaya</div>
                                            <div class="text-sm text-gray-500">NIM: 20210003</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Surat Rekomendasi</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dec 18, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dec 30, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-urgent px-2 py-1 rounded-full text-xs font-medium">Urgent</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="viewDetails('Budi Wijaya')" class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">View Details</button>
                                    <button onclick="approveRequest('Budi Wijaya')" class="text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 px-3 py-1 rounded-lg transition-colors">Approve</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-pink-600 font-semibold text-sm">DF</span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Dewi Fatimah</div>
                                            <div class="text-sm text-gray-500">NIM: 20210004</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Surat Keterangan</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dec 17, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jan 10, 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-pending px-2 py-1 rounded-full text-xs font-medium">Normal</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="viewDetails('Dewi Fatimah')" class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">View Details</button>
                                    <button onclick="approveRequest('Dewi Fatimah')" class="text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 px-3 py-1 rounded-lg transition-colors">Approve</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-indigo-600 font-semibold text-sm">RH</span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Rizki Hakim</div>
                                            <div class="text-sm text-gray-500">NIM: 20210005</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Surat Aktif Kuliah</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dec 16, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dec 28, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-urgent px-2 py-1 rounded-full text-xs font-medium">Urgent</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="viewDetails('Rizki Hakim')" class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">View Details</button>
                                    <button onclick="approveRequest('Rizki Hakim')" class="text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 px-3 py-1 rounded-lg transition-colors">Approve</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Cards -->
                <div class="mobile-cards p-4 space-y-4">
                    <!-- Card 1 -->
                    <div class="bg-gray-50 rounded-lg p-4 card-hover transition-all duration-200">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-blue-600 font-semibold text-sm">AS</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Ahmad Santoso</div>
                                    <div class="text-xs text-gray-500">NIM: 20210001</div>
                                </div>
                            </div>
                            <span class="status-urgent px-2 py-1 rounded-full text-xs font-medium">Urgent</span>
                        </div>
                        <div class="space-y-2 text-sm mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Letter Type:</span>
                                <span class="text-gray-900 font-medium">Surat Aktif Kuliah</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Requested:</span>
                                <span class="text-gray-900">Dec 20, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Deadline:</span>
                                <span class="text-gray-900">Dec 25, 2023</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="viewDetails('Ahmad Santoso')" class="flex-1 text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">View Details</button>
                            <button onclick="approveRequest('Ahmad Santoso')" class="flex-1 text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Approve</button>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-gray-50 rounded-lg p-4 card-hover transition-all duration-200">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-purple-600 font-semibold text-sm">SP</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Sari Putri</div>
                                    <div class="text-xs text-gray-500">NIM: 20210002</div>
                                </div>
                            </div>
                            <span class="status-pending px-2 py-1 rounded-full text-xs font-medium">Normal</span>
                        </div>
                        <div class="space-y-2 text-sm mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Letter Type:</span>
                                <span class="text-gray-900 font-medium">Izin Penelitian</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Requested:</span>
                                <span class="text-gray-900">Dec 19, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Deadline:</span>
                                <span class="text-gray-900">Jan 5, 2024</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="viewDetails('Sari Putri')" class="flex-1 text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">View Details</button>
                            <button onclick="approveRequest('Sari Putri')" class="flex-1 text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Approve</button>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-gray-50 rounded-lg p-4 card-hover transition-all duration-200">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-green-600 font-semibold text-sm">BW</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Budi Wijaya</div>
                                    <div class="text-xs text-gray-500">NIM: 20210003</div>
                                </div>
                            </div>
                            <span class="status-urgent px-2 py-1 rounded-full text-xs font-medium">Urgent</span>
                        </div>
                        <div class="space-y-2 text-sm mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Letter Type:</span>
                                <span class="text-gray-900 font-medium">Surat Rekomendasi</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Requested:</span>
                                <span class="text-gray-900">Dec 18, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Deadline:</span>
                                <span class="text-gray-900">Dec 30, 2023</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="viewDetails('Budi Wijaya')" class="flex-1 text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">View Details</button>
                            <button onclick="approveRequest('Budi Wijaya')" class="flex-1 text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Approve</button>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="bg-gray-50 rounded-lg p-4 card-hover transition-all duration-200">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-pink-600 font-semibold text-sm">DF</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Dewi Fatimah</div>
                                    <div class="text-xs text-gray-500">NIM: 20210004</div>
                                </div>
                            </div>
                            <span class="status-pending px-2 py-1 rounded-full text-xs font-medium">Normal</span>
                        </div>
                        <div class="space-y-2 text-sm mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Letter Type:</span>
                                <span class="text-gray-900 font-medium">Surat Keterangan</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Requested:</span>
                                <span class="text-gray-900">Dec 17, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Deadline:</span>
                                <span class="text-gray-900">Jan 10, 2024</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="viewDetails('Dewi Fatimah')" class="flex-1 text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">View Details</button>
                            <button onclick="approveRequest('Dewi Fatimah')" class="flex-1 text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Approve</button>
                        </div>
                    </div>

                    <!-- Card 5 -->
                    <div class="bg-gray-50 rounded-lg p-4 card-hover transition-all duration-200">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-indigo-600 font-semibold text-sm">RH</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Rizki Hakim</div>
                                    <div class="text-xs text-gray-500">NIM: 20210005</div>
                                </div>
                            </div>
                            <span class="status-urgent px-2 py-1 rounded-full text-xs font-medium">Urgent</span>
                        </div>
                        <div class="space-y-2 text-sm mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Letter Type:</span>
                                <span class="text-gray-900 font-medium">Surat Aktif Kuliah</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Requested:</span>
                                <span class="text-gray-900">Dec 16, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Deadline:</span>
                                <span class="text-gray-900">Dec 28, 2023</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="viewDetails('Rizki Hakim')" class="flex-1 text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">View Details</button>
                            <button onclick="approveRequest('Rizki Hakim')" class="flex-1 text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Approve</button>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="px-4 sm:px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">12</span> results
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 text-sm text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50" disabled>Previous</button>
                            <button class="px-3 py-1 text-sm text-white bg-red-600 border border-red-600 rounded-lg">1</button>
                            <button class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                            <button class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">3</button>
                            <button class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
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
                <p class="text-gray-600 text-sm mb-4">This is a demo interface. In a real application, this would connect to your university's approval system.</p>
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

        // Action functions
        function viewDetails(studentName) {
            showSuccessMessage(`Viewing details for ${studentName}`, 'blue');
        }

        function approveRequest(studentName) {
            showSuccessMessage(`Request approved for ${studentName}`, 'green');
        }

        function showSuccessMessage(message, color = 'green') {
            const colorClasses = {
                green: 'bg-green-500',
                blue: 'bg-blue-500',
                red: 'bg-red-500'
            };
            
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 ${colorClasses[color]} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    ${message}
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

        // Close modal when clicking outside
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
