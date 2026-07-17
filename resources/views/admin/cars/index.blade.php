<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Inventaris Mobil') }}
            </h2>
            <a href="{{ route('admin.cars.create') }}" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md text-sm font-semibold transition">
                + Tambah Mobil
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-500/10 border border-green-500 text-green-500 p-4 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b dark:border-gray-700">
                                <th class="p-4">Foto</th>
                                <th class="p-4">Merk & Model</th>
                                <th class="p-4">Tahun</th>
                                <th class="p-4">Harga</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-center">Unggulan</th>
                                <th class="p-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cars as $car)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="p-4">
                                    @if($car->primaryImage)
                                        <img src="{{ Storage::url($car->primaryImage->image_path) }}" alt="{{ $car->model }}" class="w-20 h-14 object-cover rounded">
                                    @else
                                        <div class="w-20 h-14 bg-gray-200 dark:bg-gray-700 flex items-center justify-center rounded text-xs text-gray-500">No Img</div>
                                    @endif
                                </td>
                                <td class="p-4 font-medium">{{ $car->brand }} {{ $car->model }}</td>
                                <td class="p-4">{{ $car->year }}</td>
                                <td class="p-4">Rp {{ number_format($car->price, 0, ',', '.') }}</td>
                                <td class="p-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $car->status == 'available' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                        {{ ucfirst($car->status) }}
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <form action="{{ route('admin.cars.toggleFeatured', $car) }}" method="POST">
                                        @csrf
                                        <button type="submit" title="{{ $car->is_featured ? 'Hapus dari Unggulan' : 'Jadikan Unggulan' }}"
                                                class="text-2xl transition hover:scale-125">{{ $car->is_featured ? '⭐' : '☆' }}</button>
                                    </form>
                                </td>
                                <td class="p-4 flex gap-2">
                                    <a href="{{ route('admin.cars.edit', $car) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                    <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Hapus mobil ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-gray-500">Tidak ada data mobil.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $cars->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
