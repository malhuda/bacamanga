jQuery(function($) {
	$('#list_manga').change(function() {
		$.notify(
			{title: "<strong>Info:</strong> ",icon:"fa fa-bullhorn fa-fw",message:"Loading, please wait..."},
			{
				placement: {from:"bottom",align:"right"},
				animate: {enter:'animated fadeInDown',exit:'animated fadeOutUp'}
			});
		var site = $(this).data('url');
		if ($(this).val()) {
			window.location = site + $(this).val();
		}
	});
	$('#list_chapter').change(function() {
		$.notify(
			{title: "<strong>Info:</strong> ",icon:"fa fa-bullhorn fa-fw",message:"Loading, please wait..."},
			{
				placement: {from:"bottom",align:"right"},
				animate: {enter:'animated fadeInDown',exit:'animated fadeOutUp'}
			});
		var site = $(this).data('url');
		if ($(this).val()) {
			window.location = site + $(this).val();
		}
	});
	$('a').not('#bookmark').on('click', function() {
		$.notify(
			{title: "<strong>Info:</strong> ",icon:"fa fa-bullhorn fa-fw",message:"Loading, please wait..."},
			{
				placement: {from:"bottom",align:"right"},
				animate: {enter:'animated fadeInDown',exit:'animated fadeOutUp'}
			});
	});
	$(window).on('load', function() {
		setTimeout(function(){
			$.notify(
				{title: "<strong>Info:</strong> ",icon:"fa fa-bullhorn fa-fw",message:"Page loaded"},
				{
					delay: 1000,
					placement: {from:"bottom",align:"right"},
					animate: {enter:'animated fadeInDown',exit:'animated fadeOutUp'}
				});
		}, 500);
	});
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
});
