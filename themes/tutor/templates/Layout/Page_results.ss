				<div class="board_content">
					<div id="search_top">			
						<% include HomePageSearchForm %>
					</div>

					<div class="clearfix"></div>
					
			
					
			<% if Query %>
					<h1>Search Results</h1>
					<p>Your results for <strong>'{$Query}'</strong></p>	
			<% if Results %>		
			<div id="talktota"><img src="{$ThemeDir}/images/talktota.png" /></div>

			
			<% if HelpLabs %>
					<div class="chl_results">
						<div class="chl"></div>
						<div class="tape_right"></div>
						
							<% loop HelpLabs %>
							<div class="chl_result">
								<h3><a href="$Link">$Title</a></h3>
								<p>$Content.Summary(40)
								</p>
								<div class="button"><a href="$Link">See More</a></div>
								</div>
								<% end_loop %><%-- end loop HelpLabs --%>

								<div class="clearfix"></div>
							
					</div>
				<% end_if %> <%-- end if HelpLabs --%>
				
				<% if SupplementalInstructions %>
					<div class="sli_results">
						<div class="sli"></div>
						<div class="tape_right"></div>
						
						<% loop SupplementalInstructions %>
						<div class="sli_result $FirstLast">
							<h3><a href="$Link">$Title</a></h3>
							<p>$Content.Summary(40)</p>
							<div class="button"><a href="$Link">See More</a></div>
							<div class="clearfix"></div>

						</div>
							<% end_loop %><%-- end loop SuppInstructions --%>
					
						
					</div>
				<% end_if %><%-- end if SuppInstructions --%>
				
							
			<% if Tutors %>
					<div class="tutor_results">
						<div class="tutor"></div>
						<div class="tape_right"></div>
						
							<% loop Tutors %>
								<div class="tutor-result $FirstLast">
									<h3><a href="$Link">$Title</a></h3>
									<p>$Content.Summary(20) <a href="$Link">[...]</a></p>
									<% if MetaKeywords %>
										<p class="tags"><strong>tags:</strong> 
										<% loop SplitKeywords %>
											<a href="{$BaseHref}home/SearchForm?Search={$Keyword}&action_results=Find+Tutors">$Keyword</a><% if Last %><% else %>, <% end_if %> 
										<% end_loop %></p>
									<% end_if %>

									<% if $HourlyRate %>
										<p><strong>rate:</strong> $HourlyRate</p>
									<% end_if %>
									
									<div class="button"><a href="$Link">view profile</a></div>
									<div class="clearfix"></div>

								</div>
							<% end_loop %>
					</div>
				<% end_if %><%-- end if Tutors --%>
				
			<% end_if %> <%-- end if Results --%>
			<% else %>
			<% loop Page(find-help) %>
				$Content
			
			<% end_loop %>				
			
			<% end_if %> <%-- end if Query --%>	