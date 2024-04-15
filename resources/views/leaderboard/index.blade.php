@extends('layouts.master')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body pb-0">
                    <h1 class="text-left mb-4"><strong>Leaderboard Management</strong></h1>
                    <form method="get" class="pt-2" action="{{ route('leaderboard.index') }}">
                        <div class="row">
                            <div class="col-1">
                                <p class="pt-1 text-start"><strong>By Name:</strong></p>
                            </div>
                            <div class="col-3 p-0">
                                <input type="text" name="search" value="{{ request()->input('search') }}" class="form-control border" placeholder="Enter player's name">
                            </div>
                            <div class="col-4 p-0 pl-1">
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <button class="btn btn-primary btn-other" type="submit">
                                        <i class="feather feather-search align-middle" data-feather="search"></i>
                                    </button>
                                    <a href="{{ route('leaderboard.index') }}" class="btn btn-secondary">Clear</a>
                                </div>
                            </div>
                            <div class="col-4 text-end ">
                                <a class="btn btn-primary btn-other dropdown-toggle" href="#" id="resourcesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Filter
                                </a>
                                <div class="dropdown-menu" aria-labelledby="resourcesDropdown">
                                <a class="dropdown-item" href="{{ route('leaderboard.index', array_merge(['filter' => 'day'])) }}">
                                        Recent Activity
                                    </a>
                                    <a class="dropdown-item" href="{{ route('leaderboard.index', array_merge(['filter' => 'week'])) }}">
                                        This Week
                                    </a>
                                    <a class="dropdown-item" href="{{ route('leaderboard.index', array_merge(['filter' => 'last_week'])) }}">
                                        Last Week
                                    </a>
                                    <a class="dropdown-item" href="{{ route('leaderboard.index', array_merge(['filter' => 'month'])) }}">
                                        This Month
                                    </a>
                                    <a class="dropdown-item" href="{{ route('leaderboard.index', array_merge(['filter' => 'last_month'])) }}">
                                        Last Month
                                        </a>
                                    <a class="dropdown-item" href="{{ route('leaderboard.index', array_merge(['filter' => 'year'])) }}">
                                        This Yearly
                                    </a>
                                    <a class="dropdown-item" href="{{ route('leaderboard.index', array_merge(['filter' => 'last_year'])) }}">
                                        Last Yearly
                                    </a>
                                </div>
                                <a href="{{ route('leaderboard.export', array_merge(\Request::query())) }}" class="btn btn-success">
                                    <i class="align-middle me-2 fas fa-fw fa-file-pdf"></i> Export
                                </a>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="scroll">
                        <table class="table border table-striped table-hover small leaderboard-table" style="width: auto;">
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
                                        <div class="d-flex">@sortablelink('correct_answers', 'Trees saved')</div>
                                    </th>
                                    <th>
                                        <div class="d-flex">@sortablelink('created_at', 'Date of Participations')</div>
                                    </th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($players->count() > 0)
                                    @foreach ($players as $key => $player)
                                        <tr>
                                            <td>{{ $players->firstItem() + $key }}</td>
                                            <td>
                                            <div class="zoomm">
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
                                            <td>{{ $player->gender }}</td>
                                            <td>{{ $player->age }}</td>
                                            <td>{{ $player->environment }}</td>
                                            <td>{{ $player->category->name }}</td>
                                            <td>{{ $player->gaming_mode }}</td>
                                            <td>{{ $player->player_count == 1 ? 'Single': 'Multi'  }}</td>
                                            <td>{{ $player->calories ? $player->calories . ' Cal': 'N/A' }}</td>
                                            <td>{{ $player->timer ? $player->timer: 'N/A' }}</td>
                                            <td>{{ $player->correct_answers ? $player->correct_answers: 'N/A' }}</td>
                                            <td>{{ $player->created_at->format('Y-m-d h:i A') }}</td>
                                            <td>
                                                <form method="post" class="pt-2" action="{{ route('leaderboard.export_user', $player->id) }}">
                                                    @csrf
                                                    <button class="btn btn-success" type="submit" style="width: 105px;">
                                                        <i class="align-middle me-2 fas fa-fw fa-file-pdf"></i> Export
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="15">No Leaderboard Found</td>
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
