<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Part;

class PartController extends Controller
{
    public function index(Request $request)
    {
        $query = Part::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $parts = $query->get();
        return view('parts.index', compact('parts'));
    }

    public function create()
    {
        $cars = Car::all();
        return view('parts.create', compact('cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'serialnumber' => 'required',
            'car_id' => 'required|exists:cars,id',
        ]);

        Part::create($request->all());
        return redirect()->route('parts.index');
    }

    public function show(Part $part)
    {
        return view('parts.show', compact('part'));
    }

    public function edit(Part $part)
    {
        $cars = Car::all();
        return view('parts.edit', compact('part', 'cars'));
    }

    public function update(Request $request, Part $part)
    {
        $request->validate([
            'name' => 'required',
            'serialnumber' => 'required',
            'car_id' => 'required|exists:cars,id',
        ]);

        $part->update($request->all());
        return redirect()->route('parts.index');
    }

    public function destroy(Part $part)
    {
        $part->delete();
        return redirect()->route('parts.index');
    }
}
