
				<div class="board_content">
					<div id="breadcrumbs"><a href="{$BaseHref}">Home</a> > <a href="{$BaseHref}find-help/">Find Help</a> > <span class="current">$Title</span></div>
					<div id="tutor_card">
						<h1>$FirstName $Surname</h1>
						<% if MeetingPreference %><span id="mp">Meeting Preference: </span><span id="meeting_preference">{$MeetingPreference}</span><% end_if %>
						<div class="clearfix"></div>
						<a href="#contact-form-inline" class="fancybox-button fancybox">Contact</a>
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
						
						<div class="clearfix"></div>
					
					</div>
					<div id="tutor_stats">
					
					<% if Hours %>
					
						<div id="availability">
							
								<div class="highlighted">Availability</div>
								<p>$Hours</p>
						</div>
					
					<% end_if %>
					
				<% if MetaKeywords %>
				<div id="tags">
						<h2>Tags</h2>
						<div class="pclip"></div>
						<p>
						<% control SplitKeywords %>
							<a href="{$BaseHref}home/SearchForm?Search={$Keyword}&action_results=Find+Tutors">$Keyword</a>, 
						<% end_control %>
						
						</p>
						<div class="clearfix"></div>
						</div>
					</div>	
						<div id="stain"></div>
						<div class="clearfix"></div>
				</div>
				<% end_if %>
				
				<div id="contact-form-inline" style="display: none;"> 
				$ContactForm
				</div>
				
				
			