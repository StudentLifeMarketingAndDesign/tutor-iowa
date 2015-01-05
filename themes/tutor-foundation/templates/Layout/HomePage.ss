<div class="bg-container">
</div>
<div class="row main-content">
	<div class="large-8 columns">
		<ul class="tutor-card-list">
			<% loop ChildrenOf("private-tutors").Limit(3).Sort('RAND') %>
				<% include TutorCard %>
			<% end_loop %>
		</ul>
	</div>
	<div class="large-4 columns">
	<% loop LatestNews %>
		<h3><a href="$Link">$Title</a></h3>
		<!--<p class = "news-details-Hpage">Posted on: $Date.Nice</p>-->
		<p>$Content.Summary(20)</p>
		<a href="$Link">continue...</a>
		<hr />
	<% end_loop %>
								
	</div>
</div>