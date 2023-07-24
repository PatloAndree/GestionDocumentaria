<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafico extends CI_Controller {
	public function __construct(){
		parent::__construct();
		// $this->load->helper('url');
        $this->load->helper(array('url','html','form'));
		$this->load->database('db_gc');
		// $this->load->model('especialidades_model');
		// is_logged_admin_in();
	}
	
	public function index(){
		$query =  $this->db->query('SELECT * FROM estados ' );
		$records = $query->result_array();

		$data = [];
		foreach($records as $row) {
        $data[] = ['date' => date('Y-m-t',strtotime($row['date'])), 'count' =>$row['10,20,30,50,50']];
  		
		}
		$data['chart_data'] = json_encode($data);
        $data['titulo'] = "Recetar Pacientes";
		$data['contenido'] = "grafico_view";
		$this->load->view('panel/include/template_view', $data);
	}
   
    public function bar_chart() {
        $query =  $this->db->query('SELECT DATE_FORMAT(login_date, "%Y-%m-%d") AS `date`, 
        COUNT(`login_date`) as count FROM login_history WHERE `login_date` >= NOW() - 
        INTERVAL 10 MONTH GROUP BY MONTH(`login_date`) ORDER BY `login_date` ASC');
        $records = $query->result_array();
        $data = [];
        foreach($records as $row) {
  $data[] = ['date' => date('Y-m-t',strtotime($row['date'])), 'count' =>$row['count']];
        }
        $data['chart_data'] = json_encode($data);
        $this->load->view('bar_chart',$data);
      }  
}
?>