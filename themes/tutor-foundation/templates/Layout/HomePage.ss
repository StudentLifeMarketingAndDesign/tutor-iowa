 
<%-- <div class="bg-container lazy" data-src="{$ThemeDir}/images/home-bg-1.jpg"> --%>
<div class="bg-container lazy" data-src="{$ThemeDir}/images/home-bg-{$RandomBackgroundImage}.jpg">
		
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
	
					<h3 class="banner">Ways to get help</h3>
					<ul class="resource-card-list">
						<% with Page("supplemental-instruction") %>
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
					<% if FeaturedTutors %>
					<h3 class="banner">Certified Tutors</h3>
					
					<ul class="tutor-card-list large">
						<% loop FeaturedTutors.Limit(16) %>
							<% include TutorCard %>
						<% end_loop %>
					</ul>
					
					<% end_if %>
					<% if $RandomTutors.Count <= 4 %> 
					<h3 class="banner">Featured Campus Resources</h3>
					<ul class="resource-card-list large">
						<% loop featuredHelpLabs.Limit(5) %>
							<% include ResourceCard %>
						<% end_loop %>
					</ul>
					<% end_if %>
					<p class="text-center lean-more-link"><a href="private-tutors/certified">Learn more about certified tutors &rarr;</a></p>
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
