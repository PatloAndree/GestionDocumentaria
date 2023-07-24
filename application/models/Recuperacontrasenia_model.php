<?php
class Recuperacontrasenia_model extends CI_Model {

	public function getDataRecuperarContraseniaXHash($recuperarcontrasenia_hash){
		$this->db->select('recuperarcontrasenia_email, recuperarcontrasenia_hash');
		$this->db->where('recuperarcontrasenia_hash', $recuperarcontrasenia_hash);
		$query = $this->db->get('recuperarcontrasenia');
		
		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}
  
	public function findHashXHash($recuperarcontrasenia_hash){
		$this->db->select('recuperarcontrasenia_hash');
		$this->db->where('recuperarcontrasenia_hash', $recuperarcontrasenia_hash);
		$query = $this->db->get('recuperarcontrasenia');
		
		if($query->num_rows() > 0)
			return true;
		else
			return false;
	}
	public function findHashXHash2($recuperarcontrasenia_hash2){
		$this->db->where('recuperarcontrasenia_hash', $recuperarcontrasenia_hash2);
		$query = $this->db->get('recuperarcontrasenia');
		
		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}
	
	public function nuevoRegistro($dataInsert){
		$this->db->insert('recuperarcontrasenia',$dataInsert);
		$recuperarcontrasenia_id = $this->db->insert_id();
		return $recuperarcontrasenia_id;
	}
	
	public function delete($recuperarcontrasenia_email){
		$this->db->where('recuperarcontrasenia_email',$recuperarcontrasenia_email);
		$this->db->delete('recuperarContrasenia');
		$result = $this->db->affected_rows();
		if($result > 0)
			return 1;
		else return 0;
	}
}
?>