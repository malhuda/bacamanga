jQuery(function($) {
	var delay;
	$('#search').on('keyup', function() {
		var keywords = $(this).val();
		var target = $(this).data('target');
		var spanel = $('#search-panel');
		var sbody = $('#search-body');
		var stitle = $('#search-title');
		var sicon = $('#search-icon');
		if (keywords) {
			$('body').addClass('hidescroll');
			sicon.addClass('search-active');
			sicon.find('i').addClass('search-close');
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
			sicon.removeClass('search-active');
			sicon.find('i').removeClass('search-close');
			spanel.addClass('hide');
			$('body').removeClass('hidescroll');
		}
	});
	$('#search-icon').on('click', function() {
		$('#search').val('');
		$('#search-panel').addClass('hide');
		$('#search-icon').removeClass('search-active');
		$('#search-icon').find('i').removeClass('search-close');
		$('body').removeClass('hidescroll');
	})
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
	$('a').not('[href*="#"], .not-notify').on('click', function() {
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
function toggleFullScreen() {
	if ((document.fullScreenElement && document.fullScreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen)) {
		if (document.documentElement.requestFullScreen) {
			document.documentElement.requestFullScreen();
		} else if (document.documentElement.mozRequestFullScreen) {
			document.documentElement.mozRequestFullScreen();
		} else if (document.documentElement.webkitRequestFullScreen) {
			document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
		}  
	} else {
		if (document.cancelFullScreen) {
			document.cancelFullScreen();
		} else if (document.mozCancelFullScreen) {
			document.mozCancelFullScreen();
		} else if (document.webkitCancelFullScreen) {
			document.webkitCancelFullScreen();
		}
	}
};
