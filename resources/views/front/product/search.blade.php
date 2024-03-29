<div class="row" id="product_container" data-ng-cloak>

    <div class="col-md-12" data-ng-show="popularProduct">
        <div class="hidden-lg hidden-md hidden-xs">
            <br><br>
        </div>
        <h3 class="margin-top-null"><strong><% title %></strong></h3>
        <br class="hidden-lg hidden-md">
    </div>

    <div class="col-sm-4" data-ng-repeat="product in popularProduct">
        @include('front.product.search-item')
    </div>

    <br clear="all">
    <div class="col-md-6 col-md-offset-3 bottom30" data-ng-show="links && !otherPopularProducts.length">
        <a href="<% links %>" class="btn btn-block btn-more">Показать все</a>
    </div>

    <div class="col-md-12 text-center top20" data-ng-show="!popularProduct.length && isFiltered">

        <strong>
            Извините, в городе {{ $current_city->name }} по указанным Вами параметрам предложений нет,<br>
            попробуйте изменить параметры поиска.
        </strong>

        <strong>
            <br><br><br>
            В городе {{ $current_city->name }} возможно заказать доставку следующих видов букетов:
            <br><br><br>
        </strong>

    </div>

    <div data-ng-repeat="items in otherPopularProducts">

        <div data-ng-show="items.popularProductCount >= 3">
            <div class="row">
                <div class="col-sm-12">
                    <div class="hidden-lg hidden-md hidden-xs">
                        <br><br>
                    </div>
                    <h3 class="margin-top-null"><strong><% items.productType.alt_name %></strong></h3>
                    <br class="hidden-lg hidden-md">
                </div>
            </div>

            <div class="row">

                <div class="col-sm-4" data-ng-repeat="product in items.popularProduct.data" data-ng-show="$index < 3 || items.popularProduct.total >= 6">
                    @include('front.product.search-item')
                </div>

                <br clear="all">

                <div class="col-md-6 col-md-offset-3 bottom30" ng-show="items.popularProduct.total > 6">
                    <a href="/catalog/<% items.productType.slug %>/vse-cvety" class="btn btn-block btn-more">Показать все</a>
                </div>

            </div>



            <div class="col-md-12" data-ng-show="popularProduct.length">
                <hr>
                <br><br>
            </div>
        </div>

    </div>

</div>