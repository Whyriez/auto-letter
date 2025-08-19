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

        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }

        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .card-hover:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
                0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }

        .logo-text {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Status Badges */
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

        /* Roles */
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

        /* Responsive table/cards */
        .desktop-table {
            width: 100%;
            overflow-x: auto;
        }

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

        /* Custom dropdown */
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

        /* === TOAST MINIMAL (tanpa border kiri/kanan/atas/bawah) === */
        #toast-container {
            position: fixed;
            bottom: 1rem;
            /* sudut kanan atas */
            right: 1rem;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            /* stacking vertikal */
            gap: .5rem;
            /* jarak antar toast */
            pointer-events: none;
            /* tidak menghalangi klik */
        }

        .toast {
            pointer-events: auto;
            /* biar hover bisa pause auto-hide */
            background: #fff;
            /* putih bersih */
            border: none;
            /* TIDAK ADA BORDER SAMA SEKALI */
            border-radius: 0.75rem;
            /* rounded-xl */
            padding: .75rem 1rem;
            width: min(92vw, 360px);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1),
                0 4px 6px -4px rgb(0 0 0 / 0.1);
            opacity: 0;
            transform: translateY(10px);
            animation: toast-in 160ms ease-out forwards;
        }

        /* kelas tipe dibiarkan untuk semantik, tapi tanpa dekorasi border */
        .toast--success {}

        .toast--error {}

        .toast__row {
            display: flex;
            gap: .5rem;
            align-items: flex-start;
        }

        .toast__icon {
            flex: 0 0 auto;
            margin-top: 2px;
            /* sejajarkan optik */
        }

        .toast__text {
            color: #111827;
            /* gray-900 */
            font-size: .875rem;
            /* text-sm */
            line-height: 1.25rem;
            /* leading-5 */
        }

        @keyframes toast-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes toast-out {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(10px);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .toast {
                animation-duration: 1ms;
            }
        }
    </style>
</head>

<body class="bg-gray-50">

    {{-- Toaster auto-show if ada session --}}
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

 
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

    <script>
        // Mobile menu
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
        menuButton?.addEventListener('click', openSidebar);
        closeSidebar?.addEventListener('click', closeSidebarFunc);
        mobileOverlay?.addEventListener('click', closeSidebarFunc);

        function showSuccessMessage(message, color = 'green', opts = {}) {
            const type = color === 'red' ? 'error' : 'success';
            showToast(message, {
                type,
                ...opts
            });
        }

        // Versi minimalis: tanpa tombol, auto-hide, stacking rapi
        function showToast(message, {
            type = 'success',
            duration = 5000
        } = {}) {
            // Buat container jika belum ada
            let container = document.getElementById('toast-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'toast-container';
                document.body.appendChild(container);
            }

            // Ikon minimal (stroke currentColor)
            const icon =
                type === 'error' ?
                `
        <!-- X-circle -->
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9l-6 6m0-6l6 6"/>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/>
        </svg>` :
                `
        <!-- Check-circle -->
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/>
        </svg>`;

            const iconColor = type === 'error' ? '#dc2626' : '#16a34a';

            // Elemen toast
            const toast = document.createElement('div');
            toast.className = `toast ${type === 'error' ? 'toast--error' : 'toast--success'}`;
            toast.setAttribute('role', 'status');
            toast.setAttribute('aria-live', 'polite');
            toast.innerHTML = `
      <div class="toast__row">
        <div class="toast__icon" style="color:${iconColor}">${icon}</div>
        <div class="toast__text">${message}</div>
      </div>
    `;

            // Tambah ke container (stacking otomatis via flex column + gap)
            container.appendChild(toast);

            // Auto-hide
            const remove = () => {
                toast.style.animation = 'toast-out 140ms ease-in forwards';
                toast.addEventListener('animationend', () => toast.remove(), {
                    once: true
                });
            };

            // Timer auto hide; pause jika user hover (opsional, tetap minimal)
            let remaining = duration;
            let start = Date.now();
            let timer = setTimeout(remove, remaining);

            toast.addEventListener('mouseenter', () => {
                clearTimeout(timer);
                remaining -= (Date.now() - start);
            });
            toast.addEventListener('mouseleave', () => {
                start = Date.now();
                timer = setTimeout(remove, Math.max(140, remaining));
            });
        }

        // Close sidebar auto when resize
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
