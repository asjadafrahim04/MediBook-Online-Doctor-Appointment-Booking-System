<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">

                    <h1 class="text-3xl font-bold text-center text-blue-700 mb-8">
                        Book Appointment with Dr. {{ $doctor->user->name }}
                    </h1>

                    <div class="mb-8 p-6 bg-blue-50 rounded-lg">
                        <p class="text-lg">
                            <span class="font-semibold">Date:</span> {{ $date->format('l, F j, Y') }}
                        </p>
                        <p class="text-lg">
                            <span class="font-semibold">Specialization:</span> {{ $doctor->specialization }}
                        </p>
                    </div>

                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                        Available Time Slots (30 minutes each)
                    </h2>

                    @if(count($slots) === 0)
                        <p class="text-center text-red-600 text-lg py-8">
                            No available slots for this day.
                        </p>
                    @else
                        <form method="POST" action="{{ route('appointments.store') }}" class="space-y-8">
                            @csrf
                            
                            <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                            <input type="hidden" name="appointment_date" value="{{ $date->format('Y-m-d') }}">

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($slots as $slot)
                                    <div class="text-center">
                                        @if($slot['is_booked'])
                                            <button type="button" 
                                                    class="w-full py-4 bg-red-100 text-red-800 rounded-lg cursor-not-allowed opacity-70"
                                                    disabled>
                                                <span class="font-medium">{{ $slot['display_time'] }}</span>
                                                <p class="text-sm mt-1">Booked</p>
                                            </button>
                                        @else
                                            <button type="submit" 
                                                    name="start_time" 
                                                    value="{{ $slot['start_time'] }}"
                                                    class="w-full py-4 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition">
                                                <span class="font-medium text-lg">{{ $slot['display_time'] }}</span>
                                                <p class="text-sm mt-1">Available</p>
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <!-- Symptoms (Optional) -->
                            <div class="mt-10">
                                <label for="symptoms" class="block text-lg font-medium text-gray-700 mb-3">
                                    Symptoms (Optional)
                                </label>
                                <textarea name="symptoms" id="symptoms" rows="3" 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                          placeholder="Briefly describe your symptoms..."></textarea>
                            </div>

                            <!-- Back Button -->
                            <div class="mt-8 text-center">
                                <a href="{{ route('doctors.show', $doctor) }}" 
                                   class="text-blue-600 hover:underline font-medium">
                                    ← Back to Doctor Profile
                                </a>
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>