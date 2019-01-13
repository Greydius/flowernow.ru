<!-- sample modal content -->
<div class="modal fade" id="city-choose-popup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="modal-title" id="myLargeModalLabel">Выбор города</h4>
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control input-sm" placeholder="Название города" id="search-city-input">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 regions_wrapper">
                        <h3 class="text-muted">Регион</h3>
                        <ul class="regions">
                            @foreach($regions as $region)
                                <li><a href="#" data-id="<?=$region->id?>" onclick="selectRegion(<?=$region->id?>)"><?=$region->name?></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-muted">Город</h3>
                        <ul class="cities">
                            @foreach($cities as $city)
                                <li><a href="http://{{ ($city->slug != 'moskva' ? $city->slug.'.' : '') . \Config::get('app.domain') }}" data-id="<?=$city->id?>" data-region-id="<?=$city->region_id?>"><span><?=$city->name?></span><i class="fa fa-chevron-right"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->