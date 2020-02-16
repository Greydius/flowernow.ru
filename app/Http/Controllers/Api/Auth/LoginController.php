<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

/** 
 * @group Auth
 * 
 * Auth actions
*/

class LoginController extends Controller
{
        /**
         * Login
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         * @response {
    "token_type": "Bearer",
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjAzNGI3NDI4OTQ4OTJlOTVmMzYwNDc0ZGJkMGNjN2M3Yjg3MzJhMTM0MGQyYzU0ODJkZWE4YWYwYjU3NGE2NmIxOTViMTViYWQ5ZmFhZThmIn0.eyJhdWQiOiIxIiwianRpIjoiMDM0Yjc0Mjg5NDg5MmU5NWYzNjA0NzRkYmQwY2M3YzdiODczMmExMzQwZDJjNTQ4MmRlYThhZjBiNTc0YTY2YjE5NWIxNWJhZDlmYWFlOGYiLCJpYXQiOjE1ODE4Mzg5NTQsIm5iZiI6MTU4MTgzODk1NCwiZXhwIjoxNjEzNDYxMzU0LCJzdWIiOiI0MjciLCJzY29wZXMiOltdfQ.nVVvZR9FtEYh6sV0Bm_oU-6eR6YAZ6aUPbjBeTlyouvK7zMypAhoo0ds12uyfEbEpZ2qgy2VT4iz9JjWEGaC_HVtc4OAKNjyV-iLMPuIjBrmyvRQ20RGf22u2bYa3j9KUaWqHwhauwckZwyUzjBFPcGPXZEwlJQt1VvvKUoIYDe7kLCJ6jwgmqbXOl9KqHV-tdTYNJsvPpCn5cwxOYpzWegcTjpxlsnYrsVkR3Vjm_rw0B8zRlJYoKDVMfnMLz3QA9yBKoUnSc83XRc7nDFseT6KHuDauE-Wt_-Qt2lsgsi9xdWkR6vsubo3P2qqL0SpkBLmXoqKckbWa5QFzIeN_94o_tHRG5RoTcKq16ynSSUjpwCuZhU9FGLAQw3fo_vclUCIjpbgutoMAGOqw6rmBwPmbqE6XXLsXf8IcJOMDZ-KkX1cCNld51BItNhV2gLQqkOe5NN5pWr8xcOC5me8P_NgACbJDRhWfFfaSZkesBtAynEuzqQT8ixzKqdkMS975huJyPsAa1q-LlA3Zzw1cX7on8N9tgId6qveDYRX-Wt97nTDbjHDOT2McW3b9EZ6CY55cvEqcV9met5-aRBT_BfPZDJts9znIC0apcDRaI8ttEw0ivABxQVKSui5fw8SuJ6tDQeNgbB-7dbbgPAsNx9eluwazchreo5v8PGDaGA",
    "shop": {
        "id": 397,
        "name": "SEATTLE",
        "logo": null,
        "photo": null,
        "about": "Цветы",
        "city_id": 645450,
        "contact_phone": "+7(905)212-23-83",
        "site": null,
        "vk": null,
        "ok": null,
        "fb": null,
        "instagram": null,
        "youtube": null,
        "delivery_price": "0.00",
        "delivery_time": 0,
        "delivery_out": 1,
        "delivery_out_max": 0,
        "delivery_out_price": "0.00",
        "round_clock": 0,
        "active": 1,
        "delivery_free": 1,
        "pivot": {
            "user_id": 427,
            "shop_id": 397
        }
    },
    "expires_at": "2020-02-17 10:42:34"
}
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