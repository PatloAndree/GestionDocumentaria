<?php
                        
                        if($hashEncontrado == '1'){ ?>

                            <form method="post" id="frm_nuevaContrasenia" action="<?php echo site_url(); ?>olvide_contrasena/restablecer_exito">
                            <img src="<?php echo base_url()."assets/dist/img/";?>exitomail.png">                
                            <h1 class="title"><?php echo $titulo;?></h1>
                            <p><?php echo $texto;?></p>
                            <div class="input-div one">	
                                <div class="i"> 
                                    <i class="fas fa-lock"></i>
                                </div>
                                <div class="div">
                                    <h5>Contraseña</h5>
                                    <input type="password" id="passwordRC" name="passwordRC" class="input" required="" data-parsley-minlength="8" data-parsley-maxlength="20" data-parsley-pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" data-parsley-required-message="Este campo es requerido!" data-parsley-pattern-message="La contraseña ingresada no cumple con el formato requerido!">
                                </div>
                            </div>
                            <div class="input-div pass">   
                                <div class="i"> 
                                    <i class="fas fa-lock"></i>
                                </div>
                                <div class="div">
                                    <h5>Verificar contraseña</h5>
                                    <input type="password" id="repitepasswordRC" name="repitepasswordRC" class=" input " required="" data-parsley-minlength="8" data-parsley-maxlength="20" data-parsley-equalto="#passwordRC" data-parsley-trigger="focusout" data-parsley-required-message="Este campo es requerido" data-parsley-equalto-message="Las dos contraseñas ingresadas deben ser iguales!">
                                </div>
                            </div>
                            <small style="color: darkseagreen;" id="passwordHelpBlock" class="form-text text-muted">
                                        Su contraseña debe tener entre 8 y 20 caracteres, contener letras y números, y no debe contener espacios, caracteres especiales o emoji.
                                    </small>
                                <input type="hidden" name="hash" value="<?php echo $hash;?>">
                                <input type="button" class="btn btn-block-xs-only" id="btn_nuevaContrasenia" value="Continuar">
                            </form><?php
                            
                        } else{?>
                            <form>
                                <img src="<?php echo base_url()."assets/dist/img/";?>traza2.png">                
                                    <h1><?php echo $titulo;?></h1>
                                    <p><?php echo $texto;?></p>
                            </form><?php }
                    ?>

