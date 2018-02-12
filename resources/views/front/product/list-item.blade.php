<div class="col-sm-4">
    <div class="media-item">
        <a href="/flowers/{{ $_item['slug'] }}">
            <figure>
                <img class="img-responsive" src="{{ $_item['photoUrl'] }}" alt="...">
                <figcaption>
                    <ul class="list-inline text-center">
                        <li>Ширина {{ $_item['width'] }} см</li>
                        <li>Высота {{ $_item['height'] }} см</li>
                    </ul>
                </figcaption>
            </figure>
        </a>

        <div class="description-media-item">
            <div class="row">
                <div class="col-xs-11">
                    <p><strong class="price-media-item">{{ $_item['clientPrice'] }} руб.</strong> <a href="/flowers/{{ $_item['slug'] }}" class="name">{{ $_item['name'] }}</a></p>
                    <p>{{ $_item['shop_name'] }}> &nbsp;<img src="{{ asset('assets/front/img/ico/deliverycar.svg') }}" alt="Скорость доставки цветов"> 2 ч 20 мин</p>
                </div>

            </div>
        </div>

    </div>
</div>