<div class="main typography" role="main">
	<div class="row">
		<div class="large-12 columns">
			$Breadcrumbs
		</div>
	</div>


	<div class="row" data-equalizer>
		<div class="large-6 columns content" data-equalizer-watch>
			<article>
				$Content
				$Form
				<h2>Tutor Requests</h2>

				<table style="width:100%">
					<tr>
						<th>Time period</th>
						<th>Number of requests</th>
					</tr>
					<tr>
						<td>Requests made since yesterday:</td>
						<td>{$RequestsSinceYesterday}</td>
					</tr>
					<tr>
						<td>Requests made in the last week:</td>
						<td>{$RequestsSinceLastWeek}</td>
					</tr>
					<tr>
						<td>Requests made in the last month: </td>
						<td>{$RequestsSinceLastMonth}</td>
					</tr>
					<tr>
						<td>Requests made in the last 6 months</td>
						<td>{$RequestsSinceLastSemester}</td>
					</tr>
					<tr>
						<td>Requests made in the last year</td>
						<td>{$RequestsSinceBeginningOfYear}</td>
					</tr>
					<tr>
						<td>Total requests made since January 2014:</td>
						<td>{$RequestsTotal}</td>
					</tr>
				</table>
				<h3>Quick Links</h3>
				<ul>
					<li><a href="admin/messages" target="_blank">Manage or Export all Tutor Requests in SilverStripe &rarr;</a></li>
					<li><a href="https://www.google.com/analytics/web/?hl=en#report/visitors-overview/a426753w61604118p63091529/" target="_blank">Tutor Iowa Google Analytics &rarr;</a></li>
				</ul>
			</article>
		</div>
		<div class="large-6 columns end" data-equalizer-watch>
			<div>
				<h2>Top 25 Most Popular Search Terms</h2>
				<table style="width:100%">
					<tr>
						<th>Search term</th>
						<th>Number of searches</th>
					</tr>
					<% loop $getTopSearchTerms.Sort("SearchCount",DESC).Limit(25) %>
						<tr>
							<td><a href="home/SearchForm?Search={$Title}" target="_blank">{$Title}</a></td>
							<td>{$SearchCount}</td>
						</tr>
					<% end_loop %>
				</table>
			</div>
		</div>
	</div>
</div>



