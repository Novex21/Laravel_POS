<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator(request()->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,svg,gif|max:5120'
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->is_admin = $request->is_admin;
        if($request->hasFile('photo')) {
            $path = $request->file('photo')->store('userPhotos','public');
            $user->photo = $path;
        }else {
            $path = 'userPhotos/profile_default.jpeg';
            $user->photo = $path;
        }
        $user->save();

        return redirect(route('users.index'))->with('Success', 'User Created Successfully');


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
    public function edit(User $user)
    {
        if (! $user) {
            return back()->with('Error','User Not Found');
        }
        return view('users.edit',[
            'user' => $user,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (! $user) return back()->with('Error','User Not Found');


        $validator = validator(request()->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,svg,gif|max:5120'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if($request->hasFile('photo')) {
            $path = $request->file('photo')->store('userPhotos','public');
            $user->photo = $path;
        }

        $user->update($request->all());
        return redirect(route('users.index'))->with('Success', 'User Updated Succeessfully');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

        if (! $user) {
            return back()->with('Error','User Not Found');
        }
        $user->delete();
        return back()->with('Success', 'User Deleted Succeessfully');


    }
}
