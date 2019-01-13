<div class="media-item">
    <a href="/flowers/<% product.slug %>/">
        <figure>
            <img class="img-responsive" data-ng-src="/uploads/products/632x632/<% product.shop_id %>/<% product.photo %>" alt="...">
            <figcaption>
                <p>
                    <% product.description %>
                </p>
                <ul class="list-inline text-center">
                    <li><span class="glyphicon glyphicon-resize-horizontal"></span> <% product.width %> см</li>
                    <li><span class="glyphicon glyphicon-resize-vertical"></span> <% product.height %> см</li>
                </ul>
            </figcaption>
        </figure>
    </a>

    <div class="description-media-item">
        <div class="row">
            <div class="col-xs-12 buy">
                <a href="/cart/<% product.id %>" class="btn btn-danger btn-outline buy-btn">Заказать</a>
                <p><strong class="price-media-item"><% product.clientPrice %> руб.</strong> <a href="#" class="name"><% product.name %></a></p>
                <p class="delivery-line"><img src="{{ asset('assets/front/img/ico/deliverycar.svg') }}" alt="Скорость доставки цветов"> доставка цветов
                    <% product.deliveryTime ? product.deliveryTime : 'от 2ч.' %>
                </p>
            </div>

        </div>
    </div>

</div>