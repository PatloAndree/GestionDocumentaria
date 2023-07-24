
	<form id="frm_restablecerContrasenia" method="post" action="<?php echo site_url(); ?>
		olvide_contrasena/exito" >
		<img src="<?php echo base_url()."assets/dist/img/";?>recuperar.png">
		<h2 class="title">¿OLVIDASTE TU CONTRESEÑA?</h2>
		<!--<span>No hay problema, te podemos ayudar a crear una nueva </span>-->
		<div class="input-div one">
			<div class="i">
					<i class="fas fa-envelope"></i>
			</div>
		<div class="div">
				<!-- <h5>ingresa tu correo electrónico</h5> -->
				<input type="text" class="input" name="email" placeholder="  Ingresa tu correo" required>
		</div>
		</div>
		<a href="<?php echo base_url();?>login">Ir al login</a>
		<input type="button" class="btn" id="btn_restablecerContrasenia" value="Continuar">
	</form>
