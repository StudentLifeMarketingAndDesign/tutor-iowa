
				<div class="board_content">
					<div id="breadcrumbs"><a href="{$BaseHref}">Home</a> > <a href="{$BaseHref}find-help/">Find Help</a> > <a href="{$BaseHref}help-labs/">Help Labs</a> > <span class="current">$Title</span></div>
					<div id="help_card">
						<h1>$Title</h1>
						<% if PhoneNo %>
							<p>Phone: $PhoneNo</p>
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
											$Description
										
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
							
								<div class="highlighted">Availability</div>
								<p>$Hours</p>
						</div>
						
						<% if MetaKeywords %>
							<% include Tags %>
						<% end_if %>
					
					<% end_if %>
					

					</div>	
						<div class="clearfix"></div>
				</div>
				

				$ContactForm
				
				
			