@extends('layouts.master')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row mb-1">
                <div class="col-auto d-none d-sm-block">
                    <h3><strong>Category detail</strong></h3>
                </div>
                <div class="col-auto ms-auto text-end mt-n1">
                    <a href="{{ route('profile-management.index') }}" class="btn btn-primary btn-other">Profile Management</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @if ($player && $player->count() > 0)
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><strong>Name: </strong> <span class="text-muted">{{ $player->name }}</span>
                            </li>
                            <li class="mb-1"><strong>Gaming Mode: </strong> <span
                                    class="text-muted">{{ $player->gaming_mode }}</span></li>
                            <li class="mb-1"><strong>Environment: </strong> <span
                                    class="text-muted">{{ $player->environment }}</span></li>
                            <li class="mb-1"><strong>Players Count: </strong> <span
                                    class="text-muted">{{ $player->player_count }}</span></li>
                            <li class="mb-1"><strong>Email: </strong> <span class="text-muted">{{ $player->email }}</span>
                            </li>
                            <li class="mb-1"><strong>Organization: </strong> <span
                                    class="text-muted">{{ $player->organization }}</span>
                            </li>
                            <li class="mb-1"><strong>Age: </strong> <span class="text-muted">{{ $player->age }}</span>
                            </li>
                            <li class="mb-1"><strong>Gender: </strong> <span
                                    class="text-muted">{{ $player->gender }}</span>
                            </li>
                            <li class="mb-1"><strong>User File: </strong>
                                <img src="{{ asset('public/storage/users/' . $player->userFile) }}" class="img-thumbnail"
                                    alt="..." width="75">
                                {{-- <span
                                    class="text-muted">{{ $player->userFile }}</span> --}}
                            </li>
                            <li class="mb-1"><strong>Created a: </strong> <span
                                    class="text-muted">{{ $player->created_at }}</span>
                            </li>

                            <li class="mb-1">
                                <form method="post" action="{{ route('profile-management.destroy', $player->id) }}"
                                    class="form-inline">
                                    @csrf
                                    @method('delete')
                                    <a href="{{ route('profile-management.edit', $player->id) }}"
                                        class="btn btn-primary btn-other btn-md">Edit</a>
                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="">
                                        <button type="submit" class="btn btn-danger btn-md">
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
                            <p class="h2 font-weight-normal mt-3 mb-4">The page you are looking for might have been removed.
                            </p>
                            <a href="{{ route('category.create') }}" class="btn btn-primary btn-other btn-lg">Add new category</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
