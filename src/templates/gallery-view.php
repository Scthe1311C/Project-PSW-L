<!-- 
TODO provide variables !
TODO scale favorite-mark-up icon, make red on hover
-->

<?php 
    foreach($photos as $photo){
    ?>
	<!-- single image element -->
	<div class="gallery-thumbnail" style="width:188px; height:141">
		
		<!-- gradients -->
		<div class="image-info gallery-thumbnail-bottom-gradient"></div>
		<div style="height:30px !important;" class="image-info gallery-thumbnail-top-gradient"></div>
		
		<!-- image info -->
		<div class="image-info views-count">
			<span class="glyphicon glyphicon-eye-open"></span><span>&nbsp;<?php echo $photo->views<1000?
                                                                                                 $photo->views:
                                                                                                ($photo->views/1000)."k"?></span>
		</div>
		<div class="image-info favorite-count">
			<span class="glyphicon glyphicon-heart"></span><span><?php echo $photo->favorites<1000?
                                                                                                 $photo->favorites:
                                                                                                ($photo->favorites/1000)."k"?></span>
		</div>
		<div class="image-info image-data">
			<span class="glyphicon glyphicon-question-sign"></span>
			<div class="image-data-popup">
                                <?php 
                                        echo '<label>Resolution:</label>'.$photo->width.'x'.$photo->height.'<br/>';
                                        echo '<label>Camera:</label>'.$photo->manufacturer.' '.$photo->model.'<br/>';
                                        echo '<label>Software:</label>'.$photo->software.'<br/>';
                                        echo '<label>Date:</label>'.$photo->date_and_time.'<br/>';
                                        echo '<label>Exposure time:</label>'.$photo->exposure_time.'<br/>';
                                        echo '<label>F number:</label>'.$photo->f_number.'<br/>';
                                ?>
			</div>
		</div>
		<?php if( $is_logged){ ?>
			<!-- quick mark as favorite -->
			<div class="image-info favorite-mark-up">
				<span class="glyphicon glyphicon-heart"></span>
			</div>
		<?php } ?>
		
		<!-- image -->
		<a href="<?php echo 'photo?galleryId='.$gallery->id.'&photo='.$photo->link?>">
			<img src="<?php echo $photo->thumbnail_link; ?>" class="file"/>
		</a>		
	</div>
<?php } ?>
