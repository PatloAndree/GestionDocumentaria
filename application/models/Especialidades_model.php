<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Especialidades_model extends CI_Model
{

	var $especialidad_id;
	function setEspecialidaID($especialidad_id)
	{
		$this->especialidad_id = $especialidad_id;
	}


	function getEspecialidades()
	{

		$documentos = $this->db->get("especialidades");
		if ($documentos->num_rows() > 0) {
			return $documentos->result();
		} else {
			return 0;
		}
	}

	
	function getEstados()
	{
		$estados = $this->db->get("estados");
		if ($estados->num_rows() > 0) {
			return $estados->result();
		} else {
			return 0;
		}
	}



	function getNombreEsblecimientos(){
		$establecimientos=$this->db->get("establecimientos");
		if($establecimientos->num_rows()>0){
			return $establecimientos->result();
		}else{
			return 0;
		}
    }


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


	// public function search($key){         
	// 	return $this->db->like('nombre_establecimiento', $key)->get("establecimientos")->result();       
	//   }
	// function addUsuario($dataInsert){
	// 	if ($this->db->insert('usuarios',$dataInsert)) {
    //         return $this->db->insert_id();
    //     }else{
    //         return '0';
    //     }
	// }



}
