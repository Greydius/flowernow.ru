---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='https://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](https://floristum.ru/docs/collection.json)

<!-- END_INFO -->

#Auth


Auth actions
<!-- START_d7b7952e7fdddc07c978c9bdaf757acf -->
## Register

* 'phone' => 'required|string|max:16|min:11|unique:users',
* 'city_id' => 'required|integer',
* 'shop_name' => 'required|string|max:255',
* 'email' => 'required|string|email|max:255|unique:users',
* 'password' => 'required|string|min:6'

> Example request:

```bash
curl -X POST "https://floristum.ru/api/register" 
```

```javascript
const url = new URL("https://floristum.ru/api/register");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": false,
    "error": {
        "phone": [
            "Этот телефон уже зарегестрирован в системе"
        ],
        "city_id": [
            "Выберите город"
        ],
        "shop_name": [
            "Введите название магазина"
        ],
        "email": [
            "Введите email"
        ]
    }
}
```

### HTTP Request
`POST api/register`


<!-- END_d7b7952e7fdddc07c978c9bdaf757acf -->

<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
## Login

> Example request:

```bash
curl -X POST "https://floristum.ru/api/login" 
```

```javascript
const url = new URL("https://floristum.ru/api/login");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "token_type": "Bearer",
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjAzNGI3NDI4OTQ4OTJlOTVmMzYwNDc0ZGJkMGNjN2M3Yjg3MzJhMTM0MGQyYzU0ODJkZWE4YWYwYjU3NGE2NmIxOTViMTViYWQ5ZmFhZThmIn0.eyJhdWQiOiIxIiwianRpIjoiMDM0Yjc0Mjg5NDg5MmU5NWYzNjA0NzRkYmQwY2M3YzdiODczMmExMzQwZDJjNTQ4MmRlYThhZjBiNTc0YTY2YjE5NWIxNWJhZDlmYWFlOGYiLCJpYXQiOjE1ODE4Mzg5NTQsIm5iZiI6MTU4MTgzODk1NCwiZXhwIjoxNjEzNDYxMzU0LCJzdWIiOiI0MjciLCJzY29wZXMiOltdfQ.nVVvZR9FtEYh6sV0Bm_oU-6eR6YAZ6aUPbjBeTlyouvK7zMypAhoo0ds12uyfEbEpZ2qgy2VT4iz9JjWEGaC_HVtc4OAKNjyV-iLMPuIjBrmyvRQ20RGf22u2bYa3j9KUaWqHwhauwckZwyUzjBFPcGPXZEwlJQt1VvvKUoIYDe7kLCJ6jwgmqbXOl9KqHV-tdTYNJsvPpCn5cwxOYpzWegcTjpxlsnYrsVkR3Vjm_rw0B8zRlJYoKDVMfnMLz3QA9yBKoUnSc83XRc7nDFseT6KHuDauE-Wt_-Qt2lsgsi9xdWkR6vsubo3P2qqL0SpkBLmXoqKckbWa5QFzIeN_94o_tHRG5RoTcKq16ynSSUjpwCuZhU9FGLAQw3fo_vclUCIjpbgutoMAGOqw6rmBwPmbqE6XXLsXf8IcJOMDZ-KkX1cCNld51BItNhV2gLQqkOe5NN5pWr8xcOC5me8P_NgACbJDRhWfFfaSZkesBtAynEuzqQT8ixzKqdkMS975huJyPsAa1q-LlA3Zzw1cX7on8N9tgId6qveDYRX-Wt97nTDbjHDOT2McW3b9EZ6CY55cvEqcV9met5-aRBT_BfPZDJts9znIC0apcDRaI8ttEw0ivABxQVKSui5fw8SuJ6tDQeNgbB-7dbbgPAsNx9eluwazchreo5v8PGDaGA",
    "shop": {
        "id": 397,
        "name": "SEATTLE",
        "logo": null,
        "photo": null,
        "about": "Цветы",
        "city_id": 645450,
        "contact_phone": "+7(905)212-23-83",
        "site": null,
        "vk": null,
        "ok": null,
        "fb": null,
        "instagram": null,
        "youtube": null,
        "delivery_price": "0.00",
        "delivery_time": 0,
        "delivery_out": 1,
        "delivery_out_max": 0,
        "delivery_out_price": "0.00",
        "round_clock": 0,
        "active": 1,
        "delivery_free": 1,
        "pivot": {
            "user_id": 427,
            "shop_id": 397
        }
    },
    "expires_at": "2020-02-17 10:42:34"
}
```

### HTTP Request
`POST api/login`


<!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->

<!-- START_61739f3220a224b34228600649230ad1 -->
## Logout

> Example request:

```bash
curl -X POST "https://floristum.ru/api/logout" 
```

```javascript
const url = new URL("https://floristum.ru/api/logout");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "You are successfully logged out"
}
```

### HTTP Request
`POST api/logout`


<!-- END_61739f3220a224b34228600649230ad1 -->

#Cities


<!-- START_56d7be9447e2ce39ac69b09141bf5902 -->
## api/cities
> Example request:

```bash
curl -X GET -G "https://floristum.ru/api/cities" 
```

```javascript
const url = new URL("https://floristum.ru/api/cities");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
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
    },
    {
        "id": 654070,
        "name": "Екатеринбург",
        "region_id": 653700,
        "name_prepositional": "Екатеринбурге",
        "metro": 0,
        "population": 1500,
        "slug": "ekaterinburg",
        "popular": 1,
        "region": {
            "id": 653700,
            "name": "Свердловская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:43",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 642320,
        "name": "Омск",
        "region_id": 642020,
        "name_prepositional": "Омске",
        "metro": 0,
        "population": 1200,
        "slug": "omsk",
        "popular": 1,
        "region": {
            "id": 642020,
            "name": "Омская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:16:00",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+6:00"
        }
    },
    {
        "id": 640860,
        "name": "Нижний Новгород",
        "region_id": 640310,
        "name_prepositional": "Нижнем Новгороде",
        "metro": 0,
        "population": 1200,
        "slug": "nizhniy-novgorod",
        "popular": 1,
        "region": {
            "id": 640310,
            "name": "Нижегородская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:56",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 661420,
        "name": "Челябинск",
        "region_id": 660710,
        "name_prepositional": "Челябинске",
        "metro": 0,
        "population": 1200,
        "slug": "chelyabinsk",
        "popular": 1,
        "region": {
            "id": 660710,
            "name": "Челябинская область",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:18",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 653040,
        "name": "Самара",
        "region_id": 652560,
        "name_prepositional": "Самаре",
        "metro": 0,
        "population": 1200,
        "slug": "samara",
        "popular": 1,
        "region": {
            "id": 652560,
            "name": "Самарская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:38",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+4:00"
        }
    },
    {
        "id": 646600,
        "name": "Уфа",
        "region_id": 645790,
        "name_prepositional": "Уфе",
        "metro": 0,
        "population": 1100,
        "slug": "ufa",
        "popular": 1,
        "region": {
            "id": 645790,
            "name": "Башкортостан",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:16:28",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 652000,
        "name": "Ростов-на-Дону",
        "region_id": 651110,
        "name_prepositional": "Ростове-на-Дону",
        "metro": 0,
        "population": 1100,
        "slug": "rostov-na-donu",
        "popular": 1,
        "region": {
            "id": 651110,
            "name": "Ростовская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:36",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 644200,
        "name": "Пермь",
        "region_id": 643700,
        "name_prepositional": "Перми",
        "metro": 0,
        "population": 1000,
        "slug": "perm",
        "popular": 1,
        "region": {
            "id": 643700,
            "name": "Пермский край",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:16:22",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 625810,
        "name": "Воронеж",
        "region_id": 625670,
        "name_prepositional": "Воронеже",
        "metro": 0,
        "population": 1000,
        "slug": "voronezh",
        "popular": 1,
        "region": {
            "id": 625670,
            "name": "Воронежская область",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:03",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 650400,
        "name": "Казань",
        "region_id": 650130,
        "name_prepositional": "Казани",
        "metro": 0,
        "population": 1000,
        "slug": "kazan",
        "popular": 1,
        "region": {
            "id": 650130,
            "name": "Татарстан",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:32",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 635320,
        "name": "Красноярск",
        "region_id": 634930,
        "name_prepositional": "Красноярске",
        "metro": 0,
        "population": 1000,
        "slug": "krasnoyarsk",
        "popular": 1,
        "region": {
            "id": 634930,
            "name": "Красноярский край",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:28",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+7:00"
        }
    },
    {
        "id": 624840,
        "name": "Волгоград",
        "region_id": 624770,
        "name_prepositional": "Волгограде",
        "metro": 0,
        "population": 1000,
        "slug": "volgograd",
        "popular": 1,
        "region": {
            "id": 624770,
            "name": "Волгоградская область",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:14:59",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 653241,
        "name": "Саратов",
        "region_id": 653420,
        "name_prepositional": "Саратове",
        "metro": 0,
        "population": 840,
        "slug": "saratov",
        "popular": 1,
        "region": {
            "id": 653420,
            "name": "Саратовская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:40",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 633540,
        "name": "Краснодар",
        "region_id": 632660,
        "name_prepositional": "Краснодаре",
        "metro": 0,
        "population": 780,
        "slug": "krasnodar",
        "popular": 1,
        "region": {
            "id": 632660,
            "name": "Краснодарский край",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:27",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 653140,
        "name": "Тольятти",
        "region_id": 652560,
        "name_prepositional": "Тольятти",
        "metro": 0,
        "population": 720,
        "slug": "tolyatti",
        "popular": 0,
        "region": {
            "id": 652560,
            "name": "Самарская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:38",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+4:00"
        }
    },
    {
        "id": 621630,
        "name": "Барнаул",
        "region_id": 621590,
        "name_prepositional": "Барнауле",
        "metro": 0,
        "population": 630,
        "slug": "barnaul",
        "popular": 1,
        "region": {
            "id": 621590,
            "name": "Алтайский край",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:12:09",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+7:00"
        }
    },
    {
        "id": 659300,
        "name": "Ижевск",
        "region_id": 659200,
        "name_prepositional": "Ижевске",
        "metro": 0,
        "population": 630,
        "slug": "izhevsk",
        "popular": 1,
        "region": {
            "id": 659200,
            "name": "Удмуртия",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:13",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+4:00"
        }
    },
    {
        "id": 659020,
        "name": "Тюмень",
        "region_id": 658170,
        "name_prepositional": "Тюмени",
        "metro": 0,
        "population": 620,
        "slug": "tyumen",
        "popular": 0,
        "region": {
            "id": 658170,
            "name": "Тюменская область",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:09",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 659880,
        "name": "Ульяновск",
        "region_id": 659540,
        "name_prepositional": "Ульяновске",
        "metro": 0,
        "population": 620,
        "slug": "ulyanovsk",
        "popular": 1,
        "region": {
            "id": 659540,
            "name": "Ульяновская область",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:15",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+4:00"
        }
    },
    {
        "id": 660250,
        "name": "Хабаровск",
        "region_id": 659930,
        "name_prepositional": "Хабаровске",
        "metro": 0,
        "population": 600,
        "slug": "khabarovsk",
        "popular": 0,
        "region": {
            "id": 659930,
            "name": "Хабаровский край",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:16",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+10:00"
        }
    },
    {
        "id": 662810,
        "name": "Ярославль",
        "region_id": 662530,
        "name_prepositional": "Ярославле",
        "metro": 0,
        "population": 600,
        "slug": "yaroslavl",
        "popular": 1,
        "region": {
            "id": 662530,
            "name": "Ярославская область",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:27",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 644560,
        "name": "Владивосток",
        "region_id": 644490,
        "name_prepositional": "Владивостоке",
        "metro": 0,
        "population": 600,
        "slug": "vladivostok",
        "popular": 1,
        "region": {
            "id": 644490,
            "name": "Приморский край",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:16:24",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+10:00"
        }
    },
    {
        "id": 628970,
        "name": "Иркутск",
        "region_id": 628780,
        "name_prepositional": "Иркутске",
        "metro": 0,
        "population": 600,
        "slug": "irkutsk",
        "popular": 0,
        "region": {
            "id": 628780,
            "name": "Иркутская область",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:10",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+8:00"
        }
    },
    {
        "id": 647420,
        "name": "Махачкала",
        "region_id": 646710,
        "name_prepositional": "Махачкале",
        "metro": 0,
        "population": 592,
        "slug": "makhachkala",
        "popular": 0,
        "region": {
            "id": 646710,
            "name": "Дагестан",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:16:30",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 642790,
        "name": "Оренбург",
        "region_id": 642480,
        "name_prepositional": "Оренбурге",
        "metro": 0,
        "population": 560,
        "slug": "orenburg",
        "popular": 0,
        "region": {
            "id": 642480,
            "name": "Оренбургская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:16:18",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 631430,
        "name": "Новокузнецк",
        "region_id": 631080,
        "name_prepositional": "Новокузнецке",
        "metro": 0,
        "population": 550,
        "slug": "novokuznetsk",
        "popular": 0,
        "region": {
            "id": 631080,
            "name": "Кемеровская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:22",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+7:00"
        }
    },
    {
        "id": 657600,
        "name": "Томск",
        "region_id": 657310,
        "name_prepositional": "Томске",
        "metro": 0,
        "population": 550,
        "slug": "tomsk",
        "popular": 0,
        "region": {
            "id": 657310,
            "name": "Томская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:18:04",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+6:00"
        }
    },
    {
        "id": 631270,
        "name": "Кемерово",
        "region_id": 631080,
        "name_prepositional": "Кемерово",
        "metro": 0,
        "population": 540,
        "slug": "kemerovo",
        "popular": 0,
        "region": {
            "id": 631080,
            "name": "Кемеровская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:22",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+7:00"
        }
    },
    {
        "id": 652430,
        "name": "Рязань",
        "region_id": 652220,
        "name_prepositional": "Рязани",
        "metro": 0,
        "population": 530,
        "slug": "ryazan",
        "popular": 0,
        "region": {
            "id": 652220,
            "name": "Рязанская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:37",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 650510,
        "name": "Набережные Челны",
        "region_id": 650130,
        "name_prepositional": "Набережных Челнах",
        "metro": 0,
        "population": 520,
        "slug": "naberezhnye-chelny",
        "popular": 0,
        "region": {
            "id": 650130,
            "name": "Татарстан",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:32",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 623130,
        "name": "Астрахань",
        "region_id": 623110,
        "name_prepositional": "Астрахани",
        "metro": 0,
        "population": 520,
        "slug": "astrakhan",
        "popular": 0,
        "region": {
            "id": 623110,
            "name": "Астраханская область",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:13:35",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+4:00"
        }
    },
    {
        "id": 643560,
        "name": "Пенза",
        "region_id": 643250,
        "name_prepositional": "Пензе",
        "metro": 0,
        "population": 520,
        "slug": "penza",
        "popular": 0,
        "region": {
            "id": 643250,
            "name": "Пензенская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:16:21",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 637440,
        "name": "Липецк",
        "region_id": 637260,
        "name_prepositional": "Липецке",
        "metro": 0,
        "population": 510,
        "slug": "lipetsk",
        "popular": 0,
        "region": {
            "id": 637260,
            "name": "Липецкая область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:48",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 658080,
        "name": "Тула",
        "region_id": 657610,
        "name_prepositional": "Туле",
        "metro": 0,
        "population": 500,
        "slug": "tula",
        "popular": 0,
        "region": {
            "id": 657610,
            "name": "Тульская область",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:07",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 631870,
        "name": "Киров",
        "region_id": 631730,
        "name_prepositional": "Кирове",
        "metro": 0,
        "population": 480,
        "slug": "kirov",
        "popular": 0,
        "region": {
            "id": 631730,
            "name": "Кировская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:24",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 637770,
        "name": "Балашиха",
        "region_id": 637680,
        "name_prepositional": "Балашихе",
        "metro": 0,
        "population": 470,
        "slug": "balashikha",
        "popular": 0,
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
        "id": 662210,
        "name": "Чебоксары",
        "region_id": 662000,
        "name_prepositional": "Чебоксарах",
        "metro": 0,
        "population": 470,
        "slug": "cheboksary",
        "popular": 0,
        "region": {
            "id": 662000,
            "name": "Чувашия",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:23",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 630090,
        "name": "Калининград",
        "region_id": 629990,
        "name_prepositional": "Калининграде",
        "metro": 0,
        "population": 440,
        "slug": "kaliningrad",
        "popular": 0,
        "region": {
            "id": 629990,
            "name": "Калининградская область",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:13",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+2:00"
        }
    },
    {
        "id": 636160,
        "name": "Курск",
        "region_id": 636030,
        "name_prepositional": "Курске",
        "metro": 0,
        "population": 430,
        "slug": "kursk",
        "popular": 0,
        "region": {
            "id": 636030,
            "name": "Курская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:31",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 661100,
        "name": "Магнитогорск",
        "region_id": 660710,
        "name_prepositional": "Магнитогорске",
        "metro": 0,
        "population": 420,
        "slug": "magnitogorsk",
        "popular": 0,
        "region": {
            "id": 660710,
            "name": "Челябинская область",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:18",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 653271,
        "name": "Улан-Удэ",
        "region_id": 623845,
        "name_prepositional": "Улан-Удэ",
        "metro": 0,
        "population": 420,
        "slug": "ulan-ude",
        "popular": 0,
        "region": {
            "id": 623845,
            "name": "Бурятия",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:14:52",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+8:00"
        }
    },
    {
        "id": 656901,
        "name": "Тверь",
        "region_id": 656890,
        "name_prepositional": "Твери",
        "metro": 0,
        "population": 410,
        "slug": "tver",
        "popular": 0,
        "region": {
            "id": 656890,
            "name": "Тверская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:18:03",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 623880,
        "name": "Брянск",
        "region_id": 623840,
        "name_prepositional": "Брянске",
        "metro": 0,
        "population": 410,
        "slug": "bryansk",
        "popular": 0,
        "region": {
            "id": 623840,
            "name": "Брянская область",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:14:40",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 628500,
        "name": "Иваново",
        "region_id": 628450,
        "name_prepositional": "Иваново",
        "metro": 0,
        "population": 410,
        "slug": "ivanovo",
        "popular": 0,
        "region": {
            "id": 628450,
            "name": "Ивановская область",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:07",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 656350,
        "name": "Ставрополь",
        "region_id": 655190,
        "name_prepositional": "Ставрополе",
        "metro": 0,
        "population": 410,
        "slug": "stavropol",
        "popular": 0,
        "region": {
            "id": 655190,
            "name": "Ставропольский край",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:18:00",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 623430,
        "name": "Белгород",
        "region_id": 623410,
        "name_prepositional": "Белгороде",
        "metro": 0,
        "population": 370,
        "slug": "belgorod",
        "popular": 0,
        "region": {
            "id": 623410,
            "name": "Белгородская область",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:13:47",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 634450,
        "name": "Сочи",
        "region_id": 632660,
        "name_prepositional": "Сочи",
        "metro": 0,
        "population": 370,
        "slug": "sochi",
        "popular": 0,
        "region": {
            "id": 632660,
            "name": "Краснодарский край",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:27",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 654410,
        "name": "Нижний Тагил",
        "region_id": 653700,
        "name_prepositional": "Нижнем Тагиле",
        "metro": 0,
        "population": 360,
        "slug": "nizhniy-tagil",
        "popular": 0,
        "region": {
            "id": 653700,
            "name": "Свердловская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:43",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 622660,
        "name": "Архангельск",
        "region_id": 622650,
        "name_prepositional": "Архангельске",
        "metro": 0,
        "population": 350,
        "slug": "arkhangelsk",
        "popular": 0,
        "region": {
            "id": 622650,
            "name": "Архангельская область",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:13:27",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 661950,
        "name": "Чита",
        "region_id": 661460,
        "name_prepositional": "Чите",
        "metro": 0,
        "population": 350,
        "slug": "chita",
        "popular": 0,
        "region": {
            "id": 661460,
            "name": "Забайкальский край",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:18:21",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+9:00"
        }
    },
    {
        "id": 624360,
        "name": "Владимир",
        "region_id": 624300,
        "name_prepositional": "Владимире",
        "metro": 0,
        "population": 350,
        "slug": "vladimir",
        "popular": 0,
        "region": {
            "id": 624300,
            "name": "Владимирская область",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:14:55",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 630410,
        "name": "Калуга",
        "region_id": 630270,
        "name_prepositional": "Калуге",
        "metro": 0,
        "population": 341,
        "slug": "kaluga",
        "popular": 0,
        "region": {
            "id": 630270,
            "name": "Калужская область",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:17",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 621585,
        "name": "Севастополь",
        "region_id": 621550,
        "name_prepositional": "Севастополе",
        "metro": 0,
        "population": 340,
        "slug": "sevastopol",
        "popular": 0,
        "region": {
            "id": 621550,
            "name": "Крым",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 15:58:03",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 635860,
        "name": "Курган",
        "region_id": 635730,
        "name_prepositional": "Кургане",
        "metro": 0,
        "population": 330,
        "slug": "kurgan",
        "popular": 0,
        "region": {
            "id": 635730,
            "name": "Курганская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:29",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 655100,
        "name": "Смоленск",
        "region_id": 654860,
        "name_prepositional": "Смоленске",
        "metro": 0,
        "population": 330,
        "slug": "smolensk",
        "popular": 0,
        "region": {
            "id": 654860,
            "name": "Смоленская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:59",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 621565,
        "name": "Симферополь",
        "region_id": 621550,
        "name_prepositional": "Симферополе",
        "metro": 0,
        "population": 330,
        "slug": "simferopol",
        "popular": 0,
        "region": {
            "id": 621550,
            "name": "Крым",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 15:58:03",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 624850,
        "name": "Волжский",
        "region_id": 624770,
        "name_prepositional": "Волжском",
        "metro": 0,
        "population": 326,
        "slug": "volzhskiy",
        "popular": 0,
        "region": {
            "id": 624770,
            "name": "Волгоградская область",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:14:59",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 643190,
        "name": "Орел",
        "region_id": 643030,
        "name_prepositional": "Орле",
        "metro": 0,
        "population": 320,
        "slug": "orel",
        "popular": 0,
        "region": {
            "id": 643030,
            "name": "Орловская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:16:20",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 660630,
        "name": "Сургут",
        "region_id": 660300,
        "name_prepositional": "Сургуте",
        "metro": 0,
        "population": 320,
        "slug": "surgut",
        "popular": 0,
        "region": {
            "id": 660300,
            "name": "Ханты-Мансийский АО",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:17",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 625650,
        "name": "Череповец",
        "region_id": 625330,
        "name_prepositional": "Череповце",
        "metro": 0,
        "population": 320,
        "slug": "cherepovets",
        "popular": 0,
        "region": {
            "id": 625330,
            "name": "Вологодская область",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:02",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 625390,
        "name": "Вологда",
        "region_id": 625330,
        "name_prepositional": "Вологде",
        "metro": 0,
        "population": 312,
        "slug": "vologda",
        "popular": 0,
        "region": {
            "id": 625330,
            "name": "Вологодская область",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:02",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 649810,
        "name": "Якутск",
        "region_id": 649330,
        "name_prepositional": "Якутске",
        "metro": 0,
        "population": 311,
        "slug": "yakutsk",
        "popular": 0,
        "region": {
            "id": 649330,
            "name": "Саха (Якутия)",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:23",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+9:00"
        }
    },
    {
        "id": 649870,
        "name": "Владикавказ",
        "region_id": 649820,
        "name_prepositional": "Владикавказе",
        "metro": 0,
        "population": 309,
        "slug": "vladikavkaz",
        "popular": 0,
        "region": {
            "id": 649820,
            "name": "Северная Осетия",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:24",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 649210,
        "name": "Саранск",
        "region_id": 648960,
        "name_prepositional": "Саранске",
        "metro": 0,
        "population": 300,
        "slug": "saransk",
        "popular": 0,
        "region": {
            "id": 648960,
            "name": "Мордовия",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:17:20",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 640160,
        "name": "Мурманск",
        "region_id": 640000,
        "name_prepositional": "Мурманске",
        "metro": 0,
        "population": 295,
        "slug": "murmansk",
        "popular": 0,
        "region": {
            "id": 640000,
            "name": "Мурманская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:53",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 653391,
        "name": "Грозный",
        "region_id": 660711,
        "name_prepositional": "Грозном",
        "metro": 0,
        "population": 280,
        "slug": "groznyy",
        "popular": 0,
        "region": {
            "id": 660711,
            "name": "Чеченская Республика",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:20",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 646520,
        "name": "Стерлитамак",
        "region_id": 645790,
        "name_prepositional": "Стерлитамаке",
        "metro": 0,
        "population": 280,
        "slug": "sterlitamak",
        "popular": 0,
        "region": {
            "id": 645790,
            "name": "Башкортостан",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:16:28",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 656830,
        "name": "Тамбов",
        "region_id": 656520,
        "name_prepositional": "Тамбове",
        "metro": 0,
        "population": 280,
        "slug": "tambov",
        "popular": 0,
        "region": {
            "id": 656520,
            "name": "Тамбовская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:18:01",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 632490,
        "name": "Кострома",
        "region_id": 632390,
        "name_prepositional": "Костроме",
        "metro": 0,
        "population": 277,
        "slug": "kostroma",
        "popular": 0,
        "region": {
            "id": 632390,
            "name": "Костромская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:25",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 648220,
        "name": "Петрозаводск",
        "region_id": 648070,
        "name_prepositional": "Петрозаводске",
        "metro": 0,
        "population": 270,
        "slug": "petrozavodsk",
        "popular": 0,
        "region": {
            "id": 648070,
            "name": "Карелия",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:16:31",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 660480,
        "name": "Нижневартовск",
        "region_id": 660300,
        "name_prepositional": "Нижневартовске",
        "metro": 0,
        "population": 260,
        "slug": "nizhnevartovsk",
        "popular": 0,
        "region": {
            "id": 660300,
            "name": "Ханты-Мансийский АО",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:17",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 648760,
        "name": "Йошкар-Ола",
        "region_id": 648730,
        "name_prepositional": "Йошкар-Оле",
        "metro": 0,
        "population": 260,
        "slug": "yoshkar-ola",
        "popular": 0,
        "region": {
            "id": 648730,
            "name": "Марий Эл",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:17:19",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 652100,
        "name": "Таганрог",
        "region_id": 651110,
        "name_prepositional": "Таганроге",
        "metro": 0,
        "population": 260,
        "slug": "taganrog",
        "popular": 0,
        "region": {
            "id": 651110,
            "name": "Ростовская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:36",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 634030,
        "name": "Новороссийск",
        "region_id": 632660,
        "name_prepositional": "Новороссийске",
        "metro": 0,
        "population": 250,
        "slug": "novorossiysk",
        "popular": 0,
        "region": {
            "id": 632660,
            "name": "Краснодарский край",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:27",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 660060,
        "name": "Комсомольск-на-Амуре",
        "region_id": 659930,
        "name_prepositional": "Комсомольске-на-Амуре",
        "metro": 0,
        "population": 248,
        "slug": "komsomolsk-na-amure",
        "popular": 0,
        "region": {
            "id": 659930,
            "name": "Хабаровский край",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:16",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+10:00"
        }
    },
    {
        "id": 648630,
        "name": "Сыктывкар",
        "region_id": 648340,
        "name_prepositional": "Сыктывкаре",
        "metro": 0,
        "population": 245,
        "slug": "siktyvkar",
        "popular": 0,
        "region": {
            "id": 648340,
            "name": "Коми",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:17:16",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 650520,
        "name": "Нижнекамск",
        "region_id": 650130,
        "name_prepositional": "Нижнекамске",
        "metro": 0,
        "population": 240,
        "slug": "nizhnekamsk",
        "popular": 0,
        "region": {
            "id": 650130,
            "name": "Татарстан",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:32",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 640650,
        "name": "Дзержинск",
        "region_id": 640310,
        "name_prepositional": "Дзержинске",
        "metro": 0,
        "population": 240,
        "slug": "dzerzhinsk",
        "popular": 0,
        "region": {
            "id": 640310,
            "name": "Нижегородская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:56",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 637641,
        "name": "Зеленоград",
        "region_id": 637640,
        "name_prepositional": "Зеленограде",
        "metro": 0,
        "population": 240,
        "slug": "zelenograd",
        "popular": 0,
        "region": {
            "id": 637640,
            "name": "Москва",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:15:50",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 629770,
        "name": "Нальчик",
        "region_id": 629430,
        "name_prepositional": "Нальчике",
        "metro": 0,
        "population": 239,
        "slug": "nalchik",
        "popular": 0,
        "region": {
            "id": 629430,
            "name": "Кабардино-Балкария",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:12",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 652200,
        "name": "Шахты",
        "region_id": 651110,
        "name_prepositional": "Шахтах",
        "metro": 0,
        "population": 235,
        "slug": "shakhty",
        "popular": 0,
        "region": {
            "id": 651110,
            "name": "Ростовская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:36",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 628890,
        "name": "Братск",
        "region_id": 628780,
        "name_prepositional": "Братске",
        "metro": 0,
        "population": 231,
        "slug": "bratsk",
        "popular": 0,
        "region": {
            "id": 628780,
            "name": "Иркутская область",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:10",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+8:00"
        }
    },
    {
        "id": 628810,
        "name": "Ангарск",
        "region_id": 628780,
        "name_prepositional": "Ангарске",
        "metro": 0,
        "population": 230,
        "slug": "angarsk",
        "popular": 0,
        "region": {
            "id": 628780,
            "name": "Иркутская область",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:10",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+8:00"
        }
    },
    {
        "id": 642800,
        "name": "Орск",
        "region_id": 642480,
        "name_prepositional": "Орске",
        "metro": 0,
        "population": 230,
        "slug": "orsk",
        "popular": 0,
        "region": {
            "id": 642480,
            "name": "Оренбургская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:16:18",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 622500,
        "name": "Благовещенск",
        "region_id": 622470,
        "name_prepositional": "Благовещенске",
        "metro": 0,
        "population": 225,
        "slug": "blagoveshchensk",
        "popular": 0,
        "region": {
            "id": 622470,
            "name": "Амурская область",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:13:06",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+9:00"
        }
    },
    {
        "id": 653265,
        "name": "Энгельс",
        "region_id": 653420,
        "name_prepositional": "Энгельсе",
        "metro": 0,
        "population": 225,
        "slug": "engels",
        "popular": 0,
        "region": {
            "id": 653420,
            "name": "Саратовская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:40",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 641270,
        "name": "Великий Новгород",
        "region_id": 641240,
        "name_prepositional": "Великом Новгороде",
        "metro": 0,
        "population": 222,
        "slug": "velikiy-novgorod",
        "popular": 0,
        "region": {
            "id": 641240,
            "name": "Новгородская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:57",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 623760,
        "name": "Старый Оскол",
        "region_id": 623410,
        "name_prepositional": "Старом Осколе",
        "metro": 0,
        "population": 220,
        "slug": "staryy-oskol",
        "popular": 0,
        "region": {
            "id": 623410,
            "name": "Белгородская область",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:13:47",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 639740,
        "name": "Химки",
        "region_id": 637680,
        "name_prepositional": "Химках",
        "metro": 0,
        "population": 220,
        "slug": "khimki",
        "popular": 0,
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
        "id": 645450,
        "name": "Псков",
        "region_id": 645260,
        "name_prepositional": "Пскове",
        "metro": 0,
        "population": 210,
        "slug": "pskov",
        "popular": 0,
        "region": {
            "id": 645260,
            "name": "Псковская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:16:25",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 621670,
        "name": "Бийск",
        "region_id": 621590,
        "name_prepositional": "Бийске",
        "metro": 0,
        "population": 210,
        "slug": "biysk",
        "popular": 0,
        "region": {
            "id": 621590,
            "name": "Алтайский край",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:12:09",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+7:00"
        }
    },
    {
        "id": 632720,
        "name": "Анапа",
        "region_id": 632660,
        "name_prepositional": "Анапе",
        "metro": 0,
        "population": 200,
        "slug": "anapa",
        "popular": 0,
        "region": {
            "id": 632660,
            "name": "Краснодарский край",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:27",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 653245,
        "name": "Балаково",
        "region_id": 653420,
        "name_prepositional": "Балаково",
        "metro": 0,
        "population": 200,
        "slug": "balakovo",
        "popular": 0,
        "region": {
            "id": 653420,
            "name": "Саратовская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:40",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 631500,
        "name": "Прокопьевск",
        "region_id": 631080,
        "name_prepositional": "Прокопьевске",
        "metro": 0,
        "population": 200,
        "slug": "prokopyevsk",
        "popular": 0,
        "region": {
            "id": 631080,
            "name": "Кемеровская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:22",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+7:00"
        }
    },
    {
        "id": 639180,
        "name": "Подольск",
        "region_id": 637680,
        "name_prepositional": "Подольске",
        "metro": 0,
        "population": 200,
        "slug": "podolsk",
        "popular": 0,
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
        "id": 638520,
        "name": "Королев",
        "region_id": 637680,
        "name_prepositional": "Королеве",
        "metro": 0,
        "population": 190,
        "slug": "korolev",
        "popular": 0,
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
        "id": 653690,
        "name": "Южно-Сахалинск",
        "region_id": 653430,
        "name_prepositional": "Южно-Сахалинске",
        "metro": 0,
        "population": 190,
        "slug": "yuzhno-sakhalinsk",
        "popular": 0,
        "region": {
            "id": 653430,
            "name": "Сахалинская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:42",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+11:00"
        }
    },
    {
        "id": 632760,
        "name": "Армавир",
        "region_id": 632660,
        "name_prepositional": "Армавире",
        "metro": 0,
        "population": 190,
        "slug": "armavir",
        "popular": 0,
        "region": {
            "id": 632660,
            "name": "Краснодарский край",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:27",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 662760,
        "name": "Рыбинск",
        "region_id": 662530,
        "name_prepositional": "Рыбинске",
        "metro": 0,
        "population": 190,
        "slug": "rybinsk",
        "popular": 0,
        "region": {
            "id": 662530,
            "name": "Ярославская область",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:27",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 623010,
        "name": "Северодвинск",
        "region_id": 622650,
        "name_prepositional": "Северодвинске",
        "metro": 0,
        "population": 183,
        "slug": "severodvinsk",
        "popular": 0,
        "region": {
            "id": 622650,
            "name": "Архангельская область",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:13:27",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 650910,
        "name": "Абакан",
        "region_id": 650890,
        "name_prepositional": "Абакане",
        "metro": 0,
        "population": 181,
        "slug": "abakan",
        "popular": 0,
        "region": {
            "id": 650890,
            "name": "Хакасия",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:17:35",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+7:00"
        }
    },
    {
        "id": 638790,
        "name": "Люберцы",
        "region_id": 637680,
        "name_prepositional": "Люберцах",
        "metro": 0,
        "population": 180,
        "slug": "lyubertsy",
        "popular": 0,
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
        "id": 638920,
        "name": "Мытищи",
        "region_id": 637680,
        "name_prepositional": "Мытищах",
        "metro": 0,
        "population": 180,
        "slug": "mytishchi",
        "popular": 0,
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
        "id": 630730,
        "name": "Петропавловск-Камчатский",
        "region_id": 630660,
        "name_prepositional": "Петропавловске-Камчатском",
        "metro": 0,
        "population": 180,
        "slug": "petropavlovsk-kamchatskiy",
        "popular": 0,
        "region": {
            "id": 630660,
            "name": "Камчатский край",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:19",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+12:00"
        }
    },
    {
        "id": 635430,
        "name": "Норильск",
        "region_id": 634930,
        "name_prepositional": "Норильске",
        "metro": 0,
        "population": 178,
        "slug": "norilsk",
        "popular": 0,
        "region": {
            "id": 634930,
            "name": "Красноярский край",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:28",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+7:00"
        }
    },
    {
        "id": 653120,
        "name": "Сызрань",
        "region_id": 652560,
        "name_prepositional": "Сызрани",
        "metro": 0,
        "population": 173,
        "slug": "syzran",
        "popular": 0,
        "region": {
            "id": 652560,
            "name": "Самарская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:38",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+4:00"
        }
    },
    {
        "id": 645160,
        "name": "Уссурийск",
        "region_id": 644490,
        "name_prepositional": "Уссурийске",
        "metro": 0,
        "population": 172,
        "slug": "ussuriysk",
        "popular": 0,
        "region": {
            "id": 644490,
            "name": "Приморский край",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:16:24",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+10:00"
        }
    },
    {
        "id": 654170,
        "name": "Каменск-Уральский",
        "region_id": 653700,
        "name_prepositional": "Каменске-Уральском",
        "metro": 0,
        "population": 169,
        "slug": "kamensk-uralskiy",
        "popular": 0,
        "region": {
            "id": 653700,
            "name": "Свердловская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:43",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 651830,
        "name": "Новочеркасск",
        "region_id": 651110,
        "name_prepositional": "Новочеркасске",
        "metro": 0,
        "population": 168,
        "slug": "novocherkassk",
        "popular": 0,
        "region": {
            "id": 651110,
            "name": "Ростовская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:36",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 660930,
        "name": "Златоуст",
        "region_id": 660710,
        "name_prepositional": "Златоусте",
        "metro": 0,
        "population": 167,
        "slug": "zlatoust",
        "popular": 0,
        "region": {
            "id": 660710,
            "name": "Челябинская область",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:18",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 638570,
        "name": "Красногорск",
        "region_id": 637680,
        "name_prepositional": "Красногорске",
        "metro": 0,
        "population": 161,
        "slug": "krasnogorsk",
        "popular": 0,
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
        "id": 639940,
        "name": "Электросталь",
        "region_id": 637680,
        "name_prepositional": "Электростали",
        "metro": 0,
        "population": 160,
        "slug": "elektrostal",
        "popular": 0,
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
        "id": 638480,
        "name": "Коломна",
        "region_id": 637680,
        "name_prepositional": "Коломне",
        "metro": 0,
        "population": 150,
        "slug": "kolomna",
        "popular": 0,
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
        "id": 645660,
        "name": "Майкоп",
        "region_id": 645530,
        "name_prepositional": "Майкопе",
        "metro": 0,
        "population": 150,
        "slug": "maykop",
        "popular": 0,
        "region": {
            "id": 645530,
            "name": "Адыгея",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:16:27",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 656200,
        "name": "Пятигорск",
        "region_id": 655190,
        "name_prepositional": "Пятигорске",
        "metro": 0,
        "population": 150,
        "slug": "pyatigorsk",
        "popular": 0,
        "region": {
            "id": 655190,
            "name": "Ставропольский край",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:18:00",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 661130,
        "name": "Миасс",
        "region_id": 660710,
        "name_prepositional": "Миассе",
        "metro": 0,
        "population": 150,
        "slug": "miass",
        "popular": 0,
        "region": {
            "id": 660710,
            "name": "Челябинская область",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:18",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 621560,
        "name": "Керчь",
        "region_id": 621550,
        "name_prepositional": "Керчи",
        "metro": 0,
        "population": 150,
        "slug": "kerch",
        "popular": 0,
        "region": {
            "id": 621550,
            "name": "Крым",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 15:58:03",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 806520,
        "name": "Колпино",
        "region_id": 653240,
        "name_prepositional": "Колпино",
        "metro": 0,
        "population": 145,
        "slug": "kolpino",
        "popular": 0,
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
        "id": 643730,
        "name": "Березники",
        "region_id": 643700,
        "name_prepositional": "Березниках",
        "metro": 0,
        "population": 145,
        "slug": "berezniki",
        "popular": 0,
        "region": {
            "id": 643700,
            "name": "Пермский край",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:16:22",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 647940,
        "name": "Хасавюрт",
        "region_id": 646710,
        "name_prepositional": "Хасавюрте",
        "metro": 0,
        "population": 141,
        "slug": "khasavyurt",
        "popular": 0,
        "region": {
            "id": 646710,
            "name": "Дагестан",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:16:30",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 638220,
        "name": "Железнодорожный",
        "region_id": 637680,
        "name_prepositional": "Железнодорожном",
        "metro": 0,
        "population": 140,
        "slug": "zheleznodorozhnyy",
        "popular": 0,
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
        "id": 639040,
        "name": "Одинцово",
        "region_id": 637680,
        "name_prepositional": "Одинцово",
        "metro": 0,
        "population": 140,
        "slug": "odintsovo",
        "popular": 0,
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
        "id": 624480,
        "name": "Ковров",
        "region_id": 624300,
        "name_prepositional": "Коврове",
        "metro": 0,
        "population": 138,
        "slug": "kovrov",
        "popular": 0,
        "region": {
            "id": 624300,
            "name": "Владимирская область",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:14:55",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 806660,
        "name": "Пушкин",
        "region_id": 653240,
        "name_prepositional": "Пушкине",
        "metro": 0,
        "population": 130,
        "slug": "pushkin",
        "popular": 0,
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
        "id": 631060,
        "name": "Черкесск",
        "region_id": 630750,
        "name_prepositional": "Черкесске",
        "metro": 0,
        "population": 130,
        "slug": "cherkessk",
        "popular": 0,
        "region": {
            "id": 630750,
            "name": "Карачаево-Черкесия",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:20",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 655720,
        "name": "Кисловодск",
        "region_id": 655190,
        "name_prepositional": "Кисловодске",
        "metro": 0,
        "population": 130,
        "slug": "kislovodsk",
        "popular": 0,
        "region": {
            "id": 655190,
            "name": "Ставропольский край",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:18:00",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 662150,
        "name": "Новочебоксарск",
        "region_id": 662000,
        "name_prepositional": "Новочебоксарске",
        "metro": 0,
        "population": 130,
        "slug": "novocheboksarsk",
        "popular": 0,
        "region": {
            "id": 662000,
            "name": "Чувашия",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:23",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 654490,
        "name": "Первоуральск",
        "region_id": 653700,
        "name_prepositional": "Первоуральске",
        "metro": 0,
        "population": 130,
        "slug": "pervouralsk",
        "popular": 0,
        "region": {
            "id": 653700,
            "name": "Свердловская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:43",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 638150,
        "name": "Домодедово",
        "region_id": 637680,
        "name_prepositional": "Домодедово",
        "metro": 0,
        "population": 130,
        "slug": "domodedovo",
        "popular": 0,
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
        "id": 646360,
        "name": "Нефтекамск",
        "region_id": 645790,
        "name_prepositional": "Нефтекамске",
        "metro": 0,
        "population": 130,
        "slug": "neftekamsk",
        "popular": 0,
        "region": {
            "id": 645790,
            "name": "Башкортостан",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:16:28",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 639470,
        "name": "Серпухов",
        "region_id": 637680,
        "name_prepositional": "Серпухове",
        "metro": 0,
        "population": 126,
        "slug": "serpukhov",
        "popular": 0,
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
        "id": 660470,
        "name": "Нефтеюганск",
        "region_id": 660300,
        "name_prepositional": "Нефтеюганске",
        "metro": 0,
        "population": 126,
        "slug": "nefteyugansk",
        "popular": 0,
        "region": {
            "id": 660300,
            "name": "Ханты-Мансийский АО",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:17",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 657900,
        "name": "Новомосковск",
        "region_id": 657610,
        "name_prepositional": "Новомосковске",
        "metro": 0,
        "population": 125,
        "slug": "novomoskovsk",
        "popular": 0,
        "region": {
            "id": 657610,
            "name": "Тульская область",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:07",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 624970,
        "name": "Камышин",
        "region_id": 624770,
        "name_prepositional": "Камышине",
        "metro": 0,
        "population": 120,
        "slug": "kamyshin",
        "popular": 0,
        "region": {
            "id": 624770,
            "name": "Волгоградская область",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:14:59",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 662420,
        "name": "Новый Уренгой",
        "region_id": 662330,
        "name_prepositional": "Новом Уренгое",
        "metro": 0,
        "population": 120,
        "slug": "noviy-urengoy",
        "popular": 0,
        "region": {
            "id": 662330,
            "name": "Ямало-Ненецкий АО",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:26",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 659610,
        "name": "Димитровград",
        "region_id": 659540,
        "name_prepositional": "Димитровграде",
        "metro": 0,
        "population": 120,
        "slug": "dimitrovgrad",
        "popular": 0,
        "region": {
            "id": 659540,
            "name": "Ульяновская область",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:15",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+4:00"
        }
    },
    {
        "id": 655950,
        "name": "Невинномысск",
        "region_id": 655190,
        "name_prepositional": "Невинномысске",
        "metro": 0,
        "population": 117,
        "slug": "nevinnomyssk",
        "popular": 0,
        "region": {
            "id": 655190,
            "name": "Ставропольский край",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:18:00",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 650740,
        "name": "Кызыл",
        "region_id": 650690,
        "name_prepositional": "Кызыле",
        "metro": 0,
        "population": 116,
        "slug": "kyzyl",
        "popular": 0,
        "region": {
            "id": 650690,
            "name": "Тыва",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:17:33",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+7:00"
        }
    },
    {
        "id": 651180,
        "name": "Батайск",
        "region_id": 651110,
        "name_prepositional": "Батайске",
        "metro": 0,
        "population": 115,
        "slug": "bataysk",
        "popular": 0,
        "region": {
            "id": 651110,
            "name": "Ростовская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:36",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 630530,
        "name": "Обнинск",
        "region_id": 630270,
        "name_prepositional": "Обнинске",
        "metro": 0,
        "population": 110,
        "slug": "obninsk",
        "popular": 0,
        "region": {
            "id": 630270,
            "name": "Калужская область",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:17",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 639250,
        "name": "Пушкино",
        "region_id": 637680,
        "name_prepositional": "Пушкино",
        "metro": 0,
        "population": 110,
        "slug": "pushkino",
        "popular": 0,
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
        "id": 662430,
        "name": "Ноябрьск",
        "region_id": 662330,
        "name_prepositional": "Ноябрьске",
        "metro": 0,
        "population": 110,
        "slug": "noyabrsk",
        "popular": 0,
        "region": {
            "id": 662330,
            "name": "Ямало-Ненецкий АО",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:26",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 638130,
        "name": "Долгопрудный",
        "region_id": 637680,
        "name_prepositional": "Долгопрудном",
        "metro": 0,
        "population": 110,
        "slug": "dolgoprudnyi",
        "popular": 0,
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
        "id": 639300,
        "name": "Реутов",
        "region_id": 637680,
        "name_prepositional": "Реутове",
        "metro": 0,
        "population": 107,
        "slug": "Reutov",
        "popular": 0,
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
        "id": 657550,
        "name": "Северск",
        "region_id": 657310,
        "name_prepositional": "Северске",
        "metro": 0,
        "population": 107,
        "slug": "seversk",
        "popular": 0,
        "region": {
            "id": 657310,
            "name": "Томская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:18:04",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+6:00"
        }
    },
    {
        "id": 644520,
        "name": "Артем",
        "region_id": 644490,
        "name_prepositional": "Артеме",
        "metro": 0,
        "population": 106,
        "slug": "artem",
        "popular": 0,
        "region": {
            "id": 644490,
            "name": "Приморский край",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:16:24",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+10:00"
        }
    },
    {
        "id": 637350,
        "name": "Елец",
        "region_id": 637260,
        "name_prepositional": "Ельце",
        "metro": 0,
        "population": 105,
        "slug": "elets",
        "popular": 0,
        "region": {
            "id": 637260,
            "name": "Липецкая область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:48",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 653341,
        "name": "Элиста",
        "region_id": 629995,
        "name_prepositional": "Элисте",
        "metro": 0,
        "population": 103,
        "slug": "elista",
        "popular": 0,
        "region": {
            "id": 629995,
            "name": "Калмыкия",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:15",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 639440,
        "name": "Сергиев Посад",
        "region_id": 637680,
        "name_prepositional": "Сергиевом Посаде",
        "metro": 0,
        "population": 103,
        "slug": "sergiev-posad",
        "popular": 0,
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
        "id": 637990,
        "name": "Воскресенск",
        "region_id": 637680,
        "name_prepositional": "Воскресенске",
        "metro": 0,
        "population": 100,
        "slug": "voskresensk",
        "popular": 0,
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
        "id": 659250,
        "name": "Глазов",
        "region_id": 659200,
        "name_prepositional": "Глазове",
        "metro": 0,
        "population": 100,
        "slug": "glazov",
        "popular": 0,
        "region": {
            "id": 659200,
            "name": "Удмуртия",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:13",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+4:00"
        }
    },
    {
        "id": 636090,
        "name": "Железногорск",
        "region_id": 636030,
        "name_prepositional": "Железногорске",
        "metro": 0,
        "population": 100,
        "slug": "zheleznogorsk",
        "popular": 0,
        "region": {
            "id": 636030,
            "name": "Курская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:31",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 655550,
        "name": "Ессентуки",
        "region_id": 655190,
        "name_prepositional": "Ессентуках",
        "metro": 0,
        "population": 100,
        "slug": "essentuki",
        "popular": 0,
        "region": {
            "id": 655190,
            "name": "Ставропольский край",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:18:00",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 642770,
        "name": "Новотроицк",
        "region_id": 642480,
        "name_prepositional": "Новотроицке",
        "metro": 0,
        "population": 100,
        "slug": "novotroitsk",
        "popular": 0,
        "region": {
            "id": 642480,
            "name": "Оренбургская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:16:18",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 641510,
        "name": "Бердск",
        "region_id": 641470,
        "name_prepositional": "Бердске",
        "metro": 0,
        "population": 100,
        "slug": "berdsk",
        "popular": 0,
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
    },
    {
        "id": 648690,
        "name": "Ухта",
        "region_id": 648340,
        "name_prepositional": "Ухте",
        "metro": 0,
        "population": 100,
        "slug": "ukhta",
        "popular": 0,
        "region": {
            "id": 648340,
            "name": "Коми",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:17:16",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 653311,
        "name": "Назрань",
        "region_id": 628455,
        "name_prepositional": "Назрани",
        "metro": 0,
        "population": 100,
        "slug": "nazran",
        "popular": 0,
        "region": {
            "id": 628455,
            "name": "Ингушетия",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:08",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 660680,
        "name": "Ханты-Мансийск",
        "region_id": 660300,
        "name_prepositional": "Ханты-Мансийске",
        "metro": 0,
        "population": 98,
        "slug": "khanty-mansiysk",
        "popular": 98,
        "region": {
            "id": 660300,
            "name": "Ханты-Мансийский АО",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:17",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 659440,
        "name": "Сарапул",
        "region_id": 659200,
        "name_prepositional": "Сарапуле",
        "metro": 0,
        "population": 97,
        "slug": "sarapul",
        "popular": 0,
        "region": {
            "id": 659200,
            "name": "Удмуртия",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:13",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+4:00"
        }
    },
    {
        "id": 636550,
        "name": "Гатчина",
        "region_id": 636370,
        "name_prepositional": "Гатчине",
        "metro": 0,
        "population": 94,
        "slug": "gatchina",
        "popular": 0,
        "region": {
            "id": 636370,
            "name": "Ленинградская область",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:15:41",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 656650,
        "name": "Мичуринск",
        "region_id": 656520,
        "name_prepositional": "Мичуринске",
        "metro": 0,
        "population": 93,
        "slug": "michurinsk",
        "popular": 0,
        "region": {
            "id": 656520,
            "name": "Тамбовская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:18:01",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 637540,
        "name": "Магадан",
        "region_id": 637530,
        "name_prepositional": "Магадане",
        "metro": 0,
        "population": 92,
        "slug": "magadan",
        "popular": 0,
        "region": {
            "id": 637530,
            "name": "Магаданская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:49",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+10:00"
        }
    },
    {
        "id": 645280,
        "name": "Великие Луки",
        "region_id": 645260,
        "name_prepositional": "Великих Луках",
        "metro": 0,
        "population": 91,
        "slug": "velikiye-luki",
        "popular": 0,
        "region": {
            "id": 645260,
            "name": "Псковская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:16:25",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 623530,
        "name": "Губкин",
        "region_id": 623410,
        "name_prepositional": "Губкине",
        "metro": 0,
        "population": 90,
        "slug": "gubkin",
        "popular": 0,
        "region": {
            "id": 623410,
            "name": "Белгородская область",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:13:47",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 631280,
        "name": "Киселевск",
        "region_id": 631080,
        "name_prepositional": "Киселевске",
        "metro": 0,
        "population": 90,
        "slug": "kiselevsk",
        "popular": 0,
        "region": {
            "id": 631080,
            "name": "Кемеровская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:22",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+7:00"
        }
    },
    {
        "id": 628530,
        "name": "Кинешма",
        "region_id": 628450,
        "name_prepositional": "Кинешме",
        "metro": 0,
        "population": 83,
        "slug": "kineshma",
        "popular": 0,
        "region": {
            "id": 628450,
            "name": "Ивановская область",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:07",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 643450,
        "name": "Кузнецк",
        "region_id": 643250,
        "name_prepositional": "Кузнецке",
        "metro": 0,
        "population": 83,
        "slug": "kuznetsk",
        "popular": 0,
        "region": {
            "id": 643250,
            "name": "Пензенская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:16:21",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 633270,
        "name": "Ейск",
        "region_id": 632660,
        "name_prepositional": "Ейске",
        "metro": 0,
        "population": 83,
        "slug": "eysk",
        "popular": 0,
        "region": {
            "id": 632660,
            "name": "Краснодарский край",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:27",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 638210,
        "name": "Егорьевск",
        "region_id": 637680,
        "name_prepositional": "Егорьевске",
        "metro": 0,
        "population": 80,
        "slug": "egorevsk",
        "popular": 0,
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
        "id": 635980,
        "name": "Шадринск",
        "region_id": 635730,
        "name_prepositional": "Шадринске",
        "metro": 0,
        "population": 80,
        "slug": "shadrinsk",
        "popular": 0,
        "region": {
            "id": 635730,
            "name": "Курганская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:29",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 651120,
        "name": "Азов",
        "region_id": 651110,
        "name_prepositional": "Азове",
        "metro": 0,
        "population": 80,
        "slug": "azov",
        "popular": 0,
        "region": {
            "id": 651110,
            "name": "Ростовская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:36",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 661190,
        "name": "Озерск",
        "region_id": 660710,
        "name_prepositional": "Озерске",
        "metro": 0,
        "population": 80,
        "slug": "ozersk",
        "popular": 0,
        "region": {
            "id": 660710,
            "name": "Челябинская область",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:18",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 633570,
        "name": "Кропоткин",
        "region_id": 632660,
        "name_prepositional": "Кропоткине",
        "metro": 0,
        "population": 80,
        "slug": "kropotkin",
        "popular": 0,
        "region": {
            "id": 632660,
            "name": "Краснодарский край",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:27",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 633080,
        "name": "Геленджик",
        "region_id": 632660,
        "name_prepositional": "Геленджике",
        "metro": 0,
        "population": 80,
        "slug": "gelendzhik",
        "popular": 0,
        "region": {
            "id": 632660,
            "name": "Краснодарский край",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:27",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 636510,
        "name": "Выборг",
        "region_id": 636370,
        "name_prepositional": "Выборге",
        "metro": 0,
        "population": 77,
        "slug": "viborg",
        "popular": 0,
        "region": {
            "id": 636370,
            "name": "Ленинградская область",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:15:41",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 651090,
        "name": "Черногорск",
        "region_id": 650890,
        "name_prepositional": "Черногорске",
        "metro": 0,
        "population": 74,
        "slug": "chernogorsk",
        "popular": 0,
        "region": {
            "id": 650890,
            "name": "Хакасия",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:17:35",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+7:00"
        }
    },
    {
        "id": 626740,
        "name": "Биробиджан",
        "region_id": 626470,
        "name_prepositional": "Биробиджане",
        "metro": 0,
        "population": 73,
        "slug": "birobidzhan",
        "popular": 0,
        "region": {
            "id": 626470,
            "name": "Еврейская АО",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:05",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+10:00"
        }
    },
    {
        "id": 631880,
        "name": "Кирово-Чепецк",
        "region_id": 631730,
        "name_prepositional": "Кирово-Чепецке",
        "metro": 0,
        "population": 73,
        "slug": "kirovo-chepetsk",
        "popular": 0,
        "region": {
            "id": 631730,
            "name": "Кировская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:24",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 636500,
        "name": "Всеволожск",
        "region_id": 636370,
        "name_prepositional": "Всеволожске",
        "metro": 0,
        "population": 72,
        "slug": "vsevolozhsk",
        "popular": 0,
        "region": {
            "id": 636370,
            "name": "Ленинградская область",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:15:41",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 634400,
        "name": "Славянск-на-Кубани",
        "region_id": 632660,
        "name_prepositional": "Славянске-на-Кубани",
        "metro": 0,
        "population": 70,
        "slug": "slavyansk-na-kubani",
        "popular": 0,
        "region": {
            "id": 632660,
            "name": "Краснодарский край",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:27",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 646570,
        "name": "Туймазы",
        "region_id": 645790,
        "name_prepositional": "Туймазах",
        "metro": 0,
        "population": 70,
        "slug": "tuymazy",
        "popular": 0,
        "region": {
            "id": 645790,
            "name": "Башкортостан",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:16:28",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 621556,
        "name": "Феодосия",
        "region_id": 621550,
        "name_prepositional": "Феодосии",
        "metro": 0,
        "population": 70,
        "slug": "feodosiya",
        "popular": 0,
        "region": {
            "id": 621550,
            "name": "Крым",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 15:58:03",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 653940,
        "name": "Верхняя Пышма",
        "region_id": 653700,
        "name_prepositional": "Верхней Пышме",
        "metro": 0,
        "population": 69,
        "slug": "verkhnyaya-pyshma",
        "popular": 0,
        "region": {
            "id": 653700,
            "name": "Свердловская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:43",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 655430,
        "name": "Георгиевск",
        "region_id": 655190,
        "name_prepositional": "Георгиевске",
        "metro": 0,
        "population": 67,
        "slug": "georgievsk",
        "popular": 0,
        "region": {
            "id": 655190,
            "name": "Ставропольский край",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:18:00",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 640760,
        "name": "Кстово",
        "region_id": 640310,
        "name_prepositional": "Кстово",
        "metro": 0,
        "population": 67,
        "slug": "kstovo",
        "popular": 0,
        "region": {
            "id": 640310,
            "name": "Нижегородская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:56",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 622490,
        "name": "Белогорск",
        "region_id": 622470,
        "name_prepositional": "Белогорске",
        "metro": 0,
        "population": 66,
        "slug": "belogorsk",
        "popular": 0,
        "region": {
            "id": 622470,
            "name": "Амурская область",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:13:06",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+9:00"
        }
    },
    {
        "id": 650460,
        "name": "Лениногорск",
        "region_id": 650130,
        "name_prepositional": "Лениногорске",
        "metro": 0,
        "population": 65,
        "slug": "leninogorsk",
        "popular": 0,
        "region": {
            "id": 650130,
            "name": "Татарстан",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:32",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 660390,
        "name": "Когалым",
        "region_id": 660300,
        "name_prepositional": "Когалыме",
        "metro": 0,
        "population": 64,
        "slug": "kogalym",
        "popular": 0,
        "region": {
            "id": 660300,
            "name": "Ханты-Мансийский АО",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:17",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 662812,
        "name": "Горно-Алтайск",
        "region_id": 662811,
        "name_prepositional": "Горно-Алтайске",
        "metro": 0,
        "population": 63,
        "slug": "gorno-altaisk",
        "popular": 0,
        "region": {
            "id": 662811,
            "name": "Республика Алтай",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:18:29",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+7:00"
        }
    },
    {
        "id": 626320,
        "name": "Россошь",
        "region_id": 625670,
        "name_prepositional": "Россоши",
        "metro": 0,
        "population": 62,
        "slug": "rossosch",
        "popular": 0,
        "region": {
            "id": 625670,
            "name": "Воронежская область",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:03",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 624030,
        "name": "Клинцы",
        "region_id": 623840,
        "name_prepositional": "Клинцах",
        "metro": 0,
        "population": 62,
        "slug": "klintsy",
        "popular": 0,
        "region": {
            "id": 623840,
            "name": "Брянская область",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:14:40",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 633600,
        "name": "Крымск",
        "region_id": 632660,
        "name_prepositional": "Крымске",
        "metro": 0,
        "population": 60,
        "slug": "krymsk",
        "popular": 0,
        "region": {
            "id": 632660,
            "name": "Краснодарский край",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:27",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 624310,
        "name": "Александров",
        "region_id": 624300,
        "name_prepositional": "Александрове",
        "metro": 0,
        "population": 60,
        "slug": "aleksandrov",
        "popular": 0,
        "region": {
            "id": 624300,
            "name": "Владимирская область",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:14:55",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 648410,
        "name": "Воркута",
        "region_id": 648340,
        "name_prepositional": "Воркуте",
        "metro": 0,
        "population": 60,
        "slug": "vorkuta",
        "popular": 0,
        "region": {
            "id": 648340,
            "name": "Коми",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:17:16",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 652010,
        "name": "Сальск",
        "region_id": 651110,
        "name_prepositional": "Сальске",
        "metro": 0,
        "population": 60,
        "slug": "salsk",
        "popular": 0,
        "region": {
            "id": 651110,
            "name": "Ростовская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:36",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 657200,
        "name": "Ржев",
        "region_id": 656890,
        "name_prepositional": "Ржеве",
        "metro": 0,
        "population": 59,
        "slug": "rzhev",
        "popular": 0,
        "region": {
            "id": 656890,
            "name": "Тверская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:18:03",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 653408,
        "name": "Урус-Мартан",
        "region_id": 660711,
        "name_prepositional": "Урус-Мартане",
        "metro": 0,
        "population": 59,
        "slug": "urus-martan",
        "popular": 0,
        "region": {
            "id": 660711,
            "name": "Чеченская Республика",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:20",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 647090,
        "name": "Избербаш",
        "region_id": 646710,
        "name_prepositional": "Избербаше",
        "metro": 0,
        "population": 58,
        "slug": "izberbash",
        "popular": 0,
        "region": {
            "id": 646710,
            "name": "Дагестан",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:16:30",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 629840,
        "name": "Прохладный",
        "region_id": 629430,
        "name_prepositional": "Прохладном",
        "metro": 0,
        "population": 57,
        "slug": "prokhladniy",
        "popular": 0,
        "region": {
            "id": 629430,
            "name": "Кабардино-Балкария",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:12",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 649560,
        "name": "Нерюнгри",
        "region_id": 649330,
        "name_prepositional": "Нерюнгри",
        "metro": 0,
        "population": 57,
        "slug": "neryungri",
        "popular": 0,
        "region": {
            "id": 649330,
            "name": "Саха (Якутия)",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:23",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+9:00"
        }
    },
    {
        "id": 640020,
        "name": "Апатиты",
        "region_id": 640000,
        "name_prepositional": "Апатитах",
        "metro": 0,
        "population": 55,
        "slug": "apatity",
        "popular": 0,
        "region": {
            "id": 640000,
            "name": "Мурманская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:53",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 648740,
        "name": "Волжск",
        "region_id": 648730,
        "name_prepositional": "Волжске",
        "metro": 0,
        "population": 54,
        "slug": "volzhsk",
        "popular": 0,
        "region": {
            "id": 648730,
            "name": "Марий Эл",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:17:19",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 640270,
        "name": "Североморск",
        "region_id": 640000,
        "name_prepositional": "Североморске",
        "metro": 0,
        "population": 52,
        "slug": "severomorsk",
        "popular": 0,
        "region": {
            "id": 640000,
            "name": "Мурманская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:53",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 654890,
        "name": "Вязьма",
        "region_id": 654860,
        "name_prepositional": "Вязьме",
        "metro": 0,
        "population": 52,
        "slug": "vyazma",
        "popular": 0,
        "region": {
            "id": 654860,
            "name": "Смоленская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:59",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 661670,
        "name": "Краснокаменск",
        "region_id": 661460,
        "name_prepositional": "Краснокаменске",
        "metro": 0,
        "population": 52,
        "slug": "krasnokamensk",
        "popular": 0,
        "region": {
            "id": 661460,
            "name": "Забайкальский край",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:18:21",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+9:00"
        }
    },
    {
        "id": 640150,
        "name": "Мончегорск",
        "region_id": 640000,
        "name_prepositional": "Мончегорске",
        "metro": 0,
        "population": 50,
        "slug": "monchegorsk",
        "popular": 0,
        "region": {
            "id": 640000,
            "name": "Мурманская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:53",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 638910,
        "name": "Московский",
        "region_id": 637680,
        "name_prepositional": "Московском",
        "metro": 0,
        "population": 50,
        "slug": "moskovskiy",
        "popular": 0,
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
        "id": 641250,
        "name": "Боровичи",
        "region_id": 641240,
        "name_prepositional": "Боровичах",
        "metro": 0,
        "population": 50,
        "slug": "borovichi",
        "popular": 0,
        "region": {
            "id": 641240,
            "name": "Новгородская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:57",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 662460,
        "name": "Салехард",
        "region_id": 662330,
        "name_prepositional": "Салехарде",
        "metro": 0,
        "population": 48,
        "slug": "salekhard",
        "popular": 0,
        "region": {
            "id": 662330,
            "name": "Ямало-Ненецкий АО",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:26",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 643140,
        "name": "Ливны",
        "region_id": 643030,
        "name_prepositional": "Ливнах",
        "metro": 0,
        "population": 47,
        "slug": "livny",
        "popular": 0,
        "region": {
            "id": 643030,
            "name": "Орловская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:16:20",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 662060,
        "name": "Канаш",
        "region_id": 662000,
        "name_prepositional": "Канаше",
        "metro": 0,
        "population": 45,
        "slug": "kanash",
        "popular": 0,
        "region": {
            "id": 662000,
            "name": "Чувашия",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:23",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 649200,
        "name": "Рузаевка",
        "region_id": 648960,
        "name_prepositional": "Рузаевке",
        "metro": 0,
        "population": 45,
        "slug": "ruzaevka",
        "popular": 0,
        "region": {
            "id": 648960,
            "name": "Мордовия",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:17:20",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 662410,
        "name": "Надым",
        "region_id": 662330,
        "name_prepositional": "Надыме",
        "metro": 0,
        "population": 44,
        "slug": "nadym",
        "popular": 0,
        "region": {
            "id": 662330,
            "name": "Ямало-Ненецкий АО",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:26",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 650000,
        "name": "Моздок",
        "region_id": 649820,
        "name_prepositional": "Моздоке",
        "metro": 0,
        "population": 41,
        "slug": "mozdok",
        "popular": 0,
        "region": {
            "id": 649820,
            "name": "Северная Осетия",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:24",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 634640,
        "name": "Темрюк",
        "region_id": 632660,
        "name_prepositional": "Темрюке",
        "metro": 0,
        "population": 40,
        "slug": "temryuk",
        "popular": 0,
        "region": {
            "id": 632660,
            "name": "Краснодарский край",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:27",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 639900,
        "name": "Щербинка",
        "region_id": 637680,
        "name_prepositional": "Щербинке",
        "metro": 0,
        "population": 40,
        "slug": "scherbinka",
        "popular": 0,
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
        "id": 630230,
        "name": "Советск",
        "region_id": 629990,
        "name_prepositional": "Советске",
        "metro": 0,
        "population": 40,
        "slug": "sovetsk",
        "popular": 0,
        "region": {
            "id": 629990,
            "name": "Калининградская область",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:13",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+2:00"
        }
    },
    {
        "id": 630680,
        "name": "Елизово",
        "region_id": 630660,
        "name_prepositional": "Елизово",
        "metro": 0,
        "population": 39,
        "slug": "elizovo",
        "popular": 0,
        "region": {
            "id": 630660,
            "name": "Камчатский край",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:19",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+12:00"
        }
    },
    {
        "id": 623140,
        "name": "Ахтубинск",
        "region_id": 623110,
        "name_prepositional": "Ахтубинске",
        "metro": 0,
        "population": 37,
        "slug": "akhtubinsk",
        "popular": 0,
        "region": {
            "id": 623110,
            "name": "Астраханская область",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:13:35",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+4:00"
        }
    },
    {
        "id": 645780,
        "name": "Яблоновский",
        "region_id": 645530,
        "name_prepositional": "Яблоновском",
        "metro": 0,
        "population": 34,
        "slug": "yablonovskiy",
        "popular": 0,
        "region": {
            "id": 645530,
            "name": "Адыгея",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:16:27",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 653500,
        "name": "Корсаков",
        "region_id": 653430,
        "name_prepositional": "Корсакове",
        "metro": 0,
        "population": 33,
        "slug": "korsakov",
        "popular": 0,
        "region": {
            "id": 653430,
            "name": "Сахалинская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:42",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+11:00"
        }
    },
    {
        "id": 640090,
        "name": "Кандалакша",
        "region_id": 640000,
        "name_prepositional": "Кандалакше",
        "metro": 0,
        "population": 31,
        "slug": "kandalaksha",
        "popular": 0,
        "region": {
            "id": 640000,
            "name": "Мурманская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:53",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 806661,
        "name": "Адлер",
        "region_id": 632660,
        "name_prepositional": "Адлере",
        "metro": 0,
        "population": 30,
        "slug": "adler",
        "popular": 0,
        "region": {
            "id": 632660,
            "name": "Краснодарский край",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:27",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 652300,
        "name": "Касимов",
        "region_id": 652220,
        "name_prepositional": "Касимове",
        "metro": 0,
        "population": 30,
        "slug": "kasimov",
        "popular": 0,
        "region": {
            "id": 652220,
            "name": "Рязанская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:17:37",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 660540,
        "name": "Пойковский",
        "region_id": 660300,
        "name_prepositional": "Пойковском",
        "metro": 0,
        "population": 30,
        "slug": "poykovskiy",
        "popular": 0,
        "region": {
            "id": 660300,
            "name": "Ханты-Мансийский АО",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:17",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 638290,
        "name": "Зарайск",
        "region_id": 637680,
        "name_prepositional": "Зарайске",
        "metro": 0,
        "population": 30,
        "slug": "zaraysk",
        "popular": 0,
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
        "id": 648130,
        "name": "Кондопога",
        "region_id": 648070,
        "name_prepositional": "Кондопоге",
        "metro": 0,
        "population": 30,
        "slug": "kondopoga",
        "popular": 0,
        "region": {
            "id": 648070,
            "name": "Карелия",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:16:31",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 631020,
        "name": "Усть-Джегута",
        "region_id": 630750,
        "name_prepositional": "Усть-Джегуте",
        "metro": 0,
        "population": 30,
        "slug": "ust-dzheguta",
        "popular": 0,
        "region": {
            "id": 630750,
            "name": "Карачаево-Черкесия",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:20",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 622190,
        "name": "Славгород",
        "region_id": 621590,
        "name_prepositional": "Славгороде",
        "metro": 0,
        "population": 29,
        "slug": "slavgorod",
        "popular": 0,
        "region": {
            "id": 621590,
            "name": "Алтайский край",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:12:09",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+7:00"
        }
    },
    {
        "id": 630050,
        "name": "Гусев",
        "region_id": 629990,
        "name_prepositional": "Гусеве",
        "metro": 0,
        "population": 28,
        "slug": "Gusev",
        "popular": 0,
        "region": {
            "id": 629990,
            "name": "Калининградская область",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:13",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+2:00"
        }
    },
    {
        "id": 642410,
        "name": "Тара",
        "region_id": 642020,
        "name_prepositional": "Таре",
        "metro": 0,
        "population": 28,
        "slug": "tara",
        "popular": 0,
        "region": {
            "id": 642020,
            "name": "Омская область",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:16:00",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+6:00"
        }
    },
    {
        "id": 621555,
        "name": "Бахчисарай",
        "region_id": 621550,
        "name_prepositional": "Бахчисарае",
        "metro": 0,
        "population": 26,
        "slug": "bakhchisaray",
        "popular": 0,
        "region": {
            "id": 621550,
            "name": "Крым",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 15:58:03",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 655650,
        "name": "Ипатово",
        "region_id": 655190,
        "name_prepositional": "Ипатово",
        "metro": 0,
        "population": 25,
        "slug": "ipatovo",
        "popular": 0,
        "region": {
            "id": 655190,
            "name": "Ставропольский край",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:18:00",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 641680,
        "name": "Краснообск",
        "region_id": 641470,
        "name_prepositional": "Краснообске",
        "metro": 0,
        "population": 25,
        "slug": "krasnoobsk",
        "popular": 0,
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
    },
    {
        "id": 653371,
        "name": "Нарьян-Мар",
        "region_id": 640001,
        "name_prepositional": "Нарьян-Маре",
        "metro": 0,
        "population": 24,
        "slug": "naryan-mar",
        "popular": 0,
        "region": {
            "id": 640001,
            "name": "Ненецкий АО",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:54",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 632410,
        "name": "Буй",
        "region_id": 632390,
        "name_prepositional": "Буе",
        "metro": 0,
        "population": 24,
        "slug": "byi",
        "popular": 0,
        "region": {
            "id": 632390,
            "name": "Костромская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:25",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 653272,
        "name": "Северобайкальск",
        "region_id": 623845,
        "name_prepositional": "Северобайкальске",
        "metro": 0,
        "population": 23,
        "slug": "severobaykalsk",
        "popular": 0,
        "region": {
            "id": 623845,
            "name": "Бурятия",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:14:52",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+8:00"
        }
    },
    {
        "id": 639260,
        "name": "Пущино",
        "region_id": 637680,
        "name_prepositional": "Пущино",
        "metro": 0,
        "population": 20,
        "slug": "Pushchino",
        "popular": 0,
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
        "id": 625720,
        "name": "Бобров",
        "region_id": 625670,
        "name_prepositional": "Боброве",
        "metro": 0,
        "population": 20,
        "slug": "bobrov",
        "popular": 0,
        "region": {
            "id": 625670,
            "name": "Воронежская область",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:03",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 631240,
        "name": "Калтан",
        "region_id": 631080,
        "name_prepositional": "Калтане",
        "metro": 0,
        "population": 20,
        "slug": "kaltan",
        "popular": 0,
        "region": {
            "id": 631080,
            "name": "Кемеровская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:22",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+7:00"
        }
    },
    {
        "id": 662814,
        "name": "Майма",
        "region_id": 662811,
        "name_prepositional": "Майме",
        "metro": 0,
        "population": 17,
        "slug": "mayma",
        "popular": 0,
        "region": {
            "id": 662811,
            "name": "Республика Алтай",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:18:29",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+7:00"
        }
    },
    {
        "id": 636000,
        "name": "Шумиха",
        "region_id": 635730,
        "name_prepositional": "Шумихе",
        "metro": 0,
        "population": 17,
        "slug": "shumikha",
        "popular": 0,
        "region": {
            "id": 635730,
            "name": "Курганская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:29",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 659630,
        "name": "Инза",
        "region_id": 659540,
        "name_prepositional": "Инзе",
        "metro": 0,
        "population": 17,
        "slug": "inza",
        "popular": 0,
        "region": {
            "id": 659540,
            "name": "Ульяновская область",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:15",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+4:00"
        }
    },
    {
        "id": 650730,
        "name": "Каа-Хем",
        "region_id": 650690,
        "name_prepositional": "Каа-Хеме",
        "metro": 0,
        "population": 17,
        "slug": "kaa-khem",
        "popular": 0,
        "region": {
            "id": 650690,
            "name": "Тыва",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:17:33",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+7:00"
        }
    },
    {
        "id": 661840,
        "name": "Петровск-Забайкальский",
        "region_id": 661460,
        "name_prepositional": "Петровске-Забайкальском",
        "metro": 0,
        "population": 16,
        "slug": "petrovsk-zabaykalskiy",
        "popular": 0,
        "region": {
            "id": 661460,
            "name": "Забайкальский край",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:18:21",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+9:00"
        }
    },
    {
        "id": 662290,
        "name": "Анадырь",
        "region_id": 662280,
        "name_prepositional": "Анадыре",
        "metro": 0,
        "population": 15,
        "slug": "anadyr",
        "popular": 0,
        "region": {
            "id": 662280,
            "name": "Чукотский АО",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:24",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+12:00"
        }
    },
    {
        "id": 806500,
        "name": "Зеленогорск",
        "region_id": 653240,
        "name_prepositional": "Зеленогорске",
        "metro": 0,
        "population": 15,
        "slug": "zelenogorsk",
        "popular": 0,
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
        "id": 653344,
        "name": "Лагань",
        "region_id": 629995,
        "name_prepositional": "Лагане",
        "metro": 0,
        "population": 13,
        "slug": "lagan",
        "popular": 0,
        "region": {
            "id": 629995,
            "name": "Калмыкия",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:15",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 625410,
        "name": "Вытегра",
        "region_id": 625330,
        "name_prepositional": "Вытегре",
        "metro": 0,
        "population": 10,
        "slug": "vytegra",
        "popular": 0,
        "region": {
            "id": 625330,
            "name": "Вологодская область",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:02",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 637360,
        "name": "Задонск",
        "region_id": 637260,
        "name_prepositional": "Задонске",
        "metro": 0,
        "population": 10,
        "slug": "zadonsk",
        "popular": 0,
        "region": {
            "id": 637260,
            "name": "Липецкая область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:48",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 646320,
        "name": "Месягутово",
        "region_id": 645790,
        "name_prepositional": "Месягутово",
        "metro": 0,
        "population": 10,
        "slug": "mesyagutovo",
        "popular": 0,
        "region": {
            "id": 645790,
            "name": "Башкортостан",
            "created_at": "2017-12-24 15:58:01",
            "updated_at": "2017-12-24 16:16:28",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 626540,
        "name": "Облучье",
        "region_id": 626470,
        "name_prepositional": "Облучье",
        "metro": 0,
        "population": 8,
        "slug": "obluchye",
        "popular": 0,
        "region": {
            "id": 626470,
            "name": "Еврейская АО",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:05",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+10:00"
        }
    },
    {
        "id": 645110,
        "name": "Тавричанка",
        "region_id": 644490,
        "name_prepositional": "Тавричанке",
        "metro": 0,
        "population": 8,
        "slug": "tavrichanka",
        "popular": 0,
        "region": {
            "id": 644490,
            "name": "Приморский край",
            "created_at": "2017-12-24 15:58:04",
            "updated_at": "2017-12-24 16:16:24",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+10:00"
        }
    },
    {
        "id": 653323,
        "name": "Магас",
        "region_id": 628455,
        "name_prepositional": "Магасе",
        "metro": 0,
        "population": 7,
        "slug": "magas",
        "popular": 0,
        "region": {
            "id": 628455,
            "name": "Ингушетия",
            "created_at": "2017-12-24 15:58:02",
            "updated_at": "2017-12-24 16:15:08",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    },
    {
        "id": 653372,
        "name": "Поселок Искателей",
        "region_id": 640001,
        "name_prepositional": "Поселке Искателей",
        "metro": 0,
        "population": 7,
        "slug": "poselok-iskateley",
        "popular": 0,
        "region": {
            "id": 640001,
            "name": "Ненецкий АО",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:54",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+5:00"
        }
    },
    {
        "id": 637550,
        "name": "Ола",
        "region_id": 637530,
        "name_prepositional": "Оле",
        "metro": 0,
        "population": 6,
        "slug": "ola",
        "popular": 0,
        "region": {
            "id": 637530,
            "name": "Магаданская область",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:49",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+10:00"
        }
    },
    {
        "id": 662300,
        "name": "Билибино",
        "region_id": 662280,
        "name_prepositional": "Билибино",
        "metro": 0,
        "population": 5,
        "slug": "bilibino",
        "popular": 0,
        "region": {
            "id": 662280,
            "name": "Чукотский АО",
            "created_at": "2017-12-24 15:58:05",
            "updated_at": "2017-12-24 16:18:24",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+12:00"
        }
    },
    {
        "id": 633530,
        "name": "Красная Поляна",
        "region_id": 632660,
        "name_prepositional": "Красной Поляне",
        "metro": 0,
        "population": 5,
        "slug": "krasnaya-polyana",
        "popular": 0,
        "region": {
            "id": 632660,
            "name": "Краснодарский край",
            "created_at": "2017-12-24 15:58:03",
            "updated_at": "2017-12-24 16:15:27",
            "used": 1,
            "code": null,
            "codes": null,
            "tz": "UTC+3:00"
        }
    }
]
```

### HTTP Request
`GET api/cities`


<!-- END_56d7be9447e2ce39ac69b09141bf5902 -->

<!-- START_a4d5223badd5566efbb334a0818791e2 -->
## api/main/{cityId}
> Example request:

```bash
curl -X GET -G "https://floristum.ru/api/main/1" 
```

```javascript
const url = new URL("https://floristum.ru/api/main/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[]
```

### HTTP Request
`GET api/main/{cityId}`


<!-- END_a4d5223badd5566efbb334a0818791e2 -->

#Orders


Orders actions
<!-- START_fcc544b1fbe5b42bdc87db0f8f19cf89 -->
## submit
Required:
* order_id
* cardHolderName
* cryptogram

> Example request:

```bash
curl -X POST "https://floristum.ru/api/payment/cloudpayments/submitpayment" 
```

```javascript
const url = new URL("https://floristum.ru/api/payment/cloudpayments/submitpayment");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "error": false,
    "message": "Успешно",
    "order": {
        "id": 40596,
        "shop_id": 869,
        "city_id": null,
        "recipient_name": null,
        "recipient_phone": null,
        "recipient_address": null,
        "recipient_flat": null,
        "recipient_info": null,
        "recipient_self": 0,
        "receiving_date": "2020-02-27",
        "receiving_time": "Согласовать",
        "anonymous": 1,
        "name": null,
        "phone": "11111",
        "email": null,
        "text": null,
        "status": "new",
        "payed": 0,
        "payment": "card",
        "key": "OifLzhnJyPjFy2he",
        "payed_at": null,
        "delivery_out_distance": 0,
        "delivery_out_price": null,
        "delivery_price": "510.00",
        "ur_name": null,
        "ur_inn": null,
        "ur_kpp": null,
        "ur_address": null,
        "ur_bank": null,
        "ur_email": "",
        "promo_code_id": 2798,
        "confirmed": 1,
        "photo": null,
        "finance_comment": null,
        "accepted_at": null,
        "recipient_photo": 0,
        "prev_shop_id": null,
        "amount": 14,
        "amountShop": 1156,
        "receivingDateFormat": "27 февраля 2020",
        "payedDateFormat": null,
        "createdAtFormat": "27 февраля 2020 02:24"
    },
    "order_list": {
        "id": 3600,
        "order_id": 40596,
        "product_id": 117356,
        "single": 0,
        "qty": 1,
        "shop_price": 646,
        "client_price": 14,
        "created_at": "2020-02-27 02:24:43",
        "updated_at": "2020-02-27 02:24:43",
        "package_id": null,
        "package_price": 0
    },
    "result": {
        "Model": {
            "TransactionId": 308907076,
            "PaReq": "eJxVUU1zgjAQ\/SsMd0yI4ctZ4tBqpx6kTouHHiNEpSOgATrqr2+CoDanfW+zu2\/fwvRcHIxfIeu8KkPTHmHTEGVaZXm5C8118mb55pRBspdCzL5E2krBYCnqmu+EkWeh6eKtH2CPWP6GcIti4Vp8oyAlgeAu5YGHbZPBKvoUJwb9IKbmjAigAaqOMt3zsmHA09PLImaEYOxhQD2EQsjFjCny\/jw7AHSjoeSFYNtDJfO6aYuRbAF1FKRVWzbywlw6BjQAaOWB7ZvmOEHouQgB0hlADzWrVke16nTOMxYnEY6vEV0mc\/tjthjHP3NneV1fPpLvEJD+ARlvhJKphBLiGRhPsDMZO4A6HnihJTCbYr3aDcBRz4ieM88MKMulusiww4BAnI9VKdQP5eM9BvRQ\/Pqu3UwbZZCPA0qp4xJbO9pRuj5XZiij3a6BBoB0EeqPhfo7q+jf\/f8A5tG1Qg==",
            "AcsUrl": "https:\/\/ds1.mirconnect.ru:443\/sc\/pareq",
            "IFrameIsAllowed": true,
            "FrameWidth": null,
            "FrameHeight": null
        },
        "InnerResult": null,
        "Success": false,
        "Message": null
    },
    "code": 200
}
```

### HTTP Request
`POST api/payment/cloudpayments/submitpayment`


<!-- END_fcc544b1fbe5b42bdc87db0f8f19cf89 -->

<!-- START_450fd212d40272e0847d41ebc4efe659 -->
## post3ds
* transactionId -&gt; int
* paRes =&gt; string

> Example request:

```bash
curl -X POST "https://floristum.ru/api/payment/cloudpayments/post3ds" 
```

```javascript
const url = new URL("https://floristum.ru/api/payment/cloudpayments/post3ds");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "error": false,
    "message": "Успешно",
    "result": {
        "Model": {
            "ReasonCode": 5006
        },
        "InnerResult": null,
        "Success": false,
        "Message": "Транзакция не найдена"
    },
    "code": 200
}
```

### HTTP Request
`POST api/payment/cloudpayments/post3ds`


<!-- END_450fd212d40272e0847d41ebc4efe659 -->

<!-- START_f69abc6f9c08f922234c4e1cf27e25d1 -->
## checkPromoCode
* code =&gt; &#039;string&#039; || code || XZ2G4

> Example request:

```bash
curl -X POST "https://floristum.ru/api/checkPromoCode" 
```

```javascript
const url = new URL("https://floristum.ru/api/checkPromoCode");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "error": false,
    "data": {
        "id": 1,
        "code": "XZ2G4",
        "value": 5,
        "code_type": "percent",
        "settings": null,
        "used_on": "2018-03-29 14:35:29",
        "created_at": "2018-03-29 10:41:37",
        "updated_at": "2018-03-29 14:35:29",
        "reusable": 0,
        "text": "5%"
    },
    "code": 200
}
```

### HTTP Request
`POST api/checkPromoCode`


<!-- END_f69abc6f9c08f922234c4e1cf27e25d1 -->

<!-- START_f9301c03a9281c0847565f96e6f723de -->
## api/orders
> Example request:

```bash
curl -X GET -G "https://floristum.ru/api/orders" 
```

```javascript
const url = new URL("https://floristum.ru/api/orders");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 37439,
        "shop_id": 397,
        "city_id": null,
        "recipient_name": "Александр",
        "recipient_phone": "+79517584767",
        "recipient_address": "Псков Госпитальная",
        "recipient_flat": null,
        "recipient_info": null,
        "recipient_self": 0,
        "receiving_date": "2018-10-18",
        "receiving_time": "с 22:00 до 23:00",
        "anonymous": 0,
        "name": null,
        "phone": "+79052122383",
        "email": null,
        "text": null,
        "status": "new",
        "payed": 1,
        "payment": "cash",
        "key": "zijc4fxyHThTOEFr",
        "payed_at": null,
        "delivery_out_distance": 0,
        "delivery_out_price": null,
        "delivery_price": "0.00",
        "ur_name": null,
        "ur_inn": null,
        "ur_kpp": null,
        "ur_address": null,
        "ur_bank": null,
        "ur_email": "",
        "promo_code_id": null,
        "confirmed": 0,
        "photo": null,
        "finance_comment": null,
        "accepted_at": null,
        "recipient_photo": 0,
        "prev_shop_id": null,
        "amount": 2400,
        "amountShop": -400,
        "receivingDateFormat": "18 октября 2018",
        "payedDateFormat": null,
        "createdAtFormat": "18 октября 2018 11:59",
        "order_lists": [
            {
                "id": 460,
                "order_id": 37439,
                "product_id": 48513,
                "single": 0,
                "qty": 1,
                "shop_price": 2000,
                "client_price": 2400,
                "created_at": "2018-10-18 11:59:37",
                "updated_at": "2018-10-18 11:59:37",
                "package_id": null,
                "package_price": 0,
                "product": {
                    "id": 48513,
                    "shop_id": 397,
                    "name": "Образец стиля.",
                    "slug": "obrazets-stilya-431",
                    "price": 5,
                    "description": "ТЕСТ",
                    "photo": "p397_1539851897_77754.jpg",
                    "make_time": 90,
                    "width": 10,
                    "height": 20,
                    "dop": 0,
                    "approved": 0,
                    "color_id": 6,
                    "product_type_id": 1,
                    "status": 1,
                    "status_comment": null,
                    "pause": 1,
                    "special_offer_id": null,
                    "sort": 3409335,
                    "single": null,
                    "status_comment_at": null,
                    "star": 0,
                    "block_id": 5,
                    "clientPrice": 7,
                    "url": "http:\/\/floristum.ru\/flowers\/obrazets-stilya-431",
                    "photoUrl": "\/uploads\/products\/397\/351x351_c\/p397_1539851897_77754.jpg",
                    "fullPrice": 7,
                    "deliveryTime": "1ч. 30мин.",
                    "shop": {
                        "id": 397,
                        "name": "SEATTLE",
                        "logo": null,
                        "photo": null,
                        "about": "Цветы",
                        "city_id": 645450,
                        "contact_phone": "+7(905)212-23-83",
                        "site": null,
                        "vk": null,
                        "ok": null,
                        "fb": null,
                        "instagram": null,
                        "youtube": null,
                        "delivery_price": "0.00",
                        "delivery_time": 0,
                        "delivery_out": 1,
                        "delivery_out_max": 0,
                        "delivery_out_price": "0.00",
                        "round_clock": 0,
                        "active": 1,
                        "delivery_free": 1
                    }
                }
            }
        ]
    }
]
```
> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/orders`


<!-- END_f9301c03a9281c0847565f96e6f723de -->

<!-- START_9bfa91de752826b7d03a6f76fb8caca6 -->
## api/order/{id}
> Example request:

```bash
curl -X POST "https://floristum.ru/api/order/1" 
```

```javascript
const url = new URL("https://floristum.ru/api/order/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 37439,
    "shop_id": 397,
    "city_id": null,
    "recipient_name": "Александр",
    "recipient_phone": "+79517584767",
    "recipient_address": "Псков Госпитальная",
    "recipient_flat": null,
    "recipient_info": null,
    "recipient_self": 0,
    "receiving_date": "2018-10-18",
    "receiving_time": "с 22:00 до 23:00",
    "anonymous": 0,
    "name": null,
    "phone": "+79052122383",
    "email": null,
    "text": null,
    "status": "new",
    "payed": 1,
    "payment": "cash",
    "key": "zijc4fxyHThTOEFr",
    "payed_at": null,
    "delivery_out_distance": 0,
    "delivery_out_price": null,
    "delivery_price": "0.00",
    "ur_name": null,
    "ur_inn": null,
    "ur_kpp": null,
    "ur_address": null,
    "ur_bank": null,
    "ur_email": "",
    "promo_code_id": null,
    "confirmed": 0,
    "photo": null,
    "finance_comment": null,
    "accepted_at": null,
    "recipient_photo": 0,
    "prev_shop_id": null,
    "amount": 2400,
    "amountShop": -400,
    "receivingDateFormat": "18 октября 2018",
    "payedDateFormat": null,
    "createdAtFormat": "18 октября 2018 11:59"
}
```

### HTTP Request
`POST api/order/{id}`


<!-- END_9bfa91de752826b7d03a6f76fb8caca6 -->

<!-- START_ad1a10d50fbdb0a507c947b3d4eadad0 -->
## api/freeOrders
> Example request:

```bash
curl -X GET -G "https://floristum.ru/api/freeOrders" 
```

```javascript
const url = new URL("https://floristum.ru/api/freeOrders");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 37463,
        "shop_id": -1,
        "city_id": 645450,
        "recipient_name": "+79192262494",
        "recipient_phone": "+79113690862",
        "recipient_address": "Яна Фабрициуса 21а",
        "recipient_flat": null,
        "recipient_info": "+7 (919) 226-24-94",
        "recipient_self": 0,
        "receiving_date": "2018-11-09",
        "receiving_time": "с 09:00 до 10:00",
        "anonymous": 0,
        "name": "Семья Махницких",
        "phone": "+79192262494",
        "email": "Nadyshka80@mail.ru",
        "text": null,
        "status": "new",
        "payed": 0,
        "payment": "card",
        "key": "ZknBKZkrUcn4jR7l",
        "payed_at": null,
        "delivery_out_distance": 0,
        "delivery_out_price": null,
        "delivery_price": "150.00",
        "ur_name": null,
        "ur_inn": null,
        "ur_kpp": null,
        "ur_address": null,
        "ur_bank": null,
        "ur_email": "",
        "promo_code_id": null,
        "confirmed": 1,
        "photo": null,
        "finance_comment": null,
        "accepted_at": null,
        "recipient_photo": 0,
        "prev_shop_id": 191,
        "amount": 1710,
        "amountShop": 1450,
        "receivingDateFormat": "09 ноября 2018",
        "payedDateFormat": null,
        "createdAtFormat": "09 ноября 2018 08:44",
        "order_lists": [
            {
                "id": 484,
                "order_id": 37463,
                "product_id": 18121,
                "single": 0,
                "qty": 1,
                "shop_price": 1300,
                "client_price": 1710,
                "created_at": "2018-11-09 08:44:19",
                "updated_at": "2018-11-09 08:44:19",
                "package_id": null,
                "package_price": 0,
                "product": {
                    "id": 18121,
                    "shop_id": 191,
                    "name": "Букет №5",
                    "slug": "buket-5-1525362195",
                    "price": 1495,
                    "description": "Необычный букет , как взрыв эмоций !",
                    "photo": "p191_1525362195_21203.jpeg",
                    "make_time": 60,
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
                    "sort": 6575085,
                    "single": null,
                    "status_comment_at": null,
                    "star": 0,
                    "block_id": 2,
                    "clientPrice": 2094,
                    "url": "http:\/\/floristum.ru\/flowers\/buket-5-1525362195",
                    "photoUrl": "\/uploads\/products\/191\/351x351_c\/p191_1525362195_21203.jpeg",
                    "fullPrice": 2094,
                    "deliveryTime": "1ч.",
                    "shop": {
                        "id": 191,
                        "name": "Katrina’s",
                        "logo": "\/uploads\/shops\/220\/logo_220_1525358407.jpeg",
                        "photo": "\/uploads\/shops\/220\/photo_220_1525358463.jpeg",
                        "about": "Мы работаем для вас в любое время",
                        "city_id": 645450,
                        "contact_phone": "+7(911)893-66-36",
                        "site": null,
                        "vk": null,
                        "ok": null,
                        "fb": null,
                        "instagram": "Katrinas_17",
                        "youtube": null,
                        "delivery_price": "150.00",
                        "delivery_time": 45,
                        "delivery_out": 1,
                        "delivery_out_max": 100,
                        "delivery_out_price": "12.00",
                        "round_clock": 0,
                        "active": 1,
                        "delivery_free": 0
                    }
                }
            }
        ]
    }
]
```
> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/freeOrders`


<!-- END_ad1a10d50fbdb0a507c947b3d4eadad0 -->

<!-- START_bc3aff8f7db9d69d10fcd6e403e18a79 -->
## api/acceptFreeOrder/{id}
> Example request:

```bash
curl -X POST "https://floristum.ru/api/acceptFreeOrder/1" 
```

```javascript
const url = new URL("https://floristum.ru/api/acceptFreeOrder/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 37463,
    "shop_id": 397,
    "city_id": 645450,
    "recipient_name": "+79192262494",
    "recipient_phone": "+79113690862",
    "recipient_address": "Яна Фабрициуса 21а",
    "recipient_flat": null,
    "recipient_info": "+7 (919) 226-24-94",
    "recipient_self": 0,
    "receiving_date": "2018-11-09",
    "receiving_time": "с 09:00 до 10:00",
    "anonymous": 0,
    "name": "Семья Махницких",
    "phone": "+79192262494",
    "email": "Nadyshka80@mail.ru",
    "text": null,
    "status": 2,
    "payed": 0,
    "payment": "card",
    "key": "ZknBKZkrUcn4jR7l",
    "payed_at": null,
    "delivery_out_distance": 0,
    "delivery_out_price": null,
    "delivery_price": "150.00",
    "ur_name": null,
    "ur_inn": null,
    "ur_kpp": null,
    "ur_address": null,
    "ur_bank": null,
    "ur_email": "",
    "promo_code_id": null,
    "confirmed": 1,
    "photo": null,
    "finance_comment": null,
    "accepted_at": null,
    "recipient_photo": 0,
    "prev_shop_id": 191,
    "amount": 1710,
    "amountShop": 1450,
    "receivingDateFormat": "09 ноября 2018",
    "payedDateFormat": null,
    "createdAtFormat": "09 ноября 2018 08:44"
}
```

### HTTP Request
`POST api/acceptFreeOrder/{id}`


<!-- END_bc3aff8f7db9d69d10fcd6e403e18a79 -->

<!-- START_ed472662a7e53b721e0661f2842b02e7 -->
## api/rejectionOrder/{id}
> Example request:

```bash
curl -X POST "https://floristum.ru/api/rejectionOrder/1" 
```

```javascript
const url = new URL("https://floristum.ru/api/rejectionOrder/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 37463,
    "shop_id": 397,
    "city_id": 645450,
    "recipient_name": "+79192262494",
    "recipient_phone": "+79113690862",
    "recipient_address": "Яна Фабрициуса 21а",
    "recipient_flat": null,
    "recipient_info": "+7 (919) 226-24-94",
    "recipient_self": 0,
    "receiving_date": "2018-11-09",
    "receiving_time": "с 09:00 до 10:00",
    "anonymous": 0,
    "name": "Семья Махницких",
    "phone": "+79192262494",
    "email": "Nadyshka80@mail.ru",
    "text": null,
    "status": "accepted",
    "payed": 0,
    "payment": "card",
    "key": "ZknBKZkrUcn4jR7l",
    "payed_at": null,
    "delivery_out_distance": 0,
    "delivery_out_price": null,
    "delivery_price": "150.00",
    "ur_name": null,
    "ur_inn": null,
    "ur_kpp": null,
    "ur_address": null,
    "ur_bank": null,
    "ur_email": "",
    "promo_code_id": null,
    "confirmed": 1,
    "photo": null,
    "finance_comment": null,
    "accepted_at": null,
    "recipient_photo": 0,
    "prev_shop_id": 191,
    "amount": 1710,
    "amountShop": 1450,
    "receivingDateFormat": "09 ноября 2018",
    "payedDateFormat": null,
    "createdAtFormat": "09 ноября 2018 08:44"
}
```

### HTTP Request
`POST api/rejectionOrder/{id}`


<!-- END_ed472662a7e53b721e0661f2842b02e7 -->

<!-- START_7618e172dd775f5dbe7c734861f55532 -->
## confirmSmsCode
sms_code =&gt; &#039;string&#039;

> Example request:

```bash
curl -X POST "https://floristum.ru/api/confirmSmsCode/1" 
```

```javascript
const url = new URL("https://floristum.ru/api/confirmSmsCode/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/confirmSmsCode/{id}`


<!-- END_7618e172dd775f5dbe7c734861f55532 -->

<!-- START_83112a65fb604be54373873131919b3e -->
## create
### Создание заказа (required)
* &#039;receiving_date&#039; =&gt; &#039;required | date_format:&quot;d.m.Y&quot;&#039; || &#039;19.02.2020&#039;
* &#039;receiving_time&#039; =&gt; &#039;required&#039; || &#039;с 14:00 до 16:00&#039;
* &#039;phone&#039; =&gt; &#039;required&#039; || &#039;+79052122383&#039;
* products[]: &#039;required | product_id&#039; || 113170
* qty: &#039;number&#039; || 1
### Others:
* promo_code: &#039;string&#039; || &#039;1FBgHH&#039;
* text: &#039;string&#039; || &#039;Тест&#039;
* recipient_name: &#039;string&#039; || &#039;Тест&#039;
* recipient_phone: &#039;string&#039; || &#039;+998999999999&#039;
* name[]: &#039;string&#039; || &#039;Тест&#039;
* recipient_address: &#039;string&#039; || &#039;Тест&#039;
* delivery_out: &#039;on&#039; || &#039;off&#039;
* delivery_out_distance: &#039;number&#039; || 10
* recipient_info: &#039;string&#039; || &#039;Тест&#039;
* anonymous: &#039;on&#039; || &#039;off&#039;
* recipient_photo: &#039;on&#039; || &#039;off&#039;
* email: &#039;emaul&#039; || &#039;test@test.test&#039;
* payment: &#039;card&#039; || &#039;cash&#039; || &#039;rs&#039;
### IF UR:
* ur_name: &#039;string&#039; || &#039;&#039;
* ur_inn: &#039;string&#039; || &#039;&#039;
* ur_kpp: &#039;string&#039; || &#039;&#039;
* ur_address: &#039;string&#039; || &#039;&#039;
* ur_bank: &#039;string&#039; || &#039;&#039;

> Example request:

```bash
curl -X POST "https://floristum.ru/api/payment/cloudpayments/createpayment" 
```

```javascript
const url = new URL("https://floristum.ru/api/payment/cloudpayments/createpayment");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/payment/cloudpayments/createpayment`


<!-- END_83112a65fb604be54373873131919b3e -->

<!-- START_96da0bd4f2ebecacb9c7bea66c039c9a -->
## api/payment/cloudpayments/checkpayment
> Example request:

```bash
curl -X POST "https://floristum.ru/api/payment/cloudpayments/checkpayment" 
```

```javascript
const url = new URL("https://floristum.ru/api/payment/cloudpayments/checkpayment");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/payment/cloudpayments/checkpayment`


<!-- END_96da0bd4f2ebecacb9c7bea66c039c9a -->

<!-- START_ac5a076b85213979160b4430592e7412 -->
## api/payment/cloudpayments/confirmpayment
> Example request:

```bash
curl -X POST "https://floristum.ru/api/payment/cloudpayments/confirmpayment" 
```

```javascript
const url = new URL("https://floristum.ru/api/payment/cloudpayments/confirmpayment");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/payment/cloudpayments/confirmpayment`


<!-- END_ac5a076b85213979160b4430592e7412 -->

#Products


<!-- START_73123bf76e0c8a3894762f134aa9ae56 -->
## api/products/{city_id}/{category_slug}
> Example request:

```bash
curl -X GET -G "https://floristum.ru/api/products/1/1" 
```

```javascript
const url = new URL("https://floristum.ru/api/products/1/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [],
    "first_page_url": "http:\/\/localhost\/api\/products\/1\/1?page=1",
    "from": null,
    "last_page": 1,
    "last_page_url": "http:\/\/localhost\/api\/products\/1\/1?page=1",
    "next_page_url": null,
    "path": "http:\/\/localhost\/api\/products\/1\/1",
    "per_page": 15,
    "prev_page_url": null,
    "to": null,
    "total": 0
}
```

### HTTP Request
`GET api/products/{city_id}/{category_slug}`


<!-- END_73123bf76e0c8a3894762f134aa9ae56 -->

<!-- START_d7e310d943b60d7e9738e43e86d47f60 -->
## api/products/{city_id}
> Example request:

```bash
curl -X GET -G "https://floristum.ru/api/products/1" 
```

```javascript
const url = new URL("https://floristum.ru/api/products/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [],
    "first_page_url": "http:\/\/localhost\/api\/products\/1?page=1",
    "from": null,
    "last_page": 1,
    "last_page_url": "http:\/\/localhost\/api\/products\/1?page=1",
    "next_page_url": null,
    "path": "http:\/\/localhost\/api\/products\/1",
    "per_page": 15,
    "prev_page_url": null,
    "to": null,
    "total": 0
}
```

### HTTP Request
`GET api/products/{city_id}`


<!-- END_d7e310d943b60d7e9738e43e86d47f60 -->

<!-- START_86e0ac5d4f8ce9853bc22fd08f2a0109 -->
## api/products
> Example request:

```bash
curl -X GET -G "https://floristum.ru/api/products" 
```

```javascript
const url = new URL("https://floristum.ru/api/products");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 55632,
            "shop_id": 152,
            "name": "Букет из 21 желтой розы",
            "slug": "buket-iz-21-zheltoy-rozy-259",
            "price": 1317,
            "description": "Букет из 21 (70см) желтой розы.",
            "photo": "p152_1544528803_85101.jpg",
            "make_time": 120,
            "width": 25,
            "height": 70,
            "dop": 0,
            "approved": 0,
            "color_id": 4,
            "product_type_id": 1,
            "status": 1,
            "status_comment": null,
            "pause": 0,
            "special_offer_id": null,
            "sort": 60103432,
            "single": null,
            "status_comment_at": null,
            "star": 1,
            "block_id": 4,
            "clientPrice": 2063,
            "url": "http:\/\/floristum.ru\/flowers\/buket-iz-21-zheltoy-rozy-259",
            "photoUrl": "\/uploads\/products\/152\/351x351_c\/p152_1544528803_85101.jpg",
            "fullPrice": 2063,
            "deliveryTime": "2ч.",
            "shop": {
                "id": 152,
                "name": "Цветочный Гид",
                "delivery_price": "350.00",
                "delivery_time": 150
            },
            "photos": [
                {
                    "id": 58051,
                    "product_id": 55632,
                    "photo": "p152_1544528803_85101.jpg",
                    "created_at": "2018-12-11 14:46:43",
                    "updated_at": "2018-12-11 14:46:43",
                    "priority": 0,
                    "cdn_response": null
                }
            ]
        },
        {
            "id": 57312,
            "shop_id": 152,
            "name": "Букет букет из 41 альстромерии микс",
            "slug": "buket-buket-iz-41-alstromerii-miks-605",
            "price": 3342,
            "description": "Пышный букет из разноцветной альстромерии.",
            "photo": "p152_1545045380_73107.jpg",
            "make_time": 60,
            "width": 50,
            "height": 60,
            "dop": 0,
            "approved": 0,
            "color_id": 10,
            "product_type_id": 1,
            "status": 1,
            "status_comment": null,
            "pause": 0,
            "special_offer_id": null,
            "sort": 53292817,
            "single": null,
            "status_comment_at": null,
            "star": 1,
            "block_id": 4,
            "clientPrice": 4695,
            "url": "http:\/\/floristum.ru\/flowers\/buket-buket-iz-41-alstromerii-miks-605",
            "photoUrl": "\/uploads\/products\/152\/351x351_c\/p152_1545045380_73107.jpg",
            "fullPrice": 4695,
            "deliveryTime": "1ч.",
            "shop": {
                "id": 152,
                "name": "Цветочный Гид",
                "delivery_price": "350.00",
                "delivery_time": 150
            },
            "photos": [
                {
                    "id": 59768,
                    "product_id": 57312,
                    "photo": "p152_1545045380_73107.jpg",
                    "created_at": "2018-12-17 14:16:20",
                    "updated_at": "2018-12-17 14:16:20",
                    "priority": 0,
                    "cdn_response": null
                }
            ]
        },
        {
            "id": 63651,
            "shop_id": 152,
            "name": "Букет из 31 кустовой розы микс",
            "slug": "buket-iz-31-kustovoy-rozy-miks-378",
            "price": 1620,
            "description": "Кустовые розы относится к роду шиповников, которые появились на Земле примерно 40 млн. лет назад. На сегодняшний день данный род объединяет примерно 250 видов различных растений и больше 200 тыс. сортов. Сначала роза именовалась древнеперсидским словом «wrodon», затем в греческом языке ее стали называть «rhodon». Позже данное слово было преобразовано римлянами в «rosa». В умеренных и теплых областях Северного полушария можно повстречать розы в диких условиях, они не уступают в красоте и превосходном аромате садовым формам. На сегодняшний день садоводы выращивают самые различные сорта и гибриды данного растения, которые отличаются удивительной красотой цветков. Они пользуются особой популярностью не только у цветоводов, садоводов и ландшафтных дизайнеров, но и у всех любителей прекрасного.",
            "photo": "p152_1547768337_55248.jpg",
            "make_time": 30,
            "width": 35,
            "height": 55,
            "dop": 0,
            "approved": 0,
            "color_id": 10,
            "product_type_id": 1,
            "status": 1,
            "status_comment": null,
            "pause": 0,
            "special_offer_id": null,
            "sort": 5581026,
            "single": null,
            "status_comment_at": null,
            "star": 1,
            "block_id": 1,
            "clientPrice": 2456,
            "url": "http:\/\/floristum.ru\/flowers\/buket-iz-31-kustovoy-rozy-miks-378",
            "photoUrl": "\/uploads\/products\/152\/351x351_c\/p152_1547768337_55248.jpg",
            "fullPrice": 2456,
            "deliveryTime": " 30мин.",
            "shop": {
                "id": 152,
                "name": "Цветочный Гид",
                "delivery_price": "350.00",
                "delivery_time": 150
            },
            "photos": [
                {
                    "id": 66475,
                    "product_id": 63651,
                    "photo": "p152_1547768337_55248.jpg",
                    "created_at": "2019-01-18 02:38:57",
                    "updated_at": "2019-01-18 02:38:57",
                    "priority": 0,
                    "cdn_response": null
                }
            ]
        },
        {
            "id": 63654,
            "shop_id": 152,
            "name": "Букет из 11 пионовидных кустовых роз",
            "slug": "buket-iz-11-pionovidnykh-kustovykh-roz-489",
            "price": 1418,
            "description": "Кустовые розы относится к роду шиповников, которые появились на Земле примерно 40 млн. лет назад. На сегодняшний день данный род объединяет примерно 250 видов различных растений и больше 200 тыс. сортов. Сначала роза именовалась древнеперсидским словом «wrodon», затем в греческом языке ее стали называть «rhodon». Позже данное слово было преобразовано римлянами в «rosa». В умеренных и теплых областях Северного полушария можно повстречать розы в диких условиях, они не уступают в красоте и превосходном аромате садовым формам. На сегодняшний день садоводы выращивают самые различные сорта и гибриды данного растения, которые отличаются удивительной красотой цветков. Они пользуются особой популярностью не только у цветоводов, садоводов и ландшафтных дизайнеров, но и у всех любителей прекрасного.",
            "photo": "p152_1547770209_75031.jpg",
            "make_time": 30,
            "width": 20,
            "height": 55,
            "dop": 0,
            "approved": 0,
            "color_id": 2,
            "product_type_id": 1,
            "status": 1,
            "status_comment": null,
            "pause": 0,
            "special_offer_id": null,
            "sort": 2651361,
            "single": null,
            "status_comment_at": null,
            "star": 1,
            "block_id": 4,
            "clientPrice": 2194,
            "url": "http:\/\/floristum.ru\/flowers\/buket-iz-11-pionovidnykh-kustovykh-roz-489",
            "photoUrl": "\/uploads\/products\/152\/351x351_c\/p152_1547770209_75031.jpg",
            "fullPrice": 2194,
            "deliveryTime": " 30мин.",
            "shop": {
                "id": 152,
                "name": "Цветочный Гид",
                "delivery_price": "350.00",
                "delivery_time": 150
            },
            "photos": [
                {
                    "id": 66478,
                    "product_id": 63654,
                    "photo": "p152_1547770209_75031.jpg",
                    "created_at": "2019-01-18 03:10:09",
                    "updated_at": "2019-01-18 03:10:09",
                    "priority": 0,
                    "cdn_response": null
                }
            ]
        },
        {
            "id": 52309,
            "shop_id": 159,
            "name": "Корзина цветов \"Разноцветные фрезии в корзинке\"",
            "slug": "korzina-tsvetov-raznotsvetnye-frezii-v-korzinke-892",
            "price": 3772,
            "description": "Корзина из 25-ти разноцветных фрезий с декоративной зеленью в корзине.",
            "photo": "p159_1542648124_40993.jpg",
            "make_time": 240,
            "width": 30,
            "height": 30,
            "dop": 0,
            "approved": 0,
            "color_id": 10,
            "product_type_id": 4,
            "status": 1,
            "status_comment": null,
            "pause": 0,
            "special_offer_id": null,
            "sort": 24516965,
            "single": null,
            "status_comment_at": null,
            "star": 1,
            "block_id": 7,
            "clientPrice": 5554,
            "url": "http:\/\/floristum.ru\/flowers\/korzina-tsvetov-raznotsvetnye-frezii-v-korzinke-892",
            "photoUrl": "\/uploads\/products\/159\/351x351_c\/p159_1542648124_40993.jpg",
            "fullPrice": 5554,
            "deliveryTime": "4ч.",
            "shop": {
                "id": 159,
                "name": "Шарлотта",
                "delivery_price": "650.00",
                "delivery_time": 180
            },
            "photos": [
                {
                    "id": 54525,
                    "product_id": 52309,
                    "photo": "p159_1542648124_40993.jpg",
                    "created_at": "2018-11-19 20:22:04",
                    "updated_at": "2018-11-19 20:22:04",
                    "priority": 0,
                    "cdn_response": null
                },
                {
                    "id": 54526,
                    "product_id": 52309,
                    "photo": "p159_1542648135_32325.jpg",
                    "created_at": "2018-11-19 20:22:15",
                    "updated_at": "2018-11-19 20:22:15",
                    "priority": 1,
                    "cdn_response": null
                },
                {
                    "id": 54527,
                    "product_id": 52309,
                    "photo": "p159_1542648141_42653.jpg",
                    "created_at": "2018-11-19 20:22:22",
                    "updated_at": "2018-11-19 20:22:22",
                    "priority": 2,
                    "cdn_response": null
                }
            ]
        },
        {
            "id": 52310,
            "shop_id": 159,
            "name": "Корзина из роз \"Солнце\" (51 роза)",
            "slug": "korzina-iz-roz-solntse-51-roza-685",
            "price": 7939,
            "description": "Корзина из 51 желтой кустовой розы с декоративной зеленью в корзине.",
            "photo": "p159_1542648232_77966.jpg",
            "make_time": 300,
            "width": 55,
            "height": 55,
            "dop": 0,
            "approved": 0,
            "color_id": 4,
            "product_type_id": 4,
            "status": 1,
            "status_comment": null,
            "pause": 0,
            "special_offer_id": null,
            "sort": 74766483,
            "single": null,
            "status_comment_at": null,
            "star": 1,
            "block_id": 7,
            "clientPrice": 10971,
            "url": "http:\/\/floristum.ru\/flowers\/korzina-iz-roz-solntse-51-roza-685",
            "photoUrl": "\/uploads\/products\/159\/351x351_c\/p159_1542648232_77966.jpg",
            "fullPrice": 10971,
            "deliveryTime": "5ч.",
            "shop": {
                "id": 159,
                "name": "Шарлотта",
                "delivery_price": "650.00",
                "delivery_time": 180
            },
            "photos": [
                {
                    "id": 54528,
                    "product_id": 52310,
                    "photo": "p159_1542648232_77966.jpg",
                    "created_at": "2018-11-19 20:23:52",
                    "updated_at": "2018-11-19 20:23:52",
                    "priority": 0,
                    "cdn_response": null
                },
                {
                    "id": 54529,
                    "product_id": 52310,
                    "photo": "p159_1542648286_29168.jpg",
                    "created_at": "2018-11-19 20:24:46",
                    "updated_at": "2018-11-19 20:24:46",
                    "priority": 1,
                    "cdn_response": null
                }
            ]
        },
        {
            "id": 52551,
            "shop_id": 159,
            "name": "Корзина из весенних цветов \"Весенняя яркая\"",
            "slug": "korzina-iz-vesennikh-tsvetov-vesennyaya-yarkaya-763",
            "price": 3253,
            "description": "ирис 7, лизиантус 3, кустовая роза 2, тюльпан 10, статица 1, зелень, корзина",
            "photo": "p159_1542727797_48085.jpg",
            "make_time": 180,
            "width": 45,
            "height": 35,
            "dop": 0,
            "approved": 0,
            "color_id": 10,
            "product_type_id": 4,
            "status": 1,
            "status_comment": null,
            "pause": 0,
            "special_offer_id": null,
            "sort": 60471889,
            "single": null,
            "status_comment_at": null,
            "star": 1,
            "block_id": 7,
            "clientPrice": 4879,
            "url": "http:\/\/floristum.ru\/flowers\/korzina-iz-vesennikh-tsvetov-vesennyaya-yarkaya-763",
            "photoUrl": "\/uploads\/products\/159\/351x351_c\/p159_1542727797_48085.jpg",
            "fullPrice": 4879,
            "deliveryTime": "3ч.",
            "shop": {
                "id": 159,
                "name": "Шарлотта",
                "delivery_price": "650.00",
                "delivery_time": 180
            },
            "photos": [
                {
                    "id": 54799,
                    "product_id": 52551,
                    "photo": "p159_1542727797_48085.jpg",
                    "created_at": "2018-11-20 18:29:57",
                    "updated_at": "2018-11-20 18:29:57",
                    "priority": 0,
                    "cdn_response": null
                }
            ]
        },
        {
            "id": 53531,
            "shop_id": 159,
            "name": "Корзина с цветами, чаем и сладостями \"Matre\"",
            "slug": "korzina-s-tsvetami-chaem-i-sladostyami-matre-659",
            "price": 5293,
            "description": "Корзина в синенево-кремовых тонах из роз, фиолетовых фрезий, лизиантусов, белой альстромерии, а так же чаем в Ж\/Б, печеньем Ж\/Б, шоколадкой Lindt, в корзине.",
            "photo": "p159_1543417022_53503.jpg",
            "make_time": 240,
            "width": 40,
            "height": 40,
            "dop": 0,
            "approved": 0,
            "color_id": 10,
            "product_type_id": 10,
            "status": 1,
            "status_comment": null,
            "pause": 0,
            "special_offer_id": null,
            "sort": 98064119,
            "single": null,
            "status_comment_at": null,
            "star": 1,
            "block_id": 9,
            "clientPrice": 7531,
            "url": "http:\/\/floristum.ru\/flowers\/korzina-s-tsvetami-chaem-i-sladostyami-matre-659",
            "photoUrl": "\/uploads\/products\/159\/351x351_c\/p159_1543417022_53503.jpg",
            "fullPrice": 7531,
            "deliveryTime": "4ч.",
            "shop": {
                "id": 159,
                "name": "Шарлотта",
                "delivery_price": "650.00",
                "delivery_time": 180
            },
            "photos": [
                {
                    "id": 55830,
                    "product_id": 53531,
                    "photo": "p159_1543417022_53503.jpg",
                    "created_at": "2018-11-28 17:57:02",
                    "updated_at": "2018-11-28 17:57:02",
                    "priority": 0,
                    "cdn_response": null
                }
            ]
        },
        {
            "id": 56355,
            "shop_id": 159,
            "name": "Корзина \"Ягоды с макарунами\"",
            "slug": "korzina-yagody-s-makarunami-143",
            "price": 4590,
            "description": "Корзинка с ягодами: клубника 500 гр, ежевика 125 гр., малина 125 гр, голубика 125 гр, смородина 125 гр, макаруны 14 шт.",
            "photo": "p159_1544627520_20940.jpg",
            "make_time": 90,
            "width": 30,
            "height": 30,
            "dop": 0,
            "approved": 0,
            "color_id": 1,
            "product_type_id": 9,
            "status": 1,
            "status_comment": null,
            "pause": 0,
            "special_offer_id": null,
            "sort": 2893975,
            "single": null,
            "status_comment_at": null,
            "star": 1,
            "block_id": 4,
            "clientPrice": 6617,
            "url": "http:\/\/floristum.ru\/flowers\/korzina-yagody-s-makarunami-143",
            "photoUrl": "\/uploads\/products\/159\/351x351_c\/p159_1544627520_20940.jpg",
            "fullPrice": 6617,
            "deliveryTime": "1ч. 30мин.",
            "shop": {
                "id": 159,
                "name": "Шарлотта",
                "delivery_price": "650.00",
                "delivery_time": 180
            },
            "photos": [
                {
                    "id": 58778,
                    "product_id": 56355,
                    "photo": "p159_1544627520_20940.jpg",
                    "created_at": "2018-12-12 18:12:00",
                    "updated_at": "2018-12-12 18:12:00",
                    "priority": 0,
                    "cdn_response": null
                },
                {
                    "id": 58779,
                    "product_id": 56355,
                    "photo": "p159_1544627534_23526.jpg",
                    "created_at": "2018-12-12 18:12:14",
                    "updated_at": "2018-12-12 18:12:14",
                    "priority": 1,
                    "cdn_response": null
                },
                {
                    "id": 58780,
                    "product_id": 56355,
                    "photo": "p159_1544627544_63590.jpg",
                    "created_at": "2018-12-12 18:12:24",
                    "updated_at": "2018-12-12 18:12:24",
                    "priority": 2,
                    "cdn_response": null
                }
            ]
        },
        {
            "id": 67110,
            "shop_id": 159,
            "name": "Корзина цветов \"Гламур\"",
            "slug": "korzina-tsvetov-glamur-597",
            "price": 6025,
            "description": "Корзина в розово-сиреневых тонах из орхидей ванда 4 шт, роз Аква 5 шт, кустовых роз нежных оттенков 5 шт, лизиантусов 3 шт, сиреневая роза кения 5 шт, зелень грин белл 3 шт, розовых пионов 3 шт, салал 1 пачка, хлопок 3 шт.",
            "photo": "p159_1549041505_31505.jpg",
            "make_time": 240,
            "width": 40,
            "height": 40,
            "dop": 0,
            "approved": 0,
            "color_id": 10,
            "product_type_id": 4,
            "status": 1,
            "status_comment": null,
            "pause": 0,
            "special_offer_id": null,
            "sort": 4947706,
            "single": null,
            "status_comment_at": null,
            "star": 1,
            "block_id": 7,
            "clientPrice": 8483,
            "url": "http:\/\/floristum.ru\/flowers\/korzina-tsvetov-glamur-597",
            "photoUrl": "\/uploads\/products\/159\/351x351_c\/p159_1549041505_31505.jpg",
            "fullPrice": 8483,
            "deliveryTime": "4ч.",
            "shop": {
                "id": 159,
                "name": "Шарлотта",
                "delivery_price": "650.00",
                "delivery_time": 180
            },
            "photos": [
                {
                    "id": 70051,
                    "product_id": 67110,
                    "photo": "p159_1549041505_31505.jpg",
                    "created_at": "2019-02-01 20:18:25",
                    "updated_at": "2019-02-01 20:18:25",
                    "priority": 0,
                    "cdn_response": null
                },
                {
                    "id": 70052,
                    "product_id": 67110,
                    "photo": "p159_1549041529_18677.jpg",
                    "created_at": "2019-02-01 20:18:49",
                    "updated_at": "2019-02-01 20:18:49",
                    "priority": 1,
                    "cdn_response": null
                },
                {
                    "id": 70053,
                    "product_id": 67110,
                    "photo": "p159_1549041536_47857.jpg",
                    "created_at": "2019-02-01 20:18:56",
                    "updated_at": "2019-02-01 20:18:56",
                    "priority": 2,
                    "cdn_response": null
                }
            ]
        },
        {
            "id": 87196,
            "shop_id": 159,
            "name": "Корзинка с розами \"Небольшой комплимент\"",
            "slug": "korzinka-s-rozami-nebolshoy-kompliment-822",
            "price": 1614,
            "description": "Корзинка в розовых тонах из роз Аква 5 шт, кустовых роз 4 шт, салал, писташ.",
            "photo": "p159_1557239651_41502.jpg",
            "make_time": 180,
            "width": 25,
            "height": 25,
            "dop": 0,
            "approved": 0,
            "color_id": 2,
            "product_type_id": 4,
            "status": 1,
            "status_comment": null,
            "pause": 0,
            "special_offer_id": null,
            "sort": 51304137,
            "single": null,
            "status_comment_at": null,
            "star": 1,
            "block_id": 4,
            "clientPrice": 2749,
            "url": "http:\/\/floristum.ru\/flowers\/korzinka-s-rozami-nebolshoy-kompliment-822",
            "photoUrl": "\/uploads\/products\/159\/351x351_c\/p159_1557239651_41502.jpg",
            "fullPrice": 2749,
            "deliveryTime": "3ч.",
            "shop": {
                "id": 159,
                "name": "Шарлотта",
                "delivery_price": "650.00",
                "delivery_time": 180
            },
            "photos": [
                {
                    "id": 91266,
                    "product_id": 87196,
                    "photo": "p159_1557239651_41502.jpg",
                    "created_at": "2019-05-07 17:34:11",
                    "updated_at": "2019-05-07 17:34:11",
                    "priority": 0,
                    "cdn_response": null
                },
                {
                    "id": 91267,
                    "product_id": 87196,
                    "photo": "p159_1557239668_73120.jpg",
                    "created_at": "2019-05-07 17:34:28",
                    "updated_at": "2019-05-07 17:34:28",
                    "priority": 1,
                    "cdn_response": null
                }
            ]
        },
        {
            "id": 97249,
            "shop_id": 159,
            "name": "Корзинка цветов \"Этим летом\"",
            "slug": "korzinka-tsvetov-etim-letom-649",
            "price": 2554,
            "description": "Корзина из минигербер красного, оранжевого, желтого цветов 11 шт, ромашек 3 шт, альстромерий белых 3 шт, рускус 15 шт, декоративные ленты 3 шт.",
            "photo": "p159_1565023459_40697.jpg",
            "make_time": 180,
            "width": 35,
            "height": 35,
            "dop": 0,
            "approved": 0,
            "color_id": 10,
            "product_type_id": 4,
            "status": 1,
            "status_comment": null,
            "pause": 0,
            "special_offer_id": null,
            "sort": 83703454,
            "single": null,
            "status_comment_at": null,
            "star": 1,
            "block_id": 7,
            "clientPrice": 3971,
            "url": "http:\/\/floristum.ru\/flowers\/korzinka-tsvetov-etim-letom-649",
            "photoUrl": "\/uploads\/products\/159\/351x351_c\/p159_1565023459_40697.jpg",
            "fullPrice": 3971,
            "deliveryTime": "3ч.",
            "shop": {
                "id": 159,
                "name": "Шарлотта",
                "delivery_price": "650.00",
                "delivery_time": 180
            },
            "photos": [
                {
                    "id": 101928,
                    "product_id": 97249,
                    "photo": "p159_1565023459_40697.jpg",
                    "created_at": "2019-08-05 19:44:19",
                    "updated_at": "2019-08-05 19:44:19",
                    "priority": 0,
                    "cdn_response": null
                },
                {
                    "id": 101929,
                    "product_id": 97249,
                    "photo": "p159_1565023525_86853.jpg",
                    "created_at": "2019-08-05 19:45:25",
                    "updated_at": "2019-08-05 19:45:25",
                    "priority": 1,
                    "cdn_response": null
                },
                {
                    "id": 101930,
                    "product_id": 97249,
                    "photo": "p159_1565023534_15392.jpg",
                    "created_at": "2019-08-05 19:45:35",
                    "updated_at": "2019-08-05 19:45:35",
                    "priority": 2,
                    "cdn_response": null
                }
            ]
        },
        {
            "id": 111216,
            "shop_id": 159,
            "name": "Букет цветов \"Запах весны\"",
            "slug": "buket-tsvetov-zapakh-vesny-247",
            "price": 3136,
            "description": "Букет из синих гиацинтов и желтых тюльпанов с декоративной зеленью в подарочной упаковке.",
            "photo": "p159_1572003776_62940.jpg",
            "make_time": 90,
            "width": 40,
            "height": 40,
            "dop": 0,
            "approved": 0,
            "color_id": 10,
            "product_type_id": 2,
            "status": 1,
            "status_comment": null,
            "pause": 0,
            "special_offer_id": null,
            "sort": 24069951,
            "single": null,
            "status_comment_at": null,
            "star": 1,
            "block_id": 1,
            "clientPrice": 4727,
            "url": "http:\/\/floristum.ru\/flowers\/buket-tsvetov-zapakh-vesny-247",
            "photoUrl": "\/uploads\/products\/159\/351x351_c\/p159_1572003776_62940.jpg",
            "fullPrice": 4727,
            "deliveryTime": "1ч. 30мин.",
            "shop": {
                "id": 159,
                "name": "Шарлотта",
                "delivery_price": "650.00",
                "delivery_time": 180
            },
            "photos": [
                {
                    "id": 116575,
                    "product_id": 111216,
                    "photo": "p159_1572003776_62940.jpg",
                    "created_at": "2019-10-25 14:42:56",
                    "updated_at": "2019-10-25 14:42:56",
                    "priority": 0,
                    "cdn_response": null
                }
            ]
        },
        {
            "id": 111264,
            "shop_id": 168,
            "name": "Букет Розовых роз и Синих ирисов",
            "slug": "buket-rozovykh-roz-i-sinikh-irisov-430",
            "price": 1783,
            "description": "Букет комплимент",
            "photo": "p168_1572519118_29790.jpg",
            "make_time": 30,
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
            "sort": 83366809,
            "single": null,
            "status_comment_at": null,
            "star": 1,
            "block_id": 3,
            "clientPrice": 2668,
            "url": "http:\/\/floristum.ru\/flowers\/buket-rozovykh-roz-i-sinikh-irisov-430",
            "photoUrl": "\/uploads\/products\/168\/351x351_c\/p168_1572519118_29790.jpg",
            "fullPrice": 2668,
            "deliveryTime": " 30мин.",
            "shop": {
                "id": 168,
                "name": "Florpro",
                "delivery_price": "350.00",
                "delivery_time": 0
            },
            "photos": [
                {
                    "id": 116656,
                    "product_id": 111264,
                    "photo": "p168_1572519118_29790.jpg",
                    "created_at": "2019-10-31 13:51:59",
                    "updated_at": "2019-10-31 13:51:59",
                    "priority": 0,
                    "cdn_response": null
                },
                {
                    "id": 116657,
                    "product_id": 111264,
                    "photo": "p168_1572519142_33655.jpg",
                    "created_at": "2019-10-31 13:52:23",
                    "updated_at": "2019-10-31 13:52:23",
                    "priority": 1,
                    "cdn_response": null
                },
                {
                    "id": 116658,
                    "product_id": 111264,
                    "photo": "p168_1572519146_65652.jpg",
                    "created_at": "2019-10-31 13:52:26",
                    "updated_at": "2019-10-31 13:52:26",
                    "priority": 2,
                    "cdn_response": null
                },
                {
                    "id": 116659,
                    "product_id": 111264,
                    "photo": "p168_1572519150_46517.jpg",
                    "created_at": "2019-10-31 13:52:30",
                    "updated_at": "2019-10-31 13:52:30",
                    "priority": 3,
                    "cdn_response": null
                },
                {
                    "id": 116660,
                    "product_id": 111264,
                    "photo": "p168_1572519153_69971.jpg",
                    "created_at": "2019-10-31 13:52:33",
                    "updated_at": "2019-10-31 13:52:33",
                    "priority": 4,
                    "cdn_response": null
                }
            ]
        },
        {
            "id": 11627,
            "shop_id": 176,
            "name": "Сладкие поздравления",
            "slug": "sladkie-pozdravleniya",
            "price": 4790,
            "description": "Вкусная и ароматная корзина с цветами и клубникой , также сладкий комплимент : Коробка с макарунами",
            "photo": "p176_1523963278_16147.jpeg",
            "make_time": 240,
            "width": 40,
            "height": 35,
            "dop": 0,
            "approved": 0,
            "color_id": 10,
            "product_type_id": 4,
            "status": 1,
            "status_comment": null,
            "pause": 0,
            "special_offer_id": null,
            "sort": 47002296,
            "single": null,
            "status_comment_at": null,
            "star": 1,
            "block_id": 7,
            "clientPrice": 7427,
            "url": "http:\/\/floristum.ru\/flowers\/sladkie-pozdravleniya",
            "photoUrl": "\/uploads\/products\/176\/351x351_c\/p176_1523963278_16147.jpeg",
            "fullPrice": 7427,
            "deliveryTime": "4ч.",
            "shop": {
                "id": 176,
                "name": "Прованс",
                "delivery_price": "1200.00",
                "delivery_time": 240
            },
            "photos": [
                {
                    "id": 12670,
                    "product_id": 11627,
                    "photo": "p176_1523963278_16147.jpeg",
                    "created_at": "2018-04-17 14:08:00",
                    "updated_at": "2019-05-05 17:49:49",
                    "priority": 0,
                    "cdn_response": "{\"632x632\":{\"public_id\":\"632x632\\\/176\\\/p176_1523963278_16147\",\"version\":1557067786,\"signature\":\"41e1f20088fc8f7a8d550c2ea93a981e1b0ed64a\",\"width\":632,\"height\":632,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T14:49:46Z\",\"tags\":[],\"bytes\":149105,\"type\":\"upload\",\"etag\":\"48c8899176864c3b0973adf42ade341e\",\"placeholder\":false,\"url\":\"http:\\\/\\\/res.cloudinary.com\\\/floristum\\\/image\\\/upload\\\/v1557067786\\\/632x632\\\/176\\\/p176_1523963278_16147.jpg\",\"secure_url\":\"https:\\\/\\\/res.cloudinary.com\\\/floristum\\\/image\\\/upload\\\/v1557067786\\\/632x632\\\/176\\\/p176_1523963278_16147.jpg\",\"original_filename\":\"p176_1523963278_16147\",\"original_extension\":\"jpeg\"},\"350x350\":{\"public_id\":\"350x350\\\/176\\\/p176_1523963278_16147\",\"version\":1557067788,\"signature\":\"7e5496b4f5debee9bff5a077086f194b665d00e2\",\"width\":350,\"height\":350,\"format\":\"jpg\",\"resource_type\":\"image\",\"created_at\":\"2019-05-05T14:49:48Z\",\"tags\":[],\"bytes\":53455,\"type\":\"upload\",\"etag\":\"035ca484a2f097656765d9ac9513ef66\",\"placeholder\":false,\"url\":\"http:\\\/\\\/res.cloudinary.com\\\/floristum\\\/image\\\/upload\\\/v1557067788\\\/350x350\\\/176\\\/p176_1523963278_16147.jpg\",\"secure_url\":\"https:\\\/\\\/res.cloudinary.com\\\/floristum\\\/image\\\/upload\\\/v1557067788\\\/350x350\\\/176\\\/p176_1523963278_16147.jpg\",\"original_filename\":\"p176_1523963278_16147\",\"original_extension\":\"jpeg\"}}"
                }
            ]
        }
    ],
    "first_page_url": "http:\/\/localhost\/api\/products?page=1",
    "from": 1,
    "last_page": 105,
    "last_page_url": "http:\/\/localhost\/api\/products?page=105",
    "next_page_url": "http:\/\/localhost\/api\/products?page=2",
    "path": "http:\/\/localhost\/api\/products",
    "per_page": 15,
    "prev_page_url": null,
    "to": 15,
    "total": 1572
}
```

### HTTP Request
`GET api/products`


<!-- END_86e0ac5d4f8ce9853bc22fd08f2a0109 -->

#User


<!-- START_c149233fdb490055a84b51dd8bbedaf8 -->
## api/user/addFirebaseToken
> Example request:

```bash
curl -X POST "https://floristum.ru/api/user/addFirebaseToken" 
```

```javascript
const url = new URL("https://floristum.ru/api/user/addFirebaseToken");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/user/addFirebaseToken`


<!-- END_c149233fdb490055a84b51dd8bbedaf8 -->

<!-- START_2b6e5a4b188cb183c7e59558cce36cb6 -->
## api/user
> Example request:

```bash
curl -X GET -G "https://floristum.ru/api/user" 
```

```javascript
const url = new URL("https://floristum.ru/api/user");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 427,
    "name": null,
    "email": "a.elcheninov@mail.ru",
    "confirmed": 1,
    "confirmation_code": "ODv6zUdE9v9B4nrVHy9V19tRRik15h",
    "created_at": "2019-11-01 00:00:00",
    "updated_at": "2020-02-08 22:00:40",
    "phone": "+79052122383",
    "admin": 0,
    "firebase_token": "e7hLQtpdx74:APA91bGTDwvnkH_b54g0uOsaqjsQ9vgVV3WVJdqjyRzU8SH-LjmL3VDuvNEm5swl026KiUn2tL2SpPaeCAJWY4uCkBLVWDaXTQSzoHnhho312U2hSrGXOfR-52aHLOIRhl9DKvBIN3Kv"
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/user`


<!-- END_2b6e5a4b188cb183c7e59558cce36cb6 -->

#general


<!-- START_3045eab9b818156433434f751510823f -->
## api/cart/{id}
> Example request:

```bash
curl -X GET -G "https://floristum.ru/api/cart/1" 
```

```javascript
const url = new URL("https://floristum.ru/api/cart/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
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
        "url": "http:\/\/floristum.ru\/flowers\/buket-nomer-chetyre",
        "photoUrl": "\/uploads\/products\/62\/351x351_c\/p62_1519228779_42033.jpg",
        "fullPrice": 13396,
        "deliveryTime": "12ч.",
        "shop": {
            "id": 62,
            "name": "Счастливые люди",
            "logo": "\/uploads\/shops\/65\/logo_65_1522151127.jpg",
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
```
> Example response (404):

```json
{
    "message": "No query results for model [App\\Model\\Product] 1"
}
```

### HTTP Request
`GET api/cart/{id}`


<!-- END_3045eab9b818156433434f751510823f -->

<!-- START_4157e0edf1bceccf85f04a2d1851670c -->
## api/v1/products
> Example request:

```bash
curl -X GET -G "https://floristum.ru/api/v1/products" 
```

```javascript
const url = new URL("https://floristum.ru/api/v1/products");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "No query results for model [App\\Model\\City]."
}
```

### HTTP Request
`GET api/v1/products`


<!-- END_4157e0edf1bceccf85f04a2d1851670c -->

<!-- START_8dcb027a7d5b882e72b8c951e487202b -->
## api/v1/singleProduct/getProductByQty
> Example request:

```bash
curl -X GET -G "https://floristum.ru/api/v1/singleProduct/getProductByQty" 
```

```javascript
const url = new URL("https://floristum.ru/api/v1/singleProduct/getProductByQty");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "No query results for model [App\\Model\\City]."
}
```

### HTTP Request
`GET api/v1/singleProduct/getProductByQty`


<!-- END_8dcb027a7d5b882e72b8c951e487202b -->


