<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
class AuthController extends Controller
{
    public function login(Request $request){
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function getuser(Request $request){
        $user = auth('sanctum')->user();
        if($user){
            return response()->json([
                'status'    => true,
                'message'   => 'User Found Successfully',
                'data'      => $user
            ], 200);
        }else{
            return response()->json([
                'status'    => true,
                'message'   => 'User Not found',
                'data'      => ''
            ], 200);
        }
    }
    public function logout(Request $request){
        $user  = auth('sanctum')->user();
        if($user){
            $user->currentAccessToken()->delete();
            return response()->json([
                'status'    => true,
                'message'   => 'User Logged Out Successfully',
                'token'     => ''
            ], 200);
        }else{
            return response()->json([
                'status'    => false,
                'message'   => 'Token Not Found!',
                'token'     => ''
            ], 404);
        }
        
    }
}
