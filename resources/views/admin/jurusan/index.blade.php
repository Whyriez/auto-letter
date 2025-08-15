<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoLetter - Admin Template Management</title>
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

        .status-active {
            @apply bg-green-100 text-green-800;
        }

        .status-draft {
            @apply bg-yellow-100 text-yellow-800;
        }

        .status-archived {
            @apply bg-gray-100 text-gray-800;
        }

        /* Mobile card styles */
        @media (max-width: 768px) {
            .desktop-table {
                display: none;
            }

            .mobile-cards {
                display: block;
            }
        }

        @media (min-width: 769px) {
            .desktop-table {
                display: table;
            }

            .mobile-cards {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Mobile Menu Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

    <!-- Sidebar -->
    <div id="sidebar"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform -translate-x-full lg:translate-x-0 sidebar-transition">
        <div class="flex items-center justify-between h-16 px-6 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <span class="text-xl font-bold logo-text">AutoLetter</span>
            </div>
            <button id="close-sidebar" class="lg:hidden text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <nav class="mt-6 px-3">
            <a href="#" onclick="showDemo()"
                class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                </svg>
                Dashboard
            </a>
            <a href="#" class="flex items-center px-3 py-2 text-red-600 bg-red-50 rounded-lg mb-1 font-medium">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                Template Management
            </a>
            <a href="#" onclick="showDemo()"
                class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                    </path>
                </svg>
                User Management
            </a>
            <a href="#" onclick="showDemo()"
                class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                    </path>
                </svg>
                Reports
            </a>
            <a href="#" onclick="showDemo()"
                class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Settings
            </a>
        </nav>

        <div class="absolute bottom-0 w-full p-4 border-t border-gray-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                    <span class="text-red-600 font-semibold text-sm">AM</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">Admin Maria</p>
                    <p class="text-xs text-gray-500">Department Admin</p>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-900">Template Management</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-gray-500 hover:text-gray-700 relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-5 5v-5zM4 19h10a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
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
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Letter Template Management</h2>
                <p class="text-gray-600">Create, edit, and manage letter templates for your department.</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-xl p-6 card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">15</p>
                            <p class="text-sm text-gray-600">Total Templates</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">12</p>
                            <p class="text-sm text-gray-600">Active Templates</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">2</p>
                            <p class="text-sm text-gray-600">Draft Templates</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">248</p>
                            <p class="text-sm text-gray-600">Times Used</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add New Template Button -->
            <div class="mb-8">
                <button onclick="openTemplateModal()"
                    class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-red-200 card-shadow">
                    <div class="flex items-center justify-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New Template
                    </div>
                </button>
            </div>

            <!-- Filters and Search -->
            <div class="bg-white rounded-xl p-4 sm:p-6 card-shadow mb-6">
                <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                    <div class="flex flex-col sm:flex-row gap-4 flex-1">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" placeholder="Search templates..."
                                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 w-full sm:w-64">
                        </div>
                        <select
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">All Categories</option>
                            <option value="academic">Academic Letters</option>
                            <option value="administrative">Administrative</option>
                            <option value="recommendation">Recommendation</option>
                            <option value="certification">Certification</option>
                        </select>
                        <select
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="draft">Draft</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>
                    <button onclick="showDemo()"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors">
                        Export Templates
                    </button>
                </div>
            </div>

            <!-- Templates Table -->
            <div class="bg-white rounded-xl card-shadow overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 bg-red-50">
                    <h3 class="text-lg font-semibold text-red-900">Letter Templates</h3>
                    <p class="text-sm text-red-700 mt-1">Manage and organize your department's letter templates</p>
                </div>

                <!-- Desktop Table -->
                <div class="desktop-table overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Template Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Last Modified</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Usage Count</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Surat Aktif Kuliah</div>
                                            <div class="text-sm text-gray-500">Academic enrollment letter</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Academic Letters</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dec 20, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="status-active px-2 py-1 rounded-full text-xs font-medium">Active</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">45</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="editTemplate('Surat Aktif Kuliah')"
                                        class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">Edit</button>
                                    <button onclick="duplicateTemplate('Surat Aktif Kuliah')"
                                        class="text-purple-600 hover:text-purple-900 bg-purple-50 hover:bg-purple-100 px-3 py-1 rounded-lg transition-colors">Duplicate</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Izin Penelitian</div>
                                            <div class="text-sm text-gray-500">Research permission letter</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Administrative</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dec 18, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="status-active px-2 py-1 rounded-full text-xs font-medium">Active</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">32</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="editTemplate('Izin Penelitian')"
                                        class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">Edit</button>
                                    <button onclick="duplicateTemplate('Izin Penelitian')"
                                        class="text-purple-600 hover:text-purple-900 bg-purple-50 hover:bg-purple-100 px-3 py-1 rounded-lg transition-colors">Duplicate</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Surat Rekomendasi</div>
                                            <div class="text-sm text-gray-500">Letter of recommendation</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Recommendation</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dec 15, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="status-active px-2 py-1 rounded-full text-xs font-medium">Active</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">67</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="editTemplate('Surat Rekomendasi')"
                                        class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">Edit</button>
                                    <button onclick="duplicateTemplate('Surat Rekomendasi')"
                                        class="text-purple-600 hover:text-purple-900 bg-purple-50 hover:bg-purple-100 px-3 py-1 rounded-lg transition-colors">Duplicate</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Surat Keterangan</div>
                                            <div class="text-sm text-gray-500">Certificate letter</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Certification</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dec 12, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-draft px-2 py-1 rounded-full text-xs font-medium">Draft</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">0</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="editTemplate('Surat Keterangan')"
                                        class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">Edit</button>
                                    <button onclick="duplicateTemplate('Surat Keterangan')"
                                        class="text-purple-600 hover:text-purple-900 bg-purple-50 hover:bg-purple-100 px-3 py-1 rounded-lg transition-colors">Duplicate</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Surat Magang</div>
                                            <div class="text-sm text-gray-500">Internship letter</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Academic Letters</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dec 10, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="status-active px-2 py-1 rounded-full text-xs font-medium">Active</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">28</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="editTemplate('Surat Magang')"
                                        class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">Edit</button>
                                    <button onclick="duplicateTemplate('Surat Magang')"
                                        class="text-purple-600 hover:text-purple-900 bg-purple-50 hover:bg-purple-100 px-3 py-1 rounded-lg transition-colors">Duplicate</button>
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
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Surat Aktif Kuliah</div>
                                    <div class="text-xs text-gray-500">Academic enrollment letter</div>
                                </div>
                            </div>
                            <span class="status-active px-2 py-1 rounded-full text-xs font-medium">Active</span>
                        </div>
                        <div class="space-y-2 text-sm mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Category:</span>
                                <span class="text-gray-900 font-medium">Academic Letters</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Last Modified:</span>
                                <span class="text-gray-900">Dec 20, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Usage Count:</span>
                                <span class="text-gray-900">45 times</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="editTemplate('Surat Aktif Kuliah')"
                                class="flex-1 text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Edit</button>
                            <button onclick="duplicateTemplate('Surat Aktif Kuliah')"
                                class="flex-1 text-purple-600 hover:text-purple-900 bg-purple-50 hover:bg-purple-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Duplicate</button>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-gray-50 rounded-lg p-4 card-hover transition-all duration-200">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Izin Penelitian</div>
                                    <div class="text-xs text-gray-500">Research permission letter</div>
                                </div>
                            </div>
                            <span class="status-active px-2 py-1 rounded-full text-xs font-medium">Active</span>
                        </div>
                        <div class="space-y-2 text-sm mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Category:</span>
                                <span class="text-gray-900 font-medium">Administrative</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Last Modified:</span>
                                <span class="text-gray-900">Dec 18, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Usage Count:</span>
                                <span class="text-gray-900">32 times</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="editTemplate('Izin Penelitian')"
                                class="flex-1 text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Edit</button>
                            <button onclick="duplicateTemplate('Izin Penelitian')"
                                class="flex-1 text-purple-600 hover:text-purple-900 bg-purple-50 hover:bg-purple-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Duplicate</button>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-gray-50 rounded-lg p-4 card-hover transition-all duration-200">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Surat Rekomendasi</div>
                                    <div class="text-xs text-gray-500">Letter of recommendation</div>
                                </div>
                            </div>
                            <span class="status-active px-2 py-1 rounded-full text-xs font-medium">Active</span>
                        </div>
                        <div class="space-y-2 text-sm mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Category:</span>
                                <span class="text-gray-900 font-medium">Recommendation</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Last Modified:</span>
                                <span class="text-gray-900">Dec 15, 2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Usage Count:</span>
                                <span class="text-gray-900">67 times</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="editTemplate('Surat Rekomendasi')"
                                class="flex-1 text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Edit</button>
                            <button onclick="duplicateTemplate('Surat Rekomendasi')"
                                class="flex-1 text-purple-600 hover:text-purple-900 bg-purple-50 hover:bg-purple-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Duplicate</button>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="px-4 sm:px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span
                                class="font-medium">15</span> results
                        </div>
                        <div class="flex space-x-2">
                            <button
                                class="px-3 py-1 text-sm text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50"
                                disabled>Previous</button>
                            <button
                                class="px-3 py-1 text-sm text-white bg-red-600 border border-red-600 rounded-lg">1</button>
                            <button
                                class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                            <button
                                class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">3</button>
                            <button
                                class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Template Modal -->
    <div id="template-modal"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50 px-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h2 id="modal-title" class="text-xl font-semibold text-gray-900">Create New Template</h2>
                <button onclick="closeTemplateModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form class="p-6 space-y-6" onsubmit="handleTemplateSubmit(event)">
                <!-- Template Name -->
                <div>
                    <label for="template-name" class="block text-sm font-medium text-gray-700 mb-2">
                        Template Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="template-name" name="template-name" required
                        placeholder="Enter template name..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500">
                </div>

                <!-- Category -->
                <div>
                    <label for="template-category" class="block text-sm font-medium text-gray-700 mb-2">
                        Category <span class="text-red-500">*</span>
                    </label>
                    <select id="template-category" name="template-category" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900">
                        <option value="">-- Select Category --</option>
                        <option value="academic">Academic Letters</option>
                        <option value="administrative">Administrative</option>
                        <option value="recommendation">Recommendation</option>
                        <option value="certification">Certification</option>
                    </select>
                </div>

                <!-- Header Content -->
                <div>
                    <label for="header-content" class="block text-sm font-medium text-gray-700 mb-2">
                        Header Content <span class="text-red-500">*</span>
                    </label>
                    <textarea id="header-content" name="header-content" rows="4" required
                        placeholder="Enter the header content for the letter template..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500 resize-none"></textarea>
                    <p class="text-xs text-gray-500 mt-1">Include letterhead, department info, and contact details</p>
                </div>

                <!-- Body Content -->
                <div>
                    <label for="body-content" class="block text-sm font-medium text-gray-700 mb-2">
                        Body Content <span class="text-red-500">*</span>
                    </label>
                    <textarea id="body-content" name="body-content" rows="8" required
                        placeholder="Enter the main body content of the letter template..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500 resize-none"></textarea>
                    <p class="text-xs text-gray-500 mt-1">Use placeholders like {{ student_name }},
                        {{ nim }}, {{ program }} for dynamic content</p>
                </div>

                <!-- Footer Content -->
                <div>
                    <label for="footer-content" class="block text-sm font-medium text-gray-700 mb-2">
                        Footer Content
                    </label>
                    <textarea id="footer-content" name="footer-content" rows="3"
                        placeholder="Enter footer content (signatures, stamps, etc.)..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500 resize-none"></textarea>
                </div>

                <!-- Template Status -->
                <div>
                    <label for="template-status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="template-status" name="template-status" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900">
                        <option value="draft">Draft</option>
                        <option value="active">Active</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="button" onclick="closeTemplateModal()"
                        class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-200">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-200">
                        <span id="submit-text">Create Template</span>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Demo Dashboard</h3>
                <p class="text-gray-600 text-sm mb-4">This is a demo interface. In a real application, this would
                    connect to your template management system.</p>
                <button onclick="closeModal()"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
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

        // Template modal functionality
        function openTemplateModal(templateName = null) {
            const modal = document.getElementById('template-modal');
            const modalTitle = document.getElementById('modal-title');
            const submitText = document.getElementById('submit-text');

            if (templateName) {
                modalTitle.textContent = `Edit Template: ${templateName}`;
                submitText.textContent = 'Update Template';
                // Pre-fill form with existing data (in real app, this would come from API)
                document.getElementById('template-name').value = templateName;
            } else {
                modalTitle.textContent = 'Create New Template';
                submitText.textContent = 'Create Template';
                // Reset form
                document.querySelector('#template-modal form').reset();
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeTemplateModal() {
            document.getElementById('template-modal').classList.add('hidden');
            document.getElementById('template-modal').classList.remove('flex');
            // Reset form
            document.querySelector('#template-modal form').reset();
        }

        function handleTemplateSubmit(event) {
            event.preventDefault();
            const templateName = document.getElementById('template-name').value;
            closeTemplateModal();
            showSuccessMessage(`Template "${templateName}" has been saved successfully!`, 'green');
        }

        // Action functions
        function editTemplate(templateName) {
            openTemplateModal(templateName);
        }

        function duplicateTemplate(templateName) {
            showSuccessMessage(`Template "${templateName}" has been duplicated!`, 'blue');
        }

        function showSuccessMessage(message, color = 'green') {
            const colorClasses = {
                green: 'bg-green-500',
                blue: 'bg-blue-500',
                red: 'bg-red-500'
            };

            const notification = document.createElement('div');
            notification.className =
                `fixed top-4 right-4 ${colorClasses[color]} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
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

        // Close modals when clicking outside
        document.getElementById('template-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeTemplateModal();
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
