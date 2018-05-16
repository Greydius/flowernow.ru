

<div class="col-sm-{{ !empty($col) ? $col : '4' }}">
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
                <div class="col-xs-12 buy">
                    <a href="{{ route('order.add', ['product_id' => $_item['id']]) }}" class="btn btn-danger btn-outline buy-btn">Заказать</a>
                    <p><strong class="price-media-item">{{ $_item['clientPrice'] }} руб.</strong> <a href="/flowers/{{ $_item['slug'] }}" class="name">{{ $_item['name'] }}</a></p>
                    <p><img src="{{ asset('assets/front/img/ico/deliverycar.svg') }}" alt="Скорость доставки цветов"> доставка
                        @if($_item['deliveryTime'] || $_item->shop->deliveryTimeFormat2)
                        {{ $_item['deliveryTime'] ? $_item['deliveryTime'] : $_item->shop->deliveryTimeFormat2 }}
                        @else
                            от 2ч.
                        @endif
                    </p>

                </div>

            </div>
        </div>

    </div>
</div>