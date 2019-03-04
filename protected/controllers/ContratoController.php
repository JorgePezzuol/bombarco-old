<?php

Yii::import('application.vendor.fpdf.*');
require_once 'fpdf.php';
require_once 'fpdf2.php';
require_once 'fpdf_merge.php';

class ContratoController extends GxController
{
    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'create'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('update', 'view', 'assinar'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionAssinar()
    {

        $this->layout = "//admin";

        $model = Contrato::model()->find("slug=:slug", array(":slug" => $_GET["id"]));

        $msg = '';

        if (isset($_POST['Contrato']) && $model->status != 2) {

            $model->attributes = $_POST['Contrato'];
			$model->id_usuario = Yii::app()->user->getId();
			$model->data = date("Y-m-d H:i:s");
            $model->status = 2; // assinado pelo cliente

            if ($model->update()) {

                $link_contrato = Yii::app()->createAbsoluteUrl('contrato/assinar/' . $model->slug, array(), 'https');
				$message = new YiiMailMessage;
				$message->view = "mail_contrato";
				$message->setBody(array("link"=>$link_contrato), "text/html");
				
				
                $message->subject = 'Contrato Bombarco';
                $message->addTo(Usuarios::getUsuarioLogado()->email);
                $message->addTo('atendimento@bombarco.com.br');
                $message->addTo('milena@bombarco.com.br');
                if($model->email_vendedor != "") {
                	$message->addTo($model->email_vendedor);	
                }
                
                $message->from = "atendimento@bombarco.com.br";

				Yii::app()->mail->send($message);

                $msg = "Sucesso ao gerar o contrato. Um e-mail foi enviado para: " . Usuarios::getUsuarioLogado()->email;
            }
        }

        $this->render('assinar', array(
            'model' => $model,
            'msg' => $msg,
        ));

    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => Contrato::model()->find("slug=:slug", array(":slug" => $id)),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Contrato;
        $mostraLink = false;

        if (isset($_POST['Contrato'])) {
            $model->attributes = $_POST['Contrato'];

            if ($model->save()) {

                $mostraLink = true;

                // mandar email p vendedor com o link
                //$link = "http://www.bombarco.com.br/admin/contrato/assinar/" . $model->slug;
                $link = "http://www.bombarco.com.br/contrato/assinar/" . $model->slug;
                $message = new YiiMailMessage;
                $message->setBody("Link do contrato: " . $link);
                $message->subject = 'Contrato Bombarco - ' . $model->nome_fantasia;

                //$message->addTo('atendimento@bombarco.com.br');
                $message->addTo($model->email_vendedor);
                $message->from = "atendimento@bombarco.com.br";

                if(!Yii::app()->mail->send($message)) {

                    echo "Nao foi possivel enviar o email";
                    exit;
                }

                /*try {
                    Yii::app()->mail->send($message);
                } catch(Exception $e) {
                    var_dump($e->getMessage());
                    exit;
                }*/
                
            }
        }

        $this->render('create', array(
            'model' => $model,
            'mostraLink' => $mostraLink,

        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {

        $model = Contrato::model()->find("slug=:slug", array(":slug" => $id));

        $msg = '';

        if (isset($_POST['Contrato']) && $model->status != 2) {
            $model->attributes = $_POST['Contrato'];
            $model->id_usuario = Yii::app()->user->getId();
            $model->status = 2; // assinado pelo cliente

            if ($model->update()) {

                // campos
                $data = $model->base64_contrato;
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);

                $nome_imagem = $model->slug . "-dados";
                $nome_imagem_png = $nome_imagem . ".png";
                $nome_pdf = $nome_imagem . ".pdf";

                $caminho_imagem_png = Yii::getPathOfAlias('webroot') . '/public/contratos/' . $nome_imagem_png;
                $caminho_imagem_pdf_dados = Yii::getPathOfAlias('webroot') . '/public/contratos/' . $nome_pdf;

                file_put_contents($caminho_imagem_png, $data);

                $pdf = new FPDF('p', 'pt', 'a3');
                //$pdf = new FPDF('p','pt','a4');
                //$pdf->SetFont('Arial','B', 18);
                $pdf->AddPage();

                //$pdf->SetAutoPageBreak(false);
                $pdf->SetMargins(0, 0, 0);
                $pdf->SetAutoPageBreak(false, 0);
                $pdf->Image($caminho_imagem_png, null, null, 1800, 3800);
                $pdf->Output($caminho_imagem_pdf_dados, 'F');
                // fim campos

                // termos
                $data_ = $model->base64_termos;
                list($type, $data_) = explode(';', $data_);
                list(, $data_) = explode(',', $data_);
                $data_ = base64_decode($data_);

                $nome_imagem = $model->slug . "-termos";
                $nome_imagem_png = $nome_imagem . ".png";
                $nome_pdf = $nome_imagem . ".pdf";

                $caminho_imagem_png = Yii::getPathOfAlias('webroot') . '/public/contratos/' . $nome_imagem_png;
                $caminho_imagem_pdf_termos = Yii::getPathOfAlias('webroot') . '/public/contratos/' . $nome_pdf;

                file_put_contents($caminho_imagem_png, $data_);

                $pdf_ = new FPDF2('p', 'pt', 'a3');
                //$pdf_ = new FPDF2('p','pt','a4');
                //$pdf_->SetFont('Arial','B', 18);
                $pdf_->AddPage();
                //$pdf_->SetAutoPageBreak(false);
                $pdf_->SetMargins(0, 0, 0);
                $pdf_->SetAutoPageBreak(false, 0);
                $pdf_->Image($caminho_imagem_png, null, null, 1730, 1800);
                $pdf_->Output($caminho_imagem_pdf_termos, 'F');
                // fim termos

                // JUNTA OS 2 PDFS
                $merge = new FPDF_Merge();
                $merge->add($caminho_imagem_pdf_dados);
                $merge->add($caminho_imagem_pdf_termos);
                $merge->output(Yii::getPathOfAlias('webroot') . '/public/contratos/' . $model->slug . ".pdf");
                $caminho_pdf_final = Yii::getPathOfAlias('webroot') . '/public/contratos/' . $model->slug . ".pdf";

                // ENVIA EMAIL COM O PDF EM ANEXO
                $message = new YiiMailMessage;
                $message->setBody("Olá, obrigado por assinar o contrato, segue anexo a sua via. Atenciosamente Equipe Bombarco");
                $message->subject = 'Contrato Bombarco';
                $message->addTo(Usuarios::getUsuarioLogado()->email);
                $message->addTo('atendimento@bombarco.com.br');
                $message->addTo($model->email_vendedor);
                $message->from = "atendimento@bombarco.com.br";
                $swiftAttachment = Swift_Attachment::fromPath($caminho_pdf_final);
                $message->attach($swiftAttachment);

                Yii::app()->mail->send($message);

                $msg = "Sucesso ao gerar o contrato. Uma cópia foi enviada para o email: " . Usuarios::getUsuarioLogado()->email;

            }

        }

        $this->render('update', array(
            'model' => $model,
            'msg' => $msg,
        ));

    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }

    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Contrato');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Contrato('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Contrato'])) {
            $model->attributes = $_GET['Contrato'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Contrato the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Contrato::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Contrato $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'contrato-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
