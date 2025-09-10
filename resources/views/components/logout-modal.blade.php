<div id="logoutModal"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">

    <div class="bg-white rounded-lg shadow-lg md:w-full md:max-w-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Confirm Logout</h2>
            <button type="button"
                onclick="document.getElementById('logoutModal').classList.add('hidden')"
                class="text-gray-600 text-2xl font-bold">&times;
            </button>
        </div>

        <form method="POST" action="{{ route('clinic.logout') }}">
            @csrf
            <p class="mb-4">Are you sure you want to log out?</p>

            <div class="flex justify-end gap-2">
                <button type="button"
                    onclick="document.getElementById('logoutModal').classList.add('hidden')"
                    class="border-2 border-gray-200 px-4 py-2 rounded">
                    Cancel
                </button>

                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">
                    Confirm
                </button>
            </div>
        </form>
    </div>
</div>