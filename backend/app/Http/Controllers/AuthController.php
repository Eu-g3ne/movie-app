<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  //

  public function register(RegisterRequest $request)
  {
    try {
      $user = User::create($request->validated());
      return response()->json([
        'message' => 'User registered'
      ], 201);
    } catch (Throwable $e) {
      return response()->json([
        'message' => $e
      ], 500);
    }
  }

  public function login(LoginRequest $request)
  {
    try {
      if (auth()->check()) {
        return response()->json(['message' => 'Already authenticated'], 403);
      }
      $credentials = $request->validated();
      if (auth()->attempt($credentials, true)) {
        $user = $request->user();
        $token = $user->createToken('api')->plainTextToken;
        // $request->session()->regenerate();
        return response()->json([
          'message' => 'Authenticated whasap'
        ]);
      }
      return response()->json([
        'message' => 'Unauthenticated'
      ]);
      return response()->json();
    } catch (Throwable $e) {
      report($e);
      return response()->json(['message' => $e], 500);
    }
  }

  public function logout(Request $request)
  {
    // auth()->user()->tokens()->delete(); // not a error, just stupid intelephense
    auth()->guard('web')->logout();
    $request->session()->invalidate();

    $request->session()->regenerateToken();
    return response()->json([
      'message' => 'Logged out'
    ], 200);
  }
}
