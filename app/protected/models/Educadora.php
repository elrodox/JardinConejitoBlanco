<?php

/**
 * This is the model class for table "educadora".
 *
 * The followings are the available columns in table 'educadora':
 * @property integer $id_educadora
 * @property string $rut_educadora
 * @property string $password
 * @property string $nombre
 * @property string $email
 * @property integer $administrador
 * @property integer $eliminado
 * @property string $token
 */
class Educadora extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'educadora';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rut_educadora, password, nombre, email', 'required'),
			array('administrador, eliminado', 'numerical', 'integerOnly'=>true),
			array('rut_educadora', 'length', 'max'=>8),
			array('password, token', 'length', 'max'=>15),
			array('nombre', 'length', 'max'=>100),
			array('email', 'length', 'max'=>80),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_educadora, rut_educadora, password, nombre, email, administrador, eliminado, token', 'safe', 'on'=>'search'),
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
			'rut_educadora' => 'Rut Educadora',
			'password' => 'Password',
			'nombre' => 'Nombre',
			'email' => 'Email',
			'administrador' => 'Administrador',
			'eliminado' => 'Eliminado',
			'token' => 'Token',
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
		$criteria->compare('rut_educadora',$this->rut_educadora,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('administrador',$this->administrador);
		$criteria->compare('eliminado',$this->eliminado);
		$criteria->compare('token',$this->token,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Educadora the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
