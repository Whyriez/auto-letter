
<div id="confirm-delete-modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 px-4"
    role="dialog" aria-modal="true" aria-labelledby="confirm-delete-title">

    <div class="absolute inset-0" data-modal-overlay></div>

    <div class="relative bg-white rounded-2xl shadow-2xl max-w-sm w-full p-6" data-modal-panel>
        <div class="text-center">
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
              
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </div>
            <h3 id="confirm-delete-title" class="text-lg font-semibold text-gray-900 mb-2">Konfirmasi Penghapusan</h3>
            <p class="text-gray-600 text-sm mb-5">
                Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
            </p>

            <form action="{{ route('super_admin.users') }}" method="POST" id="delete-form">
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
    function openDeleteModal(deleteUrl) {
        const modal = document.getElementById('confirm-delete-modal');
        const panel = modal.querySelector('[data-modal-panel]');
        const overlay = modal.querySelector('[data-modal-overlay]');
        const form = document.getElementById('delete-form');
        const cancel = modal.querySelector('[data-cancel-btn]');

        form.action = deleteUrl;

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        const delBtn = modal.querySelector('[data-delete-btn]');
        const spinner = delBtn.querySelector('svg');
        delBtn.disabled = false;
        spinner.classList.add('hidden');
        delBtn.querySelector('span').textContent = 'Hapus';

        overlay.classList.remove('modal-overlay-out');
        panel.classList.remove('modal-panel-out');
        void overlay.offsetWidth;
        overlay.classList.add('modal-overlay-in');
        panel.classList.add('modal-panel-in');

        setTimeout(() => cancel?.focus(), 10);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('confirm-delete-modal');
        const panel = modal.querySelector('[data-modal-panel]');
        const overlay = modal.querySelector('[data-modal-overlay]');

        overlay.classList.remove('modal-overlay-in');
        panel.classList.remove('modal-panel-in');
        overlay.classList.add('modal-overlay-out');
        panel.classList.add('modal-panel-out');

        const handleEnd = () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            panel.removeEventListener('animationend', handleEnd);
        };
        panel.addEventListener('animationend', handleEnd, {
            once: true
        });
    }

    document.getElementById('confirm-delete-modal')
        .addEventListener('click', (e) => {
            const panel = e.currentTarget.querySelector('[data-modal-panel]');
            if (!panel.contains(e.target)) closeDeleteModal();
        });

    document.querySelector('#confirm-delete-modal [data-cancel-btn]')
        .addEventListener('click', closeDeleteModal);

    document.addEventListener('keydown', (e) => {
        const modal = document.getElementById('confirm-delete-modal');
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeDeleteModal();
        }
    });

    document.getElementById('delete-form').addEventListener('submit', function(e) {
        const delBtn = this.querySelector('[data-delete-btn]');
        const spinner = delBtn.querySelector('svg');
        delBtn.disabled = true;
        spinner.classList.remove('hidden');
        delBtn.querySelector('span').textContent = 'Menghapus...';
    });
</script>
