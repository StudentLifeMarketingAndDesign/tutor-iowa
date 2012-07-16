				<div class="board_content">
					<div id="search_top">			
						<form>
					<div class="fieldHolder">
							<input type="text" name="Search" class="textInput" />
						</div>
							<input type="submit" name="action_results" class="button" value="Find Tutors" />
							<div id="search_help">example searches: bio, chem, 002:001, etc.</div>
						</form>
					</div>

					<div class="clearfix"></div>
					
					<h1>$Title</h1>
					
					

<div class="typography">
	<% if Results %>
	    <ul id="SearchResults">
	      <% control Results %>
	        <li>
	            <% if MenuTitle %>
	              <h3><a class="searchResultHeader" href="$Link">$MenuTitle</a></h3>
	            <% else %>
	              <h3><a class="searchResultHeader" href="$Link">$Title</a></h3>
	            <% end_if %>
			  <% if Content %>
	          	$Content.FirstParagraph(html)
			  <% end_if %>
	          <a class="readMoreLink" href="$Link" title="Read more about &quot;{$Title}&quot;">Read more about &quot;{$Title}&quot;...</a>
	        </li>
	      <% end_control %>
	    </ul>
	  <% else %>
	    <p>Sorry, your search query did not return any results.</p>
	  <% end_if %>

	  <% if Results.MoreThanOnePage %>
	    <div id="PageNumbers">
	      <% if Results.NotLastPage %>
	        <a class="next" href="$Results.NextLink" title="View the next page">Next</a>
	      <% end_if %>
	      <% if Results.NotFirstPage %>
	        <a class="prev" href="$Results.PrevLink" title="View the previous page">Prev</a>
	      <% end_if %>
	      <span>
	        <% control Results.SummaryPagination(5) %>
	          <% if CurrentBool %>
	            $PageNum
	          <% else %>
	            <a href="$Link" title="View page number $PageNum">$PageNum</a>
	          <% end_if %>
	        <% end_control %>
	      </span>
      
	    </div>
	 <% end_if %>
</div>
					
					<div id="talktota"><img src="{$ThemeDir}images/talktota.png" /></div>
					
			<% if HelpLabs %>
					<div class="chl_results">
						<div class="chl"></div>
						<div class="tape_right"></div>
						
							<% control HelpLabs %>
							<div class="chl_result">
								<h3><a href="$Link">$Title</a></h3>
								<p>$Content.Summary(40)
								</p>
								<div class="button"><a href="$Link">See More</a></div>
								</div>
								<% end_control %><%-- end control HelpLabs --%>

								<div class="clearfix"></div>
							
					</div>
				<% end_if %> <%-- end if HelpLabs --%>
				
				<% if SupplementalInstructions %>
					<div class="sli_results">
						<div class="sli"></div>
						<div class="tape_right"></div>
						
						<% control SupplementalInstructions %>
						<div class="sli_result">
							<h3><a href="tutor_test.html">$Title</a></h3>
							<p>$Content.Summary(40)</p>
							<div class="button">See More</div>
						</div>
							<% end_control %><%-- end control SuppInstructions --%>
							<div class="clearfix"></div>
					
						
					</div>
				<% end_if %><%-- end if SuppInstructions --%>
				
				<% if Tutors %>
					<div class="tutor_results">
						<% control Tutors %>
							<div class="tutor-result">
								<div class="tutor"></div>
								<div class="tape_right"></div>
										<h3><a href="$Link">$Title</a></h3>
										<p>$Bio
										</p>
										<div class="button"><a href="$Link">See More</a></div>
							</div>
						<% end_control %>

					<div class="clearfix"></div>
					</div>
				<% end_if %>
					