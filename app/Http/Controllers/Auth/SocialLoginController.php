<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;

class SocialLoginController extends Controller
{
    public function facebookpage()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookredirect()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);

                return redirect()->intended(['dashboard']);
            } else {
                $newUser = User::updatedOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'facebook_id' => $user->id,
                    'password' => encrypt('123456dummy'),
                ]);

                Auth::login($newUser);

                return redirect()->intended(['dashboard']);
            }
        } catch (Exception $e) {
            dd(\Log::error('Social Login Error: ' . $e->getMessage()));
        }
    }

    public function googlepage()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleredirect()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $findGUser = User::where('google_id', $google_user->getId())->first();

            if (!$findGUser) {
                $new_User = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                ]);

                Auth::login($new_User);

                return redirect()->intended(['dashboard']);
            } else {
                Auth::login($findGUser);
                return redirect()->intended(['dashboard']);
            }
        } catch (Exception $e) {
            dd(\Log::error('Social Login Error: ' . $e->getMessage()));
        }
    }
}

