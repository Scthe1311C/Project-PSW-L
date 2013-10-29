<!-- 
TODO provide variables !
TODO scale favorite-mark-up icon, make red on hover
-->

<?php for( $i = 1; $i < 8; $i++){ ?>
	<!-- single image element -->
	<div class="gallery-thumbnail" style="width:188px; height:141">
		
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
				<label>Resolution:</label>1600x1050<br/>
				<label>Camera:</label>Canon EOS 5D Mark II<br/>
				<label>Software:</label>Adobe Photoshop CS5<br/>
				<label>Date:</label>2012-11-26 16:04:45<br/>
				<label>Exposure time:</label>1/200 sec<br/>
				<label>F number:</label>F2.8
			</div>
		</div>
		<?php if( $is_logged){ ?>
			<!-- quick mark as favorite -->
			<div class="image-info favorite-mark-up">
				<span class="glyphicon glyphicon-heart"></span>
			</div>
		<?php } ?>
		
		<!-- image -->
		<a href="#">
			<img src="src/img/img<?php echo $i; ?>.jpg" class="file"/>
		</a>
		
	</div>
<?php } ?>