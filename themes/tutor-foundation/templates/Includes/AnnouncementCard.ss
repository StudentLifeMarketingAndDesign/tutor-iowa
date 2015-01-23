<div class="announcements">
	<h3><span>Announcements</span></h3>
	<% loop LatestNews %>
	<div class="announcement-card">
		<a href="$Link">
			
				<h4>$Title</h4>
				<!--<p class = "news-details-Hpage">Posted on: $Date.Nice</p>-->
				<p>$Content.Summary(20)</p>
				
				<hr />
			
			</a>
	</div>
	<% end_loop %>
</div>