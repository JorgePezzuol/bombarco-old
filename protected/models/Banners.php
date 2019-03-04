<?php

Yii::import('application.models._base.BaseBanners');

class Banners extends BaseBanners
{


    // Orientacões
    //const HORIZONTAL = 1;
    //const VERTICAL = 2;

    // Local
    const TOP = 1;
    const CENTER = 2;
    const FOOTER = 3;

    // dimensões banner topo fechado
    const WIDTH_MAX_BANNER_TOPO_FECHADO = 11900;
    const HEIGHT_MAX_BANNER_TOPO_FECHADO = 700;

    // dimensoes banner topo aberto
    const WIDTH_MAX_BANNER_TOPO_ABERTO = 11900;
    const HEIGHT_MAX_BANNER_TOPO_ABERTO = 4600;

    // dimensoes banner lateral
    const WIDTH_MAX_BANNER_LATERAL = 2000;
    const HEIGHT_MAX_BANNER_LATERAL = 4460;

    // dimensoes banner horizontal
    const WIDTH_MAX_BANNER_HORIZONTAL = 7280;
    const HEIGHT_MAX_BANNER_HORIZONTAL = 900;

    // formatos permitidos
    const JPEG = 'image/jpeg';
    const JPG = 'image/jpg';
    const GIF = 'image/gif';
    const PNG = 'image/png';

    // tamanhos divididos por formatos (banner topo)
    const TAMANHO_MAX_JPG_BANNER_TOPO = 4000;
    const TAMANHO_MAX_PNG_BANNER_TOPO = 4000;
    const TAMANHO_MAX_GIF_BANNER_TOPO = 8000;

    // tamanhos (Kb) divididos por formatos (banner lateral e horizontal)
    const TAMANHO_MAX_JPG = 1000;
    const TAMANHO_MAX_PNG = 1000;
    const TAMANHO_MAX_GIF = 6000;

    // indicar se é banner fechado ou aberto (somente do topo)
    // 1 é fechado
    // 2 é aberto
    const BANNER_FECHADO = 1;
    const BANNER_ABERTO = 2;

    // constantes de erro
    const ERRO_EXCEDEU_ALTURA = -1;
    const ERRO_EXCEDEU_LARGURA = -2;
    const ERRO_EXCEDEU_PESO = -3;


    // caminho da pasta onde é guardada as imagens dos banners
    const PATH = "public/banners";

    // posições
    const TOPO = 1;
    const HORIZONTAL = 2;
    const LATERAL = 3;

    public static $posicoes_por_num = array(
        1 => 'Topo',
        2=> 'Horizontal',
        3=>'Lateral'
    );

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function rules() {

        $rules = parent::rules();

        $rules[] = array('imagem', 'file', 'types'=>'jpg, jpeg, gif, png');
        $rules[] = array('inicio, fim', 'date', 'format'=>'yyyy-M-d H:m:s');

        return $rules;
    }

    public function beforeSave() {

        if($this->isNewRecord) {

            $this->cliques = 0;
            $this->status = 1;
            $this->views = 0;
        }


        return true;
    }

    public function beforeValidate() {

        if($this->isNewRecord) {

            // formatar a data de inicio e fim
            $this->inicio = Banners::formatDateTimeToDb($this->inicio);
            $this->fim = Banners::formatDateTimeToDb($this->fim);

            if( $this->local != self::TOPO
                && $this->local != self::HORIZONTAL
                && $this->local != self::LATERAL ) {
                $this->addError('local', 'Local inválido!');
            }

            if(strtotime($this->inicio) > strtotime($this->fim)) {
                $this->addError('inicio', 'A data de início está maior que a de fim!');
            }

            if($this->embarcacao_macros_id == null) {
                $this->addError('embarcacao_macros_id', 'Informe a categoria do banner');
            }

            if($this->usuarios_id == null) {
                $this->addError('usuarios_id', 'Favor relacione o banner a algum usuário');
            }
        }


        return parent::beforeValidate();
    }


    /**
     * Search
     * @return [type] [description]
     */
    public function search() {
        $criteria = new CDbCriteria;
        //$criteria->condition = "status = 1";
        $criteria->compare('id', $this->id);
        $criteria->compare('titulo', $this->titulo, true);
        $criteria->compare('embarcacao_macros_id', $this->embarcacao_macros_id);
        $criteria->compare('usuarios_id', $this->usuarios_id);
        $criteria->compare('imagem', $this->imagem, true);
        $criteria->compare('imagem_topo', $this->imagem_topo, true);
        $criteria->compare('local', $this->local);
        $criteria->compare('views', $this->views, true);
        $criteria->compare('cliques', $this->cliques, true);
        $criteria->compare('inicio', $this->inicio, true);
        $criteria->compare('fim', $this->fim, true);
        $criteria->compare('link', $this->link, true);
        $criteria->compare('status', $this->status);

        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria
        ));
    }


    // método que formata a data para salvar no banco
    public static function formatDateTimeToDb($datetime) {
        $tmp = strtotime(str_replace("/", "-", $datetime));
        return date("Y-m-d H:i:s", $tmp);
    }

    // método que formata a data para exibir na view
    public static function formatDateTimeToView($datetime) {
        $tmp = strtotime($datetime);
        return date("d/m/Y", $tmp);
    }


    // método que valida a dimensao da imagem e tamanho do banner expansivo
    // imagem -> imagem do banner
    // abertoFechado -> indica se é a imagem "do topo" ou a imagem normal do banner expansivo
    // 1 -> é a imagem fechada
    // 2 -> imagem aberta
    public static function validarImagemDeBannerExpansivo(CUploadedFile $imagem, $abertoFechado) {

         /*
            Superior Expansivo
            Fechado: 1190x70px
            Aberto: 1190x460px
            JPEG/PNG - 400kb
            GIF - 800 kb
         */

        // width
        $arrayWidth = getimagesize($imagem->getTempName());
        $width = $arrayWidth[0];

        // height
        $arrayHeight = getimagesize($imagem->getTempName());
        $height = $arrayHeight[1];

        // taamanho em kbytes
        $size = $imagem->size / 1024;


        // formato do banner
        $formato = $imagem->type;

        // validar tamanho se for jpg
        if($formato == Banners::JPG || $formato == Banners::JPEG) {

            if($size > Banners::TAMANHO_MAX_JPG_BANNER_TOPO) {
                return Banners::ERRO_EXCEDEU_PESO;
            }
        }

        // validar tamanho se for png
        if($formato == Banners::PNG) {

            if($size > Banners::TAMANHO_MAX_PNG_BANNER_TOPO) {
                return ERRO_EXCEDEU_PESO;
            }
        }

        // validar tamanho se for gif
        if($formato == Banners::GIF) {

            if($size > Banners::TAMANHO_MAX_GIF_BANNER_TOPO) {
                return Banners::ERRO_EXCEDEU_PESO;
            }
        }


        // validar imagem fechada
        if($abertoFechado == Banners::BANNER_FECHADO) {

            if($width > Banners::WIDTH_MAX_BANNER_TOPO_FECHADO) {
                return Banners::ERRO_EXCEDEU_LARGURA;
            }

            if($height > Banners::HEIGHT_MAX_BANNER_TOPO_FECHADO) {
                return Banners::ERRO_EXCEDEU_ALTURA;
            }
        }

        // validar imagem aberta
        else {

            if($width > Banners::WIDTH_MAX_BANNER_TOPO_ABERTO) {
                return Banners::ERRO_EXCEDEU_LARGURA;
            }

            if($height > Banners::HEIGHT_MAX_BANNER_TOPO_ABERTO) {
                return Banners::ERRO_EXCEDEU_ALTURA;
            }
        }

        // tudo ok
        return 1;
    }

     // método que valida a dimensao da imagem e tamanho do banner normal
    // imagem -> primeira imagem
    // posicao -> lateral ou horizontal
    public static function validarImagemDeBanner(CUploadedFile $imagem, $posicao) {

         /*
            2. Banner Horizontal 728 x 90 px
            3. Banner Lateral 200 x 446 px
               100 kb = jpg/png
               600 kb = gif
         */

        // width
        $arrayWidth = getimagesize($imagem->getTempName());
        $width = $arrayWidth[0];

        // height
        $arrayHeight = getimagesize($imagem->getTempName());
        $height = $arrayHeight[1];

        // taamanho em kbytes
        $size = $imagem->size / 1024;

        // formato do banner
        $formato = $imagem->type;

        // validar tamanho se for jpg
        if($formato == Banners::JPG || $formato == Banners::JPEG) {

            if($size > Banners::TAMANHO_MAX_JPG) {

                return Banners::ERRO_EXCEDEU_PESO;
            }
        }

        // validar tamanho se for png
        if($formato == Banners::PNG) {

            if($size > Banners::TAMANHO_MAX_PNG) {
                return Banners::ERRO_EXCEDEU_PESO;
            }
        }

        // validar tamanho se for gif
        if($formato == Banners::GIF) {

            if($size > Banners::TAMANHO_MAX_GIF) {
                return Banners::ERRO_EXCEDEU_PESO;
            }
        }


        // validar se for lateral
        if($posicao == Banners::LATERAL) {

            if($width > Banners::WIDTH_MAX_BANNER_LATERAL) {
                return Banners::ERRO_EXCEDEU_LARGURA;
            }

            if($height > Banners::HEIGHT_MAX_BANNER_LATERAL) {
                return Banners::ERRO_EXCEDEU_ALTURA;
            }
        }

        // horizontal
        else {

            if($width > Banners::WIDTH_MAX_BANNER_HORIZONTAL) {
                return Banners::ERRO_EXCEDEU_LARGURA;
            }

            if($height > Banners::HEIGHT_MAX_BANNER_HORIZONTAL) {
                return Banners::ERRO_EXCEDEU_ALTURA;
            }
        }

        // tudo ok
        return 1;
    }



    /**
     * Método que carrega qualquer banner
     * @param  [int] $orientacao [Horizontal ou Vertical]
     * @param  [int] $local      [Topo, Centro ou Rodapé]
     * @param  [int] $macro      [ID da macro, para segmentar (lancha, veleiro e jetski)]
     * @return [Model]           [Model]
     */
    public static function loadBanner($local, $macro = null, $array_image = array(), $link = false, $array_link = array()) {

        $condition = 'status = 1 AND inicio <= NOW() AND fim > NOW() AND local = :local AND (embarcacao_macros_id IS NULL OR embarcacao_macros_id = 0 OR embarcacao_macros_id = :macro)';
        $params = array(':local'=>$local, ':macro'=>EmbarcacaoMacros::$macro_by_slug['lancha']);

        if ($macro != null && ($macro == EmbarcacaoMacros::$macro_by_slug['jetski'] || $macro == EmbarcacaoMacros::$macro_by_slug['veleiro'] || $macro == EmbarcacaoMacros::$macro_by_slug['barcos-pesca'])) {
            $params[':macro'] = $macro;
        }

        $criteria = new CDbCriteria();
        $criteria->condition = $condition;
        $criteria->params = $params;
        $criteria->limit = 1;
        $criteria->order = 'RAND()';

        // Banner
        $model = self::model()->find($criteria);
        $html = '';

        if ($model != null) {

            // contabilizar views
            #$model->views += 1;
            #$model->update();

            // Se for banner de topo, cria um DATA para substituir o SRC
            if ($local == self::TOPO) {

                // mobile eh a imagem expansiva q deve aparecer
                if(Utils::checarSeEhMobile()) {
                    $model->imagem = $model->imagem_topo;
                }
                $array_image['data-original'] = Yii::app()->baseUrl . '/' . self::PATH . '/' . $model->imagem;
                $array_image['data-expanded'] = Yii::app()->baseUrl . '/' . self::PATH . '/' . $model->imagem_topo;

                // @@
                @$height = getimagesize(Yii::app()->getBaseUrl(true) .'/public/banners/'.$model->imagem_topo);

                $array_image['data-height'] = $height[1];

                if (array_key_exists("class", $array_link)) {
                    $array_link['class'] .= " advertise-head-link";
                } else {
                    $array_link['class'] = "advertise-head-link";
                }

            }

            // se tem título (aidax)
            if (!empty($model->titulo))
                $array_link['data-ax-content-click'] = $model->titulo;

            $array_image['data-banner_id'] = $model->id;

            $array_link['data-id'] = $model->id;

            if (array_key_exists("class", $array_link)) {
                $array_link['class'] .= " banner-link";
            } else {
                $array_link['class'] = "banner-link";
            }

            $image = CHtml::image(Yii::app()->baseUrl . '/' . self::PATH . '/' . $model->imagem, 'Banner', $array_image);


            $link = CHtml::link($image, $model->link, $array_link);

            if ($link == true) {

                $array_link['target'] = '_blank';
                $array_link['rel'] = 'nofollow';

                if(strpos($model->link, "http://") === false){
                  $model->link = "http://" . $model->link;
                }

                $html = CHtml::link($image, $model->link, $array_link);

            } else {
                $html = $image;
            }

        }


        return $html;
    }

}
