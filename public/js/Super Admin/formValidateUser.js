// 1. Ambil semua elemen form yang kita butuhkan
const nameInput = document.getElementById('user-name');
const emailInput = document.getElementById('user-email');
const roleSelect = document.getElementById('user-role');
const statusSelect = document.getElementById('user-status');
const passwordInput = document.getElementById('user-password');
const confirmPasswordInput = document.getElementById('user-password-confirmation');
const passwordErrorMessage = document.getElementById('password-error-message');
const submitButton = document.getElementById('user-submit-button');

// Buat array dari semua field yang wajib diisi
const requiredFields = [nameInput, emailInput, roleSelect, statusSelect, passwordInput, confirmPasswordInput];

// 2. Buat fungsi utama untuk memvalidasi seluruh form
function validateForm() {
    let allFieldsFilled = true;

    // Cek apakah semua field wajib sudah diisi
    requiredFields.forEach(field => {
        if (field.value.trim() === '') {
            allFieldsFilled = false;
        }
    });

    // Cek apakah password dan konfirmasi password cocok
    const passwordsMatch = passwordInput.value === confirmPasswordInput.value;

    // Tampilkan atau sembunyikan pesan error password
    if (confirmPasswordInput.value.length > 0 && !passwordsMatch) {
        passwordErrorMessage.textContent = 'Password and confirmation do not match.';
        passwordErrorMessage.style.display = 'block';
    } else {
        passwordErrorMessage.style.display = 'none';
    }

    // 3. Aktifkan atau nonaktifkan tombol submit berdasarkan hasil validasi
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

// 4. Tambahkan event listener ke setiap field input
// Ini akan memanggil fungsi validateForm() setiap kali pengguna mengetik
requiredFields.forEach(field => {
    field.addEventListener('input', validateForm);
});

// Panggil fungsi sekali di awal untuk memastikan tombol nonaktif
document.addEventListener('DOMContentLoaded', validateForm);