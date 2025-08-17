
function handleUserSubmit(event) {

    const submitButton = document.getElementById('user-submit-button'); // Pastikan tombol submit Anda memiliki ID ini

    if (submitButton) {
        submitButton.querySelector('span').textContent = 'Membuat...';
        submitButton.disabled = true;
    }

    // Form akan otomatis dikirim ke URL di atribut 'action' nya setelah ini.
}
