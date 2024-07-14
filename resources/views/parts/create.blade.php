@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Part</h1>
    <form action="{{ route('parts.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group mb-3">
            <label for="serialnumber">Serial Number</label>
            <input type="text" class="form-control" id="serialnumber" name="serialnumber" required>
        </div>
        <div class="form-group mb-3">
            <label for="car_id">Car</label>
            <select class="form-control" id="car_id" name="car_id" required>
                @foreach ($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Part</button>
    </form>
</div>
@endsection
