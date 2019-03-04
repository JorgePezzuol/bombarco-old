<?php
    Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/guia_capitao.js', CClientScript::POS_END);
?>
      <style>

           html { 
                background: url(http://imagizer.imageshack.us/v2/1920x1100q90/661/SqjgHF.png) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }

            body {
                padding-top: 40px;
                padding-bottom: 40px;
              
               
            }

            .form-signin {
                max-width: 420px;
                padding: 105px 20px;
                margin: 0 auto;
                box-shadow:-1px 0px 4px #ccc;
                background:#FFF;
                margin-top:-100px;
                padding-bottom:40px;
            }
            .form-signin .form-signin-heading,
            .form-signin .checkbox {
                margin-bottom: 10px;
            }
            .form-signin .checkbox {
                font-weight: normal;
            }
            .form-signin .form-control {
                position: relative;
                height: auto;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                padding: 10px;
                font-size: 16px;
                margin-top: 6px;
                
            }
            .form-signin .form-control:focus {
                z-index: 2;
            }
            .form-signin input[type="email"] {
                margin-bottom: -1px;
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
            }
            .form-signin input[type="password"] {
                margin-bottom: 10px;
                border-top-left-radius: 0;
                border-top-right-radius: 0;
            }
            #btn-form {
                margin-top: 15px;
            }
            
               
            .btn-primary:hover {
                background-color: #018288;
                border-color: #018288;           
            }
            
            .btn-primary {
                background-color: #018288;
                border-color: #018288;
                
            }
            
            .form-control:focus {
                border-color: #018288;
            }
            
            toggle.btn-primary {
                background-color:#018288 !important;
                border-color:#018288 !important;
            }
            .logo-form {
                background: url('http://imagizer.imageshack.us/v2/470x683q90/537/0ER3j7.png') no-repeat -19px -36px;
                width: 433px;
                height: 442px;
                margin:0 auto;
                position:relative;
                z-index:999;
                margin-top:-35px;
            }
            .image-selo {
                background: url('http://imagizer.imageshack.us/v2/470x683q90/537/0ER3j7.png') no-repeat -244px -487px;
                width: 134px;
                height: 179px;
                display:inline-block;
                vertical-align:top;
                margin-top:15px;
            }
            .text-form {
                display: inline-block;
                vertical-align: top;
                margin-left: 243px;
                font-family: 'Open Sans', sans-serif;
                font-size: 28px;
                line-height: 30px;
                color:#E87D3D;
                margin-top:15px;

            }
            .container {
                width:940px !important;
            }
            .logo-bombarco {
                background: url('http://imagizer.imageshack.us/v2/470x683q90/537/0ER3j7.png') no-repeat -79px -541px;
                width: 105px;
                height: 59px;
                margin-top:-70px;
                margin-left:315px;
            }

            .btn-primary.active {
                background-color:#018288 !important;
                border-color:#018288 !important;
            }

        </style>

<div class="container">

            <div id='div-form'>
                <div class="logo-form"></div>
                <form class="form-signin" role="form">
                    <h4 class="form-signin-heading" id="msg" style="color: red;"></h4>
                    <input type="text" id="nome" class="form-control" placeholder="Nome*" value="" required autofocus>
                    <input type="text" id="empresa" class="form-control" placeholder="Empresa*" value="" required autofocus>
                    <input type="text" id="email" class="form-control" placeholder="Email*" value="" required autofocus>
                    <input type="text" id="telefone" class="form-control" placeholder="Telefone (Opcional)" value="" required="required" autofocus>
                   <button style="width: 100% !important;" onclick="_gaq.push(['_trackEvent', 'GuiaDoCapitao', 'click', 'Cadastrar']);" id="btn-form" class="href-anuncio botao-contratar-an" type="submit">Receber atendimento por email</button>

                    
                </form>
                <article class="text-form">Não fique de fora <br /> do guia mais completo <br /> de Santos à Angra.</article>
                <div class="image-selo"></div>
                <a href="<?php echo Yii::app()->homeUrl; ?>"><div class="logo-bombarco"></div></a>
            </div>

        </div> <!-- /container -->