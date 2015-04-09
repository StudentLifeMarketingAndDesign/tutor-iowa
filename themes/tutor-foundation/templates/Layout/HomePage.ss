
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
			<% loop featuredTutorPages.Limit(8) %>
				<% include TutorCard %>
			<% end_loop %>
		</ul>
	</div>
	<div class="large-4 columns side-nav">

		<% include AnnouncementCardList %>	
		
		<h3>Featured Campus Resources</h3>
		<ul class="resource-card-list small">
			<% loop featuredHelpLabs.Limit(8) %>
				<% include ResourceCard %>
			<% end_loop %>
		</ul>

	</div>
</div>
