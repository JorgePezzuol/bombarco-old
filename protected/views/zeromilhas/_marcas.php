<!-- Marcas -->
    <?php
        $destaques = Empresas::model()->findAll("macros_id=:macros_id AND status = 2 AND logo IS NOT NULL AND destaque = 1", array(":macros_id"=>Macros::$macro_by_slug['estaleiro']));
        //$estaleiros = Empresas::model()->findAll("macros_id=:macros_id AND status = 2 AND logo IS NOT NULL AND destaque = 0", array(":macros_id"=>Macros::$macro_by_slug['estaleiro']));

        $criteria = new CDbCriteria;
        $criteria->condition = 'macros_id=:macros_id AND status = 2';
        $criteria->order = "nomefantasia asc";
        $criteria->params = array(":macros_id"=>Macros::$macro_by_slug['estaleiro']);
        $marcas = Empresas::model()->findAll($criteria);
    ?>
                        <section id="blocos-marcas" class="espacamento">
                          <div class="container">
                            <div class="row">
                              <div class="col-lg-12 col-sm-12">
                                <h5 class="titulo"><span>As maiores marcas do mercado estão no catálogo 0km</span></h5>
                                <ul class="lista-blocos">
                                    <?php foreach ($destaques as $key => $value): ?>
                                        <?php if($key % 4 == 0): ?>
                                            <hr class="w-100"/>
                                        <?php endif; ?>
                                        <li>
                                            <a href="<?php echo Yii::app()->createUrl('catalogo/'.$value->slug);?>">
                                                <img alt="Logo" style="width:270px;height:160px;" src="<?php echo Yii::app()->baseUrl . '/' . Empresas::PATH_IMAGES_EMPRESAS . '/' . $value->logo; ?>" class="img-fluid">
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </section>


                        <!-- Marcas -->
                        <section id="lista-marcas" class="espacamento">
                          <div class="container">
                            <div class="row">
                              <div class="col-lg-12 col-sm-12">
                                <h5 class="titulo"><span>Marcas disponíveis no catálogo do Bombarco</span></h5>
                                <ul class="lista-links">
                                <?php foreach($marcas as $marca): ?>
                                	<?php if($marca->nomefantasia != ""):?>
                                        <?php $nome = $marca->nomefantasia; ?>
                                    <?php else: ?>
                                        <?php $nome = $marca->razao; ?>
                                    <?php endif; ?>
                                	
                                        <?php if($marca->destaque == 1): ?>
                                            <li><a href="<?php echo Yii::app()->createUrl('catalogo/'.$marca->slug);?>" class="destaque"><?php echo $nome;?></a></li>
                                        <?php else: ?>
                                            <li><a href="<?php echo Yii::app()->createUrl('catalogo/'.$marca->slug);?>"><?php echo $nome;?></a></li>
                                        <?php endif; ?>
                   
                                <?php endforeach; ?>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </section>