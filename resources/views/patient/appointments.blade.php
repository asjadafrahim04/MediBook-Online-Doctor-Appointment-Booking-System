<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">

                    <h1 class="text-3xl font-bold text-center text-blue-700 mb-10">
                        My Appointments
                    </h1>

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($appointments->count() === 0)
                        <div class="text-center py-12">
                            <p class="text-xl text-gray-600">You have no appointments yet.</p>
                            <a href="{{ route('doctors.index') }}" 
                               class="mt-4 inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Find a Doctor
                            </a>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($appointments as $appointment)
                                <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div>
                                            <h3 class="text-xl font-semibold text-gray-800">
                                                Dr. {{ $appointment->doctor->user->name }}
                                            </h3>
                                            <p class="text-blue-600">{{ $appointment->doctor->specialization }}</p>
                                        </div>
                                        
                                        <div>
                                            <p class="text-gray-700">
                                                <span class="font-medium">Date:</span> 
                                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F j, Y') }}
                                            </p>
                                            <p class="text-gray-700">
                                                <span class="font-medium">Time:</span> 
                                                {{ \Carbon\Carbon::parse($appointment->start_time)->format('g:i A') }} - 
                                                {{ \Carbon\Carbon::parse($appointment->end_time)->format('g:i A') }}
                                            </p>
                                        </div>
                                        
                                        <div class="text-right">
                                            <span class="inline-block px-4 py-1 rounded-full text-sm font-medium 
                                                @if($appointment->status === 'booked') bg-green-100 text-green-800
                                                @elseif($appointment->status === 'cancelled') bg-red-100 text-red-800
                                                @else bg-blue-100 text-blue-800 @endif">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                            
                                            @if($appointment->status === 'booked')
                                                <form method="POST" action="{{ route('appointments.cancel', $appointment) }}" 
                                                      class="mt-3 inline-block" 
                                                      onsubmit="return confirm('Are you sure you want to cancel this appointment?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-800 text-sm">
                                                        Cancel Appointment
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    @if($appointment->symptoms)
                                        <div class="mt-4 pt-4 border-t border-gray-100">
                                            <p class="text-gray-600">
                                                <span class="font-medium">Symptoms:</span> {{ $appointment->symptoms }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-10">
                            {{ $appointments->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>