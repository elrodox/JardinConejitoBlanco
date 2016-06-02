<?php

/**
 * This is the model class for table "parvulo".
 *
 * The followings are the available columns in table 'parvulo':
 * @property integer $id_parvulo
 * @property string $rut_parvulo
 * @property string $password
 * @property string $nombre
 * @property string $email
 * @property string $fecha_nacimiento
 * @property integer $talla
 * @property double $peso
 * @property integer $eliminado
 * @property string $token
 *
 * The followings are the available model relations:
 * @property Hito[] $hitos
 * @property Imprevisto[] $imprevistos
 * @property Asistencia[] $asistencias
 */
class Parvulo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'parvulo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rut_parvulo, password, nombre, email, fecha_nacimiento', 'required'),
			array('talla, eliminado', 'numerical', 'integerOnly'=>true),
			array('peso', 'numerical'),
			array('rut_parvulo', 'length', 'max'=>8),
			array('password, email', 'length', 'max'=>45),
			array('nombre', 'length', 'max'=>100),
			array('token', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_parvulo, rut_parvulo, password, nombre, email, fecha_nacimiento, talla, peso, eliminado, token', 'safe', 'on'=>'search'),
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
			'hitos' => array(self::HAS_MANY, 'Hito', 'id_parvulo'),
			'imprevistos' => array(self::HAS_MANY, 'Imprevisto', 'id_parvulo'),
			'asistencias' => array(self::MANY_MANY, 'Asistencia', 'parvulo_asistencia(id_parvulo, id_asistencia)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_parvulo' => 'Id Parvulo',
			'rut_parvulo' => 'Rut Parvulo',
			'password' => 'Password',
			'nombre' => 'Nombre',
			'email' => 'Email',
			'fecha_nacimiento' => 'Fecha Nacimiento',
			'talla' => 'Talla',
			'peso' => 'Peso',
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

		$criteria->compare('id_parvulo',$this->id_parvulo);
		$criteria->compare('rut_parvulo',$this->rut_parvulo,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('fecha_nacimiento',$this->fecha_nacimiento,true);
		$criteria->compare('talla',$this->talla);
		$criteria->compare('peso',$this->peso);
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
	 * @return Parvulo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
