<?php
/* @var $this SiteController */
?>

<div class="row" style="margin-bottom:10px; margin-top:10px">
    <div class="col-xs-2"><img src="img/logo_uv.png"></img></div>
    <div class="col-xs-2"></div>
    <div class="col-xs-8">
        <div class="panel panel-primary pull-right">
            <div class="panel-body">
                <form id="signin" class="form-inline" role="form">
                      <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                          <input id="email" type="email" class="form-control" name="email" value="" placeholder="RUT (sin dígito verificador)">                                        
                      </div>
            
                      <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                          <input id="password" type="password" class="form-control" name="password" value="" placeholder="Contraseña">                                        
                      </div>
            
                      <button type="submit" class="btn btn-primary">Ingresar</button>
                 </form>
                 
                <!-- <form class="form-inline">-->
                <!--  <div class="form-group">-->
                <!--    <label class="sr-only" for="exampleInputEmail3">Email address</label>-->
                <!--    <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email">-->
                <!--  </div>-->
                <!--  <div class="form-group">-->
                <!--    <label class="sr-only" for="exampleInputPassword3">Password</label>-->
                <!--    <input type="password" class="form-control" id="exampleInputPassword3" placeholder="Password">-->
                <!--  </div>-->
                <!--  <div class="checkbox">-->
                <!--    <label>-->
                <!--      <input type="checkbox"> Remember me-->
                <!--    </label>-->
                <!--  </div>-->
                <!--  <button type="submit" class="btn btn-default">Sign in</button>-->
                <!--</form>-->
            </div>
        </div>
    </div>
</div>