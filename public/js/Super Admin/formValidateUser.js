// Pastikan semua script berjalan setelah halaman dimuat
document.addEventListener('DOMContentLoaded', function () {

    // 1. Ambil semua elemen form yang berpotensi untuk divalidasi
    const nameInput = document.getElementById('user-name');
    const emailInput = document.getElementById('user-email');
    const roleSelect = document.getElementById('user-role');
    const statusSelect = document.getElementById('user-status');
    const passwordInput = document.getElementById('user-password');
    const confirmPasswordInput = document.getElementById('user-password-confirmation');
    const passwordErrorMessage = document.getElementById('password-error-message');
    const submitButton = document.getElementById('user-submit-button');
    const nimNipInput = document.getElementById('nim-nip-input');
    const departmentInput = document.getElementById('user-jurusan');
    const studyProgramInput = document.getElementById('user-prodi');

    // Daftar semua field yang interaktif untuk diberi event listener
    const allInteractiveFields = [
        nameInput, emailInput, roleSelect, statusSelect, passwordInput,
        confirmPasswordInput, nimNipInput, departmentInput, studyProgramInput
    ];

    // 2. Buat fungsi validasi yang dinamis
    function validateForm() {
        let allFieldsFilled = true;
        const selectedRole = roleSelect.value;

        // Tentukan field mana saja yang wajib diisi berdasarkan role
        // Mulai dengan field yang selalu wajib
        let fieldsToCheck = [nameInput, emailInput, roleSelect, statusSelect, passwordInput, confirmPasswordInput];

        switch (selectedRole) {
            case 'mahasiswa':
            case 'kaprodi':
                // Jika mahasiswa atau kaprodi, semua field identitas wajib
                fieldsToCheck.push(nimNipInput, departmentInput, studyProgramInput);
                break;
            case 'kajur':
            case 'admin_jurusan':
                // Jika kajur atau admin jurusan, prodi tidak wajib
                fieldsToCheck.push(nimNipInput, departmentInput);
                break;
            case 'super_admin':
                // Jika super_admin, tidak ada field identitas yang wajib
                // Biarkan fieldsToCheck seperti semula
                break;
        }

        // Lakukan pengecekan pada field yang sudah ditentukan
        fieldsToCheck.forEach(field => {
            // Pastikan elemennya ada sebelum memeriksa nilainya
            if (field && field.value.trim() === '') {
                allFieldsFilled = false;
            }
        });

        // Cek apakah password dan konfirmasi password cocok (logika ini tetap sama)
        const passwordsMatch = passwordInput.value === confirmPasswordInput.value;

        // Tampilkan atau sembunyikan pesan error password (logika ini tetap sama)
        if (confirmPasswordInput.value.length > 0 && !passwordsMatch) {
            passwordErrorMessage.textContent = 'Katasandi dan konfirmasi katasandi tidak cocok.';
            passwordErrorMessage.style.display = 'block';
        } else {
            passwordErrorMessage.style.display = 'none';
        }

        // 3. Aktifkan atau nonaktifkan tombol submit (logika ini tetap sama)
        if (allFieldsFilled && passwordsMatch) {
            submitButton.disabled = false;
            submitButton.classList.remove('bg-red-400', 'cursor-not-allowed');
            submitButton.classList.add('bg-red-600', 'hover:bg-red-700');
        } else {
            submitButton.disabled = true;
            submitButton.classList.add('bg-red-400', 'cursor-not-allowed');
            submitButton.classList.remove('bg-red-600', 'hover:bg-red-700');
        }
    }

    // 4. Tambahkan event listener ke semua field yang relevan
    allInteractiveFields.forEach(field => {
        if (field) { // Pastikan elemen ada sebelum menambahkan listener
            field.addEventListener('input', validateForm);
        }
    });

    // Juga, jalankan validasi setiap kali role diubah, karena daftar field wajibnya berubah
    roleSelect.addEventListener('change', validateForm);

    // Panggil fungsi sekali di awal untuk mengatur kondisi awal tombol
    validateForm();

});