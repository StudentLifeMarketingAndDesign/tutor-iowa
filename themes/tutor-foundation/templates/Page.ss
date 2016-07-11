<!doctype html>
<html class="no-js" lang="$ContentLocale.ATT" dir="$i18nScriptDirection.ATT">
<head>
	<% base_tag %>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<% if $URLSegment = 'home' %>
		<title>$SiteConfig.Title - The University of Iowa</title>
		<meta property="og:title" content="$SiteConfig.Title.ATT from the University of Iowa" />
	<% else %>
		<title>$Title - $SiteConfig.Title - The University of Iowa</title>
		<meta property="og:title" content="$Title.ATT" />
	<% end_if %>
	<meta name="description" content="$Content.Summary(100)" />
	<%--http://ogp.me/--%>
	<meta property="og:site_name" content="$SiteConfig.Title.ATT" />
	<meta property="og:type" content="website" />
	<meta property="og:description" content="$Content.Summary(100)" />
	<meta property="og:url" content="$AbsoluteLink.ATT" />
	<% if $Image %>
	<meta property="og:image" content="<% with $Image.SetSize(500,500) %>$AbsoluteURL.ATT<% end_with %>" />
		<meta property="og:image:width" content="500" />
		<meta property="og:image:height" content="500" />
	<% else %>
		<meta property="og:image" content="{$BaseHref}/{$ThemeDir}/images/tutor-iowa-logo-fb.png" />
		<meta property="og:image:width" content="1200" />
		<meta property="og:image:height" content="630" />
	<% end_if %>
<style><% include CriticalCss %></style>
	<% include Favicons %>
	<%--See [Requirements](http://doc.silverstripe.org/framework/en/reference/requirements) for loading from controller--%>
	<link rel="stylesheet" href="$ThemeDir/css/app.css" />
	<script src="$ThemeDir/bower_components/modernizr/modernizr.js"></script>
	<script src="//use.typekit.net/tvn1igz.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	<!--[if lt IE 9]>
	  <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
	  <script src="//s3.amazonaws.com/nwapi/nwmatcher/nwmatcher-1.2.5-min.js"></script>
	  <script src="//html5base.googlecode.com/svn-history/r38/trunk/js/selectivizr-1.0.3b.js"></script>
	  <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
	<![endif]-->
</head>
<body class="$ClassName.ATT $Action.ATT">
	<% include UiowaBar %>
	<header class="header" role="banner">
		<div class="contain-to-grid">
			<% include TopBar %>
		</div>
	</header>

	$Layout
	<% if $URLSegment != "feedback" %>
		 <a id="feedback-btn" href="feedback" data-reveal-id="feedback-form-modal"><span class="visuallyhidden">Feedback</span></a>
		<% end_if %>
	<% include Footer %>

	<% include LoginModal %>
	<% if $URLSegment != "feedback" %>
		<% include FeedbackModal %>
	<% end_if %>

	<%--See [Requirements](http://doc.silverstripe.org/framework/en/reference/requirements) for loading from controller--%>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
	<script src="{$ThemeDir}/build/build.js"></script>

<% include GoogleAnalytics %>
$BetterNavigator
</body>
</html>
