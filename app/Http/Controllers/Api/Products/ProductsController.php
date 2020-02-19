<?php

namespace App\Http\Controllers\Api\Products;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Model\Product;

/**
 * @group Products
 */

class ProductsController extends Controller
{
  /**
   * @response {
    "current_page": 1,
    "data": [
        {
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
            "url": "http://floristum.ru/flowers/buket-nomer-chetyre",
            "photoUrl": "/uploads/products/62/351x351_c/p62_1519228779_42033.jpg",
            "fullPrice": 13396,
            "deliveryTime": "12ч.",
            "shop": {
                "id": 62,
                "name": "Счастливые люди",
                "delivery_price": "500.00",
                "delivery_time": 120
            },
            "photos": [
                {
                    "id": 2624,
                    "product_id": 1886,
                    "photo": "p62_1519228779_42033.jpg",
                    "created_at": "2018-02-21 18:59:39",
                    "updated_at": "2019-05-05 13:40:18",
                    "priority": 0,
                    "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/62\\/p62_1519228779_42033\",\"version\":1557052815,\"signature\":\"9bbf1d046898cc85f6a30929d06ba4c874368601\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T10:40:15Z\",\"tags\":[],\"bytes\":79085,\"type\":\"upload\",\"etag\":\"769f4584b40ab67266fbc3cd4ee4894c\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557052815\\/632x632\\/62\\/p62_1519228779_42033.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557052815\\/632x632\\/62\\/p62_1519228779_42033.jpg\",\"original_filename\":\"p62_1519228779_42033\"},\"350x350\":{\"public_id\":\"350x350\\/62\\/p62_1519228779_42033\",\"version\":1557052817,\"signature\":\"9d45559edb7ea006e03b53187e80eaa54b62e518\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T10:40:17Z\",\"tags\":[],\"bytes\":30555,\"type\":\"upload\",\"etag\":\"e95578be9f671e9bb81a0b383db16012\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557052817\\/350x350\\/62\\/p62_1519228779_42033.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557052817\\/350x350\\/62\\/p62_1519228779_42033.jpg\",\"original_filename\":\"p62_1519228779_42033\"}}"
                }
            ]
        },
        {
            "id": 33742,
            "shop_id": 119,
            "name": "Букет \"Нектарин\"",
            "slug": "buket-nektarin-828",
            "price": 3150,
            "description": "Состав букета:\n1.Яблоки - 5 шт.\n2.Нектарин - 6 шт.\n3.Гранат- 1 (не очищенный)\n4.Клубника - 10 шт.\n5. Альстромерия - 3 шт.\n6.Рускус итало - 3 шт.\n7.Упаковка бумага \"Крафт\"- 1 шт.\n8.Верёвка - 1 упак.\n9.Техническая упаковка целлофан - 1 шт.",
            "photo": "p119_1530717477_47214.png",
            "make_time": 90,
            "width": 35,
            "height": 45,
            "dop": 0,
            "approved": 0,
            "color_id": 3,
            "product_type_id": 9,
            "status": 1,
            "status_comment": null,
            "pause": 0,
            "special_offer_id": null,
            "sort": 37762545,
            "single": null,
            "status_comment_at": null,
            "star": 1,
            "block_id": 9,
            "clientPrice": 4445,
            "url": "http://floristum.ru/flowers/buket-nektarin-828",
            "photoUrl": "/uploads/products/119/351x351_c/p119_1530717477_47214.png",
            "fullPrice": 4445,
            "deliveryTime": "1ч. 30мин.",
            "shop": {
                "id": 119,
                "name": "Dekor&Event",
                "delivery_price": "350.00",
                "delivery_time": 180
            },
            "photos": [
                {
                    "id": 35144,
                    "product_id": 33742,
                    "photo": "p119_1530717477_47214.png",
                    "created_at": "2018-07-04 18:17:58",
                    "updated_at": "2019-05-05 20:26:34",
                    "priority": 0,
                    "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/119\\/p119_1530717477_47214\",\"version\":1557077189,\"signature\":\"09ff2919072cfc6ac56204c586f1dd8cd7133788\",\"width\":632,\"height\":632,\"format\":\"png\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:26:29Z\",\"tags\":[],\"bytes\":583029,\"type\":\"upload\",\"etag\":\"cc934381efc5422aba5ee6854748cc80\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557077189\\/632x632\\/119\\/p119_1530717477_47214.png\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557077189\\/632x632\\/119\\/p119_1530717477_47214.png\",\"original_filename\":\"p119_1530717477_47214\"},\"350x350\":{\"public_id\":\"350x350\\/119\\/p119_1530717477_47214\",\"version\":1557077193,\"signature\":\"f37c2d1a89cc887458c3759f22c604c34ca24c6c\",\"width\":350,\"height\":350,\"format\":\"png\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:26:33Z\",\"tags\":[],\"bytes\":215503,\"type\":\"upload\",\"etag\":\"d5cdb4854382f970ed7249aef1d0561c\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557077193\\/350x350\\/119\\/p119_1530717477_47214.png\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557077193\\/350x350\\/119\\/p119_1530717477_47214.png\",\"original_filename\":\"p119_1530717477_47214\"}}"
                }
            ]
        }
    ],
    "first_page_url": "http://floristum.ru/api/products?page=1",
    "from": 1,
    "last_page": 136,
    "last_page_url": "http://floristum.ru/api/products?page=136",
    "next_page_url": "http://floristum.ru/api/products?page=2",
    "path": "http://floristum.ru/api/products",
    "per_page": 15,
    "prev_page_url": null,
    "to": 15,
    "total": 2040
}
   * 
   * */
  public function products(Request $request) {

    $model = Product::popular(637640, $request);

    return $model;
  }

  public function cityProducts($city_id = 637640, Request $request) {

    $model = Product::popular($city_id, $request);

    return $model;
  }

  public function cityCategoryProducts($city_id = 637640, $category_slug, Request $request) {
    if($category_slug == 'single') {
      $request->single = true;
    }else {
      $request->product_type = $category_slug;
    }
    
    $model = Product::popular($city_id, $request);

    return $model;
  }
}