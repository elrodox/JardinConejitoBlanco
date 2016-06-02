<!--NAVBAR-->
<nav class="navbar navbar-default navbar-static">
    <!--Mobile Menu-->
    <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <!--Desktop/Tablet Menu-->
    <div class="collapse navbar-collapse js-navbar-collapse">
        <div class="container">
            <div class="row">
                <ul id="main-nav-link-group" class="nav navbar-nav">
                <div class="btn-group btn-group-justified">
                    <!--Home-->
                    <div class="btn-group">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>"
                        id="inicio-nav-link" type="button" class="btn btn-nav">
                            <span class="glyphicon glyphicon-home"></span>
                            <p>Inicio<br></p>
                        </a>
                    </div>
                    
                    <div class="btn-group">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/site/page?view=mision_vision"
                        id="mision-vision-nav-link" type="button" class="btn btn-nav">
                            <span class="glyphicon glyphicon-screenshot"></span>
                            <p>Misión y <br>Visión</p>
                        </a>
                    </div>
                    <!--TechTicket-->
                    <div class="btn-group">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/site/page?view=quienes_somos"
                        id="quienes-somos-nav-link" type="button" class="btn btn-nav">
                            <span class="glyphicon glyphicon-user"></span>
                            <p>¿Quienes <br>Somos?</p>
                        </a>
                    </div>
                    <!--Reports-->
                    <div class="btn-group">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/site/page?view=organigrama"
                        id="organigrama-nav-link" type="button" class="btn btn-nav">
                            <span class="glyphicon glyphicon-equalizer"></span>
                            <p>Organigrama<br></p>
                        </a>
                    </div>
                    <!--News-->
                    <div class="btn-group">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/site/page?view=proyecto_educativo"
                        id="proyecto-educativo-nav-link" type="button" class="btn btn-nav">
                            <span class="glyphicon glyphicon-education"></span>
                            <p>Proyecto <br>Educativo</p>
                        </a>
                    </div>
                    <!--Calendar-->
                    <div class="btn-group">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/site/page?view=planes_emergencia"
                        id="planes-emergencia-nav-link" type="button" class="btn btn-nav">
                            <span class="glyphicon glyphicon-warning-sign"></span>
                            <p>Planes de <br>Emergencia</p>
                        </a>
                    </div>
                    <!--Profile-->
                    <div class="btn-group">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/site/page?view=experiencia_pedagogica"
                        id="experiencia-pedadogica-nav-link" type="button" class="btn btn-nav">
                            <span class="glyphicon glyphicon-folder-open"></span>
                            <p>Experiencia <br>Pedagogica</p>
                        </a>
                    </div>
                    
                    <div class="btn-group">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/site/page?view=centro_padres"
                        id="centro-padres-nav-link" type="button" class="btn btn-nav">
                            <span class="glyphicon glyphicon-glyphicon-book"></span>
                            <p>Centro de <br>Padres</p>
                        </a>
                    </div>
                    
                    <div class="btn-group">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/site/page?view=contacto_ubicacion"
                        id="contacto-ubicacion-nav-link" type="button" class="btn btn-nav">
                            <span class="glyphicon glyphicon-map-marker"></span>
                            <p>Contacto y <br>Ubicacion</p>
                        </a>
                    </div>
                    
                    
                    
                </div>
                </ul>
            </div>
        </div>
    </div>
</nav>