@extends('layouts.master')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row mb-1">
                <div class="col-auto d-none d-sm-block">
                    <h3><strong>Users detail</strong></h3>
                </div>
                <div class="col-auto ms-auto text-end mt-n1">
                    <a href="{{ route('user.index') }}" class="btn btn-primary btn-other">Users List</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @if($user && $user->count() > 0)
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><strong>Full Name: </strong> <span class="text-muted">{{ $user->full_name }}</span></li>
                        <li class="mb-1"><strong>Status: </strong> <span class="text-muted">{{ $user->status }}</span></li>
                        <li class="mb-1"><strong>Role: </strong> <span class="text-muted">{{ $user->role }}</span></li>
                        <li class="mb-1"><strong>Created at: </strong> <span class="text-muted">{{ $user->created_at }}</span></li>
                        <li class="mb-1">
                            <form method="post" action="{{ route('user.destroy', $user->id) }}" class="form-inline">
                                @csrf
                                @method('delete')
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-other btn-md">Edit</a>
                                <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->role === 'admin' ? "You can't delete yourself": '' }}">
                                    <button {{ $user->role === 'admin' ? 'disabled': '' }} type="submit" class="btn btn-danger btn-md">
                                        Delete
                                    </button>
                                </span>
                            </form>
                        </li>
                    </ul>
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