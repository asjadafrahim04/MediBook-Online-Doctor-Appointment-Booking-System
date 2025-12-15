<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediBook - Online Doctor Appointment Booking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 antialiased">
    <div class="min-h-screen flex flex-col justify-center items-center px-6 py-12">
        <!-- Logo / Title -->
        <div class="text-center mb-10">
            <h1 class="text-5xl font-bold text-blue-700 mb-4">MediBook</h1>
            <p class="text-xl text-gray-600">Book Doctor Appointments Easily & Quickly</p>
        </div>

        <!-- Features -->
        <div class="max-w-2xl text-center mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Why Choose MediBook?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-4xl mb-3">⏰</div>
                    <h3 class="font-semibold text-lg">Instant Booking</h3>
                    <p class="text-gray-600 text-sm mt-2">Book in seconds – no phone calls needed</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-4xl mb-3">📅</div>
                    <h3 class="font-semibold text-lg">View Free Slots</h3>
                    <p class="text-gray-600 text-sm mt-2">See doctor availability in real-time</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-4xl mb-3">✅</div>
                    <h3 class="font-semibold text-lg">No Waiting</h3>
                    <p class="text-gray-600 text-sm mt-2">Avoid long queues and confusion</p>
                </div>
            </div>
        </div>

        <!-- Login / Register Buttons -->
        <div class="flex flex-col sm:flex-row gap-6">
            <a href="{{ route('login') }}"
               class="px-8 py-4 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition text-center text-lg">
                Login
            </a>
            <a href="{{ route('register') }}"
               class="px-8 py-4 bg-green-600 text-white font-semibold rounded-lg shadow hover:bg-green-700 transition text-center text-lg">
                Register Now
            </a>
        </div>

        <!-- Footer -->
        <div class="mt-16 text-center text-gray-500 text-sm">
            <p>&copy; 2025 MediBook - Made for easy healthcare</p>
        </div>
    </div>
</body>
</html>