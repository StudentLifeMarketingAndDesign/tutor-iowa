
				<div class="board_content">
					<div id="breadcrumbs"><a href="{$BaseHref}">Home</a> > <a href="{$BaseHref}find-help/">Find Help</a> > <a href="{$BaseHref}supplemental-instructions/">Supplemental Instructions</a> > <span class="current">$Title</span></div>
				<% if MetaKeywords %>
					<% include Tags %>
				<% end_if %>
					<div id="supp_instruction_info">
						<h1>$Title</h1>
						<% if Location %>
						<h3>Location</h3>
						$Location
						<% end_if %>
						<div class="clearfix"></div>
						<!--<div class="button">Contact</div>-->
						
						<% if Content %>
						<h2>Description</h2>
						
						
						
						
						<div class="content-box">
						
							$Content
		
							
						</div>
					<% end_if %>
										
					<% if Schedule %> 
													
					<div class="schedule-container">
						<h2>Schedule</h2>
						$Schedule 
						
					<div class="suppLink">
								<h2>About Supplemental Instruction</h2>
								<p>Supplemental Instruction (SI) are free study group sessions that are open to UI students who are enrolled in the course. Sessions are informal and lead by peer students who have performed well in the course. <a href="{$AbsoluteBaseURL}supplemental-instructions">Learn more about supplemental instruction.</a></p>
							</div>
						
					</div>
					
					<% end_if %>
					
					
												
						<div class="clearfix"></div>
					
				
					</div>
					<div id="tutor_stats">
					
					<% if Hours %>
					
						<!--<div id="availability">
							
								<div class="highlighted">Availability</div>
								<p>$Hours</p>
						</div>-->
					
					<% end_if %>
					
				
				$ContactForm
		
				
			