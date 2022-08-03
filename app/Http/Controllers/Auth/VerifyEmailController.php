<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerifyEmailController extends Controller
{
    public function verify($key)
    {
        $user = User::where('password', $key)->first();
        if (!$user) {
           abort('500'); 
        }
        if($user->email_verified_at == null){
            $user->update([
                'email_verified_at' => now(),
            ]);
        }

        return redirect()->route('login');
    
    }
}
