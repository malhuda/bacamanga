jQuery(function($) {
	var delay;
	$('#search').on('keyup', function() {
		var keywords = $(this).val();
		var target = $(this).data('target');
		var spanel = $('#search-panel');
		var sbody = $('#search-body');
		var stitle = $('#search-title');
		if (keywords) {
			$('body').addClass('hidescroll');
			stitle.html('Result for <strong>'+keywords+'</strong>');
			if (spanel.hasClass('spin') == false) sbody.html('<i class="fa fa-spinner fa-spin"></i> Loading, please wait...');
			if (spanel.hasClass('hide')) spanel.removeClass('hide');
			spanel.addClass('spin');
			clearTimeout(delay);
			delay = setTimeout(function() {
				$.ajax({
					url: target,
					method: 'POST',
					dataType: 'html',
					data: {cari: keywords},
					success: function(result) {
						sbody.html(result);
						spanel.removeClass('spin');
					}
				});
			}, 1500);
		} else {
			spanel.addClass('hide');
			$('body').removeClass('hidescroll');
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
	$('a:not([href*="#"])').not('#bookmark').on('click', function() {
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
		$('[data-toggle="tooltip"]').tooltip({
			trigger : 'hover'
		});
	});
	$('a[href*="#"]:not([href="#"])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html, body').animate({
					scrollTop: target.offset().top - 71
				}, 1000);
				return false;
			}
		}
	});
});
