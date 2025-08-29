<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AutoLetter - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .login-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .form-shadow {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, .1), 0 10px 10px -5px rgba(0, 0, 0, .04);
        }

        .input-focus:focus {
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, .1);
        }

        .logo-text {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Toast (tetap) */
        #toast-container {
            position: fixed;
            right: 1rem;
            bottom: 1rem;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: .5rem;
            pointer-events: none;
        }

        .toast {
            pointer-events: auto;
            background: #fff;
            border: none;
            border-radius: .75rem;
            padding: .75rem 1rem;
            width: min(92vw, 360px);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            opacity: 0;
            transform: translateY(10px);
            animation: toast-in 160ms ease-out forwards;
        }

        .toast__row {
            display: flex;
            gap: .5rem;
            align-items: flex-start;
        }

        .toast__icon {
            flex: 0 0 auto;
            margin-top: 2px;
        }

        .toast__text {
            color: #111827;
            font-size: .875rem;
            line-height: 1.25rem;
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

<body>
    <div class="login-container flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-md">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-red-600 rounded-xl mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold logo-text mb-2">AutoLetter</h1>
                <p class="text-gray-600 text-sm">University Web Platform</p>
            </div>

            <!-- Card -->
            <div class="bg-white rounded-2xl form-shadow p-8">
                <div class="mb-6 text-center">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-2">Selamat Datang kembali</h2>
                    <p class="text-gray-600 text-sm">Silakan masuk ke akun Anda</p>
                </div>

                <!-- Form -->
                <form id="login-form" class="space-y-6" action="{{ route('login.process') }}" method="POST">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus transition-all duration-200 text-gray-900 placeholder-gray-500"
                            placeholder="Masukkan alamat email Anda" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus transition-all duration-200 text-gray-900 placeholder-gray-500 pr-12"
                                placeholder="Masukkan kata sandi Anda" />
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 transition-colors"
                                aria-label="Tampilkan/sembunyikan password">
                                <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center mb-4">
                        <input type="checkbox" id="remember" name="remember" class="mr-2 leading-tight" />
                        <label for="remember" class="text-sm text-gray-600">Remember Me</label>
                    </div>

                    <!-- Submit: sudah diberi spinner & text wrapper -->
                    <button id="login-submit" type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-red-200 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 hidden animate-spin" data-submit-spinner viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" aria-hidden="true">
                            <circle cx="12" cy="12" r="9" stroke-width="2" class="opacity-25"></circle>
                            <path d="M21 12a9 9 0 00-9-9" stroke-width="2" class="opacity-75"></path>
                        </svg>
                        <span data-submit-text>Login</span>
                    </button>
                </form>
            </div>

            <div class="text-center mt-8">
                <p class="text-xs text-gray-500">© 2024 AutoLetter. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17.94 17.94A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 012.122-3.362M6.343 6.343A9.97 9.97 0 0112 5c4.478 0 8.268 2.943 9.543 7a9.97 9.97 0 01-1.357 2.572M15 12a3 3 0 11-6 0 3 3 0 016 0zM3 3l18 18"></path>
        `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        `;
            }
        }

        // Toast minimal
        function showToast(message, {
            type = 'success',
            duration = 3200
        } = {}) {
            let container = document.getElementById('toast-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'toast-container';
                document.body.appendChild(container);
            }
            const icon = type === 'error' ?
                `<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9l-6 6m0-6l6 6"/>
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                   d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/>
           </svg>` :
                `<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                   d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/>
           </svg>`;
            const iconColor = type === 'error' ? '#dc2626' : '#16a34a';

            const toast = document.createElement('div');
            toast.className = 'toast';
            toast.innerHTML = `
        <div class="toast__row">
          <div class="toast__icon" style="color:${iconColor}">${icon}</div>
          <div class="toast__text">${message}</div>
        </div>
      `;
            container.appendChild(toast);

            const remove = () => {
                toast.style.animation = 'toast-out 140ms ease-in forwards';
                toast.addEventListener('animationend', () => toast.remove(), {
                    once: true
                });
            };

            let remaining = duration;
            let start = Date.now();
            let timer = setTimeout(remove, remaining);

            toast.addEventListener('mouseenter', () => {
                clearTimeout(timer);
                remaining -= Date.now() - start;
            });
            toast.addEventListener('mouseleave', () => {
                start = Date.now();
                timer = setTimeout(remove, Math.max(140, remaining));
            });
        }

        // Efek loading saat submit
        document.addEventListener('DOMContentLoaded', () => {
            // Notifikasi (opsional)
            @if (session('notification'))
                const notif = @json(session('notification'));
                showToast(notif.message, {
                    type: notif.type
                });
            @endif

            const form = document.getElementById('login-form');
            const btn = document.getElementById('login-submit');
            const spin = btn.querySelector('[data-submit-spinner]');
            const text = btn.querySelector('[data-submit-text]');

            form.addEventListener('submit', () => {
                // disable semua field agar tidak bisa diubah saat proses
                form.querySelectorAll('input, button, select, textarea').forEach(el => {
                    if (el !== btn) el.setAttribute('readonly', 'readonly');
                });

                // tombol jadi loading
                btn.disabled = true;
                btn.setAttribute('aria-busy', 'true');
                spin.classList.remove('hidden');
                text.textContent = 'Memproses...';
            });
        });
    </script>
</body>

</html>
