<div class="board_content">
					<div id="breadcrumbs"><a href="{$BaseHref}">Home</a> > <a href="{$BaseHref}find-help/">Find Help</a> > <a href="{$BaseHref}help-labs/">Help Labs</a> > <span class="current">$Title</span></div>
					<div id="help_card">
						<h1>$Title</h1>
						<% if PhoneNo %>
							<p>Phone: $PhoneNo</p>
						<% end_if %>
						
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
						<% if canUserEditHelpLab %>
							<p><a href="{$Link}Edit">Edit this Help Lab</a></p>
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
						
						<% if MetaKeywords %>
							<% include Tags %>
						<% end_if %>
							
						</div>	

		<div class="clearfix"></div>
	
				
			