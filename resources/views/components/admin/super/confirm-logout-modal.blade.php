
<div id="confirm-logout-modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 px-4"
    role="dialog" aria-modal="true" aria-labelledby="confirm-logout-title">

    <div class="absolute inset-0" data-logout-overlay></div>

    <div class="relative bg-white rounded-2xl shadow-2xl max-w-sm w-full p-6" data-logout-panel>
        <div class="text-center">
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </div>

            <h3 id="confirm-logout-title" class="text-lg font-semibold text-gray-900 mb-2">Konfirmasi Keluar</h3>
            <p class="text-gray-600 text-sm mb-5">Apakah Anda yakin ingin keluar?</p>

            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                @csrf
                <div class="flex gap-2">
                    <button type="button" data-logout-cancel
                        class="w-full bg-white hover:bg-gray-100 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors border border-gray-300">
                        Batal
                    </button>
                    <button type="submit" data-logout-submit
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 hidden animate-spin" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" aria-hidden="true">
                            <circle cx="12" cy="12" r="9" stroke-width="2" class="opacity-25"></circle>
                            <path d="M21 12a9 9 0 00-9-9" stroke-width="2" class="opacity-75"></path>
                        </svg>
                        <span>Logout</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    @keyframes overlay-in {
        from {
            opacity: 0
        }

        to {
            opacity: 1
        }
    }

    @keyframes overlay-out {
        from {
            opacity: 1
        }

        to {
            opacity: 0
        }
    }

    @keyframes panel-in {
        from {
            opacity: 0;
            transform: translateY(8px) scale(.98)
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1)
        }
    }

    @keyframes panel-out {
        from {
            opacity: 1;
            transform: translateY(0) scale(1)
        }

        to {
            opacity: 0;
            transform: translateY(8px) scale(.98)
        }
    }

    .logout-overlay-in {
        animation: overlay-in .18s ease-out forwards;
    }

    .logout-overlay-out {
        animation: overlay-out .14s ease-in forwards;
    }

    .logout-panel-in {
        animation: panel-in .22s cubic-bezier(.22, .61, .36, 1) forwards;
    }

    .logout-panel-out {
        animation: panel-out .16s ease-in forwards;
    }
</style>

<script>
    function openLogoutModal() {
        const modal = document.getElementById('confirm-logout-modal');
        const overlay = modal.querySelector('[data-logout-overlay]');
        const panel = modal.querySelector('[data-logout-panel]');
        const cancel = modal.querySelector('[data-logout-cancel]');
        const submit = modal.querySelector('[data-logout-submit]');
        const spin = submit.querySelector('svg');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        submit.disabled = false;
        spin.classList.add('hidden');
        submit.querySelector('span').textContent = 'Logout';

        overlay.classList.remove('logout-overlay-out');
        panel.classList.remove('logout-panel-out');
        void overlay.offsetWidth; // reflow
        overlay.classList.add('logout-overlay-in');
        panel.classList.add('logout-panel-in');

        setTimeout(() => cancel?.focus(), 10);
    }

    function closeLogoutModal() {
        const modal = document.getElementById('confirm-logout-modal');
        const overlay = modal.querySelector('[data-logout-overlay]');
        const panel = modal.querySelector('[data-logout-panel]');

        overlay.classList.remove('logout-overlay-in');
        panel.classList.remove('logout-panel-in');
        overlay.classList.add('logout-overlay-out');
        panel.classList.add('logout-panel-out');

        const end = () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            panel.removeEventListener('animationend', end);
        };
        panel.addEventListener('animationend', end, {
            once: true
        });
    }

    document.getElementById('confirm-logout-modal')
        .addEventListener('click', (e) => {
            const panel = e.currentTarget.querySelector('[data-logout-panel]');
            if (!panel.contains(e.target)) closeLogoutModal();
        });

    document.querySelector('#confirm-logout-modal [data-logout-cancel]')
        .addEventListener('click', closeLogoutModal);

    document.addEventListener('keydown', (e) => {
        const modal = document.getElementById('confirm-logout-modal');
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeLogoutModal();
    });

    document.getElementById('logout-form').addEventListener('submit', function() {
        const submit = this.querySelector('[data-logout-submit]');
        const spin = submit.querySelector('svg');
        submit.disabled = true;
        spin.classList.remove('hidden');
        submit.querySelector('span').textContent = 'Keluar...';
    });
</script>
