<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoLetter - Admin Template Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
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

        .desktop-table {
            width: 100%;
            overflow-x: auto;
            /* supaya kalau tabelnya panjang bisa di-scroll */
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
                <form method="GET" action="{{ route('surat.index') }}"
                    class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                    <div class="flex flex-col sm:flex-row gap-4 flex-1">
                        <!-- Search -->
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" name="search" placeholder="Search templates..."
                                value="{{ request('search') }}"
                                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 w-full sm:w-64">
                        </div>

                        <!-- Filter kategori -->
                        <select name="kategori"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">All Categories</option>
                            <option value="akademik" {{ request('kategori') == 'akademik' ? 'selected' : '' }}>Akademik
                            </option>
                            <option value="administrasi" {{ request('kategori') == 'administrasi' ? 'selected' : '' }}>
                                Administrasi</option>
                            <option value="rekomendasi" {{ request('kategori') == 'rekomendasi' ? 'selected' : '' }}>
                                Rekomendasi</option>
                        </select>

                        <!-- Filter status -->
                        <select name="status"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived
                            </option>
                        </select>

                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Filter
                        </button>
                    </div>
                </form>
            </div>


            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
                    <p class="font-semibold mb-2">⚠️ Ada kesalahan input:</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <!-- Templates Table -->
            <div class="bg-white rounded-xl card-shadow overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 bg-red-50">
                    <h3 class="text-lg font-semibold text-red-900">Template Surat</h3>
                    <p class="text-sm text-red-700 mt-1">Manage and organize your department's letter templates</p>
                </div>

                <!-- Desktop Table -->
                <div class="desktop-table overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Surat</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Terakhir diubah</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total Penggunaan</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($templates as $template)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                                <svg class="w-5 h-5 text-blue-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $template->nama_surat }}</div>
                                                <div class="text-sm text-gray-500">
                                                    {{ Str::limit(strip_tags($template->konten), 40) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ ucfirst($template->kategori) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $template->updated_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 rounded-full text-xs font-medium
                    {{ $template->status === 'active' ? 'status-active' : ($template->status === 'draft' ? 'status-draft' : 'status-archived') }}">
                                            {{ ucfirst($template->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $template->letter_requests_count }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button onclick="editTemplate({{ $template }})"
                                            class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">
                                            Edit
                                        </button>

                                        <button onclick="duplicateTemplate('{{ $template->id }}')"
                                            class="text-purple-600 hover:text-purple-900 bg-purple-50 hover:bg-purple-100 px-3 py-1 rounded-lg transition-colors">Duplicate</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        Belum ada template surat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Cards -->
                <div class="mobile-cards p-4 space-y-4">
                    @forelse($templates as $template)
                        <div class="bg-gray-50 rounded-lg p-4 card-hover transition-all duration-200">
                            <div class="flex items-start justify-between mb-3">
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
                                        <div class="text-sm font-medium text-gray-900">{{ $template->nama_surat }}
                                        </div>
                                        <div class="text-xs text-gray-500">{{ ucfirst($template->kategori) }}</div>
                                    </div>
                                </div>
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-medium
                    {{ $template->status === 'active' ? 'status-active' : ($template->status === 'draft' ? 'status-draft' : 'status-archived') }}">
                                    {{ ucfirst($template->status) }}
                                </span>
                            </div>
                            <div class="space-y-2 text-sm mb-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Kategori:</span>
                                    <span class="text-gray-900 font-medium">{{ ucfirst($template->kategori) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Terakhir Diubah:</span>
                                    <span class="text-gray-900">{{ $template->updated_at->format('M d, Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Penggunaan:</span>
                                    <span class="text-gray-900">{{ $template->letter_requests_count }} times</span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button onclick="editTemplate({{ $template }})"
                                    class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">
                                    Edit
                                </button>

                                <button onclick="duplicateTemplate('{{ $template->id }}')"
                                    class="flex-1 text-purple-600 hover:text-purple-900 bg-purple-50 hover:bg-purple-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Duplicate</button>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Belum ada template surat.</p>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="px-4 sm:px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Showing
                            <span class="font-medium">{{ $templates->firstItem() }}</span>
                            to
                            <span class="font-medium">{{ $templates->lastItem() }}</span>
                            of
                            <span class="font-medium">{{ $templates->total() }}</span>
                            results
                        </div>
                        <div>
                            {{ $templates->appends(request()->query())->links('pagination::tailwind') }}

                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>




    <div id="template-modal"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50 px-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] flex flex-col overflow-hidden">

            <!-- Modal Header - Fixed at top -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200 flex-shrink-0">
                <h2 id="modal-title" class="text-xl font-semibold text-gray-900">Buat Template Surat Baru</h2>
                <button onclick="closeTemplateModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Form with flex layout -->
            <form method="POST" action="{{ route('letter-templates.store') }}"
                onsubmit="document.querySelector('#isi_konten').value = quill.root.innerHTML;"
                class="flex-1 flex flex-col overflow-hidden">
                @csrf
                <!-- Scrollable Content Area -->
                <div class="flex-1 overflow-y-auto p-6 space-y-6">

                    <!-- Template Name -->
                    <div>
                        <label for="template-name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Surat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="template-name" name="template_name" required
                            placeholder="Enter template name..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500">
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="template-category" class="block text-sm font-medium text-gray-700 mb-2">
                            Ketegori <span class="text-red-500">*</span>
                        </label>
                        <select id="template-category" name="template_category" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="akademik">Akademik</option>
                            <option value="administrasi">Administrasi</option>
                            <option value="rekomendasi">Rekomendasi</option>
                        </select>
                    </div>

                    <!-- Header Content -->

                    <div>
                        <label for="kode_seri" class="block text-md font-bold text-gray-700">
                            Nomor Surat
                        </label>
                        <label for="kode_seri" class="block text-sm font-medium text-gray-700 mb-2">
                            Kode Seri (Contoh: B) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="kode_seri" name="kode_seri" required
                            placeholder="Masukkan kode seri..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500">
                    </div>

                    <div>
                        <label for="kode_unit" class="block text-sm font-medium text-gray-700 mb-2">
                            Kode Unit (Contoh: UN47.B5.5) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="kode_unit" name="kode_unit" required
                            placeholder="Masukkan kode unit..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500">
                    </div>

                    <div>
                        <label for="kode_arsip" class="block text-sm font-medium text-gray-700 mb-2">
                            Kode Arsip (Contoh: PK.01.06) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="kode_arsip" name="kode_arsip" required
                            placeholder="Masukkan kode arsip..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500">
                    </div>

                    <!-- Header Content -->
                    <div>
                        <label for="tujuan_nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Tujuan Nama (Contoh: Koordinator Fakultas Teknik) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="tujuan_nama" name="tujuan_nama" required
                            placeholder="Masukkan nama tujuan..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500">
                    </div>

                    <div>
                        <label for=tujuan_tempat" class="block text-sm font-medium text-gray-700 mb-2">
                            Tujuan Tempat (Contoh: Gorontalo) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="tujuan_tempat" name="tujuan_tempat" required
                            placeholder="Masukkan tempat tujuan..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500">
                    </div>

                    <!-- Body Content -->
                    <div>
                        <label for="isi_konten" class="block text-sm font-medium text-gray-700 mb-2">
                            Isi Konten <span class="text-red-500">*</span>
                        </label>

                        {{-- <textarea id="isi_konten" name="isi_konten"></textarea> --}}
                        <div id="editor">

                         
                        </div>
                        <textarea id="isi_konten" name="konten" hidden></textarea>

                        @verbatim
                            <div
                                class="mt-2 text-xs text-gray-600 bg-gray-50 border border-gray-200 rounded-lg p-3 leading-relaxed">
                                <p class="font-medium mb-1">📌 Gunakan placeholder berikut untuk konten dinamis:</p>
                                <ul class="list-disc list-inside space-y-1">
                                    <li><code class="bg-gray-100 px-1 py-0.5 rounded">{{ $nama_mhs }}</code> → Nama
                                        Mahasiswa</li>
                                    <li><code class="bg-gray-100 px-1 py-0.5 rounded">{{ $nim }}</code> → NIM
                                        Mahasiswa</li>
                                    <li><code class="bg-gray-100 px-1 py-0.5 rounded">{{ $nama_dsn }}</code> → Nama
                                        Dosen
                                    </li>
                                    <li><code class="bg-gray-100 px-1 py-0.5 rounded">{{ $nip }}</code> → NIP
                                        Dosen
                                    </li>

                                    <li><code class="bg-gray-100 px-1 py-0.5 rounded">{{ $jabatan }}</code> → Jabatan
                                    </li>
                                    <li><code class="bg-gray-100 px-1 py-0.5 rounded">{{ $array_mhs }}</code> → Banyak
                                        Mahasiswa</li>
                                </ul>
                            </div>
                        @endverbatim
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Penerusan Surat
                        </label>
                        <div class="flex flex-col gap-2 text-sm text-gray-700">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="requires_kaprodi" value="1"
                                    class="h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                <span class="ml-2">Kirim ke Ketua Program Studi</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="requires_ketua_jurusan" value="1"
                                    class="h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                <span class="ml-2">Kirim ke Ketua Jurusan</span>
                            </label>
                        </div>
                    </div>

                    <!-- Template Status -->
                    <div>
                        <label for="template-status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="template-status" name="status" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900">
                            <option value="draft">Draft</option>
                            <option value="active">Active</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>
                </div>

                <!-- Action Buttons - Fixed at bottom, inside form -->
                <div class="flex flex-col sm:flex-row gap-3 p-6 border-t border-gray-200 flex-shrink-0 bg-white">
                    <button type="button" onclick="closeTemplateModal()"
                        class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-200">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-200">
                        <span id="submit-text">Buat Template</span>
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


    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script>
        const quill = new Quill('#editor', {
            theme: 'snow'
        });

        document.querySelector('form').onsubmit = function() {
            document.querySelector('#isi_konten').value = quill.root.innerHTML;
        };
    </script>

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
        function openTemplateModal(template = null) {
            const modal = document.getElementById('template-modal');
            const modalTitle = document.getElementById('modal-title');
            const submitText = document.getElementById('submit-text');
            const form = document.querySelector('#template-modal form');

            if (template) {
                // mode edit
                modalTitle.textContent = `Edit Template: ${template.nama_surat}`;
                submitText.textContent = 'Update Template';

                // isi form sesuai data template
                document.getElementById('template-name').value = template.nama_surat;
                document.getElementById('template-category').value = template.kategori;
                document.getElementById('kode_seri').value = template.kode_seri;
                document.getElementById('kode_unit').value = template.kode_unit;
                document.getElementById('kode_arsip').value = template.kode_arsip;
                document.getElementById('tujuan_nama').value = template.tujuan_nama;
                document.getElementById('tujuan_tempat').value = template.tujuan_lokasi;
                document.getElementById('isi_konten').value = template.konten;
                document.getElementById('template-status').value = (template.status ?? '').toLowerCase();

                document.querySelector('[name="requires_kaprodi"]').checked = template.requires_kaprodi == 1;
                document.querySelector('[name="requires_ketua_jurusan"]').checked = template.requires_ketua_jurusan == 1;


                quill.root.innerHTML = template.konten ?? '';

                // ubah form action ke route update
                form.action = `/letter-templates/${template.id}`;
                form.insertAdjacentHTML("beforeend", `<input type="hidden" name="_method" value="PUT">`);
            } else {
                // mode create
                modalTitle.textContent = 'Buat Template Surat Baru';
                submitText.textContent = 'Create Template';
                form.action = `{{ route('letter-templates.store') }}`;
                form.reset();
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
        function editTemplate(template) {
            openTemplateModal(template);
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
