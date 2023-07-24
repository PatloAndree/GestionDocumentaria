
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    
       <form id="frm_registrarUsuario" method="post" action="<?php echo site_url(); ?>registro_usuario/agregar" >
                <!-- <img src="<?php echo base_url()."assets/dist/img/";?>recuperar.png"> -->
                <h2 class="title">Registro</h2>
                <br>
                <!--<span>No hay problema, te podemos ayudar a crear una nueva </span>-->
                <div class="input-div one">
                        <div class="i">
                                <i class="fas fa-user"></i>
                        </div>
                        <div class="div">
                                <input type="text" class="input" name="nombres" 
                                placeholder=" Nombre completo" required   >
                        </div>
                </div>

                <div class="input-div one">
                        <div class="i">
                                <i class="fas fa-hospital"></i>
                        </div>
                        <div class="div">
                                <!-- <h5>ingresa tu correo electrónico</h5> -->
                                <input type="text" class="input" name="estable" id="estable"
                                placeholder=" Establecimiento" required >
                                <input type="hidden" class="input" name="estable_label" id="estable_label">
                        </div>
                </div>

                <div class="input-div one">
                        <div class="i">
                                <i class="fas fa-envelope"></i>
                        </div>
                        <div class="div">
                                <!-- <h5>ingresa tu correo electrónico</h5> -->
                                <input type="text" class="input" name="email" 
                                placeholder=" Correo" required >
                        </div>
                </div>

                <div class="input-div pass" >	
                        <div class="i"> 
                                <i class="fa fa-lock"></i>
                        </div>
                        <div class="div" id="show_hide_password">
                                <input type="password" class="input" name="password" placeholder="  Contraseña" required>
                        </div>
                        <div class="i pass" id="ojo"> 
                                <i class="fa fa-eye-slash" aria-hidden="true" ></i>	
                        </div>
		</div>
                
                <a href="<?php echo base_url();?>login" style="color:#000;">Ir al login</a>
               
                <input type="button" class="btn" id="btn_registrarUsuario" value="Registrarme">
        </form> 


        <script type="text/javascript">
                $(document).ready(function(e) {
                        $("#estable").autocomplete({
						maxShowItems: 3,
								// autoFocus: true,
						source:function(request,response){
								$.ajax({
										url: "<?php echo site_url(); ?>registro_usuario/estableList",
										type: 'post',
										dataType: 'json',
										data: {
												search: request.term
										},
										success:function(data){
												response(data);
										},
								});
						},
						select: function(event, ui){
								$('#estable').val(ui.item.label);
								$('#estable_label').val(ui.item.value);
								return false;
						}
				});
                });
          </script>
<script src="<?php echo base_url(); ?>src/js/jquery.ui.autocomplete.scroll.min.js"></script>
