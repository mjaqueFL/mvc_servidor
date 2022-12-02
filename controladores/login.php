<?php
/**
	Controlador de autenticación.
**/
require_once('./modelos/usuario.php');

class ControladorLogin{
	/**
		Autentifica al usuario con el email y la clave.
		Devuelve por HTTP el objeto usuario en formato JSON.
		@param $pathParams No utilizado.
		@param $queryParams No utilizado.
	**/
	function post($pathParams, $queryParams, $token){

		header('Content-type: application/json; charset=utf-8');
    	header('HTTP/1.1 200 OK');
    	die();
	}
}
