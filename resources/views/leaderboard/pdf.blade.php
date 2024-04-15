<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Cycle Simulator</title>
        <link href="{{ asset('public/css/light.css') }}" rel="stylesheet">
        <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('public/css/flatpickr.min.css') }}">
       
    </head>
    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Profile</th>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Email&nbsp;ID</th>
                    <th>Organization</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Environment</th>
                    <th>Topic</th>
                    <th>Game&nbsp;Mode</th>
                    <th>Gameplay</th>
                    <th>Calories&nbsp;Burnt</th>
                    <th>Duration</th>
                    <th>Trees&nbsp;saved</th>
                    <th>Date&nbsp;of&nbsp;Participations</th>
                </tr>
            </thead>
            <tbody>
                @if ($players->count() > 0)
                    @foreach ($players as $key => $player)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                @if($player->userFile)
                                    <img src="{{ asset('public/storage/users/' . $player->userFile) }}" class="img-thumbnail" style="width: 50px; height: 50px">
                                @else
                                    N/A
                                @endif
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
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="14">No Leaderboard Found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </body>
</html>