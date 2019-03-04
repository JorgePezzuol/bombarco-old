<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/datatable.css?e=1'); ?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/datatable.min.js'); ?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/datatable.select.js'); ?>


<br/><br/>
<div class="container">

        <h1>URL de anúncios ativos</h1>
        <br/>
        <p style="
    font-weight: bolder;
    color: red;
    font-style: italic;
">FAVOR NAO MECHER NO Q ESTA EM VERMELHO !!</p>
        <br/><br/>
        <table id="tabela" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($embarcs as $emb): ?>
                    <tr>
                        <td style="color:red;">
                            <?php echo $emb->id; ?>
                        </td>

                        <td style="color:red;">
                            <?php echo "https://www.bombarco.com.br"; ?>
                        </td>

                        <td class="text-center" style="color:red;">
                            <?php 
                                if($emb->macros_id == 3) {
                                    $url = Embarcacoes::mountUrl($emb); 
                                    $url = str_replace($emb->slug,"", $url);
                                    echo $url;  
                                }
                                else {
                                    echo Embarcacoes::mountUrl_slugs($emb) . "/"; 
                                    
                                }                            

                            ?>
                        </td>

                        <td>
                            <?php echo $emb->slug; ?>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

</div>


<!-- fim lightboxes -->

<style>
td, tr {
    cursor: pointer !important;
        white-space: nowrap;
    font-size: 13px;
    font-weight: bolder;
}

#ejbeatycelledit {
    width: 100% !important;
}
</style>

<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/datatable.css?e=1'); ?>

<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/font-awesome.min.css?e1');?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/datatable.min.js'); ?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/datatable_cell_edit.js?e=23'); ?>



<script>
$(document).ready(function () {

    var tabela = $('#tabela').DataTable({
        pageLength: 10,
        select: true,
        select: {
            style: 'multi'
        },
        "language": {
            "url": "https://www.bombarco.com.br/datatables.json"
        },
        initComplete: function( settings, json ) {
        }
    });


    tabela.MakeCellsEditable({
        "onUpdate": myCallbackFunction
    });


    function myCallbackFunction(updatedCell, updatedRow, oldValue) {

        var old_ = "https://www.bombarco.com.br" + updatedRow.data()[2] + oldValue;
        var new_ = "https://www.bombarco.com.br" + updatedRow.data()[2] + updatedRow.data()[3];

        var s = confirm("Confirmar ação?\n\n"+old_+"\n --->\n"+new_);

        if(s) {

            console.log(updatedRow.data()[0]);
            console.log(updatedRow.data()[3]);

            $.ajax({
                url: Yii.app.createUrl("embarcacoes/alteraSlug"),
                data: {
                    id: updatedRow.data()[0],
                    slug: updatedRow.data()[3]
                },
                type: "POST",
                success: function(resp) {
                    if(resp.trim() == 1) {
                        alert("Slug alterado com sucesso");
                    }
                    else {
                        alert("Erro inesperado, contate o dev do site");
                    }
                },
                error: function() {
                    alert("Erro inesperado, contate o dev do site");
                }
            });
        }
        else {
            updatedCell.data(oldValue);
        }

        console.log("The new value for the cell is: " + updatedCell.data());
        console.log("The old value for that cell was: " + oldValue);
        console.log("The values for each cell in that row are: " + updatedRow.data());
    }

});
</script>
