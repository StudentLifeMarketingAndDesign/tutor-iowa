<div>
	<h3><span>Announcements</span></h3>
	<% loop LatestNews %>
		<h4><a href="$Link">$Title</a></h4>
		<!--<p class = "news-details-Hpage">Posted on: $Date.Nice</p>-->
		<p>$Content.Summary(20) <a href="$Link">continue reading...</a></p>
		
		<hr />
	<% end_loop %>
</div>