@extends('layouts.master')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row mb-1">
                <div class="col-auto d-none d-sm-block">
                    <h3><strong>Questions List</strong></h3>
                </div>
                <div class="col-auto ms-auto text-end mt-n1">
                    <a href="{{ route('question.create') }}" class="btn btn-primary btn-other">Add a question</a>
                    <a href="{{ route('dashboard.index') }}" class="btn btn-primary btn-other">Dashboard</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body pb-0">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Question</th>
                                <th>Option 1</th>
                                <th>Option 2</th>
                                <th>Question</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($questions->count() > 0)
                                @foreach ($questions as $key => $question)
                                    <tr>
                                        <td>{{ $questions->firstItem() + $key }}</td>
                                        <td>{{ $question->category->name }}</td>
                                        <td>{{ $question->name }}</td>
                                        <td>{{ $question->option1 }}</td>
                                        <td>{{ $question->option2 }}</td>
                                        <td>{{ $question->answer }}</td>
                                        <td>{{ $question->status }}</td>
                                        <td>{{ $question->created_at }}</td>
                                        <td>
                                            <form method="post" action="{{ route('question.destroy', $question->id) }}"
                                                class="form-inline">
                                                @csrf
                                                @method('delete')
                                                <div class="d-flex justify-content-end">
                                                    <div class="btn-group" role="group"
                                                        aria-label="Basic mixed styles example">
                                                        <a href="{{ route('question.show', $question->id) }}"
                                                            role="button" class="btn btn-success">View</a>
                                                        <a href="{{ route('question.edit', $question->id) }}"
                                                            role="button" class="btn btn-primary btn-other">Edit</a>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9">No Question Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @if ($questions->count() > 0)
                        <div class="d-flex justify-content-end">
                            {{ $questions->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
