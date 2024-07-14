<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::query();

        if ($request->has('is_registered') && $request->input('is_registered') !== 'all') {
            $query->where('is_registered', $request->input('is_registered'));
        }

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $cars = $query->get();
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'registration_number' => 'required_if:is_registered,1',
            'is_registered' => 'required|boolean',
        ]);

        Car::create($request->all());
        return redirect()->route('cars.index');
    }

    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'name' => 'required',
            'registration_number' => 'required_if:is_registered,1',
            'is_registered' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($data['is_registered'] == 0) {
            $data['registration_number'] = null;
        }

        $car->update($data);
        return redirect()->route('cars.index');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index');
    }
}
