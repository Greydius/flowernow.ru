<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/** 
 * @group Auth
 * 
 * Auth actions
*/

class LogoutController extends Controller
{
  /** 
   * Logout
   * 
   * @response {
    "message": "You are successfully logged out"
}
  **/
        public function __invoke(Request $request)
        {
                $request->user()->token()->revoke();

                return response()->json([
                        'message' => 'You are successfully logged out',
                ]);
        }
}