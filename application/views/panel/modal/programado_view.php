	<style>
		#azul{
			background-color: #007BFF;
		}
		.titulo{
			color:#ffff;
		}
	</style>

	<?php if ($this->session->userdata('usuario_tipo') == 1)  : ?>
				<div class="modal-header" id="azul">
					<h5 class="modal-title titulo" id="exampleModalLabel">PROGRAMAR HORARIO</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form name="registrosEdit-form" id="registrosEdit-form" enctype="multipart/form-data" method="POST" novalidate>
						<div class="row">
						<input class="form-control d-none " type="text" value="<?php echo $registro->registro_id; ?>" 			name="registrosEditar-id" id="registrosEditar-id" readonly>

							<div class="col-md-6">
								<div class="form-group">
									<label for="registrosEdit-fecha_pro">Fecha</label>
									<input type="date" class="form-control isnumero" name="registrosEdit-fecha_pro" value="<?php echo $registro->fecha_pro;?>" id="registrosEdit-fecha_pro" >
									
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="registrosEdit-hora_pro">Hora</label>
									<input type="time" class="form-control isnumero" name="registrosEdit-hora_pro" id="registrosEdit-hora_pro" value="<?php echo $registro->hora_pro;?>" >
									
									
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="registrosEdit-medico_pro">Médico assignado</label>
									<input type="text" class="form-control" name="registrosEdit-medico_pro" id="registrosEdit-medico_pro" placeholder="" value="<?php echo $registro->medico_pro;?>"  >
									
									
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="registrosEdit-link_pro">Link de reunión</label>
									<input type="text" class="form-control" name="registrosEdit-link_pro" id="registrosEdit-link_pro" placeholder="" value="<?php echo $registro->link_pro;?>" >
									
									
								</div>
							</div>


							<div class="col-md-12 d-none" >
								<div class="form-group">
									<label for="registro-regis_observacion_resp">Observación</label>
									<textarea class="form-control" name="regis_observacion_resp" id="regis_observacion_resp" cols="10" rows="5">
										<?php echo $registro->observacion_resp;?>
									</textarea>
								</div>
							</div>

							<div class="col-md-3  d-none">
											<div class="form-group">
												<label for="registrosEdit-fecha_res">Fecha de respuesta</label>
												<input type="date" class="form-control isnumero" name="registrosEdit-fecha_res" value="<?php echo $registro->fecha_res; ?>" id="registrosEdit-fecha_res"  >
											</div>
										</div>

										<div class="col-md-12 d-none">
											<div class="form-group">
												<label for="registrosEdit-resp">Formato de respuesta  <span> <i class="fas fa-upload"></i></span> </label>
												<input type="file" class="form-control" name="registrosEdit-resp" value="<?php echo $registro->formato_res; ?>" id="registrosEdit-resp" >
											</div>
										</div>


										<div class="col-md-12 d-none">
											<div class="form-group">
												<label for="registrosEdit-format">Formato de solicitud <span> <i class="fas fa-download"></i></span></label>
												<?php if($registro->formato_res != "") :?>
														<a href="<?php echo $registro->formato_res; ?>" class="form-control" target="_blank">
															<i class="fas fa-download"></i>
															<spann>Descargar Archivo </span>
														</a>
												<?php endif ?>
											</div>
										</div>

										<div class="col-md-3 d-none">
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
							
							

									<div class="col-md-3 d-none">
										<div class="form-group">
											<label for="registrosEdit-fechare">Fecha de registros</label>
											<input type="date" class="form-control isnumero" name="registrosEdit-fechare" value="<?php echo $registro->registro_fecha; ?>" id="registrosEdit-fechare"  >
										</div>
									</div>
									
									<div class="col-md-4 d-none ">
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

									<div class="col-md-5 d-none ">
										<div class="form-group">
											<label for="registrosEdit-nrodocumento">Número </label>
											<input type="text" class="form-control" name="registrosEdit-nrodocumento"   value="<?php echo $registro->numero_dni; ?>" id="registrosEdit-nrodocumento" placeholder="Dni" readonly >
										</div>
									
									</div>
							
									<div class="col-md-3 d-none ">
										<div class="form-group">
											<label for="registrosEdit-fechanac">Fecha de nacimiento</label>
											<input type="date" class="form-control isnumero" name="registrosEdit-fechanac"  value="<?php echo $registro->fechanac; ?>" id="registrosEdit-fechanac" readonly>
										</div>
									</div>


									<div class="col-md-9 col-sm-12 d-none ">
										<div class="form-group">
											<label for="registrosEdit-nombre">Nombres y Apellidos</label>
											<input type="text" class="form-control" name="registrosEdit-nombre"  value="<?php echo $registro->nombres; ?>" id="registrosEdit-nombre" placeholder="Nombres completos" readonly>
										</div>
									</div>

									<div class="col-md-4 d-none ">
										<div class="form-group">
											<label for="registrosEdit-telefono">Telefono</label>
											<input type="telefono" class="form-control" name="registrosEdit-telefono" value="<?php echo $registro->telefono; ?>"  id="registrosEdit-telefono" placeholder="Telefono" readonly>
										</div>
									</div>

									<div class="col-md-8 d-none ">
										<div class="form-group">
											<label for="registrosEdit-correo">Correo electrónico</label>
											<input type="email" class="form-control" name="registrosEdit-correo" value="<?php echo $registro->correo; ?>"  id="registrosEdit-correo" placeholder="Ingrese su correo electronico" readonly>
										</div>
									</div>

									<div class="col-md-8  d-none " >
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

									<div class="col-md-4 d-none ">
										<div class="form-group">
											<label for="establecimientoEditar-id">ID de establecimiento</label>
											<input type="text" class="form-control" name="establecimientoEditar-id" id="establecimientoEditar-id"  value="<?php echo $registro->establecimiento_id; ?>" readonly>
										</div>
									</div>


									<div class="col-md-12 d-none ">
										<div class="form-group">
											<label for="registrosEdit-establecimiento">Nuevo Establecimiento de referencia</label>
											<input type="text" class="form-control" name="registrosEdit-establecimiento" id="registrosEdit-establecimiento"  placeholder="Establecimiento" readonly>
										</div>
									</div>


									<div class="col-md-12 d-none ">
										<div class="form-group">
											<label for="registrosEdit--">Formato de solicitud</label>
											<input type="file" class="form-control" name="registrosEdit--" 
											value="<?php echo $registro->formato; ?>" id="registrosEdit--"  readonly>
										</div>
									</div>

									<div class="col-md-12 d-none">
										<div class="form-group">
											<label for="registrosEdit-observacion">Observaciónes</label>
											<textarea class="form-control" name="registrosEdit-observacion" id="registrosEdit-observacion" 
											cols="10" rows="2" readonly>
											<?php echo $registro->observacion; ?> 
											</textarea>
											
										</div>
									</div>

									<div class="col-md-5 " id="divEstados">
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

									
						</div>

					</form>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="editaRegistro">Asignar</button>
					<button type="button" class="btn btn-secondary " data-dismiss="modal" aria-label="Close">Cancelar</button>
				</div>
	<?php endif ?>

	<?php if ($this->session->userdata('usuario_tipo') == 2)  : ?>
			<div class="modal-header" id="azul">
				<h5 class="modal-title titulo" id="exampleModalLabel">PROGRAMADO</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="registrosEdit-form" id="registrosEdit-form" enctype="multipart/form-data" method="POST" novalidate>
						<div class="row">
							<input class="form-control d-none " type="text" value="<?php echo $registro->registro_id; ?>" 			name="registrosEditar-id" id="registrosEditar-id" readonly>

										<div class="col-md-6">
											<div class="form-group">
												<label for="registrosEdit-fecha_pro">Fecha</label>
												<input type="date" class="form-control isnumero" name="registrosEdit-fecha_pro" value="<?php echo $registro->fecha_pro;?>" id="registrosEdit-fecha_pro"  readonly>
												
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="registrosEdit-hora_pro">Hora</label>
												<input type="time" class="form-control isnumero" name="registrosEdit-hora_pro" id="registrosEdit-hora_pro" value="<?php echo $registro->hora_pro;?>" readonly >
												
												
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label for="registrosEdit-medico_pro">Médico assignado</label>
												<input type="text" class="form-control" name="registrosEdit-medico_pro" id="registrosEdit-medico_pro" placeholder="" value="<?php echo $registro->medico_pro;?>"  readonly >
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="registrosEdit-link_pro">Link de reunión</label>
												<!-- <input type="text" class="form-control" name="registrosEdit-link_pro" id="registrosEdit-link_pro" placeholder="" value="<?php echo $registro->link_pro;?>" readonly > -->
												<a class="form-control" href="<?php echo $registro->link_pro;?>" target="_blank" readonly> <?php echo $registro->link_pro;?> <a/>
												
											</div>
										</div>


										<div class="col-md-12 d-none" >
											<div class="form-group">
												<label for="registro-regis_observacion_resp">Observación</label>
												<textarea class="form-control" name="regis_observacion_resp" id="regis_observacion_resp" cols="10" rows="5">
													<?php echo $registro->observacion_resp;?>
												</textarea>
											</div>
										</div>

												
										<div class="col-md-3 d-none">
											<div class="form-group">
												<label for="registrosEdit-fecha_res">Fecha de respuesta</label>
												<input type="date" class="form-control isnumero" name="registrosEdit-fecha_res" value="<?php echo $registro->fecha_res; ?>" id="registrosEdit-fecha_res"  >
											</div>
										</div>

										<div class="col-md-12 d-none">
											<div class="form-group">
												<label for="registrosEdit-resp">Formato de respuesta  <span> <i class="fas fa-upload"></i></span> </label>
												<input type="file" class="form-control" name="registrosEdit-resp" value="<?php echo $registro->formato_res; ?>" id="registrosEdit-resp" >
											</div>
										</div>


										<div class="col-md-12 d-none">
											<div class="form-group">
												<label for="registrosEdit-format">Formato de solicitud <span> <i class="fas fa-download"></i></span></label>
												<?php if($registro->formato_res != "") :?>
														<a href="<?php echo $registro->formato_res; ?>" class="form-control" target="_blank">
															<i class="fas fa-download"></i>
															<spann>Descargar Archivo </span>
														</a>
												<?php endif ?>
											</div>
										</div>

										<div class="col-md-3 d-none">
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
								

										<div class="col-md-3 d-none">
											<div class="form-group">
												<label for="registrosEdit-fechare">Fecha de registros</label>
												<input type="date" class="form-control isnumero" name="registrosEdit-fechare" value="<?php echo $registro->registro_fecha; ?>" id="registrosEdit-fechare"  >
											</div>
										</div>
										
										<div class="col-md-4 d-none ">
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

										<div class="col-md-5 d-none ">
											<div class="form-group">
												<label for="registrosEdit-nrodocumento">Número </label>
												<input type="text" class="form-control" name="registrosEdit-nrodocumento"   value="<?php echo $registro->numero_dni; ?>" id="registrosEdit-nrodocumento" placeholder="Dni" readonly >
											</div>
										
										</div>
								
										<div class="col-md-3 d-none ">
											<div class="form-group">
												<label for="registrosEdit-fechanac">Fecha de nacimiento</label>
												<input type="date" class="form-control isnumero" name="registrosEdit-fechanac"  value="<?php echo $registro->fechanac; ?>" id="registrosEdit-fechanac" readonly>
											</div>
										</div>


										<div class="col-md-9 col-sm-12 d-none ">
											<div class="form-group">
												<label for="registrosEdit-nombre">Nombres y Apellidos</label>
												<input type="text" class="form-control" name="registrosEdit-nombre"  value="<?php echo $registro->nombres; ?>" id="registrosEdit-nombre" placeholder="Nombres completos" readonly>
											</div>
										</div>

										<div class="col-md-4 d-none ">
											<div class="form-group">
												<label for="registrosEdit-telefono">Telefono</label>
												<input type="telefono" class="form-control" name="registrosEdit-telefono" value="<?php echo $registro->telefono; ?>"  id="registrosEdit-telefono" placeholder="Telefono" readonly>
											</div>
										</div>

										<div class="col-md-8 d-none ">
											<div class="form-group">
												<label for="registrosEdit-correo">Correo electrónico</label>
												<input type="email" class="form-control" name="registrosEdit-correo" value="<?php echo $registro->correo; ?>"  id="registrosEdit-correo" placeholder="Ingrese su correo electronico" readonly>
											</div>
										</div>

										<div class="col-md-8  d-none " >
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

										<div class="col-md-4 d-none ">
											<div class="form-group">
												<label for="establecimientoEditar-id">ID de establecimiento</label>
												<input type="text" class="form-control" name="establecimientoEditar-id" id="establecimientoEditar-id"  value="<?php echo $registro->establecimiento_id; ?>" readonly>
											</div>
										</div>


										<div class="col-md-12 d-none ">
											<div class="form-group">
												<label for="registrosEdit-establecimiento">Nuevo Establecimiento de referencia</label>
												<input type="text" class="form-control" name="registrosEdit-establecimiento" id="registrosEdit-establecimiento"  placeholder="Establecimiento" readonly>
											</div>
										</div>


										<div class="col-md-12 d-none ">
											<div class="form-group">
												<label for="registrosEdit--">Formato de solicitud</label>
												<input type="file" class="form-control" name="registrosEdit--" 
												value="<?php echo $registro->formato; ?>" id="registrosEdit--"  readonly>
											</div>
										</div>

										<div class="col-md-12 d-none">
											<div class="form-group">
												<label for="registrosEdit-observacion">Observaciónes</label>
												<textarea class="form-control" name="registrosEdit-observacion" id="registrosEdit-observacion" 
												cols="10" rows="2" readonly>
												<?php echo $registro->observacion; ?> 
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

								

										<div class="col-md-5 d-none" id="divEstados">
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
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary " data-dismiss="modal" aria-label="Close">OK</button>
			</div>
	<?php endif ?>

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