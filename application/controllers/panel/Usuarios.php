<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_admin_in_super();
		$this->load->helper('url');
		$this->load->model('especialidades_model');
		
	}
	public function index()
	{
		$this->load->model('documentos_model');
		$this->load->model('especialidades_model');
		$documentos = $this->documentos_model->getDocumentos();
		// $data['especialidades'] = $especialidades;
		$data["documentos"] = $documentos;
		$data['titulo'] = "MANTENIMIENTO DE USUARIOS";
		$data['contenido'] = "usuarios_view";
		$this->load->view('panel/include/template_view', $data);
	}

	public function addUsuario()
	{
		$this->load->model('usuarios_model');
		//$usuario_id=$_POST['usuario-id'];
		$usuario_correo = strtolower(trim($_POST['usuario-correo']));
		$usuario_nombre = $_POST["usuario-nombre"];
		$this->usuarios_model->setUsuario_id('');
		$verificarUsuario =
		 $this->usuarios_model->verificarCorreoUsuario($usuario_correo);
		if ($verificarUsuario == 1) {
			//nombres de campo - nombres de etiquetas
			$dataInsert['documento_id'] = $_POST["usuario-tipodocumento"];
			$dataInsert['establecimiento_id'] = $_POST["usuario-id"];
			$dataInsert['usuario_numerodocumento'] = $_POST["usuario-documento"];
			$dataInsert['usuario_nombres'] = $usuario_nombre;
			$dataInsert['usuario_direccion'] = $_POST["usuario-direccion"];
			$dataInsert['usuario_telefono_mobil'] = $_POST["usuario-telefonomobil"];
			$dataInsert['usuario_correo'] = $usuario_correo;
			$contra = trim($_POST['usuario-password']);
			$dataInsert['usuario_password'] = $_POST["usuario-password"];
			$dataInsert['usuario_tipo'] = $_POST["usuario-tipo"];		
			$sw_insert = $this->usuarios_model->addUsuario($dataInsert);

			if ($sw_insert > 0) {
				$response = array("status" =>
				 "success", "titulo" => "Éxito", "mensaje"
				  => "Se agrego correctamente la usuario " . $usuario_nombre . "con el correo " . $usuario_correo, "tipo" => "1");
			} else {
				$response = array("status" => "warning", "titulo" => 
				"Atención", "mensaje" =>
				 "Ocurrio un problema, Intentelo nuevamente.", "tipo" => "0");
			}
		} else {
			$response = array("status" => "warning", "titulo" => "Atención", "mensaje" => "El usuario " . $usuario_nombre . "con el correo " . $usuario_correo . " ya existe, ingrese otro codigo correo.", "tipo" => "0");
		}
		echo json_encode($response);
	}

	public function editarUsuario()
	{
		$this->load->model('especialidades_model');
		$this->load->model('usuarios_model');
		$usuario = $_POST['usuarioEdit-id'];
		// $usuario_nombre = $_POST["usuarioEdit-nombre"];
		$this->usuarios_model->setUsuario_id($usuario);
		$usuario_correo = strtolower(trim($_POST['usuarioEdit-correo']));
		$verificarUsuario = $this->usuarios_model->verificarCorreoUsuario($_POST["usuarioEdit-correo"]);
		if ($verificarUsuario == 1) {
		$dataUpdate['documento_id'] = $_POST["usuarioEdit-tipodocumento"];
		$numero = $_POST["usuarioEdit-idEsta"];
		$dataUpdate['establecimiento_id '] = $numero;
		$dataUpdate['usuario_numerodocumento'] = $_POST["usuarioEdit-documento"];
		$dataUpdate['usuario_nombres'] = $_POST["usuarioEdit-nombre"];
		$dataUpdate['usuario_direccion'] = $_POST["usuarioEdit-direccion"];
		$dataUpdate['usuario_telefono_mobil'] = $_POST["usuarioEdit-telefonomobil"];
		$dataUpdate['usuario_tipo'] = $_POST["usuarioEdit-tipo"];
		$dataUpdate['usuario_correo'] = $usuario_correo;
		$dataUpdate['usuario_password'] =  $_POST["usuarioEdit-password"];
		$sw_insert = $this->usuarios_model->updateUsuario($dataUpdate);
		if ($sw_insert > 0) {
				$response = array("status" => "success", "titulo" => "Éxito", "mensaje" => "Se actualizo los datos del usuario " . $usuario_correo, "tipo" => "1");
		} else{
			$response = array("status" => "warning", "titulo" => "Atención", "mensaje" => "Ocurrio un problema, Intentelo nuevamente.", "tipo" => "0");
		} 
		
		}
		
		echo json_encode($response);

	}

	public function getUsuarios()
	{
		$this->load->model('usuarios_model');
		$usuarios = $this->usuarios_model->getUsuarios();
		
		if ($usuarios == 0) {
			echo json_encode(array('sindatos' => 'sindatos'));
		} else {
			$dataReturn = array();
			$cont = 0;

			foreach ($usuarios as $usuario) {
				$acciones = '<div class="dropdown">
								<a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-ellipsis-v"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
									<a class="dropdown-item editar" data-usuarioid="' . $usuario->usuario_id . '" style="cursor:pointer" data-original-title="Editar">
										<i class="fas fa-pen"></i> Editar
									</a>				
									<a class="dropdown-item eliminar" data-usuarioid="' . $usuario->usuario_id . '" data-usuarionombre="' . $usuario->usuario_nombres . '" style="color:red;cursor:pointer">
										<i class="fas fa-trash"></i> Eliminar
								</a>	
							</div>';
				
			
				$row['usuario_nombres'] = $usuario->usuario_nombres ;
				// if ($usuario->nombre_establecimiento == null || "") {
				// 	$establecimiento = "NO ASIGNADO";
				// } else {
				// 	$establecimiento = $usuario->nombre_establecimiento;
				// }
				$row['nombre_establecimiento'] = $usuario->nombre_establecimiento;
				$row['documento_numero'] = $usuario->usuario_numerodocumento;
				$row['usuario_direccion'] = $usuario->usuario_direccion;
				$row['usuario_celular'] = $usuario->usuario_telefono_mobil;
				$row['usuario_correo'] = $usuario->usuario_correo;
				$row['contrasenia'] = $usuario_password;
				if ($usuario->usuario_tipo == 1) {
					$tipouser = "Administrador/a";
				} else if ($usuario->usuario_tipo == 2) {
					$tipouser = "Usuario/a";
				}
				$row['usuario_tipo'] = $tipouser;
				$row['documento_abreviatura'] = $usuario->documento_abreviatura;
				$row['sala_acciones'] = $acciones;
				$dataReturn[] = $row;
				$cont++;
			}
			// echo($dataReturn[1]['usuario_nombres']);
			// exit;
			echo json_encode($dataReturn);
		}
	}

	public function getUsuario()
	{
		
		$this->load->model('usuarios_model');
		$usuario_id = $_POST['usuarioid'];
		$this->usuarios_model->setUsuario_id($usuario_id);
		$datos = $this->usuarios_model->getUsuario();
		if ($datos != 0) {
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
			$dataReturn = array("sw_error" => 0, "titulo" => "Exito", "tipo" => "success", "mensaje" => "success", "usuario" => $datosUsuarios);
		} else {
			$dataReturn = array("sw_error" => 1, "titulo" => "Atención", "tipo" => "warning", "mensaje" => "success");
		}

		echo json_encode($dataReturn);
	}

	public function eliminar($usuario_id)
	{
		$this->load->model('usuarios_model');
		$this->usuarios_model->setUsuario_id($usuario_id);
		$dataDelete["usuario_estado"] = "0";

		$result = $this->usuarios_model->deleteUsuario($dataDelete);
		if ($result == 1) {
			$response = array("status" => "success", "titulo" => "Éxito", "mensaje" => "Se elimnino correctamente el usuario ", "tipo" => "1");
		} else {
			$response = array("status" => "warning", "titulo" => "Atención", "mensaje" => "Ocurrio un problema, Intentelo nuevamente.)", "tipo" => "0");
		}

		echo json_encode($response);
	}

	public function estableList(){
		$postData = $this->input->post();
		$data = $this->especialidades_model->getEstablecimientos($postData);
		echo json_encode($data);
	}


	// public function search(){
	// 	$data['retval'] = $this->especialidades_model->search($this->input->get('query'));
	// 	   echo json_encode( $data['retval']);
	//    }

	/*

	public function deleteCliente($dataUpdate){
		
		$this->db->where('cliente_id',$this->cliente_id);
		
		if ($this->db->update('clientes',$dataUpdate)) {
            return 1;
        }else{
            return 0;
        }
	}

	
	public function profile(){

		$this->load->model('documentos_model');
		$documentos=$this->documentos_model->getDocumentos();
		$this->load->model('locales_model');
		$locales=$this->locales_model->getLocales();
		$this->load->model("usuarios_model");
		$usuario=$this->usuarios_model->getUsuario($this->session->userdata('usuario_id'));$data['usuario']=$usuario;

		$data['locales']=$locales;
		$data['documentos']=$documentos;
		$data['titulo']="Actualiza tu usuario";
		$data['contenido']="usuarios_profile_view";
		$this->load->view('administrador/include/template_view',$data);
	}
	*/
}
