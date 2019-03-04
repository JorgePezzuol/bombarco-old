<?php
$empresas = Empresas::model()->findAll('macros_id = 2 and destaque = 0 and status = 4');


foreach($empresas as $emp) {
    
    $usuarios_id = $emp->usuarios_id;
    
    $criteria = new CDbCriteria;
    $criteria->condition = "t.usuarios_id =:usuarios_id and planos.flag = 'plano_empresa' and t.status = 2";
    $criteria->join = "INNER JOIN planos ON planos.id = t.planos_id";
    $criteria->params = array(':usuarios_id'=>$usuarios_id);
    $planos = PlanoUsuarios::model()->exists($criteria);
    
    if(!$planos) {
        
        $plano = new PlanoUsuarios;
        $plano->planos_id = 104;
        $plano->status = 2;
        $plano->qntpermitida = 0;
        $plano->inicio = date('Y-m-d H:i:s');
        $plano->fim = date('Y-m-d H:i:s', strtotime('today + 12 month'));
        $plano->usuarios_id = $usuarios_id;
        $plano->dataregistro = date('Y-m-d H:i:s');
        
        if($plano->save()) {
            $emp->plano_usuarios_id = $plano->id;
            $emp->status = 2;
            $emp->data_ativacao = date('Y-m-d H:i:s');
            $emp->update();
        }
    }
    
    
}
?>