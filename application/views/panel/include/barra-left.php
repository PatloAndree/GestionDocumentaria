<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
	<div class="scrollbar-inner">
		<!-- Brand -->
	
		<div class="sidenav-header d-flex align-items-center">
			<a class="navbar-brand pb-0 pr-0" href="<?php echo base_url() . 'panel/inicio'; ?>">

			<?php if ($this->session->userdata('usuario_tipo') == 2) : ?>
				<img src="<?php echo base_url() . 'assets/dist/img/avatar5.png'; ?>" class="navbar-brand-img" alt="...">
			<?php endif ?>
		
			<?php if($this->session->userdata('usuario_tipo') == 1) : ?>
				<img src="<?php echo base_url() . 'assets/dist/img/logo.png'; ?>" class="navbar-brand-img" alt="...">
			<?php endif ?>
				
				<!-- <span class="linea"> &nbsp; En linea <i class="fas fa-circle" style="font-size:9px"></i>  &nbsp;</span> -->
			</a>
			<!-- Menu Sanguchito -->
			<div class="ml-auto">
				<!-- Sidenav toggler -->
				<div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
					<div class="sidenav-toggler-inner">
						<i class="sidenav-toggler-line"></i>
						<i class="sidenav-toggler-line"></i>
						<i class="sidenav-toggler-line"></i>
					</div>
				</div>
			</div>
		</div>
		
		<div class="navbar-inner">
			<!-- Collapse -->
			<div class="collapse navbar-collapse" id="sidenav-collapse-main">
				<!-- Nav items -->
				<ul class="navbar-nav">
				
					<li class="nav-item">
						<a href="<?php echo base_url() . 'panel/requisitos'; ?>" class="nav-link <?php 
							if ($current_controller == 'requisitos') {
								echo 'active';
							} ?>">
							<i class="ni ni-folder-17 text-orange"></i>
							<span class="nav-link-text">Requisitos</span>
						</a>
					</li>

					<li class="nav-item">
						<a href="<?php echo base_url() . 'panel/registros'; ?>" class="nav-link <?php 
							if ($current_controller == 'registros') {
								echo 'active';
							} ?>">
							<i class="ni ni-archive-2 text-yellow"></i>
							<span class="nav-link-text">Registros</span>
						</a>
					</li>

					<?php if ($this->session->userdata('usuario_tipo') == 2) : ?>
						<li class="nav-item">
							<a href="<?php echo base_url() . 'panel/perfil'; ?>" class="nav-link <?php 
								if ($current_controller == 'perfil') {
									echo 'active';
								} ?>">
								<i class="ni ni-circle-08 text-gray"></i>
								<span class="nav-link-text">Mi Perfil</span>
							</a>
						</li>
					<?php endif ?>


					<?php if ($this->session->userdata('usuario_tipo') == 1) : ?>
						<li class="nav-item">
							<a href="<?php echo base_url() . 'panel/reportes'; ?>" class="nav-link <?php 
								if ($current_controller == 'reportes') {
									echo 'active';
								} ?>">
								<i class="ni ni-chart-bar-32	 text-green"></i>
								<span class="nav-link-text">Reportes</span>
							</a>
						</li>
					<?php endif ?>

					<?php if ($this->session->userdata('usuario_tipo') == 1) : ?>
					<!-- Mantenimiento -->
						<li class="nav-item">
							<!-- <a class="nav-link /* ($current_controller == 'clientes' || $current_controller == 'citas_listar' ) { -->
							<a class="nav-link <?php if ($current_controller == 'usuarios') {
									echo 'active';
								} ?>" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="<?php if ($current_controller == 'usuarios') {
										echo 'true';
								} else {
									'false';
								} ?>" aria-controls="navbar-examples">
								<i class="ni ni-circle-08 text-red"></i>
								<span class="nav-link-text">Mantenimiento</span>
							</a>

							<div class="collapse <?php if ($current_controller == 'usuarios') {
														echo 'show';
													} ?>" id="navbar-examples">
								<ul class="nav nav-sm flex-column">
									
									<?php if ($this->session->userdata('usuario_tipo') == 1) : ?>
										<li class="nav-item <?php if ($current_controller == 'usuarios') {
																echo 'active';
										} ?>">	
											<a href="<?php echo base_url() . 'panel/usuarios'; ?>" class="nav-link"><i class="ni ni-circle-08 text-orange"></i>Usuarios</a>
										</li>
									<?php endif ?>
								</ul>
							</div>
						</li>
					<?php endif ?>

					<!-- Cerrar Sesión -->
					<li class="nav-item">
						<a href="<?php echo base_url() . 'panel/inicio/salir'; ?>" class="nav-link">
							<i class="ni ni-button-power text-red"></i>
							<span class="nav-link-text">Cerrar Sesión</span>
						</a>
					</li>
					
				</ul>
			</div>
		</div>
	</div>
</nav>