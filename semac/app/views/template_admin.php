<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php echo (isset($title) ? $title." | " : "")."SEMAC"; ?></title>
	<meta name="description" content="">
	<meta name="author" content="Gustavo Seganfredo">

	<!-- Mobile viewport optimized: j.mp/bplateviewport -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!--- favicon -->
	<link rel="icon" type="image/x-icon" href="<?php echo Asset::get_file('favicon.ico', 'img') ?>" />
	<link rel="canonical" href="<?php echo Uri::current() ?>">

	<!-- CSS: implied media="all" -->
	<?php echo Asset::css('bootstrap.min.css'); ?>
	<?php echo Asset::css('bootstrap-responsive.min.css'); ?>
	<?php echo Asset::css('semac.css'); ?>
	<?php echo Asset::css('smoothness/jquery-ui-1.8.23.custom.css'); ?>
	<?php if (isset($assets['css'])) foreach (@$assets['css'] as $asset): ?>
		<?php echo Asset::css($asset); ?>
	<?php endforeach; ?>

	<!-- JavaScript at the bottom for fast page loading -->
	<?php echo Asset::js('jquery/jquery-1.8.0.min.js'); ?>
	<?php echo Asset::js('jquery/jquery-ui-1.8.23.custom.min.js'); ?>
	<?php echo Asset::js('jquery/jquery.tokeninput.js'); ?>
	<?php echo Asset::js('bootstrap/bootstrap.min.js'); ?>
	<?php if (isset($assets['js'])) foreach (@$assets['js'] as $asset): ?>
		<?php echo Asset::js($asset); ?>
	<?php endforeach; ?>

	<!-- scripts concatenated and minified via ant build script -->
	<?php echo Asset::js('application.js'); ?>
	<!-- end scripts-->
</head>

<body>
	<?php echo View::forge('templates/facebook') ?>
	<div class="wrapper">
		<?php echo $interface_topbar; ?>
		<div class="main">
			<div class="container">
				<div class="row">
					<div class="span3" style="margin-top:20px">
						<div class="well sidebar-nav">
							<?php echo $menu; ?>
						</div>
					</div>
					<div class="span9 data">
						<?php echo $content; ?>
					</div>
				</div>
			</div> <!-- /container -->
		</div>
	</div>
	<?php echo View::forge('templates/footer') ?>
	<?php echo View::forge('templates/analytics') ?>
</body>
</html>