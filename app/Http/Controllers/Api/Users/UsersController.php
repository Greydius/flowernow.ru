<?php

namespace App\Http\Controllers\Api\Users;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Model\City;
use App\Model\Product;
use App\Model\ProductType;

/**
 * @group User
 */

class UsersController extends Controller
{
        /**
         * @response {
    "id": 427,
    "name": null,
    "email": "a.elcheninov@mail.ru",
    "confirmed": 1,
    "confirmation_code": "ODv6zUdE9v9B4nrVHy9V19tRRik15h",
    "created_at": "2019-11-01 00:00:00",
    "updated_at": "2020-02-08 22:00:40",
    "phone": "+79052122383",
    "admin": 0,
    "firebase_token": "e7hLQtpdx74:APA91bGTDwvnkH_b54g0uOsaqjsQ9vgVV3WVJdqjyRzU8SH-LjmL3VDuvNEm5swl026KiUn2tL2SpPaeCAJWY4uCkBLVWDaXTQSzoHnhho312U2hSrGXOfR-52aHLOIRhl9DKvBIN3Kv"
}
         */
        public function user(Request $request) {
            return $request->user();
        }
        public function addFirebaseToken(Request $request) {
                  $user = $request->user();
                  if(!empty($request->token)) {
                          $user->firebase_token = $request->token;
                          return $user->save();
                  }

                  return false;
          }
}