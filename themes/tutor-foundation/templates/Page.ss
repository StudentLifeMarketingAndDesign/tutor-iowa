<!doctype html>
<html class="no-js" lang="$ContentLocale.ATT" dir="$i18nScriptDirection.ATT">
<head>
	<% base_tag %>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> - $SiteConfig.Title</title>
	<meta name="description" content="$MetaDescription.ATT" />
	<%--http://ogp.me/--%>
	<meta property="og:site_name" content="$SiteConfig.Title.ATT" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="$Title.ATT" />
	<meta property="og:description" content="$MetaDescription.ATT" />
	<meta property="og:url" content="$AbsoluteLink.ATT" />
	<% if $Image %>
	<meta property="og:image" content="<% with $Image.SetSize(500,500) %>$AbsoluteURL.ATT<% end_with %>" />
	<% end_if %>
	<link rel="icon" type="image/png" href="$ThemeDir/favicon.ico" />
	<%--See [Requirements](http://doc.silverstripe.org/framework/en/reference/requirements) for loading from controller--%>
	<link rel="stylesheet" href="$ThemeDir/css/app.css" />
	<script src="$ThemeDir/bower_components/modernizr/modernizr.js"></script>
	<script src="//use.typekit.net/tvn1igz.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
</head>
<body class="$ClassName.ATT">
	<% include UiowaBar %>
	<header class="header" role="banner">
		<div class="contain-to-grid">
			<% include TopBar %>
		</div>
	</header>

	$Layout

	<% include Footer %>

	<%--Login Modal--%>
	<div id="login-form-modal" class="reveal-modal large" data-reveal>
		<div class="row">
			<div class="large-6 columns">
				<h2>Login</h2>
				
				$LoginForm
			</div>
			<div class="large-6 columns">
				<div class="panel">
					<h2>New to Tutor Iowa?</h2>
					<p>If you'd like to sign up to be a tutor, please take a look at our registration process page.</p>
					<h3>How long does it take to be approved as a tutor?</h3>
					<p>X time. You need to complete the registration process and screening. Learn more</p>
					<h3>How do I edit my help lab?</h3>
					<p>In the main menu, select your name and then select "My Help Labs."</p>
				</div>
			</div>
		</div>
		<a class="close-reveal-modal">&#215;</a>
	</div>

	<%--See [Requirements](http://doc.silverstripe.org/framework/en/reference/requirements) for loading from controller--%>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="$ThemeDir/build/build.js"></script>
</body>
</html>
