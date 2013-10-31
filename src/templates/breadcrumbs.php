<?php 
	$breadcrumbs = array("Home","Explore___________","gallery");
 ?>
 
<script>
/*
$(document).ready(function(){
	$("#breadcrumb li").hover(function(){
		var hoverPos = parseInt($(this).data("id"));
		//console.log(hoverPos);
		//$("#breadcrumb li").children().eq(hoverPos)
		//$(this).children("a").css("color","yellow"); // change saturation
		if( hoverPos!=0){
			// change saturation by the same amount
			$("#breadcrumb li").children().eq(hoverPos-1)
				.css("color","red");
			$("#breadcrumb li").children().eq(hoverPos-1)
				.addClass("breadcrumb-child-hover");
		}
	   },function(){
			$("p").css("background-color","pink");
	 });
});
*/
</script>
 
<ul id="breadcrumb">
	<?php foreach( $breadcrumbs as $i=>$crumb){ ?>
		<li data-id="<?php echo $i; ?>">
		<a href="#">
			<span><?php echo $crumb; ?></span>
		</a></li>
	<?php } ?>
</ul>

