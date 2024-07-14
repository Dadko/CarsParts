@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col d-flex align-items-center">
            <h1 class="me-auto">Parts</h1>
            <a href="{{ route('parts.create') }}" class="btn btn-primary ms-3">Add New</a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <a href="{{ route('cars.index') }}" class="btn btn-secondary">Back to Cars</a>
        </div>
    </div>

    <form method="GET" action="{{ route('parts.index') }}" class="row g-3 align-items-end mb-2">
        <div class="col-md-10">
            <label for="search">Search:</label>
            <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    @if ($parts->isEmpty())
        <div class="alert alert-info">No parts found.</div>
    @else
        <div class="table-responsive">
            <table class="table table-hover w-100">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Serial Number</th>
                        <th>Car</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parts as $part)
                        <tr>
                            <td>{{ $part->name }}</td>
                            <td>{{ $part->serialnumber }}</td>
                            <td>{{ $part->car->name }}</td>
                            <td>
                                <a href="{{ route('parts.show', $part->id) }}" class="btn btn-info">View</a>
                                <a href="{{ route('parts.edit', $part->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('parts.destroy', $part->id) }}" method="POST" class="d-inline">
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