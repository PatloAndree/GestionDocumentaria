<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ventas_model extends CI_Model
{


	public function getRegistros($desde, $hasta, $estado=""  ){
		$where = "" ;
		if($estado != ""){
		$where = ' AND r.estado_id =' .$estado;
		}
		$sql = 'SELECT 
				r.estado_id,
				r.registro_fecha,
				t.nombre_establecimiento,
				r.nombres,
				r.sexo,
				r.numero_dni,
				r.fecha_pro,
				e.especialidad_nombre,
				r.medico_pro,
				s.nombre_estado,
				r.fecha_res,
				r.msj_anulado,
				r.observacion_resp
				FROM  registros r 
				inner join especialidades e on e.especialidad_id = r.especialidad_id
				inner join establecimientos t on t.establecimiento_id  = r.establecimiento_id 
				inner join estados s on s.estado_id = r.estado_id
				WHERE r.registro_fecha BETWEEN  "'.$desde.'" AND  "'.$hasta.'"' .$where ;
				// WHERE r.registro_fecha BETWEEN  "'.$desde.'" AND  "'.$hasta.'" AND r.estado_id ="'.$estado.'" ';

				
		$datos = $this->db->query($sql);
		
		if ($datos->num_rows() > 0) {
			return $datos->result();
		} else {
			return array();
		}
	}
}

