
<?php

/**
 * This is the model base class for the table "envio_emails_plano_gratis".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "EnvioEmailsPlanoGratis".
 *
 * Columns in table "envio_emails_plano_gratis" available as properties of the model,
 * followed by relations of table "envio_emails_plano_gratis" available as properties of the model.
 *
 * @property integer $id
 * @property integer $plano_usuarios_id
 * @property string $data_envio
 * @property string $tipo_envio
 *
 * @property PlanoUsuarios $planoUsuarios
 */
abstract class BaseEnvioEmailsPlanoGratis extends GxActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'envio_emails_plano_gratis';
    }

    public static function label($n = 1) {
        return Yii::t('app', 'EnvioEmailsPlanoGratis|EnvioEmailsPlanoGratises', $n);
    }

    public static function representingColumn() {
        return 'tipo_envio';
    }

    public function rules() {
        return array(
            array('tipo_envio', 'required'),
            array('plano_usuarios_id', 'numerical', 'integerOnly'=>true),
            array('tipo_envio', 'length', 'max'=>30),
            array('data_envio', 'safe'),
            array('plano_usuarios_id, data_envio', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, plano_usuarios_id, data_envio, tipo_envio', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
            'planoUsuarios' => array(self::BELONGS_TO, 'PlanoUsuarios', 'plano_usuarios_id'),
        );
    }

    public function pivotModels() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'ID'),
            'plano_usuarios_id' => null,
            'data_envio' => Yii::t('app', 'Data Envio'),
            'tipo_envio' => Yii::t('app', 'Tipo Envio'),
            'planoUsuarios' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('plano_usuarios_id', $this->plano_usuarios_id);
        $criteria->compare('data_envio', $this->data_envio, true);
        $criteria->compare('tipo_envio', $this->tipo_envio, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}