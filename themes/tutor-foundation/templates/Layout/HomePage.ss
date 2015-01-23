
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
		<ul class="tutor-card-list">
			<% loop ChildrenOf("private-tutors").Limit(8).Sort('RAND') %>
				<% include TutorCard %>
			<% end_loop %>
		</ul>
	</div>
	<div class="large-4 columns">
		<% include AnnouncementCard %>
								
	</div>
</div>

