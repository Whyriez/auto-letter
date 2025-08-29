<!-- Modal: Konfirmasi Hapus Jenis Surat -->
<div id="confirm-delete-jenis-surat" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 px-4"
    role="dialog" aria-modal="true" aria-labelledby="confirm-delete-jenis-surat-title">

    <!-- Overlay (untuk animasi) -->
    <div class="absolute inset-0" data-modal-overlay></div>

    <!-- Panel -->
    <div class="relative bg-white rounded-2xl shadow-2xl max-w-sm w-full p-6" data-modal-panel>
        <div class="text-center">
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0a2 2 0 002-2V5a2 2 0 00-2-2h-3.5l-1-1h-3l-1 1H7a2 2 0 00-2 2v0a2 2 0 002 2h10z" />
                </svg>
            </div>
            <h3 id="confirm-delete-jenis-surat-title" class="text-lg font-semibold text-gray-900 mb-2">
                Konfirmasi Penghapusan
            </h3>
            <p class="text-gray-600 text-sm mb-5">
                Apakah Anda yakin ingin menghapus jenis surat ini? Tindakan ini tidak dapat dibatalkan.
            </p>

            <form method="POST" id="delete-jenis-surat-form">
                @csrf
                @method('DELETE')
                <div class="flex gap-2">
                    <button type="button" data-cancel-btn
                        class="w-full bg-white hover:bg-gray-100 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors border border-gray-300">
                        Batal
                    </button>
                    <button type="submit" data-delete-btn
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 hidden animate-spin" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" aria-hidden="true">
                            <circle cx="12" cy="12" r="9" stroke-width="2" class="opacity-25"></circle>
                            <path d="M21 12a9 9 0 00-9-9" stroke-width="2" class="opacity-75"></path>
                        </svg>
                        <span>Hapus</span>
                    </button>
                </div>
            </form>
        </div>
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
    function openDeleteJenisSuratModal(deleteUrl) {
        const modal = document.getElementById('confirm-delete-jenis-surat');
        const form = document.getElementById('delete-jenis-surat-form');
        const overlay = modal.querySelector('[data-modal-overlay]');
        const panel = modal.querySelector('[data-modal-panel]');
        const cancel = modal.querySelector('[data-cancel-btn]');
        const btn = modal.querySelector('[data-delete-btn]');
        const spin = btn.querySelector('svg');

        // set form action
        form.action = deleteUrl;

        // reset tombol
        btn.disabled = false;
        spin.classList.add('hidden');
        btn.querySelector('span').textContent = 'Hapus';

        // tampilkan modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // trigger animasi IN
        overlay.classList.remove('modal-overlay-out');
        panel.classList.remove('modal-panel-out');
        void overlay.offsetWidth; // reflow untuk retrigger animasi
        overlay.classList.add('modal-overlay-in');
        panel.classList.add('modal-panel-in');

        // fokus ke tombol batal
        setTimeout(() => cancel?.focus(), 40);
    }

    function closeDeleteJenisSuratModal() {
        const modal = document.getElementById('confirm-delete-jenis-surat');
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

    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('confirm-delete-jenis-surat');
        const cancelBtn = modal.querySelector('[data-cancel-btn]');
        const deleteForm = document.getElementById('delete-jenis-surat-form');

        // Tombol batal
        cancelBtn?.addEventListener('click', (e) => {
            e.preventDefault();
            closeDeleteJenisSuratModal();
        });

        // Klik area di luar panel => tutup
        modal.addEventListener('click', (e) => {
            const panel = modal.querySelector('[data-modal-panel]');
            if (panel && !panel.contains(e.target)) closeDeleteJenisSuratModal();
        });

        // ESC => tutup
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeDeleteJenisSuratModal();
            }
        });

        // Submit: proteksi double submit + spinner
        deleteForm?.addEventListener('submit', function() {
            const btn = this.querySelector('[data-delete-btn]');
            const spin = btn.querySelector('svg');
            btn.disabled = true;
            spin.classList.remove('hidden');
            btn.querySelector('span').textContent = 'Menghapus...';
        });
    });
</script>
