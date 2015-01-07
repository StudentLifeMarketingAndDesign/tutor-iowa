<div class="gradient">
	<div class="main typography" role="main">
			
			<div class="row" data-equalizer>
				<div class="page-bg"></div>
				<div class="large-8 columns content" data-equalizer-watch>
					<div class="white-cover"></div>
					<article>
						<div class="row" style="padding-top: 12px;">
							<div class="medium-9 columns" >

								<% include Breadcrumbs %>

								<h1>$Title</h1>

								<div class="row">
									<div class="medium-8 columns">
										<% if $Hours %><strong>Availability: </strong>{$Hours}<br /><% end_if %>
										<% if ExternalScheduleLink %>
											<a href="$ExternalScheduleLink" target="_blank" class="external-link">View full schedule</a>
										<% end_if %>
									</div>
									<div class="medium-4 columns">
										<% if PhoneNo %>
											<strong>Phone:</strong> $PhoneNo
										<% else %>
											<strong>No Phone Listed</strong>
										<% end_if %>
										<br>
										<% if Location %>
										<strong>Location:</strong>
											$Location
										<% end_if %>
									</div>
									<hr>
								</div>

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
							<div class="medium-3 columns">
								<!--<div class="profile-image"><img src="{$ThemeDir}/images/placeholder.jpg" /></div>-->
								<div class="profile-image"><img src="http://lorempixel.com/500/500/" /></div>
							</div>
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
							