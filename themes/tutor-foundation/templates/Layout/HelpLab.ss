<div class="gradient">
	<div class="main typography" role="main">
			
			<div class="row" data-equalizer>
				<div class="page-bg" id="labmap"></div>
				<div class="large-8 columns content" data-equalizer-watch>
					<div class="white-cover"></div>
					<article>
						<div class="row" style="padding-top: 12px;">
							<div class="medium-12 columns" >

								<% include Breadcrumbs %>

								<h1>$Title</h1>

								<div class="row lab-info">
									<div class="medium-5 columns">
										<% if $Hours %><strong>Availability: </strong>{$Hours}<br /><% end_if %>
										<% if ExternalScheduleLink %>
											<a href="$ExternalScheduleLink" target="_blank" class="external-link">View full schedule</a>
										<% end_if %>
									</div>
									<div class="medium-4 columns">
										<% if $Location %>
										<span><strong>Location:</strong> $Location</span>
										<br>
										<% end_if %>
										<%-- if $Address --%>
										<span><strong>Address:</strong><data id="address">$Address 16 North Clinton Street, Iowa City, IA</data></span>
										<%-- end_if --%>
									</div>
									<div class="medium-3 columns">
										<% if PhoneNo %>
											<strong>Phone:</strong> $PhoneNo
										<% else %>
											<strong>No Phone Listed</strong>
										<% end_if %>
									</div>
								</div>
								<hr>
								$Description <%-- why not use $Content? Superseded in helplab.php --%>
								$Form
								<hr>
								<div class="row">
									<div class="medium-8 columns">
										<strong>Tags:</strong>
										<% if MetaKeywords %>
											<% include Tags %>
										<% end_if %>
									</div>
									<div class="medium-4 columns">
										<% if ContactEmail %>
										<strong>Contact:</strong>
											<% if ContactName %>
												<a href="mailto:$ContactEmail">$ContactName</a>
											<% else %>
												<a href="mailto:$ContactEmail">$ContactEmail</a>
											<% end_if %>
										<% end_if %>
									</div>
								</div>
							</div>
							<%-- do we need the coin image?
							<div class="medium-3 columns">
								<!--<div class="profile-image"><img src="{$ThemeDir}/images/placeholder.jpg" /></div>-->
								<div class="profile-image"><img src="http://lorempixel.com/500/500/" /></div>
							</div>
							--%>
						</div>

						<hr />
						<h2>Contact $FirstName</h2>
						$ContactForm
					</article>
				</div>
				<div class="large-4 columns end" data-equalizer-watch>
					<% include SideNav %>
				</div>
			
			</div>
	
	</div>
</div>
							