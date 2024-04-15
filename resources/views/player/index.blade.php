@extends('layouts.master')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body pb-0">
                    <h1 class="text-left mb-4"><strong>Profile Management</strong></h1>
                    <form method="get" class="pt-2" action="{{ route('profile-management.index') }}">
                        <div class="row">
                            <div class="col-1">
                                <p class="pt-1 text-start"><strong>By Name:</strong></p>
                            </div>
                            <div class="col-3">
                                <input type="text" name="search" value="{{ request()->input('search') }}" class="form-control border" placeholder="Enter player's name">
                            </div>
                            <div class="col-4">
                                <div class="btn-group " role="group" aria-label="Basic mixed styles example">
                                    <button class="btn btn-primary btn-other" type="submit">
                                        <i class="feather feather-search align-middle" data-feather="search"></i>
                                    </button>
                                    <a href="{{ route('profile-management.index') }}" class="btn btn-secondary">Clear</a>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <a href="{{ route('profile-management.export', array_merge(\Request::query())) }}" class="btn btn-success">
                                    <i class="align-middle me-2 fas fa-fw fa-file-pdf"></i> Export
                                </a>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="scroll">
                        <table class="table border table-striped table-hover small profile-table" style="width: 100%;">
                            <thead class="thead-color">
                                <tr>
                                    <th>#</th>
                                    <th>Profile</th>
                                    <th>Rank</th>
                                    <th>
                                        <div class="d-flex">@sortablelink('name', 'Name')</div>
                                    </th>
                                    <th>
                                        <div class="d-flex">@sortablelink('email', 'Email ID')</div>
                                    </th>
                                    <th>
                                        <div class="d-flex">@sortablelink('organization', 'Organization')</div>
                                    </th>
                                    <th>
                                        <div class="d-flex">@sortablelink('gender', 'Gender')</div>
                                    </th>
                                    <th>
                                        <div class="d-flex">@sortablelink('age', 'Age')</div>
                                    </th>
                                    <th>
                                        <div class="d-flex">@sortablelink('environment', "Environment")</div>
                                    </th>
                                    <th>
                                        <div class="d-flex">@sortablelink('category.name', 'Topic')</div>
                                    </th>
                                    <th>
                                        <div class="d-flex">@sortablelink('gaming_mode', 'Game Mode')</div>
                                    </th>
                                    <th>
                                        <div class="d-flex">@sortablelink('player_count', 'Gameplay')</div>
                                    </th>
                                    <th>
                                        <div class="d-flex">@sortablelink('calories', 'Calories Burnt')</div>
                                    </th>
                                    <th>
                                        <div class="d-flex">@sortablelink('timer_in_sec', 'Duration')</div>
                                    </th>
                                    <th>
                                        <div class="d-flex">@sortablelink('correct_answers', 'Trees Saved')</div>
                                    </th>
                                    <th style="width: 145px;">
                                        <div class="d-flex">@sortablelink('created_at', 'Date of Participations')</div>
                                    </th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($players->count() > 0)
                                    @foreach ($players as $key => $player)
                                        <tr>
                                            <td>{{ $players->firstItem() + $key }}</td>
                                            <td>
                                                <div class="{{ $player->userFile ? 'zoomm': '' }}">
                                                    @if($player->userFile)
                                                        <img src="{{ asset('public/storage/users/' . $player->userFile) }}" class="img-thumbnail" style="width: 50px; height: 50px">
                                                    @else
                                                        N/A
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $player->getRanking() }}</td>
                                            <td>{{ $player->name }}</td>
                                            <td>{{ $player->email }}</td>
                                            <td>{{ $player->organization }}</td>
                                            <td>{{ Str::title($player->gender) }}</td>
                                            <td>{{ $player->age }}</td>
                                            <td>{{ $player->environment }}</td>
                                            <td>{{ $player->category->name }}</td>
                                            <td>{{ $player->gaming_mode }}</td>
                                            <td>{{ $player->player_count == 1 ? 'Single': 'Multi'  }}</td>
                                            <td>{{ $player->calories ? $player->calories . " kcal": 'N/A' }}</td>
                                            <td>{{ $player->timer ? $player->timer: 'N/A' }}</td>
                                            <td>{{ $player->correct_answers ? $player->correct_answers: 'N/A' }}</td>
                                            <td>{{ $player->created_at->format('Y-m-d h:i A') }}</td>
                                            <td>
                                                <form method="post"
                                                    action="{{ route('profile-management.destroy', $player->id) }}"
                                                    class="form-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="d-flex justify-content-end">
                                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                            <a href="{{ route('profile-management.edit', $player->id) }}" role="button" class="btn border" tooltip="Edit">
                                                                <i class="feather feather-edit align-middle me-2" data-feather="edit"></i>
                                                            </a>
                                                            <button type="submit" class="btn border" tooltip="Delete">
                                                                <i class="feather feather-trash-2 align-middle me-2" data-feather="trash-2"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="12">No Player Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @if ($players->count() > 0)
                        <div class="d-flex justify-content-end">
                            {{ $players->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
