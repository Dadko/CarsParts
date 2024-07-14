@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">
                    <form id="addUserForm">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add User') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-user" data-id="{{ $user->id }}">Edit</button>
                                    <button class="btn btn-sm btn-danger delete-user" data-id="{{ $user->id }}">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#addUserForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('users.store') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    alert('User added successfully');
                    location.reload(); // Reload the page to see the new user
                },
                error: function(response) {
                    alert('Failed to add user');
                }
            });
        });

        $('.delete-user').on('click', function() {
            const userId = $(this).data('id');
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: '/users/' + userId,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('User deleted successfully');
                        location.reload(); // Reload the page to see the changes
                    },
                    error: function(response) {
                        alert('Failed to delete user');
                    }
                });
            }
        });

        // Additional code for editing users can be added here
    });
</script>
@endsection