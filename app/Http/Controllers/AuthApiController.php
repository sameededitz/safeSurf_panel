<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Models\User;

class AuthApiController
{
    public function loginWithGoogle(Request $request)
    {
        $token = $request->input('access_token');

        $googleUser = Socialite::driver('google')
            ->stateless()
            ->userFromToken($token);

        $user = User::updateOrCreate([
            'email' => $googleUser->getEmail(),
        ], [
            'name' => $googleUser->getName(),
            'google_id' => $googleUser->getId(),
            'avatar' => $googleUser->getAvatar(),
        ]);

        $authToken = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $authToken,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    public function loginWithApple(Request $request)
    {
        $token = $request->input('access_token');

        $appleUser = Socialite::driver('apple')
            ->stateless()
            ->userFromToken($token);

        $user = User::updateOrCreate([
            'email' => $appleUser->getEmail(),
        ], [
            'name' => $appleUser->getName() ?? 'Apple User',
            'apple_id' => $appleUser->getId(),
        ]);

        $authToken = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $authToken,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }
}
