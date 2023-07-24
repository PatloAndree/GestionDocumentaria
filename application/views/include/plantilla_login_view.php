<!DOCTYPE html>
<html lang="es" xml:lang="es">
<head>
	<meta charset="utf-8">
	<title>Acceso al sistema</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/dist/";?>css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
	<!-- <img class="wave" src="wave.png"> 
	falta el php al inicio
	< echo base_url().assets/dist/img/;?>
	-->
			<div class="container">
				<div class="section1">
						<img class="imag img-fluid" src="<?php echo base_url()."assets/dist/img/";?>salud1.svg">
				</div>
				<div class="section2">
					<!-- <div class="center"> ts.png-->
						
						<!-- <h3>Breña - 02</h3> -->
						<div class="login-content">
							<?php $this->load->view($contenido); ?>
							<!-- <span style="float:right">2022</span> -->
						</div>
					<!-- </div> -->
				</div>
			</div>
			  <!--SCRIPS-->
  	<?php include('application/views/include/plugins_scripts.php')?>
    <?php include('application/views/include/plugins_scripts_implementaciones.php')?>
    <?php include('application/views/include/plugin_scripts_registrar.php')?>

</body>
</html>
