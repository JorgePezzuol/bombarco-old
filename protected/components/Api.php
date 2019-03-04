<?php

	class Api {

		private $url;
		private $embarcacoes_id;
		private $imagemprincipal;
		private $marca;
		private $modelo;
		private $urlMarca;
		private $titulo;
		private $texto;

		public function getTexto() {
			return $this->texto;
		}

		public function setTexto($texto) {
			$this->texto = $texto;
		}

		public function setTitulo($titulo) {
			$this->titulo = $titulo;
		}

		public function getTitulo() {
			return $this->titulo;
		}

		public function getUrlMarca(){
			return $this->urlMarca;
		}

		public function setUrlMarca($urlMarca){
			$this->urlMarca = $urlMarca;
		}

		public function getUrl(){
			return $this->url;
		}

		public function setUrl($url){
			$this->url = $url;
		}

		public function getEmbarcacoesId(){
			return $this->embarcacoes_id;
		}

		public function setEmbarcacoesId($embarcacoes_id){
			$this->embarcacoes_id = $embarcacoes_id;
		}

		public function getImagemprincipal(){
			return $this->imagemprincipal;
		}

		public function setImagemprincipal($imagemprincipal){
			$this->imagemprincipal = $imagemprincipal;
		}

		public function getMarca(){
			return $this->marca;
		}

		public function setMarca($marca){
			$this->marca = $marca;
		}

		public function getModelo(){
			return $this->modelo;
		}

		public function setModelo($modelo){
			$this->modelo = $modelo;
		}

		public function toArray() {

	       $arr = array();

	        $reflexao = new \ReflectionClass($this);
	        
	        $propriedades  = $reflexao->getProperties(\ReflectionProperty::IS_PRIVATE);
	        foreach ($propriedades as $propriedade) {
	            $propriedade->setAccessible(true);
	            $arr[$propriedade->getName()] = $propriedade->getValue($this);
	        }        
	       return $arr;
	   }

	}


?>

