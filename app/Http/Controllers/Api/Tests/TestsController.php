<?php

namespace App\Http\Controllers\Api\Tests;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Model\City;
use App\Model\Shop;
use App\Model\Region;
use App\Model\Product;
use App\Model\SingleProduct;
use App\Model\ProductType;

/**
 * @group Tests
 */

class TestsController extends Controller
{
        public function cities() {
                $regions = Region::with('cities')->get();

                $results = [];
                $i = 0;
                foreach($regions as $region) {
                  foreach($region['cities'] as $k => $city) {
                    if($city->slug !== null && $i < 300 ) {
                    if($i >= 250){

                      $url = 'https://api.beget.com/api/domain/changePhpVersion';
                      $data = array(
                        'login' => 'mihast6k', 
                        'passwd' => 'RPdNV5Q&',
                        'input_format' => 'json',
                        'output_format' => 'json',
                        'input_data' => json_encode(
                          array(
                            'full_fqdn' => $city['slug'] . '.floristum.com',
                            'php_version' => '7.1'
                          )
                        )
                      );

                      // use key 'http' even if you send the request to https://...
                      $options = array(
                          'http' => array(
                              'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                              'method'  => 'POST',
                              'content' => http_build_query($data)
                          )
                      );
                      $context  = stream_context_create($options);
                      $result = file_get_contents($url, false, $context);
                      $results[] = $result;
                    }
                      $i++;
                    }
                  }

                }
                return $results;
        }

        public function createShops(Request $request) {
          $cities = json_decode($request->cities);

          foreach($cities as $city) {
            $user = new User;
            $user->email = $city->id . '@mail.ru';
            $user->confirmed = 1;
            $user->confirmation_code = 'eGSbgWeVWdGz9YPQVxhoesx2wIigFq';
            $user->password = Hash::make($city->id);
            $user->remember_token = '2um2fbjpriCrnrAegny22fpBKdobKLvsDHWl0fRzdBnRZ9Zk9lgT1w0hsd2N';
            $user->phone = '+79619' . $city->id;
            $user->admin = 0;

            $user->save();

            $shop = new Shop();
            $shop->name = $city->name . 'ФЛ';
            $shop->email = $city->id . '@mail.ru';
            $shop->city_id = $city->id;
            $shop->phone = '+79619' . $city->id;
            $shop->contact_phone = '+7961' . $city->id;
            $shop->logo = '/uploads/shops/380/logo_380_1533033588.jpg';
            $shop->about = 'Всегда в наличии большой выбор цветов. Авторские букеты, композиции, цветы в шляпных коробках, подарочные корзины, корзины  с фруктами, чаем, кофе. Гелиевые и воздушные шары. Свадебная флористика, букеты невесты.';
            $shop->delivery_price = 200.00;
            $shop->delivery_time = 120;
            $shop->delivery_out = 1;
            $shop->delivery_out_max = 300;
            $shop->delivery_out_price = 25;
            $shop->org_name = 'ООО «Бутон»';
            $shop->rs = '40702810311010130632';
            $shop->bank = 'в Филиал "Бизнес "ПАО "Совкомбанк"';
            $shop->bik = 'БИК 044525058';
            $shop->ks = '30101810045250000058';
            $shop->inn = '2222863668';
            $shop->kpp = '222201001';
            $shop->ogrn = '1172225045904';
            $shop->org_address = 'г.Барнаул ул.Попорва 123-231';
            $shop->director = 'Горских Анна Валерьевна';
            $shop->osnovanie = 'устава';
            $shop->round_clock = 0;
            $shop->active = 0;
            $shop->balance = -180.00;
            $shop->delivery_free = 0;
            $shop->copy_id = 350;
            $shop->save();

            $user->shops()->attach($shop->id);
          }

          return 'success';
        }

        public function deleteShops(Request $request) {
          $users = User::where('confirmation_code', '=', 'eGSbgWeVWdGz9YPQVxhoesx2wIigFq')->with('shops')->get();
          foreach($users as $user) {
            $user->delete();
          }

          return 'success';
        }

        public function updateShop($id) {
          $shop = Shop::find($id);
          $shop->active = $shop->active == 1 ? 0 : 1;
          $shop->save();

          return 'success';
        }

        public function createProducts() {
          $shops = Shop::where('copy_id', '=', 350)->get();
          $products = Product::where('shop_id', '=', 350)->get();
          foreach($shops as $shop) {
              foreach($products as $product){
                $newProduct = $product->replicate();
                $newProduct->shop_id = $shop->id;
                $newProduct->copy_id = $product->id;
                $newProduct->save();
              }
          }

          return 'success';
        }
}