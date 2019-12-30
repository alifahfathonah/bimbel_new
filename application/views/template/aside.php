<aside class="left-sidebar">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<li>
					<a class="waves-effect waves-dark" href="<?php echo base_url('dashboard'); ?>" aria-expanded="false">
						<i class="icon-speedometer"></i>
						<span class="hide-menu"> Dashboard </span>
					</a>
				</li>
				<li>
					<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
						<i class="fa fa-database"></i>
						<span class="hide-menu"> Data <span class="badge badge-pill badge-cyan ml-auto">4</span></span>
					</a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="<?php echo base_url('auth'); ?>"> Users </a></li>
						<li><a href="<?php echo base_url('auth'); ?>"> Group Akses </a></li>
					</ul>
				</li>
				<li>
					<a class="waves-effect waves-dark" href="<?php echo base_url('program'); ?>" aria-expanded="false">
						<i class="fa fa-database"></i>
						<span class="hide-menu"> Program </span>
					</a>
				</li>
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>