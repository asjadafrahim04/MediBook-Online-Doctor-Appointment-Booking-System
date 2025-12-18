<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-4">Account Pending Approval</h1>
                    <p class="text-lg text-gray-600">
                        Your doctor account is pending admin approval.
                    </p>
                    <p class="mt-4 text-gray-500">
                        You will be notified once approved. Thank you for registering!
                    </p>
                    <div class="mt-6 text-center">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>