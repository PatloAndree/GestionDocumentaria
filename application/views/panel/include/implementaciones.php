<script>
	function filePreview(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#previewImg').html('<img src="' + e.target.result + '" width="100" height="100"/>');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#image_file").change(function() {
		filePreview(this);
	});

	function timestrToSec(timestr) {
		var parts = timestr.split(":");
		return (parts[0] * 3600) +
			(parts[1] * 60) +
			(+parts[2]);
	}

	function pad(num) {
		if (num < 10) {
			return "0" + num;
		} else {
			return "" + num;
		}
	}

	function formatTime(seconds) {
		return [pad(Math.floor(seconds / 3600)),
			pad(Math.floor(seconds / 60) % 60),
			pad(seconds % 60),
		].join(":");
	}
	// BEGIN REGISTRAR USUARIO
	<?php if ($current_controller == "registro_usuario") : ?>
			$(document).ready(function(){
				$(".isnumero").numeric({
					decimal: false,
					negative: false
				});

				$("#estable").autocomplete({
						maxShowItems: 3,
								// autoFocus: true,
						source:function(request,response){
								$.ajax({
										url: site_url + 'panel/registro_usuario/estableList',
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

	<?php endif ?>
	// END REGISTRAR USUARIO

	// BEGIN PERFIL
	<?php if ($current_controller == "perfil") : ?>
			$(document).ready(function()
			{
					$(".isnumero").numeric({
						decimal: false,
						negative: false
					});

					$("#valueEditUser").autocomplete({
					maxShowItems: 3,
					source:function(request,response){
						$.ajax({
									url: site_url + 'panel/perfil/estableList',
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
							$('#valueEditUser').val(ui.item.label);
							$('#usuarioEdit-idEsta').val(ui.item.value);
									return false;
						}
					});
					// alert("holasdad");

					$.ajax({
							url: site_url + 'panel/perfil/getUsuario',
							type: "POST",
							data: [],
							dataType: "json",
							success: function(obj) {
								$("#usuarioEdit-id").val(obj.usuario.id);
								$("#usuarioEdit-nombre").val(obj.usuario.nombres);
								$("#usuarioEdit-tipodocumento").val(obj.usuario.documentoid);
								$("#usuarioEdit-documento").val(obj.usuario.numerodocumento);
								$("#usuarioEdit-telefonomobil").val(obj.usuario.telefonomobil);
								$("#usuarioEdit-direccion").val(obj.usuario.direccion);
								$("#usuarioEdit-correo").val(obj.usuario.correo);
								$("#usuarioEdit-password").val(obj.usuario.password);
								$("#usuarioEdit-idEsta").val(obj.usuario.establecimiento);
								$("#usuarioEdit-tipo").val(obj.usuario.tipouser);
							}
					}); 
			});

			$("#editUsuario").click(function(event) {
				var form = $("#usuarioEdit-form");
				form.parsley().validate();
				if (form.parsley().isValid()) {
					var formSerialize = $('#usuarioEdit-form').serialize();
					$.ajax({
						url: site_url + 'panel/perfil/editarUsuario', //Usando el controlador
						type: "POST",
						data: formSerialize,
						dataType: "json",
						success: function(obj) {
							if (obj.tipo == "1") {
								// $("#modal-edit").modal('hide');
								// getUsuarios.ajax.reload();
								// form.trigger("reset");
								// validator = form.parsley();
								window.location.reload();
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

		

	<?php endif ?>
// END PERFIL

// BEGIN ---------------------- USUARIOS --------------------------
	<?php if ($current_controller == "usuarios") : ?>
		$(document).ready(function() {
			$(".isnumero").numeric({
				decimal: false,
				negative: false
			});
			// $("#valueUser" ).autocomplete( "option", "appendTo", ".eventInsForm" );
			$("#valueUser").autocomplete({
				maxShowItems: 3,
				source:function(request,response){
					$.ajax({
								url: site_url + 'panel/usuarios/estableList',
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
						$('#valueUser').val(ui.item.label);
						$('#usuario-id').val(ui.item.value);
								return false;
					}
			});

			$("#valueEditUser").autocomplete({
				maxShowItems: 3,
				source:function(request,response){
					$.ajax({
								url: site_url + 'panel/usuarios/estableList',
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
						$('#valueEditUser').val(ui.item.label);
						$('#usuarioEdit-idEsta').val(ui.item.value);
								return false;
					}
			});
				
		});

		var getUsuarios = $('#tablaUsuarios').DataTable({
			// "responsive": true,        
			// "destroy": true,
			// "processing": true,
			// "order": [2, 'asc'],
			"responsive": true,
			"lengthChange": true,
			"destroy": true,
			"pageLength": 25,
			"info": true,
			"processing": true,
			// "dom": 'Bfrtip'
            // "buttons": [ 
			// 	// 'excelHtml5',	'pdfHtml5'
			// 	{   
			// 	extend: 'excelHtml5',
            //     // footer: true,
            //     title: 'Archivo',
            //     filename: 'Archivo_Exportado',
            //     //Aquí es donde generas el botón personalizado
            //     text: '<span class="badge badge-success tama">Excel <i class="fas fa-file-excel "></i></span>'
            // },
            //Botón para PDF
            // {
            //     extend: 'pdfHtml5',
            //     download: 'open',
            //     // footer: true,
            //     title: 'Reporte de usuarios',
            //     filename: 'Reporte de usuarios',
            //     text: '<span class="badge  badge-danger tama">PDF <i class="fas fa-file-pdf "></i></span>',
			// 	// orientation: 'landscape',
			// 	// pageSize: 'LEGAL'
			// 	exportOptions: {
            //         columns: [0, ':visible']
            //     }
            // }, 
			
			// ],
			
			"columnDefs": [{
					"responsivePriority": 1,
					"targets": 0
				},
				{
					"responsivePriority": 2,
					"targets": -1
				}
			],
			"ajax": {
				"url": site_url + "panel/usuarios/getUsuarios",
				"type": "POST",
				"dataSrc": "",
				"datatype": "json"
			},
			"columns": [
				{
					"data": "usuario_nombres"
				},
				{
					"data": "usuario_tipo"
				},
				{
					"data": "documento_numero"
				},
				{
					"data": "nombre_establecimiento"
				},				
				{
					"data": "usuario_celular"
				},
				{
					"data": "usuario_correo"
				},
				{
					"data": "sala_acciones"
				},
			],
		
		});

		$("#usuario-tipo").change(function() {
			if ($(this).val() == '1') {
				$("#divEspecialidad").removeClass('d-none');
				$("#usuario-especialidad").prop('required', true);
			} else {
				$("#divEspecialidad").addClass('d-none');
				$("#usuario-especialidad").prop('required', false);
			}
		});
	
		$("#tablaUsuarios").on('click', '.editar', function(event) {
			var form = $("#usuarioEdit-form");
			form.trigger("reset");
			validator = form.parsley();
			validator.reset();
			usuarioid = $(this).data('usuarioid');
			$.ajax({
				url: site_url + 'panel/usuarios/getUsuario',
				type: 'POST',
				data: {
					usuarioid: usuarioid
				},
				dataType: "json",
				success: function(obj) {
					if (obj.sw_error == "0") {
						console.log(obj.usuario);
						$("#usuarioEdit-id").val(obj.usuario.id);
						$("#usuarioEdit-nombre").val(obj.usuario.nombres);
						$("#usuarioEdit-tipodocumento").val(obj.usuario.documentoid);
						$("#usuarioEdit-documento").val(obj.usuario.numerodocumento);
						$("#usuarioEdit-telefonomobil").val(obj.usuario.telefonomobil);
						$("#usuarioEdit-direccion").val(obj.usuario.direccion);
						$("#usuarioEdit-correo").val(obj.usuario.correo);
						$("#usuarioEdit-password").val(obj.usuario.password);
						$("#usuarioEdit-idEsta").val(obj.usuario.establecimiento);
						$("#usuarioEdit-tipo").val(obj.usuario.tipouser);
						// if (obj.usuario.tipo == 1) {
						// 	$("#divEspecialidadEditar").removeClass('d-none');
						// 	$("#usuarioEdit-especialidad").val(obj.usuario.especialidad);	
						// } else {
						// 	$("#divEspecialidadEditar").addClass('d-none');
						// 	$("#usuarioEdit-especialidad").val("");
						// }
						validarDocumento();
						$("#modal-edit").modal("show");
					} else {
						Swal.fire({
							toast: true,
							position: 'bottom-end',
							icon: obj.tipo,
							title: obj.titulo,
							text: obj.mensaje,
							showConfirmButton: false,
							timer: 2500
						});
					}
				}
			});
		});

		$("#tablaUsuarios").on('click', '.eliminar', function(event) {
			var id = $(this).data("usuarioid");
			Swal.fire({
				title: 'Esta seguro?',
				text: "Si elimina al usuario,perdera todo acceso a la plataforma.!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si, eliminalo!',
				cancelButtonText: 'Cancelar'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: site_url + 'panel/usuarios/eliminar/' + id,
						type: 'POST',
						data: [],
						dataType: "json",
						success: function(obj) {
							if (obj.tipo == "1") {
								getUsuarios.ajax.reload();
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
									showConfirmButton: false
								});
							}
						}
					});
				}
			});
		});

		$("#addusuario").click(function(event) {
			var form = $("#usuario-form");
			form.parsley().validate();
			if (form.parsley().isValid()) {
				var formSerialize = $('#usuario-form').serialize();
				$.ajax({
					url: site_url + 'panel/usuarios/addUsuario', //Usando el controlador
					type: "POST",
					data: formSerialize,
					dataType: "json",
					success: function(obj) {
						if (obj.tipo == "1") {
							$("#modal-add").modal('hide');
							$("#addusuario").text("Agregar");
							getUsuarios.ajax.reload();
							form.trigger("reset");
							validator = form.parsley();
							validator.reset();
							$("#newUser").prop('disabled', true);
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
								showConfirmButton: false
							});
						}
					}
				});
			}
		});

		$("#editUsuario").click(function(event) {

			var form = $("#usuarioEdit-form");
			form.parsley().validate();
			if (form.parsley().isValid()) {
				var formSerialize = $('#usuarioEdit-form').serialize();
				$.ajax({
					url: site_url + 'panel/usuarios/editarUsuario', //Usando el controlador
					type: "POST",
					data: formSerialize,
					dataType: "json",
					success: function(obj) {
						if (obj.tipo == "1") {
							$("#modal-edit").modal('hide');
							getUsuarios.ajax.reload();
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

		$("#newUser").click(function() {

			$(this).prop('disabled', true);
			$("#modal-add").modal('show');
		});

		$("#modal-add").on('hidden.bs.modal', function() {
			var form = $("#usuario-form");
			form.trigger("reset");
			validator = form.parsley();
			validator.reset();
			$("#newUser").prop('disabled', false);
		});

		function isnumeric() {
			$('#usuario-documento').removeNumeric();
			$(".isnumero").numeric({
				decimal: false,
				negative: false
			});
		}

		function isnumericEdit() {

			$('#usuarioEdit-documento').removeNumeric();

			$(".isnumero").numeric({
				decimal: false,
				negative: false
			});

		}

		$("#usuario-tipodocumento").change(function() {
			if ($(this).val() != "") {
				$('#usuario-documento').prop("disabled", false);
				var numero = $('#usuario-documento').val();
				var selected = $(this).find('option:selected');
				var maxDigitos = selected.data('digitmax');

				$('#usuario-documento').attr("maxlength", maxDigitos);
				$('#usuario-documento').attr('data-parsley-minlength', maxDigitos);

				if (numero.length > maxDigitos) {
					var cortar = numero.length - maxDigitos;
					var numero2 = numero.substring(0, numero.length - cortar);
					$('#usuario-documento').val(numero2);
				}
				swAlfanumerico = $("#usuario-tipodocumento option:selected").data('alfanumerico');
				if (swAlfanumerico == '0') {
					$("#usuario-documento").addClass('isnumero');
					$('#usuario-documento').removeAttr("data-parsley-type");
					$('#usuario-documento').attr("data-parsley-type", "number");
					isnumeric();
				} else if (swAlfanumerico == '1') {
					$("#usuario-documento").removeClass('isnumero');
					$('#usuario-documento').removeAttr("data-parsley-type");
					$('#usuario-documento').attr("data-parsley-type", "alphanum");
					isnumeric();
				}
			} else {
				$('#usuario-documento').prop("disabled", true);
			}


		});

		$("#usuarioEdit-tipodocumento").change(function() {
			validarDocumento();
		});

		function validarDocumento() {
			var numero = $('#usuarioEdit-documento').val();
			var selected = $("#usuarioEdit-tipodocumento").find('option:selected');
			var maxDigitos = selected.data('digitmax');

			$('#usuarioEdit-documento').attr("maxlength", maxDigitos);
			$('#usuarioEdit-documento').attr('data-parsley-minlength', maxDigitos);

			if (numero.length > maxDigitos) {
				var cortar = numero.length - maxDigitos;
				var numero2 = numero.substring(0, numero.length - cortar);
				$('#usuarioEdit-documento').val(numero2);
			}
			swAlfanumerico = $("#usuarioEdit-tipodocumento option:selected").data('alfanumerico');
			if (swAlfanumerico == '0') {
				$("#usuarioEdit-documento").addClass('isnumero');
				$('#usuarioEdit-documento').removeAttr("data-parsley-type");
				$('#usuarioEdit-documento').attr("data-parsley-type", "number");
				isnumericEdit();
			} else if (swAlfanumerico == '1') {
				$("#usuarioEdit-documento").removeClass('isnumero');
				$('#usuarioEdit-documento').removeAttr("data-parsley-type");
				$('#usuarioEdit-documento').attr("data-parsley-type", "alphanum");
				isnumericEdit();
			}
		}

	<?php endif ?>
// END ------------------------ USUARIOS --------------------------

// BEGIN------------------------REGISTROS-------------------------- 
	<?php if ($current_controller == "registros") : ?>	
		var minDate, maxDate;

		$(document).ready(function() {
			
			minDate = new DateTime($('#min'), {
				format: 'YYYY-MM-DD'
			});
			maxDate = new DateTime($('#max'), {
				format: 'YYYY-MM-DD'
			});

			$('#min, #max',).on('change', function () {
				getRegistros.draw();

			});
			$('#estado').on('change', function(){
				getRegistros.search(this.value).draw();   
			});

			$("#registros-establecimiento").autocomplete({
				maxShowItems: 3,
				source:function(request,response){
					$.ajax({
								url: site_url + 'panel/registros/estableList',
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
						$('#registros-establecimiento').val(ui.item.label);
						$('#establecimiento-id').val(ui.item.value);
								return false;
					}
			});

			$.fn.dataTable.ext.search.push(
			function( settings, data, dataIndex ) {
				var min = minDate.val();
				var max = maxDate.val();
				var date = new Date( data[2] );
		
				if (
					( min === null && max === null ) ||
					( min === null && date <= max ) ||
					( min <= date   && max === null ) ||
					( min <= date   && date <= max )
				) {
					return true;
				}
				return false;
			}
			);
			$("#registrosEdit-establecimiento").autocomplete({
				maxShowItems: 3,
				source:function(request,response){
					$.ajax({
								url: site_url + 'panel/registros/estableList',
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
						$('#registrosEdit-establecimiento').val(ui.item.label);
						$('#establecimientoEditar-id').val(ui.item.value);
								return false;
					}
			});
			
		});

		

		var getRegistros = $('#tablaRegistros').removeAttr('width').DataTable({
			// "responsive": true,
			// "bJQueryUI": true,
			// "bAutoWidth": true,
			// "scrollY": "300px",
			// "scrollX":  true,
        	// "scrollCollapse": true,
			// "columnDefs": [
				
			// 	{
			// 		// "widths": 1,'20%',
			// 		"responsivePriority": 3,
			// 		"targets": -1
			// 	}
			// ],
			"columnDefs": [{
					"responsivePriority": 1,
					"targets": 0
				},
				{
					"responsivePriority": 3,
					"targets": 1
				},
				// {
				// 	"responsivePriority": 4,
				// 	"targets": -1
				// }
			],
			// "fixedColumns": true,
			"destroy": true,
			"bLengthChange": true,
			"pageLength":50,
			// dom: 'lrtip',
			"processing": true,
			"sInfo": true,
			"oLanguage": {
			// "sSearch": "Quick Search:"
			"sSearchPlaceholder": "Nombres,Servicios,etc...",
			},
			"ajax": {
				"url": site_url + "panel/registros/getRegistros",
				"type": "POST",
				"dataSrc": "",
				"datatype": "json"
			},
			"columns": [
			
				{
					"data": "acciones",
					
				},
				{
					"data": "registro_id"
				},
				{
					"data": "registro_fecha"
				},
				{
					"data": "establecimiento_nombre"
				},
				{
					"data": "especialidad_nombre"
				},
				{
					"data": "nombres"
				},
				// {
				// 	"data": "dni_numero"
				// },
				
				{
					"data": "estado_nombre"
				},
				
					
			],
			
		});

		var selectedValue=$("#estado").val();    
		getRegistros.search(selectedValue).draw();

		//REGISTROS MODAL
		$("#addregistro").click(function(event) {
		
			var formData = new FormData($("#registroAdd-form")[0]);
		
			var form = $("#registroAdd-form");
			form.parsley().validate();
			if (form.parsley().isValid()) {
				// var formSerialize = $('#registroAdd-form').serialize();
				$.ajax({
					url: site_url + 'panel/registros/addRegistro', //Usando el controlador
					type: "POST",
					data: formData,
					contentType: false,  
                    cache: false,  
                    processData:false, 
					dataType: "json",
					success: function(obj) {
						if (obj.tipo == "1") {
							$("#modal-add").modal('hide');
							$("#addregistro").text("Añadir");
							getRegistros.ajax.reload();
							form.trigger("reset");
							validator = form.parsley();
							validator.reset();
							$("#newRegistro").prop('disabled', true);
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
		$("#newRegistro").click(function() {
				$(this).prop('disabled', false);
				$("#modal-add").modal('show');
		});

		$("#modal-add").on('hidden.bs.modal', function() {
			var form = $("#registroAdd-form");
			form.trigger("reset");
			validator = form.parsley();
			validator.reset();
			$("#newRegistro").prop('disabled', false);
		});

		$("#tablaRegistros").on('click', '.editar', function(event) {
			// var form = $("#registrosEdit-form");
			// form.trigger("reset");
			// validator = form.parsley();
			// validator.reset();
			registroid = $(this).data('registroid');
			$.ajax({
				url: site_url + 'panel/registros/getRegistro',
				type: 'POST',
				data: {
					registroid: registroid
				},
				dataType: "json",
				success: function(obj) {
						 $("#estadoModalContent").html(obj.vista);
						 $("#modal-estado").modal("show");
						//  $("#registrosEditar-id").val(obj.registro.id_reg);
						//  $("#registrosEdit-fechare").val(obj.registro.fecharegi);
						//  $("#registrosEdit-tipodocumento").val(obj.registro.documentoid);
						//  $("#registrosEdit-nrodocumento").val(obj.registro.numerodocumento);
						//  $("#registrosEdit-fechanac").val(obj.registro.fechanac);
						//  $("#registrosEdit-nombre").val(obj.registro.nombres);
						//  $("#registrosEdit-telefono").val(obj.registro.telefono);
						//  $("#registrosEdit-correo").val(obj.registro.correo);
						//  $("#registrosEdit-especialidad").val(obj.registro.especialidad);
						//  $("#establecimientoEditar-id").val(obj.registro.estable);
						//  $("#registrosEdit-formato").val(obj.registro.formato);
						//  $("#registrosEdit-observacion").val(obj.registro.observacion);
						//  $("#registrosEdit-estado").val(obj.registro.estado);
				
					// 	// validarDocumento();
					// 	$("#modal-edit").modal("show");
					// } else {
					// 	Swal.fire({
					// 		toast: true,
					// 		position: 'bottom-end',
					// 		icon: obj.tipo,
					// 		title: obj.titulo,
					// 		text: obj.mensaje,
					// 		showConfirmButton: false,
					// 		timer: 2500
					// 	});
					// }
				}
			});
		});

		$("#editaRegistro").click(function(event) {
			// alert("ahaola amnigos");
			var form = $("#registrosEdit-form");
			form.parsley().validate();
			if (form.parsley().isValid()) {
				var formSerialize = $('#registrosEdit-form').serialize();
				$.ajax({
					url: site_url + 'panel/registros/editarRegistro', //Usando el controlador
					type: "POST",
					data: formSerialize,
					dataType: "json",
					success: function(obj) {
						// console.log("esto es la data",obj.dataUpda);
						if (obj.tipo == "1") {
							$("#modal-edit").modal('hide');
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

		function isnumeric() {
			$('#registros-documento').removeNumeric();
			$(".isnumero").numeric({
				decimal: false,
				negative: false
			});
		}

		function isnumericEdit() {
			$('#registrosEdit-documento').removeNumeric();
			$(".isnumero").numeric({
				decimal: false,
				negative: false
			});
		}

		function datosTabla() {
				let startDate = moment($('#rangofecha').data('daterangepicker').startDate._d).format('YYYY-MM-DD');
				let endDate = moment($('#rangofecha').data('daterangepicker').endDate._d).format('YYYY-MM-DD');
				startdate = picker.startDate //.format("YYYY-MM-DD");
				enddate = picker.endDate  //.format("YYYY-MM-DD");
				oTable.fnDraw();
			}
		$("#registros-tipodocumento").change(function() {
			if ($(this).val() != "") {
				$('#registros-documento').prop("disabled", false);
				var numero = $('#registros-documento').val();
				var selected = $(this).find('option:selected');
				var maxDigitos = selected.data('digitmax');

				$('#registros-documento').attr("maxlength", maxDigitos);
				$('#registros-documento').attr('data-parsley-minlength', maxDigitos);

				if (numero.length > maxDigitos) {
					var cortar = numero.length - maxDigitos;
					var numero2 = numero.substring(0, numero.length - cortar);
					$('#registros-documento').val(numero2);
				}
				swAlfanumerico = $("#registros-tipodocumento option:selected").data('alfanumerico');
				if (swAlfanumerico == '0') {
					$("#registros-documento").addClass('isnumero');
					$('#registros-documento').removeAttr("data-parsley-type");
					$('#registros-documento').attr("data-parsley-type", "number");
					isnumeric();
				} else if (swAlfanumerico == '1') {
					$("#registros-documento").removeClass('isnumero');
					$('#registros-documento').removeAttr("data-parsley-type");
					$('#registros-documento').attr("data-parsley-type", "alphanum");
					isnumeric();
				}
			} else {
				$('#registros-documento').prop("disabled", true);
			}
		});

		$("#registrosEdit-tipodocumento").change(function() {
			validarDocumento();
		});

		function validarDocumento() {
			var numero = $('#registrosEdit-documento').val();
			var selected = $("#registrosEdit-tipodocumento").find('option:selected');
			var maxDigitos = selected.data('digitmax');

			$('#registrosEdit-documento').attr("maxlength", maxDigitos);
			$('#registrosEdit-documento').attr('data-parsley-minlength', maxDigitos);

			if (numero.length > maxDigitos) {
				var cortar = numero.length - maxDigitos;
				var numero2 = numero.substring(0, numero.length - cortar);
				$('#usuarioEdit-documento').val(numero2);
			}
			swAlfanumerico = $("#usuarioEdit-tipodocumento option:selected").data('alfanumerico');
			if (swAlfanumerico == '0') {
				$("#registrosEdit-documento").addClass('isnumero');
				$('#registrosEdit-documento').removeAttr("data-parsley-type");
				$('#registrosEdit-documento').attr("data-parsley-type", "number");
				isnumericEdit();
			} else if (swAlfanumerico == '1') {
				$("#registrosEdit-documento").removeClass('isnumero');
				$('#registrosEdit-documento').removeAttr("data-parsley-type");
				$('#registrosEdit-documento').attr("data-parsley-type", "alphanum");
				isnumericEdit();
			}
		}

	<?php endif ?>
// END--------------------------REGISTROS--------------------------



// BEGIN------------------------CLIENTES --------------------------
	<?php if ($current_controller == "inicio") : ?>
		$(document).ready(function() {
			$(".isnumero").numeric({
				decimal: false,
				negative: false
			});
		});

		// var getClientes = $('#tablaClientes').DataTable({
		// 	"responsive": true,
		// 	"columnDefs": [{
		// 			"responsivePriority": 1,
		// 			"targets": 0
		// 		},
		// 		{
		// 			"responsivePriority": 2,
		// 			"targets": -1
		// 		}
		// 	],
		// 	"destroy": true,
		// 	"pageLength": 10,
		// 	"processing": true,
		// 	"ajax": {
		// 		"url": site_url + "panel/clientes/getClientes",
		// 		"type": "POST",
		// 		"dataSrc": "",
		// 		"datatype": "json"
		// 	},
		// 	"columns": [
		// 		{
		// 			"data": "cliente_codigo"
		// 		},
		// 		{
		// 			"data": "cliente_numerodocumento"
		// 		},
		// 		{
		// 			"data": "cliente_nombresCompletos"
		// 		},
		// 		// {
		// 		// 	"data": "cliente_apellidos"
		// 		// },
		// 		{
		// 			"data": "cliente_razonsocial"
		// 		},
		// 		{
		// 			"data": "cliente_direccion"
		// 		},
		// 		{
		// 			"data": "cliente_telefono_mobile"
		// 		},
		// 		{
		// 			"data": "cliente_correo"
		// 		},
		// 		{
		// 			"data": "cliente_nac"
		// 		},
		// 		{
		// 			"data": "enfermedad"
		// 		},
		// 		{
		// 			"data": "molestia"
		// 		},
		// 		{
		// 			"data": "motivo"
		// 		},
		// 		{
		// 			"data": "apetito"
		// 		},
		// 		{
		// 			"data": "orina"
		// 		},
		// 		{
		// 			"data": "sed"
		// 		},
		// 		{
		// 			"data": "deposiciones"
		// 		},
		// 		{
		// 			"data": "sueno"
		// 		},
		// 		{
		// 			"data": "antecedentes"
		// 		},
		// 		{
		// 			"data": "t"
		// 		},
		// 		{
		// 			"data": "p_a"
		// 		},
		// 		{
		// 			"data": "f_c"
		// 		},
		// 		{
		// 			"data": "f_r"
		// 		},
		// 		{
		// 			"data": "sto_2"
		// 		},
		// 		{
		// 			"data": "talla"
		// 		},
		// 		{
		// 			"data": "peso"
		// 		},
		// 		{
		// 			"data": "piel"
		// 		},
		// 		{
		// 			"data": "cabeza"
		// 		},
		// 		{
		// 			"data": "cavidad"
		// 		},
		// 		{
		// 			"data": "torax"
		// 		},
		// 		{
		// 			"data": "aparato"
		// 		},
		// 		{
		// 			"data": "abdomen"
		// 		},
		// 		{
		// 			"data": "diagnostico"
		// 		},
		// 		{
		// 			"data": "exam_aux"
		// 		},
		// 		{
		// 			"data": "trat_aux"
		// 		},
		// 		{
		// 			"data": "acciones"
		// 		}
		// 	]
		// });

		// $("#tablaClientes").on('click', '.editar', function(event) {
		// 	var form = $("#clientesEdit-form");
		// 	form.trigger("reset");
		// 	validator = form.parsley();
		// 	validator.reset();
		// 	clienteid = $(this).data('clienteid');
		// 	$.ajax({
		// 		url: site_url + 'panel/clientes/getCliente', //usando el MODElO
		// 		type: 'POST',
		// 		data: {
		// 			clienteid: clienteid
		// 		},
		// 		dataType: "json",
		// 		success: function(obj) {
		// 			if (obj.sw_error == "0") {
		// 				console.log(obj.cliente);
		// 				$("#clientesEdit-id").val(obj.cliente.id);
		// 				$("#clientesEdit-nombre").val(obj.cliente.nombres);
		// 				$("#clientesEdit-apellido").val(obj.cliente.apellidos);
		// 				$("#clientesEdit-tipodocumento").val(obj.cliente.documentoid);
		// 				$("#clientesEdit-documento").val(obj.cliente.numerodocumento);
		// 				$("#clientesEdit-razonsocial").val(obj.cliente.razonsocial);
		// 				$("#clientesEdit-celu").val(obj.cliente.telefonomobil);
		// 				$("#clientesEdit-cumple").val(obj.cliente.fechnac);
		// 				$("#clientesEdit-direccion").val(obj.cliente.direccion);
		// 				$("#clientesEdit-correo").val(obj.cliente.correo);
		// 				$("#clientesEdit-enfermedad").val(obj.cliente.enfermedad);
		// 				$("#clientesEdit-Tenfermedad").val(obj.cliente.Tenfermedad);
		// 				$("#clientesEdit-motivo").val(obj.cliente.motivo);
		// 				$("#clientesEdit-apetito").val(obj.cliente.apetito);
		// 				$("#clientesEdit-orina").val(obj.cliente.orina);
		// 				$("#clientesEdit-sed").val(obj.cliente.sed);
		// 				$("#clientesEdit-deposiciones").val(obj.cliente.deposiciones);
		// 				$("#clientesEdit-sueno").val(obj.cliente.sueno);
		// 				$("#clientesEdit-antecedentes").val(obj.cliente.antecedentes);
		// 				$("#clientesEdit-t").val(obj.cliente.t);
		// 				$("#clientesEdit-p_a").val(obj.cliente.p_a);
		// 				$("#clientesEdit-f_c").val(obj.cliente.f_c);
		// 				$("#clientesEdit-f_r").val(obj.cliente.f_r);
		// 				$("#clientesEdit-sto_2").val(obj.cliente.sto_2);
		// 				$("#clientesEdit-talla").val(obj.cliente.talla);
		// 				$("#clientesEdit-peso").val(obj.cliente.peso);
		// 				$("#clientesEdit-piel").val(obj.cliente.piel);
		// 				$("#clientesEdit-cabeza").val(obj.cliente.cabeza);
		// 				$("#clientesEdit-cavi").val(obj.cliente.cavidad);
		// 				$("#clientesEdit-torax").val(obj.cliente.torax);
		// 				$("#clientesEdit-aparato").val(obj.cliente.aparato);
		// 				$("#clientesEdit-abdomen").val(obj.cliente.abdomen);
		// 				$("#clientesEdit-diag").val(obj.cliente.diagnostico);
		// 				$("#clientesEdit-aux").val(obj.cliente.exam_aux);
		// 				$("#clientesEdit-trat").val(obj.cliente.trat_aux);
		// 				validarDocumento();
		// 				$("#modal-edit-cliente").modal("show");

		// 			} else {
		// 				Swal.fire({
		// 					toast: true,
		// 					position: 'bottom-end',
		// 					icon: obj.tipo,
		// 					title: obj.titulo,
		// 					text: obj.mensaje,
		// 					showConfirmButton: false,
		// 					timer: 2500
		// 				});
		// 			}

		// 		}
		// 	});
		// });

		// $("#tablaClientes").on('click', '.eliminar', function(event) {

		// 	var id = $(this).data("clienteid");

		// 	Swal.fire({
		// 		title: 'Esta seguro?',
		// 		text: "Si elimina al Cliente ,ya no podras visualizarlo en la plataforma.!",
		// 		icon: 'warning',
		// 		showCancelButton: true,
		// 		confirmButtonColor: '#3085d6',
		// 		cancelButtonColor: '#d33',
		// 		confirmButtonText: 'Si, eliminalo!',
		// 		cancelButtonText: 'Cancelar'
		// 	}).then((result) => {
		// 		if (result.value) {
		// 			$.ajax({
		// 				url: site_url + 'panel/clientes/eliminar/' + id,
		// 				type: 'POST',
		// 				data: [],
		// 				dataType: "json",
		// 				success: function(obj) {
		// 					if (obj.tipo == "1") {
		// 						getClientes.ajax.reload();
		// 						Swal.fire({
		// 							toast: true,
		// 							position: 'bottom-end',
		// 							icon: obj.status,
		// 							title: obj.titulo,
		// 							text: obj.mensaje,
		// 							showConfirmButton: false,
		// 							timer: 2500
		// 						});
		// 					} else {
		// 						Swal.fire({
		// 							toast: true,
		// 							position: 'bottom-end',
		// 							icon: obj.status,
		// 							title: obj.titulo,
		// 							text: obj.mensaje,
		// 							showConfirmButton: false
		// 						});
		// 					}
		// 				}
		// 			});
		// 		}
		// 	});
		// });

		// $("#addcliente").click(function(event) {
		// 	var form = $("#clientes-form");
		// 	form.parsley().validate();
		// 	if (form.parsley().isValid()) {
		// 		var formSerialize = $('#clientes-form').serialize();
		// 		$.ajax({
		// 			url: site_url + 'panel/clientes/addcliente', //Usando el controlador
		// 			type: "POST",
		// 			data: formSerialize,
		// 			dataType: "json",
		// 			success: function(obj) {
		// 				if (obj.tipo == "1") {
		// 					$("#modal-add-cliente").modal('hide');
		// 					getClientes.ajax.reload();
		// 					form.trigger("reset");
		// 					validator = form.parsley();
		// 					validator.reset();
		// 					$("#newCliente").prop('disabled', true);
		// 					Swal.fire({
		// 						toast: true,
		// 						position: 'bottom-end',
		// 						icon: obj.status,
		// 						title: obj.titulo,
		// 						text: obj.mensaje,
		// 						showConfirmButton: false,
		// 						timer: 2500
		// 					});
		// 				} else {
		// 					Swal.fire({
		// 						toast: true,
		// 						position: 'bottom-end',
		// 						icon: obj.status,
		// 						title: obj.titulo,
		// 						text: obj.mensaje,
		// 						showConfirmButton: false
		// 					});
		// 				}
		// 			}
		// 		});

		// 	}

		// });
		// AQUI SE DESABILITA EL BOTON
		// $("#newCliente").click(function() {
		// 	$(this).prop('enabled', true);
		// 	$("#modal-add-cliente").modal('show');
		// });

		$("#modalEditar").click(function(event) {
			event.preventDefault();
			$("#modal-edit").modal("show");

			var form = $("#usuarioEdit-form");
			// form.trigger("reset");
			// validator = form.parsley();
			// validator.reset();
			// usuarioid = $(this).data('usuarioid');
			// $.ajax({
			// 	url: site_url + 'panel/usuarios/getUsuario',
			// 	type: 'POST',
			// 	data: {
			// 		usuarioid: usuarioid
			// 	},
			// 	dataType: "json",
			// 	success: function(obj) {
			// 		$("#modal-edit").modal("show");

			// 		if (obj.sw_error == "0") {
			// 			console.log(obj.usuario);
			// 			$("#usuarioEdit-id").val(obj.usuario.id);
			// 			$("#usuarioEdit-nombre").val(obj.usuario.nombres);
			// 			$("#usuarioEdit-tipodocumento").val(obj.usuario.documentoid);
			// 			$("#usuarioEdit-documento").val(obj.usuario.numerodocumento);
			// 			$("#usuarioEdit-telefonomobil").val(obj.usuario.telefonomobil);
			// 			$("#usuarioEdit-direccion").val(obj.usuario.direccion);
			// 			$("#usuarioEdit-correo").val(obj.usuario.correo);
			// 			$("#usuarioEdit-password").val(obj.usuario.password);
			// 			$("#usuarioEdit-idEsta").val(obj.usuario.establecimiento);
			// 			$("#usuarioEdit-tipo").val(obj.usuario.tipouser);
			// 			// if (obj.usuario.tipo == 1) {
			// 			// 	$("#divEspecialidadEditar").removeClass('d-none');
			// 			// 	$("#usuarioEdit-especialidad").val(obj.usuario.especialidad);	
			// 			// } else {
			// 			// 	$("#divEspecialidadEditar").addClass('d-none');
			// 			// 	$("#usuarioEdit-especialidad").val("");
			// 			// }
			// 			validarDocumento();
			// 			$("#modal-edit").modal("show");
			// 		} else {
			// 			Swal.fire({
			// 				toast: true,
			// 				position: 'bottom-end',
			// 				icon: obj.tipo,
			// 				title: obj.titulo,
			// 				text: obj.mensaje,
			// 				showConfirmButton: false,
			// 				timer: 2500
			// 			});
			// 		}
			// 	}
			// });
		});


		$("#editUser").click(function(event) {
			var form = $("#usuarioEdit-form");
			form.parsley().validate();
			if (form.parsley().isValid()) {
				var formSerialize = $('#usuarioEdit-form').serialize();
				$.ajax({
					url: site_url + 'panel/clientes/updateClientes', //Usando el controlador
					type: "POST",
					data: formSerialize,
					dataType: "json",
					success: function(obj) {
						if (obj.tipo == "1") {
							$("#modal-edit-cliente").modal('hide');
							getClientes.ajax.reload();
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
								showConfirmButton: false
							});
						}
					}
				});

			}

		});

		$("#modal-add-cliente").on('hidden.bs.modal', function() {
			var form = $("#Clientes-form");
			form.trigger("reset");
			validator = form.parsley();
			validator.reset();
			$("#newCliente").prop('enabled', false);
		});

		function isnumeric() {
			$('#clientes-documento').removeNumeric();

			$(".isnumero").numeric({
				decimal: false,
				negative: false
			});
		}


		$("#clientes-tipodocumento").change(function() {
			if ($(this).val() != "") {

				$('#clientes-documento').prop("disabled", false);
				var numero = $('#clientes-documento').val();
				var selected = $(this).find('option:selected');
				var maxDigitos = selected.data('digitmax');

				$('#clientes-documento').attr("maxlength", maxDigitos);
				$('#clientes-documento').attr('data-parsley-minlength', maxDigitos);

				if (numero.length > maxDigitos) {
					var cortar = numero.length - maxDigitos;
					var numero2 = numero.substring(0, numero.length - cortar);
					$('#clientes-documento').val(numero2);
				}
				swAlfanumerico = $("#clientes-tipodocumento option:selected").data('alfanumerico');
				if (swAlfanumerico == '0') {
					$("#clientes-documento").addClass('isnumero');
					$('#clientes-documento').removeAttr("data-parsley-type");
					$('#clientes-documento').attr("data-parsley-type", "number");
					isnumeric();
				} else if (swAlfanumerico == '1') {
					$("#clientes-documento").removeClass('isnumero');
					$('#clientes-documento').removeAttr("data-parsley-type");
					$('#clientes-documento').attr("data-parsley-type", "alphanum");
					isnumeric();
				}

				if ($(this).val() == '2') {
					$("#clientes-razonsocial").prop("disabled", false);
					$("#clientes-razonsocial").prop("required", true);
					$("#divRazonRuc").removeClass("d-none");
				} else {
					$("#clientes-razonsocial").prop("disabled", true);
					$("#clientes-razonsocial").prop("required", false);
					$("#divRazonRuc").addClass("d-none");
				}

			} else {
				$('#clientes-documento').prop("disabled", true);
				$("#clientes-razonsocial").prop("disabled", true);
				$("#divRazonRuc").addClass("d-none");
			}
		});

		function isnumericEdit() {
			$('#clientesEdit-documento').removeNumeric();

			$(".isnumero").numeric({
				decimal: false,
				negative: false
			});

		}

		$("#clientesEdit-tipodocumento").change(function() {
			validarDocumento();
		});

		function validarDocumento() {
			var numero = $('#clientesEdit-documento').val();
			var selected = $("#clientesEdit-tipodocumento").find('option:selected');
			var maxDigitos = selected.data('digitmax');

			$('#clientesEdit-documento').attr("maxlength", maxDigitos);
			$('#clientesEdit-documento').attr('data-parsley-minlength', maxDigitos);

			if (numero.length > maxDigitos) {
				var cortar = numero.length - maxDigitos;
				var numero2 = numero.substring(0, numero.length - cortar);
				$('#clientesEdit-documento').val(numero2);
			}
			swAlfanumerico = $("#clientesEdit-tipodocumento option:selected").data('alfanumerico');
			if (swAlfanumerico == '0') {
				$("#clientesEdit-documento").addClass('isnumero');
				$('#clientesEdit-documento').removeAttr("data-parsley-type");
				$('#clientesEdit-documento').attr("data-parsley-type", "number");
				isnumericEdit();
			} else if (swAlfanumerico == '1') {
				$("#clientesEdit-documento").removeClass('isnumero');
				$('#clientesEdit-documento').removeAttr("data-parsley-type");
				$('#clientesEdit-documento').attr("data-parsley-type", "alphanum");
				isnumericEdit();
			}

			if ($("#clientesEdit-tipodocumento").val() == '2') {
				$("#clientesEdit-razonsocial").prop("disabled", false);
				$("#clientesEdit-razonsocial").prop("required", true);
				$("#divRazonRucEdit").removeClass("d-none");
			} else {
				$("#clientesEdit-razonsocial").prop("disabled", true);
				$("#clientesEdit-razonsocial").prop("required", false);
				$("#divRazonRucEdit").addClass("d-none");
			}
		}

		
	<?php endif ?>
// END--------------------------CLIENTES --------------------------


// BEGIN -----------------------REPORTES -------------------------
	<?php if ($current_controller == 'reportes') : ?>
		$(document).ready(function() {
				// datosTabla();
		});
		var start = moment().startOf('month').format('DD-MM-YYYY');
		
		$('.daterange').daterangepicker({
			opens: 'left',
			autoApply: true,
			startDate: start,
			locale: {
				format: 'DD-MM-YYYY',
				daysOfWeek: [
					"Do",
					"Lu",
					"Ma",
					"Mi",
					"Ju",
					"Vi",
					"Sa"
				],
				monthNames: [
					"Enero",
					"Febrero",
					"Marzo",
					"Abril",
					"Mayo",
					"Junio",
					"Julio",
					"Agosto",
					"Setiembre",
					"Octubre",
					"Noviembre",
					"Diciembre"
				]
			},

		}, function(start, end, label) {
			console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
		});

		$("#rpgenerar").click(function() {
				// datosTabla();
		});

		$("#rpdescargar").click(function() {
			let startDate = moment($('#rangofecha').data('daterangepicker').startDate._d).format('YYYY-MM-DD');
			let endDate = moment($('#rangofecha').data('daterangepicker').endDate._d).format('YYYY-MM-DD');
			let estado =  document.getElementById('estado').value;
			sitio = site_url + 'panel/reportes/getReportes/' + startDate + '/' + endDate + '/' + estado   ;
			console.log(sitio);
			window.open(
				sitio,
				'_blank' // <- This is what makes it open in a new window.
			);
		});

			
	<?php endif ?>
// END ------------------------ REPORTES -------------------------

</script>