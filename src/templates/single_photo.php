
<!-- Carousel
   ================================================== -->
<div  id="myCarousel" class="carousel slide">

           <!-- Indicators -->
	   
    <ol class="carousel-indicators">
        <?php
        for ($i = 0; $i < count($photos); $i++) {
            echo ($photos[$i] == $chosen_photo)? '<li data-target="#myCarousel" data-slide-to="' . $i .'" class="active"></li>' 
                                                : '<li data-target="#myCarousel" data-slide-to="' . $i . '"></li>';
        }
        ?> 
    </ol> 
	
    

    <div  class="carousel-inner">
        <?php
        for ($i = 0; $i < count($photos); $i++) {
             echo ($photos[$i] == $chosen_photo)? '<div class="item active">' : '<div class="item">';
            echo   
            
            '<div class="container">
                <div class="photo_container">
                    <div class="carousel-caption">
                        <img class="image"src="' . $photos[$i] . '">
                        <div>
                        <div class="photo_name">
                            <p>' . getNameFromPath($photos[$i]) . '</p>
                        </div>
                        <div><a  class="btn btn-large btn-primary" href="gallery?galleryId='.$galleryId.'">Browse gallery</a></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>';
        }
        ?>
  
    </div>

    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div><!-- /.carousel -->

<?php

function getNameFromPath($path) {
    $lastSlash = strripos($path, '/');
    $lastDot = strripos($path, '.');
    return substr($path, $lastSlash + 1, -(strlen($path) - $lastDot));
}
?>
