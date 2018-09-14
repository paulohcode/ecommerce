<?php

namespace Hcode;

class Model {

	private $values = [];

	public function __call($name, $args) {

		//$METHOD esta verificando qual os 3 primeiras letras do comando
		$method = substr($name, 0, 3);
		//para ler o resto do nome a partir da posição 3
		$fieldName = substr($name, 3, strlen($name));

		//se as 3 primeiras letras do metodo for get ele puxa os dados se for set ele vai inserir
		switch ($method) {
		case "get";
			return $this->values[$fieldName];
			break;

		case "set";
			$this->values[$fieldName] = $args[0];
			break;
		}
	}

	//metodo para inserir os dados dentro da variavel
	public function setData($data = array()) {
		foreach ($data as $key => $value) {
			$this->{"set" . $key}($value);
		}
	}

	public function getValues() {
		return $this->values;
	}

}

?>