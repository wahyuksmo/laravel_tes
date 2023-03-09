<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use NumberFormatter;

class DashboardController extends Controller
{
    //
    public function index()
    {

        $data = [
            'title' => 'Home',
            'data'  => User::all()
        ];

        return view('admin.index', $data);
    }


    public function add_user()
    {
        $data = [
            'title' => 'Add User'
        ];
        return view('admin.add_user', $data);
    }

    public function store_user(Request $request)
    {
        $data  = $request->validate([
            'name'      => 'required',
            'email'     => 'required|unique:users',
            'password'  => 'required'
        ]);

        $data['password'] = bcrypt($data['password']);

        if (User::create($data)) {
            return redirect('/')->with('success', 'Add user success');
        } else {
            return redirect('/')->with('error', 'Add user failed');
        }
    }

    public function delete_user(Request $request)
    {
        if (User::destroy($request->id)) {
            return redirect('/')->with('success', 'Delete user success');
        } else {
            return redirect('/')->with('error', 'Delete user failed');
        }
    }

    public function edit_user($id)
    {
        $user = User::find($id);
        $data = [
            'title' => 'Edit User',
            'data'  => $user
        ];
        return view('admin.edit', $data);
    }

    public function update_user(Request $request)
    {

        $getData = User::find($request->id);

        $rules = [
            'name'  => 'required',
            'email' => 'required'
        ];

        if ($request->email != $getData->email) {
            $rules['email'] = 'required|unique:users';
        }
        $data = $request->validate($rules);

        if (User::where('id', $request->id)->update($data)) {
            return redirect('/')->with('success', 'Edit user success');
        } else {
            return redirect('/')->with('error', 'Edit user failed');
        }
    }


    public function swapvariable($a = '', $b = '')
    {
        $a = 5;
        $b = 3;
        $a ^= $b ^= $a ^= $b;

        echo "a = " . $a . "<br>";
        echo "b = " . $b . "<br>";
    }


    public function ubahAngkaMenjadiKata()
    {
        $formatter = new NumberFormatter("id", NumberFormatter::SPELLOUT);
        $number = 1000000000;
        $word = $formatter->format($number);
        echo $word;
    }
}
