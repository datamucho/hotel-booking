<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Harbour - Premium Hotel Booking')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/airbnb.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script defer src="{{ asset('js/datepicker.js') }}"></script>
    <style>
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #2563eb;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .flatpickr-calendar {
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            border: 1px solid #f3f4f6;
            border-radius: 0.5rem;
        }

        .flatpickr-day.selected {
            background: #2563eb;
            border-color: #2563eb;
        }

        .flatpickr-day.selected:hover {
            background: #1d4ed8;
            border-color: #1d4ed8;
        }

        .flatpickr-day:hover {
            background: #eff6ff;
        }

        .flatpickr-day.today {
            border-color: #bfdbfe;
        }

        /* Custom styles for the date picker */
        .flatpickr-calendar {
            @apply shadow-lg border border-gray-100 rounded-lg;
            background: white;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }

        .flatpickr-day {
            @apply rounded-md border-0;
        }

        .flatpickr-day.selected {
            background: #2563eb !important;
            border-color: #2563eb !important;
        }

        .flatpickr-day.selected:hover {
            background: #1d4ed8 !important;
            border-color: #1d4ed8 !important;
        }

        .flatpickr-day:hover {
            background: #eff6ff !important;
        }

        .flatpickr-day.today {
            border: 1px solid #bfdbfe !important;
            background: #eff6ff !important;
        }

        .flatpickr-months {
            @apply p-2;
        }

        .flatpickr-current-month {
            @apply font-semibold;
        }

        .flatpickr-weekday {
            @apply font-medium text-gray-600;
        }

        .flatpickr-monthSelect-month {
            @apply p-2 rounded-md hover:bg-blue-50;
        }

        .flatpickr-monthSelect-month.selected {
            @apply bg-blue-500 text-white;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Header with mobile responsive menu -->
    <header x-data="{ 
        isScrolled: false,
        isMobileMenuOpen: false 
    }" 
    @scroll.window="isScrolled = window.pageYOffset > 20"
    :class="{ 'bg-white/80 backdrop-blur-md shadow-md': isScrolled || isMobileMenuOpen, 'bg-transparent': !isScrolled && !isMobileMenuOpen }"
    class="fixed w-full top-0 z-50 transition-all duration-300">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-2">
                        <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <!-- Your logo SVG -->
                        </svg>
                        <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                            Harbour
                        </span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex md:items-center md:space-x-8">
                    <a href="/" class="nav-link text-gray-700 hover:text-gray-900 font-medium transition-colors">Home</a>
                    <a href="/rooms" class="nav-link text-gray-700 hover:text-gray-900 font-medium transition-colors">Rooms</a>
                    <a href="{{ route('bookings.index') }}" class="nav-link text-gray-700 hover:text-gray-900 font-medium transition-colors">My Bookings</a>
                    
                    @auth
                        <span class="text-gray-700">Welcome, {{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 rounded-full text-gray-700 hover:bg-gray-100 transition-colors">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-full text-gray-700 hover:bg-gray-100 transition-colors">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors">
                            Sign Up
                        </a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="text-gray-700 hover:text-gray-900">
                        <svg x-show="!isMobileMenuOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="isMobileMenuOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div x-show="isMobileMenuOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-1"
                 class="md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Home</a>
                    <a href="/rooms" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Rooms</a>
                    <a href="{{ route('bookings.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">My Bookings</a>
                    
                    @auth
                        <span class="block px-3 py-2 text-base font-medium text-gray-700">Welcome, {{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Login</a>
                        <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-blue-600 hover:bg-blue-700">Sign Up</a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content with padding for fixed header -->
    <main class="pt-20">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-green-50 border border-green-200 text-green-800 rounded-md p-4">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-red-50 border border-red-200 text-red-800 rounded-md p-4">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        @yield('content')
    </main>

    <!-- Modern Footer -->
    <footer class="bg-gray-900 text-white mt-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Harbour</h3>
                    <p class="text-gray-400">Experience luxury and comfort in our carefully curated accommodations.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Rooms</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Cancellation Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Safety Information</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Newsletter</h4>
                    <form class="flex">
                        <input type="email" placeholder="Enter your email" 
                               class="px-4 py-2 rounded-l-full bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-600">
                        <button class="px-4 py-2 rounded-r-full bg-blue-600 hover:bg-blue-700 transition-colors">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-800 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Harbour. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html> 