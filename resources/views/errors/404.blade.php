<x-app-layout>
    <div class="min-h-screen bg-gray-100 flex flex-col justify-center items-center text-center px-6">
        <div class="max-w-md">
            <h1 class="text-9xl font-bold text-blue-600 mb-4">404</h1>
            <h2 class="text-3xl font-semibold text-gray-800 mb-4">Page Not Found</h2>
            <p class="text-lg text-gray-600 mb-8">
                Sorry, the page you are looking for could not be found.
            </p>

            <div class="space-x-4">
                <a href="{{ route('dashboard') }}" class="inline-block px-8 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                    Go to Dashboard
                </a>
                <a href="{{ route('home') }}" class="inline-block px-8 py-3 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition">
                    Back to Home
                </a>
            </div>
        </div>

        <div class="mt-12 text-gray-500">
            <p>&copy; {{ date('Y') }} MediBook. All rights reserved.</p>
        </div>
    </div>
</x-app-layout>