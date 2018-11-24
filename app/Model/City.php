<?php

namespace App\Model;

use App\MainModel;

class City extends MainModel
{
    //
        public static $popular = [
                ['name' => 'Железнодорожный', 'slug' => 'zheleznodorozhnyy'],
                ['name' => 'Ессентуки', 'slug' => 'essentuki'],
                ['name' => 'Петропавловск-Камчатский', 'slug' => 'petropavlovsk-kamchatskiy'],
                ['name' => 'Иркутск', 'slug' => 'irkutsk'],
                ['name' => 'Волгоград', 'slug' => 'volgograd'],
                ['name' => 'Челябинск', 'slug' => 'chelyabinsk'],
                ['name' => 'Назрань', 'slug' => 'nazran'],
                ['name' => 'Красная Поляна', 'slug' => 'krasnaya-polyana'],
                ['name' => 'Южно-Сахалинск', 'slug' => 'yuzhno-sakhalinsk'],
                ['name' => 'Одинцово', 'slug' => 'odintsovo'],
                ['name' => 'Киров', 'slug' => 'kirov'],
                ['name' => 'Азов', 'slug' => 'azov'],
                ['name' => 'Зеленоград', 'slug' => 'zelenograd'],
                ['name' => 'Тверь', 'slug' => 'tver'],
                ['name' => 'Кемерово', 'slug' => 'kemerovo'],
                ['name' => 'Севастополь', 'slug' => 'sevastopol'],
                ['name' => 'Улан-Удэ', 'slug' => 'ulan-ude'],
                ['name' => 'Хабаровск', 'slug' => 'khabarovsk'],
                ['name' => 'Владикавказ', 'slug' => 'vladikavkaz'],
                ['name' => 'Курган', 'slug' => 'kurgan'],
                ['name' => 'Королев', 'slug' => 'korolev'],
                ['name' => 'Ставрополь', 'slug' => 'stavropol'],
                ['name' => 'Санкт-Петербург', 'slug' => 'sankt-peterburg'],
                ['name' => 'Мончегорск', 'slug' => 'monchegorsk'],
                ['name' => 'Екатеринбург', 'slug' => 'ekaterinburg'],
                ['name' => 'Домодедово', 'slug' => 'domodedovo'],
                ['name' => 'Химки', 'slug' => 'khimki'],
                ['name' => 'Феодосия', 'slug' => 'feodosiya'],
                ['name' => 'Армавир', 'slug' => 'armavir'],
                ['name' => 'Новороссийск', 'slug' => 'novorossiysk'],
                ['name' => 'Краснодар', 'slug' => 'krasnodar'],
                ['name' => 'Губкин', 'slug' => 'gubkin'],
                ['name' => 'Нижнекамск', 'slug' => 'nizhnekamsk'],
                ['name' => 'Новочебоксарск', 'slug' => 'novocheboksarsk'],
                ['name' => 'Нижневартовск', 'slug' => 'nizhnevartovsk'],
                ['name' => 'Крымск', 'slug' => 'krymsk'],
                ['name' => 'Смоленск', 'slug' => 'smolensk'],
                ['name' => 'Саранск', 'slug' => 'saransk'],
                ['name' => 'Московский', 'slug' => 'moskovskiy'],
                ['name' => 'Коломна', 'slug' => 'kolomna'],
                ['name' => 'Калининград', 'slug' => 'kaliningrad'],
                ['name' => 'Курск', 'slug' => 'kursk'],
                ['name' => 'Казань', 'slug' => 'kazan'],
                //['name' => 'Москва', 'slug' => 'moskva'],
                ['name' => 'Миасс', 'slug' => 'miass'],
                ['name' => 'Мытищи', 'slug' => 'mytishchi'],
                ['name' => 'Ярославль', 'slug' => 'yaroslavl'],
                ['name' => 'Балаково', 'slug' => 'balakovo'],
                ['name' => 'Электросталь', 'slug' => 'elektrostal'],
                ['name' => 'Нефтекамск', 'slug' => 'neftekamsk'],
                ['name' => 'Владимир', 'slug' => 'vladimir'],
                ['name' => 'Нижний Новгород', 'slug' => 'nizhniy-novgorod'],
                ['name' => 'Сургут', 'slug' => 'surgut'],
                ['name' => 'Владивосток', 'slug' => 'vladivostok'],
                ['name' => 'Новокузнецк', 'slug' => 'novokuznetsk'],
                ['name' => 'Красноярск', 'slug' => 'krasnoyarsk'],
                ['name' => 'Самара', 'slug' => 'samara'],
                ['name' => 'Сальск', 'slug' => 'salsk'],
                ['name' => 'Брянск', 'slug' => 'bryansk'],
                ['name' => 'Йошкар-Ола', 'slug' => 'yoshkar-ola'],
                ['name' => 'Майкоп', 'slug' => 'maykop'],
                ['name' => 'Ульяновск', 'slug' => 'ulyanovsk'],
                ['name' => 'Обнинск', 'slug' => 'obninsk'],
                ['name' => 'Темрюк', 'slug' => 'temryuk'],
                ['name' => 'Тамбов', 'slug' => 'tambov'],
                ['name' => 'Симферополь', 'slug' => 'simferopol'],
                ['name' => 'Новый Уренгой', 'slug' => 'novyy-urengoy'],
                ['name' => 'Первоуральск', 'slug' => 'pervouralsk'],
                ['name' => 'Тольятти', 'slug' => 'tolyatti'],
                ['name' => 'Тюмень', 'slug' => 'tyumen'],
                ['name' => 'Егорьевск', 'slug' => 'egorevsk'],
                ['name' => 'Черкесск', 'slug' => 'cherkessk'],
                ['name' => 'Таганрог', 'slug' => 'taganrog'],
                ['name' => 'Пермь', 'slug' => 'perm'],
                ['name' => 'Пенза', 'slug' => 'penza'],
                ['name' => 'Задонск', 'slug' => 'zadonsk'],
                ['name' => 'Краснообск', 'slug' => 'krasnoobsk'],
                ['name' => 'Орел', 'slug' => 'orel'],
                ['name' => 'Бердск', 'slug' => 'berdsk'],
                ['name' => 'Тула', 'slug' => 'tula'],
                ['name' => 'Чебоксары', 'slug' => 'cheboksary'],
                ['name' => 'Камышин', 'slug' => 'kamyshin'],
                ['name' => 'Зарайск', 'slug' => 'zaraysk'],
                ['name' => 'Пушкино', 'slug' => 'pushkino'],
                ['name' => 'Зеленогорск', 'slug' => 'zelenogorsk'],
                ['name' => 'Воркута', 'slug' => 'vorkuta'],
                ['name' => 'Воскресенск', 'slug' => 'voskresensk'],
                ['name' => 'Стерлитамак', 'slug' => 'sterlitamak'],
                ['name' => 'Пойковский', 'slug' => 'poykovskiy'],
                ['name' => 'Грозный', 'slug' => 'groznyy'],
                ['name' => 'Бобров', 'slug' => 'bobrov'],
                ['name' => 'Дзержинск', 'slug' => 'dzerzhinsk'],
                ['name' => 'Старый Оскол', 'slug' => 'staryy-oskol'],
                ['name' => 'Подольск', 'slug' => 'podolsk'],
                ['name' => 'Омск', 'slug' => 'omsk'],
                ['name' => 'Ухта', 'slug' => 'ukhta'],
                ['name' => 'Липецк', 'slug' => 'lipetsk'],
                ['name' => 'Рязань', 'slug' => 'ryazan'],
                ['name' => 'Саратов', 'slug' => 'saratov'],
                ['name' => 'Архангельск', 'slug' => 'arkhangelsk'],
                ['name' => 'Анапа', 'slug' => 'anapa'],
                ['name' => 'Ижевск', 'slug' => 'izhevsk'],
                ['name' => 'Сочи', 'slug' => 'sochi'],
                ['name' => 'Череповец', 'slug' => 'cherepovets'],
                ['name' => 'Ростов-на-Дону', 'slug' => 'rostov-na-donu'],
                ['name' => 'Бийск', 'slug' => 'biysk'],
                ['name' => 'Нижний Тагил', 'slug' => 'nizhniy-tagil'],
                ['name' => 'Псков', 'slug' => 'pskov'],
                ['name' => 'Белгород', 'slug' => 'belgorod'],
                ['name' => 'Томск', 'slug' => 'tomsk'],
                ['name' => 'Шадринск', 'slug' => 'shadrinsk'],
                ['name' => 'Новосибирск', 'slug' => 'novosibirsk'],
                ['name' => 'Уфа', 'slug' => 'ufa'],
                ['name' => 'Набережные Челны', 'slug' => 'naberezhnye-chelny'],
                ['name' => 'Люберцы', 'slug' => 'lyubertsy'],
                ['name' => 'Глазов', 'slug' => 'glazov'],
                ['name' => 'Новотроицк', 'slug' => 'novotroitsk'],
                ['name' => 'Иваново', 'slug' => 'ivanovo'],
                ['name' => 'Воронеж', 'slug' => 'voronezh'],
                ['name' => 'Озерск', 'slug' => 'ozersk'],
                ['name' => 'Оренбург', 'slug' => 'orenburg'],
                ['name' => 'Петрозаводск', 'slug' => 'petrozavodsk'],
                ['name' => 'Батайск', 'slug' => 'bataysk'],
                ['name' => 'Славянск-на-Кубани', 'slug' => 'slavyansk-na-kubani'],
                ['name' => 'Астрахань', 'slug' => 'astrakhan'],
                ['name' => 'Ангарск', 'slug' => 'angarsk'],
                ['name' => 'Александров', 'slug' => 'aleksandrov'],
                ['name' => 'Пушкин', 'slug' => 'pushkin'],
                ['name' => 'Ноябрьск', 'slug' => 'noyabrsk'],
        ];

        protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

        public function region() {
                return $this->belongsTo('App\Model\Region');
        }

        public static function popular($limit = 10, $random = true) {
                $model = self::where('popular', 1);
                if($random) {
                        $model->orderBy('population', 'DESC');
                } else {
                        //$model->inRandomOrder();
                        $model->orderBy('name', 'ASC');
                }

                if($limit) {
                        $model->take($limit);
                }

                return $model->get();
        }
}
