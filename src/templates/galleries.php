<!-- 
TODO provide variables !
TODO scale favorite-mark-up icon, make red on hover
-->

<?php include './model/userData.php';
foreach ($galleryIndex as $index) {
    $gallery = Galleries::getInstance()->getGallery($index);
    ?>
    
    <!-- single image element -->
    <div class="gallery-thumbnail" style="width:256px; height:246px">

        <!-- gradients -->
        <div class="image-info gallery-thumbnail-bottom-gradient"></div>
        <div class="image-info gallery-thumbnail-top-gradient"></div>

        <!-- image info -->
        <div class="image-info views-count">
            <span class="glyphicon glyphicon-eye-open"></span><span>&nbsp;2k</span>
        </div>
        <div class="image-info favorite-count">
            <span class="glyphicon glyphicon-heart"></span><span>&nbsp;1k</span>
        </div>
        <div class="image-info image-data">
            <span class="glyphicon glyphicon-question-sign"></span>
            <div class="image-data-popup">
                <?php
                $designerId = $gallery->designer;
                $designer = Users::getInstance()->getUser($designerId);
                echo '<label>Designed by:</label><a href="person?id=' . $designer->id . '">' . $designer->name .' '.$designer->surname.'</a>'
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
        <h4 style="text-align: center;padding-bottom: 0">Tree gallery</h4>
        <!-- image -->
        <a href="gallery?galleryId=<?php echo $gallery->id?>">
            <img  src="src/img/galleries_folder.png"/>
    <!--                    <img src="<?php echo $gallery->tumbnail ?>" class="file"/>-->
            <div class="foreground-image">
                <img src="<?php echo $gallery->tumbnail ?>" class="file"/>
            </div>
        </a>		
    </div>
<?php } ?>
