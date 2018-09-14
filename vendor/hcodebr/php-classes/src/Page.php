<?php

//aqui identificamos a pasta onde esta a classe page
namespace Hcode;

//chamado o Tpl
use Rain\Tpl;

//criando a classe
class Page {

	//instanciar as variaveis
	private $tpl;
	private $options;
	private $defaults = [
		"header" => true,
		"footer" => true,
		"data" => [],

	];

	//criando o metodo construtor
	public function __construct($opts = array(), $tpl_dir = "/views/") {

		$this->options = array_merge($this->defaults, $opts);
		// config
		$config = array(
			"tpl_dir" => $_SERVER["DOCUMENT_ROOT"] . $tpl_dir, //pegar a pasta raiz do sistema/a pasta onde esta os arquivos da view
			"cache_dir" => $_SERVER["DOCUMENT_ROOT"] . "/views-cache/",
			"debug" => false,
		);

		Tpl::configure($config);

		//criar um novo tpl
		$this->tpl = new Tpl;

		$this->setData($this->options["data"]);

		if ($this->options["header"] === true) {
			$this->tpl->draw("header");
		}

	}

	private function setData($data = array()) {
		foreach ($this->options["data"] as $key => $value) {

			$this->tpl->assign($key, $value);

		}
	}

	public function setTpl($name, $data = array(), $returnHTML = false) {

		$this->setData($data);

		return $this->tpl->draw($name, $returnHTML);

	}

	//criando o metodo destrutor
	public function __destruct() {

		if ($this->options["footer"] === true) {
			$this->tpl->draw("footer");
		}

	}

}

?>