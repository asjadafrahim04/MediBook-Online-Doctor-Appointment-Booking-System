<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8 lg:p-12">

                    <div class="text-center mb-10">
                        <h1 class="text-4xl font-bold text-blue-700">
                            My Weekly Schedule
                        </h1>
                        <p class="text-lg text-gray-600 mt-3">
                            Set your available hours for each day. Patients will see these times.
                        </p>
                    </div>

                    @if(session('status'))
                        <div class="mb-8 p-5 bg-green-100 border border-green-400 text-green-800 rounded-lg text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('doctor.schedule.update') }}" class="space-y-8">
                        @csrf
                        @method('PATCH')

                        @foreach($days as $day)
                            @php
                                $avail = $availability[$day] ?? null;
                            @endphp

                            <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                                <h3 class="text-2xl font-semibold text-gray-800 mb-5">{{ $day }}</h3>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Start Time
                                        </label>
                                        <input type="time"
                                               name="availability[{{ $loop->index }}][start_time]"
                                               value="{{ $avail?->start_time ? \Carbon\Carbon::parse($avail->start_time)->format('H:i') : '' }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            End Time
                                        </label>
                                        <input type="time"
                                               name="availability[{{ $loop->index }}][end_time]"
                                               value="{{ $avail?->end_time ? \Carbon\Carbon::parse($avail->end_time)->format('H:i') : '' }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <div class="text-center md:text-left">
                                        <p class="text-sm text-gray-600">
                                            <strong>30-minute</strong> appointment slots
                                        </p>
                                        @if($avail)
                                            <span class="inline-block mt-2 px-4 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                                                Currently Set
                                            </span>
                                        @else
                                            <span class="inline-block mt-2 px-4 py-1 bg-red-100 text-red-800 text-xs rounded-full">
                                                Not Available
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <input type="hidden" name="availability[{{ $loop->index }}][day]" value="{{ $day }}">
                            </div>
                        @endforeach

                        <div class="text-center mt-12">
                            <button type="submit"
                                    class="px-12 py-4 bg-green-600 text-white font-bold text-lg rounded-lg shadow hover:bg-green-700 transition duration-200">
                                Save Schedule
                            </button>
                        </div>
                    </form>

                    <div class="mt-10 text-center">
                        <a href="{{ route('dashboard') }}"
                           class="text-blue-600 hover:text-blue-800 font-medium text-lg">
                            ← Back to Dashboard
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>