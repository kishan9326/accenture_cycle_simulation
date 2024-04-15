<?php


namespace App\Http\Controllers;

use App\Models\Leaderboard;
use Illuminate\Http\Request;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PDF;

class LeaderboardController extends Controller
{
    private $limit;
    public function __construct()
    {
        $this->middleware('auth');
        $this->limit = 10;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = Player::query();
        $query->where('correct_answers', '!=', null)->where('timer_in_sec', '!=', null)->where('timer', '!=', 'null')->where('calories', '!=', null);
         if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $date = $this->build_where_query($filter);
            $query->where('created_at', '>=', $date['start_date']);
            $query->where('created_at', '<=', $date['end_date']);
        }
        $query->selectRaw('players.*, ROW_NUMBER() over (ORDER BY correct_answers DESC, timer_in_sec ASC, calories ASC) as ranking');
        $query->sortable();
        $data['players'] = $query->paginate($this->limit);
        $data['search'] = $search;
        $data['filter'] = $filter;
        return view('leaderboard.index')->with($data);
    }

    private function build_where_query($filter)
    {
        switch ($filter) {
            case 'day':
                $date['start_date'] = Carbon::now()->startOfDay();
                $date['end_date'] = Carbon::now()->endOfDay();
                break;
            case 'week':
                $date['start_date'] = Carbon::now()->startOfWeek();
                $date['end_date'] = Carbon::now()->endOfWeek();
                break;
            case 'last_week':
                $date['start_date'] = Carbon::now()->subWeek(1)->startOfWeek();
                $date['end_date'] = Carbon::now()->subWeek(1)->endOfWeek();
                break;
            case 'month':
                $date['start_date'] = Carbon::now()->startOfMonth();
                $date['end_date'] = Carbon::now()->endOfMonth();
                break;
            case 'last_month':
                $date['start_date'] = Carbon::now()->subMonth(1)->startOfMonth();
                $date['end_date'] = Carbon::now()->subMonth(1)->endOfMonth();
                break;
            case 'year':
                $date['start_date'] = Carbon::now()->startOfYear();
                $date['end_date'] = Carbon::now()->endOfYear();
                break;
            case 'last_year':
                $date['start_date'] = Carbon::now()->subYear(1)->startOfYear();
                $date['end_date'] = Carbon::now()->subYear(1)->endOfYear();
                break;
            default:
                # code...
                break;
        }
        return $date;
    }

    public function export(Request $request)
    {
        $search = $request->query('search');
        $query = Player::query();
        $query->where('correct_answers', '!=', null)->where('timer_in_sec', '!=', null)->where('timer', '!=', 'null')->where('calories', '!=', null);
         if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $date = $this->build_where_query($filter);
            $query->where('created_at', '>=', $date['start_date']);
            $query->where('created_at', '<=', $date['end_date']);
        }
        $query->selectRaw('players.*, ROW_NUMBER() over (ORDER BY correct_answers DESC, timer_in_sec ASC, calories ASC) as ranking');
        $query->sortable();
        $data['players'] = $query->get();
        $data['search'] = $search;
        $data['filter'] = $filter;
        // return view('leaderboard.pdf')->with($data);
        $pdf = Pdf::loadView('leaderboard.pdf', $data);
        $pdf->setPaper('a4')->setOrientation('landscape')->setOption('margin-bottom', 0);
        $file_name = 'leaderboard_' . Auth::id() . '_' . time() . '.pdf';
        $file_path = base_path('public/leaderboard/' . $file_name);
        $pdf->save($file_path);
        return $pdf->download($file_name);
    }

    public function export_user($id) {
        $data['player'] = Player::find($id);
        $data['leaderboards'] = Leaderboard::where('player_id', $id)->get();
        // return view('leaderboard.player-pdf')->with($data);
        $pdf = Pdf::loadView('leaderboard.player-pdf', $data);
        $pdf->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0);
        $file_name = 'individual_leaderboard_' . $id . '_' . time() . '.pdf';
        $file_path = base_path('public/leaderboard/' . $file_name);
        $pdf->save($file_path);
        return $pdf->download($file_name);
;    }
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
        //
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
