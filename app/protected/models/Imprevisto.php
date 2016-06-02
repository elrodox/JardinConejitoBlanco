<?php

/**
 * This is the model class for table "imprevisto".
 *
 * The followings are the available columns in table 'imprevisto':
 * @property integer $id_imprevisto
 * @property string $descripcion
 * @property string $fecha
 * @property integer $id_parvulo
 *
 * The followings are the available model relations:
 * @property Parvulo $idParvulo
 */
class Imprevisto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'imprevisto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descripcion, fecha, id_parvulo', 'required'),
			array('id_parvulo', 'numerical', 'integerOnly'=>true),
			array('descripcion', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_imprevisto, descripcion, fecha, id_parvulo', 'safe', 'on'=>'search'),
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
			'idParvulo' => array(self::BELONGS_TO, 'Parvulo', 'id_parvulo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_imprevisto' => 'Id Imprevisto',
			'descripcion' => 'Descripcion',
			'fecha' => 'Fecha',
			'id_parvulo' => 'Id Parvulo',
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

		$criteria->compare('id_imprevisto',$this->id_imprevisto);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('id_parvulo',$this->id_parvulo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Imprevisto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
