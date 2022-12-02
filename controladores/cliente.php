<?php
/**
	Controlador de Cliente.
**/
//require_once('./modelos/cliente.php');

class ControladorCliente{
	/**
	**/
	function get($pathParams, $queryParams, $usuario){

		if (count($pathParams) == 0){
			//Solo cargamos la vista...
			require_once('./vistas/listaclientes.php');
			new ListaClientes();
			die();
		}
	}
}
