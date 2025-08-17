<div id="user-modal"
    class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50 px-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <h2 id="user-modal-title" class="text-xl font-semibold text-gray-900">Tambah Pengguna</h2>
            <button onclick="closeUserModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <form class="p-6 space-y-6" onsubmit="handleUserSubmit(event)"
            action="{{ route('super_admin.submit_new_user') }}" method="POST">
            @csrf
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pribadi</h3>
                <div class="mt-4">
                    <label for="user-name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="user-name" name="user-name" required placeholder="Masukkan nama Anda..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
            </div>

            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Kontak</h3>
                <div>
                    <label for="user-email" class="block text-sm font-medium text-gray-700 mb-2">
                        Alamat Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="user-email" name="user-email" required
                        placeholder="Masukkan alamat email..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
            </div>

            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Akses Sistem</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="user-role" class="block text-sm font-medium text-gray-700 mb-2">
                            Peran <span class="text-red-500">*</span>
                        </label>
                        <select id="user-role" name="user-role" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            <option value="">-- Pilih Peran --</option>
                            <option value="super_admin">Super Admin</option>
                            <option value="admin_jurusan">Admin Jurusan</option>
                            <option value="kaprodi">Kaprodi</option>
                            <option value="kajur">Kajur</option>
                            <option value="mahasiswa">Mahasiswa</option>
                        </select>
                    </div>
                    <div>
                        <label for="user-status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="user-status" name="user-status" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            <option value="active">Aktif</option>
                            <option value="inactive">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
            </div>

            <div id="nim-nip-container" class="border-b border-gray-200 pb-6 hidden">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Akademik</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <div id="nim-nip-field-wrapper">
                        <label id="nim-nip-label" for="nim-nip-input"
                            class="block text-sm font-medium text-gray-700 mb-2">
                            NIM / NIP <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nim-nip-input" name="nim_nip" placeholder="Masukkan NIM atau NIP..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div id="jurusan-field-wrapper">
                        <label for="user-jurusan" class="block text-sm font-medium text-gray-700 mb-2">
                            Jurusan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="user-jurusan" name="jurusan" placeholder="Masukkan Jurusan..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div id="prodi-field-wrapper">
                        <label for="user-prodi" class="block text-sm font-medium text-gray-700 mb-2">
                            Program Studi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="user-prodi" name="prodi" placeholder="Masukkan Program Studi..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                </div>
            </div>

            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Kata Sandi</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="user-password" class="block text-sm font-medium text-gray-700 mb-2">
                            Kata Sandi <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="user-password" name="password" required
                            placeholder="Masukkan kata sandi..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label for="user-password-confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Kata Sandi <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="user-password-confirmation" name="password_confirmation" required
                            placeholder="Konfirmasi kata sandi Anda..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                </div>
                <div id="password-error-message" class="text-red-500 text-sm mt-2" style="display: none;"></div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-4">
                <button type="button" onclick="closeUserModal()"
                    class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" id="user-submit-button" disabled
                    class="flex-1 px-6 py-3 bg-gray-400 text-white font-semibold rounded-lg transition-all duration-200 cursor-not-allowed">
                    <span id="user-submit-text">Buat Pengguna</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const roleSelect = document.getElementById('user-role');
        const identityContainer = document.getElementById('nim-nip-container');
        const nimNipLabel = document.getElementById('nim-nip-label');
        const nimNipInput = document.getElementById('nim-nip-input');
        const jurusanWrapper = document.getElementById('jurusan-field-wrapper');
        const jurusanInput = document.getElementById('user-jurusan');
        const prodiWrapper = document.getElementById('prodi-field-wrapper');
        const prodiInput = document.getElementById('user-prodi');

        function updateDependentFields() {
            const selectedRole = roleSelect.value;
            switch (selectedRole) {
                case 'mahasiswa':
                    identityContainer.classList.remove('hidden');
                    prodiWrapper.classList.remove('hidden');

                    nimNipLabel.innerHTML = 'NIM <span class="text-red-500">*</span>';
                    nimNipInput.placeholder = 'Masukkan NIM...';
                    nimNipInput.required = true;
                    jurusanInput.required = true;
                    prodiInput.required = true;
                    break;

                case 'kaprodi':
                    identityContainer.classList.remove('hidden');
                    prodiWrapper.classList.remove('hidden');

                    nimNipLabel.innerHTML = 'NIP <span class="text-red-500">*</span>';
                    nimNipInput.placeholder = 'Masukkan NIP...';
                    nimNipInput.required = true;
                    jurusanInput.required = true;
                    prodiInput.required = true;
                    break;

                case 'kajur':
                case 'admin_jurusan':
                    identityContainer.classList.remove('hidden');
                    prodiWrapper.classList.add('hidden');

                    nimNipLabel.innerHTML = 'NIP <span class="text-red-500">*</span>';
                    nimNipInput.placeholder = 'Masukkan NIP...';
                    nimNipInput.required = true;
                    jurusanInput.required = true;
                    prodiInput.required = false;
                    prodiInput.value = '';
                    break;

                default:
                    identityContainer.classList.add('hidden');
                    nimNipInput.required = false;
                    jurusanInput.required = false;
                    prodiInput.required = false;
                    break;
            }
        }

        roleSelect.addEventListener('change', updateDependentFields);
        updateDependentFields();
    });
</script>

<script>
    function openUserModal(userName = null) {
        const modal = document.getElementById('user-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeUserModal() {
        document.getElementById('user-modal').classList.add('hidden');
        document.getElementById('user-modal').classList.remove('flex');
        // Reset form
        document.querySelector('#user-modal form').reset();
    }
</script>
