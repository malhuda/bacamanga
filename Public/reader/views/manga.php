<section id="manga" class="content">
	<div class="container">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-list fa-fw"></i> List Chapter</h3>
			</div>
			<div class="panel-body">
				<div class="list-group">
					<?php foreach ($list_chapter as $item) : $class = ($bookmarked && $bookmarked->url == $item->url) ? "bookmarked" : NULL; ?>
						<a href="<?= current_url()."/{$item->url}" ?>" class="list-group-item <?= $class ?>" title="<?= "{$item->manga} {$item->chapter} " ?>"><i class="fa fa-angle-double-right fa-fw"></i><?= "{$item->manga} {$item->chapter} " ?></a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>
