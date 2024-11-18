<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hotel Booking')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <a href="/" class="flex items-center text-xl font-bold text-blue-600">
                        Hotel Booking
                    </a>
                    <div class="ml-10 flex items-center space-x-4">
                        <a href="/" class="text-gray-700 hover:text-gray-900">Home</a>
                        <a href="/rooms" class="text-gray-700 hover:text-gray-900">Rooms</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center">&copy; {{ date('Y') }} Hotel Booking. All rights reserved.</p>
        </div>
    </footer>
</body>
</html> 