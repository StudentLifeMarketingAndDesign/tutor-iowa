	<div class="board_content">
					<div id="splimage">
						<span></span><img src="{$ThemeDir}/images/testimage.jpg" />
					</div>
					<div id="splext">
						<span>
							<div class="highlighted">Tutor Iowa</div> dolor sit amet, consectetur adipiscing elit. Aenean elit lorem, fermentum id eleifend nec, rhoncus et urna.
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
											<div class="thumb">
												<div class="tape"></div>
											</div>
											$Content.Summary(40)
										</p>
										<div class="button"><a href="$Link">See More</a></div>
										<% end_control %>
										
										<% control Page(help-labs) %>
										<h4><a href="$Link">Campus Help Labs</a></h4>
										<p>
											<div class="thumb">
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
										<div class="button">See More</div>
										<% end_control %>
										<a href="search_test.html"><div id="more"></div></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				
				<div class="clearfix"></div>