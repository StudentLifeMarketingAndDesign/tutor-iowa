	<div class="board_content">
	<% if NewsletterSignedUp %>
	<p class="message">Thanks for signing up for our newsletter!</p>
	<% end_if %>
					<div id="splimage">

					

						<span></span>$MainImage.SetRatioSize(499,216)

					</div>
					<div id="splext">
						<span>
							$Content

						</span>
					</div>
					
					<% include HomePageSearchForm %>

<div class="clearfix"></div>
				
					<div class="box-left">
						<div class="top_edge">
	
							<div class="right_edge">
								<div class="left_edge">
									<div class="white">
										<% loop Page(supplemental-instructions) %>
										<h4><a href="$Link">$Title</a></h4>
										<p>
											<div class="thumb" style="background-image: 
											
											url(<% loop Image %> 
											<% loop SetRatioSize(135,135) %> $URL <% end_loop %>
											<% end_loop %>); background-repeat: no-repeat;">
											

												<div class="tape"></div>
											</div>
											$Content.Summary(40)
										</p>
										<p><a href="$Link">Learn more about supplemental instruction.</a></p>
										<% end_loop %>
										<hr />

										<% loop Page(help-labs) %>
										<h4><a href="$Link">Campus Help Labs</a></h4>
										<p>

											
											<div class="thumb" style="background-image: 
											
											url(<% loop Image %> 
											<% loop SetRatioSize(135,135) %> $URL <% end_loop %>
											<% end_loop %>); background-repeat: no-repeat;">
											

												<div class="tape"></div>
											</div>
											$Content.Summary(20)
										</p>
										<p><a href="$Link">Learn more about campus help labs.</a></p>
										<% end_loop %>
										<hr />
										<% if Page(academic-success) %>
											<% loop Page(academic-success) %>
											<h4><a href="$Link">$Title</a></h4>
												<p>
													<div class="thumb" style="background-image: 
													
													url(<% loop Image %> 
													<% loop SetRatioSize(135,135) %> $URL <% end_loop %>
													<% end_loop %>); background-repeat: no-repeat;">
													
		
													<div class="tape"></div>
													
													</div>
													$Content.Summary(20)											
												</p>
											
											<p><a href="$Link">Learn more about $Title</a></p>
											
											<% end_loop %>
										<% end_if %>
										
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
										<% loop LatestNews %>
										<h4><a href="$Link">$Title</a></h4>
										<!--<p class = "news-details-Hpage">Posted on: $Date.Nice</p>-->
										<p>$Content.Summary(20)</p>
										<a href="$Link">continue...</a>
										<hr />
										<% end_loop %>
										<a href="{$BaseHref}news"><div id="more"></div></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				
				<div class="clearfix"></div>
				
				