<style>
	.fc-past {
		background-color: gainsboro;
		color: black;
		border-color: black;
	}
	.table tbody td {
		vertical-align: middle;
		text-align: left;
		/* padding:0.4rem; */
		padding-left: 0;
    	padding-right: 0;
	}
	
	.fc th,
	.fc td {

		border-color: lightgray;
	}

	option:enabled {
		background: #ffff;
		color: grey;
	}
</style>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body body">

				<div class="row ">
					<?php if ($this->session->userdata('usuario_tipo') == 2)  : ?>
						<div class="col-md-3 text-left">
							<button class="btn btn-primary btn-round" id="newRegistro">
								NUEVA SOLICITUD
							</button>
						</div>
					<?php  endif ?>

					<div class="col-md-2 col-sm-4">
						<div class="form-group">
							<label for="min">Fecha inicio:</label>
							<i class="ni ni-calendar-grid-58 text-orange"></i>
							<input type="text" id="min" name="min" class="form-control daterange">
							
						</div>
					</div>
					<div class="col-md-2 col-sm-4">
						<div class="form-group">
							<label for="max">Fecha fin:</label>
							<i class="ni ni-calendar-grid-58 text-orange"></i>
							<input type="text" id="max" name="max" class="form-control daterange">
							
						</div>
					</div>
					
					<div class="col-md-2 col-sm-3">
						<div class="form-group">
							<label for="estado">Estado :</label>
							<i class="ni ni-bold-down text-orange"></i>
							<select id="estado" name="estado" class="form-control">
								<option value="">SELECCIONAR</option>
								<option value="PENDIENTE">PENDIENTE</option>
								<option value="ANULADO">ANULADO</option>
								<option value="OBSERVADO">OBSERVADO</option>
								<option value="ATENDIDO">ATENDIDO</option>
								<option value="ROGRAMADO">PROGRAMADO</option>
							</select>
						</div>
					</div>
				</div>
				

				<div class="row">
					
					<div class="col-md-12">
						<div class="table-responsive">

							<table id="tablaRegistros" class="table table-bordered table-hover table-striped display nowrap collapse;" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th scope="col"></th>
										<th scope="col">N° EXPO.</th>
										<th scope="col">Fecha</th>
										<th scope="col">Establecimiento Origen</th>
										<th scope="col">Servicio</th>
										<th scope="col">Paciente</th>
										<!-- <th scope="col">Dni</th> -->
										<th scope="col">Estado</th>

									</tr>
								</thead>
								<tbody id="bodyregistross">
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modal-add" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		
	<div class="modal-content" id="idModalContent">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">REGISTRO DE SOLICITUD - TELEINTERCONSULTA</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					
					<form name="registro-form" id="registroAdd-form" enctype="multipart/form-data" novalidate>
						<div class="row">

							<div class="col-md-3">
								<div class="form-group">
									<label for="registros-fechare">Fecha de registro</label>
									<input type="date" class="form-control isnumero" name="registros-fechare" id="registros-fechare" >
								</div>
							</div>
							
							<div class="col-md-9">
								<div class="form-group">
								</div>
							</div>
							
							<div class="col-md-3">
								<div class="form-group">
									<label for="registros-sexo">Sexo paciente </label>
									<select class="form-control" name="registros-sexo" id="registros-sexo">
										<option value="">Seleccionar</option>
										<option value="1">Masculino</option>
										<option value="2">Femenino</option>								
									</select>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="registros-tipodocumento">Documento</label>
									<select name="registros-tipodocumento" class="form-control" id="registros-tipodocumento" required>
										<option value="">SELECCIONAR</option>
										<?php if ($documentos != '0') : ?>
											<?php foreach ($documentos as $documento) : ?>
												<?php if ($documento->documento_id != '2') : ?>
													<option value="<?php echo $documento->documento_id ?>" data-alfanumerico="<?php echo $documento->documento_sw_alfanumerico; ?>" data-digitmax="<?php echo $documento->documento_tamanio_max; ?>" data-digitmin="<?php echo $documento->documento_tamanio_min; ?>"><?php echo $documento->documento_abreviatura; ?></option>
												<?php endif ?>
											<?php endforeach ?>
										<?php endif ?>
									</select>
								</div>
							</div>

							<div class="col-md-5">
								<div class="form-group">
									<label for="registros-documento">Numero de documento</label>
									<input type="text" class="form-control" name="registros-documento" id="registros-documento"  autofocus
									onchange="tamaño()" placeholder="Número de documento" disabled required>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="registros-fechanac">Fecha de nacimiento</label>
									<input type="date" class="form-control isnumero" name="registros-fechanac" id="registros-fechanac" >
								</div>
							</div>

							<div class="col-md-9 col-sm-12">
								<div class="form-group">
									<label for="registros-nombre">Nombres y Apellidos</label>
									<input type="text" class="form-control" name="registros-nombre" id="registros-nombre" placeholder="Nombres completos" required>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="registros-telefono">Telefono</label>
									<input type="phone" class="form-control" name="registros-telefono" id="registros-telefono" maxlength="9" data-parsley-minlength="9" placeholder="Telefono" required>
								</div>
							</div>

							<div class="col-md-8">
								<div class="form-group">
									<label for="registros-correo">Correo electrónico</label>
									<input type="email" class="form-control" name="registros-correo" id="registros-correo" placeholder="Ingrese su correo electronico" required>
								</div>
							</div>

							<div class="col-md-5 " id="divEspecialidad">
								<div class="form-group">
									<label for="registros-especialidad">Servicio de destino</label>
									<select class="form-control" name="registros-especialidad" id="registros-especialidad">
										<option value="">Seleccionar</option>
										<?php foreach ($especialidades as $especialidad) { ?>
											<option value="<?php echo $especialidad->especialidad_id; ?>"><?php echo $especialidad->especialidad_nombre; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="col-md-7">
								<div class="form-group">
									<label for="registros-establecimiento">Establecimiento de referencia</label>
									<input type="text" class="form-control" name="registros-establecimiento" id="registros-establecimiento" placeholder="Establecimiento">
									<input type="hidden" class="form-control"  name="establecimiento-id" id="establecimiento-id" value="0">

								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="registros-formato">Formato de solicitud</label>
									<input type="file" class="form-control" name="registros-formato" id="registros-formato" >
								</div>
							</div>


							<div class="col-md-12">
								<div class="form-group">
									<label for="registros-observa">Observación</label>
									<textarea class="form-control" name="registros-observa" id="registros-observa" placeholder="" cols="10" rows="2"></textarea>
								</div>
							</div>

						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary"  id="addregistro">Agregar</button>
					<button type="button" class="btn btn-secondary " data-dismiss="modal" aria-label="Close">Cancelar</button>
				</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modal-estado" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		
		<div class="modal-content" id="estadoModalContent">
				
		</div>
	</div>
</div>
