
<!--<div class="page-bg"></div>-->
<div>

	<div class="main typography" role="main">
	
		<div class="row" data-equalizer>
			<div class="large-8 columns content" data-equalizer-watch>
				<div class="row">
					<article class="large-10 columns end">
						$Breadcrumbs
						<h1>$Title</h1>
						$Content
						$Form
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
					</article>
				</div>
				<div class="row">
<section id="auth-button"></section>
<section id="view-selector"></section>
<section id="timeline"></section>

<!-- Step 2: Load the library. -->

<script>
(function(w,d,s,g,js,fjs){
  g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(cb){this.q.push(cb)}};
  js=d.createElement(s);fjs=d.getElementsByTagName(s)[0];
  js.src='https://apis.google.com/js/platform.js';
  fjs.parentNode.insertBefore(js,fjs);js.onload=function(){g.load('analytics')};
}(window,document,'script'));
</script>

<script>
gapi.analytics.ready(function() {

  // Step 3: Authorize the user.

  var CLIENT_ID = 'UA-426753-42';

  gapi.analytics.auth.authorize({
    container: 'auth-button',
    clientid: 685299649271-hv4jpd38skud41hnmf275eos04bv4r4i.apps.googleusercontent.com,
  });

  // Step 4: Create the view selector.

  var viewSelector = new gapi.analytics.ViewSelector({
    container: 'view-selector'
  });

  // Step 5: Create the timeline chart.

  var timeline = new gapi.analytics.googleCharts.DataChart({
    reportType: 'ga',
    query: {
      'dimensions': 'ga:date',
      'metrics': 'ga:sessions',
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
    },
    chart: {
      type: 'LINE',
      container: 'timeline'
    }
  });

  // Step 6: Hook up the components to work together.

  gapi.analytics.auth.on('success', function(response) {
    viewSelector.execute();
  });

  viewSelector.on('change', function(ids) {
    var newIds = {
      query: {
        ids: ids
      }
    }
    timeline.set(newIds).execute();
  });
});
</script>


				</div>
			</div>
			<div class="large-4 columns end" data-equalizer-watch>
					<div class="side-nav">
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
			</div>
		
		</div>
	</div>
</div>			