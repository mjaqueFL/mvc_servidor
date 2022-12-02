<?php

class VistaListaClientes{
	function __construct($configuracion){
		$this->configuracion = $configuracion;
	}

	function mostrar_old($datos){
		require_once($this->configuracion['path_html'].'cabecera.html');
		require_once($this->configuracion['path_html'].'listaclientes.html');
	}
	function mostrar($datos){
		$doc = new DOMDocument();
		$doc->loadHTMLFile($this->configuracion['path_html'].'plantilla.html');

		$p = $doc->getElementById('p1');
		$p->appendChild($doc->createTextNode('Añadido directamente'));

		echo $doc->saveHTML();
	}
}
