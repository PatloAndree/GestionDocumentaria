<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Requisitos extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			is_logged_admin_in();
		}

		public function index()
		{
			$data['titulo'] = "REQUISITOS";
			$data['contenido'] = "requisitos_view";
			$this->load->view('panel/include/template_view', $data);
		}

        public function download_pdf()
		{
			$this->load->helper('download');             
            $pth    =   file_get_contents(base_url()."src/archivos/01_Requisitos.pdf");
            $nme    =   "Requisitos_Completos.pdf";
            force_download($nme, $pth);   
		}

        public function download_word()
		{
			$this->load->helper('download');             
            $pth    =   file_get_contents(base_url()."src/archivos/02_Atencion.docx");
            $nme    =   "Formato_de_Atención.docx";
            force_download($nme, $pth);   
		}

        public function download_excel()
		{
			$this->load->helper('download');             
            $pth    =   file_get_contents(base_url()."src/archivos/03_Complementarios.xlsx");
            $nme    =   "Datos_Complementarios.xlsx";
            force_download($nme, $pth);   
		}

        public function download_word_2()
		{
			$this->load->helper('download');             
            $pth    =   file_get_contents(base_url()."src/archivos/04_Consentimiento.docx");
            $nme    =   "Consentimiento_Informado.docx";
            force_download($nme, $pth);   
		}
    }