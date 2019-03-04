<?php

class EmbarcacaoFabricantesController extends GxController {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('validarNomeFabricante'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('admin', 'delete', 'changeStatus', 'update', 'create', 'view', 'AJAXfromMacro', 'AJAXfromId'),
                                                'expression'=> function() {
                    if(Yii::app()->user->isAtendimento() || Yii::app()->user->isAdmin()) {
                        return true;
                    }
                    return false;
                }
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'EmbarcacaoFabricantes'),
        ));
    }

    public function actionCreate() {

        $model = new EmbarcacaoFabricantes;

        if (isset($_POST['EmbarcacaoFabricantes'])) {

            $model->setAttributes($_POST['EmbarcacaoFabricantes']);
            $model->status = 1;

            $fabricante = EmbarcacaoFabricantes::model()->find('titulo=:titulo and embarcacao_macros_id =:macro', array(':titulo' => $model->titulo, ':macro' => $model->embarcacao_macros_id));

            // fab existe
            if ($fabricante != null) {
                Yii::app()->user->setFlash('successo', "Erro ao salvar o fabricante! - Já Existe!");
            } else {
                $model->logo = CUploadedFile::getInstance($model, 'logo');

                if ($model->logo != null) {

                    $model->logo->saveAs(Yii::getPathOfAlias('webroot') . '/public/fabricantes/' . $model->logo);
                }

                if ($model->save()) {

                    $this->redirect(array('view', 'id' => $model->id));
                } else {
                    Yii::app()->user->setFlash('successo', "Erro ao salvar o fabricante!");
                }
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {

        $model = $this->loadModel($id, 'EmbarcacaoFabricantes');

        $logo_anterior = $model->logo;

        $flgAlterouLogo = false;

        if (isset($_POST['EmbarcacaoFabricantes'])) {

            $model->setAttributes($_POST['EmbarcacaoFabricantes']);

            $imagem = CUploadedFile::getInstance($model, 'logo');

            if ($imagem != null) {
                $model->logo = Utils::genImageName($imagem);
                $flgAlterouLogo = true;
            } else {

                $model->logo = $logo_anterior;
            }

            if ($flgAlterouLogo) {

                if (!$imagem->saveAs(Yii::getPathOfAlias('webroot') . '/public/fabricantes/' . $model->logo)) {

                    Yii::app()->user->setFlash('successo', "Erro ao alterar os dados!");
                }
            }

            if ($model->save()) {
                Yii::app()->user->setFlash('successo', "Sucesso ao alterar os dados!");
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'EmbarcacaoFabricantes')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionAdmin() {
        $model = new EmbarcacaoFabricantes('search');
        $model->unsetAttributes();

        if (isset($_GET['EmbarcacaoFabricantes']))
            $model->setAttributes($_GET['EmbarcacaoFabricantes']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Action que altera o Status
     * Se estiver Ativado, desativa
     * Se estiver Desativado, ativa
     * @param  [type] $id [ID do Modelo]
     * @return [type]     [description]
     */
    public function actionChangeStatus($id) {

        $model = EmbarcacaoFabricantes::model()->findByPk($id);

        if ($model->status == 0) {
            $model->status = 1;
        } else {
            $model->status = 0;
        }

        if($model->update()) {
            echo "1";
        }
        else {
            echo "0";
        }
        //$this->redirect(Yii::app()->request->urlReferrer);
    }

    /*
     * validar se fabricante ja existe baseado no titulo
     * return 1 => fab existe
     * 		 0 => fab não existe
     */

    public function actionValidarNomeFabricante() {

        $nomeFabricante = $_POST['nomeFabricante'];

        $fabricante = EmbarcacaoFabricantes::model()->find('titulo=:titulo and embarcacao_macros_id =:macro', array(':titulo' => $nomeFabricante, ':macro' => (int) $_POST['macro']));

        // fab existe
        if ($fabricante != null) {
            echo '1';
        } else {
            echo '0';
        }
    }


    /**
     * Carrega todos os fabricantes a partir da Macro
     * AJAX
     * @return [type] [description]
     */
    public function actionAJAXfromMacro() {

        $macro = Yii::app()->request->getPost('macro_id');

        if (!empty($macro)) {
            echo CJSON::encode(EmbarcacaoFabricantes::selectAllFromMacro($macro));
            exit();
        }

        echo null;
        exit();
    }


    public function actionAJAXfromId() {

        $embarcacao_fabricantes_id = Yii::app()->request->getPost('embarcacao_fabricantes_id');

        $fabricante = EmbarcacaoFabricantes::model()->findByPk($embarcacao_fabricantes_id);

        if($fabricante != null) {
            $macro = $fabricante->embarcacao_macros_id;
            echo CJSON::encode(EmbarcacaoFabricantes::selectAllFromMacro($macro));
            
        }

        
    }

}
