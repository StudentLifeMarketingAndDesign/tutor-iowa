<div class="gradient">
	<div class="main typography" role="main">
			
			<div class="row" >
				<div class="large-8 columns content" >

					<h1 align="center">$Title</h1>
				</div>
					<div class="large-4 columns content"align="center" >

					<h1>Sidebar</h1>
				</div>

			</div>
			<div class="row" >
				<%--<div class="page-bg" id="labmap"></div>--%>
				<div class="large-4 columns content"align="center" >
					

					<h4>Message Count</h4>

					<table style="width:100%">
						<tr>
							<th>Requests over Time:</th>
							<th>Count</th>
						</tr> 			  
					  	
							
							<tr>
							<td>Messages since yesterday:</td>
							<td>{$RequestsSinceYesterday}</td> 							
							</tr>
							<tr>
							<td>Messages over the last week:</td>
							<td>{$RequestsSinceLastWeek}</td> 							
							</tr>
							<tr>
							<td>Messages over the last month: </td>
							<td>{$RequestsSinceLastMonth}</td> 							
							</tr>
							<tr>
							<td>Messages over the last 6 months</td>
							<td>{$RequestsSinceLastSemester}</td> 							
							</tr>
							<tr>
							<td>Messages over the last year</td>
							<td>{$RequestsSinceBeginningOfYear}</td> 							
							</tr>

					  
					  </table>

				
				</div>
				<div class="large-4 columns content"align="left" >
					

					<h4>Top 25 Most Popular Terms</h4>

					<table style="width:100%">
						<tr>
							<th>Title</th>
							<th>Count</th>
					  <% loop $getTopSearchTerms.Sort("SearchCount",DESC).Limit(25) %>	  
					  	
							<tr>
							<td>{$Title}</td>
							<td>{$SearchCount}</td> 							
							</tr>

					  <% end_loop %>
					  </table>
				
					
				</div>
				<div class="large-4 columns content"align="left" >
					

					
				</div>
				
			
			</div>
		</div>
	
</div>
					