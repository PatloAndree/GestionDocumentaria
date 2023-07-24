<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/dist/";?>css/style.css">

	<form >
	<img class="imag_s1" src="<?php echo base_url()."assets/dist/img/";?>ts.png">
			<!-- <img class="imgBanner" src="<?php echo base_url()."assets/dist/img/";?>banner.png"> -->
			<h1 class="titulo">TELEINTERCONSULTA</h1>			

					<div class="input-div one">
						<div class="i">
								<i class="fa fa-user"></i>
						</div>
						<div class="div">
							<input type="text" class="input" id="emailIngresar" name="email" placeholder="  Correo" required>
						</div>
					</div>
					<div class="input-div pass" >	
						<div class="i"> 
								<i class="fa fa-lock"></i>
						</div>
						<div class="div" id="show_hide_password">
							<!-- <label>Contraseña</label> -->
							<input type="password" class="input" id="passwordIngresar" placeholder="Contraseña" name="password" required>
						</div>
						<div class="i pass" id="ojo"> 
							<i class="fa fa-eye-slash" aria-hidden="true" style="color:#000" ></i>	
						</div>
					</div>

				<!-- olvide mi contraseña	 -->
				<!-- <a href="<?php echo base_url();?>olvide_contrasena"></a> -->
				<input type="button" class="btn" id="btn_ingresar" value="Ingresar">
				<!-- <p>ó</p> -->
				<a href="<?php echo base_url();?>registro_usuario" class="btn_r"><?php echo base_url();?></a>
				<!-- <input type="button" class="btn_r" id="btn_ingresar" value="Registrarme"> -->
	</form>

	
	<!-- <script src="src/js/pass.js"></script> -->
	