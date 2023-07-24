<?php
defined('BASEPATH') or exit('No direct script access allowed');

require __DIR__ . '../../../../vendor/autoload.php';

use Dompdf\Dompdf;

class Reportes extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_admin_in();


	}
	public function index()
	{
		$data['titulo'] = "REPORTES";
		$data['contenido'] = "reporte_productividad_view";
		$this->load->view('panel/include/template_view', $data);
	}

	public function servicios()
	{
		$data['titulo'] = "Recetar Pacientes";
		$data['contenido'] = "reporte_servicios_view";
		$this->load->view('panel/include/template_view', $data);
	}


	public function getReportes($desde, $hasta , $estado="")
	{
		$this->load->model('ventas_model');
		$cantidades = $this->ventas_model->getRegistros($desde, $hasta , $estado);
	
		if($cantidades[0]->estado_id == 1 AND $estado != "")
		{
			$contador=1;
			$html = '
				<!DOCTYPE html>
				<html>
					<title>Reporte de Registros</title>
					
				<head>
					<style>
						table{
							font-family: arial,sans-serif;
							border-collapse: collapse;
							page-break-inside: auto;
							width: 100%;
						}
						.t01 {
							background-color: #f49d2dc9;
							color: white;
						  }
						td, th{
							border: 1px solid #034999;
							text-align: center;
							padding: 8px;
							font-size: 10px;
						}
						tr:nth-child(even){
							background-color: #EEEEEE;
						}
						.logo{
							width: 200px;
							margin-left:72%;
							margin-top:-8%;
						}
						h2{
							text-align: center;
						}
						.green{
							color: #90c564;
							font-weight: bold;
						}
						.red{
							color: #2B4865;
							font-weight: bold;
							background-color: #FFEBFF;
						}
						.yellow{
							background-color: #FFFF00;
						}
					</style>
				</head>
				<body>
					<h2> TELEINTERCONSULTA - REPORTE DE REGISTROS - ANULADOS</h2>
					<table>					
						<tr>
							<th>#</th>
							<th>FECHA DE SOLICITUD</th>
							<th>IPRESS SOLICITANTE</th>
							<th>NOMBRES PACIENTE</th>
							<th>SEXO</th>
							<th>DNI</th>
							<th>CNV-CUI</th>
							<th>FECHA DE INTERCONSULTA</th>
							<th>ESPECIALIDAD SOLICITADA</th>
							<th>PROFESIONAL ASIGNADO</th>
							<th>ESTADO</th>
							<th>MOTIVO</th>
						</tr>';
		
			foreach ($cantidades as $registro) {
				if($registro->sexo == "1"){
					$sexo = "Masculino";
				}else{
					$sexo = "Femenino";
				}
				$html .= '<tr>
							<th>'.$contador .'</th>
							<th>'. $registro->registro_fecha.'</th>
							<th>'. $registro->nombre_establecimiento.'</th>
							<th>'. $registro->nombres.'</th>
							<th>'. $sexo.'</th>
							<th>'. $registro->numero_dni.'</th>
							<th> - </th>
							<th>'. $registro->fecha_pro.'</th>
							<th>'. $registro->especialidad_nombre.'</th>
							<th>'. $registro->medico_pro.'</th>
							<th class="red">'. $registro->nombre_estado.'</th>
							<th class="yellow">'. $registro->msj_anulado.'</th>
							
							
						</tr> ';
				$contador++;						
			}
		}
		
		else if ($cantidades[0]->estado_id == 2 AND $estado != ""){
			$contador=1;
			$html = '
				<!DOCTYPE html>
				<html>
					<title>Reporte de Registros</title>
					
				<head>
					<style>
						table{
							font-family: arial,sans-serif;
							border-collapse: collapse;
							page-break-inside: auto;
							width: 100%;
						}
						.t01 {
							background-color: #f49d2dc9;
							color: white;
						  }
						td, th{
							border: 1px solid #034999;
							text-align: center;
							padding: 8px;
							font-size: 10px;
						}
						tr:nth-child(even){
							background-color: #FFEBFF;
						}
						.logo{
							width: 200px;
							margin-left:72%;
							margin-top:-8%;
						}
						h2{
							text-align: center;
						}
						.green{
							color: #90c564;
							font-weight: bold;
						}
						.yellow{
							color: #2B4865;
							font-weight: bold;
							background-color: #FFE699;
						}
						.red{
							color: #2B4865;
							font-weight: bold;
							background-color: #FFEBFF;
						}
					</style>
				</head>
				<body>
					<h2> TELEINTERCONSULTA - REPORTE DE REGISTROS - PENDIENTES</h2>
					<table>					
						<tr>
							<th>#</th>
							<th>FECHA DE SOLICITUD</th>
							<th>IPRESS SOLICITANTE</th>
							<th>NOMBRES PACIENTE</th>
							<th>SEXO</th>
							<th>DNI</th>
							<th>CNV-CUI</th>
							<th>FECHA DE INTERCONSULTA</th>
							<th>ESPECIALIDAD SOLICITADA</th>
							<th>PROFESIONAL ASIGNADO</th>
							<th>ESTADO</th>
						</tr>';
			
			foreach ($cantidades as $registro) {
				
				if($registro->sexo == "1"){
					$sexo = "Masculino";
				}else{
					$sexo = "Femenino";
				}
				$html .= '<tr>
							<th>'.$contador .'</th>
							<th>'. $registro->registro_fecha.'</th>
							<th>'. $registro->nombre_establecimiento.'</th>
							<th>'. $registro->nombres.'</th>
							<th>'. $sexo.'</th>
							<th>'. $registro->numero_dni.'</th>
							<th> - </th>
							<th>'. $registro->fecha_pro.'</th>
							<th class="yellow">'. $registro->especialidad_nombre.'</th>
							<th>'. $registro->medico_pro.'</th>
							<th class="red">'. $registro->nombre_estado.'</th>
						</tr> ';
				$contador++;						
			}
		}
		
		else if ($cantidades[0]->estado_id == 3 AND $estado != ""){
			$contador=1;
			$html = '
				<!DOCTYPE html>
				<html>
					<title>Reporte de Registros</title>
					
				<head>
					<style>
						table{
							font-family: arial,sans-serif;
							border-collapse: collapse;
							page-break-inside: auto;
							width: 100%;
						}
						.t01 {
							background-color: #f49d2dc9;
							color: white;
						  }
						td, th{
							border: 1px solid #034999;
							text-align: center;
							padding: 8px;
							font-size: 10px;
						}
						tr:nth-child(even){
							background-color: #EEEEEE;
						}
						.logo{
							width: 200px;
							margin-left:72%;
							margin-top:-8%;
						}

						h2{
							text-align:center;
						}
						.green{
							color: #90c564;
							font-weight: bold;
						}
						.yellow{
							color: #2B4865;
							font-weight: bold;
							background-color: #FFE699;
						}
						.yello{
							background-color: #FFFF00;
						}
					</style>
				</head>
				<body>
					<h2> TELEINTERCONSULTA - REPORTE DE REGISTROS - OBSERVADO</h2>
					<table>					
						<tr>
							<th>#</th>
							<th>FECHA DE SOLICITUD</th>
							<th>IPRESS SOLICITANTE</th>
							<th>NOMBRES PACIENTE</th>
							<th>SEXO</th>
							<th>DNI</th>
							<th>CNV-CUI</th>
							<th>FECHA DE INTERCONSULTA</th>
							<th>ESPECIALIDAD SOLICITADA</th>
							<th>PROFESIONAL ASIGNADO</th>
							<th>ESTADO</th>
							<th>MOTIVO</th>

						</tr>';
			
			foreach ($cantidades as $registro) {
				if($registro->sexo == "1"){
					$sexo = "Masculino";
				}else{
					$sexo = "Femenino";
				}
				$html .= '<tr>
							<th>'.$contador .'</th>
							<th>'. $registro->registro_fecha.'</th>
							<th>'. $registro->nombre_establecimiento.'</th>
							<th>'. $registro->nombres.'</th>
							<th>'. $sexo.'</th>
							<th>'. $registro->numero_dni.'</th>
							<th> - </th>
							<th>'. $registro->fecha_pro.'</th>
							<th class="yellow">'. $registro->especialidad_nombre.'</th>
							<th>'. $registro->medico_pro.'</th>
							<th class="red">'. $registro->nombre_estado.'</th>
							<th class="yello">'. $registro->observacion_resp.'</th>

						</tr> ';
				$contador++;						
				
			}

		}
		
		else if($cantidades[0]->estado_id == 4 AND $estado != ""){
			$contador=1;
			$html = '
				<!DOCTYPE html>
				<html>
					<title>Reporte de Registros</title>
					
				<head>
					<style>
						table{
							font-family: arial,sans-serif;
							border-collapse: collapse;
							page-break-inside: auto;
							width: 100%;
						}
						.t01 {
							background-color: #f49d2dc9;
							color: white;
						  }
						td, th{
							border: 1px solid #034999;
							text-align: center;
							padding: 8px;
							font-size: 10px;
						}
						tr:nth-child(even){
							background-color: #EEEEEE;
						}
						.logo{
							width: 200px;
							margin-left:72%;
							margin-top:-8%;
						}
						.titulo{
							color: #953793;
						}
						h2{
							text-align:center;
						}
						.green{
							color: #90c564;
							font-weight: bold;
						}
						.yellow{
							color: #2B4865;
							font-weight: bold;
							background-color: #FFE699;
						}
						.rojo{
							background-color: #FFEBFF;
						}
					</style>
				</head>
				<body>
					<h2> TELEINTERCONSULTA - REPORTE DE REGISTROS - PROGRAMADO</h2>
					<table>					
						<tr>
							<th>#</th>
							<th>FECHA DE SOLICITUD</th>
							<th>IPRESS SOLICITANTE</th>
							<th>NOMBRES PACIENTE</th>
							<th>SEXO</th>
							<th>DNI</th>
							<th>CNV-CUI</th>
							<th>FECHA CITA DE INTERCONSULTA</th>
							<th>ESPECIALIDAD SOLICITADA</th>
							<th>PROFESIONAL ASIGNADO</th>
							<th>ESTADO</th>
						</tr>';
			
	
			
			
			foreach ($cantidades as $registro) {
				if($registro->sexo == "1"){
					$sexo = "Masculino";
				}else{
					$sexo = "Femenino";
				}
				$html .= '<tr>
							<th>'.$contador .'</th>
							<th>'. $registro->registro_fecha.'</th>
							<th>'. $registro->nombre_establecimiento.'</th>
							<th>'. $registro->nombres.'</th>
							<th>'. $sexo.'</th>
							<th>'. $registro->numero_dni.'</th>
							<th> - </th>
							<th>'. $registro->fecha_pro.'</th>
							<th class="yellow">'. $registro->especialidad_nombre.'</th>
							<th>'. $registro->medico_pro.'</th>
							<th class="red">'. $registro->nombre_estado.'</th>
						</tr> ';
				$contador++;						
			}
		}
		
		else if($cantidades[0]->estado_id == 5 AND $estado != ""){
			$contador=1;
			$html = '
				<!DOCTYPE html>
				<html>
					<title>Reporte de Registros</title>
					
				<head>
					<style>
						table{
							font-family: arial,sans-serif;
							border-collapse: collapse;
							page-break-inside: auto;
							width: 100%;
						}
						.t01 {
							background-color: #f49d2dc9;
							color: white;
						  }
						td, th{
							border: 1px solid #034999;
							text-align: center;
							padding: 8px;
							font-size: 10px;
						}
						tr:nth-child(even){
							background-color: #EEEEEE;
						}
						.logo{
							width: 200px;
							margin-left:72%;
							margin-top:-8%;
						}
						.titulo{
							color: #953793;
						}
						.green{
							color: #90c564;
							font-weight: bold;
						}
						.yellow{
							color: #2B4865;
							font-weight: bold;
							background-color: #FFE699;
						}h2{
							text-align:center;
						}
						.rojo{
							background-color: #FFEBFF;
						}
					</style>
				</head>
				<body>
					<h2> TELEINTERCONSULTA - REPORTE DE REGISTROS - ATENDIDO</h2>
					<table>					
						<tr>
							<th>#</th>
							<th>FECHA DE SOLICITUD</th>
							<th>IPRESS SOLICITANTE</th>
							<th>NOMBRES PACIENTE</th>
							<th>SEXO</th>
							<th>DNI</th>
							<th>CNV-CUI</th>
							<th>FECHA DE INTERCONSULTA</th>
							<th>ESPECIALIDAD SOLICITADA</th>
							<th>PROFESIONAL ASIGNADO</th>
							<th>ESTADO</th>
							<th>FECHA ENVIO FORMATO RESPUESTA</th>

						</tr>';
			foreach ($cantidades as $registro) {
				if($registro->sexo == "1"){
					$sexo = "Masculino";
				}else{
					$sexo = "Femenino";
				}

				$html .= '<tr>
							<th>'.$contador .'</th>
							<th>'. $registro->registro_fecha.'</th>
							<th>'. $registro->nombre_establecimiento.'</th>
							<th>'. $registro->nombres.'</th>
							<th>'. $sexo.'</th>
							<th>'. $registro->numero_dni.'</th>
							<th> - </th>
							<th>'. $registro->fecha_pro.'</th>
							<th class="yellow">'. $registro->especialidad_nombre.'</th>
							<th>'. $registro->medico_pro.'</th>
							<th class="red">'. $registro->nombre_estado.'</th>
							<th class="red">'. $registro->fecha_res.'</th>
							
						</tr> ';
				$contador++;
			}

		}
		else {
			$contador=1;
			$html = '
			<!DOCTYPE html>
				<html>
					<title>Reporte de Registros</title>
					
					<head>
					<style>
						table{
							font-family: arial,sans-serif;
							border-collapse: collapse;
							page-break-inside: auto;
							width: 100%;
						}
						.t01 {
							background-color: #f49d2dc9;
							color: white;
						}
						td, th{
							border: 1px solid #034999;
							text-align: center;
							padding: 8px;
							font-size: 10px;
						}
						tr:nth-child(even){
							background-color: #EEEEEE;
						}
						.logo{
							width: 200px;
							margin-left:72%;
							margin-top:-8%;
						}
						.titulo{
							color: #953793;
						}
						.green{
							color: #90c564;
							font-weight: bold;
						}
						.yellow{
							color: #2B4865;
							font-weight: bold;
							background-color: #FFE699;
						}
						.rojo{
							background-color: #FFEBFF;
						}
					</style>
				</head>
				<body>
					<h2> TELEINTERCONSULTA - REPORTE DE REGISTROS - GENERAL</h2>
				<table>					
					<tr>
							<th>#</th>
							<th>FECHA DE SOLICITUD</th>
							<th>IPRESS SOLICITANTE</th>
							<th>NOMBRES PACIENTE</th>
							<th>SEXO</th>
							<th>DNI</th>
							<th>CNV-CUI</th>
							<th>FECHA DE INTERCONSULTA</th>
							<th>ESPECIALIDAD SOLICITADA</th>
							<th>PROFESIONAL ASIGNADO</th>
							<th>ESTADO</th>
					</tr>';
		
			foreach ($cantidades as $registro) {
				if($registro->sexo == "1"){
					$sexo = "Masculino";
				}else{
					$sexo = "Femenino";
				}
				$html .= '<tr>
							<th>'.$contador .'</th>
							<th>'. $registro->registro_fecha.'</th>
							<th>'. $registro->nombre_establecimiento.'</th>
							<th>'. $registro->nombres.'</th>
							<th>'. $sexo.'</th>
							<th>'. $registro->numero_dni.'</th>
							<th> - </th>
							<th>'. $registro->fecha_pro.'</th>
							<th class="yellow">'. $registro->especialidad_nombre.'</th>
							<th>'. $registro->medico_pro.'</th>
							<th class="red">'. $registro->nombre_estado.'</th>
						</tr> ';
				$contador++;
			}
	}
		$html .= '
			</table>
			</body>
			</html>';

		define("DOMPDF_ENABLE_REMOTE", true);
		$dompdf = new Dompdf();
		$dompdf->set_option('isRemoteEnabled', true);
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->render();
		$dompdf->stream("ReporteProductividad.pdf", array('Attachment' => 0));
	}

	
}


// <th>FECHA-SOLICITUD</th>
// <th>IPRESS SOLICITANTE</th>
// <th>NOMBRES</th>
// <th>SEXO</th>

// <th>11-12-2022</th>
// <th class="yellow">DERMATOLOGIA</th>
// <th>FAUSTINO SANCHEZ CARRIÓN</th>
// <th class="rojo">PENDIENTE</th>
// $this->load->view('reporte_productividad_view',$data);
