<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Model\RecoverCode;
use App\User;
use App\Helpers\AppHelper;
use App\Helpers\Sms;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function sendCode(Request $request) {

            $codeSend = false;

            $request->phone = !empty($request->recover_phone) ? AppHelper::normalizePhone($request->recover_phone) : null;
            
            if(!User::where('phone', $request->phone)->count()) {
                    return response()->json([
                        'errors' => ['phone' => ['Введенный номер телефона не зарегистрирован в системе']]
                    ], 422);
            }
            
            $prevRecoverCode = RecoverCode::lastCode($request->phone);

            if(!empty($prevRecoverCode) && AppHelper::diffInMinutes($prevRecoverCode->created_at) < 1) {
                    return response()->json([
                        'errors' => ['time' => ['Повторите попытку через 1 мин']]
                    ], 422);
            }

            $code = AppHelper::getCode();
            $recoverCode = new RecoverCode();
            $recoverCode->code = $code;
            $recoverCode->phone = $request->phone;

            if($recoverCode->save()) {
                    try {
                            Sms::instance()->send($recoverCode->phone, 'Код востановления пароля: '.$code);
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

            return response()->json($response);
    }
    
    public function setPassword(Request $request) {

            $codeSend = 400;
            
            $request->phone = !empty($request->phone) ? AppHelper::normalizePhone($request->phone) : null;

            $user = User::where('phone', $request->phone)->first();

            if(empty($user)) {
                    return response()->json([
                        'errors' => ['phone' => ['Введенный номер телефона не зарегистрирован в системе']]
                    ], 422);
            }

            if(empty($request->password)) {
                    return response()->json([
                        'errors' => ['password' => ['Введите пароль']]
                    ], 422);
            }
            
            $recoverCode = RecoverCode::where('phone', $request->phone)->where('code', $request->recover_code)->first();

            if (empty($recoverCode)) {
                    return response()->json([
                            'errors' => ['not_found' => ['Код не найден']]
                    ], 422);
            } elseif ($recoverCode->used || AppHelper::diffInMinutes($recoverCode->created_at) > 30) {
                    return response()->json([
                            'errors' => ['code_expired' => ['Код просрочен или уже был использован']]
                    ], 422);
            }

            $user->password = \Hash::make($request->password);
            if($user->save()) {
                    $recoverCode->used = 1;
                    $recoverCode->save();
                    return response()->json([
                            'messages' => ['error' => ['Пароль успешно изменен']],
                    ], 200);
            }

            return response()->json([
                    'errors' => ['error' => ['Ошибка. Обратитесь к администратору']]
            ], 400);
    }
}
