<?php
class registro_model extends CI_Model
{


	function getEstablecimientos($postData)
	{
		$response = array();

		if($postData['search']){
			$this->db->select('*');
			$this->db->where('nombre_establecimiento like "%'.$postData['search'].'%" ');
			$records = $this->db->get('establecimientos')->result();

			foreach($records as $row){
				$response[] = array(
					"label" => $row->nombre_establecimiento,
					"value" => $row->establecimiento_id,
				);
			}
		}
		return $response;

		
	}
	// function validateAdministrador($dni = '', $password = '')
	// {
	// 	$this->db->select('administrador_email, administrador_nombres,
	// 	 administrador_apellidos, administrador_swactivo');
	// 	$this->db->where('administrador_email', $email);
	// 	$this->db->where('administrador_swactivo', '1');
	// 	$query = $this->db->get('administradores');

	// 	if ($query->num_rows() == 1) {
	// 		$result = $this->validate_passwordAdmin($dni, $password);

	// 		if ($result == '1')
	// 			return $query->row();
	// 		else return $result;
	// 	} else {
	// 		return '-1';  //  Administrador no existe o no esta activo
	// 	}
	// }

	// function validate_passwordAdmin($dni = '', $password = '')
	// {
	// 	$this->db->select('administrador_saltpassword');
	// 	$this->db->where('administrador_email', $dni);
	// 	$query = $this->db->get('administradores');

	// 	if ($query->num_rows() == 1) {
	// 		$row = $query->row();
	// 		$salt = $row->administrador_saltpassword;
	// 		$this->db->select('administrador_email');
	// 		$this->db->where('administrador_email', $email);
	// 		$this->db->where('administrador_password', $password);
	// 		$queryAdmin = $this->db->get('administradores');

	// 		if ($queryAdmin->num_rows() == 1) {
	// 			return '1';
	// 		} else {
	// 			return '-2';  //  Administrador no encontrado
	// 		}
	// 	} else
	// 		return '-2';  //  Administrador no encontrado
	// }

	//	------------------------------------------------------------------------
	//	  USUARIO
	//	------------------------------------------------------------------------
//	function validateUsuario($email = '', $password = '', $user_id = '')

	// function validateUsuario($dni = '', $password = '', $user_id = '')
	// {
	// 	$this->db->select('usuario_password');
	// 	if ($user_id != '') {
	// 		$this->db->where('usuario_id!=', $user_id);
	// 	}
	// 	$this->db->where('usuario_numerodocumento', $dni);
	// 	$this->db->where('usuario_estado', "1");
	// 	$querySalt = $this->db->get('usuarios');

	// 	//$var1=sha1(microtime().'77205914');
	// 	///echo sha1('77205914'.$saltPassword);
	// 	//exit;
	// 	if ($querySalt->num_rows() > 0) {
	// 		$saltPassword = $querySalt->row()->usuario_password;
	// 		$this->db->select('usuario_nombres, usuario_numerodocumento,usuario_apellidos, usuario_password, 
	// 		usuario_password, usuario_estado, usuario_id,usuario_tipo');
	// 		$this->db->where('usuario_numerodocumento', $dni);
	// 		// $this->db->where('usuario_password', sha1($password . $saltPassword));
	// 		$this->db->where('usuario_password', $password);
	// 		$this->db->where('usuario_estado', '1');

	// 		$queryUsuario = $this->db->get('usuarios');

	// 		if ($queryUsuario->num_rows() == 1) {
	// 			return $queryUsuario->row();
	// 		} else {
	// 			return '0';
	// 		}
	// 	} else {
	// 		return '-1';
	// 	}
	// }


	// public function createSession($dni, $nombres, $apellidos, $usuario_id, $tipo)
	// {
	// 	$root_server = site_url();
	// 	$session_data = array(
	// 		'usuario_numerodocumento' => trim($dni),
	// 		'usuario_nombres' => trim($nombres),
	// 		'usuario_apellidos' => trim($apellidos),
	// 		'usuario_id' => $usuario_id,
	// 		'usuario_tipo' => $tipo,
	// 		'is_logged_admin_in' => true,
	// 		'root_server' => $root_server
	// 	);
	// 	$this->session->set_userdata($session_data);
	// }

	// public function last_login()
	// {

	// 	$usuario_numerodocumento = $this->session->userdata('usuario_numerodocumento');
	// 	$dataUpdate = array();
	// 	$dataUpdate['usuario_ultimologin'] = date('Y-m-d H:i:s');

	// 	$this->db->where('usuario_numerodocumento', $usuario_numerodocumento);
	// 	$this->db->update('usuarios', $dataUpdate);
	// }
}
