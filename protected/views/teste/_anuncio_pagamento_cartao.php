<div class="linha-pagamento-4">
        <div class="container">
            <div class="box-pag-cartao">
                <div class="quad-box-pag-cartao">
                    <div class="title-pag-5"> Insira os dados do seu cartão </div>
                    <div id="error_general" class="text-pag-3 error_general">Você está em um ambiente seguro.</div>
                </div>  

                    <label class="radio">
                        <input type="radio" name="card_flag" id="cardAmerican" value="american" checked>
                        <?php echo CHtml::image(Yii::app()->baseUrl.'/img/american-express.png'); ?>
                    </label>

                    <label class="radio">
                        <input type="radio" name="card_flag" id="cardVisa" value="visa">
                        <?php echo CHtml::image(Yii::app()->baseUrl.'/img/visa.png'); ?>
                    </label>

                    <!--<label class="radio">
                        <input type="radio" name="card_flag" id="cardDiners" value="diners">
                        <?php echo CHtml::image(Yii::app()->baseUrl.'/img/american-express.png'); ?>
                    </label>-->

                    <label class="radio">
                        <input type="radio" name="card_flag" id="cardMaster" value="mastercard">
                        <?php echo CHtml::image(Yii::app()->baseUrl.'/img/mastercard.png'); ?>
                    </label>

                    <!--<label class="radio">
                        <input type="radio" name="card_flag" id="cardDiscover" value="discover">
                        <?php echo CHtml::image(Yii::app()->baseUrl.'/img/discover.png'); ?>
                    </label>-->

                    <!--<label class="radio">
                        <input type="radio" name="card_flag" id="cardElo" value="elo">
                        <?php echo CHtml::image(Yii::app()->baseUrl.'/img/american-express.png'); ?>
                    </label>-->
                </div>
                
                <br/>
                <div class="quad-box-pag-cartao2">
                    <span class="text-sup-form-pagamento">*Número do cartão</span>
                            <div class="campo-form-pagamento">
                                <input name="card_number" id="card_number" class="font-form" type="text">
                            </div>
                            <div class="errorMessage" id="error-numero-cartao"></div>
                        <div class="quad-box-pag-cartao2c"></div>  

                </div>

<div class="quad-box-pag-cartao2">
                   <div class="div-text-sup-form-pagamento2" style="width: 200px !important; height: auto !important;float: left !important;">
                       <span class="text-sup-form-pagamento2">Validade (Mês):</span>
                   <div class="select-form-pagamento" style="margin-top: 5px !important;">
                       <select name="card_validate_month" id="card_validate_month" class="select-anuncio-pad">
                                   <option value="01">Janeiro</option>
                                   <option value="02">Fevereiro</option>
                                   <option value="03">Marco</option>
                                   <option value="04">Abril</option>
                                   <option value="05">Maio</option>
                                   <option value="06">Junho</option>
                                   <option value="07">Julho</option>
                                   <option value="08">Agosto</option>
                                   <option value="09">Setembro</option>
                                   <option value="10">Outubro</option>
                                   <option value="11">Novembro</option>
                                   <option value="12">Dezembro</option>
                       </select>
                       <div class="errorMessage" id="error-mes"></div>
                   </div></div>  
                     
                   
                   
                       <div class="div-text-sup-form-pagamento2" style="width: 200px !important; height: auto !important;float: left !important;">
                           <span class="text-sup-form-pagamento2">Validade (Ano):</span>
                       <div class="select-form-pagamento" style="margin-top: 5px !important;">
                       <select name="card_validate_year" id="card_validate_year" class="select-anuncio-pad">
                               <option value="2014">2014</option>

                               <option value="2015">2015</option>
                               <option value="2016">2016</option>
                               <option value="2017">2017</option>
                               <option value="2018">2018</option>
                               <option value="2019">2019</option>
                               <option value="2020">2020</option>
                               <option value="2021">2021</option>
                               <option value="2022">2022</option>
                               <option value="2023">2023</option>
                               <option value="2024">2024</option>
                               <option value="2025">2025</option>
                       </select>
                       <div class="errorMessage" id="error-ano"></div>
                   </div></div> 
         
               </div>
                 
                <div class="quad-box-pag-cartao2">
                        <span class="text-sup-form-pagamento">*Nome impresso no cartão</span>
                            <div class="campo-form-pagamento">
                                <input name="card_name" id="card_name" class="font-form" type="text">
                            </div>
                            <div class="errorMessage" id="error-nome-cartao"></div>
                        <span class="text-sup-form-pagamento3">*Codigo de segurança</span>
                            <div class="campo-form-pagamento2">
                                <input name="card_cvv" class="font-form" id="card_cvv" type="text">
                            </div>  
                            <div class="errorMessage" id="error-card-cvv"></div>

                </div>  
                <div class="quad-box-pag-cartao2" style="display:none;">
                    <div class="div-text-sup-form-pagamento2">
                        <span class="text-sup-form-pagamento2">*Número de parcelas</span>
                    </div>  
                    <div class="select-form-pagamento2">
                        <select name="card_number_payments" id="card_number_payments" class="select-anuncio-pad">
                            <option value="1">1x</option>
                            <option value="2">2x</option>
                            <option value="3">3x</option>
                            <option value="4">4x</option>
                            <option value="5">5x</option>
                            <option value="6">6x</option>
                            <option value="7">7x</option>
                            <option value="8">8x</option>
                            <option value="9">9x</option>
                            <option value="10">10x</option>
                            <option value="11">11x</option>
                            <option value="12">12x</option>
                        </select>
                    </div>  
                </div>  
            </div>  
            
            </div>
