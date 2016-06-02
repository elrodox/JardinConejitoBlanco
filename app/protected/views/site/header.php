<?php
/* @var $this SiteController */
?>

<div class="row" style="margin-bottom:10px; margin-top:10px">
    <div class="col-xs-2"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo_uv.png"></img></div>
    <div class="col-xs-2"></div>
    <div class="col-xs-8">
        <div class="panel panel-primary pull-right">
            <div class="panel-body">
                <form id="signin" class="form-inline" role="form">
                      <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                          <input id="rut" type="rut" class="form-control" name="rut" value="" placeholder="RUT (sin dígito verificador)">                                        
                      </div>
            
                      <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                          <input id="password" type="password" class="form-control" name="password" value="" placeholder="Contraseña">                                        
                      </div>
            
                      <button type="submit" class="btn btn-primary">Ingresar</button>
                 </form>
                 
            </div>
        </div>
    </div>
</div>

<?php $this->renderPartial("//site/navbar2"); ?>