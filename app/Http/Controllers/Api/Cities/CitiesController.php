<?php

namespace App\Http\Controllers\Api\Cities;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Model\City;
use App\Model\Product;
use App\Model\ProductType;

/**
 * @group Cities
 */

class CitiesController extends Controller
{
        /**
         * @response [
    {
        "id": 637640,
        "name": "Москва",
        "region_id": 637680,
        "name_prepositional": "Москве",
        "metro": 1,
        "population": 12000,
        "slug": "moskva",
        "popular": 1,
        "region": {
            "id": 637680,
            "name": "Московская область",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:15:52",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 653240,
        "name": "Санкт-Петербург",
        "region_id": 653240,
        "name_prepositional": "Санкт-Петербурге",
        "metro": 1,
        "population": 5300,
        "slug": "sankt-peterburg",
        "popular": 1,
        "region": {
            "id": 653240,
            "name": "Санкт-Петербург",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:17:39",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 641780,
        "name": "Новосибирск",
        "region_id": 641470,
        "name_prepositional": "Новосибирске",
        "metro": 0,
        "population": 1600,
        "slug": "novosibirsk",
        "popular": 1,
        "region": {
            "id": 641470,
            "name": "Новосибирская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:15:58",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+6:00"
        }
    }
  ]
         */
        public function cities(Request $request)
        {

                
                $cities = City::whereNotNull('slug')->with(['region'])->orderBy('population', 'DESC')->get();

                return $cities;
        }

        /**
         * @response {
    "productTypes": [
        {
            "id": 2,
            "name": "Авторские",
            "request": "productType/2",
            "photo": "http://floristum.ru/assets/front/img/ico"
        },
        {
            "id": 1,
            "name": "Классика",
            "request": "productType/1",
            "photo": "http://floristum.ru/assets/front/img/ico"
        },
        {
            "id": 3,
            "name": "Коробки",
            "request": "productType/3",
            "photo": "http://floristum.ru/assets/front/img/ico"
        },
        {
            "id": 4,
            "name": "Корзины",
            "request": "productType/4",
            "photo": "http://floristum.ru/assets/front/img/ico"
        },
        {
            "id": 9,
            "name": "Фрукты",
            "request": "productType/9",
            "photo": "http://floristum.ru/assets/front/img/ico"
        },
        {
            "id": 10,
            "name": "Лакомства",
            "request": "productType/10",
            "photo": "http://floristum.ru/assets/front/img/ico"
        }
    ],
    "products": [
        {
            "name": "Авторские",
            "products": {
                "current_page": 1,
                "data": [
                    {
                        "id": 844,
                        "shop_id": 31,
                        "name": "Букет 25 ароматных гербер",
                        "slug": "buket-25-aromatnykh-gerber-1518366340",
                        "price": 1890,
                        "description": "Стильно, ярко, для нее!",
                        "photo": "p31_1516875363_11001.jpg",
                        "make_time": 90,
                        "width": 40,
                        "height": 50,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 10,
                        "product_type_id": 2,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": "5",
                        "sort": 67044830,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 2,
                        "clientPrice": 2807,
                        "url": "http://floristum.ru/flowers/buket-25-aromatnykh-gerber-1518366340",
                        "photoUrl": "/uploads/products/31/351x351_c/p31_1516875363_11001.jpg",
                        "fullPrice": 2807,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 31,
                            "name": "Anneyes",
                            "delivery_price": "350.00",
                            "delivery_time": 120
                        },
                        "photos": [
                            {
                                "id": 881,
                                "product_id": 844,
                                "photo": "p31_1516875363_11001.jpg",
                                "created_at": "2018-02-09 13:32:05",
                                "updated_at": "2019-05-05 12:09:25",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/31\\/p31_1516875363_11001\",\"version\":1557047363,\"signature\":\"5e20408fd707dc2ee3420ceaf0a4dcb03f46cab5\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:09:23Z\",\"tags\":[],\"bytes\":44238,\"type\":\"upload\",\"etag\":\"2db8276d85948c7b4e4c2edde34ba7e8\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047363\\/632x632\\/31\\/p31_1516875363_11001.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047363\\/632x632\\/31\\/p31_1516875363_11001.jpg\",\"original_filename\":\"p31_1516875363_11001\"},\"350x350\":{\"public_id\":\"350x350\\/31\\/p31_1516875363_11001\",\"version\":1557047365,\"signature\":\"61562d07a98da5711a32e1ac1dc16e21bf0e0534\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:09:25Z\",\"tags\":[],\"bytes\":31047,\"type\":\"upload\",\"etag\":\"6c6670853b0e873aaa3a5b626625ba95\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047365\\/350x350\\/31\\/p31_1516875363_11001.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047365\\/350x350\\/31\\/p31_1516875363_11001.jpg\",\"original_filename\":\"p31_1516875363_11001\"}}"
                            }
                        ]
                    },
                    {
                        "id": 848,
                        "shop_id": 31,
                        "name": "Букет \"Лунный свет\"",
                        "slug": "buket-lunnyy-svet",
                        "price": 2500,
                        "description": "Нежный букет для утонченной натуры.",
                        "photo": "p31_1516875378_70084.jpg",
                        "make_time": 90,
                        "width": 30,
                        "height": 40,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 10,
                        "product_type_id": 2,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 2320687,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 2,
                        "clientPrice": 3600,
                        "url": "http://floristum.ru/flowers/buket-lunnyy-svet",
                        "photoUrl": "/uploads/products/31/351x351_c/p31_1516875378_70084.jpg",
                        "fullPrice": 3600,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 31,
                            "name": "Anneyes",
                            "delivery_price": "350.00",
                            "delivery_time": 120
                        },
                        "photos": [
                            {
                                "id": 885,
                                "product_id": 848,
                                "photo": "p31_1516875378_70084.jpg",
                                "created_at": "2018-02-09 13:32:05",
                                "updated_at": "2019-05-05 12:10:12",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/31\\/p31_1516875378_70084\",\"version\":1557047410,\"signature\":\"de763d9fbd29d1dbd58ad63c5a3a1c8049baf357\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:10Z\",\"tags\":[],\"bytes\":57543,\"type\":\"upload\",\"etag\":\"fd5c18d980037592ba08846de074a298\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047410\\/632x632\\/31\\/p31_1516875378_70084.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047410\\/632x632\\/31\\/p31_1516875378_70084.jpg\",\"original_filename\":\"p31_1516875378_70084\"},\"350x350\":{\"public_id\":\"350x350\\/31\\/p31_1516875378_70084\",\"version\":1557047412,\"signature\":\"1c905362d6d035b4f109d4fec7b8b0bc08c92bcf\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:12Z\",\"tags\":[],\"bytes\":42567,\"type\":\"upload\",\"etag\":\"b9f217ee07b8fa8b5c4182f25c277018\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047412\\/350x350\\/31\\/p31_1516875378_70084.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047412\\/350x350\\/31\\/p31_1516875378_70084.jpg\",\"original_filename\":\"p31_1516875378_70084\"}}"
                            }
                        ]
                    },
                    {
                        "id": 858,
                        "shop_id": 31,
                        "name": "Букет \"Магия\"",
                        "slug": "buket-magiya",
                        "price": 1870,
                        "description": "Яркий и стильный букетик-отличный презент для любой встречи.",
                        "photo": "p31_1516875404_53372.jpg",
                        "make_time": 90,
                        "width": 40,
                        "height": 50,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 10,
                        "product_type_id": 2,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 17623072,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 2,
                        "clientPrice": 2781,
                        "url": "http://floristum.ru/flowers/buket-magiya",
                        "photoUrl": "/uploads/products/31/351x351_c/p31_1516875404_53372.jpg",
                        "fullPrice": 2781,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 31,
                            "name": "Anneyes",
                            "delivery_price": "350.00",
                            "delivery_time": 120
                        },
                        "photos": [
                            {
                                "id": 895,
                                "product_id": 858,
                                "photo": "p31_1516875404_53372.jpg",
                                "created_at": "2018-02-09 13:32:05",
                                "updated_at": "2019-05-05 12:10:20",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/31\\/p31_1516875404_53372\",\"version\":1557047418,\"signature\":\"a6b62500db40d84ce19ddbdee82513cec804aff2\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:18Z\",\"tags\":[],\"bytes\":34117,\"type\":\"upload\",\"etag\":\"8a0808c5bb850e77c51eb4054e05c951\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047418\\/632x632\\/31\\/p31_1516875404_53372.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047418\\/632x632\\/31\\/p31_1516875404_53372.jpg\",\"original_filename\":\"p31_1516875404_53372\"},\"350x350\":{\"public_id\":\"350x350\\/31\\/p31_1516875404_53372\",\"version\":1557047419,\"signature\":\"612dceca132f9eaefa235d8e631b5f85ccad0ec6\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:19Z\",\"tags\":[],\"bytes\":23853,\"type\":\"upload\",\"etag\":\"af2d7be77baeeda898b6e2bfaf9b756d\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047419\\/350x350\\/31\\/p31_1516875404_53372.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047419\\/350x350\\/31\\/p31_1516875404_53372.jpg\",\"original_filename\":\"p31_1516875404_53372\"}}"
                            }
                        ]
                    },
                    {
                        "id": 863,
                        "shop_id": 31,
                        "name": "Букет \"Величие\"",
                        "slug": "buket-velichie",
                        "price": 830,
                        "description": "Стильный букет Кенийской из розы Состав: роза \"Кения\"-13 шт 40 см Упаковка: лента атласная, для любимой женщины.",
                        "photo": "p31_1516875416_75304.png",
                        "make_time": 90,
                        "width": 30,
                        "height": 40,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 10,
                        "product_type_id": 2,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": "5",
                        "sort": 1195890,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 2,
                        "clientPrice": 1429,
                        "url": "http://floristum.ru/flowers/buket-velichie",
                        "photoUrl": "/uploads/products/31/351x351_c/p31_1516875416_75304.png",
                        "fullPrice": 1429,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 31,
                            "name": "Anneyes",
                            "delivery_price": "350.00",
                            "delivery_time": 120
                        },
                        "photos": [
                            {
                                "id": 900,
                                "product_id": 863,
                                "photo": "p31_1516875416_75304.png",
                                "created_at": "2018-02-09 13:32:05",
                                "updated_at": "2019-05-05 12:10:24",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/31\\/p31_1516875416_75304\",\"version\":1557047421,\"signature\":\"6f7cf0e46de46ccd959c8fcd6181c3145b316493\",\"width\":632,\"height\":632,\"format\":\"png\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:21Z\",\"tags\":[],\"bytes\":330885,\"type\":\"upload\",\"etag\":\"10762d02f992bbe5d154d06b3620e403\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047421\\/632x632\\/31\\/p31_1516875416_75304.png\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047421\\/632x632\\/31\\/p31_1516875416_75304.png\",\"original_filename\":\"p31_1516875416_75304\"},\"350x350\":{\"public_id\":\"350x350\\/31\\/p31_1516875416_75304\",\"version\":1557047423,\"signature\":\"803f29983fb326789a5c1acc0c17f58f2d477d19\",\"width\":350,\"height\":350,\"format\":\"png\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:23Z\",\"tags\":[],\"bytes\":114103,\"type\":\"upload\",\"etag\":\"0ea6086e6ffbbbc729913a58787231b9\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047423\\/350x350\\/31\\/p31_1516875416_75304.png\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047423\\/350x350\\/31\\/p31_1516875416_75304.png\",\"original_filename\":\"p31_1516875416_75304\"}}"
                            }
                        ]
                    },
                    {
                        "id": 870,
                        "shop_id": 31,
                        "name": "Букет ярких хризантем",
                        "slug": "buket-yarkikh-khrizantem",
                        "price": 2250,
                        "description": "Пышный и ароматный букет с фиолетовыми ирисами и белоснежной кустовой хризантемойдля самых драгоценных вам людей.",
                        "photo": "p31_1516875436_56994.jpg",
                        "make_time": 120,
                        "width": 40,
                        "height": 50,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 10,
                        "product_type_id": 2,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 273662,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 2,
                        "clientPrice": 3275,
                        "url": "http://floristum.ru/flowers/buket-yarkikh-khrizantem",
                        "photoUrl": "/uploads/products/31/351x351_c/p31_1516875436_56994.jpg",
                        "fullPrice": 3275,
                        "deliveryTime": "2ч.",
                        "shop": {
                            "id": 31,
                            "name": "Anneyes",
                            "delivery_price": "350.00",
                            "delivery_time": 120
                        },
                        "photos": [
                            {
                                "id": 907,
                                "product_id": 870,
                                "photo": "p31_1516875436_56994.jpg",
                                "created_at": "2018-02-09 13:32:05",
                                "updated_at": "2019-05-05 12:11:06",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/31\\/p31_1516875436_56994\",\"version\":1557047465,\"signature\":\"07ec0c895ad5b0ea0e19f0475de6444f68c91ad6\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:11:05Z\",\"tags\":[],\"bytes\":73657,\"type\":\"upload\",\"etag\":\"333f023c421f973548a357478eaac368\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047465\\/632x632\\/31\\/p31_1516875436_56994.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047465\\/632x632\\/31\\/p31_1516875436_56994.jpg\",\"original_filename\":\"p31_1516875436_56994\"},\"350x350\":{\"public_id\":\"350x350\\/31\\/p31_1516875436_56994\",\"version\":1557047466,\"signature\":\"a8a764c4902127d575c21f2594191cc22b00ec0b\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:11:06Z\",\"tags\":[],\"bytes\":32007,\"type\":\"upload\",\"etag\":\"d4d496e6eca7449ffa43e779b6326589\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047466\\/350x350\\/31\\/p31_1516875436_56994.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047466\\/350x350\\/31\\/p31_1516875436_56994.jpg\",\"original_filename\":\"p31_1516875436_56994\"}}"
                            }
                        ]
                    },
                    {
                        "id": 873,
                        "shop_id": 31,
                        "name": "Букет \"Ароматная экзотика\"",
                        "slug": "buket-aromatnaya-ekzotika",
                        "price": 3250,
                        "description": "Пышный букет из 21 разноцветной кустовой розы украшенной зелеными листочками рускуса для вашей спутницы жизни. Цветы перевязаны лентой. Букет доступен для доставки на дом!",
                        "photo": "p31_1516875446_95668.jpg",
                        "make_time": 120,
                        "width": 50,
                        "height": 50,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 10,
                        "product_type_id": 2,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": "5,5,5",
                        "sort": 4773297,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 2,
                        "clientPrice": 4575,
                        "url": "http://floristum.ru/flowers/buket-aromatnaya-ekzotika",
                        "photoUrl": "/uploads/products/31/351x351_c/p31_1516875446_95668.jpg",
                        "fullPrice": 4575,
                        "deliveryTime": "2ч.",
                        "shop": {
                            "id": 31,
                            "name": "Anneyes",
                            "delivery_price": "350.00",
                            "delivery_time": 120
                        },
                        "photos": [
                            {
                                "id": 910,
                                "product_id": 873,
                                "photo": "p31_1516875446_95668.jpg",
                                "created_at": "2018-02-09 13:32:05",
                                "updated_at": "2019-05-05 12:11:14",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/31\\/p31_1516875446_95668\",\"version\":1557047472,\"signature\":\"00e9d5c5b49f49268b439a7037bc00b631d18e5f\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:11:12Z\",\"tags\":[],\"bytes\":48374,\"type\":\"upload\",\"etag\":\"f9b613dd44e9bf9a6fedba874afee6d1\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047472\\/632x632\\/31\\/p31_1516875446_95668.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047472\\/632x632\\/31\\/p31_1516875446_95668.jpg\",\"original_filename\":\"p31_1516875446_95668\"},\"350x350\":{\"public_id\":\"350x350\\/31\\/p31_1516875446_95668\",\"version\":1557047473,\"signature\":\"2c1e6a020771ed1aca66fac2a71e47cc6fa1b976\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:11:13Z\",\"tags\":[],\"bytes\":34859,\"type\":\"upload\",\"etag\":\"c66f8148c7db4d6f02aa027cfa092271\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047473\\/350x350\\/31\\/p31_1516875446_95668.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047473\\/350x350\\/31\\/p31_1516875446_95668.jpg\",\"original_filename\":\"p31_1516875446_95668\"}}"
                            }
                        ]
                    },
                    {
                        "id": 874,
                        "shop_id": 31,
                        "name": "Букет ярких розочек",
                        "slug": "buket-yarkikh-rozochek-1518373146",
                        "price": 6170,
                        "description": "Классический букет из 51 красной и кремовой розы, оформленный атласной лентой, отлично подойдет для торжества.",
                        "photo": "p31_1516875449_81261.jpg",
                        "make_time": 120,
                        "width": 60,
                        "height": 60,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 10,
                        "product_type_id": 2,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 50575393,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 2,
                        "clientPrice": 8371,
                        "url": "http://floristum.ru/flowers/buket-yarkikh-rozochek-1518373146",
                        "photoUrl": "/uploads/products/31/351x351_c/p31_1516875449_81261.jpg",
                        "fullPrice": 8371,
                        "deliveryTime": "2ч.",
                        "shop": {
                            "id": 31,
                            "name": "Anneyes",
                            "delivery_price": "350.00",
                            "delivery_time": 120
                        },
                        "photos": [
                            {
                                "id": 911,
                                "product_id": 874,
                                "photo": "p31_1516875449_81261.jpg",
                                "created_at": "2018-02-09 13:32:05",
                                "updated_at": "2019-05-05 12:11:16",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/31\\/p31_1516875449_81261\",\"version\":1557047475,\"signature\":\"49e910e17f1ae6a05d9e6844e692ff5e3d0d802b\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:11:15Z\",\"tags\":[],\"bytes\":68834,\"type\":\"upload\",\"etag\":\"4d1fd67fdb10ec49b978b984a4ce8014\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047475\\/632x632\\/31\\/p31_1516875449_81261.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047475\\/632x632\\/31\\/p31_1516875449_81261.jpg\",\"original_filename\":\"p31_1516875449_81261\"},\"350x350\":{\"public_id\":\"350x350\\/31\\/p31_1516875449_81261\",\"version\":1557047476,\"signature\":\"42c251592c2f218a108accc7e58d2c61db363c71\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:11:16Z\",\"tags\":[],\"bytes\":30350,\"type\":\"upload\",\"etag\":\"4f91cae4684b401c0f7b15347b584975\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047476\\/350x350\\/31\\/p31_1516875449_81261.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047476\\/350x350\\/31\\/p31_1516875449_81261.jpg\",\"original_filename\":\"p31_1516875449_81261\"}}"
                            }
                        ]
                    },
                    {
                        "id": 881,
                        "shop_id": 31,
                        "name": "Букет \"Яркие краски\"",
                        "slug": "buket-yarkie-kraski-1516879175",
                        "price": 4000,
                        "description": "Буйство красок и стиля.",
                        "photo": "p31_1516875470_13802.jpg",
                        "make_time": 120,
                        "width": 50,
                        "height": 50,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 10,
                        "product_type_id": 2,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": "5",
                        "sort": 32469384,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 2,
                        "clientPrice": 5550,
                        "url": "http://floristum.ru/flowers/buket-yarkie-kraski-1516879175",
                        "photoUrl": "/uploads/products/31/351x351_c/p31_1516875470_13802.jpg",
                        "fullPrice": 5550,
                        "deliveryTime": "2ч.",
                        "shop": {
                            "id": 31,
                            "name": "Anneyes",
                            "delivery_price": "350.00",
                            "delivery_time": 120
                        },
                        "photos": [
                            {
                                "id": 918,
                                "product_id": 881,
                                "photo": "p31_1516875470_13802.jpg",
                                "created_at": "2018-02-09 13:32:05",
                                "updated_at": "2019-05-05 12:12:08",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/31\\/p31_1516875470_13802\",\"version\":1557047527,\"signature\":\"f787583dd5beb559288695aa232fe923a807f498\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:12:07Z\",\"tags\":[],\"bytes\":74365,\"type\":\"upload\",\"etag\":\"448620eddd5f5015d0dcba50cf021782\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047527\\/632x632\\/31\\/p31_1516875470_13802.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047527\\/632x632\\/31\\/p31_1516875470_13802.jpg\",\"original_filename\":\"p31_1516875470_13802\"},\"350x350\":{\"public_id\":\"350x350\\/31\\/p31_1516875470_13802\",\"version\":1557047528,\"signature\":\"4802a59c9b88b8f4feb04789154fbe3875888dfd\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:12:08Z\",\"tags\":[],\"bytes\":31805,\"type\":\"upload\",\"etag\":\"e28fe591e4de2f18395c7d07cc65f607\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047528\\/350x350\\/31\\/p31_1516875470_13802.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047528\\/350x350\\/31\\/p31_1516875470_13802.jpg\",\"original_filename\":\"p31_1516875470_13802\"}}"
                            }
                        ]
                    }
                ],
                "first_page_url": "http://floristum.ru/api/main/641780?page=1",
                "from": 1,
                "last_page": 6,
                "last_page_url": "http://floristum.ru/api/main/641780?page=6",
                "next_page_url": "http://floristum.ru/api/main/641780?page=2",
                "path": "http://floristum.ru/api/main/641780",
                "per_page": 8,
                "prev_page_url": null,
                "to": 8,
                "total": 45
            },
            "request": "products/2"
        },
        {
            "name": "Классика",
            "products": {
                "current_page": 1,
                "data": [
                    {
                        "id": 845,
                        "shop_id": 31,
                        "name": "Букет розовое счастье",
                        "slug": "buket-rozovoe-schaste",
                        "price": 4050,
                        "description": "Классические розочки \"Пинк Флойд\" для любого повода и без.",
                        "photo": "p31_1516875366_40790.jpg",
                        "make_time": 90,
                        "width": 50,
                        "height": 60,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 2,
                        "product_type_id": 1,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 40365690,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 5,
                        "clientPrice": 5615,
                        "url": "http://floristum.ru/flowers/buket-rozovoe-schaste",
                        "photoUrl": "/uploads/products/31/351x351_c/p31_1516875366_40790.jpg",
                        "fullPrice": 5615,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 31,
                            "name": "Anneyes",
                            "delivery_price": "350.00",
                            "delivery_time": 120
                        },
                        "photos": [
                            {
                                "id": 882,
                                "product_id": 845,
                                "photo": "p31_1516875366_40790.jpg",
                                "created_at": "2018-02-09 13:32:05",
                                "updated_at": "2019-05-05 12:10:04",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/31\\/p31_1516875366_40790\",\"version\":1557047402,\"signature\":\"12ba708922f42c648a1c3ed0741494cd3d731df5\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:02Z\",\"tags\":[],\"bytes\":40916,\"type\":\"upload\",\"etag\":\"bf61eaf5a0341c2238c8b36672657c9e\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047402\\/632x632\\/31\\/p31_1516875366_40790.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047402\\/632x632\\/31\\/p31_1516875366_40790.jpg\",\"original_filename\":\"p31_1516875366_40790\"},\"350x350\":{\"public_id\":\"350x350\\/31\\/p31_1516875366_40790\",\"version\":1557047403,\"signature\":\"4bff3881fd7c43c9d9249ceac7dd725bbf3ca1b0\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:03Z\",\"tags\":[],\"bytes\":31056,\"type\":\"upload\",\"etag\":\"8d45d3b865a720ed8060fbb7b7be3fcb\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047403\\/350x350\\/31\\/p31_1516875366_40790.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047403\\/350x350\\/31\\/p31_1516875366_40790.jpg\",\"original_filename\":\"p31_1516875366_40790\"}}"
                            }
                        ]
                    },
                    {
                        "id": 846,
                        "shop_id": 31,
                        "name": "Букет Солнечная Кения",
                        "slug": "buket-solnechnaya-keniya",
                        "price": 1550,
                        "description": "Яркий букет из 25 желтых роз Кения 40 см с доставкой на дом! \nСолнечный букетик, который поднимет настроение на весь день.",
                        "photo": "p31_1516875373_48349.jpg",
                        "make_time": 90,
                        "width": 40,
                        "height": 40,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 4,
                        "product_type_id": 1,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": "5",
                        "sort": 63424641,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 5,
                        "clientPrice": 2365,
                        "url": "http://floristum.ru/flowers/buket-solnechnaya-keniya",
                        "photoUrl": "/uploads/products/31/351x351_c/p31_1516875373_48349.jpg",
                        "fullPrice": 2365,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 31,
                            "name": "Anneyes",
                            "delivery_price": "350.00",
                            "delivery_time": 120
                        },
                        "photos": [
                            {
                                "id": 883,
                                "product_id": 846,
                                "photo": "p31_1516875373_48349.jpg",
                                "created_at": "2018-02-09 13:32:05",
                                "updated_at": "2019-05-05 12:10:06",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/31\\/p31_1516875373_48349\",\"version\":1557047404,\"signature\":\"48313594d69482619eb1d6c35326d33d59ecb968\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:04Z\",\"tags\":[],\"bytes\":43357,\"type\":\"upload\",\"etag\":\"0cbfc518c655a863e3565b15cfa5ab11\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047404\\/632x632\\/31\\/p31_1516875373_48349.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047404\\/632x632\\/31\\/p31_1516875373_48349.jpg\",\"original_filename\":\"p31_1516875373_48349\"},\"350x350\":{\"public_id\":\"350x350\\/31\\/p31_1516875373_48349\",\"version\":1557047406,\"signature\":\"5fe99f71019c00e83ee95932ab5a46d880317e60\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:06Z\",\"tags\":[],\"bytes\":33023,\"type\":\"upload\",\"etag\":\"1e4e1c9bcb8ff4b086079dd6779a97e3\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047406\\/350x350\\/31\\/p31_1516875373_48349.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047406\\/350x350\\/31\\/p31_1516875373_48349.jpg\",\"original_filename\":\"p31_1516875373_48349\"}}"
                            }
                        ]
                    },
                    {
                        "id": 847,
                        "shop_id": 31,
                        "name": "Букет ароматных роз Вендела",
                        "slug": "buket-aromatnykh-roz-vendela",
                        "price": 3500,
                        "description": "Стильный букет из 25 роз сорта \"Вендела\" 50 см ,с добавлением зелени салала в крафт бумаге придется по душе любой получательнице.",
                        "photo": "p31_1516875376_87767.jpg",
                        "make_time": 90,
                        "width": 50,
                        "height": 50,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 9,
                        "product_type_id": 1,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 41796971,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 5,
                        "clientPrice": 4900,
                        "url": "http://floristum.ru/flowers/buket-aromatnykh-roz-vendela",
                        "photoUrl": "/uploads/products/31/351x351_c/p31_1516875376_87767.jpg",
                        "fullPrice": 4900,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 31,
                            "name": "Anneyes",
                            "delivery_price": "350.00",
                            "delivery_time": 120
                        },
                        "photos": [
                            {
                                "id": 884,
                                "product_id": 847,
                                "photo": "p31_1516875376_87767.jpg",
                                "created_at": "2018-02-09 13:32:05",
                                "updated_at": "2019-05-05 12:10:10",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/31\\/p31_1516875376_87767\",\"version\":1557047407,\"signature\":\"d04e590883f97afcaf63b841d394b2793a3061b5\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:07Z\",\"tags\":[],\"bytes\":32261,\"type\":\"upload\",\"etag\":\"3a01bc49759c25443504ba6b91b458fe\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047407\\/632x632\\/31\\/p31_1516875376_87767.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047407\\/632x632\\/31\\/p31_1516875376_87767.jpg\",\"original_filename\":\"p31_1516875376_87767\"},\"350x350\":{\"public_id\":\"350x350\\/31\\/p31_1516875376_87767\",\"version\":1557047409,\"signature\":\"f213d1c784cfcf8661f474e22ae7f0d8eff9514f\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:09Z\",\"tags\":[],\"bytes\":24616,\"type\":\"upload\",\"etag\":\"ff52503356117ff2684d447325a83a1b\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047409\\/350x350\\/31\\/p31_1516875376_87767.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047409\\/350x350\\/31\\/p31_1516875376_87767.jpg\",\"original_filename\":\"p31_1516875376_87767\"}}"
                            }
                        ]
                    },
                    {
                        "id": 850,
                        "shop_id": 31,
                        "name": "Букет \"Счастье\"",
                        "slug": "buket-schaste",
                        "price": 1720,
                        "description": "Букет из 11 роз сорта \"Фридом\", с добавлением зелени салала в крафт бумаге, для любого повода и без.",
                        "photo": "p31_1516875383_11586.jpg",
                        "make_time": 90,
                        "width": 30,
                        "height": 50,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 1,
                        "product_type_id": 1,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": "5",
                        "sort": 220645,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 5,
                        "clientPrice": 2586,
                        "url": "http://floristum.ru/flowers/buket-schaste",
                        "photoUrl": "/uploads/products/31/351x351_c/p31_1516875383_11586.jpg",
                        "fullPrice": 2586,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 31,
                            "name": "Anneyes",
                            "delivery_price": "350.00",
                            "delivery_time": 120
                        },
                        "photos": [
                            {
                                "id": 887,
                                "product_id": 850,
                                "photo": "p31_1516875383_11586.jpg",
                                "created_at": "2018-02-09 13:32:05",
                                "updated_at": "2019-05-05 12:10:15",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/31\\/p31_1516875383_11586\",\"version\":1557047413,\"signature\":\"c12d06b65d97a5359e33318382f126af56d4a688\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:13Z\",\"tags\":[],\"bytes\":33851,\"type\":\"upload\",\"etag\":\"8254af748fcd3f21ef9685e8ce8444b7\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047413\\/632x632\\/31\\/p31_1516875383_11586.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047413\\/632x632\\/31\\/p31_1516875383_11586.jpg\",\"original_filename\":\"p31_1516875383_11586\"},\"350x350\":{\"public_id\":\"350x350\\/31\\/p31_1516875383_11586\",\"version\":1557047414,\"signature\":\"3e2449b3d2c886107eb5d615a5d71e3d381dd5c5\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:14Z\",\"tags\":[],\"bytes\":25990,\"type\":\"upload\",\"etag\":\"1a3bef99c039a81b34964baa758cc9eb\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047414\\/350x350\\/31\\/p31_1516875383_11586.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047414\\/350x350\\/31\\/p31_1516875383_11586.jpg\",\"original_filename\":\"p31_1516875383_11586\"}}"
                            }
                        ]
                    },
                    {
                        "id": 854,
                        "shop_id": 31,
                        "name": "101 классическая роза",
                        "slug": "101-klassicheskaya-roza",
                        "price": 6350,
                        "description": "Большой красный букет для любого события и просто так)",
                        "photo": "p31_1516875393_31834.jpg",
                        "make_time": 90,
                        "width": 50,
                        "height": 40,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 1,
                        "product_type_id": 1,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": "5",
                        "sort": 40452901,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 5,
                        "clientPrice": 8605,
                        "url": "http://floristum.ru/flowers/101-klassicheskaya-roza",
                        "photoUrl": "/uploads/products/31/351x351_c/p31_1516875393_31834.jpg",
                        "fullPrice": 8605,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 31,
                            "name": "Anneyes",
                            "delivery_price": "350.00",
                            "delivery_time": 120
                        },
                        "photos": [
                            {
                                "id": 891,
                                "product_id": 854,
                                "photo": "p31_1516875393_31834.jpg",
                                "created_at": "2018-02-09 13:32:05",
                                "updated_at": "2019-05-05 12:10:17",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/31\\/p31_1516875393_31834\",\"version\":1557047415,\"signature\":\"117e2112baa24e180431ed2a52724757b53760e2\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:15Z\",\"tags\":[],\"bytes\":55947,\"type\":\"upload\",\"etag\":\"78c899eb72b82af82d80fa9b89e0139b\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047415\\/632x632\\/31\\/p31_1516875393_31834.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047415\\/632x632\\/31\\/p31_1516875393_31834.jpg\",\"original_filename\":\"p31_1516875393_31834\"},\"350x350\":{\"public_id\":\"350x350\\/31\\/p31_1516875393_31834\",\"version\":1557047417,\"signature\":\"2e1643aa95f9cc6b0a130f3465c16f8e8346208b\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:17Z\",\"tags\":[],\"bytes\":37870,\"type\":\"upload\",\"etag\":\"39bfef5274f8096b835c8a8c63848c6f\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047417\\/350x350\\/31\\/p31_1516875393_31834.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047417\\/350x350\\/31\\/p31_1516875393_31834.jpg\",\"original_filename\":\"p31_1516875393_31834\"}}"
                            }
                        ]
                    },
                    {
                        "id": 864,
                        "shop_id": 31,
                        "name": "Букет \"Ирландские розы\"",
                        "slug": "buket-irlandskie-rozy",
                        "price": 1850,
                        "description": "Яркий букет Ирландской розы таинственного фиолетового цвета оценит любая девушка! Состав: эустома-7 шт Зелень: эвкалипт-2 шт Упаковка: крафт бумага. Для любимой жензины.",
                        "photo": "p31_1516875420_24880.jpg",
                        "make_time": 120,
                        "width": 40,
                        "height": 50,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 7,
                        "product_type_id": 1,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": "5",
                        "sort": 8681669,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 5,
                        "clientPrice": 2755,
                        "url": "http://floristum.ru/flowers/buket-irlandskie-rozy",
                        "photoUrl": "/uploads/products/31/351x351_c/p31_1516875420_24880.jpg",
                        "fullPrice": 2755,
                        "deliveryTime": "2ч.",
                        "shop": {
                            "id": 31,
                            "name": "Anneyes",
                            "delivery_price": "350.00",
                            "delivery_time": 120
                        },
                        "photos": [
                            {
                                "id": 901,
                                "product_id": 864,
                                "photo": "p31_1516875420_24880.jpg",
                                "created_at": "2018-02-09 13:32:05",
                                "updated_at": "2019-05-05 12:10:26",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/31\\/p31_1516875420_24880\",\"version\":1557047425,\"signature\":\"73c45990725259b1461f6269ae01ed681f7b5e64\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:25Z\",\"tags\":[],\"bytes\":55751,\"type\":\"upload\",\"etag\":\"71c46baeab61420eafebce632117cda1\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047425\\/632x632\\/31\\/p31_1516875420_24880.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047425\\/632x632\\/31\\/p31_1516875420_24880.jpg\",\"original_filename\":\"p31_1516875420_24880\"},\"350x350\":{\"public_id\":\"350x350\\/31\\/p31_1516875420_24880\",\"version\":1557047426,\"signature\":\"c811d6537a8b0d6b925c43275fa9c36c2acd0d33\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:26Z\",\"tags\":[],\"bytes\":23482,\"type\":\"upload\",\"etag\":\"b83f4c12b2dfcd671221c248d59fe930\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047426\\/350x350\\/31\\/p31_1516875420_24880.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047426\\/350x350\\/31\\/p31_1516875420_24880.jpg\",\"original_filename\":\"p31_1516875420_24880\"}}"
                            }
                        ]
                    },
                    {
                        "id": 869,
                        "shop_id": 31,
                        "name": "Букет ярких ирисов",
                        "slug": "buket-yarkikh-irisov",
                        "price": 2840,
                        "description": "Этот ароматный букет подойдет для любого повода. Состав: ирис-31 шт Упаковка: лента",
                        "photo": "p31_1516875433_95459.jpg",
                        "make_time": 120,
                        "width": 30,
                        "height": 50,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 5,
                        "product_type_id": 1,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": "5",
                        "sort": 47446901,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 5,
                        "clientPrice": 4042,
                        "url": "http://floristum.ru/flowers/buket-yarkikh-irisov",
                        "photoUrl": "/uploads/products/31/351x351_c/p31_1516875433_95459.jpg",
                        "fullPrice": 4042,
                        "deliveryTime": "2ч.",
                        "shop": {
                            "id": 31,
                            "name": "Anneyes",
                            "delivery_price": "350.00",
                            "delivery_time": 120
                        },
                        "photos": [
                            {
                                "id": 906,
                                "product_id": 869,
                                "photo": "p31_1516875433_95459.jpg",
                                "created_at": "2018-02-09 13:32:05",
                                "updated_at": "2019-05-05 12:11:04",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/31\\/p31_1516875433_95459\",\"version\":1557047462,\"signature\":\"fcd91da7d18b751408552752d9f3fb2af5151457\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:11:02Z\",\"tags\":[],\"bytes\":41170,\"type\":\"upload\",\"etag\":\"c6199072ca32a9656830312da420c0dc\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047462\\/632x632\\/31\\/p31_1516875433_95459.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047462\\/632x632\\/31\\/p31_1516875433_95459.jpg\",\"original_filename\":\"p31_1516875433_95459\"},\"350x350\":{\"public_id\":\"350x350\\/31\\/p31_1516875433_95459\",\"version\":1557047463,\"signature\":\"e0cb8d7dd474709a97e327d95deec785b43e4bd3\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:11:03Z\",\"tags\":[],\"bytes\":31652,\"type\":\"upload\",\"etag\":\"6c156058ec249c203ae5737f2ca42410\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047463\\/350x350\\/31\\/p31_1516875433_95459.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047463\\/350x350\\/31\\/p31_1516875433_95459.jpg\",\"original_filename\":\"p31_1516875433_95459\"}}"
                            }
                        ]
                    },
                    {
                        "id": 871,
                        "shop_id": 31,
                        "name": "Букет \"Белые розы\"",
                        "slug": "buket-belye-rozy-1516878695",
                        "price": 6170,
                        "description": "Свежий, белоснежный букет ароматных роз сорта \"Вендела\", перевязанный атласной лентой, дополнит ваше романтическое свидание.\nЗакажите такой бует с доставкой на дом и вы сэкономите свое время!",
                        "photo": "p31_1516875439_96583.jpg",
                        "make_time": 120,
                        "width": 50,
                        "height": 60,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 9,
                        "product_type_id": 1,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 2492473,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 5,
                        "clientPrice": 8371,
                        "url": "http://floristum.ru/flowers/buket-belye-rozy-1516878695",
                        "photoUrl": "/uploads/products/31/351x351_c/p31_1516875439_96583.jpg",
                        "fullPrice": 8371,
                        "deliveryTime": "2ч.",
                        "shop": {
                            "id": 31,
                            "name": "Anneyes",
                            "delivery_price": "350.00",
                            "delivery_time": 120
                        },
                        "photos": [
                            {
                                "id": 908,
                                "product_id": 871,
                                "photo": "p31_1516875439_96583.jpg",
                                "created_at": "2018-02-09 13:32:05",
                                "updated_at": "2019-05-05 12:11:09",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/31\\/p31_1516875439_96583\",\"version\":1557047467,\"signature\":\"fa87489bf84881dda465e2d6ecf7c2267c76099f\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:11:07Z\",\"tags\":[],\"bytes\":64060,\"type\":\"upload\",\"etag\":\"d6dd4d20ec93be17cc0bcd64a46939c7\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047467\\/632x632\\/31\\/p31_1516875439_96583.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047467\\/632x632\\/31\\/p31_1516875439_96583.jpg\",\"original_filename\":\"p31_1516875439_96583\"},\"350x350\":{\"public_id\":\"350x350\\/31\\/p31_1516875439_96583\",\"version\":1557047468,\"signature\":\"d2270594d665375f8b6305785c6d090a523be7a8\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:11:08Z\",\"tags\":[],\"bytes\":28140,\"type\":\"upload\",\"etag\":\"ef98963b7b958f7a38dfd97c764e740a\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047468\\/350x350\\/31\\/p31_1516875439_96583.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047468\\/350x350\\/31\\/p31_1516875439_96583.jpg\",\"original_filename\":\"p31_1516875439_96583\"}}"
                            }
                        ]
                    }
                ],
                "first_page_url": "http://floristum.ru/api/main/641780?page=1",
                "from": 1,
                "last_page": 9,
                "last_page_url": "http://floristum.ru/api/main/641780?page=9",
                "next_page_url": "http://floristum.ru/api/main/641780?page=2",
                "path": "http://floristum.ru/api/main/641780",
                "per_page": 8,
                "prev_page_url": null,
                "to": 8,
                "total": 66
            },
            "request": "products/1"
        },
        {
            "name": "Коробки",
            "products": {
                "current_page": 1,
                "data": [
                    {
                        "id": 30086,
                        "shop_id": 105,
                        "name": "Букет №18",
                        "slug": "buket-18-310",
                        "price": 3230,
                        "description": "Один из самых актуальных трендов флористики – цветы в коробках. Это все те же букеты, только в необычной \"обертке\". такой сюрприз можно вручить в любой ситуации. Тому, кого вы решите им порадовать, не придется ломать голову, куда бы поставить цветы, чтобы они не завяли. Устройство коробки не даст растениям страдать от недостатка влаги. Да и носить такую композицию с собой гораздо удобнее.К каждому заказу прилагается средство CHRYSAL для свежесрезанных растений в подарок.",
                        "photo": "p105_1529723799_40549.jpg",
                        "make_time": 90,
                        "width": 21,
                        "height": 35,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 9,
                        "product_type_id": 3,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 37882291,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 6,
                        "clientPrice": 4649,
                        "url": "http://floristum.ru/flowers/buket-18-310",
                        "photoUrl": "/uploads/products/105/351x351_c/p105_1529723799_40549.jpg",
                        "fullPrice": 4649,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 105,
                            "name": "Флорентина",
                            "delivery_price": "450.00",
                            "delivery_time": 90
                        },
                        "photos": [
                            {
                                "id": 31446,
                                "product_id": 30086,
                                "photo": "p105_1529723799_40549.jpg",
                                "created_at": "2018-06-23 06:16:39",
                                "updated_at": "2019-05-05 20:03:03",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/105\\/p105_1529723799_40549\",\"version\":1557075782,\"signature\":\"12b10b9206628f741f144de6f35877c7b98c59e6\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:03:02Z\",\"tags\":[],\"bytes\":45983,\"type\":\"upload\",\"etag\":\"4f594c6fabae3a4eb7adb2ff958c360e\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075782\\/632x632\\/105\\/p105_1529723799_40549.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075782\\/632x632\\/105\\/p105_1529723799_40549.jpg\",\"original_filename\":\"p105_1529723799_40549\"},\"350x350\":{\"public_id\":\"350x350\\/105\\/p105_1529723799_40549\",\"version\":1557075783,\"signature\":\"8e69333be252f24a798f910fa6094a226f9e07c5\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:03:03Z\",\"tags\":[],\"bytes\":18809,\"type\":\"upload\",\"etag\":\"48df24f4ac4dd96c0c76ae864553bf0d\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075783\\/350x350\\/105\\/p105_1529723799_40549.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075783\\/350x350\\/105\\/p105_1529723799_40549.jpg\",\"original_filename\":\"p105_1529723799_40549\"}}"
                            }
                        ]
                    },
                    {
                        "id": 30107,
                        "shop_id": 105,
                        "name": "Букет №35",
                        "slug": "buket-35-813",
                        "price": 1615,
                        "description": "Выбрать оригинальный подарок несложно, но как подобрать такой презент, чтобы он не только поразил своей оригинальностью, а и навсегда остался в памяти любимой девушки, женщины или просто дорогого вам человека? Как показать всю свою любовь, нежность и безграничное уважение, но при этом не произнести ни одного слова? В такой ситуации на помощь приходят цветы в шляпной коробке.",
                        "photo": "p105_1529732177_15450.jpg",
                        "make_time": 90,
                        "width": 17,
                        "height": 10,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 10,
                        "product_type_id": 3,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 7093791,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 6,
                        "clientPrice": 2550,
                        "url": "http://floristum.ru/flowers/buket-35-813",
                        "photoUrl": "/uploads/products/105/351x351_c/p105_1529732177_15450.jpg",
                        "fullPrice": 2550,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 105,
                            "name": "Флорентина",
                            "delivery_price": "450.00",
                            "delivery_time": 90
                        },
                        "photos": [
                            {
                                "id": 31467,
                                "product_id": 30107,
                                "photo": "p105_1529732177_15450.jpg",
                                "created_at": "2018-06-23 08:36:18",
                                "updated_at": "2019-05-05 20:04:12",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/105\\/p105_1529732177_15450\",\"version\":1557075850,\"signature\":\"9a2bc4793715f9a569132436a9c6a9a23907aa5e\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:04:10Z\",\"tags\":[],\"bytes\":84228,\"type\":\"upload\",\"etag\":\"0081dae5d6f6c9a7931ce298f33a8dc5\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075850\\/632x632\\/105\\/p105_1529732177_15450.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075850\\/632x632\\/105\\/p105_1529732177_15450.jpg\",\"original_filename\":\"p105_1529732177_15450\"},\"350x350\":{\"public_id\":\"350x350\\/105\\/p105_1529732177_15450\",\"version\":1557075852,\"signature\":\"d2cfa2f59b1c691f498b327e6ab9e201fe65d554\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:04:12Z\",\"tags\":[],\"bytes\":32309,\"type\":\"upload\",\"etag\":\"2d5d37af53e4a1ae5f81fd9c50cb3dba\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075852\\/350x350\\/105\\/p105_1529732177_15450.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075852\\/350x350\\/105\\/p105_1529732177_15450.jpg\",\"original_filename\":\"p105_1529732177_15450\"}}"
                            }
                        ]
                    },
                    {
                        "id": 30114,
                        "shop_id": 105,
                        "name": "Букет №41",
                        "slug": "buket-41-935",
                        "price": 2888,
                        "description": "Цветы способны унести нас в мир иллюзий и фантазии, подарить истинное наслаждение их внешним видом и ароматом.Если вы решили не просто купить живые цветы, а сделать оригинальный и стильный подарок, то данная композиция будет кстати.Мы рады что вы выбрали салон \"Флорентина\" Мы дарим средство для продления жизни цветов в подарок.",
                        "photo": "p105_1529741909_42557.jpg",
                        "make_time": 90,
                        "width": 20,
                        "height": 25,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 4,
                        "product_type_id": 3,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 62621733,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 6,
                        "clientPrice": 4205,
                        "url": "http://floristum.ru/flowers/buket-41-935",
                        "photoUrl": "/uploads/products/105/351x351_c/p105_1529741909_42557.jpg",
                        "fullPrice": 4205,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 105,
                            "name": "Флорентина",
                            "delivery_price": "450.00",
                            "delivery_time": 90
                        },
                        "photos": [
                            {
                                "id": 31476,
                                "product_id": 30114,
                                "photo": "p105_1529741909_42557.jpg",
                                "created_at": "2018-06-23 11:18:30",
                                "updated_at": "2019-05-05 20:05:06",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/105\\/p105_1529741909_42557\",\"version\":1557075903,\"signature\":\"44a2506541f46bff69f236b59d60830662865b2a\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:05:03Z\",\"tags\":[],\"bytes\":62039,\"type\":\"upload\",\"etag\":\"8817ca0008566920717b150f6ee3d469\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075903\\/632x632\\/105\\/p105_1529741909_42557.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075903\\/632x632\\/105\\/p105_1529741909_42557.jpg\",\"original_filename\":\"p105_1529741909_42557\"},\"350x350\":{\"public_id\":\"350x350\\/105\\/p105_1529741909_42557\",\"version\":1557075904,\"signature\":\"74f8ebcd7db9fd6928ccd899f99fa80dba596d68\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:05:04Z\",\"tags\":[],\"bytes\":24642,\"type\":\"upload\",\"etag\":\"a44f0c2ec2e3394e8fa265820772d76d\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075904\\/350x350\\/105\\/p105_1529741909_42557.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075904\\/350x350\\/105\\/p105_1529741909_42557.jpg\",\"original_filename\":\"p105_1529741909_42557\"}}"
                            }
                        ]
                    },
                    {
                        "id": 30115,
                        "shop_id": 105,
                        "name": "Букет №42",
                        "slug": "buket-42-935",
                        "price": 4275,
                        "description": "Цветы способны унести нас в мир иллюзий и фантазии, подарить истинное наслаждение их внешним видом и ароматом.Если вы решили не просто купить живые цветы, а сделать оригинальный и стильный подарок, то данная композиция будет кстати.Мы рады что вы выбрали салон \"Флорентина\" Мы дарим средство для продления жизни цветов в подарок.",
                        "photo": "p105_1529742364_52463.jpg",
                        "make_time": 90,
                        "width": 20,
                        "height": 25,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 10,
                        "product_type_id": 3,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 98804204,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 6,
                        "clientPrice": 6008,
                        "url": "http://floristum.ru/flowers/buket-42-935",
                        "photoUrl": "/uploads/products/105/351x351_c/p105_1529742364_52463.jpg",
                        "fullPrice": 6008,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 105,
                            "name": "Флорентина",
                            "delivery_price": "450.00",
                            "delivery_time": 90
                        },
                        "photos": [
                            {
                                "id": 31477,
                                "product_id": 30115,
                                "photo": "p105_1529742364_52463.jpg",
                                "created_at": "2018-06-23 11:26:04",
                                "updated_at": "2019-05-05 20:05:08",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/105\\/p105_1529742364_52463\",\"version\":1557075907,\"signature\":\"463c1025be4d278f1a8948d3a57249078d6e7df4\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:05:07Z\",\"tags\":[],\"bytes\":75405,\"type\":\"upload\",\"etag\":\"7f326c0bd6b32cd6e9c5a41e39dede0b\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075907\\/632x632\\/105\\/p105_1529742364_52463.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075907\\/632x632\\/105\\/p105_1529742364_52463.jpg\",\"original_filename\":\"p105_1529742364_52463\"},\"350x350\":{\"public_id\":\"350x350\\/105\\/p105_1529742364_52463\",\"version\":1557075908,\"signature\":\"3e7cfc681fad363625b8f0e372ea69f55dbd146d\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:05:08Z\",\"tags\":[],\"bytes\":29427,\"type\":\"upload\",\"etag\":\"db398a30b3eda0676e793400eeb3a6e0\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075908\\/350x350\\/105\\/p105_1529742364_52463.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075908\\/350x350\\/105\\/p105_1529742364_52463.jpg\",\"original_filename\":\"p105_1529742364_52463\"}}"
                            }
                        ]
                    },
                    {
                        "id": 30117,
                        "shop_id": 105,
                        "name": "Букет №44",
                        "slug": "buket-44-824",
                        "price": 2375,
                        "description": "Цветы способны унести нас в мир иллюзий и фантазии, подарить истинное наслаждение их внешним видом и ароматом.Если вы решили не просто купить живые цветы, а сделать оригинальный и стильный подарок, то данная композиция будет кстати.Мы рады что вы выбрали салон \"Флорентина\" Мы дарим средство для продления жизни цветов в подарок.",
                        "photo": "p105_1529743053_44063.png",
                        "make_time": 90,
                        "width": 20,
                        "height": 22,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 10,
                        "product_type_id": 3,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 72653485,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 6,
                        "clientPrice": 3538,
                        "url": "http://floristum.ru/flowers/buket-44-824",
                        "photoUrl": "/uploads/products/105/351x351_c/p105_1529743053_44063.png",
                        "fullPrice": 3538,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 105,
                            "name": "Флорентина",
                            "delivery_price": "450.00",
                            "delivery_time": 90
                        },
                        "photos": [
                            {
                                "id": 31479,
                                "product_id": 30117,
                                "photo": "p105_1529743053_44063.png",
                                "created_at": "2018-06-23 11:37:33",
                                "updated_at": "2019-05-05 20:05:16",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/105\\/p105_1529743053_44063\",\"version\":1557075912,\"signature\":\"6f6fb0536873af01c9d5fbfa71d65667f0e5b87a\",\"width\":632,\"height\":632,\"format\":\"png\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:05:12Z\",\"tags\":[],\"bytes\":260772,\"type\":\"upload\",\"etag\":\"65074053820e2880ddf49cbb1ac48f27\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075912\\/632x632\\/105\\/p105_1529743053_44063.png\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075912\\/632x632\\/105\\/p105_1529743053_44063.png\",\"original_filename\":\"p105_1529743053_44063\"},\"350x350\":{\"public_id\":\"350x350\\/105\\/p105_1529743053_44063\",\"version\":1557075915,\"signature\":\"f5138cab46d0d5b0607771c85a5082d424d3d0bb\",\"width\":350,\"height\":350,\"format\":\"png\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:05:15Z\",\"tags\":[],\"bytes\":96214,\"type\":\"upload\",\"etag\":\"11c9dbd0919b47f5b099e602c02c4267\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075915\\/350x350\\/105\\/p105_1529743053_44063.png\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075915\\/350x350\\/105\\/p105_1529743053_44063.png\",\"original_filename\":\"p105_1529743053_44063\"}}"
                            }
                        ]
                    },
                    {
                        "id": 30326,
                        "shop_id": 105,
                        "name": "Букет №253",
                        "slug": "buket-253-801",
                        "price": 4253,
                        "description": "Один из самых актуальных трендов флористики – цветы в коробках. Это все те же букеты, только в необычной \"обертке\". такой сюрприз можно вручить в любой ситуации. Тому, кого вы решите им порадовать, не придется ломать голову, куда бы поставить цветы, чтобы они не завяли. Устройство коробки не даст растениям страдать от недостатка влаги. Да и носить такую композицию с собой гораздо удобнее.К каждому заказу прилагается средство CHRYSAL для свежесрезанных растений в подарок.",
                        "photo": "p105_1529751702_57730.jpg",
                        "make_time": 90,
                        "width": 35,
                        "height": 25,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 1,
                        "product_type_id": 3,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 25313647,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 6,
                        "clientPrice": 5979,
                        "url": "http://floristum.ru/flowers/buket-253-801",
                        "photoUrl": "/uploads/products/105/351x351_c/p105_1529751702_57730.jpg",
                        "fullPrice": 5979,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 105,
                            "name": "Флорентина",
                            "delivery_price": "450.00",
                            "delivery_time": 90
                        },
                        "photos": [
                            {
                                "id": 31688,
                                "product_id": 30326,
                                "photo": "p105_1529751702_57730.jpg",
                                "created_at": "2018-06-23 14:01:42",
                                "updated_at": "2019-05-05 20:05:26",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/105\\/p105_1529751702_57730\",\"version\":1557075924,\"signature\":\"5787ccc7322076b1087ad99111e92da9ac6da9e6\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:05:24Z\",\"tags\":[],\"bytes\":101687,\"type\":\"upload\",\"etag\":\"1e13e49c7097e8e3df74ffc064fc5144\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075924\\/632x632\\/105\\/p105_1529751702_57730.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075924\\/632x632\\/105\\/p105_1529751702_57730.jpg\",\"original_filename\":\"p105_1529751702_57730\"},\"350x350\":{\"public_id\":\"350x350\\/105\\/p105_1529751702_57730\",\"version\":1557075926,\"signature\":\"40694be1ba8a0ca949f47ecb3742bf3a4982a09b\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:05:26Z\",\"tags\":[],\"bytes\":39241,\"type\":\"upload\",\"etag\":\"707a21e74b44c7ecd1fc9be00757955f\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075926\\/350x350\\/105\\/p105_1529751702_57730.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075926\\/350x350\\/105\\/p105_1529751702_57730.jpg\",\"original_filename\":\"p105_1529751702_57730\"}}"
                            }
                        ]
                    },
                    {
                        "id": 30327,
                        "shop_id": 105,
                        "name": "Букет №254",
                        "slug": "buket-254-610",
                        "price": 3336,
                        "description": "Один из самых актуальных трендов флористики – цветы в коробках. Это все те же букеты, только в необычной \"обертке\". такой сюрприз можно вручить в любой ситуации. Тому, кого вы решите им порадовать, не придется ломать голову, куда бы поставить цветы, чтобы они не завяли. Устройство коробки не даст растениям страдать от недостатка влаги. Да и носить такую композицию с собой гораздо удобнее.К каждому заказу прилагается средство CHRYSAL для свежесрезанных растений в подарок.",
                        "photo": "p105_1529751840_10652.jpg",
                        "make_time": 90,
                        "width": 21,
                        "height": 35,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 10,
                        "product_type_id": 3,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 6432274,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 6,
                        "clientPrice": 4787,
                        "url": "http://floristum.ru/flowers/buket-254-610",
                        "photoUrl": "/uploads/products/105/351x351_c/p105_1529751840_10652.jpg",
                        "fullPrice": 4787,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 105,
                            "name": "Флорентина",
                            "delivery_price": "450.00",
                            "delivery_time": 90
                        },
                        "photos": [
                            {
                                "id": 31689,
                                "product_id": 30327,
                                "photo": "p105_1529751840_10652.jpg",
                                "created_at": "2018-06-23 14:04:00",
                                "updated_at": "2019-05-05 20:05:29",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/105\\/p105_1529751840_10652\",\"version\":1557075927,\"signature\":\"c8ca0e8beef53ed6ceb6b969fd0bb744e1c06879\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:05:27Z\",\"tags\":[],\"bytes\":58556,\"type\":\"upload\",\"etag\":\"181765159faaeb818a273fda4ac42a1a\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075927\\/632x632\\/105\\/p105_1529751840_10652.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075927\\/632x632\\/105\\/p105_1529751840_10652.jpg\",\"original_filename\":\"p105_1529751840_10652\"},\"350x350\":{\"public_id\":\"350x350\\/105\\/p105_1529751840_10652\",\"version\":1557075928,\"signature\":\"c81ca81faa8e7a591e8b249ba9099300d388d1fe\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:05:28Z\",\"tags\":[],\"bytes\":24576,\"type\":\"upload\",\"etag\":\"d0efa44f086c692c3a0577ac989b4794\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075928\\/350x350\\/105\\/p105_1529751840_10652.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075928\\/350x350\\/105\\/p105_1529751840_10652.jpg\",\"original_filename\":\"p105_1529751840_10652\"}}"
                            }
                        ]
                    },
                    {
                        "id": 30329,
                        "shop_id": 105,
                        "name": "Букет №256",
                        "slug": "buket-256-187",
                        "price": 3040,
                        "description": "Один из самых актуальных трендов флористики – цветы в коробках. Это все те же букеты, только в необычной \"обертке\". такой сюрприз можно вручить в любой ситуации. Тому, кого вы решите им порадовать, не придется ломать голову, куда бы поставить цветы, чтобы они не завяли. Устройство коробки не даст растениям страдать от недостатка влаги. Да и носить такую композицию с собой гораздо удобнее.К каждому заказу прилагается средство CHRYSAL для свежесрезанных растений в подарок.",
                        "photo": "p105_1529752344_24469.jpg",
                        "make_time": 90,
                        "width": 18,
                        "height": 22,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 7,
                        "product_type_id": 3,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 36066872,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 6,
                        "clientPrice": 4402,
                        "url": "http://floristum.ru/flowers/buket-256-187",
                        "photoUrl": "/uploads/products/105/351x351_c/p105_1529752344_24469.jpg",
                        "fullPrice": 4402,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 105,
                            "name": "Флорентина",
                            "delivery_price": "450.00",
                            "delivery_time": 90
                        },
                        "photos": [
                            {
                                "id": 31691,
                                "product_id": 30329,
                                "photo": "p105_1529752344_24469.jpg",
                                "created_at": "2018-06-23 14:12:24",
                                "updated_at": "2019-05-05 20:05:34",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/105\\/p105_1529752344_24469\",\"version\":1557075933,\"signature\":\"c68050c180da9b1180c2ffd9beb74ec3b1e9960f\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:05:33Z\",\"tags\":[],\"bytes\":62345,\"type\":\"upload\",\"etag\":\"08d17a5b2607094824ba179f1cd485e9\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075933\\/632x632\\/105\\/p105_1529752344_24469.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075933\\/632x632\\/105\\/p105_1529752344_24469.jpg\",\"original_filename\":\"p105_1529752344_24469\"},\"350x350\":{\"public_id\":\"350x350\\/105\\/p105_1529752344_24469\",\"version\":1557075934,\"signature\":\"450e9b85fe7469510c0dacaf2f8a00c4cb5ea383\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:05:34Z\",\"tags\":[],\"bytes\":25361,\"type\":\"upload\",\"etag\":\"2d511c0848e405776d340281611e7190\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075934\\/350x350\\/105\\/p105_1529752344_24469.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075934\\/350x350\\/105\\/p105_1529752344_24469.jpg\",\"original_filename\":\"p105_1529752344_24469\"}}"
                            }
                        ]
                    }
                ],
                "first_page_url": "http://floristum.ru/api/main/641780?page=1",
                "from": 1,
                "last_page": 3,
                "last_page_url": "http://floristum.ru/api/main/641780?page=3",
                "next_page_url": "http://floristum.ru/api/main/641780?page=2",
                "path": "http://floristum.ru/api/main/641780",
                "per_page": 8,
                "prev_page_url": null,
                "to": 8,
                "total": 21
            },
            "request": "products/3"
        },
        {
            "name": "Корзины",
            "products": {
                "current_page": 1,
                "data": [
                    {
                        "id": 866,
                        "shop_id": 31,
                        "name": "Разноцветная корзинка",
                        "slug": "raznotsvetnaya-korzinka",
                        "price": 9500,
                        "description": "Пышная и ароматная разноцветная корзина кустовых роз! Состав: роза кустовая-55 шт Упаковка: корзина, флористическая пена",
                        "photo": "p31_1516875426_58158.jpg",
                        "make_time": 120,
                        "width": 60,
                        "height": 50,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 10,
                        "product_type_id": 4,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 12805298,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 7,
                        "clientPrice": 12700,
                        "url": "http://floristum.ru/flowers/raznotsvetnaya-korzinka",
                        "photoUrl": "/uploads/products/31/351x351_c/p31_1516875426_58158.jpg",
                        "fullPrice": 12700,
                        "deliveryTime": "2ч.",
                        "shop": {
                            "id": 31,
                            "name": "Anneyes",
                            "delivery_price": "350.00",
                            "delivery_time": 120
                        },
                        "photos": [
                            {
                                "id": 903,
                                "product_id": 866,
                                "photo": "p31_1516875426_58158.jpg",
                                "created_at": "2018-02-09 13:32:05",
                                "updated_at": "2019-05-05 12:10:29",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/31\\/p31_1516875426_58158\",\"version\":1557047427,\"signature\":\"13e970f702ddf60e7773047241e2126b771ead3a\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:27Z\",\"tags\":[],\"bytes\":67453,\"type\":\"upload\",\"etag\":\"4ed7fdea3879ab0ff754e4c546f287e1\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047427\\/632x632\\/31\\/p31_1516875426_58158.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047427\\/632x632\\/31\\/p31_1516875426_58158.jpg\",\"original_filename\":\"p31_1516875426_58158\"},\"350x350\":{\"public_id\":\"350x350\\/31\\/p31_1516875426_58158\",\"version\":1557047429,\"signature\":\"255d70bbd532ddb433b0e02e35467d30f821da80\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T09:10:29Z\",\"tags\":[],\"bytes\":45404,\"type\":\"upload\",\"etag\":\"ac5f6ffa4e92ed1ccad7478827f73907\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047429\\/350x350\\/31\\/p31_1516875426_58158.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557047429\\/350x350\\/31\\/p31_1516875426_58158.jpg\",\"original_filename\":\"p31_1516875426_58158\"}}"
                            }
                        ]
                    },
                    {
                        "id": 30099,
                        "shop_id": 105,
                        "name": "Букет №29",
                        "slug": "buket-29-554",
                        "price": 2185,
                        "description": "Корзинка с орхидеей от салона Флорентина..",
                        "photo": "p105_1529730760_71312.jpg",
                        "make_time": 90,
                        "width": 17,
                        "height": 20,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 2,
                        "product_type_id": 4,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 49364518,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 7,
                        "clientPrice": 3291,
                        "url": "http://floristum.ru/flowers/buket-29-554",
                        "photoUrl": "/uploads/products/105/351x351_c/p105_1529730760_71312.jpg",
                        "fullPrice": 3291,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 105,
                            "name": "Флорентина",
                            "delivery_price": "450.00",
                            "delivery_time": 90
                        },
                        "photos": [
                            {
                                "id": 31459,
                                "product_id": 30099,
                                "photo": "p105_1529730760_71312.jpg",
                                "created_at": "2018-06-23 08:12:40",
                                "updated_at": "2019-05-05 20:03:21",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/105\\/p105_1529730760_71312\",\"version\":1557075799,\"signature\":\"a941de902cb710be2d6a5c83d209c04c22cceb0e\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:03:19Z\",\"tags\":[],\"bytes\":50192,\"type\":\"upload\",\"etag\":\"a6a71d15cbdc58e19656bbe8e3d24aff\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075799\\/632x632\\/105\\/p105_1529730760_71312.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075799\\/632x632\\/105\\/p105_1529730760_71312.jpg\",\"original_filename\":\"p105_1529730760_71312\"},\"350x350\":{\"public_id\":\"350x350\\/105\\/p105_1529730760_71312\",\"version\":1557075801,\"signature\":\"bfb5acbd7cb61ddfbc789ac020cbcf13231a26df\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:03:21Z\",\"tags\":[],\"bytes\":34074,\"type\":\"upload\",\"etag\":\"5bbbc2a91ca6d92e2a15b8d100e7a805\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075801\\/350x350\\/105\\/p105_1529730760_71312.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075801\\/350x350\\/105\\/p105_1529730760_71312.jpg\",\"original_filename\":\"p105_1529730760_71312\"}}"
                            }
                        ]
                    },
                    {
                        "id": 30324,
                        "shop_id": 105,
                        "name": "Букет №251",
                        "slug": "buket-251-496",
                        "price": 3703,
                        "description": "Замечательная корзина из красных роз. Долго будет радовать Вас своим благоуханием и свежестью.Мы рады что Вы выбрали наш магазин Флорентина , и дарим Вам средство для продления жизни цветов в подарок.",
                        "photo": "p105_1529751283_72815.jpg",
                        "make_time": 90,
                        "width": 35,
                        "height": 37,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 1,
                        "product_type_id": 4,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 50499640,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 7,
                        "clientPrice": 5264,
                        "url": "http://floristum.ru/flowers/buket-251-496",
                        "photoUrl": "/uploads/products/105/351x351_c/p105_1529751283_72815.jpg",
                        "fullPrice": 5264,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 105,
                            "name": "Флорентина",
                            "delivery_price": "450.00",
                            "delivery_time": 90
                        },
                        "photos": [
                            {
                                "id": 31686,
                                "product_id": 30324,
                                "photo": "p105_1529751283_72815.jpg",
                                "created_at": "2018-06-23 13:54:44",
                                "updated_at": "2019-05-05 20:05:18",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/105\\/p105_1529751283_72815\",\"version\":1557075916,\"signature\":\"714195f1c66da536110d56c3404b49e75da792f3\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:05:16Z\",\"tags\":[],\"bytes\":79016,\"type\":\"upload\",\"etag\":\"619c6dc9133780272f09f456c1f0c19a\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075916\\/632x632\\/105\\/p105_1529751283_72815.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075916\\/632x632\\/105\\/p105_1529751283_72815.jpg\",\"original_filename\":\"p105_1529751283_72815\"},\"350x350\":{\"public_id\":\"350x350\\/105\\/p105_1529751283_72815\",\"version\":1557075918,\"signature\":\"62a9fea3157361204b42fdada8834986ad8077d9\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:05:18Z\",\"tags\":[],\"bytes\":32577,\"type\":\"upload\",\"etag\":\"ba9a0b47b28c03aa74ca4f0f80743f9a\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075918\\/350x350\\/105\\/p105_1529751283_72815.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075918\\/350x350\\/105\\/p105_1529751283_72815.jpg\",\"original_filename\":\"p105_1529751283_72815\"}}"
                            }
                        ]
                    },
                    {
                        "id": 30335,
                        "shop_id": 105,
                        "name": "Букет №261",
                        "slug": "buket-261-956",
                        "price": 3146,
                        "description": "Замечательная корзина из розовых роз. Долго будет радовать Вас своим благоуханием и свежестью. Мы рады ,что Вы выбрали наш салон.К каждому заказу прилагается средство CHRYSAL для свежесрезанных растений в подарок.",
                        "photo": "p105_1529753228_13212.jpg",
                        "make_time": 90,
                        "width": 35,
                        "height": 25,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 2,
                        "product_type_id": 4,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 51169591,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 7,
                        "clientPrice": 4540,
                        "url": "http://floristum.ru/flowers/buket-261-956",
                        "photoUrl": "/uploads/products/105/351x351_c/p105_1529753228_13212.jpg",
                        "fullPrice": 4540,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 105,
                            "name": "Флорентина",
                            "delivery_price": "450.00",
                            "delivery_time": 90
                        },
                        "photos": [
                            {
                                "id": 31697,
                                "product_id": 30335,
                                "photo": "p105_1529753228_13212.jpg",
                                "created_at": "2018-06-23 14:27:08",
                                "updated_at": "2019-05-05 20:06:12",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/105\\/p105_1529753228_13212\",\"version\":1557075970,\"signature\":\"83fc00d70860f0ec1d12aeb9915d5de6186169f8\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:06:10Z\",\"tags\":[],\"bytes\":82378,\"type\":\"upload\",\"etag\":\"886621e6ef2c1732dc780a27b8f1232f\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075970\\/632x632\\/105\\/p105_1529753228_13212.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075970\\/632x632\\/105\\/p105_1529753228_13212.jpg\",\"original_filename\":\"p105_1529753228_13212\"},\"350x350\":{\"public_id\":\"350x350\\/105\\/p105_1529753228_13212\",\"version\":1557075972,\"signature\":\"8ded5257081d63b7a53dab97b0725cd7572ecbdb\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T17:06:12Z\",\"tags\":[],\"bytes\":33086,\"type\":\"upload\",\"etag\":\"6a2c08c783e6a44472b5f759d3c61221\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075972\\/350x350\\/105\\/p105_1529753228_13212.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075972\\/350x350\\/105\\/p105_1529753228_13212.jpg\",\"original_filename\":\"p105_1529753228_13212\"}}"
                            }
                        ]
                    },
                    {
                        "id": 111374,
                        "shop_id": 843,
                        "name": "Корзина из 85 роз",
                        "slug": "korzina-iz-85-roz-363",
                        "price": 9500,
                        "description": "Корзина из 85 роз не оставит равнодушным никого!",
                        "photo": "p843_1573057231_95591.jpg",
                        "make_time": 90,
                        "width": 45,
                        "height": 50,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 1,
                        "product_type_id": 4,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 269131,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": null,
                        "clientPrice": 12650,
                        "url": "http://floristum.ru/flowers/korzina-iz-85-roz-363",
                        "photoUrl": "/uploads/products/843/351x351_c/p843_1573057231_95591.jpg",
                        "fullPrice": 12650,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 843,
                            "name": "Цветочница",
                            "delivery_price": "300.00",
                            "delivery_time": 60
                        },
                        "photos": [
                            {
                                "id": 117042,
                                "product_id": 111374,
                                "photo": "p843_1573057231_95591.jpg",
                                "created_at": "2019-11-06 19:20:32",
                                "updated_at": "2019-11-06 19:20:32",
                                "priority": 0,
                                "cdn_response": null
                            }
                        ]
                    },
                    {
                        "id": 111378,
                        "shop_id": 843,
                        "name": "Корзинка с хризантемой",
                        "slug": "korzinka-s-khrizantemoy-461",
                        "price": 1350,
                        "description": "Яркая корзинка с хризантемкой.",
                        "photo": "p843_1573057787_50406.jpg",
                        "make_time": 30,
                        "width": 30,
                        "height": 30,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 7,
                        "product_type_id": 4,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 95624818,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": null,
                        "clientPrice": 2055,
                        "url": "http://floristum.ru/flowers/korzinka-s-khrizantemoy-461",
                        "photoUrl": "/uploads/products/843/351x351_c/p843_1573057787_50406.jpg",
                        "fullPrice": 2055,
                        "deliveryTime": " 30мин.",
                        "shop": {
                            "id": 843,
                            "name": "Цветочница",
                            "delivery_price": "300.00",
                            "delivery_time": 60
                        },
                        "photos": [
                            {
                                "id": 117048,
                                "product_id": 111378,
                                "photo": "p843_1573057787_50406.jpg",
                                "created_at": "2019-11-06 19:29:47",
                                "updated_at": "2019-11-06 19:29:47",
                                "priority": 0,
                                "cdn_response": null
                            }
                        ]
                    },
                    {
                        "id": 111381,
                        "shop_id": 843,
                        "name": "33 Хризантемы в корзине",
                        "slug": "33-khrizantemy-v-korzine-948",
                        "price": 4925,
                        "description": "33 Хризантемы в корзине.",
                        "photo": "p843_1573058250_63504.jpeg",
                        "make_time": 30,
                        "width": 45,
                        "height": 45,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 9,
                        "product_type_id": 4,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 77462110,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": null,
                        "clientPrice": 6703,
                        "url": "http://floristum.ru/flowers/33-khrizantemy-v-korzine-948",
                        "photoUrl": "/uploads/products/843/351x351_c/p843_1573058250_63504.jpeg",
                        "fullPrice": 6703,
                        "deliveryTime": " 30мин.",
                        "shop": {
                            "id": 843,
                            "name": "Цветочница",
                            "delivery_price": "300.00",
                            "delivery_time": 60
                        },
                        "photos": [
                            {
                                "id": 117051,
                                "product_id": 111381,
                                "photo": "p843_1573058250_63504.jpeg",
                                "created_at": "2019-11-06 19:37:30",
                                "updated_at": "2019-11-06 19:37:30",
                                "priority": 0,
                                "cdn_response": null
                            }
                        ]
                    }
                ],
                "first_page_url": "http://floristum.ru/api/main/641780?page=1",
                "from": 1,
                "last_page": 1,
                "last_page_url": "http://floristum.ru/api/main/641780?page=1",
                "next_page_url": null,
                "path": "http://floristum.ru/api/main/641780",
                "per_page": 8,
                "prev_page_url": null,
                "to": 7,
                "total": 7
            },
            "request": "products/4"
        },
        {
            "name": "Фрукты",
            "products": {
                "current_page": 1,
                "data": [
                    {
                        "id": 30047,
                        "shop_id": 105,
                        "name": "Букет №3",
                        "slug": "buket-3-152",
                        "price": 3040,
                        "description": "Подарочная корзина с сезонными фруктами  (3  кг.) не оставит равнодушной ни одну девушку.\nМы рады ,что Вы выбрали наш салон \"Флорентина\".",
                        "photo": "p105_1529684806_32279.jpg",
                        "make_time": 90,
                        "width": 35,
                        "height": 30,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 10,
                        "product_type_id": 9,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 68742778,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 9,
                        "clientPrice": 4402,
                        "url": "http://floristum.ru/flowers/buket-3-152",
                        "photoUrl": "/uploads/products/105/351x351_c/p105_1529684806_32279.jpg",
                        "fullPrice": 4402,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 105,
                            "name": "Флорентина",
                            "delivery_price": "450.00",
                            "delivery_time": 90
                        },
                        "photos": [
                            {
                                "id": 31405,
                                "product_id": 30047,
                                "photo": "p105_1529684806_32279.jpg",
                                "created_at": "2018-06-22 19:26:46",
                                "updated_at": "2019-05-05 19:59:40",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/105\\/p105_1529684806_32279\",\"version\":1557075578,\"signature\":\"59b017d0acc35b8551338a60b7fd35cba3033758\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T16:59:38Z\",\"tags\":[],\"bytes\":61896,\"type\":\"upload\",\"etag\":\"6600418b037edcb1c18ecb33123edc3b\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075578\\/632x632\\/105\\/p105_1529684806_32279.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075578\\/632x632\\/105\\/p105_1529684806_32279.jpg\",\"original_filename\":\"p105_1529684806_32279\"},\"350x350\":{\"public_id\":\"350x350\\/105\\/p105_1529684806_32279\",\"version\":1557075579,\"signature\":\"3e69488bffb509004aae5e28c933b3d99286fadc\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T16:59:39Z\",\"tags\":[],\"bytes\":26156,\"type\":\"upload\",\"etag\":\"568cea4f18f42e572a081cb6c6743aae\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075579\\/350x350\\/105\\/p105_1529684806_32279.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557075579\\/350x350\\/105\\/p105_1529684806_32279.jpg\",\"original_filename\":\"p105_1529684806_32279\"}}"
                            }
                        ]
                    },
                    {
                        "id": 111385,
                        "shop_id": 843,
                        "name": "Фрутэтто",
                        "slug": "frutetto-872",
                        "price": 3000,
                        "description": "Красиво, ароматно и вкусно! Букет из фруктов с оформлением от наших цветочных фей)",
                        "photo": "p843_1573058977_77811.png",
                        "make_time": 120,
                        "width": 30,
                        "height": 30,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 10,
                        "product_type_id": 9,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 82133937,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": null,
                        "clientPrice": 4200,
                        "url": "http://floristum.ru/flowers/frutetto-872",
                        "photoUrl": "/uploads/products/843/351x351_c/p843_1573058977_77811.png",
                        "fullPrice": 4200,
                        "deliveryTime": "2ч.",
                        "shop": {
                            "id": 843,
                            "name": "Цветочница",
                            "delivery_price": "300.00",
                            "delivery_time": 60
                        },
                        "photos": [
                            {
                                "id": 117055,
                                "product_id": 111385,
                                "photo": "p843_1573058977_77811.png",
                                "created_at": "2019-11-06 19:49:38",
                                "updated_at": "2019-11-06 19:49:38",
                                "priority": 0,
                                "cdn_response": null
                            }
                        ]
                    }
                ],
                "first_page_url": "http://floristum.ru/api/main/641780?page=1",
                "from": 1,
                "last_page": 1,
                "last_page_url": "http://floristum.ru/api/main/641780?page=1",
                "next_page_url": null,
                "path": "http://floristum.ru/api/main/641780",
                "per_page": 8,
                "prev_page_url": null,
                "to": 2,
                "total": 2
            },
            "request": "products/9"
        },
        {
            "name": "Лакомства",
            "products": {
                "current_page": 1,
                "data": [
                    {
                        "id": 2672,
                        "shop_id": 105,
                        "name": "Букет №2",
                        "slug": "buket-2-1520850684",
                        "price": 4800,
                        "description": "Букет из роз в асс. торт и мягкая игрушка. Медведь может отличаться от фото)",
                        "photo": "p105_1520850683_87378.jpg",
                        "make_time": 90,
                        "width": 35,
                        "height": 50,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 1,
                        "product_type_id": 10,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 59563678,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 9,
                        "clientPrice": 6690,
                        "url": "http://floristum.ru/flowers/buket-2-1520850684",
                        "photoUrl": "/uploads/products/105/351x351_c/p105_1520850683_87378.jpg",
                        "fullPrice": 6690,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 105,
                            "name": "Флорентина",
                            "delivery_price": "450.00",
                            "delivery_time": 90
                        },
                        "photos": [
                            {
                                "id": 3468,
                                "product_id": 2672,
                                "photo": "p105_1520850683_87378.jpg",
                                "created_at": "2018-03-12 13:31:24",
                                "updated_at": "2019-05-05 14:47:18",
                                "priority": 0,
                                "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\/105\\/p105_1520850683_87378\",\"version\":1557056836,\"signature\":\"b5f31aafd4de71b2bc397dd756fc3a503f84371e\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T11:47:16Z\",\"tags\":[],\"bytes\":70281,\"type\":\"upload\",\"etag\":\"a5af1087e0b630322e391542715706bb\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557056836\\/632x632\\/105\\/p105_1520850683_87378.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557056836\\/632x632\\/105\\/p105_1520850683_87378.jpg\",\"original_filename\":\"p105_1520850683_87378\"},\"350x350\":{\"public_id\":\"350x350\\/105\\/p105_1520850683_87378\",\"version\":1557056838,\"signature\":\"897df7d64c052c782052828357ddd8183af62d0a\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T11:47:18Z\",\"tags\":[],\"bytes\":29413,\"type\":\"upload\",\"etag\":\"b31478b196baac2dd3dadcf0dd47a4bf\",\"placeholder\":false,\"url\":\"http:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557056838\\/350x350\\/105\\/p105_1520850683_87378.jpg\",\"secure_url\":\"https:\\/\\/res.cloudinary.com\\/floristum\\/image\\/upload\\/v1557056838\\/350x350\\/105\\/p105_1520850683_87378.jpg\",\"original_filename\":\"p105_1520850683_87378\"}}"
                            }
                        ]
                    },
                    {
                        "id": 68444,
                        "shop_id": 105,
                        "name": "Букет №267",
                        "slug": "buket-267-640",
                        "price": 1794,
                        "description": "Что может быть прекраснее живых цветов? Они всегда будут отличным подарком, комплиментом или просто способом порадовать близкого человека. А если вся эта прелесть упакована в красивую подарочную коробку, то восторг гарантирован! Подарочные коробки с живыми цветами — новинка в мире подарков и флористики. Таким сюрпризом можно удивить самого избалованного получателя! Нежные цветочки в замечательных коробках Цветы коротко подрезаны и установлены в пропитанную специальным раствором флористическую губку, что позволяет им оставаться свежими длительное время, требует минимального полива.",
                        "photo": "p105_1549460795_64410.jpg",
                        "make_time": 90,
                        "width": 17,
                        "height": 15,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 10,
                        "product_type_id": 10,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 93786300,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 9,
                        "clientPrice": 2783,
                        "url": "http://floristum.ru/flowers/buket-267-640",
                        "photoUrl": "/uploads/products/105/351x351_c/p105_1549460795_64410.jpg",
                        "fullPrice": 2783,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 105,
                            "name": "Флорентина",
                            "delivery_price": "450.00",
                            "delivery_time": 90
                        },
                        "photos": [
                            {
                                "id": 71560,
                                "product_id": 68444,
                                "photo": "p105_1549460795_64410.jpg",
                                "created_at": "2019-02-06 16:46:35",
                                "updated_at": "2019-02-06 16:46:35",
                                "priority": 0,
                                "cdn_response": null
                            }
                        ]
                    },
                    {
                        "id": 68448,
                        "shop_id": 105,
                        "name": "Букет №270",
                        "slug": "buket-270-768",
                        "price": 3800,
                        "description": "Выбрать оригинальный подарок несложно, но как подобрать такой презент, чтобы он не только поразил своей оригинальностью, а и навсегда остался в памяти любимой девушки, женщины или просто дорогого вам человека? Как показать всю свою любовь, нежность и безграничное уважение, но при этом не произнести ни одного слова? В такой ситуации на помощь приходят цветы в шляпной коробке.Мы со своей стороны максимально постараемся сделать так,чтобы обрадовать не только получателя букета,но и оставить хорошее впечатление для Вас о проделанной работе!",
                        "photo": "p105_1549460925_92932.jpg",
                        "make_time": 90,
                        "width": 21,
                        "height": 20,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 10,
                        "product_type_id": 10,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 8675318,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 9,
                        "clientPrice": 5390,
                        "url": "http://floristum.ru/flowers/buket-270-768",
                        "photoUrl": "/uploads/products/105/351x351_c/p105_1549460925_92932.jpg",
                        "fullPrice": 5390,
                        "deliveryTime": "1ч. 30мин.",
                        "shop": {
                            "id": 105,
                            "name": "Флорентина",
                            "delivery_price": "450.00",
                            "delivery_time": 90
                        },
                        "photos": [
                            {
                                "id": 71564,
                                "product_id": 68448,
                                "photo": "p105_1549460925_92932.jpg",
                                "created_at": "2019-02-06 16:48:45",
                                "updated_at": "2019-02-06 16:48:45",
                                "priority": 0,
                                "cdn_response": null
                            }
                        ]
                    },
                    {
                        "id": 47826,
                        "shop_id": 374,
                        "name": "Букет №208",
                        "slug": "buket-208-579",
                        "price": 2060,
                        "description": "Деревянный ящичек с цветами и нежнейшими макарунами",
                        "photo": "p374_1539327388_32545.jpg",
                        "make_time": 240,
                        "width": 25,
                        "height": 25,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 10,
                        "product_type_id": 10,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 50669511,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": 9,
                        "clientPrice": 2978,
                        "url": "http://floristum.ru/flowers/buket-208-579",
                        "photoUrl": "/uploads/products/374/351x351_c/p374_1539327388_32545.jpg",
                        "fullPrice": 2978,
                        "deliveryTime": "4ч.",
                        "shop": {
                            "id": 374,
                            "name": "Жасмин",
                            "delivery_price": "300.00",
                            "delivery_time": 120
                        },
                        "photos": [
                            {
                                "id": 49662,
                                "product_id": 47826,
                                "photo": "p374_1539327388_32545.jpg",
                                "created_at": "2018-10-12 09:56:29",
                                "updated_at": "2018-10-12 09:56:29",
                                "priority": 0,
                                "cdn_response": null
                            }
                        ]
                    },
                    {
                        "id": 111383,
                        "shop_id": 843,
                        "name": "Коробочка цветы + киндер",
                        "slug": "korobochka-tsvety-kinder-910",
                        "price": 2950,
                        "description": "Коробочка с цветами и сладостями.",
                        "photo": "p843_1573058447_46880.jpg",
                        "make_time": 60,
                        "width": 25,
                        "height": 20,
                        "dop": 0,
                        "approved": 0,
                        "color_id": 1,
                        "product_type_id": 10,
                        "status": 1,
                        "status_comment": null,
                        "pause": 0,
                        "special_offer_id": null,
                        "sort": 92005320,
                        "single": null,
                        "status_comment_at": null,
                        "star": 0,
                        "block_id": null,
                        "clientPrice": 4135,
                        "url": "http://floristum.ru/flowers/korobochka-tsvety-kinder-910",
                        "photoUrl": "/uploads/products/843/351x351_c/p843_1573058447_46880.jpg",
                        "fullPrice": 4135,
                        "deliveryTime": "1ч.",
                        "shop": {
                            "id": 843,
                            "name": "Цветочница",
                            "delivery_price": "300.00",
                            "delivery_time": 60
                        },
                        "photos": [
                            {
                                "id": 117053,
                                "product_id": 111383,
                                "photo": "p843_1573058447_46880.jpg",
                                "created_at": "2019-11-06 19:40:47",
                                "updated_at": "2019-11-06 19:40:47",
                                "priority": 0,
                                "cdn_response": null
                            }
                        ]
                    }
                ],
                "first_page_url": "http://floristum.ru/api/main/641780?page=1",
                "from": 1,
                "last_page": 1,
                "last_page_url": "http://floristum.ru/api/main/641780?page=1",
                "next_page_url": null,
                "path": "http://floristum.ru/api/main/641780",
                "per_page": 8,
                "prev_page_url": null,
                "to": 5,
                "total": 5
            },
            "request": "products/10"
        }
    ]
}
         */

        public function main($cityId, Request $request) {
                $return = [];
                $popularProducts = [];
                $innerRequest = new Request();

                $productTypes = ProductType::select(['id', 'name'])->where('show_on_main', '1')->inCity($cityId)->orderBy('priority')->get();
                foreach($productTypes as $productType) {
                        $productType->request = 'productType/'.$productType->id;

                        $innerRequest->productType = $productType->id;
                        $_popularProduct = [
                                'name' => $productType->name,
                                'products' => Product::popular($cityId, $innerRequest, 1, 8),
                                'request' => 'products/'.$productType->id
                        ];

                        $popularProducts[] = $_popularProduct;
                }
                $return['productTypes'] = $productTypes;
                $return['products'] = $popularProducts;


                return $return;
        }
}