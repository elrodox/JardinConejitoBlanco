<?php

/**
 * This is the model class for table "logs".
 *
 * The followings are the available columns in table 'logs':
 * @property integer $id_educadora
 * @property integer $id_elemento_accedido
 * @property string $tipo_log
 * @property string $fecha
 * @property string $tabla_elemento_accedido
 */
class Logs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'logs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_educadora, id_elemento_accedido, tipo_log, fecha, tabla_elemento_accedido', 'required'),
			array('id_educadora, id_elemento_accedido', 'numerical', 'integerOnly'=>true),
			array('tipo_log, tabla_elemento_accedido', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_educadora, id_elemento_accedido, tipo_log, fecha, tabla_elemento_accedido', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_educadora' => 'Id Educadora',
			'id_elemento_accedido' => 'Id Elemento Accedido',
			'tipo_log' => 'Tipo Log',
			'fecha' => 'Fecha',
			'tabla_elemento_accedido' => 'Tabla Elemento Accedido',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_educadora',$this->id_educadora);
		$criteria->compare('id_elemento_accedido',$this->id_elemento_accedido);
		$criteria->compare('tipo_log',$this->tipo_log,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('tabla_elemento_accedido',$this->tabla_elemento_accedido,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Logs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
