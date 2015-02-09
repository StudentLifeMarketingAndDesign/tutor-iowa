<div class="gradient">
	<div class="main typography" role="main">
			
			<div class="row" data-equalizer>
				<div class="page-bg"></div>
				<div class="large-8 columns content" data-equalizer-watch>
					<div class="white-cover"></div>
					<article>
						<div class="row">
							<div class="medium-9 columns">
								<h1>$Title</h1>

								<p><strong>Member Since: </strong> $Created.NiceUS <br />
								<% if $MeetingPreference %><strong>Meeting Preference: </strong>{$MeetingPreference}<br /><% end_if %>
									<% if $Hours %><strong>Availability: </strong>{$Hours}<br /><% end_if %>
									<% if $HourlyRate %><strong>Hourly Rate:</strong> {$HourlyRate}<% end_if %>
									<% if $MetaKeywords %>
										<br /><% include TutorTags %>
									<% end_if %>
						
								</p>
							</div>
							<div class="medium-3 columns">
								<!--<div class="profile-image"><img src="{$ThemeDir}/images/placeholder.jpg" /></div>-->

								<div class="profile-image">
									<% if $Image %>
										<img src="http://lorempixel.com/500/500/" />
									<% else %>
										<img src="{$ThemeDir}/images/stain.png" />
									<% end_if %>
								</div>
							</div>
						</div>
						$Content

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