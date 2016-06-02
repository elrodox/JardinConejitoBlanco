<?php
/* @var $this ParvuloController */
/* @var $model Parvulo */

$this->breadcrumbs=array(
	'Parvulos'=>array('index'),
	$model->rut_parvulo,
);

$this->menu=array(
	array('label'=>'List Parvulo', 'url'=>array('index')),
	array('label'=>'Create Parvulo', 'url'=>array('create')),
	array('label'=>'Update Parvulo', 'url'=>array('update', 'id'=>$model->rut_parvulo)),
	array('label'=>'Delete Parvulo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->rut_parvulo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Parvulo', 'url'=>array('admin')),
);
?>

<h1>View Parvulo #<?php echo $model->rut_parvulo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'rut_parvulo',
		'password',
		'nombre',
		'email',
		'fecha_nacimiento',
		'talla',
		'peso',
	),
)); ?>
