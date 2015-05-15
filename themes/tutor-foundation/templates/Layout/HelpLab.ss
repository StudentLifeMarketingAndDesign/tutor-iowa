<div class="gradient">
	<div class="main typography" role="main" data-equalizer>
			
			<div class="row"  data-equalizer-watch>
				<%--<div class="page-bg" id="labmap"></div>--%>
				<div class="large-8 columns content" data-equalizer-watch>
					<div class="white-cover"></div>
					<article>
						$Breadcrumbs
						<h1>$Title</h1>

						<% if $Hours %><strong>Availability: </strong>{$Hours}<br /><% end_if %>
						<% if ExternalScheduleLink %>
							<a href="$ExternalScheduleLink" target="_blank" class="external-link">View full schedule</a>
						<% end_if %>
						<p>
						<% if $Location %>
						<span><strong>Location:</strong> $Location</span>
						<br>
						<% end_if %>
						<% if $Address %>
						<span><strong>Address:</strong><data id="address">$Address</data></span><br />
						<% end_if %>
						<% if $ContactEmail %>
						<strong>Contact:</strong>
							<% if ContactName %>
								<a href="mailto:$ContactEmail">$ContactName</a>
							<% else %>
								<a href="mailto:$ContactEmail">$ContactEmail</a>
							<% end_if %>
							<br />
						<% end_if %>
						<% if PhoneNo %>
							<strong>Phone:</strong> $PhoneNo<br />
						<% else %>
							<strong>No Phone Listed</strong><br />
						<% end_if %>
						</p>
						<% if $Description %>
							<h2>About $Title</h2>
							<p>$Description</p>
						<% end_if %>
						$Form
						<% if $Tags %>
							<p><% include Tags %></p>
						<% end_if %>
					</article>
				</div>
				<div class="large-4 columns end" data-equalizer-watch>
					<% include HelpLabSideNav %>
				</div>
			
			</div>
	
	</div>
</div>
							