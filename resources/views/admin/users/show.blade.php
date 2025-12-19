<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-6">User Details</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-lg font-medium">Name:</p>
                            <p class="text-gray-700">{{ $user->name }}</p>
                        </div>
                        <div>
                            <p class="text-lg font-medium">Email:</p>
                            <p class="text-gray-700">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-lg font-medium">Role:</p>
                            <p class="text-gray-700">{{ ucfirst($user->role) }}</p>
                        </div>
                        <div>
                            <p class="text-lg font-medium">Phone:</p>
                            <p class="text-gray-700">{{ $user->phone ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-lg font-medium">Registered At:</p>
                            <p class="text-gray-700">{{ $user->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-lg font-medium">Status:</p>
                            <p class="text-gray-700">
                                @if($user->is_blocked)
                                    Blocked
                                @else
                                    Active
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('admin.users.index') }}" class="text-indigo-600 hover:text-indigo-900">Back to Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>