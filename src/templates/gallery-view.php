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
			<span class="glyphicon glyphicon-eye-open"></span><span>&nbsp;2k</span>
		</div>
		<div class="image-info favorite-count">
			<span class="glyphicon glyphicon-heart"></span><span>&nbsp;1k</span>
		</div>
		<div class="image-info image-data">
			<span class="glyphicon glyphicon-question-sign"></span>
			<div class="image-data-popup">
                                <?php 
                                    foreach ($photo->data as $key => $value){
                                        echo '<label>'.$key.':</label>'.$value.'<br/>';
                                    }
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
		<a href="<?php echo 'photo?galleryId='.$gallery->id.'&photo='.$photo->href?>">
			<img src="<?php echo $photo->href; ?>" class="file"/>
		</a>		
	</div>
<?php } ?>
