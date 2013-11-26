<?php
foreach ($galleries as $gallery) {
    ?>

    <!-- single image element -->
    <div class="gallery-thumbnail" style="width:256px; height:246px">

        <!-- gradients -->
        <div class="image-info gallery-thumbnail-bottom-gradient"></div>
        <div class="image-info gallery-thumbnail-top-gradient"></div>

        <!-- image info -->
        <div class="image-info views-count">
            <span class="glyphicon glyphicon-eye-open"></span><span>&nbsp;<?php echo $gallery->views<1000?
                                                                                     $gallery->views:
                                                                                     ($gallery->views/1000)."k"?></span>
        </div>
        <div class="image-info favorite-count">
            <span class="glyphicon glyphicon-heart"></span><span>&nbsp;<?php echo $gallery->favorites<1000?
                                                                                  $gallery->favorites:
                                                                                  ($gallery->favorites/1000)."k" ?></span>
        </div>
        <div class="image-info image-data">
            <span class="glyphicon glyphicon-question-sign"></span>
            <div class="image-data-popup">
                <?php
                $signature = Users::getUserSignature($gallery->user_id);
                echo '<label>Designed by:</label><a href="person?userId=' . $gallery->user_id. '">' . $signature .'</a>'
                ?><br/>
                <label>Description:</label><?php echo $gallery->description ?> <br/>
            </div>
        </div>
        <?php if ($is_logged) { ?>
            <!-- quick mark as favorite -->
            <div class="image-info favorite-mark-up">
                <span  class="glyphicon glyphicon-heart"></span>
            </div>
        <?php } ?>
        <!--title-->
        <h4 style="text-align: center;padding-bottom: 0"><?php echo $gallery->name ?></h4>
        <!-- image -->
        <a href="gallery?galleryId=<?php echo $gallery->id ?>">
            <img  src="src/img/galleries_folder.png"/>
            <div class="foreground-image">
                <img src="<?php echo $gallery->tumbnail_href ?>" class="file"/>
            </div>
        </a>		
    </div>
<?php } ?>
