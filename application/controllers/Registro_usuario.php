<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Registro_usuario extends CI_Controller
{
	

	

	// function __construct()
	// {
	// 	parent::__construct();
	// 	// is_logged_admin_in_super();
	// 	$this->load->helper('url');
	// 	$this->load->model('registro_model');
	// 	$this->load->model('usuarios_model');
	// 	//_is_logged_in_user();
	// }
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		
	}
	public function index()
	{

		// $data['usuarioNombres'] = $this->session->userdata('usuario_nombres');
		// $data['usuarioApellidos'] = $this->session->userdata('usuario_apellidos');
		// $data['fechaHoy'] = date('d/m/Y');
		// $data['title'] = "SISTEMA: ¿Olvidaste tu contraseña?";
		// $data['titulo'] = "¿Olvidaste tu contraseña?";	

		$data['current_controller'] = "Registro_usuario";
		$data['sw_session'] = '0';
		$data['contenido'] = "Login/registro_view";
		$this->load->view('include/plantilla_login_view.php', $data);
	}

	public function estableList(){
		$postData = $this->input->post();
		$data = $this->registro_model->getEstablecimientos($postData);
		echo json_encode($data);
	}
	
	



	
	public function agregar()
	{
		$this->load->model('usuarios_model');

		$data['current_controller'] = "registro_usuario";
		$data['hashEncontrado'] = '0';
		$data['sw_session'] = '0';

		// $emailRestablecer = trim($this->input->post('email'));
		$nombres 			= trim($this->input->post('nombres'));
		$establecimiento 	= trim($this->input->post('estable_label'));
		$email 				= trim($this->input->post('email'));
		$contrasenia 		= trim($this->input->post('password'));
		//  echo($email."-");
		//$usuario_id=$_POST['usuario-id'];

		$usuario_correo = $email;
		$usuario_nombre = $nombres;
		// echo("hola ".$usuario_nombre);
		$this->usuarios_model->setUsuario_id('');
		$verificarUsuario = $this->usuarios_model->verificarCorreoUsuario($usuario_correo);
		if ($verificarUsuario == 1) {
			// $dataInsert['documento_id'] = $_POST["usuario-tipodocumento"];
			// $dataInsert['especialidad_id'] = $_POST["usuario-especialidad"];
			$dataInsert['establecimiento_id'] = $establecimiento;
			$dataInsert['usuario_nombres'] = $usuario_nombre;
			$dataInsert['usuario_correo'] = $usuario_correo;
			$dataInsert['usuario_password'] = $contrasenia;
			// echo("/ chau -".$contrasenia);
			// $dataInsert['usuario_password_sha1'] = $saltPassword = sha1(microtime() . $contra);
			// $dataInsert['usuario_password'] = sha1($contra . $saltPassword);
			$dataInsert['usuario_tipo'] = 2;		
			$sw_insert = $this->usuarios_model->addUsuario($dataInsert);
			if ($sw_insert > 0) {
				$data['title'] = "SISTEMA : El Email ingresado no se encuentra registrado en nuestro sistema";
				$data['titulo'] = "Registrado correctamente";
				$data['texto'] = "Inicie sesión con su correo y contraseña ";
				// $data['email'] = $nombresCompletos;
				// 	$response = array("status" =>
				//  "success", "titulo" => "Éxito", "mensaje"=> "Se agrego correctamente la usuario " . $usuario_nombre . "con el correo " . $usuario_correo, "tipo" => "1");
			} else {
				$data['title'] = "SISTEMA : else 1";
				$data['titulo'] = "No se pudo registrar";
				$data['texto'] = "Intentelo de nuevo ";
				// $data['email'] = $nombresCompletos;
				// $response = array("status" => "warning", "titulo" => 
				// "Atención", "mensaje" =>
				//  "Ocurrio un problema, Intentelo nuevamente.", "tipo" => "0");
			}
		} else {
			// $response = array("status" => "warning", "titulo" => "Atención", "mensaje" => "El usuario " . $usuario_nombre . "con el correo " . $usuario_correo . " ya existe, ingrese otro codigo correo.", "tipo" => "0");
			$data['title'] = "SISTEMA : else 2";
			$data['titulo'] = "El Email ingresado  se encuentra registrado";
			$data['texto'] = "Intentelo con otro correo ";
		}
		// echo json_encode($response);
		$data['contenido'] = "login/registro_notifica_view";
		$this->load->view('include/plantilla_login_view.php', $data);
	}


	

}
