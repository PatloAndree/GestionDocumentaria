<?php
class Login_model extends CI_Model
{

	function validateAdministrador($email = '', $password = '')
	{
		$this->db->select('administrador_email, administrador_nombres,
		 administrador_swactivo');
		$this->db->where('administrador_email', $email);
		$this->db->where('administrador_swactivo', '1');
		$query = $this->db->get('administradores');

		if ($query->num_rows() == 1) {
			$result = $this->validate_passwordAdmin($email, $password);

			if ($result == '1')
				return $query->row();
			else return $result;
		} else {
			return '-1';  //  Administrador no existe o no esta activo
		}
	}

	function validate_passwordAdmin($email = '', $password = '')
	{
		$this->db->select('administrador_saltpassword');
		$this->db->where('administrador_email', $email);
		$query = $this->db->get('administradores');

		if ($query->num_rows() == 1) {
			$row = $query->row();
			$salt = $row->administrador_saltpassword;
			$this->db->select('administrador_email');
			$this->db->where('administrador_email', $email);
			$this->db->where('administrador_password', $password);
			$queryAdmin = $this->db->get('administradores');

			if ($queryAdmin->num_rows() == 1) {
				return '1';
			} else {
				return '-2';  //  Administrador no encontrado
			}
		} else
			return '-2';  //  Administrador no encontrado
	}

	//	------------------------------------------------------------------------
	//	  USUARIO
	//	------------------------------------------------------------------------


	function validateUsuario($email = '', $password = '', $user_id = '')
	{
		$this->db->select('usuario_correo');
		if ($user_id != '') {
			$this->db->where('usuario_id!=', $user_id);
		}
		$this->db->where('usuario_correo', $email);
		$this->db->where('usuario_estado', "1");
		$querySalt = $this->db->get('usuarios');
		// echo '<pre>';
		// print_r($querySalt);
		// echo '</pre>';
		// exit;
		//$var1=sha1(microtime().'77205914');
		///echo sha1('77205914'.$saltPassword);
		//exit;
		if ($querySalt->num_rows() > 0) {
			$saltPassword = $querySalt->row()->usuario_password;
			$this->db->select('usuario_nombres, usuario_numerodocumento, usuario_password, 
			usuario_password, usuario_estado, usuario_id,usuario_tipo, establecimiento_id');
			$this->db->where('usuario_correo', $email);
			// $this->db->where('usuario_password', sha1($password . $saltPassword));
			$this->db->where('usuario_password', $password);
			$this->db->where('usuario_estado', '1');

			$queryUsuario = $this->db->get('usuarios');

			if ($queryUsuario->num_rows() == 1) {
				return $queryUsuario->row();
			} else {
				return '0';
			}
		} else {
			return '-1';
		}
	}


	public function createSession($email, $nombres, $usuario_id, $tipo)
	{

		$root_server = site_url();
		$session_data = array(
			'usuario_correo' => trim($email),
			'usuario_nombres' => trim($nombres),
			'usuario_id' => $usuario_id,
			'usuario_tipo' => $tipo,
			'is_logged_admin_in' => true,
			'root_server' => $root_server
		);
		$this->session->set_userdata($session_data);
	}

	public function last_login()
	{

		$usuario_numerodocumento = $this->session->userdata('usuario_numerodocumento');
		$dataUpdate = array();
		$dataUpdate['usuario_ultimologin'] = date('Y-m-d H:i:s');

		$this->db->where('usuario_numerodocumento', $usuario_numerodocumento);
		$this->db->update('usuarios', $dataUpdate);
	}
}
