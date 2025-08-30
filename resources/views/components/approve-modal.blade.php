<div id="confirm-approve-modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 px-4"
    role="dialog" aria-modal="true" aria-labelledby="confirm-approve-title">

    <div class="absolute inset-0" data-approve-overlay></div>

    <div class="relative bg-white rounded-2xl shadow-2xl max-w-sm w-full p-6" data-approve-panel>
        <div class="text-center">
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    aria-hidden="true">
                    <path d="M5 13l4 4L19 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>

            <h3 id="confirm-approve-title" class="text-lg font-semibold text-gray-900 mb-2">
                Konfirmasi Persetujuan
            </h3>
            <p class="text-gray-600 text-sm mb-5">
                Setujui permintaan surat ini?
            </p>

            <!-- NOTE: route menggunakan GET seperti anchor sebelumnya -->
            <form action="" method="GET" id="approve-form">
                <div class="flex gap-2">
                    <button type="button" data-approve-cancel
                        class="w-full bg-white hover:bg-gray-100 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors border border-gray-300">
                        Batal
                    </button>
                    <button type="submit" data-approve-submit
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 hidden animate-spin" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" aria-hidden="true" data-approve-spinner>
                            <circle cx="12" cy="12" r="9" stroke-width="2" class="opacity-25"></circle>
                            <path d="M21 12a9 9 0 00-9-9" stroke-width="2" class="opacity-75"></path>
                        </svg>
                        <span>Setujui</span>
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

    .approve-overlay-in {
        animation: overlay-in .18s ease-out forwards
    }

    .approve-overlay-out {
        animation: overlay-out .14s ease-in forwards
    }

    .approve-panel-in {
        animation: panel-in .22s cubic-bezier(.22, .61, .36, 1) forwards
    }

    .approve-panel-out {
        animation: panel-out .16s ease-in forwards
    }
</style>

<script>
    // Buka modal dan set form action dari tombol
    function openApproveModal(url) {
        const modal = document.getElementById('confirm-approve-modal');
        const overlay = modal.querySelector('[data-approve-overlay]');
        const panel = modal.querySelector('[data-approve-panel]');
        const submit = modal.querySelector('[data-approve-submit]');
        const spin = modal.querySelector('[data-approve-spinner]');
        const form = document.getElementById('approve-form');

        form.action = url || '';

        // reset state
        submit.disabled = false;
        spin.classList.add('hidden');
        submit.querySelector('span').textContent = 'Setujui';

        // tampil + animasi
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        overlay.classList.remove('approve-overlay-out');
        panel.classList.remove('approve-panel-out');
        void overlay.offsetWidth;
        overlay.classList.add('approve-overlay-in');
        panel.classList.add('approve-panel-in');
    }

    function closeApproveModal() {
        const modal = document.getElementById('confirm-approve-modal');
        const overlay = modal.querySelector('[data-approve-overlay]');
        const panel = modal.querySelector('[data-approve-panel]');

        overlay.classList.remove('approve-overlay-in');
        panel.classList.remove('approve-panel-in');
        overlay.classList.add('approve-overlay-out');
        panel.classList.add('approve-panel-out');

        const end = () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            panel.removeEventListener('animationend', end);
        };
        panel.addEventListener('animationend', end, {
            once: true
        });
    }

    // Bind tombol Setujui (delegation)
    document.addEventListener('click', (e) => {
        const btn = e.target.closest('.approve-open-btn');
        if (!btn) return;
        e.preventDefault();
        openApproveModal(btn.dataset.approveUrl);
    });

    // Tutup via overlay/kancel/ESC
    document.getElementById('confirm-approve-modal').addEventListener('click', (e) => {
        const panel = e.currentTarget.querySelector('[data-approve-panel]');
        if (!panel.contains(e.target)) closeApproveModal();
    });
    document.querySelector('#confirm-approve-modal [data-approve-cancel]')?.addEventListener('click',
    closeApproveModal);
    document.addEventListener('keydown', (e) => {
        const modal = document.getElementById('confirm-approve-modal');
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeApproveModal();
    });

    // Spinner saat submit
    document.getElementById('approve-form').addEventListener('submit', function() {
        const modal = document.getElementById('confirm-approve-modal');
        const submit = modal.querySelector('[data-approve-submit]');
        const spin = modal.querySelector('[data-approve-spinner]');
        submit.disabled = true;
        spin.classList.remove('hidden');
        submit.querySelector('span').textContent = 'Memproses...';
    });
</script>
