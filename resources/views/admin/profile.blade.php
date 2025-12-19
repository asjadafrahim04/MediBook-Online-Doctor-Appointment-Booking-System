<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-xl">
                <div class="p-10 lg:p-16">

                    <!-- Header -->
                    <div class="text-center mb-12">
                        <div class="w-32 h-32 mx-auto mb-6 rounded-full overflow-hidden shadow-lg border-4 border-indigo-100">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-indigo-500 to-indigo-700 flex items-center justify-center text-5xl text-white font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </div>
                            @endif
                        </div>
                        <h1 class="text-4xl font-bold text-indigo-800">
                            Admin Profile
                        </h1>
                        <p class="text-xl text-gray-600 mt-4">
                            Manage your admin account information
                        </p>
                    </div>

                    @if(session('status'))
                        <div class="mb-8 p-6 bg-green-100 border border-green-400 text-green-800 rounded-xl text-center text-lg">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Update Profile Form -->
                    <div class="mb-12">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Personal Information</h2>
                        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="space-y-8">
                            @csrf
                            @method('PATCH')

                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-lg font-medium text-gray-700 mb-2">
                                    Name
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required
                                       class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-indigo-300 focus:border-indigo-500">
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-lg font-medium text-gray-700 mb-2">
                                    Email
                                </label>
                                <p class="px-6 py-4 bg-gray-100 rounded-xl text-gray-800">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-lg font-medium text-gray-700 mb-2">
                                    Phone Number
                                </label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', Auth::user()->phone) }}"
                                       class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-indigo-300 focus:border-indigo-500">
                            </div>

                            <!-- Profile Photo -->
                            <div>
                                <label for="profile_photo" class="block text-lg font-medium text-gray-700 mb-2">
                                    Profile Picture
                                </label>
                                <input type="file" name="profile_photo" id="profile_photo" accept="image/*"
                                       class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            </div>

                            <div class="text-center pt-6">
                                <button type="submit"
                                        class="px-12 py-4 bg-indigo-600 text-white font-bold text-xl rounded-xl shadow-lg hover:bg-indigo-700 transition">
                                    Update Profile
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Change Password -->
                    <div class="mb-12 pt-8 border-t border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Change Password</h2>
                        <form method="POST" action="{{ route('admin.profile.password.update') }}" class="space-y-8">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label for="current_password" class="block text-lg font-medium text-gray-700 mb-2">
                                    Current Password
                                </label>
                                <input type="password" name="current_password" id="current_password" required
                                       class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-indigo-300 focus:border-indigo-500">
                            </div>

                            <div>
                                <label for="password" class="block text-lg font-medium text-gray-700 mb-2">
                                    New Password
                                </label>
                                <input type="password" name="password" id="password" required
                                       class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-indigo-300 focus:border-indigo-500">
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-lg font-medium text-gray-700 mb-2">
                                    Confirm New Password
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                       class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-indigo-300 focus:border-indigo-500">
                            </div>

                            <div class="text-center pt-6">
                                <button type="submit"
                                        class="px-12 py-4 bg-orange-600 text-white font-bold text-xl rounded-xl shadow-lg hover:bg-orange-700 transition">
                                    Change Password
                                </button>
                            </div>
                        </form>
                    </div>

                    
                    <div class="border-t-4 border-red-200 pt-8">
                        

                        <!-- Logout -->
                        <div class="mb-8">
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                        class="px-8 py-4 bg-gray-600 text-white font-bold rounded-xl shadow hover:bg-gray-700 transition">
                                    Logout
                                </button>
                            </form>
                        </div>

                        <!-- Delete Account -->
                        <div>
                            <p class="text-red-600 mb-4">
                                Once you delete your account, there is no going back.
                            </p>
                            <form method="POST" action="{{ route('admin.profile.delete') }}" onsubmit="return confirm('Are you sure you want to delete your account? This cannot be undone.');">
                                @csrf
                                @method('DELETE')

                                <div class="mb-4">
                                    <label for="password" class="block text-lg font-medium text-gray-700 mb-2">
                                        Confirm Password
                                    </label>
                                    <input type="password" name="password" id="password" required
                                           class="w-full px-6 py-4 border-2 border-red-300 rounded-xl focus:ring-4 focus:ring-red-300 focus:border-red-500">
                                </div>

                                <button type="submit"
                                        class="px-12 py-4 bg-red-600 text-white font-bold text-xl rounded-xl shadow-lg hover:bg-red-700 transition">
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