<?php

/**
 * This is the model base class for the table "contratos".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Contrato".
 *
 * Columns in table "contratos" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $nome_fantasia
 * @property string $razao_social
 * @property string $data_fundacao
 * @property string $rua
 * @property string $numero
 * @property string $complemento
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property string $cep
 * @property string $cnpj
 * @property string $inscricao_estadual
 * @property string $telefone
 * @property string $site
 * @property string $nome_representante_legal
 * @property string $funcao_representante_legal
 * @property string $cpf_representante_legal
 * @property string $rg_representante_legal
 * @property string $data_nascimento_representante_legal
 * @property string $cel_representante_legal
 * @property string $email_representante_legal
 * @property string $email_pergunta
 * @property string $resp_financeiro_nome
 * @property string $resp_financeiro_email
 * @property string $resp_financeiro_tel
 * @property string $resp_anuncios_nome
 * @property string $resp_anuncios_email
 * @property string $resp_anuncios_tel
 * @property string $resp_pecas_nome
 * @property string $resp_pecas_email
 * @property string $resp_pecas_tel
 * @property string $plano_classificados_desc
 * @property string $plano_classificados_periodo
 * @property string $plano_classificado_valor
 * @property string $plano_banner_site_bb_desc
 * @property string $plano_banner_site_bb_periodo
 * @property string $plano_banner_site_bb_valor
 * @property string $plano_classificados_subtotal
 * @property string $plano_banner_site_bb_subtotal
 * @property string $plano_banner_news_desc
 * @property string $plano_banner_news_periodo
 * @property string $plano_banner_news_valor
 * @property string $plano_banner_news_subtotal
 * @property string $plano_emkt_desc
 * @property string $plano_emkt_periodo
 * @property string $plano_emkt_valor
 * @property string $plano_emkt_subtotal
 * @property string $plano_zeromilhas_desc
 * @property string $plano_zeromilhas_periodo
 * @property string $plano_zeromilhas_valor
 * @property string $plano_zeromilhas_subtotal
 * @property string $plano_impresso_guia_desc
 * @property string $plano_impresso_guia_periodo
 * @property string $plano_impresso_guia_valor
 * @property string $plano_impresso_guia_subtotal
 * @property string $plano_site_guia_desc
 * @property string $plano_site_guia_periodo
 * @property string $plano_site_guia_valor
 * @property string $plano_site_guia_subtotal
 * @property string $plano_raiox_desc
 * @property string $plano_raiox_periodo
 * @property string $plano_raiox_valor
 * @property string $plano_raiox_subtotal
 * @property string $plano_outros_desc
 * @property string $plano_outros_periodo
 * @property string $plano_outros_valor
 * @property string $plano_outros_subtotal
 * @property string $valor_total_contrato
 * @property string $forma_pagamento
 * @property string $num_parcelas_pagamento
 * @property string $valor_parcelas_pagamento
 * @property string $vencimento_parcelas_pagamento
 * @property string $vencimento_primeira_parcela_pagamento
 * @property string $observacao
 * @property string $visto_bombarco
 * @property string $visto_contratante
 * @property string $segundo_visto_contratante
 * @property string $flg_renovacao
 * @property string $num_contrato
 * @property string $data
 *
 */
abstract class BaseContrato extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'contratos';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Contrato|Contratos', $n);
	}

	public static function representingColumn() {
		return 'nome_fantasia';
	}

	public function rules() {
		return array(
			array('base64_termos, valor_total_contrato_extenso, valor_parcelas_pagamento_extenso, email_vendedor, status, id_usuario, base64_contrato, slug, nome_fantasia, razao_social, data_fundacao, rua, numero, complemento, bairro, cidade, estado, cep, cnpj, inscricao_estadual, telefone, site, nome_representante_legal, funcao_representante_legal, cpf_representante_legal, rg_representante_legal, data_nascimento_representante_legal, cel_representante_legal, email_representante_legal, email_pergunta, resp_financeiro_nome, resp_financeiro_email, resp_financeiro_tel, resp_anuncios_nome, resp_anuncios_email, resp_anuncios_tel, resp_pecas_nome, resp_pecas_email, resp_pecas_tel, plano_classificados_desc, plano_classificados_periodo, plano_classificado_valor, plano_banner_site_bb_desc, plano_banner_site_bb_periodo, plano_banner_site_bb_valor, plano_classificados_subtotal, plano_banner_site_bb_subtotal, plano_banner_news_desc, plano_banner_news_periodo, plano_banner_news_valor, plano_banner_news_subtotal, plano_emkt_desc, plano_emkt_periodo, plano_emkt_valor, plano_emkt_subtotal, plano_zeromilhas_desc, plano_zeromilhas_periodo, plano_zeromilhas_valor, plano_zeromilhas_subtotal, plano_impresso_guia_desc, plano_impresso_guia_periodo, plano_impresso_guia_valor, plano_impresso_guia_subtotal, plano_site_guia_desc, plano_site_guia_periodo, plano_site_guia_valor, plano_site_guia_subtotal, plano_raiox_desc, plano_raiox_periodo, plano_raiox_valor, plano_raiox_subtotal, plano_outros_desc, plano_outros_periodo, plano_outros_valor, plano_outros_subtotal, valor_total_contrato, forma_pagamento, num_parcelas_pagamento, valor_parcelas_pagamento, vencimento_parcelas_pagamento, vencimento_primeira_parcela_pagamento, observacao, visto_bombarco, visto_contratante, segundo_visto_contratante, flg_renovacao, num_contrato, data', 'safe'),
			array('base64_termos, valor_parcelas_pagamento_extenso, valor_total_contrato_extenso, email_vendedor, status, id_usuario, base64_contrato, slug, nome_fantasia, razao_social, data_fundacao, rua, numero, complemento, bairro, cidade, estado, cep, cnpj, inscricao_estadual, telefone, site, nome_representante_legal, funcao_representante_legal, cpf_representante_legal, rg_representante_legal, data_nascimento_representante_legal, cel_representante_legal, email_representante_legal, email_pergunta, resp_financeiro_nome, resp_financeiro_email, resp_financeiro_tel, resp_anuncios_nome, resp_anuncios_email, resp_anuncios_tel, resp_pecas_nome, resp_pecas_email, resp_pecas_tel, plano_classificados_desc, plano_classificados_periodo, plano_classificado_valor, plano_banner_site_bb_desc, plano_banner_site_bb_periodo, plano_banner_site_bb_valor, plano_classificados_subtotal, plano_banner_site_bb_subtotal, plano_banner_news_desc, plano_banner_news_periodo, plano_banner_news_valor, plano_banner_news_subtotal, plano_emkt_desc, plano_emkt_periodo, plano_emkt_valor, plano_emkt_subtotal, plano_zeromilhas_desc, plano_zeromilhas_periodo, plano_zeromilhas_valor, plano_zeromilhas_subtotal, plano_impresso_guia_desc, plano_impresso_guia_periodo, plano_impresso_guia_valor, plano_impresso_guia_subtotal, plano_site_guia_desc, plano_site_guia_periodo, plano_site_guia_valor, plano_site_guia_subtotal, plano_raiox_desc, plano_raiox_periodo, plano_raiox_valor, plano_raiox_subtotal, plano_outros_desc, plano_outros_periodo, plano_outros_valor, plano_outros_subtotal, valor_total_contrato, forma_pagamento, num_parcelas_pagamento, valor_parcelas_pagamento, vencimento_parcelas_pagamento, vencimento_primeira_parcela_pagamento, observacao, visto_bombarco, visto_contratante, segundo_visto_contratante, flg_renovacao, num_contrato, data', 'default', 'setOnEmpty' => true, 'value' => null),
			array('base64_termos, valor_parcelas_pagamento_extenso, valor_total_contrato_extenso, email_vendedor, status, id_usuario, base64_contrato, id, slug, nome_fantasia, razao_social, data_fundacao, rua, numero, complemento, bairro, cidade, estado, cep, cnpj, inscricao_estadual, telefone, site, nome_representante_legal, funcao_representante_legal, cpf_representante_legal, rg_representante_legal, data_nascimento_representante_legal, cel_representante_legal, email_representante_legal, email_pergunta, resp_financeiro_nome, resp_financeiro_email, resp_financeiro_tel, resp_anuncios_nome, resp_anuncios_email, resp_anuncios_tel, resp_pecas_nome, resp_pecas_email, resp_pecas_tel, plano_classificados_desc, plano_classificados_periodo, plano_classificado_valor, plano_banner_site_bb_desc, plano_banner_site_bb_periodo, plano_banner_site_bb_valor, plano_classificados_subtotal, plano_banner_site_bb_subtotal, plano_banner_news_desc, plano_banner_news_periodo, plano_banner_news_valor, plano_banner_news_subtotal, plano_emkt_desc, plano_emkt_periodo, plano_emkt_valor, plano_emkt_subtotal, plano_zeromilhas_desc, plano_zeromilhas_periodo, plano_zeromilhas_valor, plano_zeromilhas_subtotal, plano_impresso_guia_desc, plano_impresso_guia_periodo, plano_impresso_guia_valor, plano_impresso_guia_subtotal, plano_site_guia_desc, plano_site_guia_periodo, plano_site_guia_valor, plano_site_guia_subtotal, plano_raiox_desc, plano_raiox_periodo, plano_raiox_valor, plano_raiox_subtotal, plano_outros_desc, plano_outros_periodo, plano_outros_valor, plano_outros_subtotal, valor_total_contrato, forma_pagamento, num_parcelas_pagamento, valor_parcelas_pagamento, vencimento_parcelas_pagamento, vencimento_primeira_parcela_pagamento, observacao, visto_bombarco, visto_contratante, segundo_visto_contratante, flg_renovacao, num_contrato, data', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'email_vendedor' => Yii::t('app', 'ID'),
			'id_usuario' => Yii::t('app', 'Isdsd'),
			'nome_fantasia' => Yii::t('app', 'Nome Fantasia'),
			'base64_contrato' => Yii::t('app', 'Nome Fantasia'),
			'base64_termos' => Yii::t('app', 'Nome Fantasia'),
			'slug' => Yii::t('app', 'Nome'),
			'razao_social' => Yii::t('app', 'Razao Social'),
			'data_fundacao' => Yii::t('app', 'Data Fundacao'),
			'rua' => Yii::t('app', 'Rua'),
			'numero' => Yii::t('app', 'Numero'),
			'complemento' => Yii::t('app', 'Complemento'),
			'bairro' => Yii::t('app', 'Bairro'),
			'cidade' => Yii::t('app', 'Cidade'),
			'estado' => Yii::t('app', 'Estado'),
			'cep' => Yii::t('app', 'Cep'),
			'cnpj' => Yii::t('app', 'Cnpj'),
			'inscricao_estadual' => Yii::t('app', 'Inscricao Estadual'),
			'telefone' => Yii::t('app', 'Telefone'),
			'site' => Yii::t('app', 'Site'),
			'nome_representante_legal' => Yii::t('app', 'Nome Representante Legal'),
			'funcao_representante_legal' => Yii::t('app', 'Funcao Representante Legal'),
			'cpf_representante_legal' => Yii::t('app', 'Cpf Representante Legal'),
			'rg_representante_legal' => Yii::t('app', 'Rg Representante Legal'),
			'data_nascimento_representante_legal' => Yii::t('app', 'Data Nascimento Representante Legal'),
			'cel_representante_legal' => Yii::t('app', 'Cel Representante Legal'),
			'email_representante_legal' => Yii::t('app', 'Email Representante Legal'),
			'email_pergunta' => Yii::t('app', 'Email Pergunta'),
			'resp_financeiro_nome' => Yii::t('app', 'Resp Financeiro Nome'),
			'resp_financeiro_email' => Yii::t('app', 'Resp Financeiro Email'),
			'resp_financeiro_tel' => Yii::t('app', 'Resp Financeiro Tel'),
			'resp_anuncios_nome' => Yii::t('app', 'Resp Anuncios Nome'),
			'resp_anuncios_email' => Yii::t('app', 'Resp Anuncios Email'),
			'resp_anuncios_tel' => Yii::t('app', 'Resp Anuncios Tel'),
			'resp_pecas_nome' => Yii::t('app', 'Resp Pecas Nome'),
			'resp_pecas_email' => Yii::t('app', 'Resp Pecas Email'),
			'resp_pecas_tel' => Yii::t('app', 'Resp Pecas Tel'),
			'plano_classificados_desc' => Yii::t('app', 'Plano Classificados Desc'),
			'plano_classificados_periodo' => Yii::t('app', 'Plano Classificados Periodo'),
			'plano_classificado_valor' => Yii::t('app', 'Plano Classificado Valor'),
			'plano_banner_site_bb_desc' => Yii::t('app', 'Plano Banner Site Bb Desc'),
			'plano_banner_site_bb_periodo' => Yii::t('app', 'Plano Banner Site Bb Periodo'),
			'plano_banner_site_bb_valor' => Yii::t('app', 'Plano Banner Site Bb Valor'),
			'plano_classificados_subtotal' => Yii::t('app', 'Plano Classificados Subtotal'),
			'plano_banner_site_bb_subtotal' => Yii::t('app', 'Plano Banner Site Bb Subtotal'),
			'plano_banner_news_desc' => Yii::t('app', 'Plano Banner News Desc'),
			'plano_banner_news_periodo' => Yii::t('app', 'Plano Banner News Periodo'),
			'plano_banner_news_valor' => Yii::t('app', 'Plano Banner News Valor'),
			'plano_banner_news_subtotal' => Yii::t('app', 'Plano Banner News Subtotal'),
			'plano_emkt_desc' => Yii::t('app', 'Plano Emkt Desc'),
			'plano_emkt_periodo' => Yii::t('app', 'Plano Emkt Periodo'),
			'plano_emkt_valor' => Yii::t('app', 'Plano Emkt Valor'),
			'plano_emkt_subtotal' => Yii::t('app', 'Plano Emkt Subtotal'),
			'plano_zeromilhas_desc' => Yii::t('app', 'Plano Zeromilhas Desc'),
			'plano_zeromilhas_periodo' => Yii::t('app', 'Plano Zeromilhas Periodo'),
			'plano_zeromilhas_valor' => Yii::t('app', 'Plano Zeromilhas Valor'),
			'plano_zeromilhas_subtotal' => Yii::t('app', 'Plano Zeromilhas Subtotal'),
			'plano_impresso_guia_desc' => Yii::t('app', 'Plano Impresso Guia Desc'),
			'plano_impresso_guia_periodo' => Yii::t('app', 'Plano Impresso Guia Periodo'),
			'plano_impresso_guia_valor' => Yii::t('app', 'Plano Impresso Guia Valor'),
			'plano_impresso_guia_subtotal' => Yii::t('app', 'Plano Impresso Guia Subtotal'),
			'plano_site_guia_desc' => Yii::t('app', 'Plano Site Guia Desc'),
			'plano_site_guia_periodo' => Yii::t('app', 'Plano Site Guia Periodo'),
			'plano_site_guia_valor' => Yii::t('app', 'Plano Site Guia Valor'),
			'plano_site_guia_subtotal' => Yii::t('app', 'Plano Site Guia Subtotal'),
			'plano_raiox_desc' => Yii::t('app', 'Plano Raiox Desc'),
			'plano_raiox_periodo' => Yii::t('app', 'Plano Raiox Periodo'),
			'plano_raiox_valor' => Yii::t('app', 'Plano Raiox Valor'),
			'plano_raiox_subtotal' => Yii::t('app', 'Plano Raiox Subtotal'),
			'plano_outros_desc' => Yii::t('app', 'Plano Outros Desc'),
			'plano_outros_periodo' => Yii::t('app', 'Plano Outros Periodo'),
			'plano_outros_valor' => Yii::t('app', 'Plano Outros Valor'),
			'plano_outros_subtotal' => Yii::t('app', 'Plano Outros Subtotal'),
			'valor_total_contrato' => Yii::t('app', 'Valor Total Contrato'),
			'forma_pagamento' => Yii::t('app', 'Forma Pagamento'),
			'num_parcelas_pagamento' => Yii::t('app', 'Num Parcelas Pagamento'),
			'valor_parcelas_pagamento' => Yii::t('app', 'Valor Parcelas Pagamento'),
			'vencimento_parcelas_pagamento' => Yii::t('app', 'Vencimento Parcelas Pagamento'),
			'vencimento_primeira_parcela_pagamento' => Yii::t('app', 'Vencimento Primeira Parcela Pagamento'),
			'observacao' => Yii::t('app', 'Observacao'),
			'visto_bombarco' => Yii::t('app', 'Visto Bombarco'),
			'visto_contratante' => Yii::t('app', 'Visto Contratante'),
			'segundo_visto_contratante' => Yii::t('app', 'Segundo Visto Contratante'),
			'flg_renovacao' => Yii::t('app', 'Flg Renovacao'),
			'num_contrato' => Yii::t('app', 'Num Contrato'),
			'data' => Yii::t('app', 'Data'),
			'status' => Yii::t('app', 'Data'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('nome_fantasia', $this->nome_fantasia, true);
		$criteria->compare('razao_social', $this->razao_social, true);
		$criteria->compare('data_fundacao', $this->data_fundacao, true);
		$criteria->compare('rua', $this->rua, true);
		$criteria->compare('numero', $this->numero, true);
		$criteria->compare('complemento', $this->complemento, true);
		$criteria->compare('bairro', $this->bairro, true);
		$criteria->compare('cidade', $this->cidade, true);
		$criteria->compare('estado', $this->estado, true);
		$criteria->compare('cep', $this->cep, true);
		$criteria->compare('cnpj', $this->cnpj, true);
		$criteria->compare('inscricao_estadual', $this->inscricao_estadual, true);
		$criteria->compare('telefone', $this->telefone, true);
		$criteria->compare('site', $this->site, true);
		$criteria->compare('nome_representante_legal', $this->nome_representante_legal, true);
		$criteria->compare('funcao_representante_legal', $this->funcao_representante_legal, true);
		$criteria->compare('cpf_representante_legal', $this->cpf_representante_legal, true);
		$criteria->compare('rg_representante_legal', $this->rg_representante_legal, true);
		$criteria->compare('data_nascimento_representante_legal', $this->data_nascimento_representante_legal, true);
		$criteria->compare('cel_representante_legal', $this->cel_representante_legal, true);
		$criteria->compare('email_representante_legal', $this->email_representante_legal, true);
		$criteria->compare('email_pergunta', $this->email_pergunta, true);
		$criteria->compare('resp_financeiro_nome', $this->resp_financeiro_nome, true);
		$criteria->compare('resp_financeiro_email', $this->resp_financeiro_email, true);
		$criteria->compare('resp_financeiro_tel', $this->resp_financeiro_tel, true);
		$criteria->compare('resp_anuncios_nome', $this->resp_anuncios_nome, true);
		$criteria->compare('resp_anuncios_email', $this->resp_anuncios_email, true);
		$criteria->compare('resp_anuncios_tel', $this->resp_anuncios_tel, true);
		$criteria->compare('resp_pecas_nome', $this->resp_pecas_nome, true);
		$criteria->compare('resp_pecas_email', $this->resp_pecas_email, true);
		$criteria->compare('resp_pecas_tel', $this->resp_pecas_tel, true);
		$criteria->compare('plano_classificados_desc', $this->plano_classificados_desc, true);
		$criteria->compare('plano_classificados_periodo', $this->plano_classificados_periodo, true);
		$criteria->compare('plano_classificado_valor', $this->plano_classificado_valor, true);
		$criteria->compare('plano_banner_site_bb_desc', $this->plano_banner_site_bb_desc, true);
		$criteria->compare('plano_banner_site_bb_periodo', $this->plano_banner_site_bb_periodo, true);
		$criteria->compare('plano_banner_site_bb_valor', $this->plano_banner_site_bb_valor, true);
		$criteria->compare('plano_classificados_subtotal', $this->plano_classificados_subtotal, true);
		$criteria->compare('plano_banner_site_bb_subtotal', $this->plano_banner_site_bb_subtotal, true);
		$criteria->compare('plano_banner_news_desc', $this->plano_banner_news_desc, true);
		$criteria->compare('plano_banner_news_periodo', $this->plano_banner_news_periodo, true);
		$criteria->compare('plano_banner_news_valor', $this->plano_banner_news_valor, true);
		$criteria->compare('plano_banner_news_subtotal', $this->plano_banner_news_subtotal, true);
		$criteria->compare('plano_emkt_desc', $this->plano_emkt_desc, true);
		$criteria->compare('plano_emkt_periodo', $this->plano_emkt_periodo, true);
		$criteria->compare('plano_emkt_valor', $this->plano_emkt_valor, true);
		$criteria->compare('plano_emkt_subtotal', $this->plano_emkt_subtotal, true);
		$criteria->compare('plano_zeromilhas_desc', $this->plano_zeromilhas_desc, true);
		$criteria->compare('plano_zeromilhas_periodo', $this->plano_zeromilhas_periodo, true);
		$criteria->compare('plano_zeromilhas_valor', $this->plano_zeromilhas_valor, true);
		$criteria->compare('plano_zeromilhas_subtotal', $this->plano_zeromilhas_subtotal, true);
		$criteria->compare('plano_impresso_guia_desc', $this->plano_impresso_guia_desc, true);
		$criteria->compare('plano_impresso_guia_periodo', $this->plano_impresso_guia_periodo, true);
		$criteria->compare('plano_impresso_guia_valor', $this->plano_impresso_guia_valor, true);
		$criteria->compare('plano_impresso_guia_subtotal', $this->plano_impresso_guia_subtotal, true);
		$criteria->compare('plano_site_guia_desc', $this->plano_site_guia_desc, true);
		$criteria->compare('plano_site_guia_periodo', $this->plano_site_guia_periodo, true);
		$criteria->compare('plano_site_guia_valor', $this->plano_site_guia_valor, true);
		$criteria->compare('plano_site_guia_subtotal', $this->plano_site_guia_subtotal, true);
		$criteria->compare('plano_raiox_desc', $this->plano_raiox_desc, true);
		$criteria->compare('plano_raiox_periodo', $this->plano_raiox_periodo, true);
		$criteria->compare('plano_raiox_valor', $this->plano_raiox_valor, true);
		$criteria->compare('plano_raiox_subtotal', $this->plano_raiox_subtotal, true);
		$criteria->compare('plano_outros_desc', $this->plano_outros_desc, true);
		$criteria->compare('plano_outros_periodo', $this->plano_outros_periodo, true);
		$criteria->compare('plano_outros_valor', $this->plano_outros_valor, true);
		$criteria->compare('plano_outros_subtotal', $this->plano_outros_subtotal, true);
		$criteria->compare('valor_total_contrato', $this->valor_total_contrato, true);
		$criteria->compare('forma_pagamento', $this->forma_pagamento, true);
		$criteria->compare('num_parcelas_pagamento', $this->num_parcelas_pagamento, true);
		$criteria->compare('valor_parcelas_pagamento', $this->valor_parcelas_pagamento, true);
		$criteria->compare('vencimento_parcelas_pagamento', $this->vencimento_parcelas_pagamento, true);
		$criteria->compare('vencimento_primeira_parcela_pagamento', $this->vencimento_primeira_parcela_pagamento, true);
		$criteria->compare('observacao', $this->observacao, true);
		$criteria->compare('visto_bombarco', $this->visto_bombarco, true);
		$criteria->compare('visto_contratante', $this->visto_contratante, true);
		$criteria->compare('segundo_visto_contratante', $this->segundo_visto_contratante, true);
		$criteria->compare('flg_renovacao', $this->flg_renovacao, true);
		$criteria->compare('num_contrato', $this->num_contrato, true);
		$criteria->compare('data', $this->data, true);
		$criteria->compare('slug', $this->num_contrato, true);
		$criteria->compare('id_usuario', $this->id_usuario, true);
		$criteria->compare('status', $this->id_usuario, true);


		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}