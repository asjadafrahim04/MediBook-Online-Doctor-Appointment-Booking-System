<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8 lg:p-12">

                    <!-- Page Title -->
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold text-blue-700">
                            Find a Doctor
                        </h1>
                        <p class="text-xl text-gray-600 mt-4">
                            Search and book an appointment with available specialists
                        </p>
                    </div>

                    <!-- Search Form -->
                    <div class="max-w-2xl mx-auto mb-12">
                        <form method="GET" action="{{ route('doctors.index') }}" class="flex gap-4">
                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Search by name or specialization (e.g. Cardiologist)"
                                   class="flex-1 px-6 py-4 text-lg border border-gray-300 rounded-l-xl focus:outline-none focus:ring-4 focus:ring-blue-300 focus:border-blue-500">
                            <button type="submit"
                                    class="px-10 py-4 bg-blue-600 text-white font-bold text-lg rounded-r-xl hover:bg-blue-700 transition shadow-lg">
                                Search
                            </button>
                        </form>
                        @if(request('search'))
                            <p class="text-center mt-4 text-gray-600">
                                Showing results for: <strong>"{{ request('search') }}"</strong>
                                <a href="{{ route('doctors.index') }}" class="text-blue-600 hover:underline ml-2">[Clear]</a>
                            </p>
                        @endif
                    </div>

                    <!-- Doctors Grid -->
                    @if($doctors->count() === 0)
                        <div class="text-center py-16">
                            <div class="text-6xl mb-6 text-gray-300">🔍</div>
                            <p class="text-2xl text-gray-600">
                                No doctors found matching your search.
                            </p>
                            <p class="text-gray-500 mt-4">
                                Try different keywords or browse all available doctors.
                            </p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                            @foreach($doctors as $doctor)
                                <a href="{{ route('doctors.show', $doctor) }}"
                                   class="block bg-white border border-gray-200 rounded-2xl shadow-lg hover:shadow-2xl hover:scale-105 transition duration-300 overflow-hidden">
                                    <div class="p-8 text-center">
                                        <!-- Doctor Avatar -->
                                        <div class="w-28 h-28 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full mx-auto mb-6 flex items-center justify-center text-5xl text-white font-bold shadow-md">
                                            {{ strtoupper(substr($doctor->user->name, 0, 2)) }}
                                        </div>

                                        <!-- Doctor Info -->
                                        <h3 class="text-2xl font-bold text-gray-800">
                                            Dr. {{ $doctor->user->name }}
                                        </h3>
                                        <p class="text-xl text-blue-600 font-medium mt-3">
                                            {{ $doctor->specialization }}
                                        </p>
                                        <div class="mt-4 text-gray-600">
                                            <p>{{ $doctor->qualification }}</p>
                                            <p class="mt-2">{{ $doctor->experience_years }} years experience</p>
                                        </div>

                                        <!-- Status Badge -->
                                        <div class="mt-6 inline-block px-6 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                                            ✓ Available for Booking
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif

                    <!-- Back to Dashboard -->
                    <div class="mt-16 text-center">
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-lg">
                            ← Back to Dashboard
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>