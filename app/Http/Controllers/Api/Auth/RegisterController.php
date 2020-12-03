<?php
namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterFormRequest;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Helpers\AppHelper;
use App\Helpers\Sms;
use App\Model\City;
use App\Model\RegisterCode;
use App\Model\Shop;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

/** 
 * @group Auth
 * 
 * Auth actions
*/

class RegisterController extends Controller
{

        /** 
         * Register
         * 
          * * 'phone' => 'required|string|max:16|min:11|unique:users',
          * * 'city_id' => 'required|integer',
          * * 'shop_name' => 'required|string|max:255',
          * * 'email' => 'required|string|email|max:255|unique:users',
          * * 'password' => 'required|string|min:6'
         * @response {
                "success": false,
                "error": {
                    "phone": [
                        "Этот телефон уже зарегестрирован в системе"
                    ],
                    "city_id": [
                        "Выберите город"
                    ],
                    "shop_name": [
                        "Введите название магазина"
                    ],
                    "email": [
                        "Введите email"
                    ]
                }
            }
        */
        
        public function __invoke(Request $request)
        {
                $messages = [
                        'phone.required' => 'Введите телефон',
                        'phone.unique' => 'Этот телефон уже зарегестрирован в системе',
                        'phone.max' => 'Неверный формат телефона',
                        'phone.min' => 'Неверный формат телефона',

                        'email.required' => 'Введите email',
                        'email.email' => 'Введите правильный email',
                        'email.unique' => 'Этот email уже зарегестрирован в системе',

                        'password.min' => 'Пароль должен быть не менее :min символов',
                        'password.confirmed' => 'Пароли не совпадают',
                        'password.required' => 'Введите пароль',

                        'shop_name.required' => 'Введите название магазина',

                        'city_id.required' => 'Выберите город',
                        'city_id.integer' => 'Выберите город'
                ];

                $rules = [
                        'phone' => 'required|string|max:16|min:11|unique:users',
                        'city_id' => 'required|integer',
                        'shop_name' => 'required|string|max:255',
                        'email' => 'required|string|email|max:255|unique:users',
                        'password' => 'required|string|min:6'
                ];

                if(!empty($request->phone)) {
                        $request->phone = AppHelper::normalizePhone($request->phone);
                }

                $input     = $request->only('name', 'email','password','phone', 'shop_name', 'city_id');
                $validator = Validator::make($input, $rules, $messages);

                if ($validator->fails()) {
                        return response()->json(['success' => false, 'error' => $validator->messages()]);
                }


                $confirmation_code = str_random(30);

                $user = User::create([
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                        'confirmation_code' => $confirmation_code
                ]);

                if($user) {
                        $shop = new Shop();
                        $shop->name = $request->shop_name;
                        $shop->email = $request->email;
                        $shop->city_id = $request->city_id;
                        $shop->phone = $user->phone;
                        $shop->contact_phone = $user->phone;
                        $shop->save();
                        $user->shops()->attach($shop->id);

                        $credentials = $request->only('phone', 'password');
                        Auth::attempt($credentials);
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

                return response()->json([
                        'message' => 'You were successfully registered. Use your email and password to sign in.'
                ], 200);
        }
}