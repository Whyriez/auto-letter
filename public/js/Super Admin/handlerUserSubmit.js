
function handleUserSubmit(event) {

    const submitButton = document.getElementById('user-submit-button'); // Pastikan tombol submit Anda punya ID ini

    if (submitButton) {
        submitButton.querySelector('span').textContent = 'Creating...';
        submitButton.disabled = true;
    }

    // Form akan otomatis submit ke URL di atribut 'action'-nya setelah ini.
}