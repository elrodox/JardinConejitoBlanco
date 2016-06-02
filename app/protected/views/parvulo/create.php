<?php
/* @var $this ParvuloController */
/* @var $model Parvulo */

$this->breadcrumbs=array(
	'Parvulos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Parvulo', 'url'=>array('index')),
	array('label'=>'Manage Parvulo', 'url'=>array('admin')),
);
?>

<h1>Create Parvulo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>