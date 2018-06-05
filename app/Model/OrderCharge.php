<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderCharge extends Model
{
    //
        public static $chargeRules = [
                'amount' => 'required | integer',
                'order_id' => 'required | integer',
                'description' => 'required',
        ];

        public  static $chargeRulesMessages = [
                'amount.required' => 'Введите сумму',
                'amount.integer' => 'Сумма платежа не правильная',
                'order_id.required' => 'Заказ не выбран',
                'order_id.integer' => 'Заказ не правильный',
                'description.required' => 'Введите назначение платежа',
        ];

        public function createBill() {
                $return = [
                        'success' => false,
                        'message' => 'Ошибка. Попробуйте позже или обратитесь к администратору'
                ];
                
                $client = new \GuzzleHttp\Client();

                $form_params = [
                        'Amount' => $this->amount,
                        'Currency' => 'RUB',
                        'Description' => $this->description,
                        'InvoiceId' => $this->order_id . '-' . $this->id
                ];

                if(!empty($this->email)) {
                        $form_params['Email'] = $this->email;
                        $form_params['SendEmail'] = 'true';
                }

                if(!empty($this->phone)) {
                        $form_params['Phone'] = $this->phone;
                        $form_params['SendSms'] = 'true';
                }

                $res = $client->request('POST', 'https://api.cloudpayments.ru/orders/create', [
                        'auth' => [
                                \Config::get('cloudpayments.publicId'),
                                \Config::get('cloudpayments.pwd')
                        ],
                        'form_params' => $form_params
                ]);
                
                if($res->getStatusCode() == 200) {
                        $decoded_traces = json_decode($res->getBody());
                        if($decoded_traces->Success) {
                                $return['success'] = true;
                                $return['message'] = '';
                                $this->url = $decoded_traces->Model->Url;
                                $this->details = serialize($decoded_traces);
                                $this->save();
                        } else {
                                $return['message'] = $decoded_traces->Message;
                        }
                }

                return $return;
        }
}
