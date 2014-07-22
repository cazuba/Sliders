<?php
    session_start();
    if( !isset($_SESSION['user']) || (isset($_SESSION['user']) && empty($_SESSION['user'])) ){
        header("location:login.php");
        exit;
    }
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
        <title>Modificar Banners </title>
        <!--JQUERY js-->
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    </head>
    <body>
        <div class="modif">
            <div class="submenu">
                <a href="./">Inicio</a><p> > <span>Banner Home (ID: <?php echo isset($searched['id']) ? $searched [ 'id'] : 0;?>)</span></p>
            </div>
            <h2>Modificar Banner Home</h2>
            <form method="post" action="modificar_slider.php" style="width: 100%;" enctype="multipart/form-data">
                <input type="hidden" name="sel" value="save"/>
                <input type="hidden" name="ref" value="<?php echo isset($searched['id']) ? $searched['id'] : "";?>"/>
                <input type="hidden" name="edit" value="<?php echo $edit ?>"/>
                <div class="item">
                    <label>Id</label>
                    <span><?php echo isset($searched['id']) ? $searched['id'] : "";?></span>
                </div>
                <br>
                <div class="item">
                    <label>Imagen</label>
                    <img src="<?php echo isset($searched['url_imagen']) ? "../".$searched['url_imagen'] : "";?>" width="300" /><br>
                </div> 
                <div class="item">
                    <label>&nbsp;</label>
                    <input type="file" name="url_imagen" value="" />
                </div>
                <br>
                <div class="item">
                    <label>Enlace</label>
                    <input type="text" name="url_destino" value="<?php echo isset($searched['url_destino']) ? $searched['url_destino'] : "";?>" />
                </div>
                <div class="item">
                    <label>Estado</label>
                    <select name="activo">
                            <option value="1" <?php if(isset($searched['activo']) && $searched['activo']) echo "selected";?>>Activo</option>
                            <option value="0" <?php if(isset($searched['activo']) && !$searched['activo']) echo "selected";?>>Inactivo</option>
                        </select>
                </div>
                <div class="item">
                    <label>Orden (Orden en aparecer en la seccion de Banners)</label>
                    <input type="text" name="orden" value="<?php echo isset($searched['orden']) ? $searched['orden'] : "";?>" />
                </div>
                <div class="item">
                    <label>Fecha creado</label>
                    <input type="text" value="<?php echo isset($searched['created_at']) ? $searched['created_at'] : "" ?>" readonly=""/>
                </div>
                <div class="item">
                    <label>Fecha actualizado</label>
                    <input type="text" value="<?php echo isset($searched['updated_at']) ? $searched['updated_at'] : "" ?>" readonly=""/>
                </div>

               <div>
                   <input type="submit" value="<?php if($edit): ?>Modificar<?php else:?>Guardar<?php endif;?>" name="btnModificar" />
               </div>
             </form>
            <?php if(isset($mensaje)):?>
            <div id="msg_succ" style="clear: both; width: 100%; padding-top: 10px;"><?php echo $mensaje;?></div>
            <script>
                $(document).ready(function(){
                    $("html,body").animate({'scrollTop':$("#msg_succ").offset().top+"px"},400);
                });
            </script>
            <?php endif;?>

        </div>
    </body>
</html>
