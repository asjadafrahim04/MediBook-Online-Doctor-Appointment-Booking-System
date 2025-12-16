<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl">
                <div class="p-10">

                    <!-- Doctor Profile Header -->
                    <div class="text-center mb-12">
                        <div class="w-32 h-32 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full mx-auto mb-6 flex items-center justify-center text-6xl text-white shadow-lg">
                            {{ strtoupper(substr($doctor->user->name, 0, 2)) }}
                        </div>
                        <h1 class="text-4xl font-bold text-gray-800">
                            Dr. {{ $doctor->user->name }}
                        </h1>
                        <p class="text-2xl text-blue-600 font-medium mt-3">
                            {{ $doctor->specialization }}
                        </p>
                        <div class="mt-4 text-gray-600">
                            <p>{{ $doctor->qualification }}</p>
                            <p class="mt-1">{{ $doctor->experience_years }} years of experience</p>
                        </div>
                        <div class="mt-6 inline-block px-6 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                            ✓ Approved & Available
                        </div>
                    </div>

                    <!-- Weekly Availability Calendar -->
                    <div class="mt-16">
                        <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">
                            Weekly Availability
                        </h2>

                        @if($availability->isEmpty())
                            <div class="text-center py-12">
                                <p class="text-xl text-gray-500">
                                    This doctor has not set their availability yet.
                                </p>
                                <p class="text-gray-400 mt-2">Please check back later.</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                    <div class="bg-gradient-to-b from-gray-50 to-gray-100 p-6 rounded-xl border border-gray-200 text-center hover:shadow-md transition">
                                        <h3 class="text-xl font-semibold text-gray-800 mb-4">{{ $day }}</h3>
                                        @if(isset($availability[$day]))
                                            @php $slot = $availability[$day]->first(); @endphp
                                            <div class="text-green-600 font-bold text-lg">
                                                {{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }}
                                                –
                                                {{ \Carbon\Carbon::parse($slot->end_time)->format('g:i A') }}
                                            </div>
                                            <p class="text-sm text-gray-600 mt-3">
                                                {{ $slot->slot_duration_minutes }}-minute appointments
                                            </p>
                                            <a href="#" class="inline-block mt-6 px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition text-sm">
                                                Book {{ $day }}
                                            </a>
                                        @else
                                            <p class="text-red-500 font-medium">Unavailable</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Back Button -->
                    <div class="mt-12 text-center">
                        <a href="{{ route('doctors.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-lg">
                            ← Back to Doctors List
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>