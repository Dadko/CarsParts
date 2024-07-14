@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Car</h1>
    <form action="{{ route('cars.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group mb-3">
            <label for="is_registered">Is Registered</label>
            <select class="form-control" id="is_registered" name="is_registered" required>
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
        <div class="form-group" id="registration_number_group" style="display: none;">
            <label for="registration_number">Registration Number</label>
            <input type="text" class="form-control" id="registration_number" name="registration_number">
        </div>
        <button type="submit" class="btn btn-primary">Add Car</button>
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