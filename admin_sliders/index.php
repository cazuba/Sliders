<?php
    session_start();
    include_once '../Model/Sliders.php';
    
    $sliders = new Sliders();
    
    /*if( !isset($_SESSION['user']) || (isset($_SESSION['user']) && empty($_SESSION['user'])) ){
        header("location:login.php");
        exit;
    }*/
    
    /* SLIDERS */
    $array_sliders = $sliders->buscarSlider(array("1=1"));
    if(isset($array_sliders['id'])) {
        $tmp = $array_sliders;
        $array_sliders = array();
        $array_sliders[] = $tmp;
    }
    //echo "<pre>";print_r($array_sliders);exit;
    /* FIN SLIDERS */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <title>Administrador</title>

        <link rel="stylesheet" href="../css/bootstrap.css" media="screen"/>
        
        <!--JQUERY js-->
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br><br></div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                    <!--Sliders-->
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <legend>Banners Home</legend>
                            <p><a href="modificar_slider.php?edit=0">Agregar Banner en el Home</a></p>
                            <span id="result_delete" style="display: none;"></span>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="50">Id</th>
                                            <th width="120">Image</th>
                                            <th width="120">Enlace</th>
                                            <th width="100">Activo</th>
                                            <th width="100">Orden</th>
                                            <th width="100">Creado</th>
                                            <th width="100">Actualizado</th>
                                            <th width="20">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($array_sliders as $slide):?>
                                        <tr id="banner_<?php echo $slide['id'];?>"<?php if($slide['activo']):?> style="font-weight: bold;" title="Banner activo"<?php endif;?>>
                                            <td><a href="modificar_slider.php?edit=1&ref=<?php echo $slide['id'];?>" title="Modificar"><?php echo $slide['id'];?></a></td>
                                            <td align="center"><img src="<?php echo "../".$slide['url_imagen'];?>" width="100" /><br><?php echo $slide['url_imagen'];?></td>
                                            <td><a title="Ir a URL" href="<?php echo $slide['url_destino'];?>" target="_blank"><?php echo $slide['url_destino'];?></a></td>
                                            <td><?php echo $slide['activo'];?></td>
                                            <td><?php echo $slide['orden'];?></td>
                                            <td><?php echo $slide['created_at'];?></td>
                                            <td><?php echo $slide['updated_at'];?></td>
                                            <td title="Eliminar" onclick="RemoveBanner(<?php echo $slide['id'];?>);return false;" style="cursor: pointer;color:red;text-align: center;" onmouseover="$(this).css('text-decoration','underline')" onmouseout="$(this).css('text-decoration','none')">X</td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--Fin Sliders-->
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function RemoveBanner(id){
                $("#result_delete").hide();
                $.post('remove_slider.php',{id:id},
                    function(response){
                        $("#result_delete").html(response).show("fast");
                        $("#banner_"+id).hide('fast', function(){
                           setTimeout(function(){
                               $("#banner_"+id).remove();
                           },1000); 
                        });
                    }
                ).fail(function(){alert("Fallo al intentar eliminar el banner");});
            }
        </script>
    </body>
</html>