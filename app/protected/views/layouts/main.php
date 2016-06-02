<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="es" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lib/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main2.css" />
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/layout/main.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/app.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container-fluid" id="page">

	<div id="header">
		<?php $this->renderPartial("//site/header"); ?>
	</div><!-- header -->
	
	<div class="row">
		<div class="col-xs-9">
			<?php echo $content; ?>
		</div>
		<div class="col-xs-3">
			<?php echo $this->renderPartial("//site/enlaces_interes"); ?>
		</div>	
	</div>
	

	<div id="footer">
	</div><!-- footer -->

</div><!-- page -->


</body>
</html>
