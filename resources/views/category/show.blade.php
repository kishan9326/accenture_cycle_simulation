@extends('layouts.master')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row mb-1">
                <div class="col-auto d-none d-sm-block">
                    <h3><strong>Category detail</strong></h3>
                </div>
                <div class="col-auto ms-auto text-end mt-n1">
                    <a href="{{ route('category.index') }}" class="btn btn-primary btn-other">Category List</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @if($category && $category->count() > 0)
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><strong>Name: </strong> <span class="text-muted">{{ $category->name }}</span></li>
                        <li class="mb-1"><strong>Status: </strong> <span class="text-muted">{{ $category->status }}</span></li>
                        <li class="mb-1"><strong>Created at: </strong> <span class="text-muted">{{ $category->created_at }}</span></li>
                        <li class="mb-1">
                            <form method="post" action="{{ route('category.destroy', $category->id) }}" class="form-inline">
                                @csrf
                                @method('delete')
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary btn-other btn-md">Edit</a>
                                <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="top" title="">
                                    <button  type="submit" class="btn btn-danger btn-md">
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
                            <a href="{{ route('category.create') }}" class="btn btn-primary btn-other btn-lg">Add new category</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection