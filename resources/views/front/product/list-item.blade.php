

<div class="product-item col-sm-{{ !empty($col) ? $col : '4' }} col-xs-6 {{ !empty($class) ? $class : '' }}">
  <div class="product-item__inner">
    <div class="product-item__front media-item">
        @if(!empty($user) && $user->isSupervisor($current_city->id))
            <a href ng-click="editItem($event, {{ $_item['id'] }})" style="display: block; position: absolute; padding: 5px; z-index: 9;">
                <i class="fa fa-pencil"></i>
            </a>

            <a href ng-click="starItem({{ $_item['star'] ? 0 : 1 }}, {{ $_item['id'] }})" style="display: block; position: absolute; padding: 5px; z-index: 9; right: 0">
                <i class="fa fa-star{{ !$_item['star'] ? '-o' : '' }}"></i>
            </a>
        @endif
        <div class="product-image">
          <a href="/flowers/{{ $_item['slug'] }}" class="product-image">
              <figure>
                  <img class="img-responsive lazy" data-src="{{ $_item['photoUrl'] }}">

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
          @if(Route::currentRouteName() == 'favorites.show')
            <span data-product-id="{{ $_item['id'] }}" class="product-image__close">X</span>
          @endif
          @if(Route::currentRouteName() != 'favorites.show')
            <span data-product-id="{{ $_item['id'] }}" title="" class="product-image__like"></span>
          @endif
          <span class="product-image__qr">
            <span class="product-image__qr--top">100 ₽ скидка</span>
            <span class="product-image__qr--bottom">в приложении</span>
          </span>
        </div>

        <div class="description-media-item">
            <div class="row">
                <div class="col-xs-12 buy">
                    <a href="{{ route('order.add', ['product_id' => $_item['id']]) }}" class="btn btn-danger btn-outline buy-btn">Заказать</a>
                    <p><strong class="price-media-item">{{ empty($_item['deleted_at']) ? $_item['clientPrice'].' ₽' : '&nbsp;' }}</strong> <a href="/flowers/{{ $_item['slug'] }}" class="name">{{ $_item['name'] }}</a></p>
                    @if(!empty($isNeedShopName))
                        <p>{{ $_item['shop']->name }}</p>
                    @endif
                    <p class="delivery-line"><img src="{{ asset('assets/front/img/ico/deliverycar.svg') }}" alt="Скорость доставки">&nbsp;
                        @if($_item->block_id == 3)
                            до 1 ч.
                        @else
                            за 2 ч. 30 мин.
                        @endif
                        <!--
                        @if($_item['deliveryTime'] || $_item->shop->deliveryTimeFormat2)
                            {{ $_item['deliveryTime'] ? $_item['deliveryTime'] : $_item->shop->deliveryTimeFormat2 }}
                        @else
                            от 2ч.
                        @endif
                        -->
                    </p>

                </div>

            </div>
        </div>

    </div>
    <div class="product-item__back qr-item">
      <a href="" class="qr-item__close">
        <img src="{{ asset('assets/front/images/close.svg') }}" />
      </a>
      <a href="#" class="qr-item__link">Отправить ссылку на приложение</a>
      <div class="qr-item__image">
        <img src="{{ asset('assets/front/images/qr-code.svg') }}" />
      </div>
      <div class="qr-item__description">
        <div class="qr-item__download app-download">
          <a href="https://apps.apple.com/ru/app/floristum/id1454760508" target="_blank" class="app-download__item ios">
            <img src="{{ asset('assets/front/images/downloadIOS.svg') }}" alt="" class="">
          </a>
           <a href="https://play.google.com/store/apps/details?id=ru.floristum.app&hl=en_US" target="_blank" class="app-download__item andorid">
            <img src="{{ asset('assets/front/images/downloadAndroid.svg') }}" alt="" class="">
          </a>
        </div>
      </div>
    </div>
  </div>
</div>