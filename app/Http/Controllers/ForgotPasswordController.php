<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Models\User;
use App\Models\ForgotPassword;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('forgotpassword.index');
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
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (empty($user)) {
            return back()->with('error', "Email couldn't found");
        }
        if (!empty($user)) {
            $forgot_password = array(
                'user_id' => $user->id,
                'token' => Str::random(40)
            );
            $data['user'] = $user;
            $data['data'] = $forgot_password;
            ForgotPassword::create($forgot_password);
            try {
                $result = Mail::to($request->email)->send(new ResetPassword($data));
                return back()->with('success', 'Reset link sent on your email id');
            } catch (Exception $e) {
                return back()->with('error', 'Reset link not sent on given email id due to ' . $e->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $forgot_password = ForgotPassword::where('token', $id)->first();
        if (empty($forgot_password)) {
            return redirect()->route('login.index');
        }
        $data['forgot_password'] = $forgot_password;
        return view('forgotpassword.reset', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ForgotPassword $forgotPassword)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);
        $forgot_password = ForgotPassword::where('user_id', $id)->first();
        $forgot_password->status = 'deleted';
        $forgot_password->save();
        $user = User::find($id);
        if (!empty($user)) {
            $user->password = Hash::make($request->password);
            $user->save();
        }
        return redirect()->route('login.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ForgotPassword $forgotPassword)
    {
        //
    }
}
