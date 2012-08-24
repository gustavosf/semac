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
	<link rel="icon" type="image/x-icon" href="<?php echo Asset::get_file('favicon.ico', 'img') ?>">
	<link rel="canonical" href="<?php echo Uri::current() ?>">

	<!-- CSS: implied media="all" -->
	<?php echo Asset::css('bootstrap.min.css'); ?>
	<?php echo Asset::css('bootstrap-responsive.min.css'); ?>
	<?php if (isset($assets['css'])) foreach (@$assets['css'] as $asset): ?>
		<?php echo Asset::css($asset); ?>
	<?php endforeach; ?>
	<?php echo Asset::css('semac.css'); ?>
	<?php if (isset($admin)) echo Asset::css('semac.admin.css'); ?>

	<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

	<?php echo Asset::js('jquery/jquery-1.8.0.min.js'); ?>
	<?php echo Asset::js('bootstrap/bootstrap.min.js'); ?>
	<?php if (isset($assets['js'])) foreach (@$assets['js'] as $asset): ?>
		<?php echo Asset::js($asset); ?>
	<?php endforeach; ?>
	<?php echo Asset::js('application.js'); ?>

	<?php if (isset($ogtags)): ?>
		<meta property="fb:admins" content="<?php echo $ogtags['admins'] ?>" />
		<meta property="fb:app_id" content="<?php echo $ogtags['app_id'] ?>" />
		<meta property="og:site_name" content="SEMAC" />
		<meta property="og:title" content="<?php echo $ogtags['title'] ?>" />
		<meta property="og:description" content="<?php echo $ogtags['description'] ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:image" content="<?php echo $ogtags['image'] ?>" />
		<link rel="image_src" href="<?php echo $ogtags['image'] ?>" />
	<?php endif; ?>
</head>

<body>
	<?php echo View::forge('templates/facebook') ?>
	<div class="wrapper">
		<?php echo $interface_topbar; ?>
		<div class="main">
			<?php echo $content; ?>
		</div>
	</div>
	<?php echo View::forge('templates/footer') ?>
	<?php echo View::forge('templates/analytics') ?>
</body>
</html>