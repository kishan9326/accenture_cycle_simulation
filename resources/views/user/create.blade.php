@extends('layouts.master')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="row mb-1">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>Create User</strong></h3>
            </div>
            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{ route('user.index') }}" class="btn btn-primary btn-other">Users</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('user.store') }}">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name') ? old('name'): '' }}" class="form-control" id="name" placeholder="Enter name">
                            @error('name')
                                <div class="small text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" value="{{ old('email') ? old('email'): '' }}" class="form-control" id="email" placeholder="Enter email">
                            @error('email')
                                <div class="small text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" value="{{ old('password') ? old('password'): '' }}" class="form-control" id="password" placeholder="Enter password">
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
                                    <option value="{{ $role }}" {{ (old('role') && old('role') === $role) ? 'selected': '' }}>{{ Str::title($role) }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="small text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="role">User status</label>
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" {{ (old('status') && old('status') === 'active') ? 'checked': '' }} value="active">
                                    <span class="form-check-label">Active</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" {{ (old('status') && old('status') === 'inactive') ? 'checked': '' }} value="inactive">
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
            </div>
        </div>
    </div>
</main>
@endsection