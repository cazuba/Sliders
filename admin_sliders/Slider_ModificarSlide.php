<?php
    include_once '../Model/Sliders.php';
    $pro = new Sliders();
    $searched = ($edit) ? $pro->buscarSlider(array('id="'.$_REQUEST['ref'].'"')) : array();
    $succ=0;
    $advice = $nombre_nueva_imagen = "";
if(count($searched)>0 || !$edit){
    if($edit)
        $pro->setId( $_REQUEST['ref'] );
    $img_ok = -1;/*-1 => nothing to load | 0 =>not loaded | 1 => image loaded */
    if(isset($_FILES['url_imagen']) && strval($_FILES['url_imagen']['tmp_name'])!=""){
        $subir = new imgUpldr();
        $subir->__set('_height',300);
        $subir->__set('_width',800);
        
        $subir->__set('_dest',  getcwd() . "/../images/sliders/");
        
	$advice = $subir->init($_FILES['url_imagen']);
        /* ELIMINAR IMAGEN EXISTENTE DEL SERVIDOR */
        if($edit)
            if($searched['url_imagen']!=""){
                $tmp_arr_image = explode("/", $searched['url_imagen']);
                $name = $tmp_arr_image[count($tmp_arr_image)-1];
                $file_image = dirname(getcwd()).DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."sliders".DIRECTORY_SEPARATOR.$name;
                @unlink($file_image);
            }
        /* FIN ELIMINAR IMAGEN ANTERIOR */
        $nombre_nueva_imagen = "images/sliders/".$subir->__get("_name");
    }else{
        if(!$edit){
            $advice = "No agrego una imagen al banner";
            $img_ok=0;
        }
    }
    
    if( abs($img_ok) == 1 ){
        if($nombre_nueva_imagen!=""){
            $pro->setUrl_imagen($nombre_nueva_imagen);
        }else
            $pro->setUrl_imagen(($searched['url_imagen']) ? $searched['url_imagen'] : "");
        
        $pro->setUrl_destino($_REQUEST['url_destino']);
        $pro->setOrden($_REQUEST['orden']);
        $pro->setActivo($_REQUEST['activo']);
        
        if($edit)
            $succ = $pro->actualizarSlider();
        else{
            $succ = $pro->insertarSlider ();
        }
    }
}
$mensaje = "";
if($succ){
    $mensaje = "Se modifico el Banner de manera correcta. " . $advice;
}else{
    $mensaje = "No se pudo modificar el Banner. ". $advice;
}
?>
