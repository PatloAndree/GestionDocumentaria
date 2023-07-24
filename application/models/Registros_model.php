	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registros_model extends CI_Model {

	var $registro_id;
	
	function setRegistro_id($registro_id){
		$this->registro_id=$registro_id;
	}

	function getRegistros(){
		$query = "SELECT 
					c.registro_id,
					e.especialidad_nombre,
					c.registro_fecha,
					c.numero_dni,
					c.nombres,
					c.fechanac,
					c.telefono,
					c.correo,
					c.formato,
					c.observacion,
					c.observacion_resp,
					c.fecha_pro,
					c.hora_pro,
					c.medico_pro,
					c.link_pro,
					c.formato_res,
					t.nombre_establecimiento,
					c.estado_id,
					s.nombre_estado,
					u.usuario_id
					FROM registros c     
					inner join especialidades e on c.especialidad_id = e.especialidad_id
					inner join usuarios u on c.usuario_id = u.usuario_id
					inner join establecimientos t on t.establecimiento_id  = c.establecimiento_id 
					inner join estados s on c.estado_id = s.estado_id";
		$registros=$this->db->query($query);
		if($registros->num_rows()>0){
			return $registros->result();
		}else{
			return 0;
		}
	}

	function getRegistrosId(){
		$usuarioId = $this->session->userdata("usuario_id");
		// $usuarioId = 25;
		//  $this->usuarioId=$usuarioId;
		$query = "SELECT 
					c.registro_id,
					e.especialidad_nombre,
					c.registro_fecha,
					c.numero_dni,
					c.nombres,
					c.fechanac,
					c.telefono,
					c.correo,
					c.formato,
					c.observacion,
					c.observacion_resp,
					c.fecha_pro,
					c.hora_pro,
					c.medico_pro,
					c.link_pro,
					c.formato_res,
					t.nombre_establecimiento,
					c.estado_id,
					s.nombre_estado,
					u.usuario_id
					FROM registros c  
					inner join especialidades e on c.especialidad_id = e.especialidad_id
					inner join usuarios u on c.usuario_id = u.usuario_id
					inner join establecimientos t on t.establecimiento_id  = c.establecimiento_id 
					inner join estados s on c.estado_id = s.estado_id
					WHERE u.usuario_id = $usuarioId
					";
		// $this->db->where('usuario_id',$this->session->userdata("usuario_id"));
		$registros=$this->db->query($query);
		// $registros=$this->db->get('registros');
		if($registros->num_rows()>0){
			return $registros->result();
		}else{
			return 0;
		}
	}


	function getRegistrar(){
		$this->db->where('registro_id',$this->registro_id);
		$registro=$this->db->get('registros');
		if($registro->num_rows()>0){
			return $registro->row();
		}else{
			return false;
		}
	}

	function addRegistro($dataInsert){
		if ($this->db->insert('registros',$dataInsert)) {
            return $this->db->insert_id();
        }else{
            return '0';
        }
	}

	function updateRegistro($dataUpdate)
	{
		$this->db->where('registro_id', $this->registro_id);
		if ($this->db->update('registros',$dataUpdate)) {
            return 1;
        }else{
            return 0;
        }
	
	}

}

