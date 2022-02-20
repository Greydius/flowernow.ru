$(function () {

	$('[data-toggle="tooltip"]').tooltip();

        $(".links-media-item-open a").click(function () {
                var $el = $($(this).attr("href"));
                $("html:not(:animated),body:not(:animated)").animate({scrollTop: $el.offset().top - 62}, 1000, function () {
                });
                return false;
        });

        if($('#filter4 input[type="checkbox"]:checked').length) {
        	$("#filter4").collapse('show');
	}

        if($('#filter-product-price ul li.active').length) {
        	$("#filter-product-price").collapse('show');
	}

	if($('#filter-product-color .color-item.active').length) {
        	$("#filter-product-color").collapse('show');
	}

});
