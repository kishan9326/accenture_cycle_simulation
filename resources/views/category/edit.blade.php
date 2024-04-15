@extends('layouts.master')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="row mb-1">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>Edit Category</strong></h3>
            </div>
            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{ route('category-management.index', ['cat_id' => 1]) }}" class="btn btn-primary btn-other">Category Management</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @if($categories && $categories->count() > 0)
                <form method="post" action="{{ route('category-management.category_update') }}">
                    @csrf
                    @foreach($categories as $category)
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label" for="name_{{ $category->id }}">Category Name</label>
                                <input type="text" name="cat[{{ $category->id }}][name]" value="{{ old('name') ? old('name') : $category->name }}" class="form-control" id="name_{{ $category->id }}" placeholder="Enter name">
                                @error('name')
                                    <div class="small text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Status</label>
                                <div>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="cat[{{ $category->id }}][status]" {{ ((old('status') && old('status') === 'active') || $category->status === 'active') ? 'checked': '' }} value="active">
                                        <span class="form-check-label">Active</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="cat[{{ $category->id }}][status]" {{ ((old('status') && old('status') === 'inactive') || $category->status === 'inactive') ? 'checked': '' }} value="inactive">
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
                        <hr>
                    @endforeach
                    <button type="submit" class="btn btn-primary btn-other">Save</button>
                </form>
                @else
                <div class="text-center">
                    <h1 class="display-1 font-weight-bold">404</h1>
                    <p class="h1">Page not found.</p>
                    <p class="h2 font-weight-normal mt-3 mb-4">The page you are looking for might have been removed.</p>
                    <a href="{{ route('category.create') }}" class="btn btn-primary btn-other btn-lg">Add new Category</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection