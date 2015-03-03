<div class="gradient">
	<div class="main typography" role="main">
			
			<div class="row" data-equalizer>
				<div class="page-bg"></div>
				<div class="large-8 columns content" data-equalizer-watch>

					<div class="white-cover"></div>
					$Breadcrumbs
					<article>
						<div class="row">
							<div class="medium-9 small-10 columns">
								<% if $Sent %>
								<div data-alert class="alert-box success">
								  Your message to $FirstName has been sent.
								  <a href="#" class="close">&times;</a>
								</div>
								<% end_if %>
								
								<h1>$Title</h1>
								<p><strong>Member Since: </strong> $Created.NiceUS <br />
								<% if $MeetingPreference %><strong>Meeting Preference: </strong>{$MeetingPreference}<br /><% end_if %>
									<% if $Hours %><strong>Availability: </strong>{$Hours}<br /><% end_if %>
									<% if $HourlyRate %><strong>Hourly Rate:</strong> {$HourlyRate}<% end_if %>
								</p>
								<% include EditProfileButton %>
							</div>
							<div class="medium-3 small-2 columns">

								<div class="profile-image">
									<% if $Image %>
										<img src="http://lorempixel.com/500/500/" />
									<% else %>
										<img src="{$ThemeDir}/images/stain.png" />
									<% end_if %>
									<span class="text-center"><% include EditProfileButton %></span>
								</div>
							</div>
						</div>

						<h2>About $FirstName</h2>
						<p>$Content</p>
						<% include EditProfileButton %>
						<% if $Tags %>
							<p><% include Tags %></p>
						<% end_if %>
						$Form
						<hr />
						<h2>Contact $FirstName</h2>
						$ContactForm
					</article>
				</div>
				<div class="large-4 columns end" data-equalizer-watch>
					<% include TutorSideNav %>
				</div>
			
			</div>
	
	</div>
</div>