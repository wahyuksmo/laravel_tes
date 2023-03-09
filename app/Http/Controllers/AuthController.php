<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //

    public function register()
    {

        return view('register');
    }


    public function regisProses(Request $request)
    {


        $validatedData = $request->validate([
            'name'      => 'required',
            'email'     => 'required|unique:users',
            'password'  => 'required'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        if (User::create($validatedData)) {
            return response()->json(
                [
                    "status" => "success",
                    "message" => "Berhasil registrasi"
                ],
                200
            );
        }
    }

    public function login()
    {

        return view('login');
    }


    public function loginProses(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        $user = DB::table('users')->where('email', $request->email)->first();

        if (Auth::attempt($validatedData)) {
            User::whereId($user->id)->update(['is_login' => 'Y']);
            return response()->json([
                "status" => true,
                "data" => [
                    "users" => $user,
                    "message" => "Login sukses"
                ]
            ], 200);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Login gagal"
            ], 422);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();
        User::whereId($request->user_id)->update(['is_login' => 'N']);
        return response()->json([
            'status' => true,
            'data' => [
                'message' => 'Logout Berhasil'
            ]
        ], 200);
    }
}
