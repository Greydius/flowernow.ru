<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
        /**
         * Handle the incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function __invoke(Request $request)
        {

                
                $credentials = $request->only('phone', 'password');

                if (!Auth::attempt($credentials)) {
                        return response()->json([
                                'message' => 'You cannot sign with those credentials',
                                'errors' => 'Unauthorised'
                        ], 401);
                }

                $user =  Auth::user();

                $token = $user->createToken(config('app.name'));
                $token->token->expires_at = $request->remember_me ?
                        Carbon::now()->addMonth() :
                        Carbon::now()->addDay();

                $token->token->save();

                return response()->json([
                        'token_type' => 'Bearer',
                        'token' => $token->accessToken,
                        'shop' => $user->getShop(),
                        'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString()
                ], 200);
        }
}