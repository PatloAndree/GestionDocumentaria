<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('especialidades_model');
		// is_logged_admin_in();
	}
	
	public function index(){
		$this->load->model('documentos_model');
		// $this->load->model('especialidades_model');
		$documentos = $this->documentos_model->getDocumentos();
		// $data['especialidades'] = $especialidades;
		$data["documentos"] = $documentos;
		$data['titulo']="MI PERFIL ";
		$data['contenido']="perfil_view";
		$this->load->view('panel/include/template_view',$data);
	}

    
	public function editarUsuario()
	{
		$this->load->model('especialidades_model');
		$this->load->model('perfil_model');
		$usuario = $_POST['usuarioEdit-id'];
		// $usuario_nombre = $_POST["usuarioEdit-nombre"];
		$this->perfil_model->setUsuario_id($usuario);
		$usuario_correo = strtolower(trim($_POST['usuarioEdit-correo']));
		$verificarUsuario = $this->perfil_model->verificarCorreoUsuario($_POST["usuarioEdit-correo"]);
		if ($verificarUsuario == 1) {
		$dataUpdate['documento_id'] = $_POST["usuarioEdit-tipodocumento"];
		$numero = $_POST["usuarioEdit-idEsta"];
		$dataUpdate['establecimiento_id '] = $numero;
		$dataUpdate['usuario_numerodocumento'] = $_POST["usuarioEdit-documento"];
		$dataUpdate['usuario_nombres'] = $_POST["usuarioEdit-nombre"];
		$dataUpdate['usuario_direccion'] = $_POST["usuarioEdit-direccion"];
		$dataUpdate['usuario_telefono_mobil'] = $_POST["usuarioEdit-telefonomobil"];
		$dataUpdate['usuario_tipo'] = 2;
		$dataUpdate['usuario_correo'] = $usuario_correo;
		$dataUpdate['usuario_password'] =  $_POST["usuarioEdit-password"];
		$sw_insert = $this->perfil_model->updateUsuario($dataUpdate);
		if ($sw_insert > 0) {
				$response = array("status" => "success", "titulo" => "Éxito", "mensaje" => "Se actualizo los datos del usuario " . $usuario_correo, "tipo" => "1");
		} else{
			$response = array("status" => "warning", "titulo" => "Atención", "mensaje" => "Ocurrio un problema, Intentelo nuevamente.", "tipo" => "0");
		} 
		
		}
		
		echo json_encode($response);

	}


	public function getUsuario()
	{
		$this->load->model('perfil_model');
		$usuarioId = $this->session->userdata("usuario_id");
		$this->perfil_model->setUsuario_id($usuarioId);
		$datos = $this->perfil_model->getUsuario();
		// if ($datos != 0) {
            $data = [];
			$data["usuario"]=$datos;
			$datosUsuarios['id'] = $datos->usuario_id;
			$datosUsuarios['documentoid'] = $datos->documento_id;
			$datosUsuarios['establecimiento'] = $datos->establecimiento_id;
			$datosUsuarios['tipouser'] = $datos->usuario_tipo;
			$datosUsuarios['numerodocumento'] = $datos->usuario_numerodocumento;
			$datosUsuarios['nombres'] = $datos->usuario_nombres;
			$datosUsuarios['direccion'] = $datos->usuario_direccion;
			$datosUsuarios['telefonomobil'] = $datos->usuario_telefono_mobil;
			$datosUsuarios['correo'] = $datos->usuario_correo;
			$datosUsuarios['password'] = $datos->usuario_password;
		// 	$dataReturn = array("sw_error" => 0, "titulo" => "Exito", "tipo" => "success", "mensaje" => "success", "usuario" => $datosUsuarios);
		// } else {
		// 	$dataReturn = array("sw_error" => 1, "titulo" => "Atención", "tipo" => "warning", "mensaje" => "success");
		// }

		echo json_encode(array("usuario" => $datosUsuarios));
        exit;
	}


	public function estableList(){
		$postData = $this->input->post();
		$data = $this->especialidades_model->getEstablecimientos($postData);
		echo json_encode($data);
	}

}