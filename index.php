<?php
	include "model/Sliders.php";
	$sliders = new Sliders();
	$array_sliders = $sliders->getSlidersTodos();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width  initial-scale=1.0 maximum-scale=1.0 user-scalable=yes">
        <meta name="author" content="Carlos Zúñiga | GN Digital">
        <meta name="description" content="">
        <meta name="keywords" content="">
        
        <!-- STYLES -->
        <link rel="stylesheet" href="css/bootstrap.css" media="screen"/>
        <link rel="stylesheet" href="css/slider.css" media="screen"/>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

        <!--JQUERY js-->
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="js/class.slider.js"></script>
         <script type="text/javascript">
                var slider = new CallSlider();
                $(document).ready(function(){
                        $(window).change(function(){
                                slider.init();
                        });
                        $(".pointers span").each(function(index, item){
                                $(item).click(function(){
                                        slider.setSlide(index);
                                });
                        });
                        slider.init();
                });
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if( count($array_sliders)>0):?>
                      <div id="background-slider">
                              <div id="slider">
                                      <?php foreach ($array_sliders as $slide):?>
                                    <div class="box">
                                            <img src="<?php echo $slide['url_imagen'] ?>" <?php if($slide['url_destino']){ echo "onclick=top.location.href='{$slide['url_destino']}';"; }?> />
                                    </div>
                                    <?php endforeach;?>

                                    <div class="pointers">
                                            <?php for($index_pointer=0;$index_pointer<count($array_sliders);$index_pointer++):?>
                                            <span class="fa fa-circle-o"></span>
                                            <?php endfor; ?>
                                    </div>
                                    <?php if( count($array_sliders)>1 ):?>
                                    <div class="wrapper-handler">
                                            <div class="previous" onclick="slider.previous();"><i class="fa fa-chevron-left"></i></div>
                                            <div class="next" onclick="slider.next();"><i class="fa fa-chevron-right"></i></div>
                                    </div>
                                    <?php endif; ?>
                            </div>
                    </div>
                    <?php else:?>
                    <span style="width: 100%;height: 25px;display: inline;float: left;"></span>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </body>
</html>