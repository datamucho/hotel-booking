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
            padding-bottom: 2px;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 50%;
            background-color: #2563eb;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .nav-link.active {
            color: #2563eb;
        }
        .nav-link.active::after {
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

        /* Improved mobile menu animation */
        .mobile-menu-enter {
            opacity: 0;
            transform: translateY(-10px);
        }

        .mobile-menu-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.2s ease, transform 0.2s ease;
        }

        .mobile-menu-exit {
            opacity: 1;
            transform: translateY(0);
        }

        .mobile-menu-exit-active {
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.15s ease, transform 0.15s ease;
        }

        /* Improved header backdrop */
        .header-backdrop {
            backdrop-filter: blur(8px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-dropdown-enter {
            opacity: 0;
            transform: scale(0.95);
        }

        .nav-dropdown-enter-active {
            opacity: 1;
            transform: scale(1);
            transition: opacity 0.1s ease-out, transform 0.1s ease-out;
        }

        .nav-dropdown-exit {
            opacity: 1;
            transform: scale(1);
        }

        .nav-dropdown-exit-active {
            opacity: 0;
            transform: scale(0.95);
            transition: opacity 0.075s ease-in, transform 0.075s ease-in;
        }

        .header-backdrop {
            @apply bg-white/90 backdrop-blur-md;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05);
        }

        .nav-link {
            @apply relative py-2 px-1;
        }

        .nav-link::after {
            content: '';
            @apply absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            @apply w-full;
        }

        .nav-link.active {
            @apply text-blue-600;
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
    :class="{ 
        'header-backdrop bg-white/90 shadow-lg': isScrolled || isMobileMenuOpen, 
        'bg-transparent': !isScrolled && !isMobileMenuOpen 
    }"
    class="fixed w-full top-0 z-50 transition-all duration-300">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-2 group">
                        <svg class="w-8 h-8 text-blue-600 transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24">
                            <!-- Your logo SVG -->
                        </svg>
                        <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                            Harbour
                        </span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex md:items-center md:space-x-8">
                    <a href="/" class="nav-link text-gray-700 hover:text-gray-900 font-medium transition-colors {{ request()->is('/') ? 'active' : '' }}">Home</a>
                    <a href="/rooms" class="nav-link text-gray-700 hover:text-gray-900 font-medium transition-colors {{ request()->is('rooms*') ? 'active' : '' }}">Rooms</a>
                    <a href="{{ route('bookings.index') }}" class="nav-link text-gray-700 hover:text-gray-900 font-medium transition-colors {{ request()->is('bookings*') ? 'active' : '' }}">My Bookings</a>
                    
                    @auth
                        <div class="flex items-center pl-6 ml-6 border-l border-gray-200">
                            <div class="relative" x-data="{ isOpen: false }">
                                <button @click="isOpen = !isOpen" 
                                        class="flex items-center space-x-3 text-gray-700 hover:text-gray-900 focus:outline-none group">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                            <span class="text-blue-600 font-medium">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                        </div>
                                        <span class="font-medium group-hover:text-blue-600 transition-colors">{{ Auth::user()->name }}</span>
                                    </div>
                                    <svg class="w-4 h-4 transition-transform duration-200" 
                                         :class="{ 'rotate-180': isOpen }"
                                         fill="none" 
                                         stroke="currentColor" 
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                
                                <!-- Dropdown menu -->
                                <div x-show="isOpen" 
                                     @click.away="isOpen = false"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 border border-gray-100">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-blue-600 transition-colors">
                                            Sign Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center space-x-4 pl-6 ml-6 border-l border-gray-200">
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 font-medium transition-colors">
                                Sign In
                            </a>
                            <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-all duration-300 hover:shadow-md hover:scale-105">
                                Sign Up
                            </a>
                        </div>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button @click="isMobileMenuOpen = !isMobileMenuOpen" 
                            class="text-gray-700 hover:text-gray-900 transition-colors p-2 rounded-lg hover:bg-gray-100">
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
                 x-transition:enter="mobile-menu-enter"
                 x-transition:enter-active="mobile-menu-enter-active"
                 x-transition:leave="mobile-menu-exit"
                 x-transition:leave-active="mobile-menu-exit-active"
                 class="md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 bg-white rounded-lg shadow-lg mt-2">
                    <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors {{ request()->is('/') ? 'text-blue-600 bg-blue-50' : '' }}">Home</a>
                    <a href="/rooms" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors {{ request()->is('rooms*') ? 'text-blue-600 bg-blue-50' : '' }}">Rooms</a>
                    <a href="{{ route('bookings.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors {{ request()->is('bookings*') ? 'text-blue-600 bg-blue-50' : '' }}">My Bookings</a>
                    
                    @auth
                        <span class="block px-3 py-2 text-base font-medium text-gray-700">Welcome, {{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors">Sign Up</a>
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