<div id="user-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 px-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] flex flex-col overflow-hidden">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-red-50 flex-shrink-0">
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white shadow-sm">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c1.657 0 3-1.567 3-3.5S13.657 4 12 4 9 5.567 9 7.5 10.343 11 12 11zM5 21v-2a4 4 0 014-4h6a4 4 0 014 4v2" />
                    </svg>
                </span>
                <div>
                    <h2 id="user-modal-title" class="text-lg font-semibold text-gray-900">Tambah Pengguna</h2>
                    <p class="text-xs text-gray-600">Lengkapi data di bawah, lalu klik “Buat Pengguna”.</p>
                </div>
            </div>
            <button onclick="closeUserModal()" class="text-gray-400 hover:text-gray-600 transition-colors"
                aria-label="Tutup">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="add-user-form" class="flex-1 overflow-y-auto px-6 py-6 space-y-6" onsubmit="handleUserSubmit(event)"
            action="{{ route('super_admin.submit_new_user') }}" method="POST">
            @csrf
            <section class="border border-gray-200 rounded-xl p-4">
                <div class="flex items-center gap-2 mb-3">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c1.657 0 3-1.567 3-3.5S13.657 4 12 4 9 5.567 9 7.5 10.343 11 12 11zM5 21v-2a4 4 0 014-4h6a4 4 0 014 4v2" />
                    </svg>
                    <h3 class="text-sm font-semibold text-gray-900">Informasi Pribadi</h3>
                </div>
                <label for="user-name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama <span class="text-red-500">*</span>
                </label>
                <input type="text" id="user-name" name="user-name" required placeholder="Masukkan nama lengkap..."
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
                <label for="user-email" class="block text-sm font-medium text-gray-700 mb-2">
                    Alamat Email <span class="text-red-500">*</span>
                </label>
                <input type="email" id="user-email" name="user-email" required placeholder="nama@kampus.ac.id"
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
                        <label for="user-role" class="block text-sm font-medium text-gray-700 mb-2">
                            Peran <span class="text-red-500">*</span>
                        </label>
                        <select id="user-role" name="user-role" required
                            class="role-dropdown w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
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
            </section>

            <section id="nim-nip-container" class="border border-gray-200 rounded-xl p-4 hidden">
                <div class="flex items-center gap-2 mb-3">
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
                    <div id="nim-nip-field-wrapper">
                        <label id="nim-nip-label" for="nim-nip-input"
                            class="block text-sm font-medium text-gray-700 mb-2">
                            NIM / NIP <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nim-nip-input" name="nim_nip" placeholder="Masukkan NIM/NIP..."
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
                        <input type="text" id="user-prodi" name="prodi" placeholder="Masukkan Prodi..."
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
                        <label for="user-password" class="block text-sm font-medium text-gray-700 mb-2">
                            Kata Sandi <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" id="user-password" name="password" required
                                placeholder="Minimal 6 karakter"
                                class="w-full pr-11 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            <button type="button" id="toggle-pass"
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
                        <label for="user-password-confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Kata Sandi <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" id="user-password-confirmation" name="password_confirmation"
                                required placeholder="Ulangi kata sandi"
                                class="w-full pr-11 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            <button type="button" id="toggle-pass2"
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

                </div>
                <div id="password-error-message" class="text-red-600 text-sm mt-2 hidden">
                    Kata sandi dan konfirmasi tidak sama.
                </div>
            </section>
        </form>

        <div class="flex flex-col sm:flex-row gap-3 px-6 py-4 border-t border-gray-200 bg-white flex-shrink-0">
            <button type="button" onclick="closeUserModal()"
                class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50">
                Batal
            </button>
            <button type="submit" form="__dummyFormIdPrevention" class="hidden"></button> {{-- prevent Enter default on wrong form --}}
            <button type="submit" id="user-submit-button" form="add-user-form"
                class="flex-1 px-6 py-3 bg-gray-400 text-white font-semibold rounded-lg transition disabled:cursor-not-allowed"
                disabled>
                <span id="user-submit-text">Buat Pengguna</span>
            </button>
        </div>
    </div>
</div>
<script>
    function openUserModal() {
        const m = document.getElementById('user-modal');
        m.classList.remove('hidden');
        m.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeUserModal() {
        const m = document.getElementById('user-modal');
        m.classList.add('hidden');
        m.classList.remove('flex');
        document.body.style.overflow = '';
        const form = m.querySelector('form');
        if (form) form.reset();
        document.getElementById('password-error-message')?.classList.add('hidden');
        document.getElementById('user-submit-button').disabled = true;
        document.getElementById('nim-nip-container')?.classList.add('hidden');
        document.getElementById('prodi-field-wrapper')?.classList.remove('hidden');
    }

    document.getElementById('user-modal').addEventListener('click', (e) => {
        if (e.target.id === 'user-modal') closeUserModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            const m = document.getElementById('user-modal');
            if (!m.classList.contains('hidden')) closeUserModal();
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        const roleSelect = document.getElementById('user-role');
        const identityContainer = document.getElementById('nim-nip-container');
        const nimNipLabel = document.getElementById('nim-nip-label');
        const nimNipInput = document.getElementById('nim-nip-input');
        const jurusanInput = document.getElementById('user-jurusan');
        const prodiWrapper = document.getElementById('prodi-field-wrapper');
        const prodiInput = document.getElementById('user-prodi');

        function updateDependentFields() {
            const r = roleSelect.value;
            switch (r) {
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
                    prodiInput.value = '';
            }
        }

        roleSelect.addEventListener('change', updateDependentFields);
        updateDependentFields();
    });

    (function passwordValidation() {
        const pwd = document.getElementById('user-password');
        const conf = document.getElementById('user-password-confirmation');
        const msg = document.getElementById('password-error-message');
        const btn = document.getElementById('user-submit-button');

        function sync() {
            const p = (pwd.value || '').trim();
            const c = (conf.value || '').trim();

            if (p === '' || c === '') {
                msg.classList.add('hidden');
                btn.disabled = true;
                btn.classList.remove('hover:bg-red-700');
                btn.classList.add('bg-gray-400');
                btn.classList.remove('bg-red-600');
                return;
            }
            if (p !== c) {
                msg.classList.remove('hidden');
                btn.disabled = true;
                btn.classList.add('bg-gray-400');
                btn.classList.remove('bg-red-600', 'hover:bg-red-700');
            } else {
                msg.classList.add('hidden');
                btn.disabled = false;
                btn.classList.remove('bg-gray-400');
                btn.classList.add('bg-red-600', 'hover:bg-red-700');
            }
        }

        pwd.addEventListener('input', sync);
        conf.addEventListener('input', sync);
    })();

    (function togglePassword() {
        const pairs = [{
                btn: document.getElementById('toggle-pass'),
                input: document.getElementById('user-password')
            },
            {
                btn: document.getElementById('toggle-pass2'),
                input: document.getElementById('user-password-confirmation')
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

    function handleUserSubmit(e) {
        const btn = document.getElementById('user-submit-button');
        if (btn) {
            btn.disabled = true;
            btn.classList.remove('hover:bg-red-700');
            btn.querySelector('span').textContent = 'Menyimpan...';
        }
    }
</script>
