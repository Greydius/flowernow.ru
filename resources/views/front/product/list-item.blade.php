

<div class="col-sm-{{ !empty($col) ? $col : '4' }} col-xs-6 {{ !empty($class) ? $class : '' }}">
    <div class="media-item">
        <a href="/flowers/{{ $_item['slug'] }}">
            <figure>
                <img class="img-responsive" src="{{ $_item['photoUrl'] }}">

                <figcaption>
                    <p>
                        @foreach($_item->compositions as $composition)
                            {{ $composition->flower->name }} {{ $composition->qty ? ' - '.$composition->qty.' шт.' : null }}<br>
                        @endforeach
                        {{ $_item['description'] }}
                    </p>
                    <ul class="list-inline text-center">
                        <li><span class="glyphicon glyphicon-resize-horizontal"></span> {{ $_item['width'] }} см</li>
                        <li><span class="glyphicon glyphicon-resize-vertical"></span> {{ $_item['height'] }} см</li>
                    </ul>
                </figcaption>
            </figure>
        </a>

        <div class="description-media-item">
            <div class="row">
                <div class="col-xs-12 buy">
                    <a href="{{ route('order.add', ['product_id' => $_item['id']]) }}" class="btn btn-danger btn-outline buy-btn">Заказать</a>
                    <p><strong class="price-media-item">{{ empty($_item['deleted_at']) ? $_item['clientPrice'].' руб.' : '&nbsp;' }}</strong> <a href="/flowers/{{ $_item['slug'] }}" class="name">{{ $_item['name'] }}</a></p>
                    @if(!empty($isNeedShopName))
                        <p>{{ $_item['shop']->name }}</p>
                    @endif
                    <p class="delivery-line"><img src="{{ asset('assets/front/img/ico/deliverycar.svg') }}" alt="Скорость доставки">&nbsp; за   
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