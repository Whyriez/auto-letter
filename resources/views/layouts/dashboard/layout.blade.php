<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoLetter - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/tributejs@5.1.3/dist/tribute.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tributejs@5.1.3/dist/tribute.min.css">
    <style>
        .ql-editor {
            min-height: 200px;
        }

        #suggestions-container {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #e2e8f0;
        }

        #suggestions-container div:hover {
            background-color: #f1f5f9;
        }
    </style>
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

        .status-inactive {
            @apply bg-red-100 text-red-800;
        }

        .status-pending {
            @apply bg-yellow-100 text-yellow-800;
        }

        .status-suspended {
            @apply bg-gray-100 text-gray-800;
        }

        .role-super-admin {
            @apply bg-purple-100 text-purple-800;
        }

        .role-department-admin {
            @apply bg-blue-100 text-blue-800;
        }

        .role-staff {
            @apply bg-green-100 text-green-800;
        }

        .role-student {
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
                display: block;
            }

            .mobile-cards {
                display: none;
            }
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

        .active {
            color: #e53e3e !important;
            background-color: #fef2f2 !important;
        }

        .status-pending {
            @apply bg-yellow-100 text-yellow-800;
        }

        .status-approved {
            @apply bg-green-100 text-green-800;
        }

        .status-rejected {
            @apply bg-red-100 text-red-800;
        }

        .status-draft {
            @apply bg-gray-100 text-gray-800;
        }
    </style>
</head>

<body class="bg-gray-50">

    @if (session('notification'))
        @php
            $notification = session('notification');
            $message = $notification['message'];
            $color = $notification['type'] === 'success' ? 'green' : 'red';
        @endphp
    @elseif ($errors->any())
        @php
            $message = $errors->first();
            $color = 'red';
        @endphp
    @endif

    @if (isset($message) && isset($color))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showSuccessMessage("{{ $message }}", "{{ $color }}");
            });
        </script>
    @endif
    <!-- Mobile Menu Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

    <!-- Sidebar -->
    @include('partials.dashboard.sidebar')

    <!-- Main Content -->
    @yield('content')

    {{-- confirm logout modal --}}
    <x-admin.super.confirm-logout-modal />

    <script src="{{ asset('js/Super Admin/formValidateUser.js') }}"></script>
    <script src="{{ asset('js/Super Admin/handlerUserSubmit.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

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




        // Versi baru yang lebih baik dari showSuccessMessage
        function showSuccessMessage(message, color = 'green') {
            const config = {
                green: {
                    bgColor: 'bg-green-500',
                    icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>` // Centang
                },
                red: {
                    bgColor: 'bg-red-500',
                    icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>` // Tanda seru
                },
                blue: {
                    bgColor: 'bg-blue-500',
                    icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>` // Info
                }
            };

            const notificationConfig = config[color] || config.green;

            const notification = document.createElement('div');
            notification.className =
                `fixed top-4 right-4 ${notificationConfig.bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;

            notification.innerHTML = `
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${notificationConfig.icon}
            </svg>
            ${message}
        </div>
    `;

            // ... sisa fungsi setTimeout Anda tetap sama ...
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

    @stack('scriptsSurat')
    @stack('scriptsMahasiswa')
</body>

</html>
