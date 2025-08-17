<div id="confirm-logout-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 px-4">
    <div class="bg-white rounded-xl p-6 max-w-sm w-full">
        <div class="text-center">
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 text-red-600 text-center" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>
            </div>
        </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2 text-center">Logout Confirmation</h3>
            <p class="text-gray-600 text-sm mb-4 text-center">Are you sure you want to logout?</p>
            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                @csrf
                <div class="flex gap-2">
                    <button onclick="closeLogoutModal()" type="button"
                        class="w-full bg-white hover:bg-gray-100 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors border border-gray-300">
                        Cancel
                    </button>
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Logout
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openLogoutModal() {
        const modal = document.getElementById('confirm-logout-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeLogoutModal() {
        const modal = document.getElementById('confirm-logout-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
