<?php
    include '../Model/Sliders.php';
    
    $ref = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : 0;
    if($ref){
        $slider = new Sliders();
        $searched = $slider->buscarSlider(array("id='$ref'"));
        if(count($searched)>0){
            $removed = $slider->removeSlider($ref);            
            if($removed){
                $tmp_arr_image = explode("/", $searched['url_imagen']);
                $name = $tmp_arr_image[count($tmp_arr_image)-1];
                $file_image = dirname(getcwd()).DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."sliders".DIRECTORY_SEPARATOR.$name;
                @unlink($file_image);
                echo "Banner eliminado correctamente";
            }else
                echo "El Banner no pudo ser eliminado correctamente";
        }else{
            echo "Banner no encontrado";
        }
    }else{
        echo "Identificador de Banner inv&aacute;lido";
    }
    exit;
?>
