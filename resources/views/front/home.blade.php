@extends('front.layout')

@section('title', 'Koleksi Eksklusif')

@section('content')
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-black py-32 sm:py-48 flex items-center justify-center"
         x-data="{ 
             currentIndex: 0,
             init() {
                 setInterval(() => {
                     this.currentIndex = (this.currentIndex + 1) % 2;
                 }, 8000); // Video berganti setiap 8 detik
             }
         }">
         
        <!-- Video 1 -->
        <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
             :class="currentIndex === 0 ? 'opacity-30' : 'opacity-0'">
            <video src="{{ asset('videos/video1.mp4') }}" class="w-full h-full object-cover" autoplay muted loop playsinline></video>
        </div>
        
        <!-- Video 2 -->
        <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
             :class="currentIndex === 1 ? 'opacity-30' : 'opacity-0'">
            <video src="{{ asset('videos/video2.mp4') }}" class="w-full h-full object-cover" autoplay muted loop playsinline></video>
        </div>

        <!-- Dark Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-luxury-dark via-luxury-dark/80 to-luxury-dark opacity-90"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="zoom-in" data-aos-duration="1200">
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 tracking-tight">
                Rasakan <span class="text-luxury-gold">Kemewahan</span>
            </h1>
            <p class="text-lg md:text-2xl text-gray-400 mb-10 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="300">
                Koleksi mobil sport dan supercar paling eksklusif di dunia, kini hadir dalam genggaman Anda.
            </p>
            <a href="{{ route('front.catalog') }}" data-aos="fade-up" data-aos-delay="600" class="inline-block bg-luxury-gold text-luxury-dark font-bold text-lg px-8 py-4 rounded hover:bg-yellow-400 transition shadow-[0_0_20px_rgba(212,175,55,0.4)]">
                Jelajahi Koleksi
            </a>
        </div>
    </div>

    <!-- Featured Cars -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl font-bold text-white uppercase tracking-wider mb-4">Koleksi Unggulan</h2>
            <div class="w-24 h-1 bg-luxury-gold mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @forelse($featuredCars as $car)
                <a href="{{ route('front.detail', $car) }}" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 150 }}" class="group block bg-luxury-gray rounded-xl overflow-hidden shadow-2xl border border-gray-800 hover:border-luxury-gold transition duration-300">
                    <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                        @if($car->primaryImage)
                            <img src="{{ Storage::url($car->primaryImage->image_path) }}" alt="{{ $car->model }}" class="w-full h-64 object-cover transform group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-64 bg-gray-800 flex items-center justify-center text-gray-500">No Image</div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-luxury-gold text-sm font-semibold uppercase tracking-wider">{{ $car->brand }}</p>
                                <h3 class="text-xl font-bold text-white">{{ $car->model }}</h3>
                            </div>
                            <span class="text-gray-400 text-sm">{{ $car->year }}</span>
                        </div>
                        <p class="text-2xl font-bold text-white mb-4">Rp {{ number_format($car->price, 0, ',', '.') }}</p>
                        <div class="flex items-center text-sm text-gray-400 gap-4">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-luxury-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                {{ ucfirst($car->status) }}
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-3 text-center text-gray-500">
                    Belum ada mobil yang ditambahkan.
                </div>
            @endforelse
        </div>
        
        <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('front.catalog') }}" class="inline-block text-luxury-gold hover:text-white border-b border-luxury-gold hover:border-white transition pb-1">
                Lihat Semua Kendaraan &rarr;
            </a>
        </div>
    </div>
@endsection
