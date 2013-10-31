<?php 
	$breadcrumbs = array("Home","Explore___________","gallery");
 ?>
 
<script>
$(document).ready(function(){
	$("#breadcrumb li").hover(function(){
	   $("p").css("background-color","yellow");
		$(this).css("background-color","yellow");
	   },function(){
	   $("p").css("background-color","pink");
	   
	 });
});
</script>
 
<ul id="breadcrumb">
	<?php foreach( $breadcrumbs as $i=>$crumb){ ?>
		<li>
		<a href="#">
			<span><?php echo $crumb; ?></span>
		</a></li>
	<?php } ?>
</ul>

<p>Lorem</p>