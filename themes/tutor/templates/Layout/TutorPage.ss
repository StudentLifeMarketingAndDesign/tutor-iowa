
				<div class="board_content">
					<div id="breadcrumbs"><a href="{$BaseHref}">Home</a> > <a href="{$BaseHref}find-help/">Find Help</a> > <span class="current">$Title</span></div>
					<h1>$FirstName $Surname</h1>
					<div id="tutor_card">
						
						<% if MeetingPreference %><span id="mp">Meeting Preference: </span><span id="meeting_preference">{$MeetingPreference}</span><% end_if %>
						<div class="clearfix"></div>
						<a href="{$BaseHref}contact-tutor/?tutor-id={$ID}" class="fancybox-button contact-button">Contact</a>
						
						<% if Content %>
						<h2>Bio</h2>
					
						<div class="box-left">
							<div class="top_edge">
	
								<div class="right_edge">
									<div class="left_edge">
										<div class="white_thin">
											<p>
											$Content
											
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<% end_if %>
						
						<div class="clearfix"></div>
					
					</div>
					
					<div id="tutor_stats">
					
					
					
					<% if Hours %>
					
						<div id="availability">
							
								<div class="highlighted"><span>Availability</span></div>
								<p>$Hours</p>
						</div>
					
					<% end_if %>
					
					<% if HourlyRate %>
				
						<div id="rate">
							
								<div class="highlighted">Hourly Rate</div>
								<p>$HourlyRate</p>
						</div>
				
					<% end_if %>
																
					<% if MetaKeywords %>
	
							<% include Tags %>
							
					<% end_if %>
					
				
				
			
				
			