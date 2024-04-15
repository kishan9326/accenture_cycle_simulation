@extends('layouts.master')
@section('content')
    <main class="content">
    <div class="scroll">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body pb-0">
                    <h1 class="text-left mb-4"><strong>Category Management</strong></h1>
                    <div class="text-end">
                        @php
                        $active = 0;
                        $inactive = 0;
                            if ($questions->count() > 0) {
                                foreach ($questions as $key => $question) {
                                    if($question->status === 'active') {
                                        $active++;
                                    }
                                    if($question->status === 'inactive') {
                                        $inactive++;
                                    }
                                }
                            }
                        @endphp
                        <p class="mb-0"><strong>Active questions into current topic</strong>: {{ $active }}</p>
                        <p class="mb-0"><strong>Inactive questions into current topic</strong>: {{ $inactive }}</p>
                    </div>
                    <form method="get" class="pt-2" action="">
                        <div class="d-flex justify-content-left bd-highlight position-relative">
                            @if ($categories->count() > 0)
                                @foreach ($categories as $key => $category)
                                    <a href="{{ route('category-management.index', ['cat_id' => $category->id]) }}" role="button" class="nav-link p-3 {{ request()->input('cat_id') && request()->input('cat_id') == $category->id ? 'btn_active' : '' }}">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                                <a href="{{ route('category-management.category_list') }}" role="button" class="nav-link p-3 position-relative top-0 end-0">
                                    <i class="align-middle fas fa-fw fa-pencil-alt"></i> Edit
                                </a>
                            @else
                                <tr>
                                    <td colspan="9">No Category Found</td>
                                </tr>
                            @endif
                        </div>
                    </form>
                    <table class="table table-striped table-hover">
                        <thead class="thead-color">
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Question</th>
                                <th>Correct Choice</th>
                                <th>Choice 1</th>
                                <th>Choice 2</th>
                                <th>Status</th>
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
                                        <td>{{ $question->answer }}</td>
                                        <td>{{ $question->option1 }}</td>
                                        <td>{{ $question->option2 }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input question-status" value="{{ $question->status }}" data-question="{{ $question->id }}" data-status="{{ $question->status }}" id="switch-check-{{ $key }}" {{ $question->status === 'active' ? 'checked': '' }}>
                                                <label class="form-check-label" for="switch-check-{{ $key }}">{{ Str::title($question->status) }}</label>
                                            </div>
                                        </td>
                                        <td>
                                            <form method="post" action="{{ route('question.destroy', $question->id) }}"
                                                class="form-inline">
                                                @csrf
                                                @method('delete')
                                                <div class="d-flex justify-content-end">
                                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                        <a href="{{ route('question.edit', $question->id) }}" role="button" class="btn border" tooltip="Edit">
                                                            <i class="feather feather-edit align-middle me-2" data-feather="edit"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">No Questions Found</td>
                                </tr>
                            @endif
                        </tbody>
                   
                    </table>
                    @if ($questions->count() > 0)
                        <div class="d-flex justify-content-end">
                            {{ $questions->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </main>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header bg-secondary text-white">
            <i class="far fa-flag me-2"></i>
            <strong class="me-auto">Question Status</strong>
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="toast" aria-label="Close">
                <i class="align-middle fas fa-fw fa-window-close"></i>
            </button>
          </div>
          <div id="question-body" class="toast-body">
            <!-- Response from service -->
          </div>
        </div>
      </div>
@endsection
