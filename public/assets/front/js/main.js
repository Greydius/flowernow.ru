$(function () {

	$('[data-toggle="tooltip"]').tooltip();

	$(".links-media-item-open a").click(function () {
		var $el = $($(this).attr("href"));
		$("html:not(:animated),body:not(:animated)").animate({scrollTop: $el.offset().top-62}, 1000, function(){});
		return false;
	});

});
