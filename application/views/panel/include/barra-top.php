<!-- Topnav -->
<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
	<div class="container-fluid">
		<div class="collapse navbar-collapse" id="navbarSupportedContent">

			<!-- <img src="<?php echo base_url() . 'assets/dist/img/ts-c.png'; ?>" style="width:80px" alt=""> -->
			<!-- <h3>TELEINTERCONSULTA</h3> -->
			<!-- Navbar links -->
			<ul class="navbar-nav align-items-center ml-md-auto">
				<li class="nav-item d-xl-none">
					<!-- Sidenav toggler -->
					<div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
						<div class="sidenav-toggler-inner" style="background:#2dce89">
							<i class="sidenav-toggler-line"></i>
							<i class="sidenav-toggler-line"></i>
							<i class="sidenav-toggler-line"></i>
							<i class="sidenav-toggler-line"></i>
						</div>
					</div>
				</li>
			</ul>

			<ul class="navbar-nav align-items-center ml-auto ml-md-0">
				<li class="nav-item dropdown borde">
					<a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<div class="media align-items-center">
							<div class="media-body ml-2 d-none d-lg-block">
								<span class="mb-0 text-sm  font-weight-bold"><i class="ni ni-single-02 mr-2">
									</i><?php echo $this->session->userdata("usuario_nombres"); ?> 
									&nbsp;&nbsp;</span>
							</div>
						</div>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<!-- <a href="<?php echo base_url(); ?>" class="dropdown-item"target="_blank">
							<i class="ni ni-world-2 text-info"></i>
							<span>Ir a la web</span>
						</a> -->
				

							<a href="<?php echo base_url().'panel/inicio/salir'; ?>" class="dropdown-item">
								<i class="ni ni-user-run text-warning"></i>
								<span>Salir</span>
							</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>
