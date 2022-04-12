<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\AppHelper;
use App\Helpers\Sms;
use App\Model\City;
use App\Model\RegisterCode;
use App\Model\Shop;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/shop';

    private  static $messages = [
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

            'agree.required' => 'Вы не приняли условия публичной оферты',

            'city_id.required' => 'Выберите город',
            'city_id.integer' => 'Выберите город'
    ];

    private  static $messagesCode = [
            'code.required' => 'Введите код'
    ];

    private  static $rulesCode = [
            'code' => 'required',
    ];

    private  static $rules = [
            'phone' => 'required|string|max:17|min:12|unique:users',
            'city_id' => 'required|integer',
            'shop_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'agree' => 'required'
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function redirectTo() {
            return route('admin.products');
    }

    public function showRegistrationForm()
    {

        return view('auth.register', [
                'cities' => City::all()
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, $rules = [], $messages = [])
    {
            $rules = !empty($rules) ? $rules : self::$rules;
            $messages = !empty($messages) ? $messages : self::$messages;
            return Validator::make($data, $rules, $messages);
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
                'phone' => $data['phone'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'confirmation_code' => $data['confirmation_code']
        ]);
    }

    public function register(Request $request)
    {
            $request->phone = !empty($request->phone) ? AppHelper::normalizePhone($request->phone) : null;
            //$this->validator($request->all())->validate();
        $validation = $this->validator($request->all(), array_merge(self::$rules, self::$rulesCode), array_merge(self::$messages, self::$messagesCode));

        if($request->ajax()) {
                if( $validation->fails()) {
                        return response()->json([
                                'errors' => $validation->errors()->getMessages()
                        ], 422);
                }
        } else {
                $validation->validate();
        }

        $registerCode = RegisterCode::where('phone', $request->phone)->where('code', $request->code)->first();

        if(empty($registerCode)) {
                return response()->json([
                        'errors' => ['not_found' => ['Код не найден']]
                ], 422);
        } elseif ($registerCode->used || AppHelper::diffInMinutes($registerCode->created_at) > 30) {
                return response()->json([
                        'errors' => ['code_expired' => ['Код просрочен или уже был использован']]
                ], 422);
        }

        $confirmation_code = str_random(30);

        $request->merge(['phone' => AppHelper::normalizePhone($request->phone)]);

        event(new Registered($user = $this->create(array_merge(['confirmation_code' => $confirmation_code], $request->all()))));

        //$this->guard()->login($user);

            if($user) {
                    $shop = new Shop();
                    $shop->name = Input::get('shop_name');
                    $shop->email = Input::get('email');
                    $shop->city_id = Input::get('city_id');
                    $shop->phone = $user->phone;
                    $shop->contact_phone = $user->phone;
                    $shop->save();
                    $user->shops()->attach($shop->id);

                    $this->guard()->login($user);

                    $registerCode->used = 1;
                    $registerCode->save();

                    Mail::send('email.verify', ['confirmation_code' => $confirmation_code], function($message) {
                        $message->to(Input::get('email'), Input::get('username'))
                        ->subject('Verify your email address');
                    });
            }

            \Session::flash('layoutWarning', ['type' => 'success', 'text' => 'Спасибо за регистрацию!']);

        if($request->ajax()) {
                return response()->json([
                        'message' => 'Спасибо за регистрацию!',
                        'url' => route('admin.shop.profile')
                ]);
        }

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    public function verify($code) {
            $user = User::where('confirmation_code', $code)->first();
            if($user && !$user->confirmed) {
                    $user->confirmed = 1;
                    $user->save();
            }

            return Redirect::route('admin.shop.profile');
    }

    public function checkData (Request $request) {

            $request->phone = !empty($request->phone) ? AppHelper::normalizePhone($request->phone) : null;


            if(User::where('phone', $request->phone)->count()) {
                    return response()->json([
                        'errors' => ['phone' => ['Введенный номер телефона уже зарегистрирован в системе']]
                    ], 422);
            }

            $codeSend = config('app.debug') ? true : false;
            $validation = $this->validator($request->all());

            if( $validation->fails()) {
                    return response()->json([
                        'errors' => $validation->errors()->getMessages()
                    ], 422);
            }

            $prevRegisterCode = RegisterCode::lastCode($request->phone);

            if(!empty($prevRegisterCode) && AppHelper::diffInMinutes($prevRegisterCode->created_at) < 1) {
                    return response()->json([
                        'errors' => ['time' => ['Повторите попытку через 1 мин']]
                    ], 422);
            }

            $code = AppHelper::getCode();
            $registerCode = new RegisterCode();
            $registerCode->code = $code;
            $registerCode->phone = $request->phone;

            if($registerCode->save() && !config('app.debug')) {
                    try {
                            Sms::instance()->send($registerCode->phone, 'Код регистрации магазина: '.$code);
                            $codeSend = true;
                    } catch (Exception $e) {
                            return response()->json([
                                'errors' => ['time' => ['Ошибка отправки СМС']]
                            ], 422);
                    }
            }

            $response = [
                    'message' => config('app.debug') ? null : '',
                    'code' => $codeSend
            ];

            if(config('app.debug')) {
                    $response['code_value'] = $code;
            }

            return response()->json($response);
    }
}
