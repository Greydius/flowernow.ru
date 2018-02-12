<div class="media-item">
    <a href="/flowers/<% product.slug %>/">
        <figure>
            <img class="img-responsive" ng-src="/uploads/products/632x632/<% product.shop_id %>/<% product.photo %>" alt="...">
            <figcaption>
                <ul class="list-inline text-center">
                    <li>Ширина <% product.width %> см</li>
                    <li>Высота <% product.height %> см</li>
                </ul>
            </figcaption>
        </figure>
    </a>

    <div class="description-media-item">
        <div class="row">
            <div class="col-xs-11">
                <p><strong class="price-media-item"><% product.clientPrice %> руб.</strong> <a href="#" class="name"><% product.name %></a></p>
                <p><% product.shop_name %> &nbsp;<img src="{{ asset('assets/front/img/ico/deliverycar.svg') }}" alt="Скорость доставки цветов"> 2 ч 20 мин</p>
            </div>

        </div>
    </div>

</div>