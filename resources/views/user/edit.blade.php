@extends('layouts.master')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="row mb-1">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>Edit Users</strong></h3>
            </div>
            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{ route('user.index') }}" class="btn btn-primary btn-other">Users List</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @if($user && $user->count() > 0)
                <form method="post" action="{{ route('user.update', $user->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name') ? old('name') : $user->full_name }}" class="form-control" id="name" placeholder="Enter name">
                            @error('name')
                                <div class="small text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" value="{{ old('email') ? old('email') : $user->email }}" class="form-control" id="email" autocomplete="off" placeholder="Enter email">
                            @error('email')
                                <div class="small text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" value="" class="form-control" id="password" autocomplete="off" placeholder="Enter password">
                            @error('password')
                                <div class="small text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="role">User role</label>
                            <select class="form-select" name="role" id="role" aria-label="Default select example">
                                <option selected>Select user role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role }}" {{ ((old('role') && old('role') === $role) || ($user->role === $role)) ? 'selected': '' }}>{{ Str::title($role) }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="small text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" {{ ((old('status') && old('status') === 'active') || $user->status === 'active') ? 'checked': '' }} value="active">
                                    <span class="form-check-label">Active</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" {{ ((old('status') && old('status') === 'inactive') || $user->status === 'inactive') ? 'checked': '' }} value="inactive">
                                    <span class="form-check-label">Inactive</span>
                                </label>
                            </div>
                            @error('status')
                                <div class="small text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-other">Save</button>
                </form>
                @else
                <div class="text-center">
                    <h1 class="display-1 font-weight-bold">404</h1>
                    <p class="h1">Page not found.</p>
                    <p class="h2 font-weight-normal mt-3 mb-4">The page you are looking for might have been removed.</p>
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-other btn-lg">Add new user</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection