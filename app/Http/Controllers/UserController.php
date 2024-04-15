<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $limit;
    private $roles;
    public function __construct()
    {
        $this->middleware('auth');
        $this->roles = ['admin', 'user', 'viewer'];
        $this->limit = 10;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate($this->limit);
        return view('user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['roles'] = $this->roles;
        return view('user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
            'status' => 'required'
        ]);
        $data = array(
            'full_name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status
        );
        User::create($data);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('user.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['user'] = User::find($id);
        $data['roles'] = $this->roles;
        return view('user.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return redirect()->route('user.index');
        }
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,'. $id ?? 0,
            'status' => 'required',
            'role' => 'required'
        ]);
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->full_name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->save();
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
