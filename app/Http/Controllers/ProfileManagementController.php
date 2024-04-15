<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class ProfileManagementController extends Controller
{
    private $limit;
    private $age_ranges;
    public function __construct()
    {
        $this->middleware('auth');
        $this->limit = 10;
        $this->age_ranges = ['18-24', '25-34', '35-44', '45-54', '55-70'];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = Player::query();
        $query->where('player_status', 'active');
         if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        $query->selectRaw('players.*, ROW_NUMBER() over (ORDER BY correct_answers DESC, timer_in_sec ASC, calories ASC) as ranking');
        $query->sortable();
        $data['players'] = $query->paginate($this->limit);
        $data['search'] = $search;
        return view('player.index')->with($data);
    }

    public function export(Request $request) {
        $search = $request->query('search');
        $query = Player::query();
        $query->where('player_status', 'active');
         if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        $query->selectRaw('players.*, ROW_NUMBER() over (ORDER BY correct_answers DESC, timer_in_sec ASC, calories ASC) as ranking');
        $query->sortable();
        $data['players'] = $query->get();
        // return view('player.pdf')->with($data);
        $pdf = Pdf::loadView('player.pdf', $data);
        $pdf->setPaper('a4')->setOrientation('landscape')->setOption('margin-bottom', 0);
        $file_name = 'profile_' . Auth::id() . '_' . time() . '.pdf';
        $file_path = base_path('public/player/' . $file_name);
        $pdf->save($file_path);
        return $pdf->download($file_name);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['player'] = Player::find($id);
        return view('player.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['player'] = Player::find($id);
        $data['categories'] = Category::all();
        $data['age_ranges'] = $this->age_ranges;
        return view('player.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $player = Player::find($id);
        if (empty($player)) {
            return redirect()->route('profile-management.index');
        }
        $this->validate($request, [
            'cat_id' => 'required',
            'name' => 'required',
            'email' => 'required|unique:players,email,' . $id,
            'organization' => 'required',
            'age' => 'required',
            'gender' => 'required',
        ]);
        $userFileName = '';
        if ($request->has('userFile')) {
            $file = $request->userFile;
            $ext = $file->getClientOriginalExtension();
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $userFileName = time() . '_' . $filename . '.' . $ext;
            if (strlen($player->userFile) > 0 && file_exists('public/storage/' . $player->userFile))
                unlink('public/storage/' . $player->userFile);
            $request->userFile->move('public/storage/', $userFileName);
        }

        $player->cat_id = $request->cat_id;
        $player->name = $request->name;
        $player->email = $request->email;
        $player->organization = $request->organization;
        $player->age = $request->age;
        $player->gender = $request->gender;
        if (strlen($userFileName) > 0)
            $player->userFile = $userFileName;
        $player->save();
        return redirect()->route('profile-management.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $player = Player::find($id);
        $player->player_status = 'deleted';
        $player->save();
        return redirect()->route('profile-management.index');
    }
}
