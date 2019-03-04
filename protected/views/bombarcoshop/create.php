<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/js/fineuploader/fine-uploader-new.css'); ?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/fineuploader/jquery.fine-uploader.js?'.microtime(), CClientScript::POS_END); ?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.price_format.2.0.min.js', CClientScript::POS_END); ?>

<div class="container">
<?php $form = $this->beginWidget('GxActiveForm', array(
  'enableAjaxValidation' => true,
  'id'=>'bombarcoshopform',
  'action' => Yii::app()->createUrl("admin/bombarcoshop/create"),
  'htmlOptions'=>array('enctype'=>'multipart/form-data')
));
?>
<?php
do {
    $flg = false;
    if(Bombarcoshop::model()->find(array("order"=>"id DESC")) == null) {
        $id = 0;
    }
    else {
        $id = Bombarcoshop::model()->find(array("order"=>"id DESC"))->id + 5;        
    }
    $id_produto = rand($id, 999);
    if(Bombarcoshop::model()->findByPk($id_produto) == null) {
        $flg = true;
    }
} while(!$flg);
echo "<input name='id_produto' id='id_produto' type='hidden' value='".$id_produto."'/>";
?>
  <legend><h2>Cadastro de novo produto no Bombarcoshop</h2></legend>

    <?php
        foreach(Yii::app()->user->getFlashes() as $key => $message) {

            echo '<div class="alert alert-' . $key . '">';
            echo $message;
            echo '</div>';
        }
    ?>


    <div class="row">
        <div class="col-md-3">
          <label for="ex1">Título</label>
          <?php echo $form->textField($model, 'nome', array('maxlength' => 120, 'class'=>'required form-control')); ?>
          <!--<input class="form-control" id="ex1" type="text">-->
        </div>
        <div class="col-md-3">
          <label for="ex2">Valor</label>
          <?php echo $form->textField($model, 'valor', array('class'=>'required form-control', 'id'=>'valor')); ?>
        </div>
        <div class="col-md-3">
          <label for="ex3">Data início</label>
          <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                'name'=>'BombarcoshopForm[data_inicio]',
                'options'=>array(
                   'dateFormat'=>'dd/mm/yy',
                   'startDate'=>date("yy-mm-dd"),
                   'minDate'=>'0',  // this will disable previous dates from datepicker
                   'onSelect'=>'js:function(i,j) {

                       function JSClock() {
                            var time = new Date();
                            var hour = time.getHours();
                            var minute = time.getMinutes();
                            var second = time.getSeconds();
                            var temp="";
                            temp +=(hour<10)? "0"+hour : hour;
                            temp += (minute < 10) ? ":0"+minute : ":"+minute ;
                            temp += (second < 10) ? ":0"+second : ":"+second ;
                            return temp;
                        }

                        $v=$(this).val();
                        $(this).val($v+" "+JSClock());
                          
                    }',
               
                ),
                'language'=> 'pt-BR',
                'htmlOptions'=>array(
                    'style'=>'',
                    'class'=>'form-control required',
                ),

            ));
          ?>
        </div>
        <div class="col-md-3">
          <label for="ex3">Data fim</label>
          <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                'name'=>'BombarcoshopForm[data_fim]',
                'options'=>array(
                   'dateFormat'=>'dd/mm/yy',
                   'startDate'=>date("yy-mm-dd"),
                   'minDate'=>'0',  // this will disable previous dates from datepicker
                   'onSelect'=>'js:function(i,j) {

                       function JSClock() {
                            var time = new Date();
                            var hour = time.getHours();
                            var minute = time.getMinutes();
                            var second = time.getSeconds();
                            var temp="";
                            temp +=(hour<10)? "0"+hour : hour;
                            temp += (minute < 10) ? ":0"+minute : ":"+minute ;
                            temp += (second < 10) ? ":0"+second : ":"+second ;
                            return temp;
                        }

                        $v=$(this).val();
                        $(this).val($v+" "+JSClock());
                          
                    }',
               
                ),
                'language'=> 'pt-BR',
                'htmlOptions'=>array(
                    'style'=>'',
                    'class'=>'form-control required',
                ),

            ));
          ?>
        </div>
    </div>
    <br/>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="comment">Descrição:</label>
          <textarea name="BombarcoshopForm[descricao]" class="required form-control" rows="5" id="comment"></textarea>
        </div>
      </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12 form-inline">
          <label for="ex1">Gerar</label>
          <input name="BombarcoshopForm[qtde_codigos]" style="width:50px;" value="200" class=" required form-control" id="ex1" type="text">
          <label for="ex2">códigos, com</label>
          <input name="BombarcoshopForm[porcentagem_desconto]" style="width:50px;" value="50" class="required form-control" id="ex2" type="text">
          <label for="ex2">% de desconto</label>
        </div>
    </div>
    <br/>
    <div id="uploader"></div>
    <br/>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" id="btn-cadastrar" class="btn btn-lg pull-right btn-primary">Cadastrar</button>
        </div>
    </div>

</div>
<?php
$this->endWidget();
?>
<!-- template usado no form de anuncio, esse primeiro ´e para upar fotos normais (nao turbo) -->
<script type="text/template" id="qq-template">
        <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="ou arraste as imagens aqui">
            <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
            </div>
            <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                <span class="qq-upload-drop-area-text-selector"></span>
            </div>
            <div class="buttons">
                <div class="qq-upload-button-selector qq-upload-button">
                    <div>Carregar fotos</div>
                </div>
                <button style="display:none;" type="button" id="trigger-upload-fotos" class="btn btn-primary">
                    <i class="icon-upload icon-white"></i> Upload
                </button>
            </div>
            <span style="display:none;" class="qq-drop-processing-selector qq-drop-processing">
                <span>Processando arquivos...</span>
                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
            <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
                <li>
                    <div class="qq-progress-bar-container-selector">
                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                    </div>
                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                    <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                    <span class="upload-file qq-upload-file-selector qq-upload-file"></span>
                    <!--<span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>-->
                    <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                    <span class="qq-upload-size-selector qq-upload-size"></span>
                    <button type="button" class="cancelar-foto qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancelar</button>
                    <!--<button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>
                    <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Delete</button>-->
                    <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                </li>
            </ul>

            <dialog class="qq-alert-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Close</button>
                </div>
            </dialog>

            <dialog class="qq-confirm-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">No</button>
                    <button type="button" class="qq-ok-button-selector">Yes</button>
                </div>
            </dialog>

            <dialog class="qq-prompt-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <input type="text">
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Cancel</button>
                    <button type="button" class="qq-ok-button-selector">Ok</button>
                </div>
            </dialog>
        </div>
    </script>


<script>
  $(document).ready(function() {

        $('#valor').priceFormat({
            prefix: '',
            centsSeparator: ',',
            thousandsSeparator: '.',
            clearPrefix: true
        });

        $('#uploader').fineUploader({
            template: 'qq-template', 
            request: {
                endpoint: Yii.app.createUrl("bombarcoshop/uploadFoto"),
                params: {
                    id_produto: $("#id_produto").val()
                }
            },
            thumbnails: {},
            autoUpload: false,
            validation: {
                allowedExtensions: ['jpeg', 'jpg', 'png'],
                itemLimit: 20,
                minSizeLimit: 1000, 
                sizeLimit: 1000000 // 1 Mb

            },
            callbacks: {

            },
            noFilesError: ""
        });

        $("#btn-cadastrar").on("click", function(e) {
            e.preventDefault();
            var flgok = true;
            $(".required").each(function(){
                if($(this).val() == "") {
                    $(this).css("border-color", "red");
                    flgok = false;
                }
            });
            if(!flgok) return false;
            if($(".cancelar-foto").length > 0) {
                $("#uploader").fineUploader("uploadStoredFiles");    
            }
            $("#bombarcoshopform").submit(); 
        });
  });
</script>





