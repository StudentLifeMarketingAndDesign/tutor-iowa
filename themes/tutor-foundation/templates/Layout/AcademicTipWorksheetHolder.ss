
<!--<div class="page-bg"></div>-->


	<div class="main typography" role="main">
	
		<div class="row">
			<div class="large-12 columns content">
					<article>
						<div class="row">
							<div class="large-8 large-centered columns end">
								$Breadcrumbs
								<h1>$Title</h1>
								$Content

							</div>
							<div class="large-4 columns end">

							</div>
						</div>

						<h2>Topics:</h2>
						<ul class="accordion" data-accordion role="tablist">
							<li class="accordion-navigation active">
								<a href="#panel-featured" role="tab" id="panel-featured-heading" aria-controls="panel-featured">Featured&nbsp;<i class="fa fa-caret-down fa-lg"></i> </a>
								<div id="panel-featured" class="content active" role="tabpanel" aria-labelledby="panel-featured-heading">
								<ul class="resource-card-list">
								<% loop RandomWorksheets.Limit(2) %>
									<% include WorksheetCard %>
								<% end_loop %>
								</ul>
								</div>
							</li>
							<% loop $Categories %>
							  <li class="accordion-navigation">
							    <a href="#panel{$ID}d" role="tab" id="panel{$ID}d-heading" aria-controls="panel{$ID}d">$Title&nbsp;<i class="fa fa-caret-down fa-lg"></i> </a>
							    <div id="panel{$ID}d" class="content" role="tabpanel" aria-labelledby="panel{$ID}d-heading">
							    	<ul class="resource-card-list">
									<% loop Worksheets %>
										<% include WorksheetCard %>
									<% end_loop %>
									</ul>
							    </div>
							  </li>
							<% end_loop %>
							<li class="accordion-navigation">
								<a href="#panel-uncatd" role="tab" id="panel-uncatd-heading" aria-controls="panel-uncatd">Uncategorized&nbsp;<i class="fa fa-caret-down fa-lg"></i> </a>
								<div id="panel-uncatd" class="content" role="tabpanel" aria-labelledby="panel-uncatd-heading">
								<ul class="resource-card-list">
								<% loop UncategorizedWorksheets %>
									<% include WorksheetCard %>
								<% end_loop %>
								</ul>
								</div>
							</li>
						</ul>
						$Form
					</article>
		
			</div>
		
		</div>
	</div>
