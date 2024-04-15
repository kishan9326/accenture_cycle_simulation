@extends('layouts.master')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row mb-1">
                <div class="col-auto d-none d-sm-block">
                    <h3><strong>Edit Player</strong></h3>
                </div>
                <div class="col-auto ms-auto text-end mt-n1">
                    <a href="{{ route('profile-management.index') }}" class="btn btn-primary btn-other">Profile Management</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @if ($player && $player->count() > 0)
                        <form method="post" action="{{ route('profile-management.update', $player->id) }}"
                            accept-charset="utf-8" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="category">Category</label>
                                    <select class="form-select" name="cat_id" id="category"
                                        aria-label="Default select example">
                                        <option value="" selected>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ (old('cat_id') && old('cat_id') == $category->id) || $category->id === $player->cat_id ? 'selected' : '' }}>
                                                {{ Str::title($category->name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('cat_id')
                                        <div class="small text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" name="name"
                                        value="{{ old('name') ? old('name') : $player->name }}" class="form-control"
                                        id="name" placeholder="Enter name">
                                    @error('name')
                                        <div class="small text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" name="email"
                                        value="{{ old('email') ? old('email') : $player->email }}" class="form-control"
                                        id="email" placeholder="Enter email">
                                    @error('email')
                                        <div class="small text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="organization">Organization</label>
                                    <input type="text" name="organization"
                                        value="{{ old('organization') ? old('organization') : $player->organization }}"
                                        class="form-control" id="organization" placeholder="Enter organization">
                                    @error('organization')
                                        <div class="small text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="age">Age</label>
                                    <select class="form-select" name="age" id="age" aria-label="Default select example">
                                        <option value="" selected>Select Age</option>
                                        @foreach($age_ranges as $age_range)
                                            <option value="{{ $age_range }}" {{ (old('age') && old('age') == $age_range) || $player->age == $age_range ? 'selected' : '' }}>{{ $age_range }}</option>
                                        @endforeach
                                    </select>
                                    @error('age')
                                        <div class="small text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="gender">Select gender</label>
                                    <select class="form-select" name="gender" id="gender"
                                        aria-label="Default select example">
                                        <option value="" selected>Select gender</option>
                                        <option value="male"
                                            {{ (old('gender') && old('gender') == 'male') || $player->gender == 'male' ? 'selected' : '' }}>
                                            Male</option>
                                        <option value="female"
                                            {{ (old('gender') && old('gender') == 'female') || $player->gender == 'female' ? 'selected' : '' }}>
                                            Female</option>
                                        <option value="other"
                                            {{ (old('gender') && old('gender') == 'other') || $player->gender == 'other' ? 'selected' : '' }}>
                                            Other</option>
                                    </select>
                                    @error('gender')
                                        <div class="small text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <input type="file" name="userFile" value="dsds.jpg" class="form-control mt-2"
                                        accept=".jpg,.jpeg,.png">
                                    @if ($player->userFile)
                                        <p class="mt-1">
                                            <span class="fw-bolder">Uploaded file name:</span>
                                            <img src="{{ asset('public/storage/users/' . $player->userFile) }}" class="img-thumbnail" alt="..." width="75">
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-other">Save</button>
                        </form>
                    @else
                        <div class="text-center">
                            <h1 class="display-1 font-weight-bold">404</h1>
                            <p class="h1">Page not found.</p>
                            <p class="h2 font-weight-normal mt-3 mb-4">The page you are looking for might have been removed.
                            </p>
                            <a href="{{ route('category.create') }}" class="btn btn-primary btn-other btn-lg">Add new Category</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
