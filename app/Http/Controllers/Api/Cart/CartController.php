<?php

namespace App\Http\Controllers\Api\Cart;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Model\Product;

class CartController extends Controller
{
  /**
    * @response {
      "product": {
          "id": 1886,
          "shop_id": 62,
          "name": "Букет номер четыре",
          "slug": "buket-nomer-chetyre",
          "price": 9920,
          "description": "Состав букета\nРоза 31шт\nРоза кустовая 15шт\nГиацинты 10шт\nХамелациум 10шт\n\nУпаковка: атласная лента(цвет на выбор)\n\nВозможна корректировка состава и упаковки по желанию клиента.(Упаковка без изменения стоимости: крафт-бумага, органза, фетр и т.д.). Уважаемые покупатели! Цветы являются сезонным товаром и могут находиться на складе в ограниченном количестве. Также качество цветов, поступающих от производителя, может быть не всегда приемлемым. В этом случае мы совершаем эквивалентную замену цветов, предварительно согласовав этот вопрос с вами. Мы гарантируем неизменность стоимости и цветовой гаммы букета в случае замены.",
          "photo": "p62_1519228779_42033.jpg",
          "make_time": 720,
          "width": 35,
          "height": 55,
          "dop": 0,
          "approved": 0,
          "color_id": 2,
          "product_type_id": 2,
          "status": 1,
          "status_comment": "\"Пожалуйста, заполните Профиль магазина, товары и сообщите о готовности получать заказы на service@floristum.ru\"",
          "pause": 0,
          "special_offer_id": null,
          "sort": 78786949,
          "single": null,
          "status_comment_at": null,
          "star": 1,
          "block_id": 2,
          "clientPrice": 13396,
          "url": "https://floristum.ru/flowers/buket-nomer-chetyre",
          "photoUrl": "/uploads/products/62/351x351_c/p62_1519228779_42033.jpg",
          "fullPrice": 13396,
          "deliveryTime": "12ч.",
          "shop": {
              "id": 62,
              "name": "Счастливые люди",
              "logo": "/uploads/shops/65/logo_65_1522151127.jpg",
              "photo": null,
              "about": "Салон цветов \"Счастливые Люди\" –  флористический магазин  высокого уровня. С 2012 года наша компания успешно развивается и на сегодняшний день занимает достойное место на рынке флористических услуг.\r\nФлористы Салона цветов \"Счастливые Люди\" -  это лучшие специалисты в области флористики. Постоянное обучение , командная работа и дружеская атмосфера – все это дает возможность создавать уникальные творческие работы и всегда быть в курсе сезонных трендов и последних тенденций мировой флористики.  \r\n Большой ассортимент свежих срезанных цветов в Москве, большой и удобный холодильник – витрина для цветов.\r\n- Создаем стильные авторские букеты и композиции на любой вкус\r\n- Доставляем букеты и композиции по Москве и ближнему Подмосковью в удобное для Вас время\r\n- Делимся хорошим настроением и дарим Вам наслаждение и радость от покупки цветов.\r\nСпасибо, что выбрали нас!",
              "city_id": 637640,
              "contact_phone": "+7(925)887-04-96",
              "site": null,
              "vk": null,
              "ok": null,
              "fb": null,
              "instagram": "@schastlivye_lyudi",
              "youtube": null,
              "delivery_price": "500.00",
              "delivery_time": 120,
              "delivery_out": 1,
              "delivery_out_max": 40,
              "delivery_out_price": "50.00",
              "round_clock": 0,
              "active": 1,
              "delivery_free": 0,
              "city": {
                  "id": 637640,
                  "name": "Москва",
                  "region_id": 637680,
                  "name_prepositional": "Москве",
                  "metro": 1,
                  "population": 12000,
                  "slug": "moskva",
                  "popular": 1
              }
          },
          "compositions": [],
          "single_product": null
      },
      "qty": 1,
      "pageTitle": "Оплата доставки Букет номер четыре в г Москва",
      "pageDescription": "Оплата доставки Букет номер четыре в г Москва и оформление заказа",
      "pageKeywords": "Букет номер четыре, букет, цветы, доставка, заказ, Москва, оплата",
      "dopProducts": []
  }
  *
  * */
  
  public function cart($id, Request $request) {

    $product = Product::with('shop.city')->with('compositions.flower')->with('singleProduct.parent')->findOrFail($id);

    $params = [
            'product' => $product,
            'qty' => 1,
            'pageTitle' => 'Оплата доставки '.$product->name.' в г '.$product->shop->city->name,
            'pageDescription' => 'Оплата доставки '.$product->name.' в г '.$product->shop->city->name.' и оформление заказа',
            'pageKeywords' => $product->name.', букет, цветы, доставка, заказ, '.$product->shop->city->name.', оплата',
    ];

    if(!empty($product->single)) {
            $qty = !empty($request->qty) ? $request->qty : $product->singleProduct->qty_from;
            $params['qty'] = $qty;
    }

    $params['dopProducts'] = Product::where('dop', 1)->where('shop_id', $product->shop_id)->get();

    return $params;
  }
}