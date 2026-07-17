<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('primaryImage')->latest()->paginate(10);
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:available,sold',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120', // Max 5MB
        ]);

        $car = Car::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('cars', 'public');
                $car->images()->create([
                    'image_path' => $path,
                    'is_primary' => $index === 0, // First image is primary
                ]);
            }
        }

        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil ditambahkan.');
    }

    public function show(Car $car)
    {
        return view('admin.cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        $car->load('images');
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:available,sold',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $car->update($validated);

        if ($request->hasFile('images')) {
            $hasPrimary = $car->images()->where('is_primary', true)->exists();
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('cars', 'public');
                $car->images()->create([
                    'image_path' => $path,
                    'is_primary' => !$hasPrimary && $index === 0,
                ]);
            }
        }

        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil diperbarui.');
    }

    public function destroy(Car $car)
    {
        foreach ($car->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        $car->delete();

        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil dihapus.');
    }

    public function toggleFeatured(Car $car)
    {
        $car->update(['is_featured' => !$car->is_featured]);

        $status = $car->is_featured ? 'ditandai sebagai Unggulan' : 'dihapus dari Unggulan';
        return back()->with('success', "{$car->brand} {$car->model} berhasil {$status}.");
    }
}
