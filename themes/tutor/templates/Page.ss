<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
<title>$Title - Tutor Iowa: Find Academic at Help at The University of Iowa</title>

<link href='http://fonts.googleapis.com/css?family=Permanent+Marker|Short+Stack|Gloria+Hallelujah|Oswald|Bevan' rel='stylesheet' type='text/css' />


<% base_tag %>
<link href='{$ThemeDir}/css/tutor.css' rel='stylesheet' type='text/css' />
<link href='{$ThemeDir}/css/forms.css' rel='stylesheet' type='text/css' />
<link href='{$ThemeDir}/scripts/fancybox/jquery.fancybox.css' rel='stylesheet' type='text/css' />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<!--[if IE 7]>
	<link href='{$ThemeDir}/css/ie7.css' rel='stylesheet' type='text/css' />
<![endif]-->

<!--[if IE 8]>
	<link href='{$ThemeDir}/css/ie8.css' rel='stylesheet' type='text/css' />
<![endif]-->

</head>

<body>


<div id="background">
	<div id="midground">
		<div id="fg_wrapper">
			<div id="navigation">
				<div id="navbar">
					<div class="nav_wrapper">
						
						<div id="nav">
							<ul>
							<% loop Menu(1) %>
							<a href="$Link"><li class="$FirstLast">$MenuTitle</li></a>
							<% end_loop %>
							</ul>
						</div>
						<div id="uiowa"><a href="http://www.uiowa.edu"><img src="{$ThemeDir}/images/uiowa.png" alt="The University of Iowa"/></a></div>
					</div>
				</div>
				<div class="nav_wrapper">
					<% if CurrentMember %>
						<div class="tab">Hi, <a href="$currentMemberPage.Link">$CurrentMember.FirstName $CurrentMember.Surname</a>!</div>
						<% if isHelpLab %>
							<a href="{$BaseHref}personal-help-labs"><div class="tab short">Edit Help Labs</div></a>
						<% else %>
							<a href="{$BaseHref}edit-profile"><div class="tab short">Edit Profile</div></a>
						<% end_if %>
					<% else %>
						<a href="{$BaseHref}register/"><div class="tab long">Apply to be a Tutor</div></a>
						<a href="{$BaseHref}Security/login/"><div class="tab short">Tutor Sign-In</div></a>
					<% end_if %>
					<!--<a href="#newsletter-signup-form" class="newsletter-signup-link"><div class="tab long">Sign up for E-mail updates!</div></a>-->
	
					<% if CurrentMember %>
					<a href="{$LogoutLink}"><div class="tab short">Sign Out</div></a>
					<% end_if %>
					<form action="{$BaseHref}home/SearchForm" class="topForm">
						<div id="topRightSearch">
							<input type="submit" name="action_results" class="topButton" value="Search" style="text-indent:-9999px;">	
							<label for="SearchForm" style="display:none;"></label><input type="text" name="Search" class="topSearch" id="SearchForm" placeholder="Find a tutor here!">
							
						</div>
					</form>
				</div>
			</div>
			<div id="foreground">
				
			
<div id="clip_wrapper">
	<a id="cliphead" href="{$BaseHref}" style="text-indent:-9999px;">Tutor Iowa</a>
				<div id="paper">
			$Layout
							</div>
	</div>
				
			</div>
			<!--<div class="nav_wrapper"><div id="login">Tutor Log In</div></div>-->
		</div>
	</div>
</div>

<div id="footer-wrapper">
	<div class="footer_content">
		<div class="third">
			<h2>Contact Us</h2>
			<ul>
				<li><a href="mailto:tutoriowa@uiowa.edu">Send us an email</a></li>
			</ul>
		</div>
		<div class="third">
			<h2>Site Map</h2>
			<ul>
				<% loop Menu(1) %>
				<li><a href="$Link">$Title</a></li>
				<% end_loop %>
			</ul>
		</div>
		
		<div class="footer-info">
			<a href="{$BaseHref}"><img src="{$ThemeDir}/images/footer_logo.png" alt="Tutor Iowa Logo"/></a>
			<a href="http://uc.uiowa.edu/swat"><img src="{$ThemeDir}/images/footer_swat.png" alt="SWAT Logo"/></a>
			<p>&copy; $Now.Year <a href="http://www.uiowa.edu/" target="_blank" >The University of Iowa</a></p>
			<p><a href="mailto:tutoriowa@uiowa.edu">tutoriowa@uiowa.edu</a></p>
		</div>
		<div class="clearfix"></div>
		<div class="disability-statement">
		<p>Individuals with disabilities are encouraged to attend all University of Iowa events. If you are a person with a disability and require an accommodation in order to participate in this event, please contact the SWAT Program / Tutor Iowa at 319-353-2747.</p>
		
		</div>
		
		<div class="clearfix"></div>
		
	</div>
</div>


<script type="text/javascript" src="{$ThemeDir}/scripts/fancybox/jquery.fancybox.pack.js"></script>

<script type="text/javascript" src="{$ThemeDir}/scripts/jquery.parallax-1.1.js"></script>
<script type="text/javascript" src="{$ThemeDir}/scripts/jquery.localscroll-1.2.7-min.js"></script>
<script type="text/javascript" src="{$ThemeDir}/scripts/jquery.scrollTo-1.4.2-min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){

	$('.newsletter-signup-link').fancybox({
		 type: 'inline',
		 maxWidth: '400'
	});

	$('.contact-button').fancybox({
		 type: 'iframe',
		 minHeight: 500
	});
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
	/*$('#background').parallax("50%",$("#foreground").height() + 88, 0.5, true);*/

})
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-426753-42']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>