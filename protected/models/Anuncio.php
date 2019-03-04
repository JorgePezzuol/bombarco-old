<?php

class Anuncio {
    
    public static $_tipo_contato = array(
        'EMBARCACAO_CATALOGO' => 'S',
        'EMBARCACAO_CLASSIFICADO'=> 'X',
        'GUIA_DE_EMPRESAS' => 'G',
        'ESTALEIRO'=> 'E',
        'CONTATO' => 'C'
    );


	// CONSTANTES DE EMPRESA
	public static $_status = array(
		'INATIVA' => 0,
		'ATIVA' => 1
	);

	// extensoes permitidas
	public static $_extensoes_permitidas = array(
		'JPG' => 'image/jpg',
		'JPEG' => 'image/jpeg',
		'PNG' => 'image/png'
	);

	public static $_status_anuncio = array(
		'ANUNCIO_CRIADO' => 0,
		'ANUNCIO_PAGO' => 1,
		'ANUNCIO_ATIVADO' => 2,
		'ANUNCIO_BARRADO' => 3,
		'ANUNCIO_VENDIDO' => 4,		
		'ANUNCIO_PAUSADO' => 5,
		'ANUNCIO_EXPIRADO' => 6,
		'ANUNCIO_DELETADO' => 7		
	);

	// STATUS BY NUMBER
	public static $_status_anuncio_by_number = array(
		0 => 'Aguardando Pagamento',
		1 => 'Aguardando Ativação',
		2 => 'Ativado',		
		3 => 'Barrado',
		4 => 'Vendido', 
		5 => 'Pausado',
		6 => 'Expirado',
		7 => 'Deletado',
		127 => 'Teste'

	);

	// STATUS DE EDITADO BY NUMBER
	public static $_status_editado_anuncio_by_number = array(
		0 => 'OK',
		1 => 'Dados Editados',
		2 => 'Não Autorizado'
	);

	// MACROS
	public static $_macros = array(
		'VENDEDOR' => 1,
		'GUIA_EMPRESAS' => 2,
		'ESTALEIRO' => 3
	);


	// CLASSIFICAÇÕES DE USUÁRIOS
	public static $_classificacoes_de_usuario = array(
		'VENDEDOR' => 1,
		'EMPRESA' => 2,
		'ESTALEIRO' => 3,
		'USUARIO' => 4,
		'ADMIN' => 5
	);

	// PESSOA
	public static $_pessoa = array(
		'FISICA' => 'F',
		'JURIDICA' => 'J'
	);

	public static $_categoria_embarcacao = array(
		'JETSKI' => 1,
		'LANCHA' => 2,
		'VELEIRO' => 3,
		'PESCA' => 4

	);

	public static $_categoria_por_numero = array(
		1 => 'JetSki',
		2 => 'Lancha',
		3 => 'Veleiro',
		4 => 'Barcos de Pesca'

	);

	// STATUS DE PLANO DO USUÁRIO
	public static $_status_plano = array(
		'FINALIZADO' => 0,
		'CRIADO' => 1,
		'PAGO' => 2,
		// indica que pagou renovacao de plano, esta aguardando o plano atual vencer
		'RENOVACAO_PAGA' => 3,
		'RENOVACAO_CONCLUIDA' => 4,
		'RENOVACAO_CRIADA' => 1
	);

	// STATUS DE PLANO DO USUÁRIO PELO ID
	public static $_status_plano_id = array(
		0 => 'Finalizado',
		1 => 'Aguardando Pagamento',
		2 => 'Pago'
	);

	// STATUS DA ORDEM DE PEDIDO
	public static $_status_ordem = array(
		'ESCONDIDA' => 0,
		'CRIADA' => 1,
		'PAGA' => 2
	);

	// TIPO DA ORDEM
	public static $_tipo_ordem = array(
		'ANUNCIO' => 1,
		'PLANO_ANUNCIO' => 2,
		'PLANO_EMPRESA' => 3,
		'ESTALEIRO' => 4,
		'ADICIONAL_EMBARCACAO' => 5,
		'ADICIONAL_EMPRESA' => 6,
		'BANNER' => 7,
		'RENOVAR_PLANO' => 8,
		'PLANO_MOTOR' => 9
	);

	// ID DE TURBINADOS EMPRESA
	public static $_turbinados_empresa = array(
		'CPM' => 1,
		'TELEFONE_EMPRESA' => 3,
		'FOTOS' => 4,
		'VIDEO' => 5,
		'DESCRICAO' => 7
	);

	// ID TURBINADO EMBARCACAO
	public static $_turbinados_embarcacao = array(
		'DESTAQUE_BUSCA' => 4,
		'FOTOS' => 2,
		'VIDEO' => 3,
		'CPM' => 1,
		'TITULO' => 5
	);

	// TOTAL DE FOTOS
	public static $_max_fotos = array(
		'MAX_FOTOS_TURBINADO_EMPRESA' => 6,
		'MAX_FOTOS_TURBINADO_EMBARCACAO' => 10,
		'MAX_FOTOS_ESTALEIRO' => 16,
		'MAX_FOTOS_EMBARCACAO' => 6
	);

	// DESTAQUE EMBARCAÇÃO
	public static $_status_destaque_embarcacao = array(
		'NULO' => 0,
		'PENDENTE' => 1,
		'PAGO' => 2,
	);

	// STATUS DE TRANSAÇÃO
	public static $_status_transacao = array(
		'ESCONDIDA' => 0,
		'CRIADA' => 1,
		'AGUARDANDO_PAGAMENTO' => 2,
		'PAGA' => 3,
		'CANCELADA' => 4,
		'ESTORNADA' => 5,
		'FRAUDE' => 6,
		'OUTRO' => 7
	);

	// IMAGEM DE EMBARCAÇÃO TURBO OU NÃO
	public static $_img_turbo = array(
		'NAO_TURBO' => 0,
		'TURBO' => 1
	); 

	// KEY DO AZPAY
	public static $_az_pay = array(
		// versão teste
		/*'KEY' => 'd41d8cd98f00b204e9800998ecf8427e',
		 'ID' => '1',*/
		
		// versao produção
		'ID' => '13',
		'KEY' => 's3vlf6t3duzq6w299750992297194898'
	);

	// TIPOS DE ACESSORIOS
	public static $_tipos_acessorio = array(
		'ACESSORIOS' => 1,
		'COMUNICACAO_NAVEGACAO' => 2,
		'ELETROELETRONICOS' => 3,
		'VELA_MESTRA' => 4,
		'VELA_GENOA' => 5
	);

	// LOGIN COM REDE SOCIAL
	public static $_tipo_de_login = array(
		'REDE_SOCIAL' => 1
	);

}

?>