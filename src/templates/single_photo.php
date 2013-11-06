<!-- Carousel
   ================================================== -->
<div  id="myCarousel" class="carousel slide">

           <!-- Indicators -->
	<!--	   
    <ol class="carousel-indicators">
        <?php
        echo '<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
        for ($i = 1; $i < count($photos); $i++) {
            echo '<li data-target="#myCarousel" data-slide-to="' . $i . '"></li>';
        }
        ?> 
    </ol> 
	-->
    

    <div  class="carousel-inner">
        <div class="item active">
            <div  class="container">
                <div class="photo_container">
                    <div class="carousel-caption">
                        <img class="image"src="<?php echo $photos[0] ?>">
                  
                            <div class="photo_name">
                       
                           <p> <?php echo getNameFromPath($photos[0]) ?></p>
                              </div>
                        <div >
                            <p><a  style="font-size: 70%" class="btn btn-large btn-primary" href="#">Browse gallery</a></p>
                        </div>                                   
                    </div>
                </div>
            </div>
        </div>

        <?php
        for ($i = 1; $i < count($photos); $i++) {
            echo '
              <div class="item">
            <div class="container">
                <div class="photo_container">
                    <div class="carousel-caption">
                        <img class="image"src="' . $photos[$i] . '">
                        <div class="photo_name">
                            <p>' . getNameFromPath($photos[$i]) . '</p>
                        </div>
                        <p><a  class="btn btn-large btn-primary" href="#">Browse gallery</a><p>
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
