<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-center">
                    <div class="text-6xl mb-6">🔨</div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-4">
                        {{ $title ?? 'Feature' }} - Coming Soon
                    </h1>
                    <p class="text-xl text-gray-600">
                        This page is under development.<br>
                        Check back soon!
                    </p>
                    <div class="mt-8">
                        <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            ← Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>