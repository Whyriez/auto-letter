<div id="edit-user-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 px-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] flex flex-col overflow-hidden">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-red-50 flex-shrink-0">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 11c1.657 0 3-1.567 3-3.5S13.657 4 12 4 9 5.567 9 7.5 10.343 11 12 11zM5 21v-2a4 4 0 014-4h6a4 4 0 014 4v2" />
                </svg>
                </span>
                <div>
                    <h2 id="user-modal-title" class="text-lg font-semibold text-gray-900">Edit Pengguna</h2>
                    <p class="text-xs text-gray-600">Perbarui data pengguna, lalu klik “Simpan Perubahan”.</p>
                </div>
            </div>
            <button onclick="closeEditUserModal()" class="text-gray-400 hover:text-gray-600 transition-colors"
                aria-label="Tutup">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form class="flex-1 overflow-y-auto px-6 py-6 space-y-6" onsubmit="handleEditFormSubmit(event)"
            id="edit-user-form" method="POST" action="">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit-user-id" name="user_id">

            <section class="border border-gray-200 rounded-xl p-4">
                <div class="flex items-center gap-2 mb-3">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c1.657 0 3-1.567 3-3.5S13.657 4 12 4 9 5.567 9 7.5 10.343 11 12 11zM5 21v-2a4 4 0 014-4h6a4 4 0 014 4v2" />
                    </svg>
                    <h3 class="text-sm font-semibold text-gray-900">Informasi Pribadi</h3>
                </div>
                <label for="edit-user-name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama <span class="text-red-500">*</span>
                </label>
                <input type="text" id="edit-user-name" name="user-name" required placeholder="Masukkan nama Anda..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
            </section>

            <section class="border border-gray-200 rounded-xl p-4">
                <div class="flex items-center gap-2 mb-3">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <h3 class="text-sm font-semibold text-gray-900">Informasi Kontak</h3>
                </div>
                <label for="edit-user-email" class="block text-sm font-medium text-gray-700 mb-2">
                    Alamat Email <span class="text-red-500">*</span>
                </label>
                <input type="email" id="edit-user-email" name="user-email" required
                    placeholder="Masukkan alamat email..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
            </section>

            <section class="border border-gray-200 rounded-xl p-4">
                <div class="flex items-center gap-2 mb-3">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3l7 2.5v5c0 5.25-3.7 9.9-7 11.5-3.3-1.6-7-6.25-7-11.5v-5L12 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                    </svg>
                    <h3 class="text-sm font-semibold text-gray-900">Akses Sistem</h3>
                </div>
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
            </section>

            <section id="edit-nim-nip-container" class="border border-gray-200 rounded-xl p-4 hidden">
                <div class="flex items-center gap-2 mb-3">
                    <!-- academic-cap (valid) -->
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l6.16-3.422A12.082 12.082 0 0112 20.055 12.082 12.082 0 015.84 10.578L12 14z" />
                    </svg>
                    <h3 class="text-sm font-semibold text-gray-900">Informasi Akademik</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
                        <input type="text" id="edit-user-jurusan" name="jurusan"
                            placeholder="Masukkan Jurusan..."
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
            </section>

            <section class="border border-gray-200 rounded-xl p-4">
                <div class="flex items-center gap-2 mb-3">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10V7a4 4 0 118 0v3m-9 0h10a2 2 0 012 2v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-6a2 2 0 012-2z" />
                    </svg>
                    <h3 class="text-sm font-semibold text-gray-900">Kata Sandi</h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="relative">
                        <label for="edit-user-password" class="block text-sm font-medium text-gray-700 mb-2">
                            Kata Sandi
                        </label>
                        <div class="relative">
                            <input type="password" id="edit-user-password" name="password"
                                placeholder="Masukkan kata sandi baru (opsional)"
                                class="w-full pr-11 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            <button type="button" id="edit-toggle-pass"
                                class="absolute right-4 top-1/2 -translate-y-1/2 translate-x-1/2 text-gray-400 hover:text-gray-600"
                                aria-label="Lihat/Sembunyikan password" aria-pressed="false">
                                <svg class="icon-eye w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7S3.732 16.057 2.458 12z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg class="icon-eye-off w-5 h-5 hidden" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7S3.732 16.057 2.458 12z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="relative">
                        <label for="edit-user-password-confirmation"
                            class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Kata Sandi
                        </label>
                        <div class="relative">
                            <input type="password" id="edit-user-password-confirmation" name="password_confirmation"
                                placeholder="Konfirmasi kata sandi baru (opsional)"
                                class="w-full pr-11 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            <button type="button" id="edit-toggle-pass2"
                                class="absolute right-4 top-1/2 -translate-y-1/2 translate-x-1/2 text-gray-400 hover:text-gray-600"
                                aria-label="Lihat/Sembunyikan konfirmasi" aria-pressed="false">
                                <svg class="icon-eye w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7S3.732 16.057 2.458 12z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg class="icon-eye-off w-5 h-5 hidden" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7S3.732 16.057 2.458 12z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div id="edit-password-error-message" class="text-red-600 text-sm mt-2 hidden">
                    Kata sandi dan konfirmasi tidak sama.
                </div>
            </section>
        </form>

        <div class="flex flex-col sm:flex-row gap-3 px-6 py-4 border-t border-gray-200 bg-white flex-shrink-0">
            <button type="button" onclick="closeEditUserModal()"
                class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50">
                Batal
            </button>
            <button type="submit" form="edit-user-form" id="edit-user-submit-button" disabled
                class="flex-1 px-6 py-3 bg-gray-400 text-white font-semibold rounded-lg transition disabled:cursor-not-allowed">
                <span id="edit-user-submit-text">Simpan Perubahan</span>
            </button>
        </div>
    </div>
</div>

<script>
    async function openEditUserModal(userId) {
        const modal = document.getElementById('edit-user-modal');
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

            const form = document.getElementById('edit-user-form');
            if (form) form.action = `/dashboard/users/${user.id}`;

            validateForm();

        } catch (error) {
            console.error('Gagal memuat data pengguna:', error);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    function closeEditUserModal() {
        const m = document.getElementById('edit-user-modal');
        m.classList.add('hidden');
        m.classList.remove('flex');
        const form = m.querySelector('form');
        if (form) form.reset();

        document.getElementById('edit-password-error-message')?.classList.add('hidden');

        const btn = document.getElementById('edit-user-submit-button');
        btn.disabled = true;
        btn.classList.remove('bg-red-600', 'hover:bg-red-700');
        btn.classList.add('bg-gray-400');

        document.getElementById('edit-nim-nip-container')?.classList.add('hidden');
        document.getElementById('edit-user-prodi').value = '';

        ['edit-toggle-pass', 'edit-toggle-pass2'].forEach(id => {
            const b = document.getElementById(id);
            if (!b) return;
            const eye = b.querySelector('.icon-eye');
            const eyeOff = b.querySelector('.icon-eye-off');
            eye?.classList.remove('hidden');
            eyeOff?.classList.add('hidden');
        });
    }

    document.getElementById('edit-user-modal').addEventListener('click', (e) => {
        if (e.target.id === 'edit-user-modal') closeEditUserModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            const m = document.getElementById('edit-user-modal');
            if (!m.classList.contains('hidden')) closeEditUserModal();
        }
    });

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

    function validatePasswords() {
        const pwd = (editPasswordInput.value || '').trim();
        const conf = (confirmInput.value || '').trim();

        if (pwd === '' && conf === '') {
            errorMsg.classList.add('hidden');
            return true;
        }
        if (pwd !== conf) {
            errorMsg.classList.remove('hidden');
            return false;
        }
        errorMsg.classList.add('hidden');
        return true;
    }

    function updateEditDependentFields() {
        const r = editRole.value;
        let valid = true;

        switch (r) {
            case 'mahasiswa':
                editContainer.classList.remove('hidden');
                editProdiWrapper.classList.remove('hidden');
                editNimLabel.innerHTML = 'NIM <span class="text-red-500">*</span>';
                editNimInput.required = true;
                editJurusan.required = true;
                editProdi.required = true;
                if (!editNimInput.value.trim() || !editJurusan.value.trim() || !editProdi.value.trim()) valid = false;
                break;

            case 'kaprodi':
                editContainer.classList.remove('hidden');
                editProdiWrapper.classList.remove('hidden');
                editNimLabel.innerHTML = 'NIP <span class="text-red-500">*</span>';
                editNimInput.required = true;
                editJurusan.required = true;
                editProdi.required = true;
                if (!editNimInput.value.trim() || !editJurusan.value.trim() || !editProdi.value.trim()) valid = false;
                break;

            case 'kajur':
            case 'admin_jurusan':
                editContainer.classList.remove('hidden');
                editProdiWrapper.classList.add('hidden');
                editNimLabel.innerHTML = 'NIP <span class="text-red-500">*</span>';
                editNimInput.required = true;
                editJurusan.required = true;
                editProdi.required = false;
                editProdi.value = '';
                if (!editNimInput.value.trim() || !editJurusan.value.trim()) valid = false;
                break;

            case 'super_admin':
                editContainer.classList.add('hidden');
                editNimInput.required = false;
                editJurusan.required = false;
                editProdi.required = false;
                valid = true;
                break;

            default:
                editContainer.classList.add('hidden');
                editNimInput.required = false;
                editJurusan.required = false;
                editProdi.required = false;
                valid = true;
        }
        return valid;
    }

    function validateForm() {
        const pwdValid = validatePasswords();
        const roleValid = updateEditDependentFields();

        if (pwdValid && roleValid) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('bg-gray-400');
            submitBtn.classList.add('bg-red-600', 'hover:bg-red-700');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('bg-gray-400');
            submitBtn.classList.remove('bg-red-600', 'hover:bg-red-700');
        }
    }

    (function togglePasswordEdit() {
        const pairs = [{
                btn: document.getElementById('edit-toggle-pass'),
                input: document.getElementById('edit-user-password')
            },
            {
                btn: document.getElementById('edit-toggle-pass2'),
                input: document.getElementById('edit-user-password-confirmation')
            }
        ];
        pairs.forEach(({
            btn,
            input
        }) => {
            if (!btn || !input) return;
            const eye = btn.querySelector('.icon-eye');
            const eyeOff = btn.querySelector('.icon-eye-off');
            btn.addEventListener('click', () => {
                const isVisible = input.type === 'text';
                input.type = isVisible ? 'password' : 'text';
                eye.classList.toggle('hidden', !isVisible);
                eyeOff.classList.toggle('hidden', isVisible);
                btn.setAttribute('aria-pressed', String(!isVisible));
            });
        });
    })();

    editPasswordInput.addEventListener('input', validateForm);
    confirmInput.addEventListener('input', validateForm);
    editRole.addEventListener('change', validateForm);
    editNimInput.addEventListener('input', validateForm);
    editJurusan.addEventListener('input', validateForm);
    editProdi.addEventListener('input', validateForm);

    document.addEventListener('DOMContentLoaded', validateForm);

    function handleEditFormSubmit(event) {
        const btn = document.getElementById('edit-user-submit-button');
        if (btn) {
            btn.disabled = true;
            btn.classList.remove('hover:bg-red-700');
            btn.querySelector('span').textContent = 'Menyimpan...';
        }
    }
</script>
