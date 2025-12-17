<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">

                    <!-- Common Welcome -->
                    <h1 class="text-3xl font-bold text-center text-blue-700 mb-8">
                        Welcome back, {{ auth()->user()->name }}!
                    </h1>

                    @if(auth()->user()->role === 'patient')
                        <!-- Patient Dashboard - Only 3 Cards -->
                        <div class="text-center">
                            <p class="text-xl text-gray-700 mb-8">
                                Book your next appointment easily
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <a href="{{ route('doctors.index') }}" class="block p-8 bg-blue-50 rounded-lg hover:bg-blue-100 transition border border-blue-200">
                                    <div class="text-5xl mb-4">🔍</div>
                                    <h3 class="text-xl font-semibold text-blue-800">Find Doctors</h3>
                                    <p class="text-gray-600 mt-2">Search and view available doctors</p>
                                </a>

                                <a href="{{ route('patient.appointments') }}" class="block p-8 bg-green-50 rounded-lg hover:bg-green-100 transition border border-green-200">
                                    <div class="text-5xl mb-4">📅</div>
                                    <h3 class="text-xl font-semibold text-green-800">My Appointments</h3>
                                    <p class="text-gray-600 mt-2">View upcoming and past appointments</p>
                                </a>

                                <a href="{{ route('patient.profile') }}" class="block p-8 bg-purple-50 rounded-lg hover:bg-purple-100 transition border border-purple-200">
                                    <div class="text-5xl mb-4">👤</div>
                                    <h3 class="text-xl font-semibold text-purple-800">My Profile</h3>
                                    <p class="text-gray-600 mt-2">View and edit your information</p>
                                </a>
                            </div>
                        </div>

                    @elseif(auth()->user()->role === 'doctor')
                        <!-- Doctor Dashboard - Only 3 Cards -->
                        <div class="text-center">
                            <p class="text-xl text-gray-700 mb-8">
                                Manage your schedule and patients
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <a href="{{ route('doctor.today') }}" class="block p-8 bg-purple-50 rounded-lg hover:bg-purple-100 transition border border-purple-200">
                                    <div class="text-5xl mb-4">👥</div>
                                    <h3 class="text-xl font-semibold text-purple-800">Today's Patients</h3>
                                    <p class="text-gray-600 mt-2">See who is coming today</p>
                                </a>

                                <a href="{{ route('doctor.schedule.edit') }}" class="block p-8 bg-orange-50 rounded-lg hover:bg-orange-100 transition border border-orange-200">
                                    <div class="text-5xl mb-4">⚙️</div>
                                    <h3 class="text-xl font-semibold text-orange-800">My Schedule</h3>
                                    <p class="text-gray-600 mt-2">Set your weekly availability</p>
                                </a>

                                <a href="{{ route('doctor.appointments') }}" class="block p-8 bg-teal-50 rounded-lg hover:bg-teal-100 transition border border-teal-200">
                                    <div class="text-5xl mb-4">🗓️</div>
                                    <h3 class="text-xl font-semibold text-teal-800">All Appointments</h3>
                                    <p class="text-gray-600 mt-2">View upcoming bookings</p>
                                </a>
                            </div>
                        </div>

                    @elseif(auth()->user()->role === 'admin')
                        <!-- Admin Dashboard -->
                        <div class="text-center">
                            <p class="text-xl text-gray-700 mb-8">
                                Manage the MediBook system
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <a href="{{ route('admin.doctors.index') }}" class="block p-8 bg-red-50 rounded-lg hover:bg-red-100 transition border border-red-200">
                                    <div class="text-5xl mb-4">👨‍⚕️</div>
                                    <h3 class="text-xl font-semibold text-red-800">Manage Doctors</h3>
                                    <p class="text-gray-600 mt-2">Approve or reject doctor registrations</p>
                                </a>

                                <a href="#" class="block p-8 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition border border-indigo-200">
                                    <div class="text-5xl mb-4">📊</div>
                                    <h3 class="text-xl font-semibold text-indigo-800">System Overview</h3>
                                    <p class="text-gray-600 mt-2">View statistics and reports (coming soon)</p>
                                </a>
                            </div>
                        </div>

                    @else
                        <p class="text-center text-gray-600">Your role is not recognized. Please contact admin.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>