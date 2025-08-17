<div id="edit-user-modal"
    class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50 px-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <!-- Header Modal -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <h2 id="user-modal-title" class="text-xl font-semibold text-gray-900">Edit Pengguna</h2>
            <button onclick="closeEditUserModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Body Modal -->
        <form class="p-6 space-y-6" onsubmit="handleEditFormSubmit(event)" id="edit-user-form" method="POST"
            action="">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit-user-id" name="user_id">

            <!-- Informasi Pribadi -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pribadi</h3>
                <div class="mt-4">
                    <label for="edit-user-name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="edit-user-name" name="user-name" required
                        placeholder="Masukkan nama Anda..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
            </div>

            <!-- Informasi Kontak -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Kontak</h3>
                <div>
                    <label for="edit-user-email" class="block text-sm font-medium text-gray-700 mb-2">
                        Alamat Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="edit-user-email" name="user-email" required
                        placeholder="Masukkan alamat email..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
            </div>

            <!-- Akses Sistem -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Akses Sistem</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="edit-user-role" class="block text-sm font-medium text-gray-700 mb-2">
                            Peran <span class="text-red-500">*</span>
                        </label>
                        <select id="edit-user-role" name="user-role" required
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
                        <label for="edit-user-status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="edit-user-status" name="user-status" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            <option value="active">Aktif</option>
                            <option value="inactive">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Informasi Akademik (dinamis) -->
            <div id="edit-nim-nip-container" class="border-b border-gray-200 pb-6 hidden">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Akademik</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <div id="edit-nim-nip-field-wrapper">
                        <label id="edit-nim-nip-label" for="edit-nim-nip-input"
                            class="block text-sm font-medium text-gray-700 mb-2">
                            NIM / NIP <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit-nim-nip-input" name="nim_nip"
                            placeholder="Masukkan NIM atau NIP..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div id="edit-jurusan-field-wrapper">
                        <label for="edit-user-jurusan" class="block text-sm font-medium text-gray-700 mb-2">
                            Jurusan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit-user-jurusan" name="jurusan" placeholder="Masukkan Jurusan..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div id="edit-prodi-field-wrapper">
                        <label for="edit-user-prodi" class="block text-sm font-medium text-gray-700 mb-2">
                            Program Studi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit-user-prodi" name="prodi"
                            placeholder="Masukkan Program Studi..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                </div>
            </div>

            <!-- Kata Sandi -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Kata Sandi</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="edit-user-password" class="block text-sm font-medium text-gray-700 mb-2">
                            Kata Sandi
                        </label>
                        <input type="password" id="edit-user-password" name="password"
                            placeholder="Masukkan kata sandi baru (opsional)"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label for="edit-user-password-confirmation"
                            class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Kata Sandi
                        </label>
                        <input type="password" id="edit-user-password-confirmation" name="password_confirmation"
                            placeholder="Konfirmasi kata sandi baru (opsional)"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                </div>
                <div id="edit-password-error-message" class="text-red-500 text-sm mt-2" style="display: none;"></div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex flex-col sm:flex-row gap-3 pt-4">
                <button type="button" onclick="closeEditUserModal()"
                    class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" id="edit-user-submit-button" disabled
                    class="flex-1 px-6 py-3 bg-gray-400 text-white font-semibold rounded-lg transition-all duration-200 cursor-not-allowed">
                    <span id="edit-user-submit-text">Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    async function openEditUserModal(userId) {
        const modal = document.getElementById('edit-user-modal');
        const form = document.getElementById('edit-user-form');
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        try {
            const response = await fetch(`/dashboard/users/${userId}`);
            if (!response.ok) throw new Error('Data pengguna tidak ditemukan.');

            const user = await response.json();
            document.getElementById('edit-user-id').value = user.id ?? '';
            document.getElementById('edit-user-name').value = user.name ?? '';
            document.getElementById('edit-user-email').value = user.email ?? '';
            document.getElementById('edit-user-role').value = user.role ?? '';
            document.getElementById('edit-user-status').value = user.status ?? '';
            document.getElementById('edit-nim-nip-input').value = user.nim_nip ?? '';
            document.getElementById('edit-user-jurusan').value = user.jurusan ?? '';
            document.getElementById('edit-user-prodi').value = user.prodi ?? '';

            if (form) form.action = `/dashboard/users/${user.id}`;

            // jalankan validasi role & password setelah isi data
            validateForm();

        } catch (error) {
            console.error('Gagal memuat data pengguna:', error);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    function closeEditUserModal() {
        document.getElementById('edit-user-modal').classList.add('hidden');
        document.getElementById('edit-user-modal').classList.remove('flex');
        document.querySelector('#edit-user-modal form').reset();
    }

    const editPasswordInput = document.getElementById('edit-user-password');
    const confirmInput = document.getElementById('edit-user-password-confirmation');
    const submitBtn = document.getElementById('edit-user-submit-button');
    const errorMsg = document.getElementById('edit-password-error-message');

    const editRole = document.getElementById('edit-user-role');
    const editContainer = document.getElementById('edit-nim-nip-container');
    const editNimLabel = document.getElementById('edit-nim-nip-label');
    const editNimInput = document.getElementById('edit-nim-nip-input');
    const editJurusan = document.getElementById('edit-user-jurusan');
    const editProdiWrapper = document.getElementById('edit-prodi-field-wrapper');
    const editProdi = document.getElementById('edit-user-prodi');

    // Validasi password
    function validatePasswords() {
        const pwd = editPasswordInput.value.trim();
        const conf = confirmInput.value.trim();

        if (pwd === '' && conf === '') {
            errorMsg.textContent = '';
            errorMsg.style.display = 'none';
            return true;
        }

        if (pwd !== conf) {
            errorMsg.textContent = 'Kata sandi dan konfirmasi tidak sama.';
            errorMsg.style.display = 'block';
            return false;
        }

        errorMsg.textContent = '';
        errorMsg.style.display = 'none';
        return true;
    }

    // Validasi role & bidang akademik
    function updateEditDependentFields() {
        let role = editRole.value;
        let valid = true;

        switch (role) {
            case 'mahasiswa':
                editContainer.classList.remove('hidden');
                editProdiWrapper.classList.remove('hidden');
                editNimLabel.innerHTML = 'NIM <span class="text-red-500">*</span>';
                editNimInput.required = editJurusan.required = editProdi.required = true;
                if (!editNimInput.value.trim() || !editJurusan.value.trim() || !editProdi.value.trim()) valid = false;
                break;

            case 'kaprodi':
                editContainer.classList.remove('hidden');
                editProdiWrapper.classList.remove('hidden');
                editNimLabel.innerHTML = 'NIP <span class="text-red-500">*</span>';
                editNimInput.required = editJurusan.required = editProdi.required = true;
                if (!editNimInput.value.trim() || !editJurusan.value.trim() || !editProdi.value.trim()) valid = false;
                break;

            case 'kajur':
            case 'admin_jurusan':
                editContainer.classList.remove('hidden');
                editProdiWrapper.classList.add('hidden');
                editNimLabel.innerHTML = 'NIP <span class="text-red-500">*</span>';
                editNimInput.required = editJurusan.required = true;
                editProdi.required = false;
                editProdi.value = '';
                if (!editNimInput.value.trim() || !editJurusan.value.trim()) valid = false;
                break;

            case 'super_admin':
                editContainer.classList.add('hidden');
                editNimInput.required = editJurusan.required = editProdi.required = false;
                valid = true;
                break;

            default:
                editContainer.classList.add('hidden');
                editNimInput.required = editJurusan.required = editProdi.required = false;
                valid = true;
        }

        return valid;
    }

    // Gabungkan semua validasi
    function validateForm() {
        const pwdValid = validatePasswords();
        const roleValid = updateEditDependentFields();

        if (pwdValid && roleValid) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('bg-red-400', 'cursor-not-allowed');
            submitBtn.classList.add('bg-red-600', 'hover:bg-red-700');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('bg-red-400', 'cursor-not-allowed');
            submitBtn.classList.remove('bg-red-600', 'hover:bg-red-700');
        }
    }

    // Listener
    editPasswordInput.addEventListener('input', validateForm);
    confirmInput.addEventListener('input', validateForm);
    editRole.addEventListener('change', validateForm);
    editNimInput.addEventListener('input', validateForm);
    editJurusan.addEventListener('input', validateForm);
    editProdi.addEventListener('input', validateForm);

    document.addEventListener('DOMContentLoaded', validateForm);

    function handleEditFormSubmit(event) {
        const btn = document.getElementById('edit-user-submit-button');
        btn.querySelector('span').textContent = 'Menyimpan...';
        btn.disabled = true;
    }
</script>
