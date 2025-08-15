<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoLetter - Super Admin User Management</title>
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
        .status-active { @apply bg-green-100 text-green-800; }
        .status-inactive { @apply bg-red-100 text-red-800; }
        .status-pending { @apply bg-yellow-100 text-yellow-800; }
        .status-suspended { @apply bg-gray-100 text-gray-800; }
        
        .role-super-admin { @apply bg-purple-100 text-purple-800; }
        .role-department-admin { @apply bg-blue-100 text-blue-800; }
        .role-staff { @apply bg-green-100 text-green-800; }
        .role-student { @apply bg-gray-100 text-gray-800; }
        
        /* Mobile card styles */
        @media (max-width: 768px) {
            .desktop-table { display: none; }
            .mobile-cards { display: block; }
        }
        
        @media (min-width: 769px) {
            .desktop-table { display: table; }
            .mobile-cards { display: none; }
        }

        /* Custom dropdown styles */
        .role-dropdown {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
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
            <a href="#" onclick="showDemo()" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                </svg>
                Dashboard
            </a>
            <a href="#" class="flex items-center px-3 py-2 text-red-600 bg-red-50 rounded-lg mb-1 font-medium">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
                User Management
            </a>
            <a href="#" onclick="showDemo()" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Department Management
            </a>
            <a href="#" onclick="showDemo()" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                System Templates
            </a>
            <a href="#" onclick="showDemo()" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Analytics & Reports
            </a>
            <a href="#" onclick="showDemo()" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                System Settings
            </a>
        </nav>

        <div class="absolute bottom-0 w-full p-4 border-t border-gray-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                    <span class="text-red-600 font-semibold text-sm">SA</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">Super Admin</p>
                    <p class="text-xs text-gray-500">System Administrator</p>
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
                    <h1 class="text-xl font-semibold text-gray-900">User Management</h1>
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
                <h2 class="text-2xl font-bold text-gray-900 mb-2">System User Management</h2>
                <p class="text-gray-600">Manage all system users, roles, and permissions across the platform.</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-xl p-6 card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">1,247</p>
                            <p class="text-sm text-gray-600">Total Users</p>
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
                            <p class="text-2xl font-bold text-gray-900">1,189</p>
                            <p class="text-sm text-gray-600">Active Users</p>
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
                            <p class="text-2xl font-bold text-gray-900">23</p>
                            <p class="text-sm text-gray-600">Pending Approval</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 card-shadow">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">35</p>
                            <p class="text-sm text-gray-600">Suspended</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add New User Button -->
            <div class="mb-8">
                <button onclick="openUserModal()" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-red-200 card-shadow">
                    <div class="flex items-center justify-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New User
                    </div>
                </button>
            </div>

            <!-- Filters and Search -->
            <div class="bg-white rounded-xl p-4 sm:p-6 card-shadow mb-6">
                <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                    <div class="flex flex-col sm:flex-row gap-4 flex-1">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" placeholder="Search users..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 w-full sm:w-64">
                        </div>
                        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">All Roles</option>
                            <option value="super-admin">Super Admin</option>
                            <option value="department-admin">Department Admin</option>
                            <option value="staff">Staff</option>
                            <option value="student">Student</option>
                        </select>
                        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="pending">Pending</option>
                            <option value="suspended">Suspended</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="showDemo()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors">
                            Export Users
                        </button>
                        <button onclick="showDemo()" class="bg-red-100 hover:bg-red-200 text-red-700 px-4 py-2 rounded-lg font-medium transition-colors">
                            Bulk Actions
                        </button>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="bg-white rounded-xl card-shadow overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 bg-red-50">
                    <h3 class="text-lg font-semibold text-red-900">System Users</h3>
                    <p class="text-sm text-red-700 mt-1">Manage user accounts, roles, and permissions</p>
                </div>

                <!-- Desktop Table -->
                <div class="desktop-table overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input type="checkbox" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Login</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-purple-600 font-semibold text-sm">JD</span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">John Doe</div>
                                            <div class="text-sm text-gray-500">@johndoe</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">john.doe@university.edu</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <select onchange="handleRoleChange(this, 'john.doe@university.edu')" class="role-dropdown text-sm px-3 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white">
                                        <option value="super-admin">Super Admin</option>
                                        <option value="department-admin" selected>Department Admin</option>
                                        <option value="staff">Staff</option>
                                        <option value="student">Student</option>
                                    </select>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-active px-2 py-1 rounded-full text-xs font-medium">Active</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dec 20, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="editUser('John Doe', 'john.doe@university.edu', 'department-admin', 'active')" class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">Edit</button>
                                    <button onclick="suspendUser('John Doe')" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-lg transition-colors">Suspend</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-green-600 font-semibold text-sm">AS</span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Alice Smith</div>
                                            <div class="text-sm text-gray-500">@alicesmith</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">alice.smith@university.edu</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <select onchange="handleRoleChange(this, 'alice.smith@university.edu')" class="role-dropdown text-sm px-3 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white">
                                        <option value="super-admin">Super Admin</option>
                                        <option value="department-admin">Department Admin</option>
                                        <option value="staff" selected>Staff</option>
                                        <option value="student">Student</option>
                                    </select>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-active px-2 py-1 rounded-full text-xs font-medium">Active</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dec 19, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="editUser('Alice Smith', 'alice.smith@university.edu', 'staff', 'active')" class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">Edit</button>
                                    <button onclick="suspendUser('Alice Smith')" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-lg transition-colors">Suspend</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-blue-600 font-semibold text-sm">MB</span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Michael Brown</div>
                                            <div class="text-sm text-gray-500">@michaelbrown</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">michael.brown@student.edu</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <select onchange="handleRoleChange(this, 'michael.brown@student.edu')" class="role-dropdown text-sm px-3 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white">
                                        <option value="super-admin">Super Admin</option>
                                        <option value="department-admin">Department Admin</option>
                                        <option value="staff">Staff</option>
                                        <option value="student" selected>Student</option>
                                    </select>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-pending px-2 py-1 rounded-full text-xs font-medium">Pending</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Never</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="editUser('Michael Brown', 'michael.brown@student.edu', 'student', 'pending')" class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">Edit</button>
                                    <button onclick="approveUser('Michael Brown')" class="text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 px-3 py-1 rounded-lg transition-colors">Approve</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-yellow-600 font-semibold text-sm">EJ</span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Emily Johnson</div>
                                            <div class="text-sm text-gray-500">@emilyjohnson</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">emily.johnson@university.edu</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <select onchange="handleRoleChange(this, 'emily.johnson@university.edu')" class="role-dropdown text-sm px-3 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white">
                                        <option value="super-admin">Super Admin</option>
                                        <option value="department-admin" selected>Department Admin</option>
                                        <option value="staff">Staff</option>
                                        <option value="student">Student</option>
                                    </select>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-suspended px-2 py-1 rounded-full text-xs font-medium">Suspended</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dec 15, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="editUser('Emily Johnson', 'emily.johnson@university.edu', 'department-admin', 'suspended')" class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">Edit</button>
                                    <button onclick="reactivateUser('Emily Johnson')" class="text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 px-3 py-1 rounded-lg transition-colors">Reactivate</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-indigo-600 font-semibold text-sm">DW</span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">David Wilson</div>
                                            <div class="text-sm text-gray-500">@davidwilson</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">david.wilson@student.edu</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <select onchange="handleRoleChange(this, 'david.wilson@student.edu')" class="role-dropdown text-sm px-3 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white">
                                        <option value="super-admin">Super Admin</option>
                                        <option value="department-admin">Department Admin</option>
                                        <option value="staff">Staff</option>
                                        <option value="student" selected>Student</option>
                                    </select>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-active px-2 py-1 rounded-full text-xs font-medium">Active</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dec 18, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="editUser('David Wilson', 'david.wilson@student.edu', 'student', 'active')" class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg transition-colors">Edit</button>
                                    <button onclick="suspendUser('David Wilson')" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-lg transition-colors">Suspend</button>
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
                                <input type="checkbox" class="rounded border-gray-300 text-red-600 focus:ring-red-500 mr-3">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-purple-600 font-semibold text-sm">JD</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">John Doe</div>
                                    <div class="text-xs text-gray-500">@johndoe</div>
                                </div>
                            </div>
                            <span class="status-active px-2 py-1 rounded-full text-xs font-medium">Active</span>
                        </div>
                        <div class="space-y-2 text-sm mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Email:</span>
                                <span class="text-gray-900 font-medium">john.doe@university.edu</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Role:</span>
                                <select onchange="handleRoleChange(this, 'john.doe@university.edu')" class="role-dropdown text-xs px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500 bg-white">
                                    <option value="super-admin">Super Admin</option>
                                    <option value="department-admin" selected>Department Admin</option>
                                    <option value="staff">Staff</option>
                                    <option value="student">Student</option>
                                </select>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Last Login:</span>
                                <span class="text-gray-900">Dec 20, 2023</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="editUser('John Doe', 'john.doe@university.edu', 'department-admin', 'active')" class="flex-1 text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Edit</button>
                            <button onclick="suspendUser('John Doe')" class="flex-1 text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Suspend</button>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-gray-50 rounded-lg p-4 card-hover transition-all duration-200">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-red-600 focus:ring-red-500 mr-3">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-green-600 font-semibold text-sm">AS</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Alice Smith</div>
                                    <div class="text-xs text-gray-500">@alicesmith</div>
                                </div>
                            </div>
                            <span class="status-active px-2 py-1 rounded-full text-xs font-medium">Active</span>
                        </div>
                        <div class="space-y-2 text-sm mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Email:</span>
                                <span class="text-gray-900 font-medium">alice.smith@university.edu</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Role:</span>
                                <select onchange="handleRoleChange(this, 'alice.smith@university.edu')" class="role-dropdown text-xs px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500 bg-white">
                                    <option value="super-admin">Super Admin</option>
                                    <option value="department-admin">Department Admin</option>
                                    <option value="staff" selected>Staff</option>
                                    <option value="student">Student</option>
                                </select>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Last Login:</span>
                                <span class="text-gray-900">Dec 19, 2023</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="editUser('Alice Smith', 'alice.smith@university.edu', 'staff', 'active')" class="flex-1 text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Edit</button>
                            <button onclick="suspendUser('Alice Smith')" class="flex-1 text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Suspend</button>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-gray-50 rounded-lg p-4 card-hover transition-all duration-200">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-red-600 focus:ring-red-500 mr-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-blue-600 font-semibold text-sm">MB</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Michael Brown</div>
                                    <div class="text-xs text-gray-500">@michaelbrown</div>
                                </div>
                            </div>
                            <span class="status-pending px-2 py-1 rounded-full text-xs font-medium">Pending</span>
                        </div>
                        <div class="space-y-2 text-sm mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Email:</span>
                                <span class="text-gray-900 font-medium">michael.brown@student.edu</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Role:</span>
                                <select onchange="handleRoleChange(this, 'michael.brown@student.edu')" class="role-dropdown text-xs px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500 bg-white">
                                    <option value="super-admin">Super Admin</option>
                                    <option value="department-admin">Department Admin</option>
                                    <option value="staff">Staff</option>
                                    <option value="student" selected>Student</option>
                                </select>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Last Login:</span>
                                <span class="text-gray-900">Never</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="editUser('Michael Brown', 'michael.brown@student.edu', 'student', 'pending')" class="flex-1 text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Edit</button>
                            <button onclick="approveUser('Michael Brown')" class="flex-1 text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Approve</button>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="px-4 sm:px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">1,247</span> results
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

    <!-- User Edit Modal -->
    <div id="user-modal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50 px-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h2 id="user-modal-title" class="text-xl font-semibold text-gray-900">Edit User</h2>
                <button onclick="closeUserModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form class="p-6 space-y-6" onsubmit="handleUserSubmit(event)">
                <!-- Personal Information Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="user-first-name" class="block text-sm font-medium text-gray-700 mb-2">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="user-first-name" 
                                name="user-first-name" 
                                required
                                placeholder="Enter first name..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500"
                            >
                        </div>
                        <div>
                            <label for="user-last-name" class="block text-sm font-medium text-gray-700 mb-2">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="user-last-name" 
                                name="user-last-name" 
                                required
                                placeholder="Enter last name..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500"
                            >
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="user-username" class="block text-sm font-medium text-gray-700 mb-2">
                            Username <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="user-username" 
                            name="user-username" 
                            required
                            placeholder="Enter username..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500"
                        >
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h3>
                    <div>
                        <label for="user-email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="email" 
                            id="user-email" 
                            name="user-email" 
                            required
                            placeholder="Enter email address..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500"
                        >
                    </div>
                    <div class="mt-4">
                        <label for="user-phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number
                        </label>
                        <input 
                            type="tel" 
                            id="user-phone" 
                            name="user-phone" 
                            placeholder="Enter phone number..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500"
                        >
                    </div>
                </div>

                <!-- System Access Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">System Access</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="user-role" class="block text-sm font-medium text-gray-700 mb-2">
                                Role <span class="text-red-500">*</span>
                            </label>
                            <select id="user-role" name="user-role" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900">
                                <option value="">-- Select Role --</option>
                                <option value="super-admin">Super Admin</option>
                                <option value="department-admin">Department Admin</option>
                                <option value="staff">Staff</option>
                                <option value="student">Student</option>
                            </select>
                        </div>
                        <div>
                            <label for="user-status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select id="user-status" name="user-status" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="pending">Pending</option>
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="user-department" class="block text-sm font-medium text-gray-700 mb-2">
                            Department
                        </label>
                        <select id="user-department" name="user-department" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900">
                            <option value="">-- Select Department --</option>
                            <option value="computer-science">Computer Science</option>
                            <option value="engineering">Engineering</option>
                            <option value="business">Business Administration</option>
                            <option value="arts">Arts & Humanities</option>
                            <option value="sciences">Natural Sciences</option>
                        </select>
                    </div>
                </div>

                <!-- Security Section -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Security Settings</h3>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="force-password-reset" name="force-password-reset" class="rounded border-gray-300 text-red-600 focus:ring-red-500 mr-3">
                            <label for="force-password-reset" class="text-sm text-gray-700">Force password reset on next login</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="two-factor-auth" name="two-factor-auth" class="rounded border-gray-300 text-red-600 focus:ring-red-500 mr-3">
                            <label for="two-factor-auth" class="text-sm text-gray-700">Enable two-factor authentication</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="email-notifications" name="email-notifications" class="rounded border-gray-300 text-red-600 focus:ring-red-500 mr-3" checked>
                            <label for="email-notifications" class="text-sm text-gray-700">Send email notifications</label>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button 
                        type="button" 
                        onclick="closeUserModal()"
                        class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-200"
                    >
                        Cancel
                    </button>
                    <button 
                        type="submit"
                        class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-200"
                    >
                        <span id="user-submit-text">Save Changes</span>
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
                <p class="text-gray-600 text-sm mb-4">This is a demo interface. In a real application, this would connect to your user management system.</p>
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

        // User modal functionality
        function openUserModal(userName = null) {
            const modal = document.getElementById('user-modal');
            const modalTitle = document.getElementById('user-modal-title');
            const submitText = document.getElementById('user-submit-text');
            
            if (userName) {
                modalTitle.textContent = `Edit User: ${userName}`;
                submitText.textContent = 'Save Changes';
            } else {
                modalTitle.textContent = 'Add New User';
                submitText.textContent = 'Create User';
                // Reset form
                document.querySelector('#user-modal form').reset();
            }
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeUserModal() {
            document.getElementById('user-modal').classList.add('hidden');
            document.getElementById('user-modal').classList.remove('flex');
            // Reset form
            document.querySelector('#user-modal form').reset();
        }

        function handleUserSubmit(event) {
            event.preventDefault();
            const firstName = document.getElementById('user-first-name').value;
            const lastName = document.getElementById('user-last-name').value;
            const fullName = `${firstName} ${lastName}`;
            closeUserModal();
            showSuccessMessage(`User "${fullName}" has been saved successfully!`, 'green');
        }

        // Role change handler
        function handleRoleChange(selectElement, userEmail) {
            const newRole = selectElement.value;
            const roleText = selectElement.options[selectElement.selectedIndex].text;
            showSuccessMessage(`Role updated to "${roleText}" for ${userEmail}`, 'blue');
        }

        // Action functions
        function editUser(userName, email, role, status) {
            openUserModal(userName);
            // Pre-fill form with existing data
            const nameParts = userName.split(' ');
            document.getElementById('user-first-name').value = nameParts[0] || '';
            document.getElementById('user-last-name').value = nameParts.slice(1).join(' ') || '';
            document.getElementById('user-username').value = email.split('@')[0];
            document.getElementById('user-email').value = email;
            document.getElementById('user-role').value = role;
            document.getElementById('user-status').value = status;
        }

        function suspendUser(userName) {
            showSuccessMessage(`User "${userName}" has been suspended.`, 'red');
        }

        function approveUser(userName) {
            showSuccessMessage(`User "${userName}" has been approved and activated.`, 'green');
        }

        function reactivateUser(userName) {
            showSuccessMessage(`User "${userName}" has been reactivated.`, 'green');
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

        // Close modals when clicking outside
        document.getElementById('user-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeUserModal();
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
