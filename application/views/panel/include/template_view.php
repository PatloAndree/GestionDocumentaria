<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
		<meta name="author" content="Creative Tim">
		<title><?php echo $this->router->fetch_class(); ?></title>
		<!-- Favicon -->
		<link rel="icon" href="<?php echo base_url().'src/'; ?>img/brand/favicon.png" type="image/png">
		<!-- Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
		<?php include('application/views/panel/include/estilos.php'); ?>
	</head>

	<body>
		<?php include('application/views/panel/include/barra-left.php'); ?>
		<!-- Main content -->
		<div class="main-content" id="panel">
			<?php include('application/views/panel/include/barra-top.php'); ?>
			<!-- Page content -->
			<div class="header bg-success pb-6">
				<div class="container-fluid">
					<div class="header-body">
					<div class="row align-items-center py-4">
						<div class="col-lg-12">
							<h6 class="h2 text-white d-inline-block mb-0"><?php  if(isset($titulo)){ echo $titulo;} ?></h6>
						</div>
					</div>
					</div>
				</div>
			</div>
			
			<div class="container-fluid mt--6">
				<?php if(isset($contenido)){$this->load->view("panel/".$contenido);}?>
			</div>
		</div>
		<?php include('application/views/panel/include/scripts.php'); ?>
		<?php include('application/views/panel/include/implementaciones.php'); ?>
	</body>

</html>
