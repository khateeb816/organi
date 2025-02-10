<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            $user = User::updateOrCreate(
                ['email' => $socialUser->getEmail()],
                [
                    'name' => $socialUser->getName(),
                    "{$provider}_id" => $socialUser->getId(), // Dynamic field for provider
                    'password' => bcrypt(uniqid()),
                ]
            );

            Auth::login($user);

            return redirect('/');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Failed to login with ' . ucfirst($provider) . '.');
        }
    }
}
