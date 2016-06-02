<?php
/* @var $this ParvuloController */
/* @var $model Parvulo */

$this->breadcrumbs=array(
	'Parvulos'=>array('index'),
	$model->rut_parvulo=>array('view','id'=>$model->rut_parvulo),
	'Update',
);

$this->menu=array(
	array('label'=>'List Parvulo', 'url'=>array('index')),
	array('label'=>'Create Parvulo', 'url'=>array('create')),
	array('label'=>'View Parvulo', 'url'=>array('view', 'id'=>$model->rut_parvulo)),
	array('label'=>'Manage Parvulo', 'url'=>array('admin')),
);
?>

<h1>Update Parvulo <?php echo $model->rut_parvulo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>