<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		
	}

	public function index()
	{
		/* CALCULAR LA HORA Y SUMA DE MINUTOS
		$Fecha = date('Y-m-d H:i:s');
		$NuevaFecha = strtotime ( '+10 minute', strtotime($Fecha));
		$NuevaFecha = date ( 'Y-m-d H:i:s' , $NuevaFecha); 
		echo $Fecha. "<br>";	
		echo $NuevaFecha;
*/
		$data['contenido'] = "Login/login_view";
		$this->load->view('include/plantilla_login_view.php', $data);
	}

	public function validate()
	{

		$this->load->model('login_model');
		$email = trim($this->input->post('email'));
		$password = trim($this->input->post('password'));

		$resultAdmin = $this->login_model->validateUsuario($email, $password);

		if ($resultAdmin == '-1') {
			$this->session->set_flashdata('msn', 'El Dni ingresado no se encuentra registrado!');
			redirect('login/login', 'refresh');
		} else if ($resultAdmin == '-2') {
			$this->session->set_flashdata('msn', 'La contraseña ingresada es incorrecta. Intente nuevamente!');
			redirect('login/login', 'refresh');
		} else if (is_object($resultAdmin)) {

			$root_server = site_url();
			$session_data = array(
				'usuario_email' => trim($resultAdmin->usuario_email),
				'usuario_nombres' => trim($resultAdmin->usuario_nombres),
				'usuario_apellidos' => trim($resultAdmin->usuario_apellidos),
				'is_logged_admin_in' => true,
				'root_server' => $root_server
			);
			$this->session->set_userdata($session_data);

			$this->last_login();
			redirect('login/panel');
		} else {
			$this->session->set_flashdata('msn', 'No te encuentras registrado en el sistema!');
			redirect('login/login', 'refresh');
		}
	}
	
	public function VerificarUsuario()
	{
		$this->load->model('Login_model');

		$email = trim($this->input->post('email'));
		$password = trim($this->input->post('password'));
		$resultValidate = $this->Login_model->validateUsuario($email, $password);
		if($resultValidate == '-1') {

			$dataResult = array("error" => '1', "msn" => "¡Verifique sus credenciales!");
		}  
		
		else if ($resultValidate == '0') {
			$dataResult = array("error" => '1', "msn" => "¡Las credenciales ingresadas son incorrectos!");
		} else if (is_object($resultValidate)) {

			$dataResult = array("error" => '0', "msn" => "Credenciales correctas");
			$this->Login_model->createSession(
				$resultValidate->usuario_correo,
				$resultValidate->usuario_nombres,
				// $resultValidate->usuario_apellidos,
				$resultValidate->usuario_id,
				$resultValidate->usuario_tipo,
				$resultValidate->establecimiento_id

			);
			$this->Login_model->last_login();
		}
		echo json_encode($dataResult);
	}

	public function last_login()
	{
		$email = $this->session->userdata('usuario_correo');
		$dataUpdate = array();
		$dataUpdate['usuario_ultimologin'] = date('Y-m-d H:i:s');

		$this->db->where('usuario_correo', $email);
		$this->db->update('usuarios', $dataUpdate);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('');
	}

	function a()
	{
		/*for($i=0; $i<30; $i++){
			echo microtime().'<br>';
		}*/
		// $salt = sha1(microtime() . '12345678');
		// echo 'Salt: ' . $salt . '<br>';
		// echo 'Password: ' . sha1('12345678' . $salt);
	}
}
