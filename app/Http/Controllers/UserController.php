<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Hash;

class UserController extends Controller
{

    const MAX_BALANCE = 1000000000;

    public function get(User $user)
    {
        return view('users.details')->with('user', $user);
    }

    public function getAll()
    {
        $users = User::paginate(5);
        return view('users.list')->with('users', $users);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:50|unique:users,email',
            'password' => 'required|max:50',
            'balance' => 'required|gte:0|numeric|digits_between:1,20',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')
        ]);

        if ($request->balance != null) {
            $user->balance = $request->balance;
        } else {
            $user->balance = 0.0;
        }
        if ($request->img_url != null) {
            $user->img_url = $request->img_url;
        } else {
            $user->img_url = 'default.jpg';
        }
        $user->save();
        return back();
    }

    public function delete(Request $request)
    {
        $request->validate([
            'iddelete' => 'required|exists:users,id'
        ]);
        $user = User::find($request->iddelete);

        /*
        If we delete in ADMIN view we must be in user.list. Otherwise it means is the same user the one auto-deleting his account, 
        due to this reason; if it's not the admin it musy go to home page!!!
        */
        if (\Auth::user()->is_admin) {
            $user->delete();
            return back();
        } else {
            $user->delete();
            return redirect('login');
        }
    }

    public function updateProfileName(Request $request)
    {
        $request->validate([
            'id_update' => 'required|exists:users,id',
        ]);
        $newUser = User::find($request->id_update);
        // User NAME PROFILE SETTINGS
        $request->validate([
            'name_update_profile' => 'required|max:50',
            'passwordName' => 'required',
            'current_password_name' => 'required|same:passwordName',
        ]);

        if (\Hash::check($request->current_password_name, $newUser->password)) {
            $newUser->name = $request->name_update_profile;
            $newUser->update();
            session()->flash('msg', 'Name updated correctly!');
        } else {
            session()->flash('errorMsg', 'Invalid password!');
        }
        return back();
    }

    public function updateProfilePassword(Request $request)
    {
        $request->validate([
            'id_update' => 'required'
        ]);
        $newUser = User::find($request->id_update);
        $request->validate([
            'password_update_profile' => 'required|max:50',
            'password_password' => 'required',
            'current_password_password' => 'required|same:password_password',
        ]);
        if (\Hash::check($request->current_password_password, $newUser->password)) {
            $newUser->password = \Hash::make($request['password_update_profile']);
            $newUser->update();
            session()->flash('msg', 'Password updated correctly!');
        } else {
            session()->flash('errorMsg', 'Invalid current password!');
        }
        return back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_update' => 'required'
        ]);
        $newUser = User::find($request->id_update);


        if ($request->filled('name_update')) {
            $request->validate([
                'name_update' => 'max:50',
            ]);
            $newUser->name = $request->name_update;
        }
        if ($request->filled('password_update')) {
            $request->validate(['password_update' => 'max:50']);
            $newUser->password = \Hash::make($request->password_update);
        }

        if ($request->filled('email_update')) {
            $request->validate(['email_update' => 'email|unique:users,email|max:50']);
            $newUser->email = $request->email_update;
        }
        if ($request->filled('img_url_update')) {
            $request->validate(['img_url_update' => 'max:50']);
            $newUser->img_url = $request->img_url_update;
            session()->flash('msg', 'Image updated correctly!');
        }
        if ($request->filled('balance_update')) {
            $request->validate([
                'balance_update' => 'numeric|gte:0'
            ]);
            $newUser->balance = $request->balance_update;
        }
        $newUser->save();
        return back();
    }

    public function addBalance(Request $request)
    {
        $request->validate([
            'addBalance' => 'required|numeric|gte:0|max:1000000000'
        ]);
        $user = User::find($request->userId);
        $newBalance = $user->balance + $request->addBalance;
        if ($newBalance > self::MAX_BALANCE) {
            $newBalance = self::MAX_BALANCE;
            return throw ValidationException::withMessages([
                'addBalance' => 'Maximum balance overloaded. You can own a maximum of 1000M of ETH in your account.'
            ]);
        }
        $user->balance = $newBalance;
        $user->update();
        return back();
    }

    public function sortByBalance(Request $request)
    {
        if ($request->sortByBalance == 0) {
            $users = User::orderBy('balance', 'ASC')->paginate(5);
        } elseif ($request->sortByBalance == 1) {
            $users = User::orderBy('balance', 'DESC')->paginate(5);
        } else {
            $users = User::paginate(5);
        }

        return view('users.list')->with('users', $users);
    }

    public function sortByName(Request $request)
    {
        if ($request->sortByName == 0) {
            $users = User::orderBy('name', 'ASC')->paginate(5);
        } elseif ($request->sortByName == 1) {
            $users = User::orderBy('name', 'DESC')->paginate(5);
        } else {
            $users = User::paginate(5);
        }

        return view('users.list')->with('users', $users);
    }
}
