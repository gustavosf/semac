<div class="topbar-wrapper" style="z-index: 5;">
	<div class="topbar">
		<div class="topbar-inner">
			<div class="container">
				<h3><a href="#">SEMAC</a></h3>
				<ul class="nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="javascript:callModal()">Link</a></li>
					<li><a href="#">Link</a></li>
					<li><a href="#">Link</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle">Dropdown</a>
						<ul class="dropdown-menu">
							<li><a href="#">Secondary link</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Another link</a></li>
						</ul>
					</li>
				</ul>
				<form action="">
					<input type="text" placeholder="Search">
				</form>
				
				<?php if ($user != 'guest'): ?>
					<ul class="nav secondary-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle"><?php echo $user; ?></a>
							<ul class="dropdown-menu">
								<li><a href="#">Secondary link</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo Uri::create('admin/logout'); ?>">Sair</a></li>
							</ul>
						</li>
					</ul>
				<?php else: ?>
					<a href="<?php echo Uri::create('admin/login')?>"
						class="nav secondary-nav btn primary"
						style="margin-top:6px;">Login</a>
				<?php endif; ?>

			</div>
		</div><!-- /topbar-inner -->
	</div><!-- /topbar -->
</div>