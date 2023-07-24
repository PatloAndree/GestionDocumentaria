<script>
	site_url = "<?php echo base_url();?>";
</script>
<?php $current_controller = $this->router->fetch_class() ?>
<?php $current_metodo = $this->router->fetch_method() ?>

<script>

	// funcion que valida el login 
	function ingresar() {

		var email = $.trim($('#emailIngresar').val());
		var password = $.trim($('#passwordIngresar').val());
		var resultValidar = email;
		if (resultValidar === false) {
			Swal.fire({
				title: 'Cuidado!',
				text: 'El email ingresado no es válido!',
				icon: 'error',
				toast: true,
				position: 'bottom-end',
				showConfirmButton: false,
				timer: 3000
			});
		} else {
			$.ajax({
				type: "POST",
				dataType: 'json',
				url: site_url + 'Login/VerificarUsuario',
				data: {
					email: email,
					password: password
				},
				success: function(obj) {
					if (obj.error == '1') {
						Swal.fire({
							title: 'Error!',
							text: obj.msn,
							icon: 'error',
							toast: true,
							position: 'bottom-end',
							showConfirmButton: false,
							timer: 3000
						});

					} else if (obj.error == '0') {
						Swal.fire({
							title: 'Ingresando ...',
							text: obj.msn,
							icon: 'success',
							toast: true,
							position: 'bottom-end',
							showConfirmButton: false,
							timer: 3000
						});

						document.location.href = site_url + 'panel/Inicio';
					}
				}
			});
		}
	}
	
	function validar_email(valor) {
		var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		if (filter.test(valor))
			return true;
		else
			return false;
	}

	// $(document).ready(function() {
    $("#ojo").on('click', function(event) {
			event.preventDefault();
			if($('#show_hide_password input').attr("type") == "text"){
				$('#show_hide_password input').attr('type', 'password');
				$('#ojo i').addClass( "fa-eye-slash" );
				$('#ojo i').removeClass( "fa-eye" );
			}else if($('#show_hide_password input').attr("type") == "password"){
				$('#show_hide_password input').attr('type', 'text');
				$('#ojo i').removeClass( "fa-eye-slash" );
				$('#ojo i').addClass( "fa-eye" );
			}
		});
	// });

	$("#btn_restablecerContrasenia").click(function(e) {
		e.preventDefault();
		var form = $("#frm_restablecerContrasenia");
		form.parsley().validate();

		if (form.parsley().isValid()) {
			$("#frm_restablecerContrasenia").submit();
		}
	});

	$("#btn_nuevaContrasenia").click(function(e) {
		e.preventDefault();
		var form = $("#frm_nuevaContrasenia");
		form.parsley().validate();

		if (form.parsley().isValid()) {
			$("#frm_nuevaContrasenia").submit();
		}
	});

	$("#btn_nuevaContrasenia").click(function(e) {
		e.preventDefault();
		var form = $("#frm_nuevaContrasenia");
		form.parsley().validate();

		if (form.parsley().isValid()) {
			$("#frm_nuevaContrasenia").submit();
		}
	});

	$(document).ready(function() {

		$("#email").keypress(function(event) {
			if (event.which == 13) {
				event.preventDefault();
				ingresar();
			}
		});

		$("#password").keypress(function(event) {
			if (event.which == 13) {
				event.preventDefault();
				ingresar();
			}
		});

		$('#btn_ingresar').click(function() {
			ingresar();
		});
	});

</script>