<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-xl">
                <div class="p-10 lg:p-16">

                    <!-- Header -->
                    <div class="text-center mb-12">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-700 rounded-full mx-auto mb-6 flex items-center justify-center text-4xl text-white font-bold shadow-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <h1 class="text-4xl font-bold text-blue-800">
                            Welcome, Dr. {{ Auth::user()->name }}
                        </h1>
                        <p class="text-xl text-gray-600 mt-4">
                            Complete your professional profile to start receiving appointments
                        </p>
                    </div>

                    <!-- Form -->
                    <form method="POST" action="{{ route('doctor.profile.store') }}" class="space-y-10">
                        @csrf

                        <!-- Specialization Dropdown -->
                        <div>
                            <label for="specialization" class="block text-lg font-medium text-gray-700 mb-3">
                                Specialization <span class="text-red-600">*</span>
                            </label>
                            <select name="specialization" id="specialization" required
                                    class="w-full px-6 py-4 text-lg border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-300 focus:border-blue-500 transition">
                                <option value="" disabled selected>Select your specialization</option>
                                <option value="General Physician">General Physician</option>
                                <option value="Cardiologist">Cardiologist</option>
                                <option value="Dermatologist">Dermatologist</option>
                                <option value="Pediatrician">Pediatrician</option>
                                <option value="Neurologist">Neurologist</option>
                                <option value="Orthopedic Surgeon">Orthopedic Surgeon</option>
                                <option value="Gynecologist">Gynecologist</option>
                                <option value="ENT Specialist">ENT Specialist</option>
                                <option value="Psychiatrist">Psychiatrist</option>
                                <option value="Dentist">Dentist</option>
                                <option value="Ophthalmologist">Ophthalmologist</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('specialization')
                                <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Qualification Dropdown -->
                        <div>
                            <label for="qualification" class="block text-lg font-medium text-gray-700 mb-3">
                                Qualification <span class="text-red-600">*</span>
                            </label>
                            <select name="qualification" id="qualification" required
                                    class="w-full px-6 py-4 text-lg border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-300 focus:border-blue-500 transition">
                                <option value="" disabled selected>Select your qualification</option>
                                <option value="MBBS">MBBS</option>
                                <option value="MD">MD</option>
                                <option value="FCPS">FCPS</option>
                                <option value="FRCS">FRCS</option>
                                <option value="MRCP">MRCP</option>
                                <option value="MS">MS</option>
                                <option value="BDS">BDS</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('qualification')
                                <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Years of Experience -->
                        <div>
                            <label for="experience_years" class="block text-lg font-medium text-gray-700 mb-3">
                                Years of Experience <span class="text-red-600">*</span>
                            </label>
                            <input type="number"
                                   name="experience_years"
                                   id="experience_years"
                                   value="{{ old('experience_years') }}"
                                   required
                                   min="0"
                                   max="60"
                                   placeholder="e.g. 5"
                                   class="w-full px-6 py-4 text-lg border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-300 focus:border-blue-500 transition">
                            @error('experience_years')
                                <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Save Profile Button (ADD THIS) -->
                        <div class="text-center pt-12">
                            <button type="submit"
                                    class="px-20 py-6 bg-gradient-to-r from-green-600 to-green-700 text-white font-bold text-2xl rounded-xl shadow-2xl hover:from-green-700 hover:to-green-800 transform hover:scale-105 transition duration-300">
                                Save Profile
                            </button>
                        </div>
                    </form>

                    <!-- Logout Hint (optional) -->
                    <div class="mt-12 text-center text-gray-500 text-sm">
                        <p>You can update this information later from your profile settings.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>