<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class VerifyEmailController extends Controller
{
    public function verify($keyName, $keyEmail)
    {

        $user = User::where('email', Crypt::decryptString($keyEmail))->where('name', Crypt::decryptString($keyName))->first();
        if (!$user) {
           return response()->json('User Not Found', 500);
        }
        if($user->email_verified_at == null){
            $user->update([
                'email_verified_at' => now(),
            ]);
        }

        return response()->json('Success, Email Has Been Verified', 200);
    
    }
}
