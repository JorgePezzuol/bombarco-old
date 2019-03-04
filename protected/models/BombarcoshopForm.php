<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class BombarcoshopForm extends CFormModel {

	public $codigo;
	public $porcentagem_desconto;
	public $data_inicio;
	public $data_fim;
	public $id;
	public $nome;
	public $descricao;
	public $valor;
	public $qtde_codigos;
	public $slug;

	/**
	 * Declares the validation rules.
	 */
	public function rules() {
		return array(
			array('id, nome, descricao, valor, slug', 'required'),
			array('codigo, qtde_codigos, porcentagem_desconto, data_inicio, data_fim, nome, descricao, valor, slug', 'safe'),
		);
	}


	public function save() {

		$bbshop = new Bombarcoshop();
		$bbshop->nome = $this->nome;
		$bbshop->descricao = $this->descricao;
		$bbshop->valor = Utils::formataValor($this->valor);
		$bbshop->slug = Utils::slugify($this->nome);
		$bbshop->id = $this->id;

		if($bbshop->save()) {

			do {
				$this->codigo = strtoupper(BombarcoshopDescontos::gerarCodigoDesconto(5));
				$desconto = BombarcoshopDescontos::model()->find("codigo=:codigo", array(":codigo"=>$this->codigo));
			} while($desconto != null);

			
			$bbshopdesconto = new BombarcoshopDescontos();
			$bbshopdesconto->id_produto = $bbshop->id;
			$bbshopdesconto->porcentagem_desconto = $this->porcentagem_desconto;
			$bbshopdesconto->data_inicio = Utils::formatDateTimeToDb($this->data_inicio);
			$bbshopdesconto->data_fim = Utils::formatDateTimeToDb($this->data_fim);
			$bbshopdesconto->codigo = $this->codigo;	
			$bbshopdesconto->qtde_codigos = $this->qtde_codigos;
			$bbshopdesconto->save();
			

			return true;		
		}

		return false;
	}
}

