<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">

                    <!-- Welcome -->
                    <div class="text-center mb-10">
                        <h1 class="text-3xl font-bold text-blue-700">
                            Doctor Dashboard
                        </h1>
                        <p class="text-xl text-gray-600 mt-4">
                            Manage your schedule and patients
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
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
            </div>
        </div>
    </div>
</x-app-layout>