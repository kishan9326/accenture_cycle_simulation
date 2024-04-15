@extends('layouts.master')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row mb-1">
                <div class="col-auto d-none d-sm-block">
                    <h3><strong>Users List</strong></h3>
                </div>
                <div class="col-auto ms-auto text-end mt-n1">
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-other">Add a user</a>
                    <!-- <a href="{{ route('dashboard.index') }}" class="btn btn-primary btn-other">Dashboard</a> -->
                </div>
            </div>
            <div class="card">
                <div class="card-body pb-0">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->count() > 0)
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ $users->firstItem() + $key }}</td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->status }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <form method="post" action="{{ route('user.destroy', $user->id) }}"
                                                class="form-inline">
                                                @csrf
                                                @method('delete')
                                                <div class="d-flex justify-content-end">
                                                    <div class="btn-group" role="group"
                                                        aria-label="Basic mixed styles example">
                                                        <a href="{{ route('user.show', $user->id) }}" role="button"
                                                            class="btn btn-success">View</a>
                                                        <a href="{{ route('user.edit', $user->id) }}" role="button"
                                                            class="btn btn-primary btn-other">Edit</a>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">No User(s) Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @if ($users->count() > 0)
                        <div class="d-flex justify-content-end">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
