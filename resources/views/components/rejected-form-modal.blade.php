<!-- Modal: Tolak Permintaan Surat -->
<div id="reject-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 px-4"
    role="dialog" aria-modal="true" aria-labelledby="reject-title" aria-describedby="reject-desc">

    <!-- Overlay (for animation) -->
    <div class="absolute inset-0" data-modal-overlay></div>

    <!-- Panel -->
    <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6" data-modal-panel>
        <div class="text-center">
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <!-- exclamation icon -->
                <svg class="w-6 h-6 text-red-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v4m0 4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                </svg>
            </div>

            <h3 id="reject-title" class="text-lg font-semibold text-gray-900">Tolak Permintaan Surat</h3>
            <p id="reject-desc" class="text-gray-600 text-sm mt-1">
                Mohon berikan alasan yang jelas mengapa permintaan surat ini ditolak.
            </p>
        </div>

        <form id="reject-form" method="POST" action="" class="mt-5">
            @csrf

            <label for="notes" class="sr-only">Alasan Penolakan</label>
            <textarea id="notes" name="notes" rows="4" required placeholder="Tulis alasan penolakan..."
                class="w-full px-3 py-2 text-gray-800 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"></textarea>

            <div class="mt-5 flex gap-2">
                <button type="button" data-cancel-btn
                    class="w-1/2 bg-white hover:bg-gray-100 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors border border-gray-300">
                    Batal
                </button>

                <button type="submit" data-reject-btn
                    class="w-1/2 bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 hidden animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        aria-hidden="true">
                        <circle cx="12" cy="12" r="9" stroke-width="2" class="opacity-25"></circle>
                        <path d="M21 12a9 9 0 00-9-9" stroke-width="2" class="opacity-75"></path>
                    </svg>
                    <span>Tolak Surat</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Animations -->
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

    .modal-overlay-in {
        animation: overlay-in .18s ease-out forwards;
    }

    .modal-overlay-out {
        animation: overlay-out .14s ease-in forwards;
    }

    .modal-panel-in {
        animation: panel-in .22s cubic-bezier(.22, .61, .36, 1) forwards;
    }

    .modal-panel-out {
        animation: panel-out .16s ease-in forwards;
    }
</style>

<script>
    // Buka modal + set action form (opsional prefill notes)
    function openRejectModal(actionUrl, currentNotes = '') {
        const modal = document.getElementById('reject-modal');
        const form = document.getElementById('reject-form');
        const overlay = modal.querySelector('[data-modal-overlay]');
        const panel = modal.querySelector('[data-modal-panel]');
        const cancel = modal.querySelector('[data-cancel-btn]');
        const notes = document.getElementById('notes');

        // set form action & isi notes (jika ada)
        form.action = actionUrl || '';
        notes.value = currentNotes || '';

        // reset tombol submit
        const btn = modal.querySelector('[data-reject-btn]');
        const spinner = btn.querySelector('svg');
        btn.disabled = false;
        spinner.classList.add('hidden');
        btn.querySelector('span').textContent = 'Tolak Surat';

        // tampilkan modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // animasi IN
        overlay.classList.remove('modal-overlay-out');
        panel.classList.remove('modal-panel-out');
        void overlay.offsetWidth; // reflow
        overlay.classList.add('modal-overlay-in');
        panel.classList.add('modal-panel-in');

        // fokuskan ke textarea biar langsung ketik
        setTimeout(() => notes.focus(), 60);
    }

    // Tutup modal
    function closeRejectModal() {
        const modal = document.getElementById('reject-modal');
        const overlay = modal.querySelector('[data-modal-overlay]');
        const panel = modal.querySelector('[data-modal-panel]');

        // animasi OUT
        overlay.classList.remove('modal-overlay-in');
        panel.classList.remove('modal-panel-in');
        overlay.classList.add('modal-overlay-out');
        panel.classList.add('modal-panel-out');

        // sembunyikan setelah animasi selesai
        panel.addEventListener('animationend', () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, {
            once: true
        });
    }

    // Klik overlay untuk menutup
    document.getElementById('reject-modal').addEventListener('click', (e) => {
        const panel = e.currentTarget.querySelector('[data-modal-panel]');
        if (!panel.contains(e.target)) closeRejectModal();
    });

    // Tombol batal
    document.querySelector('#reject-modal [data-cancel-btn]')
        .addEventListener('click', closeRejectModal);

    // ESC untuk menutup
    document.addEventListener('keydown', (e) => {
        const modal = document.getElementById('reject-modal');
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeRejectModal();
        }
    });

    // Proteksi double submit + spinner
    document.getElementById('reject-form').addEventListener('submit', function() {
        const btn = this.querySelector('[data-reject-btn]');
        const spinner = btn.querySelector('svg');
        btn.disabled = true;
        spinner.classList.remove('hidden');
        btn.querySelector('span').textContent = 'Mengirim...';
    });
</script>
