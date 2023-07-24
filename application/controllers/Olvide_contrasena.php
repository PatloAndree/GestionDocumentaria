<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Olvide_contrasena extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		//_is_logged_in_user();
	}

	public function index()
	{
		$data['usuarioNombres'] = $this->session->userdata('usuario_nombres');
		$data['usuarioApellidos'] = $this->session->userdata('usuario_apellidos');
		$data['fechaHoy'] = date('d/m/Y');

		$data['title'] = "SISTEMA: ¿Olvidaste tu contraseña?";
		$data['titulo'] = "¿Olvidaste tu contraseña?";

		$data['current_controller'] = "olvide_contrasena";
		$data['sw_session'] = '0';
		$data['contenido'] = "login/recuperar_contrasenia_view";
		$this->load->view('include/plantilla_login_view.php', $data);
	}

	public function exito()
	{

		$data['usuarioNombres'] = $this->session->userdata('usuario_nombres');
		$data['usuarioApellidos'] = $this->session->userdata('usuario_apellidos');
		$data['fechaHoy'] = date('d/m/Y');
		$data['current_controller'] = "olvide_contrasena";
		$data['hashEncontrado'] = '0';
		$data['sw_session'] = '0';

		$emailRestablecer = trim($this->input->post('email'));
		echo($emailRestablecer);


		if ($emailRestablecer == '') {
			$data['title'] = "SISTEMA : Error - Email no enviado";
			$data['titulo'] = "Necesitamos tu email";
			$data['texto'] = "";
		} else {
			$this->load->model('usuarios_model');
			$usuario = $this->usuarios_model->getUsuarioXEmail($emailRestablecer);

			if ($usuario == false) {
				$data['title'] = "SISTEMA : El Email ingresado no se encuentra registrado en nuestro sistema";
				$data['titulo'] = "No te encontramos";
				$data['texto'] = "El Email ingresado no se encuentra registrado en nuestro sistema";
			} else {
				$this->load->library('encryption');
				$key = $this->encryption->create_key(16);
				$hash = sha1(microtime() . $key);

				$this->load->model('recuperacontrasenia_model');
				$this->recuperacontrasenia_model->delete($usuario->usuario_correo);

				$dataInsert = array();
				$dataInsert['recuperarcontrasenia_email'] = trim($usuario->usuario_correo);
				$dataInsert['recuperarcontrasenia_hash'] = $hash;
				$dataInsert['recuperarcontrasenia_fecharegistro'] = date('Y-m-d H:i:s');
				$recuperarcontrasenia_id = $this->recuperacontrasenia_model->nuevoRegistro($dataInsert);

				if ($recuperarcontrasenia_id > 0) {

					$data['title'] = "SISTEMA : Te hemos enviado un email para que crees una nueva contraseña";
					$data['titulo'] = "Vas a crear una nueva contraseña";
					$data['texto'] = "Te hemos enviado un correo electrónico para que puedas crear una nueva contraseña. Por favor, revisa su bandeja de entrada y haz clic en el vínculo indicado en el mensaje.";
					//	----------------------------------------------------------------
					//	ENVIAR EMAIL DE RECUPERACION DE CONTRASEÑA
					//	----------------------------------------------------------------
					$to = array($usuario->usuario_correo);
					$from = EMAIL_FROM;
					$nombreFrom = 'SISTEMA ';
					$subject = 'SISTEMA  - Recupera tu contraseña';
					$cc = '';
					$bbc = '';
					$replyTo = EMAIL_REPLAY;
					$attachments = array();

					ob_start();
					$dataEmail = array();
					$dataEmail['titulo_email'] = 'Recupera tu contraseña';
					$dataEmail['titulo_mensaje'] = 'Hemos recibido una solicitud de recuperación de contraseña. Si deseas cambiarlo, dale clic al siguiente enlace para restaurarlo.';

					$dataEmail['link'] = site_url() . 'olvide_contrasena/restablecer/' . $hash;

					$dataEmail['contenido'] = "email-recupera-contrasenia";

					$this->load->view('email/plantilla-email', $dataEmail);
					$content = ob_get_contents();
					ob_end_clean();

					send_mail_ses($to, $from, $subject, $content, $bbc, $attachments, $replyTo);
				} else {
					$data['title'] = "SISTEMA : Error al recibir la petición de cambio de contraseña";
					$data['titulo'] = "Error en tu petición";
					$data['texto'] = "Error al recibir la petición de cambio de contraseña";
				}
			}
		}
		$data['contenido'] = "login/olvide_contrasena_exito_view";
		$this->load->view('include/plantilla_login_view.php', $data);
	}

	public function restablecer($hash)
	{
		$this->load->model('recuperacontrasenia_model');
		$this->load->model('usuarios_model');
		$fechaAcutual = date('Y-m-d H:i:s');
		$data['fechaHoy'] = $fechaAcutual;
		$data['hashEncontrado'] = '0';
		$sw_recCon = $this->recuperacontrasenia_model->findHashXHash($hash);
		$sw_recCon2 = $this->recuperacontrasenia_model->findHashXHash2($hash);

		if ($sw_recCon == true) {
			$get_usuario = $this->usuarios_model->getUsuarioXEmail($sw_recCon2->recuperarcontrasenia_email);
			$dataIn['usuarioNombres'] = $get_usuario->usuario_nombres;
			$data['usuarioApellidos'] = $get_usuario->usuario_apellidos;
			$fechaLimite = strtotime('+15 minute', strtotime($fechaAcutual));
			$fechaLimite = date('Y-m-d H:i:s', $fechaLimite);
			if ($fechaAcutual < $fechaLimite) {
				$sw_fechaLimite = 0;
				$data['usuarioHora'] = $fechaLimite;
				$data['title'] = "SISTEMA : Crea una nueva contraseña";
				$data['titulo'] = "Crea una nueva contraseña";
				$data['texto'] = "En caso hayas olvidado tu contraseña, utiliza el siguiente formulario para crear una nueva.";
				$data['hashEncontrado'] = '1';
				$data['hash'] = $hash;
			} else {
				$sw_fechaLimite = 1;
				$data['title'] = "SISTEMA : Tiempo de enlace caducado";
				$data['titulo'] = "Tiempo de enlace caducado";
				$data['texto'] = "Si deseas, puedes volver a intentar recuperar tu contraseña desde ente enlace <a href='" . site_url() . "olvide_contrasena'>Recuperar mi contraseña</a>";
				$data['hashEncontrado'] = '0';
			}
		} else {
			$data['title'] = "SISTEMA : No te encontramos";
			$data['titulo'] = "No te encontramos";
			$data['texto'] = "Si deseas, puedes volver a intentar recuperar tu contraseña desde ente enlace <a href='" . site_url() . "olvide_contrasena'>Recuperar mi contraseña</a>";
			$data['hashEncontrado'] = '0';
		}

		$data['current_controller'] = "olvide_contrasena";
		$data['session'] = '0';

		$data['contenido'] = "/login/recuperar_contrasenia_restablecer_view";
		$this->load->view('include/plantilla_login_view.php', $data);
	}

	public function restablecer_exito()
	{

		$data['usuarioNombres'] = $this->session->userdata('usuario_nombres');
		$data['usuarioApellidos'] = $this->session->userdata('usuario_apellidos');
		$data['fechaHoy'] = date('d/m/Y');

		$passwordRC = trim($this->input->post('passwordRC'));
		$repitepasswordRC = trim($this->input->post('repitepasswordRC'));
		$hash = trim($this->input->post('hash'));


		if ($passwordRC == '' || $repitepasswordRC == '' || $hash == '') {
			$data['title'] = "SISTEMA : Error al cambiar tu contraseña";
			$data['titulo'] = "Error al cambiar tu contraseña";
			$data['texto'] = "No nos enviaste tu nueva contraseña!";
		} else if ($passwordRC != $repitepasswordRC) {
			$data['title'] = "SISTEMA : Error al cambiar tu contraseña";
			$data['titulo'] = "Error al cambiar tu contraseña";
			$data['texto'] = "Las dos contraseñas ingresadas deben ser iguales!";
		} else {
			//	Data del usuario
			$this->load->model('usuarios_model');
			$this->load->model('recuperacontrasenia_model');

			//	Actualizar la nueva contraseña - Encriptar Password
			$saltPasswordRC = sha1(microtime() . $passwordRC);
			$passwordRC = sha1($passwordRC . $saltPasswordRC);

			$dataRC = $this->recuperacontrasenia_model->getDataRecuperarContraseniaXHash($hash);
			$usuario = $this->usuarios_model->getUsuarioXEmail($dataRC->recuperarcontrasenia_email);

			$dataUpdate = array();
			$dataUpdate['usuario_password'] = $passwordRC;
			$dataUpdate['usuario_password_sha1'] = $saltPasswordRC;
			$this->usuarios_model->setUsuario_id($usuario->usuario_id);
			$resultUpdate = $this->usuarios_model->updateUsuario($dataUpdate);
			$data['hashEncontrado'] = '1';

			if ($resultUpdate == TRUE) {
				$data['title'] = "SISTEMA : Tu contraseña se ha cambiado con éxito";
				$data['titulo'] = "¡Listo!";
				$data['texto'] = "Tu contraseña se ha restablecido con éxito. Haz clic a continuación para ingresar a nuestro sistema con tu nueva contraseña.";

				//	----------------------------------------------------------------
				//	ENVIAR EMAIL DE CONFIRMACIÓN DE CAMBIO DE CONTRASEÑA
				//	----------------------------------------------------------------
				$to = array($dataRC->recuperarcontrasenia_email);
				$from = EMAIL_FROM;
				$nombreFrom = 'SISTEMA ';
				$subject = 'SISTEMA  - Confirmación de cambio de contraseña';
				$cc = '';
				$bcc = '';
				$replyTo = EMAIL_REPLAY;
				$attachments = array();

				ob_start();
				$dataEmail = array();
				$dataEmail['titulo_email'] = 'Confirmación de cambio de contraseña';
				$dataEmail['titulo_mensaje'] = 'Tu contraseña fué modificado correctamente. Desde ahora puedes usarlo para ingresar a tu cuenta.';
				$dataEmail['contenido'] = "email-confirmacion-cambio-contrasenia";

				$this->load->view('email/plantilla-email', $dataEmail);
				$content = ob_get_contents();
				ob_end_clean();

				send_mail_ses($to, $from, $subject, $content, $bcc, $attachments, $replyTo);
			} else {
				$data['title'] = "SISTEMA : Error al cambiar tu contraseña";
				$data['titulo'] = "Error al cambiar tu contraseña";
				$data['texto'] = "No podemos cambiar tu contraseña. Por favor intente otra vez!";
			}
			//	Eliminar las solicitudes de cambio de contraseña 
			$this->recuperacontrasenia_model->delete($dataRC->recuperarcontrasenia_email);
		}

		$data['current_controller'] = "olvide_contrasena";
		$data['session'] = '0';
		$data['contenido'] = "login/olvide_contrasena_restablecer_exito_view";
		$this->load->view('include/plantilla_login_view.php', $data);
	}
}
