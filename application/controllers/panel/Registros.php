<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registros extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		// $this->load->library('form_validation');
		// $this->load->helper('date');
		$this->load->model('especialidades_model');
		is_logged_admin_in();
	}

	public function index()
	{
		$this->load->model('documentos_model');
		$this->load->model('especialidades_model');
		$documentos = $this->documentos_model->getDocumentos();
		$especialidades =$this->especialidades_model->getEspecialidades();
		$estados =$this->especialidades_model->getEstados();
		$data["documentos"] = $documentos;
		$data["especialidades"] = $especialidades;
		$data["estados"] = $estados;
		// $data['registros-fechare'] = date('d/m/Y');
		$data['titulo'] = "LISTADO DE REGISTROS";
		$data['contenido'] = "registros_view";
		$this->load->view('panel/include/template_view', $data);
	}

	public function getDataDocumento($documento, $num_documento)
	{
        // $this->load->model('reserva_model');
        // $incidencias=$this->reserva_model->getIncidenciasByDocument($num_documento);
        // $sugerencias=$this->reserva_model->getSugerenciasByDocument($num_documento);
        // $clienteFrecuente = $this->reserva_model->getClienteFrecuenteByDocument($num_documento);
		if ($documento == 'DNI') {
			$datosDni = contultaDocumento(1, $num_documento);
            $valor = " ";
			if ($datosDni['success'] == 1) {

				$completo = $datosDni['nombres'] . $valor . $datosDni['apellidoPaterno'] .$datosDni['apellidoMaterno'] ;
			


				echo json_encode(array("datos" => $completo,"valor" => '1'));
			} else {
				echo json_encode(array("datos" => 'Error al obtener el dni', "valor" => '0'));
			}
		} else {
		}
	}		
		
	// 	echo json_encode($response);
	// }

	public function addRegistro(){
			// var_dump($_POST); 
			$this->load->model('registros_model');
			$this->registros_model->setRegistro_id('');
			$usuarioId = $this->session->userdata("usuario_id");
			//añadiendoArchivos2
			$directory_local = 'uploads/pdf/';
			//$directory_local = 'uploads/'.$directorio;
			if (is_dir($directory_local) == FALSE){
				mkdir($directory_local, 0777,true);
			}
			$directorio_archivo = $directory_local. basename($_FILES['registros-formato']['name']);
			move_uploaded_file($_FILES['registros-formato']['tmp_name'], $directorio_archivo);
		
			$dataInsert['usuario_id'] = $usuarioId;
			$dataInsert['registro_fecha'] = $_POST["registros-fechare"];
			$dataInsert['documento_id'] = $_POST["registros-tipodocumento"];
			$dataInsert['numero_dni'] = $_POST["registros-documento"];
			$dataInsert['fechanac'] = $_POST["registros-fechanac"];
			$dataInsert['nombres'] = $_POST["registros-nombre"];
			$dataInsert['telefono'] = $_POST["registros-telefono"];
			$dataInsert['correo'] = $_POST['registros-correo'];
			$dataInsert['especialidad_id'] = $_POST["registros-especialidad"];
			$dataInsert['establecimiento_id'] = $_POST["establecimiento-id"];
			$dataInsert['sexo'] = $_POST["registros-sexo"];
			$dataInsert['formato'] = site_url() . $directorio_archivo;
			$dataInsert['estado_id'] = 2;
			// $dataInsert['formato'] = $this->upload->data($_POST["registros-formato"]);
			$dataInsert['observacion'] = trim($_POST["registros-observa"]);

			$sw_insert = $this->registros_model->addRegistro($dataInsert);
				if ($sw_insert > 0) {
					$response = array("status" =>
					"success", "titulo" => "Éxito", "mensaje"
					=> "Se agrego correctamente el registro", "tipo" => "1");
				} else {
					$response = array("status" => "warning", "titulo" => 
					"Atención", "mensaje" =>
					"Ocurrio un problema, Intentelo nuevamente.", "tipo" => "0");
				}
			
		echo json_encode($response);
	}	

	public function editarRegistro()
	{
		$this->load->model('registros_model');
		$this->load->model('especialidades_model');
		$registro_id = $_POST['registrosEditar-id'];
		$this->registros_model->setRegistro_id($registro_id);
		$datos = $this->registros_model->getRegistrar();
		$usuarioTipo = $this->session->userdata("usuario_tipo");
		$directory_local = 'uploads/pdf/';
		if (is_dir($directory_local) == FALSE){
			mkdir($directory_local, 0777,true);
		}
		if($usuarioTipo == 2){
			$directorio_archivo = $directory_local. basename($_FILES['registrosEdit-format']['name']);
			move_uploaded_file($_FILES['registrosEdit-format']['tmp_name'], $directorio_archivo);
			// exit;
		}
		$name = pathinfo($directorio_archivo, PATHINFO_FILENAME);
		$name2 = pathinfo($directorio_archivo, PATHINFO_EXTENSION);
		// echo("el nombre del archivo -> ".$name ."el de la extension es".$name2);
		// exit;
		$paciente = $_POST["registrosEdit-nombre"];
		$numero =$_POST["establecimientoEditar-id"];
		// $dataUpdate['registrosEdit-idreg'] = $registro_id;
		// $dataUpdate['usuario_id'] = $usuarioId;
		$dataUpdate['registro_fecha'] = $_POST["registrosEdit-fechare"];
		$dataUpdate['documento_id'] = $_POST["registrosEdit-tipodocumento"];
		$dataUpdate['sexo'] = $_POST["registrosEdit-sexo"];
		$dataUpdate['msj_anulado'] = $_POST["registrosEdit-msj_anulado"];
		$dataUpdate['numero_dni'] = $_POST["registrosEdit-nrodocumento"];
		$dataUpdate['fechanac'] = $_POST["registrosEdit-fechanac"];
		$dataUpdate['nombres'] = $paciente;
		$dataUpdate['telefono'] = $_POST["registrosEdit-telefono"];
		$dataUpdate['correo'] = $_POST['registrosEdit-correo'];
		$dataUpdate['especialidad_id'] = $_POST["registrosEdit-especialidad"];
		$dataUpdate['establecimiento_id'] =$numero;
		$dataUpdate['observacion'] = trim($_POST["registrosEdit-observacion"]);
		$dataUpdate['estado_id'] = $_POST["registrosEdit-estado"];
		if($usuarioTipo == 2)
		{
			if($name != "" and $name2 != ""){
				$dataUpdate['formato'] = site_url() . $directorio_archivo;
			}else{

			}
		}
		$ruta = 'uploads/pdf_r/';
		if (is_dir($ruta) == FALSE){
			mkdir($ruta, 0777,true);
		}
		if($usuarioTipo == 1){
			$ruta_archivo = $ruta. basename($_FILES['registrosEdit-resp']['name']);
			move_uploaded_file($_FILES['registrosEdit-resp']['tmp_name'], $ruta_archivo);
		}

		$path = pathinfo($ruta_archivo, PATHINFO_FILENAME);
		$path2 = pathinfo($ruta_archivo, PATHINFO_EXTENSION);

		$dataUpdate['observacion_resp'] = trim($_POST["regis_observacion_resp"]);
		$dataUpdate['fecha_pro'] = $_POST["registrosEdit-fecha_pro"];
		$dataUpdate['hora_pro'] = $_POST["registrosEdit-hora_pro"];
		$dataUpdate['medico_pro'] = $_POST["registrosEdit-medico_pro"];
		$dataUpdate['link_pro'] = $_POST["registrosEdit-link_pro"];
		$dataUpdate['fecha_res'] = $_POST["registrosEdit-fecha_res"];

		if($usuarioTipo == 1)
		{
			if($path != "" and $path2 != ""){
				$dataUpdate['formato_res'] = site_url() . $ruta_archivo;
			}else{

			}
		}
		$sw_insert = $this->registros_model->updateRegistro($dataUpdate);
		if ($sw_insert > 0) {
				$response = array("status" => "success", "titulo" => "Éxito", "mensaje" => "Se actualizo los datos del registro ".$registro_id , "tipo" => "1" , "dataUpda" =>  $dataUpdate);
		} else{
			$response = array("status" => "warning", "titulo" => "Atención", "mensaje" => "Ocurrio un problema, Intentelo nuevamente" .$registro_id , "tipo" => "0");
		} 
		// }
		echo json_encode($response);
	}

	public function getRegistros()
	{
		$this->load->model('Registros_model');
		$usuarioId = $this->session->userdata("usuario_id");
		$usuarioTipo = $this->session->userdata("usuario_tipo");
	
		if($usuarioTipo == 1){
			$registros = $this->Registros_model->getRegistros();

			if ($registros == 0) {
				echo json_encode(array('sindatos' => 'IF'));
			} else {
	
				$dataReturn = array();
				$cont = 0;
				foreach ($registros as $registro) {
						$acciones = '
						<div class="dropdown">
							<a class="dropdown-item editar" data-registroid="'.$registro->registro_id. '" style="cursor:pointer" data-original-title="Editar">
								<i class="fas fa-search"></i>
							</a>
						</div>
						';
					$row['registro_id'] = $registro->registro_id;
					$row['establecimiento_nombre'] = $registro->nombre_establecimiento;
					$row['especialidad_nombre'] = $registro->especialidad_nombre;
					$row['registro_fecha'] = $registro->registro_fecha;
					$row['dni_numero'] = $registro->numero_dni;
					$row['nombres'] = $registro->nombres;
					$row['fechanac'] = $registro->fechanac;
					$row['telefono'] = $registro->telefono;
					$row['correo'] = $registro->correo;
					$row['formato'] = $registro->formato;
					$row['observacion'] = $registro->observacion;
					// $row['estado_nombre'] = $registro->nombre_estado;
						if ($registro->estado_id == "1" ) 
						{
							$row["estado_nombre"] = '<span class="badge badge-pill badge-secondary" >'.$registro->nombre_estado.'</span>'; 	//gris Anulado
						}
						else if ($registro->estado_id == "2") 
						{
							$row["estado_nombre"] = '<span class="badge badge-pill badge-danger">'.$registro->nombre_estado.'</span>'; 		//rojo
						}
						else if ($registro->estado_id == "3") 
						{
							$row["estado_nombre"] = '<span class="badge badge-pill badge-warning">'.$registro->nombre_estado.'</span>'; 	//naranja
						} 
						else if ($registro->estado_id == "4") 
						{
							$row["estado_nombre"] = '<span class="badge badge-pill badge-primary">'.$registro->nombre_estado.'</span>'; 	//azul
						}
						else {
							$row["estado_nombre"] = '<span class="badge badge-pill badge-success">'.$registro->nombre_estado.'</span>'; 	//verde
						
						}
					$row['acciones'] = $acciones;
					$dataReturn[] = $row;
					$cont++;
	
				}
				echo json_encode($dataReturn);
	
			}
		}else{
			$registros = $this->Registros_model->getRegistrosId();
			if ($registros == 0) {
				echo json_encode(array('sindatos' => 'ELSE'));
			} else {
				$dataReturn = array();
				$cont = 0;
				foreach ($registros as $registro) {
						$acciones = '
						<div class="dropdown">
							<a class="dropdown-item editar" data-registroid="'.$registro->registro_id. '" style="cursor:pointer" data-original-title="Editar">
								<i class="fas fa-search"></i>
							</a>
						</div>
						';
					$row['registro_id'] = $registro->registro_id;
					$row['establecimiento_nombre'] = $registro->nombre_establecimiento;
					$row['especialidad_nombre'] = $registro->especialidad_nombre;
					$row['registro_fecha'] = $registro->registro_fecha;
					$row['dni_numero'] = $registro->numero_dni;
					$row['nombres'] = $registro->nombres;
					$row['fechanac'] = $registro->fechanac;
					$row['telefono'] = $registro->telefono;
					$row['correo'] = $registro->correo;
					$row['formato'] = $registro->formato;
					$row['observacion'] = $registro->observacion;
					// $row['estado_nombre'] = $registro->nombre_estado;
						if ($registro->estado_id == "1" ) 
						{
							$row["estado_nombre"] = '<span class="badge badge-pill badge-secondary" >'.$registro->nombre_estado.'</span>'; 	//gris Anulado
						}
						else if ($registro->estado_id == "2") 
						{
							$row["estado_nombre"] = '<span class="badge badge-pill badge-danger">'.$registro->nombre_estado.'</span>'; 		//rojo
						}
						else if ($registro->estado_id == "3") 
						{
							$row["estado_nombre"] = '<span class="badge badge-pill badge-warning">'.$registro->nombre_estado.'</span>'; 	//naranja
						} 
						else if ($registro->estado_id == "4") 
						{
							$row["estado_nombre"] = '<span class="badge badge-pill badge-primary">'.$registro->nombre_estado.'</span>'; 	//azul
						}
						else {
							$row["estado_nombre"] = '<span class="badge badge-pill badge-success">'.$registro->nombre_estado.'</span>'; 	//verde
						
						}
					$row['acciones'] = $acciones;
					$dataReturn[] = $row;
					$cont++;
	
				}
				echo json_encode($dataReturn);
			}
		}
	}

	public function getRegistro()
	{
		$this->load->model('registros_model');
		$tipo = $this->session->userdata("usuario_tipo");
		$registro_id = $_POST['registroid'];
		$this->registros_model->setRegistro_id($registro_id);
		$datos = $this->registros_model->getRegistrar();
		if ($datos) {
			if($datos->estado_id == 1){
				$this->load->model('documentos_model');
				$this->load->model('especialidades_model');
				$documentos = $this->documentos_model->getDocumentos();
				$especialidades =$this->especialidades_model->getEspecialidades();
				$estados =$this->especialidades_model->getEstados();
				$data = [];
				$data["registro"]=$datos;
				$data["estados"] = $estados;
				$data["documentos"] = $documentos;
				$data["especialidades"] = $especialidades;
				$datosRegistros['id_reg'] = $datos->registro_id;
				$datosRegistros['documentoid'] = $datos->documento_id;
				$datosRegistros['estable'] = $datos->establecimiento_id;
				$datosRegistros['fecharegi'] = $datos->registro_fecha;
				$datosRegistros['numerodocumento'] = $datos->numero_dni;
				// if($datos->sexo == 1){
				// 	$sexo = "Masculino";
				// }else{
				// 	$sexo = "Femenino";
				// }
				$datosRegistros['sexo'] = $datos->sexo;
				$datosRegistros['msj_anulado'] = $datos->msj_anulado;
				$datosRegistros['nombres'] = $datos->nombres;
				$datosRegistros['fechanac'] = $datos->fechanac;
				$datosRegistros['telefono'] = $datos->telefono;
				$datosRegistros['correo'] = $datos->correo;
				$datosRegistros['formato'] = $datos->formato;
				$datosRegistros['observacion'] = $datos->observacion;
				$datosRegistros['estado'] = $datos->estado_id;
				$datosRegistros['usuario'] = $datos->usuario_id;
				$datosRegistros['especialidad'] = $datos->especialidad_id;
				$datosRegistros['observacion_resp'] = $datos->observacion_resp;
				$datosRegistros['fehca_pro'] = $datos->fehca_pro;
				$datosRegistros['hora_pro'] = $datos->hora_pro;
				$datosRegistros['medico_pro'] = $datos->medico_pro;
				$datosRegistros['link_pro'] = $datos->link_pro;
				$datosRegistros['formato_Res'] = $datos->formato_res;
				$datosRegistros['fecha_res'] = $datos->fecha_res;
				ob_start();
				$this->load->view('panel/modal/anulado_view', $data);
				$contentHTML = ob_get_contents();
				ob_end_clean();
				// echo $contentHTML ;
				echo json_encode(array("vista" => $contentHTML , "registro" => $datosRegistros ));
				exit;
			}
			else if($datos->estado_id == 2){
				// if ($datos != 0) {
				$this->load->model('documentos_model');
				$this->load->model('especialidades_model');
				$documentos = $this->documentos_model->getDocumentos();
				$especialidades =$this->especialidades_model->getEspecialidades();
				$estados =$this->especialidades_model->getEstados();
				$data = [];
				$data["registro"]=$datos;
				$data["estados"] = $estados;
				$data["documentos"] = $documentos;
				$data["especialidades"] = $especialidades;
				$datosRegistros['id_reg'] = $datos->registro_id;
				$datosRegistros['documentoid'] = $datos->documento_id;
				$datosRegistros['estable'] = $datos->establecimiento_id;
				$datosRegistros['fecharegi'] = $datos->registro_fecha;
				$datosRegistros['numerodocumento'] = $datos->numero_dni;
				$datosRegistros['sexo'] = $datos->sexo;
				$datosRegistros['msj_anulado'] = $datos->msj_anulado;
				$datosRegistros['nombres'] = $datos->nombres;
				$datosRegistros['fechanac'] = $datos->fechanac;
				$datosRegistros['telefono'] = $datos->telefono;
				$datosRegistros['correo'] = $datos->correo;
				$datosRegistros['formato'] = $datos->formato;
				$datosRegistros['observacion'] = $datos->observacion;
				$datosRegistros['estado'] = $datos->estado_id;
				$datosRegistros['usuario'] = $datos->usuario_id;
				$datosRegistros['especialidad'] = $datos->especialidad_id;
				$datosRegistros['observacion_resp'] = $datos->observacion_resp;
				$datosRegistros['fehca_pro'] = $datos->fehca_pro;
				$datosRegistros['hora_pro'] = $datos->hora_pro;
				$datosRegistros['medico_pro'] = $datos->medico_pro;
				$datosRegistros['link_pro'] = $datos->link_pro;
				$datosRegistros['formato_Res'] = $datos->formato_res;
				$datosRegistros['fecha_res'] = $datos->fecha_res;
				ob_start();
				$this->load->view('panel/modal/pendiente_view', $data);
				$contentHTML = ob_get_contents();
				ob_end_clean();
				// echo $contentHTML ;
				echo json_encode(array("vista" => $contentHTML , "registro" => $datosRegistros ));
				exit;
				// echo json_encode($dataReturn);
			}
			else if($datos->estado_id == 3){
				$this->load->model('documentos_model');
				$this->load->model('especialidades_model');
				$documentos = $this->documentos_model->getDocumentos();
				$especialidades =$this->especialidades_model->getEspecialidades();
				$estados =$this->especialidades_model->getEstados();
				$data = [];
				$data["registro"]=$datos;
				$data["estados"] = $estados;
				$data["documentos"] = $documentos;
				$data["especialidades"] = $especialidades;
				$datosRegistros['id_reg'] = $datos->registro_id;
				$datosRegistros['documentoid'] = $datos->documento_id;
				$datosRegistros['estable'] = $datos->establecimiento_id;
				$datosRegistros['fecharegi'] = $datos->registro_fecha;
				$datosRegistros['numerodocumento'] = $datos->numero_dni;
				$datosRegistros['nombres'] = $datos->nombres;
				$datosRegistros['fechanac'] = $datos->fechanac;
				$datosRegistros['telefono'] = $datos->telefono;
				$datosRegistros['correo'] = $datos->correo;
				$datosRegistros['formato'] = $datos->formato;
				$datosRegistros['observacion'] = $datos->observacion;
				$datosRegistros['estado'] = $datos->estado_id;
				$datosRegistros['usuario'] = $datos->usuario_id;
				$datosRegistros['especialidad'] = $datos->especialidad_id;
				$datosRegistros['observacion_resp'] = $datos->observacion_resp;
				$datosRegistros['fehca_pro'] = $datos->fecha_pro;
				$datosRegistros['hora_pro'] = $datos->hora_pro;
				$datosRegistros['medico_pro'] = $datos->medico_pro;
				$datosRegistros['link_pro'] = $datos->link_pro;
				$datosRegistros['formato_Res'] = $datos->formato_Res;
				$datosRegistros['sexo'] = $datos->sexo;
				$datosRegistros['msj_anulado'] = $datos->msj_anulado;
				$datosRegistros['fecha_res'] = $datos->fecha_res;
				ob_start();
				$this->load->view('panel/modal/observado_view', $data);
				// $this->load->view('panel/modal/pendiente_view', $data);
				$contentHTML = ob_get_contents();
				ob_end_clean();
				// echo $contentHTML ;
				echo json_encode(array("vista" => $contentHTML , "registro" => $datosRegistros ));
				exit;
			}
			else if($datos->estado_id == 4){
				$this->load->model('documentos_model');
				$this->load->model('especialidades_model');
				$documentos = $this->documentos_model->getDocumentos();
				$especialidades =$this->especialidades_model->getEspecialidades();
				$estados =$this->especialidades_model->getEstados();
				$data = [];
				$data["registro"]=$datos;
				$data["estados"] = $estados;
				$data["documentos"] = $documentos;
				$data["especialidades"] = $especialidades;
				$datosRegistros['id_reg'] = $datos->registro_id;
				$datosRegistros['documentoid'] = $datos->documento_id;
				$datosRegistros['estable'] = $datos->establecimiento_id;
				$datosRegistros['fecharegi'] = $datos->registro_fecha;
				$datosRegistros['numerodocumento'] = $datos->numero_dni;
				$datosRegistros['sexo'] = $datos->sexo;
				$datosRegistros['msj_anulado'] = $datos->msj_anulado;
				$datosRegistros['nombres'] = $datos->nombres;
				$datosRegistros['fechanac'] = $datos->fechanac;
				$datosRegistros['telefono'] = $datos->telefono;
				$datosRegistros['correo'] = $datos->correo;
				$datosRegistros['formato'] = $datos->formato;
				$datosRegistros['observacion'] = $datos->observacion;
				$datosRegistros['estado'] = $datos->estado_id;
				$datosRegistros['usuario'] = $datos->usuario_id;
				$datosRegistros['especialidad'] = $datos->especialidad_id;
				$datosRegistros['observacion_resp'] = $datos->observacion_resp;
				$datosRegistros['fehca_pro'] = $datos->fecha_pro;
				$datosRegistros['hora_pro'] = $datos->hora_pro;
				$datosRegistros['medico_pro'] = $datos->medico_pro;
				$datosRegistros['link_pro'] = $datos->link_pro;
				$datosRegistros['formato_Res'] = $datos->formato_Res;
				$datosRegistros['fecha_res'] = $datos->fecha_res;
				// $this->load->view('panel/registros/', $data);
				ob_start();
				$this->load->view('panel/modal/programado_view', $data);
				$contentHTML = ob_get_contents();
				ob_end_clean();
				// echo $contentHTML ;
				echo json_encode(array("vista" => $contentHTML , "registro" => $datosRegistros ));
				exit;
			}
			else {
				$this->load->model('documentos_model');
				$this->load->model('especialidades_model');
				$documentos = $this->documentos_model->getDocumentos();
				$especialidades =$this->especialidades_model->getEspecialidades();
				$estados =$this->especialidades_model->getEstados();
				$data = [];
				$data["registro"]=$datos;
				$data["estados"] = $estados;
				$data["documentos"] = $documentos;
				$data["especialidades"] = $especialidades;
				$datosRegistros['id_reg'] = $datos->registro_id;
				$datosRegistros['documentoid'] = $datos->documento_id;
				$datosRegistros['estable'] = $datos->establecimiento_id;
				$datosRegistros['fecharegi'] = $datos->registro_fecha;
				$datosRegistros['numerodocumento'] = $datos->numero_dni;
				$datosRegistros['sexo'] = $datos->sexo;
				$datosRegistros['msj_anulado'] = $datos->msj_anulado;
				$datosRegistros['nombres'] = $datos->nombres;
				$datosRegistros['fechanac'] = $datos->fechanac;
				$datosRegistros['telefono'] = $datos->telefono;
				$datosRegistros['correo'] = $datos->correo;
				$datosRegistros['formato'] = $datos->formato;
				$datosRegistros['observacion'] = $datos->observacion;
				$datosRegistros['estado'] = $datos->estado_id;
				$datosRegistros['usuario'] = $datos->usuario_id;
				$datosRegistros['especialidad'] = $datos->especialidad_id;
				$datosRegistros['observacion_resp'] = $datos->observacion_resp;
				$datosRegistros['fehca_pro'] = $datos->fecha_pro;
				$datosRegistros['hora_pro'] = $datos->hora_pro;
				$datosRegistros['medico_pro'] = $datos->medico_pro;
				$datosRegistros['link_pro'] = $datos->link_pro;
				$datosRegistros['formato_Res'] = $datos->formato_Res;
				$datosRegistros['fecha_res'] = $datos->fecha_res;
				// $this->load->view('panel/registros/', $data);
				ob_start();
				$this->load->view('panel/modal/atendido_view', $data);
				$contentHTML = ob_get_contents();
				ob_end_clean();
				// echo $contentHTML ;
				echo json_encode(array("vista" => $contentHTML , "registro" => $datosRegistros ));
				exit;
			}
					
		}
		// echo json_encode($dataReturn);
	}

	// public function eliminar($registros_id)
	// {
	// 	$this->load->model('registross_model');
	// 	$this->registross_model->setUsuario_id($registros_id);
	// 	$dataDelete["registros_estado"] = "0";

	// 	$result = $this->registross_model->deleteUsuario($dataDelete);
	// 	if ($result == 1) {
	// 		$response = array("status" => "success", "titulo" => "Éxito", "mensaje" => "Se elimnino correctamente el registros ", "tipo" => "1");
	// 	} else {
	// 		$response = array("status" => "warning", "titulo" => "Atención", "mensaje" => "Ocurrio un problema, Intentelo nuevamente.)", "tipo" => "0");
	// 	}

	// 	echo json_encode($response);
	// }

	public function estableList(){
		$postData = $this->input->post();
		$data = $this->especialidades_model->getEstablecimientos($postData);
		echo json_encode($data);
	}


}

