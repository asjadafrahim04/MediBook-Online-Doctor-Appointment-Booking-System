<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <h1 class="text-3xl font-bold text-center text-teal-800 mb-8">System Overview</h1>

                    <!-- Statistics Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
                        <div class="text-center p-6 bg-teal-50 rounded-lg border border-teal-200">
                            <p class="text-4xl font-bold text-teal-700">{{ $totalPatients }}</p>
                            <p class="text-lg text-gray-700 mt-2">Total Patients</p>
                        </div>
                        <div class="text-center p-6 bg-teal-50 rounded-lg border border-teal-200">
                            <p class="text-4xl font-bold text-teal-700">{{ $totalDoctors }}</p>
                            <p class="text-lg text-gray-700 mt-2">Total Doctors</p>
                        </div>
                        <div class="text-center p-6 bg-teal-50 rounded-lg border border-teal-200">
                            <p class="text-4xl font-bold text-teal-700">{{ $totalAppointments }}</p>
                            <p class="text-lg text-gray-700 mt-2">Total Appointments</p>
                        </div>
                        <div class="text-center p-6 bg-orange-50 rounded-lg border border-orange-200">
                            <p class="text-4xl font-bold text-orange-600">{{ $pendingDoctors }}</p>
                            <p class="text-lg text-gray-700 mt-2">Pending Approvals</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Appointments Chart -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h2 class="text-2xl font-semibold text-teal-800 mb-4 text-center">Appointments (Last 7 Days)</h2>
                            <canvas id="appointmentsChart" height="300"></canvas>
                        </div>

                        <!-- Doctor Registrations Chart -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h2 class="text-2xl font-semibold text-teal-800 mb-4 text-center">Doctor Registrations (Last 6 Months)</h2>
                            <canvas id="registrationsChart" height="300"></canvas>
                        </div>
                    </div>

                    <div class="mt-8 text-center">
                        <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-900">
                            ← Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Chart(document.getElementById('appointmentsChart'), {
                type: 'line',
                data: {
                    labels: @json($appointmentsLabels),
                    datasets: [{
                        label: 'Appointments',
                        data: @json($appointmentsCounts),
                        borderColor: '#14b8a6',
                        backgroundColor: 'rgba(20, 184, 166, 0.2)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });

            new Chart(document.getElementById('registrationsChart'), {
                type: 'bar',
                data: {
                    labels: @json($registrationsLabels),
                    datasets: [{
                        label: 'New Doctors',
                        data: @json($registrationsCounts),
                        backgroundColor: '#6366f1'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });
        });
    </script>
</x-app-layout>