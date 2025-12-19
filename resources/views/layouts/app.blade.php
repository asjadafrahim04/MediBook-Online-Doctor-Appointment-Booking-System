<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Chart.js CDN - Loaded only for admin users -->
        @if(auth()->check() && auth()->user()->role === 'admin')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @endif
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Chart.js Initialization Script - Only for admin users -->
        @if(auth()->check() && auth()->user()->role === 'admin')
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const appointmentsChartEl = document.getElementById('appointmentsChart');
                    if (appointmentsChartEl) {
                        new Chart(appointmentsChartEl, {
                            type: 'line',
                            data: {
                                labels: @json($appointmentsLabels ?? []),
                                datasets: [{
                                    label: 'Appointments',
                                    data: @json($appointmentsCounts ?? []),
                                    borderColor: '#14b8a6',
                                    backgroundColor: 'rgba(20, 184, 166, 0.2)',
                                    tension: 0.4,
                                    fill: true
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: { display: false }
                                },
                                scales: {
                                    y: { beginAtZero: true }
                                }
                            }
                        });
                    }

                    const registrationsChartEl = document.getElementById('registrationsChart');
                    if (registrationsChartEl) {
                        new Chart(registrationsChartEl, {
                            type: 'bar',
                            data: {
                                labels: @json($registrationsLabels ?? []),
                                datasets: [{
                                    label: 'New Doctors',
                                    data: @json($registrationsCounts ?? []),
                                    backgroundColor: '#6366f1'
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: { display: false }
                                },
                                scales: {
                                    y: { beginAtZero: true }
                                }
                            }
                        });
                    }
                });
            </script>
        @endif
    </body>
</html>