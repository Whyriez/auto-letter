<!-- Modal: Konfirmasi Hapus Jenis Surat -->
<div id="confirm-delete-jenis-surat" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 px-4"
    role="dialog" aria-modal="true" aria-labelledby="confirm-delete-jenis-surat-title">

    <div class="absolute inset-0" data-modal-overlay></div>

    <div class="relative bg-white rounded-2xl shadow-2xl max-w-sm w-full p-6" data-modal-panel>
        <div class="text-center">
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <!-- ikon trash -->
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
<script>
    // Open modal hapus jenis surat
    function openDeleteJenisSuratModal(deleteUrl) {
        const modal = document.getElementById('confirm-delete-jenis-surat');
        const form = document.getElementById('delete-jenis-surat-form');
        const panel = modal.querySelector('[data-modal-panel]');
        const overlay = modal.querySelector('[data-modal-overlay]');
        const cancelBtn = modal.querySelector('[data-cancel-btn]');

        // set action form
        form.action = deleteUrl;

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // animasi masuk
        overlay.classList.remove('modal-overlay-out');
        panel.classList.remove('modal-panel-out');
        void overlay.offsetWidth;
        overlay.classList.add('modal-overlay-in');
        panel.classList.add('modal-panel-in');

        setTimeout(() => cancelBtn.focus(), 10);
    }

    // Close modal hapus jenis surat
    function closeDeleteJenisSuratModal() {
        const modal = document.getElementById('confirm-delete-jenis-surat');
        const panel = modal.querySelector('[data-modal-panel]');
        const overlay = modal.querySelector('[data-modal-overlay]');

        overlay.classList.remove('modal-overlay-in');
        panel.classList.remove('modal-panel-in');
        overlay.classList.add('modal-overlay-out');
        panel.classList.add('modal-panel-out');

        panel.addEventListener('animationend', () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, {
            once: true
        });
    }

    // Event cancel & overlay click
    document.querySelector('#confirm-delete-jenis-surat [data-cancel-btn]')
        .addEventListener('click', closeDeleteJenisSuratModal);

    document.getElementById('confirm-delete-jenis-surat')
        .addEventListener('click', (e) => {
            const panel = e.currentTarget.querySelector('[data-modal-panel]');
            if (!panel.contains(e.target)) closeDeleteJenisSuratModal();
        });

    // ESC untuk tutup
    document.addEventListener('keydown', (e) => {
        const modal = document.getElementById('confirm-delete-jenis-surat');
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeDeleteJenisSuratModal();
        }
    });

    // Spinner saat submit
    document.getElementById('delete-jenis-surat-form')
        .addEventListener('submit', function() {
            const delBtn = this.querySelector('[data-delete-btn]');
            const spinner = delBtn.querySelector('svg');
            delBtn.disabled = true;
            spinner.classList.remove('hidden');
            delBtn.querySelector('span').textContent = 'Menghapus...';
        });
</script>
