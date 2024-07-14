@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Part Details</h1>
    <div class="card">
        <div class="card-header">
            Part Information
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $part->name }}</p>
            <p><strong>Serial Number:</strong> {{ $part->serialnumber }}</p>
            <p><strong>Car:</strong> {{ $part->car->name }}</p>
        </div>
    </div>
    <a href="{{ route('parts.index') }}" class="btn btn-primary mt-3">Back to Parts List</a>
</div>
@endsection