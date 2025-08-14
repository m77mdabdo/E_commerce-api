<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //

    public function all()
    {
        $users = User::paginate(3);

        return view('admin.employe.alluser', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        // dd($user);
        return view('admin.employe.show', compact('user'));
    }

    public function create()
    {
        return view('admin.employe.create');
    }

    public function store(Request $request)
    {
        $validtion = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,admin',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users', 'public');
            $validtion['image'] = $imagePath; // Store the path in the data array
        }
        $validtion['password'] = bcrypt($validtion['password']); // Hash the password

        User::create($validtion);

        return redirect()->route('allUsers')->with('success', 'User created successfully!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.employe.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validation = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:user,admin',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'

        ]);


        // $path = $user->image;
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            // Upload the new image
            $imagePath = $request->file('image')->store('users', 'public');
            $validation['image'] = $imagePath;
        } else {
            // Keep the old image if no new one uploaded
            $validation['image'] = $user->image;
        }

        if (!empty($validation['password'])) {
        $validation['password'] = bcrypt($validation['password']);
    } else {

        unset($validation['password']);
    }


        $user->update($validation);


        session()->flash("success", "Data updated successfully");

        return redirect()->route('showUser', $user->id)->with('success', 'Data updated successfully');

    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }
        $user->delete();
        session()->flash("success", "User deleted successfully");
        return redirect()->route('allUsers');
    }
}
