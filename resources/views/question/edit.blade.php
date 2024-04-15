
@extends('layouts.master')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">
                <div class="row mb-1">
                    <div class="col-auto d-none d-sm-block">
                        <h1 class="text-left mb-4"><strong>Edit Question</strong></h1>
                    </div>
                    <div class="col-auto ms-auto text-end mt-n1">
                        <a href="{{ route('category-management.index', ['cat_id' => $question['cat_id']] ) }}" class="btn btn-primary btn-other">Category Management</a>
                    </div>
                </div>   
                @if (session()->has('error'))
                    <div class="shadow-lg p-3 mb-2 bg-body rounded">
                        <div class="text-danger">
                            {{ session()->get('error') }}
                        </div>
                    </div>
                @endif
                <form method="post" action="{{ route('question.update',  $question['id']) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="cat_id" value="{{ $question['cat_id'] }}" />
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="name">Question</label>
                            <input type="text" maxlength="300" name="name" value="{{ old('name') ? old('name'): $question['name'] }}" class="form-control" id="name" placeholder="Enter Question">
                            @error('name')
                                <div class="small text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="option1">Choice 1</label>
                            <input type="text" maxlength="150" name="option1" value="{{ old('option1') ? old('option1'): $question['option1']  }}" class="form-control" id="option1" placeholder="Enter option1">
                            @error('option1')
                                <div class="small text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="option2">Choice 2</label>
                            <input type="text" maxlength="150" name="option2" value="{{ old('option2') ? old('option2'): $question['option2'] }}" class="form-control" id="option2" placeholder="Enter option2">
                            @error('option2')
                                <div class="small text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="option2">Correct Choice</label>
                            <input type="text" maxlength="150" name="answer" value="{{ old('answer') ? old('answer'): $question['answer'] }}" class="form-control" id="answer" placeholder="Enter answer">
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
                                    <input class="form-check-input" type="radio" name="status" {{ ((old('status') && old('status') === 'active') || $question['status'] === 'active') ? 'checked': '' }} value="active">
                                    <span class="form-check-label">Active</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" {{ ((old('status') && old('status') === 'inactive') || $question['status'] === 'inactive') ? 'checked': '' }} value="inactive">
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