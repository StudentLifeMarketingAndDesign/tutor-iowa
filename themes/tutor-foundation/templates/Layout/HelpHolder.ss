
<!--<div class="page-bg"></div>-->
<div class="gradient">

	<div class="main typography" role="main">
	
		<div class="row" data-equalizer>
			<div class="large-8 columns content" data-equalizer-watch>
				<div class="white-cover"></div>
				<div class="row">
					<article class="large-10 columns">
						$Breadcrumbs
						<h1>$Title</h1>
						<% include FindHelpSearch %>
						$Content
						$Form
						<ul class="resource-card-list">
							<% loop Children %>
								<% include ResourceCard %>
							<% end_loop %>
						</ul>
					</article>
				</div>
			</div>
			<div class="large-4 columns end" data-equalizer-watch>
					<% include SideNav %>
			</div>
		
		</div>
	</div>
</div>