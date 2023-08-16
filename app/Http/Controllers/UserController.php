<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdatePasswordRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function register(UserRegisterRequest $request)
    {
        $validated = $request->validated();
        $adopterRole = Role::where('name', '=', 'Adopter')->first();

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->role_id = $adopterRole->id;

        $user->save();
        $status = "User registered successfully";

        Auth::login($user);

        return redirect()->route('home')->with('status', $status);
    }


    public function getLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user = User::where('email', '=', $request->input()['email'])->first();
        if ($user != null) {
            if (Hash::check($request->input()['password'], $user->password)) {
                Auth::login($user);
                $status = "Login successfully";

                if ($user->role == "Admin") {
                    return redirect('/admin');
                } else {
                    return redirect()->route('home')->with('status', $status);
                }
            }
        }

        $error = "Wrong email or password";
        return redirect()->back()->with('error', $error);
    }


    public function logout()
    {
        Auth::logout();
        $status = "Logout successfully";
        return redirect()->route('home')->with('status', $status);
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
    }


    public function profile()
    {

        $user = User::where('id', '=', Auth::user()->id)->with('adopted')->first();
        // dd($user->adopted);
        return view('auth.profile', ['user' => $user]);
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

    public function profileUpdate(UserUpdateRequest $request)
    {


        $user = User::where('id', '=', Auth::user()->id)->first();

        $user->email = $request->get('email');
        $user->name = $request->get('name');
        $user->save();

        if (count($request->file()) >= 1) {
            $image = $request->file()['image'];
            $user->clearMediaCollection('avatars');
            $user->addMedia($image)->toMediaCollection('avatars');
        }



        return view('auth.profile', ['user' => $user]);
    }

    public function getUpdatePassword()
    {
        return view('auth.password');
    }

    public function updatePassword(UserUpdatePasswordRequest $request)
    {
        $user = User::where('id', '=', Auth::user()->id)->first();


        if (Hash::check($request->get('old_password'), $user->password)) {
            $user->password = Hash::make($request->get('password'));
            $user->save();
            $status = "Password updated successfully";
            return redirect()->back()->with('status', $status);
        } else {
            $error = "Wrong email or password";
            return redirect()->back()->with('error', $error);
        }
        // return view('auth.password');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
