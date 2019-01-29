@if(!empty($_productTypes ))
    <div class="filter-block filter-block-on-main filter-product-checker filter-block-inline filter-product-type" id="filter-product-type">
        <ul class="list-unstyled filter">
            @foreach ($_productTypes as $key => $type)
                <li style="display: inline-block; {{ $key > 0 ? ' padding: 0 0 0 20px;' : 'padding: 0;'}} border-bottom: 0; text-align: center" data-id="{{ $type->id }}" data-slug="{{ $type->slug }}" class="{{ !empty(request()->product_type_filter) && request()->product_type_filter == $type->slug ? 'active' : null }}">
                    <img style="margin-right: 0px;" src="{{ asset('assets/front/img/ico/'.$type->icon) }}" alt="{{ $type->alt_name }}">
                    <br>
                    <span style="padding-top: 5px;display: block;text-decoration: underline;">{{ $type->name }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endif