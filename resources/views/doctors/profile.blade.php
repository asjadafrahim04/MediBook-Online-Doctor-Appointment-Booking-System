<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-xl">
                <div class="p-10 lg:p-16">

                    <!-- Header -->
<div class="text-center mb-12">
    <div class="w-32 h-32 mx-auto mb-6 rounded-full overflow-hidden shadow-lg border-4 border-blue-100">
        @if(Auth::user()->profile_photo)
            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-5xl text-white font-bold">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
        @endif
    </div>
    <h1 class="text-4xl font-bold text-blue-800">
        Doctor Profile
    </h1>
    <p class="text-xl text-gray-600 mt-4">
        Manage your personal and professional information
    </p>
</div>

                    @if(session('status'))
                        <div class="mb-8 p-6 bg-green-100 border border-green-400 text-green-800 rounded-xl text-center text-lg">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Update Profile Form -->
                    <div class="mb-12">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Personal & Professional Information</h2>
                        <form method="POST" action="{{ route('doctor.profile.update') }}" enctype="multipart/form-data" class="space-y-8">
                            @csrf
                            @method('PATCH')

                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-lg font-medium text-gray-700 mb-2">
                                    Name
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required
                                       class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-300 focus:border-blue-500">
                            </div>

                            <!-- Email (Display Only) -->
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
                                       class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-300 focus:border-blue-500">
                            </div>

                            <!-- Specialization -->
                            <div>
                                <label for="specialization" class="block text-lg font-medium text-gray-700 mb-2">
                                    Specialization
                                </label>
                                <select name="specialization" id="specialization" required
                                        class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-300 focus:border-blue-500">
                                    <option value="" disabled>Select Specialization</option>
                                    <option value="General Physician" {{ old('specialization', $doctor->specialization ?? '') == 'General Physician' ? 'selected' : '' }}>General Physician</option>
                                    <option value="Cardiologist" {{ old('specialization', $doctor->specialization ?? '') == 'Cardiologist' ? 'selected' : '' }}>Cardiologist</option>
                                    <option value="Dermatologist" {{ old('specialization', $doctor->specialization ?? '') == 'Dermatologist' ? 'selected' : '' }}>Dermatologist</option>
                                    <option value="Pediatrician" {{ old('specialization', $doctor->specialization ?? '') == 'Pediatrician' ? 'selected' : '' }}>Pediatrician</option>
                                    <option value="Neurologist" {{ old('specialization', $doctor->specialization ?? '') == 'Neurologist' ? 'selected' : '' }}>Neurologist</option>
                                    <option value="Orthopedic Surgeon" {{ old('specialization', $doctor->specialization ?? '') == 'Orthopedic Surgeon' ? 'selected' : '' }}>Orthopedic Surgeon</option>
                                    <option value="Gynecologist" {{ old('specialization', $doctor->specialization ?? '') == 'Gynecologist' ? 'selected' : '' }}>Gynecologist</option>
                                    <option value="ENT Specialist" {{ old('specialization', $doctor->specialization ?? '') == 'ENT Specialist' ? 'selected' : '' }}>ENT Specialist</option>
                                    <option value="Psychiatrist" {{ old('specialization', $doctor->specialization ?? '') == 'Psychiatrist' ? 'selected' : '' }}>Psychiatrist</option>
                                    <option value="Other" {{ old('specialization', $doctor->specialization ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <!-- Qualification -->
                            <div>
                                <label for="qualification" class="block text-lg font-medium text-gray-700 mb-2">
                                    Qualification
                                </label>
                                <select name="qualification" id="qualification" required
                                        class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-300 focus:border-blue-500">
                                    <option value="" disabled>Select Qualification</option>
                                    <option value="MBBS" {{ old('qualification', $doctor->qualification ?? '') == 'MBBS' ? 'selected' : '' }}>MBBS</option>
                                    <option value="MD" {{ old('qualification', $doctor->qualification ?? '') == 'MD' ? 'selected' : '' }}>MD</option>
                                    <option value="FCPS" {{ old('qualification', $doctor->qualification ?? '') == 'FCPS' ? 'selected' : '' }}>FCPS</option>
                                    <option value="FRCS" {{ old('qualification', $doctor->qualification ?? '') == 'FRCS' ? 'selected' : '' }}>FRCS</option>
                                    <option value="MRCP" {{ old('qualification', $doctor->qualification ?? '') == 'MRCP' ? 'selected' : '' }}>MRCP</option>
                                    <option value="MS" {{ old('qualification', $doctor->qualification ?? '') == 'MS' ? 'selected' : '' }}>MS</option>
                                    <option value="BDS" {{ old('qualification', $doctor->qualification ?? '') == 'BDS' ? 'selected' : '' }}>BDS</option>
                                    <option value="Other" {{ old('qualification', $doctor->qualification ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <!-- Experience Years -->
                            <div>
                                <label for="experience_years" class="block text-lg font-medium text-gray-700 mb-2">
                                    Years of Experience
                                </label>
                                <input type="number" name="experience_years" id="experience_years" value="{{ old('experience_years', $doctor->experience_years ?? '') }}" min="0" max="60" required
                                       class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-300 focus:border-blue-500">
                            </div>

                            <!-- Profile Photo -->
                            <div>
                                <label for="profile_photo" class="block text-lg font-medium text-gray-700 mb-2">
                                    Profile Picture
                                </label>
                                <input type="file" name="profile_photo" id="profile_photo" accept="image/*"
                                       class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>

                            <div class="text-center pt-6">
                                <button type="submit"
                                        class="px-12 py-4 bg-blue-600 text-white font-bold text-xl rounded-xl shadow-lg hover:bg-blue-700 transition">
                                    Update Profile
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Change Password -->
                    <div class="mb-12 pt-8 border-t border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Change Password</h2>
                        <form method="POST" action="{{ route('doctor.profile.password.update') }}" class="space-y-8">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label for="current_password" class="block text-lg font-medium text-gray-700 mb-2">
                                    Current Password
                                </label>
                                <input type="password" name="current_password" id="current_password" required
                                       class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-300 focus:border-blue-500">
                            </div>

                            <div>
                                <label for="password" class="block text-lg font-medium text-gray-700 mb-2">
                                    New Password
                                </label>
                                <input type="password" name="password" id="password" required
                                       class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-300 focus:border-blue-500">
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-lg font-medium text-gray-700 mb-2">
                                    Confirm New Password
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                       class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-300 focus:border-blue-500">
                            </div>

                            <div class="text-center pt-6">
                                <button type="submit"
                                        class="px-12 py-4 bg-orange-600 text-white font-bold text-xl rounded-xl shadow-lg hover:bg-orange-700 transition">
                                    Change Password
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Danger Zone -->
                    <div class="border-t-4 border-red-200 pt-8">
                        <h2 class="text-2xl font-bold text-red-800 mb-6">Danger Zone</h2>

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
                                Once you delete your account, there is no going back. All your appointments will be lost.
                            </p>
                            <form method="POST" action="{{ route('doctor.profile.delete') }}" onsubmit="return confirm('Are you sure you want to delete your account? This cannot be undone.');">
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