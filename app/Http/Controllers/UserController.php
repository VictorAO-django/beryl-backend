<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

    /**
     * @group Users
     * 
     */
class UserController extends Controller
{
    /**
     * Get a list of users.
     * 
     * @response 200 {
     *      "id": 1,
     *      "name: "John Doe",
     *      "email": "john@example.com"
     * }
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "first_name" => "string|required|max:255",
            "last_name" => "string|required|max:255",
            "email" => "required|email|unique:users",
            "password" => "required|string|min:8",
        ]);
        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);

        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'first_name'=> 'sometimes|required|string|max:255',
            'last_name'=> 'sometimes|required|string|max:255',
        ]);

        $user->update($validated);
        return response()->json($user);
    }
}
