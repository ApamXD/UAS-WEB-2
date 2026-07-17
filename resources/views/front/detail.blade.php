@extends('front.layout')

@section('title', $car->brand . ' ' . $car->model)

@section('content')
    <!-- Detail Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <a href="{{ route('front.catalog') }}" class="text-luxury-gold hover:text-white transition inline-flex items-center mb-8">
            &larr; Kembali ke Katalog
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Gallery (Alpine.js Slider) -->
            <div x-data="{ activeIndex: 0, images: {{ json_encode($car->images->pluck('image_path')->map(fn($path) => Storage::url($path))) }} }" class="space-y-4">
                @if($car->images->count() > 0)
                    <!-- Main Image -->
                    <div class="aspect-w-16 aspect-h-10 bg-luxury-gray rounded-xl overflow-hidden border border-gray-800">
                        <img :src="images[activeIndex]" class="w-full h-96 object-cover transition duration-500" alt="{{ $car->model }}">
                    </div>
                    <!-- Thumbnails -->
                    <div class="flex gap-4 overflow-x-auto pb-2">
                        <template x-for="(image, index) in images" :key="index">
                            <button @click="activeIndex = index" 
                                    :class="{'border-luxury-gold ring-2 ring-luxury-gold': activeIndex === index, 'border-gray-800 opacity-60 hover:opacity-100': activeIndex !== index}"
                                    class="flex-shrink-0 border rounded overflow-hidden transition">
                                <img :src="image" class="w-24 h-16 object-cover">
                            </button>
                        </template>
                    </div>
                @else
                    <div class="w-full h-96 bg-luxury-gray rounded-xl border border-gray-800 flex items-center justify-center text-gray-500">
                        Belum ada foto tersedia
                    </div>
                @endif
            </div>

            <!-- Specs -->
            <div class="flex flex-col justify-center">
                <div class="mb-2">
                    <span class="text-luxury-gold font-bold tracking-widest uppercase text-sm">{{ $car->brand }}</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">{{ $car->model }}</h1>
                <p class="text-3xl font-light text-gray-300 mb-8">Rp {{ number_format($car->price, 0, ',', '.') }}</p>
                
                <div class="bg-luxury-gray rounded-xl p-6 border border-gray-800 mb-8">
                    <h3 class="text-lg font-semibold text-white mb-4 border-b border-gray-700 pb-2">Spesifikasi Utama</h3>
                    <ul class="space-y-4">
                        <li class="flex justify-between">
                            <span class="text-gray-400">Tahun Produksi</span>
                            <span class="text-white font-medium">{{ $car->year }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-400">Status Ketersediaan</span>
                            <span class="{{ $car->status == 'available' ? 'text-green-400' : 'text-red-400' }} font-medium uppercase text-sm tracking-wider">
                                {{ $car->status }}
                            </span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-semibold text-white mb-3">Tentang Kendaraan Ini</h3>
                    <div class="prose prose-invert max-w-none text-gray-400">
                        {!! nl2br(e($car->description ?: 'Belum ada deskripsi mendetail untuk kendaraan ini.')) !!}
                    </div>
                </div>

                <div class="mt-10">
                    <button class="w-full bg-luxury-gold text-luxury-dark font-bold text-lg py-4 rounded hover:bg-yellow-400 transition shadow-[0_0_15px_rgba(212,175,55,0.3)]">
                        Hubungi Showroom
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
