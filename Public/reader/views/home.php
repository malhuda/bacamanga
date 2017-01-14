<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Bacamanga</title>
		<!-- CSS -->
		<link rel="stylesheet" href="<?= base_url('Vendor/bootstrap-3.3.7/css/bootstrap.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('Vendor/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('Vendor/sweetalert/dist/sweetalert.css') ?>">
		<link rel="stylesheet" href="<?= base_url('Vendor/animate/animate.css') ?>">
		<link rel="stylesheet" href="<?= base_url('Vendor/custom/style.css') ?>">
		<!-- Scripts -->
		<script src="<?= base_url('Vendor/jQuery/jquery.min.js') ?>"></script>
		<script src="<?= base_url('Vendor/bootstrap-3.3.7/js/bootstrap.min.js') ?>"></script>
		<script src="<?= base_url('Vendor/sweetalert/dist/sweetalert.min.js') ?>"></script>
		<script src="<?= base_url('Vendor/bootstrap-notify-3.1.3/dist/bootstrap-notify.min.js') ?>"></script>
		<script src="<?= base_url('Vendor/custom/main.js') ?>"></script>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<header>
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="<?= base_url() ?>">Bacamanga</a>
					</div>
			
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<form class="navbar-form navbar-left" role="search" onsubmit="return false">
							<div class="form-group">
								<div class="input-group">
									<input id="search" type="text" class="form-control" placeholder="Search Manga" data-target="<?= base_url('search') ?>">
									<div class="input-group-addon"><i class="fa fa-search fa-fw"></i></div>
								</div>
							</div>
						</form>
						<ul class="nav navbar-nav navbar-right">
							<li data-toggle="tooltip" data-placement="bottom" title="list manga"><a href="#list_manga"><i class="fa fa-list fa-fw"></i> List Manga</a></li>
							<li data-toggle="tooltip" data-placement="bottom" title="list Bookmark"><a href="#list_bookmark"><i class="fa fa-bookmark-o fa-fw"></i> List Bookmark</a></li>
							<li data-toggle="tooltip" data-placement="bottom" title="Update list manga"><a href="<?= base_url('update') ?>"><i class="fa fa-refresh fa-fw"></i> Update</a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div>
			</nav>
		</header>
		<section id="body" class="content">
			<div id="search-panel" class="hide">
				<div class="container">
					<div class="panel panel-warning">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-search fa-fw"></i> Search</h3>
						</div>
						<div id="search-body" class="panel-body"></div>
					</div>
				</div>
			</div>
			<div class="container">
				<div id="list_bookmark" class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-bookmark-o fa-fw"></i> Bookmark</h3>
					</div>
					<div class="panel-body">
						<?php
							if ($list_bookmark) :
								echo "<div class=\"list-group\">\n";
								foreach ($list_bookmark as $item) :
									echo "<a href=\"".base_url("bookmark/{$item->path}/{$item->url}"). "\" class=\"list-group-item\" title=\"{$item->manga} {$item->chapter}\"><i class=\"fa fa-angle-double-right fa-fw\"></i>{$item->manga} {$item->chapter}</a>\n";
								endforeach;
								echo "</div>\n";
							else :
								echo "Belum ada chapter yang dibookmark";
							endif;
						?>
					</div>
				</div>
				<div id="list_manga" class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-list fa-fw"></i> List Manga</h3>
					</div>
					<div class="panel-body">
						<div class="list-group">
							<?php foreach ($list_manga as $manga) : ?>
								<a href="<?= base_url("manga/{$manga->url}") ?>" class="list-group-item" title="<?= $manga->name ?>"><i class="fa fa-angle-double-right fa-fw"></i><?= $manga->name ?></a>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<footer id="footer">
			<div class="container">
				<div class="row">
					<div class="left col-xs-12 col-md-6">
						&copy; <?= date('Y') ?> <a href="<?= base_url() ?>">Baca<strong>manga</strong></a> <span class="">- All Rights Reserved.</span>
					</div>
					<div class="right hidden-xs col-xs-12 col-md-6">
						Developed by <a href="https://www.facebook.com/zyonesth" target="_blank">Aris-kun</a>
					</div>
				</div>
			</div>
		</footer>
	</body>
</html>
