@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Car</h1>
    <form action="{{ route('cars.update', $car->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $car->name }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="is_registered">Is Registered</label>
            <select class="form-control" id="is_registered" name="is_registered" required>
                <option value="0" {{ !$car->is_registered ? 'selected' : '' }}>No</option>
                <option value="1" {{ $car->is_registered ? 'selected' : '' }}>Yes</option>
            </select>
        </div>
        <div class="form-group mb-3" id="registration_number_group" class="{{ $car->is_registered ? '' : 'd-none' }}">
            <label for="registration_number">Registration Number</label>
            <input type="text" class="form-control" id="registration_number" name="registration_number" value="{{ $car->registration_number }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Car</button>
    </form>
</div>

<script>
    document.getElementById('is_registered').addEventListener('change', function () {
        var registrationGroup = document.getElementById('registration_number_group');
        if (this.value == '1') {
            registrationGroup.style.display = 'block';
        } else {
            registrationGroup.style.display = 'none';
        }
    });
</script>
@endsection