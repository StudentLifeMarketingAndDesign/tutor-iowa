
<!--<div class="page-bg"></div>-->
<div class="gradient">

	<div class="main typography" role="main">
	
		<div class="row" data-equalizer>
			<div class="large-8 columns content" data-equalizer-watch>
				<div class="white-cover"></div>
				<div class="row">
					<article class="large-10 large-centered columns end">
						$Breadcrumbs
						<h1>$Title</h1>
						<ul class="accordion" data-accordion role="tablist">
							<% loop $Categories %>
							  <li class="accordion-navigation">
							    <a href="#panel{$ID}d" role="tab" id="panel1d-heading" aria-controls="panel{$ID}d">$Title</a>
							    <div id="panel{$ID}d" class="content active" role="tabpanel" aria-labelledby="panel{$ID}d-heading">
									<% loop Worksheets %>
										<h2>$Title</h2>
										<% if $Content %>
											$Content
										<% end_if %>
										<% if $Worksheet %>
											<p><a href="$Workshet.URL" class="button medium">Download this worksheet</a></p>
										<% end_if %>
									<% end_loop %>
							    </div>
							  </li>
							<% end_loop %>
						</ul>
						$Content
						$Form
					</article>
				</div>
			</div>
			<div class="large-4 columns end" data-equalizer-watch>
					<% include SideNav %>
			</div>
		
		</div>
	</div>
</div>