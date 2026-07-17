<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home()
    {
        $featuredCars = Car::with('primaryImage')->where('is_featured', true)->latest()->take(3)->get();
        return view('front.home', compact('featuredCars'));
    }

    public function catalog(Request $request)
    {
        $query = Car::with('primaryImage');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('brand', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%");
            });
        }

        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        $cars = $query->paginate(9);
        
        $brands = Car::select('brand')->distinct()->pluck('brand');
        
        return view('front.catalog', compact('cars', 'brands'));
    }

    public function detail(Car $car)
    {
        $car->load('images');
        return view('front.detail', compact('car'));
    }
}
