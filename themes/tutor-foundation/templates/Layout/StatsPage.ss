<div class="main typography" role="main">
	<div class="row">
		<div class="large-12 columns">
			$Breadcrumbs
		</div>
	</div>


	<div class="row" data-equalizer>
		<div class="large-8 columns content" data-equalizer-watch>
			<article>
				<h1>$Title</h1>
				$Content
				$Form
				<h2>Tutor Requests</h2>

				<table style="width:100%">
					<tr>
						<th>Tutor requests this year</th>
						<th>Count</th>
					</tr>
					<tr>
						<td>Requests sent yesterday:</td>
						<td>{$RequestsSinceYesterday}</td>
					</tr>
					<tr>
						<td>Requests sent in the last week:</td>
						<td>{$RequestsSinceLastWeek}</td>
					</tr>
					<tr>
						<td>Requests sent in the last month: </td>
						<td>{$RequestsSinceLastMonth}</td>
					</tr>
					<tr>
						<td>Requests sent in the last 6 months</td>
						<td>{$RequestsSinceLastSemester}</td>
					</tr>
					<tr>
						<td>Requests sent in the last year</td>
						<td>{$RequestsSinceBeginningOfYear}</td>
					</tr>
				</table>

				<h3>Quick Links</h3>
				<ul>
					<li><a href="https://www.google.com/analytics/web/?hl=en#report/visitors-overview/a426753w61604118p63091529/" target="_blank">Tutor Iowa Google Analytics</a></li>
				</ul>
			</article>
		</div>
		<div class="large-4 columns end" data-equalizer-watch>
			<div>
				<h2>Top 25 Most Popular Search Terms</h2>
				<table style="width:100%">
					<tr>
						<th>Title</th>
						<th>Count</th>
					</tr>
					<% loop $getTopSearchTerms.Sort("SearchCount",DESC).Limit(25) %>
						<tr>
							<td>{$Title}</td>
							<td>{$SearchCount}</td>
						</tr>
					<% end_loop %>
				</table>
			</div>
		</div>
	</div>
</div>



