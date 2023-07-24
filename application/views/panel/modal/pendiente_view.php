	<style>
		textarea{
		float:left;
		}
	</style>
	
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">EDITAR SOLICITUD - TELEINTERCONSULTA</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		<!-- <form name="registrosEdit-form" id="registrosEdit-form" method="POST" novalidate> -->
			<!-- Usuario -->
			<?php if ($this->session->userdata('usuario_tipo') == 2)  : ?>
				<form name="registrosEdit-form" id="registrosEdit-form" method="POST" novalidate>
					<div class="row">
						<input class="form-control d-none " type="text" value="<?php echo $registro->registro_id; ?>" name="registrosEditar-id" id="registrosEditar-id" required>

						<div class="col-md-3">
							<div class="form-group">
								<label for="registrosEdit-fechare">Fecha de registro</label>
								<input type="date" class="form-control isnumero" name="registrosEdit-fechare" value="<?php echo $registro->registro_fecha; ?>" id="registrosEdit-fechare" >
							</div>
						</div>
							
						
						<div class="col-md-9">
								<div class="form-group">
								</div>
						</div>
						
						<div class="col-md-3">
							<div class="form-group">
								<label for="registrosEdit-sexo">Sexo paciente </label>
								<select class="form-control" name="registrosEdit-sexo" id="registrosEdit-sexo">
									<?php if($registro->sexo =='1') : ?> 
										<option value="1">Masculino</option>
										<option value="2">Femenino</option>
									<?php else : ?>
										<option value="2">Femenino</option>
										<option value="1">Masculino</option>
									<?php endif ?>	
								</select>
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="form-group">
								<label for="registrosEdit-tipodocumento">Documento</label>
								<select name="registrosEdit-tipodocumento" class="form-control" id="registrosEdit-tipodocumento" required>
									<!-- <option value="">SELECCIONAR</option> -->
									<?php if ($documentos != '0') : ?>
										<?php foreach ($documentos as $documento) : ?>
											<?php if ($documento->documento_id != '2') : ?>
												<option value="<?php echo $documento->documento_id ?>" data-alfanumerico="<?php echo $documento->documento_sw_alfanumerico; ?>" 
												<?php if($registro->documento_id == $documento->documento_id) { echo "selected";} ?> 
												data-digitmax="<?php echo $documento->documento_tamanio_max; ?>" data-digitmin="<?php echo $documento->documento_tamanio_min; ?>">
												<?php echo $documento->documento_abreviatura; ?></option>
											<?php endif ?>
										<?php endforeach ?>
									<?php endif ?>
								</select>
							</div>
						</div>

						<div class="col-md-5">
							<div class="form-group">
								<label for="registrosEdit-nrodocumento">Número </label>
								<input type="text" class="form-control" name="registrosEdit-nrodocumento"   value="<?php echo $registro->numero_dni; ?>" id="registrosEdit-nrodocumento" placeholder="Dni"  >
							</div>
						
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="registrosEdit-fechanac">Fecha de nacimiento</label>
								<input type="date" class="form-control isnumero" name="registrosEdit-fechanac"  value="<?php echo $registro->fechanac; ?>" id="registrosEdit-fechanac" >
							</div>
						</div>

						<div class="col-md-9 col-sm-12">
							<div class="form-group">
								<label for="registrosEdit-nombre">Nombres y Apellidos</label>
								<input type="text" class="form-control" name="registrosEdit-nombre"  value="<?php echo $registro->nombres; ?>" id="registrosEdit-nombre" placeholder="Nombres completos" required>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="registrosEdit-telefono">Telefono</label>
								<input type="telefono" class="form-control" name="registrosEdit-telefono" value="<?php echo $registro->telefono; ?>"  id="registrosEdit-telefono" maxlength="9" data-parsley-minlength="9" placeholder="Telefono" required>
							</div>
						</div>

						<div class="col-md-8">
							<div class="form-group">
								<label for="registrosEdit-correo">Correo electrónico</label>
								<input type="email" class="form-control" name="registrosEdit-correo" value="<?php echo $registro->correo; ?>"  id="registrosEdit-correo" placeholder="Ingrese su correo electronico" required>
							</div>
						</div>

						<div class="col-md-8 " >
							<div class="form-group">
								<label for="registrosEdit-especialidad">Servicio de destino</label>
								<select class="form-control" name="registrosEdit-especialidad" id="registrosEdit-especialidad">
									<!-- <option value="">Seleccionar</option> -->
									<?php foreach ($especialidades as $especialidad) { ?>
										<option value="<?php echo $especialidad->especialidad_id; ?>"
										<?php if($registro->especialidad_id == $especialidad->especialidad_id) { echo "selected";} ?> 
										><?php echo $especialidad->especialidad_nombre; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="col-md-4">
						
							<div class="form-group">
								<label for="establecimientoEditar-id">ID de establecimiento</label>
								<input type="text" class="form-control" name="establecimientoEditar-id" id="establecimientoEditar-id"  value="<?php echo $registro->establecimiento_id; ?>">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label for="registrosEdit-establecimiento">Nuevo Establecimiento de referencia</label>
								<input type="text" class="form-control" name="registrosEdit-establecimiento" id="registrosEdit-establecimiento"  placeholder="Establecimiento">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="registrosEdit-format">Formato de solicitud  <span> <i class="fas fa-upload"></i></span> </label>
								<input type="file" class="form-control" name="registrosEdit-format" value="<?php echo $registro->formato; ?>" id="registrosEdit-format" >
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="registrosEdit-format">Formato de solicitud <span> <i class="fas fa-download"></i></span></label>
								<?php if($registro->formato != "") :?>
										<a href="<?php echo $registro->formato; ?>" class="form-control" target="_blank">
											<i class="fas fa-download"></i>
											<spann>Descargar Archivo </span>
										</a>
								<?php endif ?>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label for="registrosEdit-observacion">Observaciónes</label>
								<textarea class="form-control" name="registrosEdit-observacion" id="registrosEdit-observacion" 
								cols="5" 
								rows="2"
								tabindex="2"
									>
								<?php 
									echo trim($registro->observacion); 
									?> 
								</textarea>
								
							</div>
						</div>

						<div class="col-md-5 d-none" id="divEstados">
							<div class="form-group">
								<label for="registrosEdit-estado">Estado de Registro</label>
								<select class="form-control" name="registrosEdit-estado" id="registrosEdit-estado">
									<!-- <option value="">Seleccionar</option> -->
									<?php foreach ($estados as $estado) { ?>
										<option value="<?php echo $estado->estado_id; ?>"
										<?php if($registro->estado_id == $estado->estado_id) { echo "selected";} ?> 

										><?php echo
										$estado->nombre_estado; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>

					</div>
				</form>

			<?php  endif ?>

			<!-- Administrador -->
			<?php if ($this->session->userdata('usuario_tipo') == 1)  : ?>
				<form name="registrosEdit-form" id="registrosEdit-form" method="POST" novalidate>
					<div class="row">
						<input class="form-control d-none " type="text" value="<?php echo $registro->registro_id; ?>" name="registrosEditar-id" id="registrosEditar-id" readonly>
						
						<div class="col-md-3">
							<div class="form-group">
								<label for="registrosEdit-fechare">Fecha de registros</label>
								<input type="date" class="form-control isnumero" name="registrosEdit-fechare" value="<?php echo $registro->registro_fecha; ?>" id="registrosEdit-fechare"  readonly>
							</div>
						</div>

						<div class="col-md-9">
								<div class="form-group">
								</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="registrosEdit-sexo">Sexo paciente </label>
								<select class="form-control" name="registrosEdit-sexo" id="registrosEdit-sexo" readonly>
									<?php if($registro->sexo =='1') : ?> 
										<option value="1">Masculino</option>
										<option value="2">Femenino</option>
									<?php else : ?>
										<option value="2">Femenino</option>
										<option value="1">Masculino</option>
									<?php endif ?>	
								</select>
							</div>
						</div>
					
						
						<div class="col-md-4">
							<div class="form-group">
								<label for="registrosEdit-tipodocumento">Documento</label>
								<select name="registrosEdit-tipodocumento" class="form-control" id="registrosEdit-tipodocumento" readonly>
									<!-- <option value="">SELECCIONAR</option> -->
									<?php if ($documentos != '0') : ?>
										<?php foreach ($documentos as $documento) : ?>
											<?php if ($documento->documento_id != '2') : ?>
												<option value="<?php echo $documento->documento_id ?>" data-alfanumerico="<?php echo $documento->documento_sw_alfanumerico; ?>" 
												<?php if($registro->documento_id == $documento->documento_id) { echo "selected";} ?> 
												data-digitmax="<?php echo $documento->documento_tamanio_max; ?>" data-digitmin="<?php echo $documento->documento_tamanio_min; ?>">
												<?php echo $documento->documento_abreviatura; ?></option>
											<?php endif ?>
										<?php endforeach ?>
									<?php endif ?>
								</select>
							</div>
						</div>

						<div class="col-md-5">
							<div class="form-group">
								<label for="registrosEdit-nrodocumento">Número </label>
								<input type="text" class="form-control" name="registrosEdit-nrodocumento"   value="<?php echo $registro->numero_dni; ?>" id="registrosEdit-nrodocumento" placeholder="Dni" readonly >
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="registrosEdit-fechanac">Fecha de nacimiento</label>
								<input type="date" class="form-control isnumero" name="registrosEdit-fechanac"  value="<?php echo $registro->fechanac; ?>" id="registrosEdit-fechanac" readonly>
							</div>
						</div>


						<div class="col-md-9 col-sm-12">
							<div class="form-group">
								<label for="registrosEdit-nombre">Nombres y Apellidos</label>
								<input type="text" class="form-control" name="registrosEdit-nombre"  value="<?php echo $registro->nombres; ?>" id="registrosEdit-nombre" placeholder="Nombres completos" readonly>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="registrosEdit-telefono">Telefono</label>
								<input type="telefono" class="form-control" name="registrosEdit-telefono" value="<?php echo $registro->telefono; ?>"  id="registrosEdit-telefono"  placeholder="Telefono" readonly>
							</div>
						</div>

						<div class="col-md-8">
							<div class="form-group">
								<label for="registrosEdit-correo">Correo electrónico</label>
								<input type="email" class="form-control" name="registrosEdit-correo" value="<?php echo $registro->correo; ?>"  id="registrosEdit-correo" placeholder="Ingrese su correo electronico" readonly>
							</div>
						</div>

						<div class="col-md-8 " >
							<div class="form-group">
								<label for="registrosEdit-especialidad">Servicio de destino</label>
								<select class="form-control" name="registrosEdit-especialidad" id="registrosEdit-especialidad" readonly>
									<option value="">Seleccionar</option>
									<?php foreach ($especialidades as $especialidad) { ?>
										<option value="<?php echo $especialidad->especialidad_id; ?>"
										<?php if($registro->especialidad_id == $especialidad->especialidad_id) { echo "selected";} ?> 
										><?php echo $especialidad->especialidad_nombre; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="col-md-4">
						
							<div class="form-group">
								<label for="establecimientoEditar-id">ID de establecimiento</label>
								<input type="text" class="form-control" name="establecimientoEditar-id" id="establecimientoEditar-id"  value="<?php echo $registro->establecimiento_id; ?>" readonly>
							</div>
						</div>


						<div class="col-md-12">
							<div class="form-group">
								<label for="registrosEdit-establecimiento">Nuevo Establecimiento de referencia</label>
								<input type="text" class="form-control" name="registrosEdit-establecimiento" id="registrosEdit-establecimiento"  placeholder="Establecimiento" readonly>
							</div>
						</div>


						
						<div class="col-md-6">
							<div class="form-group">
								<label for="registrosEdit-format">Formato de solicitud <span> <i class="fas fa-download"></i></span></label>
								<?php if($registro->formato != "") :?>
										<a href="<?php echo $registro->formato; ?>" class="form-control" target="_blank">
											<i class="fas fa-download"></i>
											<spann>Descargar Archivo </span>
										</a>
								<?php endif ?>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label for="registrosEdit-observacion">Observaciónes</label>
								<textarea class="form-control" name="registrosEdit-observacion" id="registrosEdit-observacion" 
								cols="10" rows="2" readonly>
								<?php echo trim($registro->observacion); ?> 
								</textarea>
								
							</div>
						</div>

						<div class="col-md-5 d-none" id="divEstados">
							<div class="form-group">
								<label for="registrosEdit-estado">Estado de Registro</label>
								<select class="form-control" name="registrosEdit-estado" id="registrosEdit-estado">
									<option value="">Seleccionar</option>
									<?php foreach ($estados as $estado) { ?>
										<option value="<?php echo $estado->estado_id; ?>"
										<?php if($registro->estado_id == $estado->estado_id) { echo "selected";} ?> 
										><?php echo $estado->nombre_estado; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>

				

						<div class="col-md-5" id="divEstados">
							<div class="form-group">
								<label for="registrosEdit-estado">Estado de Registro</label>
								<select class="form-control" name="registrosEdit-estado" id="registrosEdit-estado">
									<option value="">Seleccionar</option>
									<?php foreach ($estados as $estado) { ?>
										<option value="<?php echo $estado->estado_id; ?>"
										<?php if ($registro->estado_id == $estado->estado_id) { echo "selected";} ?>
										><?php echo	$estado->nombre_estado; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>

					</div>
				</form>
			<?php  endif ?>

	</div>
	<div class="modal-footer">
			<button type="button" class="btn btn-primary" id="editaRegistro">Editar</button>
			<button type="button" class="btn btn-secondary " data-dismiss="modal" aria-label="Close">Cancelar</button>
	</div>

	<script>
			$("#editaRegistro").click(function(event) {
				var formData = new FormData($("#registrosEdit-form")[0]);
				var form = $("#registrosEdit-form");
				form.parsley().validate();
				if (form.parsley().isValid()) {
					var formSerialize = $('#registrosEdit-form').serialize();
							$.ajax(
							{
								url: site_url + 'panel/registros/editarRegistro', //Usando el controlador
								type: "POST",
								data: formData,
								contentType: false,  
								cache: false,  
								processData:false, 
								dataType: "json",
								success: function(obj) {
									// console.log("esto es la data",obj.dataUpda);
									if (obj.tipo == "1") {
										$("#modal-estado").modal('hide');
										getRegistros.ajax.reload();
										form.trigger("reset");
										validator = form.parsley();
										validator.reset();
										Swal.fire({
											toast: true,
											position: 'bottom-end',
											icon: obj.status,
											title: obj.titulo,
											text: obj.mensaje,
											showConfirmButton: false,
											timer: 2500
										});
									} else {
										Swal.fire({
											toast: true,
											position: 'bottom-end',
											icon: obj.status,
											title: obj.titulo,
											text: obj.mensaje,
											showConfirmButton: false,
											timer: 2500
										});
									}
								}
							});
				}
			});
	</script>
			