<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return response()->json(['user' => $user], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePassword(Request $request, string $id)
    {
        // Retrieve the authenticated user
        $authUser = $request->user();
        // Check if the authenticated user matches the user whose password is being updated
        if ($authUser->id !== (int)$id) {
            return response()->json(['error' => 'Unauthorized. You can only update your own password.'], 403);
        }
    
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        $user = User::findOrFail($id);
        $user->update([
            'password' => bcrypt($request->input('password')),
        ]);
    
        return response()->json(['message' => 'Password updated successfully']);
    }
    
    
    public function updateEmail(Request $request, string $id)
    {
        // Retrieve the authenticated user
        $authUser = $request->user();
    
        // Check if the authenticated user matches the user whose email is being updated
        if ($authUser->id !== (int)$id) {
            return response()->json(['error' => 'Unauthorized. You can only update your own email.'], 403);
        }
    
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        $user = User::findOrFail($id);
        $user->update([
            'email' => $request->input('email'),
        ]);
    
        return response()->json(['message' => 'Email updated successfully']);
    }
    /**
     * 
     * Update Profile Image*/ 
    
    public function updateImage(Request $request, string $id)
{
    // Retrieve the authenticated user
    $authUser = $request->user();

    // Check if the authenticated user matches the user whose image is being updated
    if ($authUser->id !== (int)$id) {
        return response()->json(['error' => 'Unauthorized. You can only update your own image.'], 403);
    }

    $validator = Validator::make($request->all(), [
        'image' => 'required|image|mimes:jpg,bmp,png|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    $user = User::findOrFail($id);

    // Handle image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        
        // Update user's image path in the database
        $user->image = $imageName;
        $user->save();
    }

    return response()->json(['message' => 'Image updated successfully']);
}

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
