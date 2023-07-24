<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Documentos_model extends CI_Model {

	var $documento_id;
	function setDocumento_id($documento_id){
		$this->documento_id=$documento_id;
	}


	function getDocumentos(){
		$this->db->where('documento_estado',1);
		$documentos=$this->db->get("documentos");
		if($documentos->num_rows()>0){
			return $documentos->result();
		}else{
			return 0;
		}
    }
    
    /*
	function addDocumento($dataInsert){
		if ($this->db->insert('documentos',$dataInsert)) {
            return $this->db->insert_id();
        }else{
            return '0';
        }
	}

	function updateDocumento($dataUpdate){
		$this->db->where('documento_id',$this->documento_id);

		if ($this->db->update('documentos',$dataUpdate)) {
            return 1;
        }else{
            return 0;
        }
	}
	
	function verificarNombreDocumento($nombre){
		if(trim($this->documento_id)!=''){
			$this->db->where('documento_id!=',$this->documento_id);
		}
		$this->db->where('documento_nombre',$nombre);
		$documentos=$this->db->get('documentos');
		
		if($documentos->num_rows()>0){
			return 0;
		}else{
			return 1;
		}
	}
    */
}
