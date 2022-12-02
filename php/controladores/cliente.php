<?php
	/** Controlador de Cliente
	 * */

class ControladorCliente{
	function __construct($configuracion){
		$this->configuracion = $configuracion;
	}
	/**
		Devuelve una vista HTML con la tabla de Clientes
	*/
	function get(){
		//Control de acceso y de roles
		//Llamar al modelo y pedirle los datos
		require_once($this->configuracion['path_modelos'].'cliente.php');
		$modelo = new Cliente();
		$datos = $modelo->dameLosDatos();
		//Ajustar el formato de los datos a lo que quiere la vista
		require_once($this->configuracion['path_vistas'].'vistalistaclientes.php');
		$vista = new VistaListaClientes($this->configuracion);
		$vista->mostrar($datos);
	}

}
