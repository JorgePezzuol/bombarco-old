
<?php

class Utils {

    // Imagem Fake usada quando não existe a real
    const IMAGE_FAKE = "img/sem_foto_bb.jpg";

    /**
     * Padrão de Status
     * usado no projeto para esconder ou não dados
     * @var array
     */
    public static $_status = array('0' => 'Não', '1' => 'Sim');

    // método que formata a data para exibir na view
    public static function formatDateTimeToView($datetime) {
        $tmp = strtotime($datetime);
        return date("d/m/Y H:i", $tmp);
    }

    // function que detecta se a requisição é de algum dispositivo mobile
    public static function isMobileBrowser() {
      return false;
        #$useragent = $_SERVER['HTTP_USER_AGENT'];
        #return preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4));
    }

    // function que detecta se a requisição é de algum dispositivo mobile
    public static function checarSeEhMobile() {

        $useragent = $_SERVER['HTTP_USER_AGENT'];
        
        return preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4));
    }

    /**
     * Funcão que gera o slug da URL
     * para página de detalhe
     * @param  [type] $text [description]
     * @return [type]       [description]
     */
    public static function slugify($text) {

        $table = array(
            'Š' => 'S', 'š' => 's', 'Đ' => 'Dj', 'đ' => 'dj', 'Ž' => 'Z', 'ž' => 'z', 'Č' => 'C', 'č' => 'c', 'Ć' => 'C', 'ć' => 'c',
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O',
            'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
            'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o',
            'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b',
            'ÿ' => 'y', 'Ŕ' => 'R', 'ŕ' => 'r', '/' => '-', ' ' => '-', '?' => '', ',' => '', '.' => ''
        );

        // -- Remove duplicated spaces
        $stripped = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $text);

        // -- Returns the slug
        return strtolower(strtr($stripped, $table));
    }

    /**
     * Gera nome aleatório pra imagem
     * @param  [type] $image [description]
     * @return [type]        [description]
     */
    public static function genImageName($image) {

        $ext = $image->getExtensionName();
        $name = uniqid();

        return $name . '.' . $ext;
    }

    public static function chckFolder($fileSavepath) {

        if (!file_exists($fileSavePath))
            mkdir($fileSavePath, 0, true);
    }

    /**
     * Método que converte o preço pt-br no formato do mysql
     * @param  [type] $valor [preço]
     * @return [type]        [description]
     */
    public static function formataValor($valor) {

        return str_replace(',', '.', str_replace('.', '', $valor));

    }

    /**
     * Formata o valor para ser exibido
     * @param  [type] $valor [description]
     * @return [type]        [description]
     */
    public static function formataValorView($valor) {
        if(!is_string($valor))
          return number_format($valor, 2, ",", ".");
        return $valor;
    }

    /**
     * Breadcrumbs
     * @param  [type] $array [description]
     * @return [type]        [description]
     */
    public static function breadCrumbs($array) {

        $breadcrumbs = '';
        $count = 1;

        foreach ($array as $key => $value) {

            $breadcrumbs .= CHtml::link($value['texto'], $value['link']);

            if ($count < count($array)) {
                $breadcrumbs .= ' > ';
                $count++;
            }
        }

        return $breadcrumbs;
    }

    /**
     * Separa o ID do video do Youtube
     * @param  [type] $url [description]
     * @return [type]      [description]
     */
    public static function getYoutubeID($url) {

        parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);

        if(isset($my_array_of_vars['v'])) {
            return $my_array_of_vars['v'];    
        }
        
    }

    /**
     * Detecta se é página de busca e aplica noIndex e noFollow
     * @return [type] [description]
     */
    public static function noIndex() {

        Yii::app()->clientScript->registerMetaTag('index,follow', 'robots');

        //$url = Yii::app()->request->url;

        /*if (strpos($url, "/busca") !== FALSE) {
            Yii::app()->clientScript->registerMetaTag('noindex,nofollow', 'robots');
        } else {
            Yii::app()->clientScript->registerMetaTag('index,follow', 'robots');
        }*/
    }

    /**
     * Carrega e exibe as metatags
     * @return [type] [description]
     */
    public static function metaTags($controller) {


        /*$url = Yii::app()->request->url;
       
        $seo = Seo::model()->find('url LIKE :url', array(':url' => '%' . $url));


        // Se existe SEO cadastrado
        if ($seo != NULL) {

            if (!empty($seo->canonical))
                Yii::app()->clientScript->registerMetaTag($seo->canonical, 'canonical', null, array(), 'bombarco_canonical');

            if (!empty($seo->description))
                Yii::app()->clientScript->registerMetaTag($seo->description, 'description', null, array(), 'bombarco_description');

            if (!empty($seo->keywords))
                Yii::app()->clientScript->registerMetaTag($seo->keywords, 'keywords', null, array(), 'bombarco_keywords');

            // montando robots
            $robots = array(0 => 'follow', 1 => 'index');
            if ($seo->follow == 0)
                $robots[0] = 'nofollow';
            if ($seo->index == 0)
                $robots[1] = 'noindex';

            Yii::app()->clientScript->registerMetaTag(implode(',', $robots), 'robots');

            if (!empty($seo->title)) {
               echo '<title>' . CHtml::encode($seo->title) . '</title>';
               echo '<meta name="ax_title" content="' . CHtml::encode($seo->title) . '">';
               echo '<meta name="ax_category" content="Interna">';
            }

        } else {
      
            //Yii::app()->clientScript->registerMetaTag('index,follow', 'robots');
            Yii::app()->clientScript->registerMetaTag('noindex,nofollow', 'robots');
            echo '<title>' . CHtml::encode($controller->pageTitle) . '</title>';
            echo '<meta name="ax_title" content="' . CHtml::encode($controller->title) . '">';
            echo '<meta name="ax_category" content="Interna">';

        }*/


        
        $url = Yii::app()->request->url;
       
        $seo = Seo::model()->find('url LIKE :url', array(':url' => '%' . $url));

        $robots = array(0 => 'follow', 1 => 'index');

        if(strpos($url, "admin") == false) {

            if ($seo != NULL) {

                if (!empty($seo->canonical))
                    Yii::app()->clientScript->registerMetaTag($seo->canonical, 'canonical', null, array(), 'bombarco_canonical');

                if (!empty($seo->description))
                    Yii::app()->clientScript->registerMetaTag($seo->description, 'description', null, array(), 'bombarco_description');

                if (!empty($seo->keywords))
                    Yii::app()->clientScript->registerMetaTag($seo->keywords, 'keywords', null, array(), 'bombarco_keywords');

                // montando robots
                if ($seo->follow == 0)
                    $robots[0] = 'nofollow';
                if ($seo->index == 0)
                    $robots[1] = 'noindex';
            }
        }

        else {

            $robots[0] = 'nofollow';
            $robots[1] = 'noindex';
        }


        Yii::app()->clientScript->registerMetaTag(implode(',', $robots), 'robots');

        if (!empty($seo->title)) {
           echo '<title>' . CHtml::encode($seo->title) . '</title>';
        }

    }

    /**
     * Redireciona para domínio com WWW caso não tenha
     * @return [type] [description]
     */
    public static function redirectWWW() {

        // Selecionar URL
        $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        if (preg_match('/index\.php/', $url)) {
            $url = preg_replace('/index\.php/', '', $url);
            $url = preg_replace('/\/$/', '', $url);
            $redirect = 'http://' . $url;
            Yii::app()->request->redirect($redirect, true, 301);
            exit();
        }

        // Se não tiver WWW, redireciona
        if (strpos($url, "www") === FALSE) {

            $redirect = 'http://www.' . $url;

            // Se tiver index.php no final, remove
            if (strpos(Yii::app()->request->url, "index.php") !== FALSE)
                $redirect = 'http://www' . str_replace("index.php", "", $url);

            Yii::app()->request->redirect($redirect, true, 301);
            exit();
        }

        // Se tiver index.php remove e redireciona
        if (strpos(Yii::app()->request->url, "index.php") !== FALSE) {
            $redirect = 'http://' . $url . str_replace("index.php", "", Yii::app()->request->url);
            Yii::app()->request->redirect($redirect, true, 301);
            exit();
        }
    }

    /**
     * Add WWW nas urls
     * @param [string] $url [URL]
     */
    public static function checkWWW($url) {

        if (strpos($url, "http://www") === FALSE) {
            $tmp = explode("http://", $url);
            $url = "http://www." . $tmp[1];
        }

        return $url;
    }

    /**
     * Verifica se aquela URL precisa de um Redirect
     * Executa o Redirect para a URL nova
     */
    public static function redirect() {

        // Selecionar URL
        $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        // Se for algum arquivo retorna
        if (preg_match("/(\.jpg|\.jpeg|\.png|\.gif)$/", $url) == 1)
            return null;

        // Remove barra final '/'
        $url = preg_replace('/\/$/', '', $url);

        // Remove /index.php
        $url = preg_replace('/\/index\.php/', '', $url);

        // Remove WWW. e HTTP://
        $url = preg_replace('/(www\.|http:\/\/)/', '', $url);

        $url2 = 'www.' . $url;
        $url3 = 'http://' . $url;
        $url4 = 'http://www.' . $url;

        $redirect = Redirects::model()->find('de = :url OR de = :url2 OR de = :url3 OR de = :url4 and status = 1', array(':url'=>$url, ':url2'=>$url2, ':url3'=>$url3, ':url4'=>$url4));
        if ($redirect != NULL) {

            // Se existir um destino
            if (!empty($redirect->para)) {

                // Se tiver HTTP://
                if (strpos($redirect->para, 'http://') !== FALSE) {
                    Yii::app()->request->redirect($redirect->para, true, 301);
                } else {
                    Yii::app()->request->redirect('http://' . $redirect->para, true, 301);
                }

                exit();

            } else { // Se não, recua a URL até a base

                $uri = $_SERVER['REQUEST_URI'];

                // Caminho da URL
                $base = explode('/', $uri);

                // Para redirecionar  para uma base, precisa ter no mínimo 2 valores no PATH
                if (count($base) >= 3) {
                    $url_base = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $base[1];
                    Yii::app()->request->redirect($url_base, true, 301);
                    exit();
                }

            }

        } else { // Se não achar nada no banco, executa padrões

            $uri = $_SERVER['REQUEST_URI'];

            if (preg_match('/noticias\/exibir/', $uri)) {
                Yii::app()->request->redirect(Yii::app()->createUrl('/comunidade/noticias'), true, 301);
                exit();
            }

            if (preg_match('/materias\/exibir/', $uri)) {
                Yii::app()->request->redirect(Yii::app()->createUrl('/comunidade/blog'), true, 301);
                exit();
            }

            if (preg_match('/imagem\?src=images/', $uri)) {
                Yii::app()->request->redirect(Yii::app()->createUrl('/comunidade'), true, 301);
                exit();
            }
        }

    }

    /**
     * Redirect manual de páginas que existem
     * @return [type] [description]
     */
    public static function redirectManual() {

        $urls = array(
            "http://www.seguro.bombarco.com.br" => "http://www.bombarco.com.br/anuncios/index",
            "http://www.bombarco.com.br/site/index" => "http://www.bombarco.com.br",
            "http://www.bombarco.com.br/index" => "http://www.bombarco.com.br",
            "http://www.bombarco.com.br/site" => "http://www.bombarco.com.br",
        );

        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url2 = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if (array_key_exists($url, $urls)) {

            if (strpos($urls[$url], 'http://') !== FALSE) {
                Yii::app()->request->redirect($urls[$url], true, 301);
            } else {
                Yii::app()->request->redirect('http://' . $urls[$url], true, 301);
            }

            exit();
        }

        if (array_key_exists($url2, $urls)) {

            if (strpos($urls[$url2], 'http://') !== FALSE) {
                Yii::app()->request->redirect($urls[$url2], true, 301);
            } else {
                Yii::app()->request->redirect('http://' . $urls[$url2], true, 301);
            }

            exit();
        }
    }


    /**
     * Metatag Canonical
     * @return [type] [description]
     */
    public static function canonicalMeta() {

        // Selecionar URL
        $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $url = preg_replace('/\/$/', '', $url);

        // Canonical WWW e Index.php
        if (preg_match('/index.php/', $url) || !preg_match('/www\./', $url)) {
            $new_url = preg_replace('/www\./', '', $url);
            $new_url = 'http://www.' . preg_replace('/index.php/', '', $new_url);
            $new_url = preg_replace('/\/$/', '', $new_url);
            echo '<link rel="canonical" href="'.$new_url.'" />';
        }

        // Canonical Novas/Usadas
        /*$pattern = '/\/(jet-skis|veleiros|lanchas|pesca)-(usados|novos|novas|usadas)/';
        if (preg_match($pattern, $url)) {
            $new_url = preg_replace('/www\./', '', $url);
            $new_url = 'http://www.' . preg_replace($pattern, '', $new_url);
            echo '<link rel="canonical" href="'.$new_url.'" />';
        }*/

        // Canonical Busca
        $pattern = '/\/busca.*/';
        if (preg_match($pattern, $url)) {
            $new_url = preg_replace('/www\./', '', $url);
            $new_url = 'http://www.' . preg_replace($pattern, '', $new_url);
            echo '<link rel="canonical" href="'.$new_url.'" />';
        }

    }


    public static function mountTitle($array) {
        return trim(implode(' ', $array));
    }


    public static function mountDescription($array) {

        $description = trim(implode(' ', $array));

        if (count($array) > 0)
            $description .= '. ';

        return  $description . 'Acesse o Bombarco o Líder em Classificados Náuticos e faça um Bom Negócio de Capitão para Capitão.';
    }

    public static function youtube_id_from_url($url) {
        $pattern = 
            '%^# Match any youtube URL
            (?:https?://)?  # Optional scheme. Either http or https
            (?:www\.)?      # Optional www subdomain
            (?:             # Group host alternatives
              youtu\.be/    # Either youtu.be,
            | youtube\.com  # or youtube.com
              (?:           # Group path alternatives
                /embed/     # Either /embed/
              | /v/         # or /v/
              | /watch\?v=  # or /watch\?v=
              )             # End path alternatives.
            )               # End host alternatives.
            ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
            $%x'
            ;
        $result = preg_match($pattern, $url, $matches);
        if ($result) {
            return $matches[1];
        }
        return false;
    }

    // método que formata a data para salvar no banco
    public static function formatDateTimeToDb($datetime) {
        $tmp = strtotime(str_replace("/", "-", $datetime));
        return date("Y-m-d H:i:s", $tmp);
    }

}
