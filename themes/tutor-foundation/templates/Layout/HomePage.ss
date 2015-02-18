
<div class="bg-container">
	
		
		<div class="HomePageSearchBg">
				<% include HomepageSearchForm %>
			<div class ="HomePagePopSearches">
				<% include HomePagePopSearches %>
			</div>
		</div>
	</div>
	
</div>

<div class="row main-content">
	<div class="large-8 columns">
		<ul class="tutor-card-list large">
			<% loop ChildrenOf("private-tutors").Limit(8).Sort('RAND') %>
				<% include TutorCard %>
			<% end_loop %>
		</ul>
	</div>
	<div class="large-4 columns side-nav">

		<% include AnnouncementCardList %>	
		
		<h3>Featured Campus Resources</h3>
		<ul class="resource-card-list small">
			<% loop ChildrenOf("help-labs").Limit(5) %>
				<% include ResourceCard %>
			<% end_loop %>
		</ul>

	</div>
</div>

