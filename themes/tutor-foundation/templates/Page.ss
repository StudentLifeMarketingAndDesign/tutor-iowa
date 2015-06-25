<!doctype html>
<html class="no-js" lang="$ContentLocale.ATT" dir="$i18nScriptDirection.ATT">
<head>
	<% base_tag %>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<% if $URLSegment = 'home' %>
		<title>$SiteConfig.Title - The University of Iowa</title>
	<% else %>
		<title>$Title - $SiteConfig.Title - The University of Iowa</title>
	<% end_if %>
	<meta name="description" content="$Content.ATT" />
	<%--http://ogp.me/--%>
	<meta property="og:site_name" content="$SiteConfig.Title.ATT" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="$Title.ATT" />
	<meta property="og:description" content="$Content.ATT" />
	<meta property="og:url" content="$AbsoluteLink.ATT" />
	<% if $Image %>
	<meta property="og:image" content="<% with $Image.SetSize(500,500) %>$AbsoluteURL.ATT<% end_with %>" />
	<% else %>
		<meta property="og:image" content="{$BaseHref}/{$ThemeDir}/images/tutor-iowa-logo-fb.png" />
	<% end_if %>
	<style><% include CriticalCss %></style>
	<% include Favicons %>
	<%--See [Requirements](http://doc.silverstripe.org/framework/en/reference/requirements) for loading from controller--%>
	<link rel="stylesheet" href="$ThemeDir/css/app.css" />
	<script src="$ThemeDir/bower_components/modernizr/modernizr.js"></script>
</head>
<body class="$ClassName.ATT $Action.ATT">
	<% include UiowaBar %>
	<header class="header" role="banner">
		<div class="contain-to-grid">
			<% include TopBar %>
		</div>
	</header>

	$Layout
	 <a id="feedback-btn" href="feedback" data-reveal-id="feedback-form-modal"><span class="visuallyhidden">Feedback</span></a>

	<% include Footer %>

	<% include LoginModal %>
	<% include FeedbackModal %>

	<%--See [Requirements](http://doc.silverstripe.org/framework/en/reference/requirements) for loading from controller--%>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
	<script type="text/javascript">
function downloadJSAtOnload() {
  var build = document.createElement("script");
  build.src = "$ThemeDir/build/build.js";
  document.body.appendChild(build);
}
if (window.addEventListener)
window.addEventListener("load", downloadJSAtOnload, false);
else if (window.attachEvent)
window.attachEvent("onload", downloadJSAtOnload);
else window.onload = downloadJSAtOnload;
</script>
<script src="//use.typekit.net/tvn1igz.js"></script>
<script>try{Typekit.load();}catch(e){}</script>
</body>
</html>
