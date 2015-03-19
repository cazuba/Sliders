<?php
    session_start();
    /*if( !isset($_SESSION['user']) || (isset($_SESSION['user']) && empty($_SESSION['user'])) ){
        header("location:login.php");
        exit;
    }*/
    $edit = isset($_REQUEST['edit']) ? $_REQUEST['edit'] : 1;
    include_once '../Model/Sliders.php';
    if(isset($_REQUEST['sel']) && $_REQUEST['sel']=="save"){
        include_once "class_imgUpldr.php";
        include './Slider_ModificarSlide.php';
    }
    
    $ref = (isset($_REQUEST['ref'])) ? $_REQUEST['ref'] : "";
    if($ref=="" && $edit){header("location: ../error/404");}
    $slider = new Sliders();
    $searched = $slider->buscarSlider(array('id="'.$ref.'"')) ;
    if(!$searched && $edit){header("location: ../error/404");}
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width  initial-scale=1.0 maximum-scale=1.0 user-scalable=yes">
        <meta name="author" content="Carlos Zúñiga | GN Digital">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <title>Modificar Banners </title>
        
        <link rel="stylesheet" href="../css/bootstrap.css" media="screen"/>
        
        <!--JQUERY js-->
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <style>
            .form-group {margin-bottom: 5px;}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="page-header">
                        <h1>Administrador | <small>Modificar Banner</small></h1>
                    </div>
                    <ol class="breadcrumb">
                        <li><a href="./">Inicio</a></li>
                        <li class="active">Banner Home (ID: <?php echo isset($searched['id']) ? $searched [ 'id'] : 0;?>)</li>
                    </ol>
                    <form role="form"  method="post" action="modificar_slider.php" enctype="multipart/form-data">
                        <input type="hidden" name="sel" value="save"/>
                        <input type="hidden" name="ref" value="<?php echo isset($searched['id']) ? $searched['id'] : "";?>"/>
                        <input type="hidden" name="edit" value="<?php echo $edit ?>"/>
                        <div class="form-group">
                            <label>Id</label>
                            <span><?php echo isset($searched['id']) ? $searched['id'] : "";?></span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Imagen</label>
                            <img class="img-responsive img-thumbnail" src="<?php echo isset($searched['url_imagen']) ? "../".$searched['url_imagen'] : "";?>" width="300" /><br>
                        </div> 
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <input class="form-control" type="file" name="url_imagen" value="" />
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Enlace</label>
                            <input class="form-control" type="text" name="url_destino" value="<?php echo isset($searched['url_destino']) ? $searched['url_destino'] : "";?>" />
                        </div>
                        <div class="form-group">
                            <label>Estado</label>
                            <select class="form-control" name="activo">
                                    <option value="1" <?php if(isset($searched['activo']) && $searched['activo']) echo "selected";?>>Activo</option>
                                    <option value="0" <?php if(isset($searched['activo']) && !$searched['activo']) echo "selected";?>>Inactivo</option>
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Orden (Orden en aparecer en la seccion de Banners)</label>
                            <input class="form-control" type="text" name="orden" value="<?php echo isset($searched['orden']) ? $searched['orden'] : "";?>" />
                        </div>
                        <div class="form-group">
                            <label>Fecha creado</label>
                            <input class="form-control" type="text" value="<?php echo isset($searched['created_at']) ? $searched['created_at'] : "" ?>" readonly=""/>
                        </div>
                        <div class="form-group">
                            <label>Fecha actualizado</label>
                            <input class="form-control" type="text" value="<?php echo isset($searched['updated_at']) ? $searched['updated_at'] : "" ?>" readonly=""/>
                        </div>

                       <div>
                           <input class="btn btn-success" type="submit" value="<?php if($edit): ?>Modificar<?php else:?>Guardar<?php endif;?>" name="btnModificar" />
                       </div>
                     </form>
                    <?php if(isset($mensaje)):?>
                    <div id="msg_succ" class="alert"><?php echo $mensaje;?></div>
                    <script>
                        $(document).ready(function(){
                            $("html,body").animate({'scrollTop':$("#msg_succ").offset().top+"px"},400);
                        });
                    </script>
                    <?php endif;?>
                </div>
            </div>
            <br>
        </div>
    </body>
</html>
