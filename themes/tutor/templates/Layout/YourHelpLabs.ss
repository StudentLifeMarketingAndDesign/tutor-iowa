<div class="board_content">
<div class="page-content">
<div id="breadcrumbs"><a href="{$BaseHref}">Home</a> > <span class="current">Your help labs</span></div>
<h1>$Title</h1>
<% loop getHelpLabs %>
	<a href="$Link" target="_blank">$Name</a>:   <a href="{$Link}Edit" >Edit</a> / <a href="$Link" target="_blank">View</a> <br>
<% end_loop %>
</div>
</div>






