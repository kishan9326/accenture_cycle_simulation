<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Leaderboard;
use App\Models\Player;
use App\Models\Question;
use App\Models\Banner;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    private $response;
    private $limit;
    private $filters;
    private $user_id;
    public function __construct()
    {
        $this->response = array(
            'header' => array(
                'code' => 404,
                'status' => 'error',
                'message' => 'Not fond'
            ),
            'body' => null
        );
        $this->limit = 10;
        $this->filters = array('user', 'current', 'week', 'month');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        $data = array();
        $this->user_id = $id;
        foreach ($this->filters as $filter) {
            $players = $this->build_leaderboard($filter);
            $data[$filter] = array();
            if (!empty($players)) {
                foreach ($players as $key => $player) {
                    $data[$filter][$key] = $player;
                }
            }
        }
        $this->response['header']['code'] = 200;
        $this->response['header']['message'] = "Ok";
        $this->response['header']['status'] = "success";
        $this->response['body'] = $data;
        return response()->json($this->response, 200);
    }

    private function build_leaderboard($filter)
    {
        $players = array();
        switch ($filter) {
            case 'current':
                $single = Player::latest('id')->where('player_status', 'active')->first();
                if (!empty($single)) {
                    $query = Player::query();
                    $query = $query->where('session_id', $single->session_id);
                    $query->selectRaw('players.*, ROW_NUMBER() over (ORDER BY correct_answers DESC, timer_in_sec ASC, calories ASC) as ranking');
                    $results = $query->limit(3)->get();
                    if($results->count() > 0) {
                        foreach($results as $result) {
                            $rank = $result->getRanking();
                            $temp = $result->toArray();
                            $temp['ranking'] = $rank;
                            $players[] = $temp;
                        }
                    }
                }
                break;
            case 'week':
                $query = Player::query();
                $start_date = Carbon::now()->startOfWeek();
                $end_date = Carbon::now()->endOfWeek();
                $query = $query->where('created_at', '>=', $start_date);
                $query = $query->where('created_at', '<=', $end_date);
                $query->where('players.correct_answers', '!=', null)->where('players.timer_in_sec', '!=', null)->where('players.timer', '!=', 'null')->where('players.calories', '!=', null);
                $query->selectRaw('players.*, ROW_NUMBER() over (ORDER BY correct_answers DESC, timer_in_sec ASC, calories ASC) as ranking');
                $results = $query->limit($this->limit)->get();
                if($results->count() > 0) {
                    foreach($results as $result) {
                        $rank = $result->getRanking();
                        $temp = $result->toArray();
                        $temp['ranking'] = $rank;
                        $players[] = $temp;
                    }
                }
            case 'month':
                $query = Player::query();
                // $start_date = Carbon::now()->startOfMonth();
                // $end_date = Carbon::now()->endOfMonth();
                // $query = $query->where('created_at', '>=', $start_date);
                // $query = $query->where('created_at', '<=', $end_date);
                $query->where('players.correct_answers', '!=', null)->where('players.timer_in_sec', '!=', null)->where('players.timer', '!=', 'null')->where('players.calories', '!=', null);
                $query->selectRaw('players.*, ROW_NUMBER() over (ORDER BY correct_answers DESC, timer_in_sec ASC, calories ASC) as ranking');
                $results = $query->limit($this->limit)->get();
                if($results->count() > 0) {
                    foreach($results as $result) {
                        $rank = $result->getRanking();
                        $temp = $result->toArray();
                        $temp['ranking'] = $rank;
                        $players[] = $temp;
                    }
                }
                break;
            case 'user':
                $query = Player::query();
                $query->where('id', $this->user_id);
                $query->selectRaw('players.*, ROW_NUMBER() over (ORDER BY correct_answers DESC, timer_in_sec ASC, calories ASC) as ranking');
                $results = $query->limit($this->limit)->get();
                if($results->count() > 0) {
                    foreach($results as $result) {
                        $rank = $result->getRanking();
                        $temp = $result->toArray();
                        $temp['ranking'] = $rank;
                        $players[] = $temp;
                    }
                }
                break;
            default:
                # code...
                break;
        }
        return $players;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request_data = $request->all();
        if (empty($request_data)) {
            $this->response['header']['message'] = "All fields are required";
            return response()->json($this->response, 201);
        } else if (empty($request_data['players'])) {
            $this->response['header']['message'] = "Player key is missing";
            return response()->json($this->response, 201);
        }
        $hold_array = array();
        $user_file = '';
        $session_id = time();
        $cat_ids = array();
        $env = '';
        foreach ($request_data['players'] as $data) {
            if (empty($data)) {
                $this->response['header']['message'] = "All fields are required 2";
                return response()->json($this->response, 201);
            }
            if (isset($data['userFile']) && $data['userFile'] !== null) {
                $user_file = uniqid() . '.' . File::extension($data['userFile']->getClientOriginalName());
                Storage::putFileAs('public/users', $data['userFile'], $user_file);
            }
            $cat_ids[] = $data['cat_id'];
            $hold_array[] = array(
                'cat_id' => $data['cat_id'],
                'session_id' => $session_id,
                'gaming_mode' => $data['gaming_mode'],
                'environment' => $data['environment'],
                'player_count' => count($request_data['players']),
                'name' => $data['name'],
                'email' => $data['email'],
                'organization' => $data['organization'],
                'age' => $data['age'],
                'gender' => $data['gender'],
                'userFile' => $user_file,
                'created_at' => Carbon::now()->isoFormat('YYYY-MM-DD H:mm:ss'),
                'updated_at' => Carbon::now()->isoFormat('YYYY-MM-DD H:mm:ss')
            );
            $env = $data['environment'];
        }
        if (empty($hold_array)) {
            $this->response['header']['message'] = "Something went wrong";
            return response()->json($this->response, 500);
        }
        Player::insert($hold_array);
        $questions = array();
        foreach ($cat_ids as $cat_id) {
            $category = Category::where(array('id' => $cat_id, 'status' => 'active'))->first();
            if(!empty($category)) {
                $questions[] = Question::select(array('id', 'cat_id', 'name', 'option1', 'option2', 'answer', 'status'))->where(array('cat_id' => $cat_id, 'status' => 'active'))->inRandomOrder()->limit($this->limit)->get()->toArray();
            } else {
                $questions[] = array();
            }
        }
        $players_data = Player::select('id', 'cat_id', 'session_id', 'gaming_mode', 'environment', 'player_count', 'name', 'email', 'organization', 'age', 'gender', 'userFile', 'created_at')->where('session_id', $session_id)->get()->toArray();
        $players = array();
        foreach ($players_data as $player) {
            $player['full_path'] = '';
            if (!empty($player['userFile'])) {
                $player['full_path'] = asset('public/storage/users/' . $player['userFile']);
            }
            $players[] = $player;
        }
        $banners_hold = Banner::where('env', $env)->get();
        $banners = array();
        foreach ($banners_hold as $banner_hold) {
            $banner_hold['full_path'] = '';
            if (!empty($banner_hold['file'])) {
                $banner_hold['full_path'] = asset('public/storage/banner/' . $banner_hold['file']);
            }
            $banners[] = $banner_hold;
        }
        $this->response['header']['code'] = 200;
        $this->response['header']['message'] = "Ok";
        $this->response['header']['status'] = "success";
        $this->response['body']['players'] = $players;
        $this->response['body']['banners'] = $banners;
        $this->response['body']['questions'] = $questions;
        return response()->json($this->response, 200);
    }

    public function leaderboard(Request $request)
    {
        $request_data = $request->all();
        if (empty($request_data)) {
            $this->response['header']['message'] = "All fields are required 2";
            return response()->json($this->response, 201);
        }
        $errors = '';
        $insert = array();
        foreach ($request_data as $key => $data) {
            $id = $key++;
            if (!isset($data['player_id']) || empty($data['player_id'])) {
                $errors = "player_id field is required for " . $id;
            }
            if (!isset($data['calories']) || empty($data['calories'])) {
                $errors = "calories field is required for " . $id;
            }

            if (!isset($data['timer']) || empty($data['timer'])) {
                $errors = "timer field is required for " . $id;
            }

            if (!isset($data['questions']) || empty($data['questions'])) {
                $errors = "questions field is required for " . $id;
            } else {
                $datetime = Carbon::now()->isoFormat('YYYY-MM-DD H:mm:ss');
                $correct_answers = 0;
                foreach ($data['questions'] as $question) {
                    $correct_answers += $question['is_correct'] === 'yes' ? 1 : 0;
                    $insert[] = array(
                        'player_id' => $data['player_id'],
                        'question_id' => $question['question_id'],
                        'is_correct' => $question['is_correct'],
                        'created_at' => $datetime,
                        'updated_at' => $datetime
                    );
                }

                $player = Player::find($data['player_id']);
                $player->calories = $data['calories'];
                $player->timer = $data['timer'];
                $seconds = null;
                if (!empty($data['timer'])) {
                    $timers = explode(':', $data['timer']);
                    $seconds = ($timers[0] * 60 * 60) + ($timers[1] * 60) + $timers[2];
                }
                $player->timer_in_sec = $seconds;
                $player->correct_answers = $correct_answers;
                $player->save();
            }
        }
        if (!empty($errors)) {
            $this->response['header']['message'] = $errors;
            return response()->json($this->response, 402);
        }
        if (empty($insert)) {
            $this->response['header']['message'] = "No data found for insertion";
            return response()->json($this->response, 404);
        }
        Leaderboard::insert($insert);
        $this->response['header']['code'] = 200;
        $this->response['header']['message'] = "Ok";
        $this->response['header']['status'] = "success";
        $this->response['body'] = null;
        return response()->json($this->response, 200);
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
