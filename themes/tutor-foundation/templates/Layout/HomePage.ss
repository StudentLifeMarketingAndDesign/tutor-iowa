
<div class="bg-container">
	
		
		<div class="HomePageSearchBg">
			<span class="tagline">$RandomTagline</span>
				<% include HomepageSearchForm %>
			<div class ="HomePagePopSearches">
				<% include HomePagePopSearches %>
			</div>
		</div>
	</div>
	
</div>
<div class="gradient">

	<div class="main typography" role="main">
	
		<div class="row" data-equalizer>
			<div class="large-8 columns content" data-equalizer-watch>
				<div class="white-cover"></div>
					<h3 class="banner">Shuffled Selection of Tutors</h3>
						<ul class="tutor-card-list large">
							<% loop RandomTutors.Limit(16) %>
								<% include TutorCard %>
							<% end_loop %>
						</ul>

			</div>
			<div class="large-4 columns end" data-equalizer-watch>
				<div class="side-nav">

					<% include AnnouncementCardList %>	
					
					<h3>Featured Campus Resources</h3>
					<ul class="resource-card-list small">
						<% loop featuredHelpLabs.Limit(5) %>
							<% include ResourceCard %>
						<% end_loop %>
					</ul>

				</div>
			</div>
		
		</div>
	</div>
</div>
