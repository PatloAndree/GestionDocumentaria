<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function toURL($str, $replace = array(), $delimiter = '-')
{
	setlocale(LC_ALL, 'en_US.UTF8');
	if (!empty($replace)) {
		$str = str_replace((array)$replace, ' ', $str);
	}

	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
	$clean = trim($clean);

	return $clean;
}

function get_value($table, $field, $value, $var_result)
{
	$CI = &get_instance();
	$CI->load->database();
	//$CI->db->select( $var_result );
	$query = $CI->db->from($table);
	$CI->db->where($field . " =", $value);
	$obj = $CI->db->get();
	$data = $obj->result();
	$id = "";
	if ($obj->num_rows() >= 1) {
		foreach ($data as $row) {
			$id = $row->$var_result;
		}
	}
	return $id;
}

function calcular_edad($fechanacimiento)
{
	list($ano, $mes, $dia) = explode("-", $fechanacimiento);
	$ano_diferencia  = date("Y") - $ano;
	$mes_diferencia = date("m") - $mes;
	$dia_diferencia   = date("d") - $dia;
	if ($dia_diferencia < 0 || $mes_diferencia < 0)
		$ano_diferencia--;
	return $ano_diferencia;
}

function generateLetterString($length = 4)
{
	$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function generateLetterStringMinusculas($length = 4)
{
	$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function get_zero($numero, $tamannio)
{
	$cantZeros = $tamannio - strlen($numero);
	$zeros = str_repeat("0", $cantZeros);
	return $zeros . $numero;
}

function get_generales()
{
	$CI = &get_instance();
	$CI->load->database();
	$generales = $CI->db->get('generales');
	return $generales->row();
}

function send_mail_recuperar_pasword($correo, $dataView)
{
	$ci = &get_instance();
	$ci->load->library('email');
	$generales = get_generales();

	$config = array(
		'protocol' => 'ssmtp',
		'smtp_host' => 'ssl://ssmtp.googlemail.com',
		'smtp_port' => 465,
		'smtp_user' => EMAIL_TEST, // change it to yours
		'smtp_pass' => EMAIL_PASS, // change it to yours
		'mailtype' => 'html', // it can be text or html
		'wordwrap' => TRUE,
		'newline' => "\r\n",
		'charset' => 'utf-8',
	);

	$ci->email->initialize($config);
	$ci->email->from(EMAIL_TEST, EMAIL_COMERCIAL);
	$ci->email->to($correo);
	$ci->email->subject('Contraseña restaurada exitosamente.');
	$data['titulo'] = 'nombre ' . ', gracias por registrarse.';
	$data['nombreEmpresa'] = $generales->general_razonsocial;
	$data['mensajeadicional'] = "Hemos procedido a generarle una contraseña aleatoria <strong>constraseña</strong> podras acceder a nuestra plataforma ingresando tu correo y la contraseña.";
	$mensaje = $ci->load->view('email/micuenta_recuperar_pasword', $dataView, TRUE);
	$ci->email->message($mensaje);
	$send = $ci->email->send();
}

function send_mail_contactanos($correo, $dataView)
{
	$ci = &get_instance();
	$ci->load->library('email');
	$generales = get_generales();

	$config = array(
		'protocol' => 'ssmtp',
		'smtp_host' => 'ssl://ssmtp.googlemail.com',
		'smtp_port' => 465,
		'smtp_user' => EMAIL_TEST, // change it to yours
		'smtp_pass' => EMAIL_PASS, // change it to yours
		'mailtype' => 'html', // it can be text or html
		'wordwrap' => TRUE,
		'newline' => "\r\n",
		'charset' => 'utf-8',
	);

	$ci->email->initialize($config);
	$ci->email->from(EMAIL_TEST, EMAIL_COMERCIAL);
	$ci->email->to($correo);
	$ci->email->subject($dataView['titulo']);
	$mensaje = $ci->load->view('email/mensaje_view', $dataView, TRUE);
	$ci->email->message($mensaje);

	@$ci->email->send();
}

function send_mail_registro_cliente($correo, $dataView)
{
	$ci = &get_instance();
	$ci->load->library('email');
	$generales = get_generales();

	$config = array(
		'protocol' => 'ssmtp',
		'smtp_host' => 'ssl://ssmtp.googlemail.com',
		'smtp_port' => 465,
		'smtp_user' => EMAIL_TEST, // change it to yours
		'smtp_pass' => EMAIL_PASS, // change it to yours
		'mailtype' => 'html', // it can be text or html
		'wordwrap' => TRUE,
		'newline' => "\r\n",
		'charset' => 'utf-8',
	);

	$ci->email->initialize($config);
	$ci->email->from(EMAIL_TEST, EMAIL_COMERCIAL);
	$ci->email->to($correo);
	$ci->email->subject('Registro exitoso.');
	$data['titulo'] = 'nombre ' . ', gracias por registrarse.';
	$data['nombreEmpresa'] = $generales->general_razonsocial;
	$data['mensajeadicional'] = "Hemos procedido a generarle una contraseña aleatoria <strong>constraseña</strong> podras acceder a nuestra plataforma ingresando tu correo y la contraseña.";
	$mensaje = $ci->load->view('email/welcome', $dataView, TRUE);
	$ci->email->message($mensaje);
	@$ci->email->send();
}

function send_detalle_transaccion($dataView)
{
	$ci = &get_instance();
	$ci->load->library('email');

	$generales = get_generales();

	$config = array(
		'protocol' => 'ssmtp',
		'smtp_host' => 'ssl://ssmtp.googlemail.com',
		'smtp_port' => 465,
		'smtp_user' => EMAIL_TEST, // change it to yours
		'smtp_pass' =>  EMAIL_PASS, // change it to yours
		'mailtype' => 'html', // it can be text or html
		'wordwrap' => TRUE,
		'newline' => "\r\n",
		'charset' => 'utf-8',
	);

	$ci->email->initialize($config);
	$ci->email->from(EMAIL_TEST, EMAIL_COMERCIAL);
	$ci->email->to($dataView['correo']);
	$ci->email->subject($dataView['asunto']);

	$mensaje = $ci->load->view('email/carrito_view', $dataView, TRUE);
	$ci->email->message($mensaje);
	@$ci->email->send();
}

function enviarCotizacion($codigoReferencia)
{
	$ci = &get_instance();
	$ci->load->model('cotizaciones_model');
	$ci->cotizaciones_model->setCodigoReferencia($codigoReferencia);
	$cotizacion = $ci->cotizaciones_model->getDataCotizacion();
	$ci->cotizaciones_model->setcotizacion_id($cotizacion->cotizacion_id);
	$cotizacionDetalles = $ci->cotizaciones_model->getDetalleCotizacion();

	$dataEmail['nombres_clientes'] = $cotizacion->cliente_nombres;
	$dataEmail['titulo'] = 'tu cotización fue realizada exitosamente.';
	$dataEmail['apellidos_clientes'] = $cotizacion->cliente_apellidos;
	$dataEmail['correo'] = $cotizacion->cliente_correo;
	$dataEmail['asunto'] = 'Cotización realiza correctamente.';
	$dataEmail['productos'] = $cotizacionDetalles;

	//send_detalle_transaccion($dataEmail);

}

function getDocumentos()
{
	$ci = &get_instance();
	$ci->load->model('documentos_model');
	$documentos = $ci->documentos_model->getDocumentos();

	return $documentos;
}

function is_logged_admin_in()
{
	$ci = &get_instance();
	$ci->load->library('session');
	$is_logged_in = $ci->session->userdata('is_logged_admin_in');
	if (!isset($is_logged_in) || $is_logged_in != TRUE) {
		redirect(base_url());
	}
}
function is_logged_admin_in_super()
{
	$ci = &get_instance();
	$ci->load->library('session');
	$is_logged_in = $ci->session->userdata('is_logged_admin_in');
	if ((!isset($is_logged_in) || $is_logged_in != TRUE || $ci->session->userdata('usuario_tipo') != 1)) {
		redirect(base_url());
	}
}

function is_admin()
{
	$ci = &get_instance();
	$ci->load->library('session');
	$is_admin = $ci->session->userdata('usuario_tipo');
	if ($is_admin == 2) {
		redirect(base_url() . 'administrador/panel');
		exit();
	}
}

function is_logged_cliente_in()
{
	$ci = &get_instance();
	$ci->load->library('session');
	$is_logged_in = $ci->session->userdata('is_logged_cliente_in');
	if (!isset($is_logged_in) || $is_logged_in != TRUE) {
		redirect(base_url());
	}
}

function send_mail_ses($to, $from, $subject, $content, $bcc = '', $attachments = array(), $replyTo = '')
{
	require 'vendor/autoload.php';
	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 0;                                 // Enable verbose debug output	(2) show errors
		$mail->CharSet = 'UTF-8';
		$mail->isSMTP();                                   // Set mailer to use SMTP
		$mail->Host = 'mail.princabsac.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = EMAIL_TEST;                 // SMTP username
		$mail->Password = EMAIL_PASS;                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                    // TCP port to connect to
		$mail->Sender = EMAIL_TEST;
		$mail->From = EMAIL_TEST;

		$mail->DKIM_domain = 'princabsac.com';
		$mail->DKIM_private = '';
		$mail->DKIM_selector = '';
		$mail->DKIM_passphrase = '';
		$mail->DKIM_identity = '@princabsac.com';

		$mail->isHTML(true);                                  // Set email format to HTML

		if (is_array($to)) {
			foreach ($to as $destinatarios) {
				$mail->addAddress($destinatarios);     // Add a recipient
			}
		} else {
			$mail->addAddress($to);
		}

		$mail->setFrom($from, 'FromPrueba');

		//  CON COPIA OCULTA
		if (trim($bcc) != '') {
			$mail->addBCC($bcc);
		}
		//  RESPONDER EMAIL A:


		if (trim($replyTo) != '') {
			$mail->addReplyTo($replyTo);
		}

		//  ARCHIVOS ADJUNTOS
		if (count($attachments) > 0) {  //  Hay archivos adjuntos
			foreach ($attachments as $attach) {
				$mail->addAttachment($attach['file'], $attach['name'], 'base64', $attach['mime']);         // Add attachments
			}
		}

		//Content
		$mail->Subject = $subject;
		$mail->Body    = $content;
		$envio = $mail->send();
	} catch (Exception $e) {
		//echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		return false;
	}
}


function contultaDocumento($tipo, $numero)
{ //1 DNI //2 RUC

	//APIS PERÚ 
	//MIGO PERÚ
	$tokenMigo = TOKEN_MIGOPERU;

	if ($tipo == 1) { // DNI
		//APIS PERÚ DNI
		//https://dniruc.apisperu.com/api/v1/ruc/20131312955?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNhcmxvc3phdmFsZXRhcmFtaXJlekBnbWFpbC5jb20ifQ.A-7RcIU3fDpT_KuqU7f51kLyCXjTOErfJZ0XLCl3hGU
		$url = "https://dniruc.apisperu.com/api/v1/dni/" . $numero . "?token=" . TOKEN_APISPERU;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$res = curl_exec($ch);
		curl_close($ch);


		$respuesta = json_decode($res);


		if (isset($respuesta->dni) && isset($respuesta->nombres) && isset($respuesta->apellidoPaterno) && isset($respuesta->apellidoMaterno)) {
			$datos['success'] = 1;
			$datos['dni'] = $respuesta->dni;
			$datos['nombres'] = $respuesta->nombres;
			$datos['apellidoPaterno'] = $respuesta->apellidoPaterno;
			$datos['apellidoMaterno'] = $respuesta->apellidoMaterno;
		} else { // MIGOPERÚ DNI

			$url = URLDNI_MIGOPERU;
			$dataSend = array(
				"token"	=> $tokenMigo,
				"dni"   => $numero
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $dataSend);
			$res = curl_exec($ch);
			curl_close($ch);

			$respuesta = json_decode($res);


			if (isset($respuesta->nombre) && $respuesta->success == 1) {
				$respuestaExpo = explode(" ", $respuesta->nombre);
				$datos['success'] = 1;
				$datos['dni'] = $respuesta->dni;
				$nombres = '';
				$countF = 1;
				foreach ($respuestaExpo as $expo) {
					if ($countF == 1) {
						$datos['apellidoPaterno'] = $expo;
					} else if ($countF == 2) {
						$datos['apellidoMaterno'] = $expo;
					} else {
						if ($countF == 3) {
							$nombres .= $nombres . $expo;
						} else {
							$nombres .= ' ' . $expo;
						}
					}
					$countF++;
				}

				$datos['nombres'] = $nombres ;
			} else {
				$datos['success'] = 0;
			}
		}


		return $datos;
	} else if ($tipo == 2) { // RUC
		//https://dniruc.apisperu.com/api/v1/dni/12345678?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNhcmxvc3phdmFsZXRhcmFtaXJlekBnbWFpbC5jb20ifQ.A-7RcIU3fDpT_KuqU7f51kLyCXjTOErfJZ0XLCl3hGU
		$url = "https://dniruc.apisperu.com/api/v1/ruc/" . $numero . "?token=" . TOKEN_APISPERU;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$res = curl_exec($ch);
		curl_close($ch);


		$respuesta = json_decode($res);

		//$prueba=1;
		if (isset($respuesta->ruc) && isset($respuesta->razonSocial)) {
			$datos['success'] = 1;
			$datos['ruc'] = $respuesta->ruc;
			$datos['razonSocial'] = $respuesta->razonSocial;
			$datos['nombreComercial'] = $respuesta->nombreComercial;
			$datos['estado'] = $respuesta->estado;
			$datos['condicion'] = $respuesta->condicion;

			$datos['direccion'] = $respuesta->direccion . ' - ' . $respuesta->departamento . ' ' . $respuesta->provincia . ' ' . $respuesta->distrito;
		} else {

			$url = URLRUC_MIGOPERU;
			$dataSend = array(
				"token"	=> $tokenMigo,
				"ruc"   => $numero
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $dataSend);
			$res = curl_exec($ch);
			curl_close($ch);

			$respuesta = json_decode($res);

			if (isset($respuesta->success) && $respuesta->success == 1) {
				$datos['success'] = 1;
				$datos['ruc'] = $respuesta->ruc;
				$datos['razonSocial'] = $respuesta->nombre_o_razon_social;
				$datos['nombreComercial'] = $respuesta->nombre_o_razon_social;
				$datos['estado'] = $respuesta->estado_del_contribuyente;
				$datos['condicion'] = $respuesta->condicion_de_domicilio;

				$datos['direccion'] = $respuesta->direccion;
			} else {
				$datos['success'] = 0;
			}
		}

		return $datos;
	} else {	//ERROR
		$datos['success'] = 0;
	}
}

