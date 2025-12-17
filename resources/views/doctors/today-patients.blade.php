<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">

                    <!-- Header -->
                    <div class="text-center mb-10">
                        <h1 class="text-3xl font-bold text-blue-700">
                            Today's Patients
                        </h1>
                        <p class="text-xl text-gray-600 mt-4">
                            Appointments for {{ $today->format('F j, Y') }}
                        </p>
                    </div>

                    @if($appointments->isEmpty())
                        <div class="text-center py-12 bg-gray-50 rounded-lg">
                            <div class="text-6xl mb-4">😊</div>
                            <p class="text-2xl text-gray-600">
                                No patients today!
                            </p>
                            <p class="text-gray-500 mt-4">
                                Your schedule is clear. Check upcoming days or relax.
                            </p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($appointments as $appointment)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $appointment->patient->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $appointment->patient->email }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $appointment->start_time->format('g:i A') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Booked
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <!-- Back to Dashboard -->
                    <div class="text-center mt-12">
                        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            ← Back to Dashboard
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>