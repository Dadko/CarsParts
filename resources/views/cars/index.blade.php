@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col d-flex align-items-center">
            <h1 class="me-auto">Cars</h1>
            <a href="{{ route('cars.create') }}" class="btn btn-primary ms-3">Add New</a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <a href="{{ route('parts.index') }}" class="btn btn-secondary">Parts</a>
        </div>
    </div>

    <form method="GET" action="{{ route('cars.index') }}" class="row g-3 align-items-end mb-2">
        <div class="col-md-6">
            <label for="search">Search:</label>
            <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <label for="is_registered">Registration:</label>
            <select name="is_registered" id="is_registered" class="form-control">
                <option value="all" {{ request('is_registered') === 'all' ? 'selected' : '' }}>All</option>
                <option value="1" {{ request('is_registered') == '1' ? 'selected' : '' }}>Registered</option>
                <option value="0" {{ request('is_registered') == '0' ? 'selected' : '' }}>Not Registered</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    @if ($cars->isEmpty())
        <div class="alert alert-info">No cars found.</div>
    @else
        <div class="table-responsive">
            <table class="table table-hover w-100">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Registration Number</th>
                        <th>Is Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cars as $car)
                        <tr>
                            <td>{{ $car->name }}</td>
                            <td>{{ $car->registration_number ? $car->registration_number : '-' }}</td>
                            <td>{{ $car->is_registered ? 'Yes' : 'No' }}</td>
                            <td>
                                <a href="{{ route('cars.show', $car->id) }}" class="btn btn-info">View</a>
                                <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection