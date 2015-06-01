 
<div class="bg-container lazy" data-src="{$ThemeDir}/images/home-bg.jpg">
	
		
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
			<div class="large-9 columns content" data-equalizer-watch>
				<div class="white-cover"></div>
					<article>
					<hr />
					<h3 class="banner">Ways to get help</h3>
					<ul class="resource-card-list">
						<% with Page("supplemental-instructions") %>
							<% include ResourceCard %>
						<% end_with %>
						<% with Page("private-tutors") %>
							<% include ResourceCard %>
						<% end_with %>
						<% with Page("help-labs") %>
							<% include ResourceCard %>
						<% end_with %>
						<% with Page("academic-success") %>
							<% include ResourceCard %>
						<% end_with %>
					</ul>
					<hr />
					<h3 class="banner">Featured Tutors</h3>
					<ul class="tutor-card-list large">
						<% loop RandomTutors.Limit(16) %>
							<% include TutorCard %>
						<% end_loop %>
					</ul>
					<% if $RandomTutors.Count <= 4 %> 
					<hr />
					<h3 class="banner">Featured Campus Resources</h3>
					<ul class="resource-card-list large">
						<% loop featuredHelpLabs.Limit(5) %>
							<% include ResourceCard %>
						<% end_loop %>
					</ul>
					<% end_if %>
					</article>
			</div>
			<div class="large-3 columns end" data-equalizer-watch>
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
