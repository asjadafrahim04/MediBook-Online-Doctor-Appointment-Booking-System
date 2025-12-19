<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">

                    <h2 class="text-3xl font-bold text-center text-blue-700 mb-10">
                        My Profile
                    </h2>

                    @if(session('status'))
                        <div class="mb-8 p-4 bg-green-50 text-green-700 rounded-lg text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Profile Photo -->
                    <div class="text-center mb-10">
                        <div class="w-32 h-32 mx-auto rounded-full overflow-hidden shadow-lg border-4 border-blue-100">
                            <img src="{{ Auth::user()->profile_photo_url }}" 
                                 alt="Profile Photo" 
                                 class="w-full h-full object-cover">
                        </div>
                    </div>

                    <!-- Update Profile Form -->
                    <form method="POST" action="{{ route('patient.profile.update') }}" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PATCH')

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Name
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required
                                   class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email
                            </label>
                            <p class="px-5 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-600">
                                {{ Auth::user()->email }}
                            </p>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Phone Number
                            </label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', Auth::user()->phone) }}"
                                   class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Profile Photo Upload -->
                        <div>
                            <label for="profile_photo" class="block text-sm font-medium text-gray-700 mb-2">
                                Profile Picture
                            </label>
                            <input type="file" name="profile_photo" id="profile_photo" accept="image/*"
                                   class="w-full px-5 py-3 border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>

                        <div class="text-center pt-6">
                            <button type="submit"
                                    class="px-8 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                                Update Profile
                            </button>
                        </div>
                    </form>

                    <!-- Change Password -->
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">Change Password</h3>
                        <form method="POST" action="{{ route('patient.password.update') }}" class="space-y-6">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Current Password
                                </label>
                                <input type="password" name="current_password" id="current_password" required
                                       class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    New Password
                                </label>
                                <input type="password" name="password" id="password" required
                                       class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                    Confirm New Password
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                       class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div class="text-center">
                                <button type="submit"
                                        class="px-8 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition">
                                    Change Password
                                </button>
                            </div>
                        </form>
                    </div>

                   
                    <div class="mt-12 pt-8 border-t border-gray-200">

                        <!-- Logout -->
                        <div class="mb-8 text-center">
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                        class="px-8 py-3 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition">
                                    Logout
                                </button>
                            </form>
                        </div>

                        <!-- Delete Account -->
                        <div class="text-center">
                            <p class="text-red-600 mb-4 text-sm">
                                This action cannot be undone. All your data and appointments will be permanently deleted.
                            </p>
                            <form method="POST" action="{{ route('patient.account.delete') }}" onsubmit="return confirm('Are you sure? This cannot be undone.');">
                                @csrf
                                @method('DELETE')

                                <div class="mb-4">
                                    <label for="delete_password" class="block text-sm font-medium text-gray-700 mb-2">
                                        Confirm Password
                                    </label>
                                    <input type="password" name="password" id="delete_password" required
                                           class="w-full px-5 py-3 border border-red-300 rounded-lg focus:ring-2 focus:ring-red-500">
                                </div>

                                <button type="submit"
                                        class="px-8 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition">
                                    Delete My Account
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>