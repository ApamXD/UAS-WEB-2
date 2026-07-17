@extends('front.layout')

@section('title', 'Katalog Mobil')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-white mb-2 uppercase tracking-wider">Katalog Kendaraan</h1>
            <p class="text-gray-400">Temukan mobil sport impian Anda.</p>
        </div>

        <!-- Filters & Search -->
        <div class="bg-luxury-gray p-6 rounded-xl border border-gray-800 mb-10">
            <form action="{{ route('front.catalog') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Pencarian</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari merk / model..." class="w-full bg-luxury-dark border-gray-700 text-white rounded focus:ring-luxury-gold focus:border-luxury-gold">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Merk</label>
                    <select name="brand" class="w-full bg-luxury-dark border-gray-700 text-white rounded focus:ring-luxury-gold focus:border-luxury-gold">
                        <option value="">Semua Merk</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Tahun</label>
                    <input type="number" name="year" value="{{ request('year') }}" placeholder="Contoh: 2023" class="w-full bg-luxury-dark border-gray-700 text-white rounded focus:ring-luxury-gold focus:border-luxury-gold">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-luxury-gold text-luxury-dark font-bold py-2 px-4 rounded hover:bg-yellow-400 transition">
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($cars as $car)
                <a href="{{ route('front.detail', $car) }}" class="group block bg-luxury-gray rounded-xl overflow-hidden shadow-lg border border-gray-800 hover:border-luxury-gold transition duration-300">
                    <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                        @if($car->primaryImage)
                            <img src="{{ Storage::url($car->primaryImage->image_path) }}" alt="{{ $car->model }}" class="w-full h-56 object-cover transform group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-56 bg-gray-800 flex items-center justify-center text-gray-500">No Image</div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <p class="text-luxury-gold text-sm font-semibold uppercase tracking-wider">{{ $car->brand }}</p>
                            <span class="text-gray-400 text-xs">{{ $car->year }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">{{ $car->model }}</h3>
                        <p class="text-lg font-bold text-white mb-4">Rp {{ number_format($car->price, 0, ',', '.') }}</p>
                    </div>
                </a>
            @empty
                <div class="col-span-3 text-center py-20 text-gray-500 bg-luxury-gray rounded-xl border border-gray-800">
                    Tidak ditemukan mobil yang sesuai dengan kriteria Anda.
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $cars->links() }}
        </div>
    </div>
@endsection
