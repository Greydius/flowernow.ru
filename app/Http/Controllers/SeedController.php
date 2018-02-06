<?php

namespace App\Http\Controllers;

use App\Model\City;
use App\Model\Flower;
use App\Model\ProductType;
use App\Model\Region;
use Illuminate\Http\Request;

class SeedController extends Controller
{
    //

        public function insertRegionData() {
                $json = "[
           {\"id\":\"637640\",\"name\":\"Москва\"},
           {\"id\":\"637680\",\"name\":\"Московская область\"},
           {\"id\":\"653240\",\"name\":\"Санкт-Петербург\"},
           {\"id\":\"636370\",\"name\":\"Ленинградская область\"},{\"id\":\"645530\",\"name\":\"Адыгея\"},{\"id\":\"621590\",\"name\":\"Алтайский край\"},{\"id\":\"622470\",\"name\":\"Амурская область\"},{\"id\":\"622650\",\"name\":\"Архангельская область\"},{\"id\":\"623110\",\"name\":\"Астраханская область\"},{\"id\":\"645790\",\"name\":\"Башкортостан\"},{\"id\":\"623410\",\"name\":\"Белгородская область\"},{\"id\":\"623840\",\"name\":\"Брянская область\"},{\"id\":\"623845\",\"name\":\"Бурятия\"},{\"id\":\"624300\",\"name\":\"Владимирская область\"},{\"id\":\"624770\",\"name\":\"Волгоградская область\"},{\"id\":\"625330\",\"name\":\"Вологодская область\"},{\"id\":\"625670\",\"name\":\"Воронежская область\"},{\"id\":\"646710\",\"name\":\"Дагестан\"},{\"id\":\"626470\",\"name\":\"Еврейская АО\"},{\"id\":\"661460\",\"name\":\"Забайкальский край\"},{\"id\":\"628450\",\"name\":\"Ивановская область\"},{\"id\":\"628455\",\"name\":\"Ингушетия\"},{\"id\":\"628780\",\"name\":\"Иркутская область\"},{\"id\":\"629430\",\"name\":\"Кабардино-Балкария\"},{\"id\":\"629990\",\"name\":\"Калининградская область\"},{\"id\":\"629995\",\"name\":\"Калмыкия\"},{\"id\":\"630270\",\"name\":\"Калужская область\"},{\"id\":\"630660\",\"name\":\"Камчатский край\"},{\"id\":\"630750\",\"name\":\"Карачаево-Черкесия\"},{\"id\":\"648070\",\"name\":\"Карелия\"},{\"id\":\"631080\",\"name\":\"Кемеровская область\"},{\"id\":\"631730\",\"name\":\"Кировская область\"},{\"id\":\"648340\",\"name\":\"Коми\"},{\"id\":\"632390\",\"name\":\"Костромская область\"},{\"id\":\"632660\",\"name\":\"Краснодарский край\"},{\"id\":\"634930\",\"name\":\"Красноярский край\"},{\"id\":\"621550\",\"name\":\"Крым\"},{\"id\":\"635730\",\"name\":\"Курганская область\"},{\"id\":\"636030\",\"name\":\"Курская область\"},{\"id\":\"637260\",\"name\":\"Липецкая область\"},{\"id\":\"637530\",\"name\":\"Магаданская область\"},{\"id\":\"648730\",\"name\":\"Марий Эл\"},{\"id\":\"648960\",\"name\":\"Мордовия\"},{\"id\":\"640000\",\"name\":\"Мурманская область\"},{\"id\":\"640001\",\"name\":\"Ненецкий АО\"},{\"id\":\"640310\",\"name\":\"Нижегородская область\"},{\"id\":\"641240\",\"name\":\"Новгородская область\"},{\"id\":\"641470\",\"name\":\"Новосибирская область\"},{\"id\":\"642020\",\"name\":\"Омская область\"},{\"id\":\"642480\",\"name\":\"Оренбургская область\"},{\"id\":\"643030\",\"name\":\"Орловская область\"},{\"id\":\"643250\",\"name\":\"Пензенская область\"},{\"id\":\"643700\",\"name\":\"Пермский край\"},{\"id\":\"644490\",\"name\":\"Приморский край\"},{\"id\":\"645260\",\"name\":\"Псковская область\"},{\"id\":\"662811\",\"name\":\"Республика Алтай\"},{\"id\":\"651110\",\"name\":\"Ростовская область\"},{\"id\":\"652220\",\"name\":\"Рязанская область\"},{\"id\":\"652560\",\"name\":\"Самарская область\"},{\"id\":\"653420\",\"name\":\"Саратовская область\"},{\"id\":\"653430\",\"name\":\"Сахалинская область\"},{\"id\":\"649330\",\"name\":\"Саха (Якутия)\"},{\"id\":\"653700\",\"name\":\"Свердловская область\"},{\"id\":\"649820\",\"name\":\"Северная Осетия\"},{\"id\":\"654860\",\"name\":\"Смоленская область\"},{\"id\":\"655190\",\"name\":\"Ставропольский край\"},{\"id\":\"656520\",\"name\":\"Тамбовская область\"},{\"id\":\"650130\",\"name\":\"Татарстан\"},{\"id\":\"656890\",\"name\":\"Тверская область\"},{\"id\":\"657310\",\"name\":\"Томская область\"},{\"id\":\"657610\",\"name\":\"Тульская область\"},{\"id\":\"650690\",\"name\":\"Тыва\"},{\"id\":\"658170\",\"name\":\"Тюменская область\"},{\"id\":\"659200\",\"name\":\"Удмуртия\"},{\"id\":\"659540\",\"name\":\"Ульяновская область\"},{\"id\":\"659930\",\"name\":\"Хабаровский край\"},{\"id\":\"650890\",\"name\":\"Хакасия\"},{\"id\":\"660300\",\"name\":\"Ханты-Мансийский АО\"},{\"id\":\"660710\",\"name\":\"Челябинская область\"},{\"id\":\"660711\",\"name\":\"Чеченская Республика\"},{\"id\":\"662000\",\"name\":\"Чувашия\"},{\"id\":\"662280\",\"name\":\"Чукотский АО\"},{\"id\":\"662330\",\"name\":\"Ямало-Ненецкий АО\"},{\"id\":\"662530\",\"name\":\"Ярославская область\"}
        ]";
                $regions = json_decode($json);

                foreach ($regions as $item) {
                        $region = new Region();
                        $region->id = $item->id;
                        $region->name = $item->name;
                        //$region->save();
                }
        }

        public function insertCityData() {
                $regions = Region::where('used', 0)->get();

                foreach ($regions as $item) {
                        $json = file_get_contents('https://www.avito.ru/js/locations?json=true&id='.$item->id);

                        $cities = json_decode($json);
                        $data = [];
                        foreach ($cities as $city) {
                                $data[] = [
                                        'id' => $city->id,
                                        'name' => $city->name,
                                        'region_id' => $city->parentId,
                                        'name_prepositional' => $city->namePrepositional,
                                        'metro' => (int)$city->metroMap
                                ];
                        }
                        City::insert($data);
                        $item->used = 1;
                        $item->save();
                        echo $item->id.'<br>';
                        exit();
                }
        }
        
        function addCitySlug() {

                $cities = City::popular(300, false);

                foreach ($cities as $city) {
                        //echo "['".$city->name."' => '".$city->slug."'],<br>";
                        echo "['name' => '".$city->name."', 'slug' => '".$city->slug."'],<br>";
                }

                exit();

                $host = strtolower(request()->getHost());
                $shortHost = str_replace('floristum.ru', '', $host);
                $shortHost = str_replace('flowenow.ru', '', $shortHost);

                $subdomains = explode('.', $shortHost);
                if(count($subdomains) > 2) {
                        abort(404);
                }

                $subdomain = current($subdomains);

                if(empty($subdomain) || $subdomain == 'www') {
                        $subdomain = 'moskva';
                }

                $city = City::whereSlug($subdomain)->firstOrFail();

                dd($city);

                echo current(explode('.',  $shortHost)); exit();
                //echo current(explode('.',  request()->getHost())); exit();

                $cities = City::where('population', '>', 0)->get();

                foreach ($cities as $city) {
                        $city->slug = str_slug($city->name, '-');
                        //$city->save();
                }
        }

        function addProductTypesSlug() {

                $productTypes = ProductType::all();

                foreach ($productTypes as $item) {
                        $item->slug = str_slug($item->name, '-');
                        //$item->save();
                }
        }

        function addFlowersSlug() {

                $flowers = Flower::all();

                foreach ($flowers as $item) {
                        $item->slug = str_slug($item->name, '-');
                        $item->save();
                }
        }
}
