<img style="margin-bottom:10px; margin-top:10px" class="center-block" src="<?php echo Yii::app()->request->baseUrl; ?>/img/banner-jardin-contacto.jpg"></img>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3>Formulario de Contacto</h3></div>
    <div class="panel-body">
        <h4>Enviar un correo electrónico.<br> Todos los campos con el asterisco ('*') son obligatorios</h4>
        <form>

            <div class="form-group">
                <label for="InputName">*Nombre</label>
                <input type="nombre" class="form-control" id="exampleInputEmail1" placeholder="Escriba aquí su Nombre">
            </div>
            <div class="form-group">
                <label for="InputEmail">*Dirección de correo electronico</label>
                <input type="email" class="form-control" id="InputEmail1" placeholder="Escriba aquí suEmail">
            </div>
            <div class="form-group">
                <label for="InputAsunto">*Asunto</label>
                <input type="asunto" class="form-control" id="InputAsunto" placeholder="Escriba aquí su Asunto">
            </div>
            <div class="form-group">
                <label for="InputText">*Mensaje</label>
                <textarea type="text" class="form-control" rows="4" id="InputText" placeholder="Escriba aqui su mensaje"></textarea>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"> Envíeme una copia
                </label>
            </div>
            <button style="margin-bottom:10px; margin-left:20px" type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</div>
<div class="panel panel-primary">
    
    <div class="panel-heading">
        <h3>Informaciones Generales</h3></div>
    <div class="panel-body">
        <div class="list-group">
            <h4 class="list-group-item-heading">
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Ubicación
            </h4>
            <p class="list-group-item-text">CHILOÉ 1918  SECTOR ALMENDRAL , Valparaíso - V Región  </p>
        </div>
        <div class="list-group">
            <h4 class="list-group-item-heading">
                <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Correo Electronico:
            </h4>
            <a href="mailto://jardininfantil@uv.cl" class="list-group-item-text">jardininfantil@uv.cl</a>
        </div>
        <div class="list-group">
            <h4 class="list-group-item-heading">
                <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> Telefono Contacto:
            </h4>
            <p class="list-group-item-text">32-2217841</p>
        </div>
    </div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3344.292848467397!2d-71.61842081875739!3d-33.04875619746395!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9689e0d8fcb8c8a9%3A0xe9f5d68ecf1ace9b!2zQ2hpbG_DqSAxOTE4LCBWYWxwYXJhw61zbywgUmVnacOzbiBkZSBWYWxwYXJhw61zbw!5e0!3m2!1ses!2scl!4v1448516805568" width="950" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>






<script>
    setNavActive("contacto-ubicacion");
</script>
