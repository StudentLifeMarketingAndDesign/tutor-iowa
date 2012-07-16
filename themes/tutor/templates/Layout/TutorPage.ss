
				<div class="board_content">
					<div id="breadcrumbs"><a href="index_test.html">Home</a> > <a href="search_test.html">Find a Tutor</a> > <span class="current">$Title</span></div>
					<div id="tutor_card">
						<h1>$Title</h1>
						<span id="mp">Meeting Preference: </span><span id="meeting_preference">On Campus</span>
						<div class="clearfix"></div>
						<div class="button">Contact</div>
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
							
								<div class="highlighted">Availability</div><br />
								$Hours
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
				
				
			