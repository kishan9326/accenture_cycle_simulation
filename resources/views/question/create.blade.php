@extends('layouts.master')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="row mb-1">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>Create Question</strong></h3>
            </div>
            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{ route('category-management.index', ['cat_id' => 1]) }}" class="btn btn-primary btn-other">Category Management</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('question.store') }}">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="cat_id">Select Category</label>
                            <select class="form-select" name="cat_id" id="cat_id" aria-label="Default select example">
                                <option value="" selected>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('cat_id') && old('cat_id') == $category->id) ? 'selected': '' }}>{{ Str::title($category->name) }}</option>
                                @endforeach
                            </select>
                            @error('cat_id')
                                <div class="small text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="name">Question</label>
                            <input type="text" name="name" value="{{ old('name') ? old('name'): '' }}" class="form-control" id="name" placeholder="Enter Question">
                            @error('name')
                                <div class="small text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="option1">Option 1</label>
                            <input type="text" name="option1" value="{{ old('option1') ? old('option1'): '' }}" class="form-control" id="option1" placeholder="Enter option1">
                            @error('option1')
                                <div class="small text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="option2">Option 2</label>
                            <input type="text" name="option2" value="{{ old('option2') ? old('option2'): '' }}" class="form-control" id="option2" placeholder="Enter option2">
                            @error('option2')
                                <div class="small text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="option2">Answer</label>
                            <input type="text" name="answer" value="{{ old('answer') ? old('answer'): '' }}" class="form-control" id="answer" placeholder="Enter answer">
                            @error('answer')
                                <div class="small text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="role">Question status</label>
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