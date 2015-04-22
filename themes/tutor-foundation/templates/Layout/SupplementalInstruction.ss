<div class="gradient">
	<div class="main typography" role="main">
			
			<div class="row" data-equalizer>
				<div class="large-8 columns content" data-equalizer-watch>
					<div class="white-cover"></div>
					<article>
						$Breadcrumbs
						<h1>$Title</h1>
						<% if ExternalScheduleLink %>
							<a href="$ExternalScheduleLink" target="_blank" class="external-link">View full schedule</a>
						<% end_if %>

						<% if $Location %>
						<span><strong>Location:</strong>$Location</span>
						<br />
						<% end_if %>

						<% if $Hours %>
						<span><strong>Hours:</strong>$Hours</span>
						<br />
						<% end_if %>


						<% if $Schedule %>
						<span><strong>Schedule:</strong>$Schedule</span>
						<br />
						<% end_if %>


						<% if $SessionLeader%>
							<strong>Session Leader:</strong>$SessionLeader
							<br />
						<% end_if %>
						$Form
						<% if $Tags %>
							<p><% include Tags %></p>
						<% end_if %>
					</article>
				</div>
				<div class="large-4 columns end" data-equalizer-watch>
					<% include SideNav %>
				</div>
			
			</div>
	
	</div>
</div>
							