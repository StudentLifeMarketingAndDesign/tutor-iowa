	<div class="board_content">
	<% if NewsletterSignedUp %>
	<p class="message">Thanks for signing up for our newsletter!</p>
	<% end_if %>
					<div id="splimage">
						<span></span>$MainImage.SetRatioSize(499,216)
					</div>
					<div id="splext">
						<span>
							<div class="highlighted">Tutor Iowa</div> is the best spot to find help and personal mentoring for your University of Iowa classes! <div class="button"><a href="about/">Read More</a></div>

						</span>
					</div>
					
					<% include SearchForm %>

<div class="clearfix"></div>
				
					<div class="box-left">
						<div class="top_edge">
	
							<div class="right_edge">
								<div class="left_edge">
									<div class="white">
										<% control Page(supplemental-instructions) %>
										<h4><a href="$Link">$Title</a></h4>
										<p>
											<div class="thumb" style="background-image: 
											
											url(<% control Image %> 
											<% control SetRatioSize(135,135) %> $URL <% end_control %>
											<% end_control %>); background-repeat: no-repeat;">
											
												<div class="tape"></div>
											</div>
											$Content.Summary(40)
										</p>
										<div class="button"><a href="$Link">See More</a></div>
										<% end_control %>
										
										<% control Page(help-labs) %>
										<h4><a href="$Link">Campus Help Labs</a></h4>
										<p>
											<div class="thumb" style="background-image: 
											
											url(<% control Image %> 
											<% control SetRatioSize(135,135) %> $URL <% end_control %>
											<% end_control %>); background-repeat: no-repeat;">
											
												<div class="tape"></div>
											</div>
											$Content.Summary(20)
										</p>
										<div class="button"><a href="$Link">See More</a></div>
										<% end_control %>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="box-right">
						<div class="top_edge">
	
							<div class="right_edge">
								<div class="left_edge">
									<div class="white">
										<div id="news"></div>
										<% control News %>
										<h4><a href="$Link">$Title</a></h4>
										<p>$Content.Summary(20)</p>
										<div class="button"><a href="$Link">See More</a></div>
										<% end_control %>
										<a href="{$BaseHref}news"><div id="more"></div></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				
				<div class="clearfix"></div>