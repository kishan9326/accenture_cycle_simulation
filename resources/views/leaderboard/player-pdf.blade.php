<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <style type="text/css" role="stylesheet">
            * {
                box-sizing: border-box;
                -moz-box-sizing: border-box;
            }

            body {
                font-family: Arial;
                font-size: 12pt;
                margin: 0 auto;
            }

            table {
                border-collapse: collapse;
                font-family: Arial;
                font-size: 12pt;
                border: 1px solid #ccc;
                width: 100%;
            }
            table td,
            table th {
                border: 1px solid #ccc;
                padding: 5px;
                text-align: left;
            }
        </style>
    </head>
    <body>
        <h2 style="font-weight: bold">Individual's Leaderboard</h2>
        <table>
            <thead>
                <tr>
                    <th>Profile</th>
                    <td>
                        <div class="{{ $player->userFile ? 'zoomm': '' }}">
                            @if($player->userFile)
                                <img src="{{ asset('public/storage/users/' . $player->userFile) }}" class="img-thumbnail" style="width: 50px; height: 50px">
                            @else
                                N/A
                            @endif
                        </div>
                    </td>
                    <th>Name</th>
                    <td>{{ $player->name }}</td>
                    <th>Email</th>
                    <td>{{ $player->email }}</td>
                </tr>
                <tr>
                    <th>Organization</th>
                    <td>{{ $player->organization }}</td>
                    <th>Gender</th>
                    <td>{{ $player->gender }}</td>
                    <th>Age</th>
                    <td>{{ $player->age }}</td>
                </tr>
                <tr>
                    <th>Topic</th>
                    <td>{{ $player->category->name }}</td>
                    <th>Game Mode</th>
                    <td>{{ $player->gaming_mode }}</td>
                    <th>Gameplay</th>
                    <td>{{ $player->player_count == 1 ? 'Single': 'Multi'  }}</td>
                </tr>
                <tr>
                    <th>Environment</th>
                    <td>{{ $player->environment }}</td>
                    <th>Rank</th>
                    <td>{{ $player->getRanking() }}</td>
                    <th>Calories Burnt</th>
                    <td>{{ $player->calories }} Cal</td>
                </tr>
                <tr>
                    <th>Duration</th>
                    <td>{{ $player->timer }}</td>
                    <th>Trees saved</th>
                    <td>{{ $player->correct_answers }}</td>
                    <th>Participation Date</th>
                    <td>{{ $player->created_at->format('Y-m-d h:i A') }}</td>
                </tr>
            </thead>
        </table>
        <table style="margin-top: 20px;">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Choice&nbsp;1</th>
                    <th>Choice&nbsp;2</th>
                    <th>Player's Choice</th>
                    <th>Correct</th>
                </tr>
            </thead>
            <tbody>
                @if($leaderboards->count() > 0)
                    @foreach($leaderboards as $leaderboard)
                    <tr>
                        <td>{{ $leaderboard->question->name }}</td>
                        <td>{{ $leaderboard->question->option1 }}</td>
                        <td>{{ $leaderboard->question->option2 }}</td>
                        <td>
                            @php
                                $user_selection = '';
                                if($leaderboard->is_correct === 'yes') {
                                    $user_selection = $leaderboard->question->answer;
                                } else if($leaderboard->is_correct === 'no') {
                                    $user_selection = $leaderboard->question->answer === $leaderboard->question->option1 ? $leaderboard->question->option2: $leaderboard->question->option1;
                                } else {
                                    $user_selection = 'None';
                                }
                            @endphp
                            {{ $user_selection }}
                        </td>
                        <td>{{ Str::title($leaderboard->is_correct) }}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </body>
</html>