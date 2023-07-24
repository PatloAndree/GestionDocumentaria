<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfil_model extends CI_Model {

	var $usuario_id;
	
	function setUsuario_id($usuario_id){
		$this->usuario_id=$usuario_id;
	}

	// function getUsuarios(){
	// 	$query = "SELECT 
	// 	u.usuario_id,
	// 	u.usuario_numerodocumento,
	// 	e.nombre_establecimiento,
	// 	u.usuario_nombres,
	// 	u.usuario_direccion,
	// 	u.usuario_telefono_mobil,
	// 	u.usuario_correo,
	// 	u.usuario_password,
	// 	u.usuario_tipo,
	// 	u.documento_id,
	// 	d.documento_abreviatura FROM usuarios u 
	// 	LEFT JOIN documentos d ON u.documento_id = d.documento_id  
	// 	LEFT JOIN establecimientos e ON u.establecimiento_id = e.establecimiento_id
	// 	 WHERE u.usuario_estado=1";
	// 	$usuarios=$this->db->query($query);
	// 	if($usuarios->num_rows()>0){
	// 		return $usuarios->result();
	// 	}else{
	// 		return 0;
	// 	}
	// }
	
	// function addUsuario($dataInsert){
	// 	if ($this->db->insert('usuarios',$dataInsert)) {
    //         return $this->db->insert_id();
    //     }else{
    //         return '0';
    //     }
	// }

	function getUsuario(){
		$this->db->where('usuario_id',$this->usuario_id);
		$this->db->where('usuario_estado',"1");
		$usuario=$this->db->get('usuarios');
		if($usuario->num_rows()>0){
			return $usuario->row();
		}else{
			return 0;
		}

	}

	function updateUsuario($dataUpdate){
		$this->db->where('usuario_id',$this->usuario_id);
		if ($this->db->update('usuarios',$dataUpdate)) {
            return 1;
        }else{
            return 0;
        }
	}
	
	function verificarCorreoUsuario($usuario_correo){
		if(trim($this->usuario_id)!=''){
			$this->db->where('usuario_id!=',$this->usuario_id);
		}
		$this->db->where('usuario_correo',$usuario_correo);
		$this->db->where('usuario_estado',"1");
		$usuarios=$this->db->get('usuarios');
		
		if($usuarios->num_rows()>0){
			return 0;//existe
		}else{
			return 1;//no existe
		}
	}

	function getUsuarioByCorreo($correo){
		$this->db->where('cliente_correo', $correo);
		$this->db->where('cliente_estado', "1");
		$cliente=$this->db->get('clientes');
		if($cliente->num_rows()>0){
			return $cliente->row();
		}else{
			1;
		}
	}

	public function getUsuarioXEmail($usuario_correo){
		$this->db->select('usuario_id, usuario_nombres, 
		usuario_apellidos, usuario_correo');
		$this->db->where('usuario_correo', $usuario_correo);
		$query = $this->db->get('usuarios');
	//	echo $this->db->last_query();
		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}

}


