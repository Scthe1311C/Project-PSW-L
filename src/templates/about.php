<script>
$( document ).ready(function() {
	recalculateSectionsHeight();
});

function recalculateSectionsHeight(){
	var navBarH = $('#navigation-bar').height();
	var docViewTop = $(window).scrollTop();
	var docViewBottom = docViewTop + $(window).height();
	var h = docViewBottom - navBarH;
	
	var wrapper = $('#about-wrapper');
	//$(wrapper).css("height", $(wrapper).height());
	$(wrapper).css("height", h);
	//console.log( "measured h: "+$(wrapper).height()+"   ; h: "+h );
}

window.onresize = function(event) {
   recalculateSectionsHeight();
}
</script>

<div style="position:relative; width:100%; height:100%" id="about-wrapper">
<div class="main">
	
	<section id="about-section-1">
		<h1>
		Place some monochromatic background here. With some photos on the side. And big words.
		</h1>
	</section>
	<section id="about-section-2">
		<h1>
		incredible, unique, forward-thinking, bold, stunning, best, amazing, phenomenal, outstanding, fantastic, great, beautiful, great, new, gorgeous, innovative, incredible, remarkable, amazing, advanced, cool, revolutionary
		</h1>
	</section>
	<section id="about-section-3">
		<h1>
		section3
		</h1>
	</section>
</div>
</div>

<script>
$(".main").onepage_scroll({
	sectionContainer: "section",
	easing: "ease",
	animationTime: 1000,
	pagination: true,
	updateURL: false,
	beforeMove: function(index) {},
	afterMove: function(index) {},
	loop: false 
});
</script>
