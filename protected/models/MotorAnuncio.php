<?php

Yii::import('application.models._base.BaseMotorAnuncio');

class MotorAnuncio extends BaseMotorAnuncio
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public static function totalizarCliques($usuarios_id, $motor_anuncio_id = null) {

        if($motor_anuncio_id == null) {

            $r = Yii::app()->db->createCommand()
                ->select('sum(clicks) as total')
                ->from('motor_anuncio')
                ->where('usuarios_id = ' . Yii::app()->user->id. ' and status <> 7')
                ->queryRow();    

        }

        else {

            $r = Yii::app()->db->createCommand()
                ->select('sum(clicks) as total')
                ->from('motor_anuncio')
                ->where('id = ' . $motor_anuncio_id)
                ->queryRow();
        }

        return $r["total"] == NULL ? 0 : $r["total"];
    }

    public function totalizarVerTelefone($usuarios_id, $motor_anuncio_id = null) {


        if($motor_anuncio_id == null) {

            $r = Yii::app()->db->createCommand()
                ->select('sum(ver_telefone) as total')
                ->from('motor_anuncio')
                ->where('usuarios_id = ' . Yii::app()->user->id. ' and status <> 7')
                ->queryRow();    

        }

        else {

            $r = Yii::app()->db->createCommand()
                ->select('sum(ver_telefone) as total')
                ->from('motor_anuncio')
                ->where('id = ' . $motor_anuncio_id)
                ->queryRow();
        }

        return $r["total"] == NULL ? 0 : $r["total"];

    }

    public static function totalizarMensagens($usuarios_id, $motor_anuncio_id = null) {


        if($motor_anuncio_id == null) {

            $r = Yii::app()->db->createCommand()
                ->select('count(motor_anuncio_id) as total')
                ->from('contatos')
                ->where('email_dest = "'.Usuarios::getUsuarioLogado()->email.'"')
                ->queryRow();    

        }

        else {

            $r = Yii::app()->db->createCommand()
                ->select('count(motor_anuncio_id) as total')
                ->from('contatos')
                ->where('motor_anuncio_id = ' . $motor_anuncio_id)
                ->queryRow();
        }


        return $r["total"] == NULL ? 0 : $r["total"];
    }

    public static function verSeEhDono($id) {

        $motor = self::model()->findByPk($id);
        
        if($motor == null) return false;

        if(Yii::app()->user->isAdmin()) return true;

        if($motor->usuarios_id != Yii::app()->user->id) {
            return false;
        }

        return true;
    }

    public static function listarImagens($motorAnuncio) {

        $criteria = new CDbCriteria();
        $criteria->condition = 't.motor_anuncio_id = :motor_anuncio_id';
        $criteria->params = array(":motor_anuncio_id" => $motorAnuncio->id);
        $criteria->order = "t.ordem ASC";

        return MotorImagens::model()->findAll($criteria);
    }

	public static function verSePodeAnunciar($plano_usuarios_id) {

		if($plano_usuarios_id == null) return false;

    	$planoUsuarios = PlanoUsuarios::model()->findByPk($plano_usuarios_id);
    	$usuarios_id = Yii::app()->user->id;
    	$qtdeAnuncios = MotorAnuncio::model()
    		->count("plano_usuarios_id = :plano_usuarios_id", 
    			array(":plano_usuarios_id"=>$plano_usuarios_id));

    	if( ($planoUsuarios->usuarios_id != $usuarios_id) 
    		|| (($qtdeAnuncios) >= $planoUsuarios->qntpermitida) ) {

    		return false;
    	}

    	return true;
	}

    public static function nomeAnuncio2($id) {

        $motorAnuncio = self::model()->findByPk($id);

        return $motorAnuncio->motorFabricantes->titulo . " " . $motorAnuncio->motorTipos->titulo . " " . $motorAnuncio->potencia;
    }

    public static function nomeAnuncio($motorAnuncio) {

        return $motorAnuncio->motorFabricantes->titulo . " " . $motorAnuncio->motorTipos->titulo . " " . $motorAnuncio->potencia;
    }

    public static function obterImgPrincipalPreview($motorAnuncio) {

        $motorImagem = MotorImagensPreview::model()->find("motor_anuncio_preview_id = :id AND ordem = 0", array(":id" => $motorAnuncio->id));

        if($motorImagem != null) {

            return $motorImagem->imagem;
        }

        return null;
    }

    public static function obterImgPrincipal($motorAnuncio) {

        $motorImagem = MotorImagens::model()->find("motor_anuncio_id = :id AND ordem = 0", array(":id" => $motorAnuncio->id));

        if($motorImagem != null) {

            return $motorImagem->imagem;
        }

        return null;
    }

    public static function obterImgPrincipal2($id) {

        $motorAnuncio = self::model()->findByPk($id);
        
        $motorImagem = MotorImagens::model()->find("motor_anuncio_id = :id AND ordem = 0", array(":id" => $motorAnuncio->id));

        if($motorImagem != null) {

            return $motorImagem->imagem;
        }

        return null;
    }

    public static function gerarSlug($motorAnuncio) {

        // ex: mercury/centro-rabeta/265, mercury/rabeta-centro/265-2, mercury/rabeta-centro/265-3
        $slug = $motorAnuncio->motorFabricantes->slug."/".$motorAnuncio->motorTipos->slug."/".$motorAnuncio->potencia;

        $existe = MotorAnuncio::model()->exists("slug = :slug and id != :id", array(":slug" => $slug, ":id" => $motorAnuncio->id));
        
        if($existe) {
            for($i = 2; $i < 1000; $i++) {
                $slug_ = "";
                $slug_ = $slug."-".$i;
                $existe = MotorAnuncio::model()->exists("slug = :slug and id != :id", array(":slug" => $slug_, ":id" => $motorAnuncio->id));
                if($existe) {
                    continue;
                }
                $slug = $slug_;
                break;
            }
        }

        return $slug;
    }

    public static function gerarLinkAbsoluto($motorAnuncio) {

        // ex: motores/mercury/centro-rabeta/265, motores/mercury/rabeta-centro/265-2, motores/mercury/rabeta-centro/265-3
        return "https://www.bombarco.com.br/motores/".$motorAnuncio->slug;
    }

    public static function getThumb($model, $array_image = array(), $link = false, $array_link = array(), $guid = null) {
        
        $img = self::obterImgPrincipal($model);

        if ($img != null) {
            $url = Yii::getPathOfAlias('webroot') . '/public/motores/' . $img;
        } else {
            $url = Yii::getPathOfAlias('webroot') . '/themes/bombarco/img/sem_foto_bb.jpg';
        }

        if (Yii::app()->theme->name == 'mobile') {
            $thumb = @Yii::app()->easyImage->thumbSrcOf($url, array('scaleAndCrop' => array('width' => 75, 'height' => 75)));
        } else {

            $thumb = @Yii::app()->easyImage->thumbSrcOf($url, array('scaleAndCrop' => array('width' => 225, 'height' => 150)));
        }


        //$thumb = "http://www.bombarco.com.br/assets/easyimage/a/a45e8a437d8c75ebe8b10924dc5ac60f.jpeg";

        $array_image += array('title'=>self::nomeAnuncio($model));
        $image = CHtml::image($thumb, self::nomeAnuncio($model), $array_image);

        // Se for Link, retorna o link completo
        if (Yii::app()->theme->name == 'mobile') {
            return $image;
        } else {

            if ($link === true) {
                return CHtml::link($image, self::gerarLinkAbsoluto($model), $array_link);
            } else { // Se não retorna só a IMG
                return $image;
            }
        }
    }


}