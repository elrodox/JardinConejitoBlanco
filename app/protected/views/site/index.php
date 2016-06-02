<?php
/*  @var $this SiteController 
    @var $noticias Noticia */

?>

<div class="row">
    
    <div class="col-xs-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2>Noticias Importantes</h2>
            </div>
            
            <div class="panel-body">
                
                <?php foreach( $noticias as $noticia): ?>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <?php echo $noticia['titulo'] ?>
                            </h3>
                            <span class="label label-default"><?php echo $noticia['fecha'] ?></span>
                        </div>
                        <div class="panel-body">
                            <p><?php echo $noticia['descripcion'] ?></p>
                        </div>
                    </div>
                    
                <?php endforeach; ?>
                
            
    
                <nav>
                  <ul class="pagination">
                    <li>
                      <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                      <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                  </ul>
                </nav>
                
            </div>
        </div>
    
    </div>
    <div class="col-xs-8">
        <div class="row">
            <div class="col-xs-6"><img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/img/inicio/centro-padres2.jpg"></img></div>
            <div class="col-xs-6"><img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/img/inicio/niveles-educativos2.jpg"></img></div>
        </div>
        <div class="row">
            <div class="col-xs-6"><img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/img/inicio/nosotros2.jpg"></img></div>
            <div class="col-xs-6"><img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/img/inicio/proyecto-educativo2.jpg"></img></div>
        </div>
    </div>
</div>

<script>
    setNavActive("inicio");
</script>
