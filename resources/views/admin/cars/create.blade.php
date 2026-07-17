<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Mobil Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if ($errors->any())
                    <div class="mb-4 bg-red-500/10 border border-red-500 text-red-500 p-4 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="brand" value="Merk Mobil" />
                            <x-text-input id="brand" name="brand" type="text" class="mt-1 block w-full" :value="old('brand')" required />
                        </div>
                        <div>
                            <x-input-label for="model" value="Model Mobil" />
                            <x-text-input id="model" name="model" type="text" class="mt-1 block w-full" :value="old('model')" required />
                        </div>
                        <div>
                            <x-input-label for="year" value="Tahun" />
                            <x-text-input id="year" name="year" type="number" class="mt-1 block w-full" :value="old('year', date('Y'))" required />
                        </div>
                        <div>
                            <x-input-label for="price" value="Harga (Rp)" />
                            <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price')" required />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="description" value="Deskripsi Eksklusif" />
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <x-input-label for="status" value="Status" />
                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                        </select>
                    </div>

                    <div>
                        <x-input-label for="images" value="Galeri Foto (Pilih beberapa)" />
                        <input type="file" id="images" name="images[]" multiple accept="image/*" class="mt-1 block w-full text-gray-900 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-md cursor-pointer bg-gray-50 dark:bg-gray-900 focus:outline-none">
                        <p class="text-xs text-gray-500 mt-1">Foto pertama akan dijadikan cover utama. Max 5MB/foto.</p>
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('admin.cars.index') }}" class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md">Batal</a>
                        <x-primary-button>Simpan Mobil</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
