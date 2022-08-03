<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\Api\PasswordReset;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function passwordResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return response()->json('User Not Found', 500);
        }
        
        $token = Str::random(50);
        
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
        ]);
        // return response()->json($token, 200);

        Mail::to($user->email)->send(new PasswordReset($user, $token));

        return response()->json([
            'message' => 'Password Reset Link Sent to Your Email',
        ], 200);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'token' => ['required'],
            'password' => ['required', 'confirmed'],
        ]);

        $email = DB::table('password_resets')->select('email')->where('email', $request->email)->where('token', $request->token)->first();

        
        $user = User::where('email', $email->email)->first();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        DB::table('password_resets')->where('email', $request->email)->delete();

        return response()->json([
            'message' => $user->email.' password has been updated'
        ], 200);

    }
}
