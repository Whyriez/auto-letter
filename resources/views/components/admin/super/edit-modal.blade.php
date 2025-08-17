<div id="edit-user-modal"
    class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50 px-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <h2 id="user-modal-title" class="text-xl font-semibold text-gray-900">Edit User</h2>
            <button onclick="closeEditUserModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <form class="p-6 space-y-6" onsubmit="handleEditFormSubmit(event)" id="edit-user-form" method="POST"
            action="">
            @csrf
            @method('PUT')
            <!-- Personal Information Section -->
            <input type="hidden" id="edit-user-id" name="user_id">
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h3>
                <div class="mt-4">
                    <label for="user-username" class="block text-sm font-medium text-gray-700 mb-2">
                        Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="edit-user-name" name="user-name" required placeholder="Enter your name..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500">
                </div>
            </div>

            <!-- Contact Information Section -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h3>
                <div>
                    <label for="user-email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="edit-user-email" name="user-email" required
                        placeholder="Enter email address..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900 placeholder-gray-500">
                </div>
            </div>

            <!-- System Access Section -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">System Access</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="user-role" class="block text-sm font-medium text-gray-700 mb-2">
                            Role <span class="text-red-500">*</span>
                        </label>
                        <select id="edit-user-role" name="user-role" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900">
                            <option value="">-- Select Role --</option>
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
                        <select id="edit-user-status" name="user-status" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 text-gray-900">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="border-b border-gray-200 pb-6">
            </div>

            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Password</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="user-password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="edit-user-password" name="password" placeholder="Enter password..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label for="user-password-confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirm Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="edit-user-password-confirmation" name="password_confirmation"
                            placeholder="Confirm your password..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                </div>
                <div id="edit-password-error-message" class="text-red-500 text-sm mt-2" style="display: none;"></div>
            </div>


            <div class="flex flex-col sm:flex-row gap-3 pt-4">
                <button type="button" onclick="closeEditUserModal()"
                    class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50">
                    Cancel
                </button>
                <button type="submit" id="edit-user-submit-button"
                    class="flex-1 px-6 py-3 bg-red-600 text-white font-semibold rounded-lg transition-all duration-200">
                    <span id="edit-user-submit-text">Save Changes</span>
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    async function openEditUserModal(userId) {
        const modal = document.getElementById('edit-user-modal');
        const form = document.getElementById('edit-user-form');

        // Tampilkan modal terlebih dahulu
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        try {
            // 1. Minta data user ke server menggunakan ID
            const response = await fetch(`/dashboard/users/${userId}`);
            // Jika respons tidak sukses (misal: user tidak ditemukan), lempar error
            if (!response.ok) {
                throw new Error('User data not found.');
            }

            // 2. Ubah data respons menjadi objek JSON
            const user = await response.json();
            document.getElementById('edit-user-id').value = user.id ?? '';
            document.getElementById('edit-user-name').value = user.name ?? '';
            document.getElementById('edit-user-email').value = user.email ?? '';
            document.getElementById('edit-user-role').value = user.role ?? '';
            document.getElementById('edit-user-status').value = user.status ?? '';

            if (form) {
                form.action = `/dashboard/users/${user.id}`;
            }

        } catch (error) {
            console.error('Failed to fetch user data:', error);

            showSuccessMessage('Gagal memuat data user. Silakan coba lagi.', 'red');

            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    function closeEditUserModal() {
        document.getElementById('edit-user-modal').classList.add('hidden');
        document.getElementById('edit-user-modal').classList.remove('flex');
        // Reset form
        document.querySelector('#edit-user-modal form').reset();
    }
</script>

<script>
    // Password match validation
    const editPasswordInput = document.getElementById('edit-user-password');
    const confirmInput = document.getElementById('edit-user-password-confirmation');
    const submitBtn = document.getElementById('edit-user-submit-button');
    const errorMsg = document.getElementById('edit-password-error-message');

    function validatePasswords() {
        const pwd = editPasswordInput.value;
        const conf = confirmInput.value;

        if ((pwd !== conf) && (pwd !== '' || conf !== '')) {
            submitBtn.disabled = true;
            submitBtn.classList.add('bg-red-400', 'cursor-not-allowed');
            submitBtn.classList.remove('bg-red-600', 'hover:bg-red-700');
            errorMsg.textContent = 'Password and confirmation do not match.';
            errorMsg.style.display = 'block';
        } else {
            submitBtn.disabled = false;
            submitBtn.classList.remove('bg-red-400', 'cursor-not-allowed');
            submitBtn.classList.add('bg-red-600', 'hover:bg-red-700');
            errorMsg.textContent = '';
            errorMsg.style.display = 'none';
        }
    }

    editPasswordInput.addEventListener('input', validatePasswords);
    confirmInput.addEventListener('input', validatePasswords);
</script>

{{-- handle submit --}}
<script>
    function handleEditFormSubmit(event) {
        const submitButton = document.getElementById('edit-user-submit-button');

        // Ubah teks tombol dan nonaktifkan untuk mencegah klik ganda
        if (submitButton) {
            submitButton.querySelector('span').textContent = 'Saving...';
            submitButton.disabled = true;
        }
    }
</script>
