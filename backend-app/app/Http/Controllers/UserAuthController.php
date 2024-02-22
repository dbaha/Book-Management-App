<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\User;
use Carbon\Carbon;

class UserAuthController extends Controller
{
    public function register(Request $request){
        $registerUserData = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|min:8'
        ]);
        $user = User::create([
            'name' => $registerUserData['name'],
            'email' => $registerUserData['email'],
            'password' => Hash::make($registerUserData['password']),
        ]);
        return response()->json([
            'message' => 'User Created ',
        ]);
    }
    public function login(Request $request){
        $loginUserData = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|min:8'
        ]);
        $user = User::where('email',$loginUserData['email'])->first();
        if(!$user || !Hash::check($loginUserData['password'],$user->password)){
            return response()->json([
                'message' => 'Invalid Credentials'
            ],401);
        }
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
        return response()->json([
            'access_token' => $token,
        ]);
    }
    public function logout(Request $request)
    {
        $user= auth()->user();
        
        if($user){
            $user->tokens()->delete();
            return response()->json([
                'User' => $user,
                'status' => 'success',
                'message' => 'User is logged out successfully'
                ], 200);
        }
        return response()->json([
            'error' => 'Unauthenticated',
        ], 401);
    }   
    public function tokenExpirationTimeLeft(Request $request)
    {
        $user = $request->user(); // Get the authenticated user

        if ($user) {
            $latestToken = $user->tokens()->latest()->first();
            if($latestToken){
                $tokenExpiresAt = $latestToken->expires_at;
                $now = Carbon::now();

                $minutesLeft = $now->diffInMinutes($tokenExpiresAt);

                return response()->json([
                    'minutes_left' => $minutesLeft,
                ]);
            } else {
            return response()->json([
                'error' => 'No tokens found for the user',
            ], 400);
            }
        }

        return response()->json([
            'error' => 'Unauthenticated',
        ], 401);
    }
}
