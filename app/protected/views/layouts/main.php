<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="es" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lib/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<script type="text/javascript" src="js/lib/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/lib/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/layout/main.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container-fluid" id="page">

	<div id="header">
		<?php $this->renderPartial("//site/header"); ?>
		<?php $this->renderPartial("//site/navbar"); ?>
	</div><!-- header -->

	<?php echo $content; ?>

	<div id="footer">
	</div><!-- footer -->

</div><!-- page -->


</body>
</html>
