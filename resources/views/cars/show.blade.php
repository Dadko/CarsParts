@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Car Details</h1>
    <div class="card">
        <div class="card-header">
            Car Information
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $car->name }}</p>
            <p><strong>Registration Number:</strong> {{ $car->registration_number ? $car->registration_number : '-' }}</p>
            <p><strong>Is Registered:</strong> {{ $car->is_registered ? 'Yes' : 'No' }}</p>
        </div>
    </div>
    <h2 class="mt-4">Parts</h2>
    <div class="table-responsive">
        <table class="table table-hover w-100">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Serial Number</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($car->parts as $part)
                    <tr>
                        <td>{{ $part->name }}</td>
                        <td>{{ $part->serialnumber }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{ route('cars.index') }}" class="btn btn-primary mt-2">Back to Cars List</a>
</div>
@endsection