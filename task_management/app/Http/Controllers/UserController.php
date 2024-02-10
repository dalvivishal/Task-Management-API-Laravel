<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class UserController extends Controller
{
    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Data',
                'data' => $validator->errors()
            ], 400);
        }

        if (!$token = Auth::attempt($validator->validated())) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Credentials.'
            ], 400);
        }

        $user = Auth::user();

        if (!$user->email_verified_at) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your Email is not verified.',
                'resend_email' => true
            ], 400);
        }

        $status_code = 200;
        $success_arr = [
            'status' => 'success',
            'message' => 'User Logged In Successfully!',
            'data' => $user
        ];
        return response()->json($success_arr, $status_code);
    }
}
