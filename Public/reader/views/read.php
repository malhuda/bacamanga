<section id="read" class="read-manga content" data-url="<?= base_url("manga/{$this->uri->segment(2)}/") ?>" data-prev="<?= $page->prev['url'] ?>" data-next="<?= $page->next['url'] ?>">
	<?php foreach ($images as $img) : ?>
		<img src="<?= $img ?>">
	<?php endforeach; ?>
</section>
<!-- Scripts -->
<script>
	jQuery(function($) {
		$(document).keydown(function(event) {
			var keycode = event.which;
			var site = $('#read').data('url');
			var next = $('#read').data('next');
			var prev = $('#read').data('prev');
			switch (keycode) {
				case 37 :
				if (prev) {
					$.notify(
						{title: "<strong>Info:</strong> ",icon:"fa fa-bullhorn fa-fw",message:"Loading, please wait..."},
						{
							placement: {from:"bottom",align:"right"},
							animate: {enter:'animated fadeInDown',exit:'animated fadeOutUp'}
						});
					window.location = site + prev;
				} else {
					swal("Oops!", "sudah di chapter pertama", "warning");
				}
				return false;

				case 39 :
				if (next) {
					$.notify(
						{title: "<strong>Info:</strong> ",icon:"fa fa-bullhorn fa-fw",message:"Loading, please wait..."},
						{
							placement: {from:"bottom",align:"right"},
							animate: {enter:'animated fadeInDown',exit:'animated fadeOutUp'}
						});
					window.location = site + next;
				} else {
					swal("Oops!", "belum ada chapter baru", "warning");
				}
				return false;

				default :
				return true;
			}
		});
		var lastScrollTop = 0;
		$(window).scroll(function(event){
			var st = $(this).scrollTop();
			if (st > lastScrollTop){
				$('.navbar').addClass('kamuflase');
			} else {
				$('.navbar').removeClass('kamuflase');
			}
			lastScrollTop = st;
		});
		<?php if ($config->auto_bookmark) : ?>
		$(window).on('load', function() {
			setTimeout(function(){
				$.ajax(
				{
					type: "GET",
					url: $('#bookmark').data('href'),
					datatype: 'json',
					success: function(json){
						var data = JSON.parse(json);
						$.notify(
							{title: "<strong>Info:</strong> ",icon:"fa fa-bullhorn fa-fw",message:data.pesan},
							{
								placement: {from:"bottom",align:"right"},
								animate: {enter:'animated fadeInDown',exit:'animated fadeOutUp'}
							});
					}
				});
			}, 1000);
		});
		<?php else : ?>
		$('#bookmark').on('click', function() {
			swal({
				title: 'Bookmark!',
				text: 'bookmark chapter ini?',
				type: 'info',
				showCancelButton: true,
				closeOnConfirm: false,
				showLoaderOnConfirm: true,
				confirmButtonText: "Ya",
				cancelButtonText: "Tidak",
			}, function() {
				$.ajax(
				{
					type: "GET",
					url: $('#bookmark').data('href'),
					datatype: 'json',
					success: function(json){
						var data = JSON.parse(json);
						swal(data.title, data.pesan, data.status);
					}
				});
			});
		});
		<?php endif; ?>
	});
</script>
