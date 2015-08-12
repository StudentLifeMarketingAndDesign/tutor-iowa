<div class="gradient">
	<div class="main container typography" role="main">
			
			<div class="row" data-equalizer>
				<div class="col-lg-8  content" data-equalizer-watch>
					<div class="white-cover"></div>
					<article>
						$Breadcrumbs
						<h1>$Title</h1>
						<% if ExternalScheduleLink %>
							<a href="$ExternalScheduleLink" target="_blank" class="external-link">View full schedule</a>
						<% end_if %>

						<% if $Location %>
						<span><strong>Location:</strong> $Location</span>
						<br />
						<% end_if %>

						<% if $Hours %>
						<span><strong>Hours:</strong> $Hours</span>
						<br />
						<% end_if %>


						<% if $Schedule %>
						$Schedule
						<% end_if %>


						<% if $SessionLeader%>
							<strong>Session Leader:</strong> $SessionLeader
							<br />
						<% end_if %>
						$Form
						<% if $Tags %>
							<p><% include Tags %></p>
						<% end_if %>
					</article>
				</div>
				<div class="col-lg-4  end" data-equalizer-watch>
					<% include SideNav %>
				</div>
			
			</div>
	
	</div>
</div>
							