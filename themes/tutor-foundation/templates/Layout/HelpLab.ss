<div class="gradient">
	<div class="main typography" role="main">
			
			<div class="row" data-equalizer>
				<div class="page-bg"></div>
				<div class="large-8 columns content" data-equalizer-watch>
					<div class="white-cover"></div>
					<article>
						<div class="row">
							<div class="medium-9 columns">
								<div id="breadcrumbs"><a href="{$BaseHref}">Home</a> > <a href="{$BaseHref}find-help/">Find Help</a> > <a href="{$BaseHref}help-labs/">Help Labs</a> > <span class="current">$Title</span></div>

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
								<div class="profile-image"><img src="http://lorempixel.com/500/500/" /></div>
								<% if canUserEditHelpLab %>
								<p><a href="{$Link}Edit">Edit this Help Lab</a></p>
								<% end_if %>
								<% if PhoneNo %>
								<p>Phone: $PhoneNo</p>
								<% end_if %>
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
					<% include SideNav %>
				</div>
			
			</div>
	
	</div>
</div>


<div class="board_content">
					<div id="help_card">
						<h1>$Title</h1>
						
						
						<% if ContactEmail %>
						<p>Contact: 
							<% if ContactName %>
								<a href="mailto:$ContactEmail">$ContactName</a>
							<% else %>
								<a href="mailto:$ContactEmail">$ContactEmail</a>
							<% end_if %>
						</p>
						<% end_if %>
						
						<% if Location %>
						<h3>Location</h3>
							$Location
						<% end_if %>
						<% if ExtrnlLink %>
						<p><a href="$ExtrnlLink" class="external-link" target="_blank">visit website</a></p>
						<% end_if %>
	
						
						<p>
						<div class="clearfix"></div>
						<!--<div class="button">Contact</div>-->
						<% if Description %>
						<h2>Description</h2>
					
						<div class="box-left">
							<div class="top_edge">
	
								<div class="right_edge">
									<div class="left_edge">
										<div class="white_thin">
											<p>
											<% if Description %>
												$Description
											<% end_if %>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						
				
						<% end_if %>
		
				
					</div>
					

					<div id="tutor_stats">
					
				
					
						<div id="availability">
							
								<div class="highlighted">Availability</div>
								

								
								<% if Hours %>
									<p>$Hours</p>
								<% else %>
									<p>Not provided</p>
								<% end_if %>
								
																
								<% if ExternalScheduleLink %>
									<p><a href="$ExternalScheduleLink" target="_blank" class="external-link">View full schedule</a></p>
								<% end_if %>
							
						</div>
						<%--
						<% if MetaKeywords %>
							<% include Tags %>
						<% end_if %>
						--%>	
					</div>	
	
			