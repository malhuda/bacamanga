<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?= isset($title) ? "{$title} - Bacamanga" : "Bacamanga" ?></title>
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
								<select id="list_manga" class="open-notify form-control" data-url="<?= base_url('manga/') ?>" data-toggle="tooltip" data-placement="left" title="Manga">
									<?php foreach ($list_manga as $item) : ?>
										<option value="<?= $item->url ?>" <?= ($item->url == $this->uri->segment(2)) ? "selected" : NULL ?>><?= $item->name ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<?php if ($this->uri->segment(3)) : ?>
								<div class="form-group">
								<select id="list_chapter" class="open-notify form-control" data-url="<?= base_url("manga/{$this->uri->segment(2)}/") ?>" data-toggle="tooltip" data-placement="right" title="Chapter">
								<?php foreach ($list_chapter as $item) : ?>
											<option value="<?= $item->url ?>" <?= ($item->url == $this->uri->segment(3)) ? "selected" : NULL ?>><?= $item->chapter ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							<?php endif; ?>
						</form>
						<ul class="nav navbar-nav navbar-right">
							<?php if ($this->uri->segment(3)) : ?>
								<li <?= $config->auto_bookmark ? "class=\"hide\"" : NULL ?> data-toggle="tooltip" data-placement="left" title="Bookmark this chapter"><a id="bookmark" data-href="<?= base_url("add-bookmark/{$this->uri->segment(2)}/{$this->uri->segment(3)}") ?>" class="not-notify" style="cursor:pointer"><i class="fa fa-bookmark-o"></i> Bookmark</a></li>
							<?php endif; ?>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div>
			</nav>
		</header>
