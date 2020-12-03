<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Helpers\AppHelper;
use App\Helpers\Sms;
use Illuminate\Support\Facades\Validator;

class ToAppController extends Controller
{

  private  static $messages = [
    'phone.required' => 'Введите телефон',
    'phone.unique' => 'Этот телефон уже зарегестрирован в системе',
    'phone.max' => 'Неверный формат телефона',
    'phone.min' => 'Неверный формат телефона'
  ];

  private  static $rules = [
    'phone' => 'required|string|max:17|min:15'
  ];

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

  public function redirect(Request $request) {
    $agent = $request->header('User-Agent');
    $iPod    = stripos($agent,"iPod");
    $iPhone  = stripos($agent,"iPhone");
    $iPad    = stripos($agent,"iPad");
    $Android = stripos($agent,"Android");

    if( $iPod || $iPhone || $iPad ){
      return redirect('https://apps.apple.com/ru/app/floristum/id1454760508');
    }else if($Android){
      return redirect('https://play.google.com/store/apps/details?id=ru.floristum.app&hl=en_US');
    }else {
      return redirect()->route('front.index');
    }
  }

  public function sendSMSUrl (Request $request) {

    $request->phone = !empty($request->phone) ? AppHelper::normalizePhone($request->phone) : null;

    $validation = $this->validator($request->all());

    if( $validation->fails()) {
      return response()->json([
          'errors' => $validation->errors()->getMessages()
      ], 422);
    }

    try {
            Sms::instance()->send($request->phone, 'Скачать приложение Floristum: https://floristum.ru/1');
    } catch (Exception $e) {
            return response()->json([
                'errors' => ['time' => ['Ошибка отправки СМС']]
            ], 422);
    }

    $response = [
            'message' => 'success'
    ];

    return response()->json($response);
    }
}