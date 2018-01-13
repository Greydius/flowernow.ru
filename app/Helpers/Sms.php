<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 04.01.2018
 * Time: 20:17
 */

namespace App\Helpers;


class Sms {

        private $sever, $password, $login, $name;

        function __construct() {
                $this->sever = \Config::get('sms.server');
                $this->login = \Config::get('sms.login');
                $this->password = \Config::get('sms.pwd');
                $this->name = \Config::get('sms.name');
        }

        public function send($phone, $text) {
                $session = $this->GetSessionId_Post($this->sever, $this->login, $this->password);
                return $this->SendSms($this->sever, $session, $this->name, $this->normalizePhone($phone), $text);
        }

        private function normalizePhone($phone) {
                $plusPosition = strpos($phone, '+');
                return $plusPosition === false ? $phone : str_replace('+', '', $phone);
        }


        private function SendSms($server, $session, $sourceAddress, $destinationAddress, $data, $validity = 1440, $sendDate = ' '){

                $href = $server.'Send/SendSms/';

                if($sendDate != ' ') {
                        $sendDate = '&sendDate='.$sendDate;
                }

                $src = 'sessionId='.$session.
                        '&sourceAddress='.$sourceAddress.
                        '&destinationAddress='.$destinationAddress.
                        '&data='.$data.
                        '&validity='.$validity.$sendDate;

                $result = $this->PostConnect($src, $href);

                return json_decode($result,true);

        }

        private function PostConnect($src, $href){

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/x-www-form-urlencoded']);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                curl_setopt($ch, CURLOPT_CRLF, true);

                curl_setopt($ch, CURLOPT_POST, true);

                curl_setopt($ch, CURLOPT_POSTFIELDS, $src);

                curl_setopt($ch, CURLOPT_URL, $href);

                $result = curl_exec($ch);

                curl_close($ch);

                return $result;

        }

        private function GetSessionId_Post($server, $login, $password){

                $href = $server.'Session/session.php';

                $src = 'login='.$login.'&password='.$password;

                $result = $this->PostConnect($src, $href);

                return json_decode($result,true);


        }

        public static function instance() {
                return new self();
        }
}