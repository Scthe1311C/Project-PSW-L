<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="src/css/style.css"/>
		<link rel="stylesheet" type="text/css" href="src/css/about.css"/>
		<link rel="stylesheet" type="text/css" href="vendor/onepage-scroll/onepage-scroll.css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="vendor/onepage-scroll/jquery.onepage-scroll.js"></script>
    </head>
    <body>
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
    </body>
	
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
</html>
