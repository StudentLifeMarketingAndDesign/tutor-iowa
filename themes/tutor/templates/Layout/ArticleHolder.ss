<div class="board_content">
<div id="breadcrumbs"><a href="{$BaseHref}">Home</a> > <span class="current">News</span></div>
<h1>$Title</h1>
<div id="News">

<% control News %>
	<h4><a href="$Link">$Title</a></h4>
	<p>$Content.Summary(20)</p>
	<div class="button"><a href="$Link">See More</a></div>
<% end_control %>
</div>
</div>









