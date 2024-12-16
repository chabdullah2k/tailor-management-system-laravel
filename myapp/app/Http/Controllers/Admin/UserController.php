<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.user', compact('users'));
    }


    public function create()
    {
        return view('admin.usercreate');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:users,phone|max:15',
            'username' => 'required|string|unique:users,username|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8',
            'salary' => 'required|numeric|min:0',
            'permissions' => 'array',
        ]);
        $user = new User();
        $user->name = $validated['name'];
        $user->phone = $validated['phone'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->salary = $validated['salary'];
        $user->active = $request->has('active') ? true : false;
        $user->permissions = $validated['permissions'] ?? [];
        $user->save();

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }





    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.userupdate', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:users,phone,' . $user->id . '|max:15',
            'username' => 'required|string|unique:users,username,' . $user->id . '|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id . '|max:255',
            'password' => 'nullable|string|min:8',
            'salary' => 'required|numeric|min:0',
            'permissions' => 'array',
        ]);

        $user->name = $validated['name'];
        $user->phone = $validated['phone'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->salary = $validated['salary'];
        $user->active = $request->has('active') ? true : false;
        $user->permissions = $validated['permissions'] ?? [];
        $user->save();

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }


        public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }

}

