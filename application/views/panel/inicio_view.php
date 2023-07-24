<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/dist/";?>css/inicio.css">

<!-- <div class="row"> -->
	<!-- <div class="col-md-12"> -->

	<!-- </div> -->
<!-- </div> -->

<div class="row marco">
	<div class="mx-auto">
		<div class="card marco">
			<!-- <div class="card-body body"> -->
				<!-- <div class="row"> -->
					 <h1 id="wel">TELEINTERCONSULTA</h1>
               		 <!-- <img src="<?php echo base_url()."assets/dist/img/";?>cca.png" class="fondo_inicio"> -->
               		 <img src="<?php echo base_url()."assets/dist/img/";?>lo.gif" class="fondo_inicio">

				<!-- </div> -->
			<!-- </div> -->
		</div>
	</div>
</div>


<div class="modal fade" id="modal-edit" data-backdrop="static" data-keyboard="false" tabindex="-1" 
		role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">MI PERFIL - EDITAR</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="usuarioEdit-form" id="usuarioEdit-form" method="POST" novalidate>
					<div class="row">
						<input class="form-control " type="text" value="0" name="usuarioEdit-id" id="usuarioEdit-id" required>
						<div class="col-md-3">
							<div class="form-group">
								<label for="usuarioEdit-tipo">Tipo usuario</label>
								<select name="usuarioEdit-tipo" class="form-control" id="usuarioEdit-tipo" required>
									<option value="">SELECCIONAR</option>
									<option value="1">Administrador/a</option>
									<option value="2">Usuario/a</option>
								</select>
							</div>
						</div>

						<div class="col-md-9 col-sm-2">
							<div class="form-group">
								<label for="usuarioEdit-nombre">Nombres</label>
								<input type="text" class="form-control" name="usuarioEdit-nombre" id="usuarioEdit-nombre" placeholder="Nombres completos" required>
							</div>
						</div>
												
						<div class="col-md-6">
							<div class="form-group">
								<label for="usuarioEdit-tipodocumento">Documento</label>
								<select name="usuarioEdit-tipodocumento" class="form-control" id="usuarioEdit-tipodocumento" required>
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

						<div class="col-md-6">
							<div class="form-group">
								<label for="usuarioEdit-documento">Numero documento</label>
								<input type="text" class="form-control" name="usuarioEdit-documento" id="usuarioEdit-documento" placeholder="Número de documento" required>
							</div>
						</div>
						
						<div class="col-md-3">
							<div class="form-group">
								<label for="usuarioEdit-telefonomobil">Celular</label>
								<input type="text" class="form-control isnumero" name="usuarioEdit-telefonomobil" id="usuarioEdit-telefonomobil" placeholder="Celular" maxlength="9" data-parsley-minlength="9" required>
							</div>
						</div>

						<div class="col-md-9">
							<div class="form-group">
								<label for="usuarioEdit-direccion">Dirección</label>
								<input type="text" class="form-control" name="usuarioEdit-direccion" id="usuarioEdit-direccion" placeholder="Dirección">
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="usuarioEdit-idEsta">ID de establecimiento</label>
								<input type="text" class="form-control"  name="usuarioEdit-idEsta" id="usuarioEdit-idEsta" value="">
							</div>
						</div>

						<div class="col-md-9">
							<div class="form-group">
								<label for="usuarioEdit-id">Nuevo Establecimiento</label>
								<input type="text" class="form-control" name="" id="valueEditUser" placeholder="Escribir nuevo establecimiento ">
							</div>
						</div>
					
						<div class="col-md-12">
							<div class="form-group">
								<label for="usuarioEdit-correo">Correo electrónico</label>
								<input type="email" class="form-control" name="usuarioEdit-correo" id="usuarioEdit-correo" placeholder="Ejemplo@gmail.com o Ejemplo@outlook.com" required>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label for="usuarioEdit-password">Contraseña</label>
								<input type="text" class="form-control" name="usuarioEdit-password" id="usuarioEdit-password" placeholder="Contraseña" required>
							</div>
						</div>

					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="editUser">Editar</button>
				<button type="button" class="btn btn-secondary " data-dismiss="modal" aria-label="Close">Cancelar</button>
			</div>
		</div>
	</div>
</div>




