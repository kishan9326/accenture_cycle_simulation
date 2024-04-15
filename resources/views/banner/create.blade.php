@extends('layouts.master')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="row mb-1">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>Create Category</strong></h3>
            </div>
            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{ route('category-management.index') }}" class="btn btn-primary btn-other btn-other">Category Management</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('category.store') }}">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="name">Category Name</label>
                            <input type="text" name="name" value="{{ old('name') ? old('name'): '' }}" class="form-control" id="name" placeholder="Enter name">
                            @error('name')
                                <div class="small text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="role">Category status</label>
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
                    <button type="submit" class="btn btn-primary btn-other btn-other">Save</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection