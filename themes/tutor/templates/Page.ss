<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
<title>Tutor Iowa Demo</title>

<link href='http://fonts.googleapis.com/css?family=Permanent+Marker|Short+Stack|Gloria+Hallelujah|Oswald|Bevan' rel='stylesheet' type='text/css' />


<% base_tag %>
<link href='{$ThemeDir}/css/tutor.css' rel='stylesheet' type='text/css' />

</head>

<body>


<div id="background">
	<div id="midground">
		<div id="fg_wrapper">
			<div id="navbar">
				<div class="nav_wrapper">
					<div id="uiowa"><img src="{$ThemeDir}/images/uiowa.png" /></div>
					<div id="nav">
						<ul>
						<% control Menu(1) %>
						<a href="$Link"><li>$MenuTitle</li></a>
						<% end_control %>
						</ul>
					</div>
				</div>
			</div>
			<div class="nav_wrapper">
				<a href="#"><div class="tab short">Tutor Sign-Up</div></a>
				<a href="#"><div class="tab short">Tutor Sign-In</div></a>
				<a href="#"><div class="tab long">Sign up for E-mail updates!</div></a>
			</div>
			<div id="foreground">
				
				
<div id="clip_wrapper">
	<div id="cliphead"></div>
	<div id="board_top"></div>
	<div id="board_shadow_mid">
		<div id="board_mid">
			<div id="paper">
			$Layout
					
			</div>
				
				
			</div>
		</div>
	</div>
	<div id="board_shadow_bottom">
		<div id="board_bottom"></div>
	</div>
</div>
				
			</div>
			<div class="nav_wrapper"><div id="login">Tutor Log In</div></div>
		</div>
	</div>
</div>



  
  

<div id="footer-wrapper">
	<div class="board_content">
		<div class="third">
			<h2>Contact Us</h2>
			<ul>
				<li><a href="#">Send us an email</a></li>
			</ul>
		</div>
		<div class="third">
			<h2>Site Map</h2>
			<ul>
				<li><a href="#">I dunno</a></li>
				<li><a href="#">I dunno</a></li>
				<li><a href="#">I dunno</a></li>
			</ul>
		</div>
	</div>
</div>
      
      
      


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="{$ThemeDir}/scripts/jquery.parallax-1.1.js"></script>
<script type="text/javascript" src="{$ThemeDir}/scripts/jquery.localscroll-1.2.7-min.js"></script>
<script type="text/javascript" src="{$ThemeDir}/scripts/jquery.scrollTo-1.4.2-min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#nav').localScroll(800);
	
	RepositionNav();
	
	$(window).resize(function(){
		RepositionNav();
	});	
	
	//.parallax(xPosition, adjuster, inertia, outerHeight) options:
	//xPosition - Horizontal position of the element
	//adjuster - y position to start from
	//inertia - speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling
	//outerHeight (true/false) - Whether or not jQuery should use it's outerHeight option to determine when a section is in the viewport
	$('#background').parallax("50%",$("#foreground").height() + 88, 0.5, true);

})
</script>

</body>
</html>