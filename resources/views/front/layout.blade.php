<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Veloce Exotics - @yield('title', 'Platform Showroom Mobil Sport')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-luxury-dark text-gray-200 font-sans antialiased min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-luxury-gray border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('front.home') }}" class="text-2xl font-bold text-luxury-gold tracking-widest uppercase">
                        Veloce Exotics
                    </a>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ml-6 gap-8">
                    <a href="{{ route('front.home') }}" 
                       class="relative font-medium transition-all duration-300 group
                              {{ request()->routeIs('front.home') ? 'text-luxury-gold' : 'text-gray-300 hover:text-luxury-gold' }}">
                        Beranda
                        <span class="absolute -bottom-1 left-0 h-0.5 bg-luxury-gold transition-all duration-300
                                     {{ request()->routeIs('front.home') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>
                    <a href="{{ route('front.catalog') }}" 
                       class="relative font-medium transition-all duration-300 group
                              {{ request()->routeIs('front.catalog') ? 'text-luxury-gold' : 'text-gray-300 hover:text-luxury-gold' }}">
                        Katalog
                        <span class="absolute -bottom-1 left-0 h-0.5 bg-luxury-gold transition-all duration-300
                                     {{ request()->routeIs('front.catalog') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>
                    @auth
                        <a href="{{ route('admin.cars.index') }}" class="text-sm bg-luxury-gold text-luxury-dark px-4 py-2 rounded font-bold hover:bg-yellow-400 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition text-sm">Login Admin</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-luxury-gray border-t border-gray-800 py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-xl font-bold text-luxury-gold mb-4 uppercase tracking-widest">Veloce Exotics</h3>
            <p class="text-gray-500 mb-6 max-w-md mx-auto">Platform digital showroom mobil sport dan supercar eksklusif untuk kalangan kolektor elit.</p>
            <p class="text-gray-600 text-sm">&copy; {{ date('Y') }} Veloce Exotics. Hak cipta dilindungi.</p>
        </div>
    </footer>

    <!-- AOS Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: false,
            offset: 100,
        });
    </script>
</body>
</html>
