<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  // Validation rules
  protected function userValidationRules()
  {
    return [
      'firstname' => 'required|string|max:25',
      'lastname' => 'required|string|max:25',
      'type' => 'required|in:Writer,Editor',
      'status' => 'required|in:Active,Inactive',
    ];
  }

  // Retrieve all users
  public function index()
  {
    return User::all();
  }

  // Store a new user
  public function store(Request $request)
  {
    // Define validation rules
    $rules = $this->userValidationRules();

    // Validate the request using the Validator facade
    $validator = Validator::make($request->all(), $rules);

    // Check if validation fails
    if ($validator->fails()) {
      return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    $user = User::create($request->all());

    return response()->json($user, Response::HTTP_CREATED);
  }

  // Retrieve a specific user by ID
  public function show($id)
  {
    $user = User::find($id);

    if (!$user) {
      return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
    }

    return response()->json($user);
  }

  // Update an existing user
  public function update(Request $request, $id)
  {
    // Define validation rules
    $rules = $this->userValidationRules(true);

    // Validate the request
    $validator = Validator::make($request->all(), $rules);

    // Check if validation fails
    if ($validator->fails()) {
      return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    $user = User::find($id);
    if (!$user) {
      return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
    }

    $user->update($request->all());
    return response()->json($user);
  }


  // Delete a user
  public function destroy($id)
  {
    $user = User::find($id);

    if (!$user) {
      return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
    }

    $user->delete();

    return response()->json(['message' => 'User deleted successfully'], Response::HTTP_NO_CONTENT);
  }
}
