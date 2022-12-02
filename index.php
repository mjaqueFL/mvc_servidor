<?php
	/**
		Fachada de la aplicación.

		Carga la configuración.
		Ejecuta los Middlewares:
			- Identificación del usuario
			- Lectura de parámetros de petición
		Realiza el Routing
			- Carga el Controlador pedido
			- Llama a su método
		Controla errores
	**/

	//Cargamos la configuración
	$config = require_once('config.php');
	if ($config['debug']){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	}

	try{
		//MIDDLEWAREs
		//Identificación del usuario
		$usuario = null;
		session_start();
		if (isset($_SESSION['usuario']))
			$usuario = $_SESSION['usuario'];

		//Lectura de parámetros de la petición: método, pathParams, queryParams y body
		//Llamamos "recurso solicitado" al primer pathParam
		$metodo = $_SERVER['REQUEST_METHOD'];
		$metodo = $_SERVER['REQUEST_METHOD'];
		
		$pathParams = null;
		$recurso = 'login';	//por defecto
		if (isset($_SERVER['PATH_INFO'])){
			$pathParams = explode('/', $_SERVER['PATH_INFO']);
			$recurso = $pathParams[1];	//El primer elemento es la /.
			if (count($pathParams) >= 2)
				array_splice($pathParams, 0, 2);	//Quitamos la / y el recurso solicitado.
		}
		
		$queryParams = [];
		parse_str($_SERVER['QUERY_STRING'], $queryParams);
		
		$body = json_decode(file_get_contents('php://input'));

		//ROUTING
		//Cargamos el controlador del recurso que han solicitado
		$controlador = false;
		switch($recurso){
			case 'login':
				require_once('./controladores/login.php');
				$controlador = new ControladorLogin();
				break;
			case 'cliente':
				require_once('./controladores/cliente.php');
				$controlador = new ControladorCliente();
				break;
			//Otros case...
			default:
				header('HTTP/1.1 501 Not Implemented');
				die();
		}

		//Llamamos al Método del Controlador
		switch($metodo){
			case 'GET':
				$controlador->get($pathParams, $queryParams, $usuario);
				die();
			case 'POST':
				$controlador->post($pathParams, $queryParams, $body, $usuario);
				die();
			case 'DELETE':
				$controlador->delete($pathParams, $queryParams, $usuario);
				die();
			case 'PUT':
				$controlador->put($pathParams, $queryParams, $body, $usuario);
				die();
			default:
				header('HTTP/1.1 501 Not Implemented');
				die();
			}

	}catch(Throwable $excepcion){	//Throwable (interfaz) incluye Error y Exception
		header('HTTP/1.1 500 Internal Server Error');
		echo $excepcion;
		die();
	}
