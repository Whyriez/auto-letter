<div id="confirm-delete-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 px-4">
    <div class="bg-white rounded-xl p-6 max-w-sm w-full">
        <div class="text-center">
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Konfirmasi Penghapusan</h3>
            <p class="text-gray-600 text-sm mb-4">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat
                dibatalkan.</p>
            <form action="{{ route('super_admin.users') }}" method="POST" id="delete-form">
                @csrf
                @method('DELETE')
                <div class="flex gap-2">
                    <button onclick="closeDeleteModal()" type="button"
                        class="w-full bg-white hover:bg-gray-100 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors border border-gray-300">
                        Batal
                    </button>
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(deleteUrl) {
        // Cari form di dalam modal
        const deleteForm = document.getElementById('delete-form');

        // Atur atribut 'action' dari form dengan URL yang dikirim dari tombol
        deleteForm.action = deleteUrl;

        // Tampilkan modal
        const modal = document.getElementById('confirm-delete-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('confirm-delete-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
