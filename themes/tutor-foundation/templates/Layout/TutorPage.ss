<div class="main typography" role="main">
	<div class="row">
		<div class="large-8 columns">
			<article>
				<div class="row">
					<div class="medium-10 columns">
						<h1>$Title</h1>
						<p><% if $MeetingPreference %><strong>Meeting Preference: </strong>{$MeetingPreference}<br /><% end_if %>
							<% if $Hours %><strong>Availability: </strong>{$Hours}<br /><% end_if %>
							<% if $HourlyRate %><strong>Hourly Rate:</strong> {$HourlyRate}<% end_if %>
							<% if $MetaKeywords %>
								<br /><% include TutorTags %>
							<% end_if %>
				
						</p>
					</div>
					<div class="medium-2 columns">
						<img src="{$ThemeDir}/images/placeholder.jpg" />
					</div>
				</div>
				$Content

				$Form
				<hr />
				<h2>Contact $FirstName</h2>
				$ContactForm
			</article>
		</div>
		<div class="large-4 columns end">
			<% include TutorSideNav %>
		</div>
	
	</div>
</div>