<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function get(User $user)
    {
        return view('users.details')->with('user', $user);
    }

    public function getAll()
    {
        $users = User::paginate(2);
        return view('users.list')->with('users', $users);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([]);
    }

    public function delete(User $user)
    {
        if (User::whereId($user->id)->count()) {
            $user->delete();
            return response()->json(['success' => true, 'user' => $user]);
        }
        return response()->json(['success' => false]);
    }

    public function update(Request $request, User $user)
    {
        $newUser = User::find($user->id);
        if($request->filled('name')) {
            $newUser->name = $request->name;
        }
        if($request->filled('password')) {
            $newUser->password = $request->password;
        }
        if($request->filled('email')) {
            $newUser->email = $request->email;
        }
        if($request->filled('img_url')) {
            $newUser->img_url = $request->img_url;
        }
        $newUser->save();
    }
}
