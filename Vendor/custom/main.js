jQuery(function($) {
	var delay;
	$('#search').on('keyup', function() {
		var keywords = $(this).val();
		var target = $(this).data('target');
		if (keywords) {
			$('#search-body').html('<i class="fa fa-spinner fa-spin"></i> Loading, please wait...');
			var check = $('#search-panel').hasClass('hide');
			if (check) $('#search-panel').removeClass('hide');
			$('html, body').animate({
				scrollTop: $('#search-panel').offset().top - 71
			}, 2000);
			clearTimeout(delay);
			delay = setTimeout(function() {
				$.ajax({
					url: target,
					method: 'POST',
					dataType: 'html',
					data: {cari: keywords},
					success: function(result) {
						$('#search-body').html(result);
					}
				});
			}, 1500);
		} else {
			$('#search-panel').addClass('hide');
		}
	});
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
