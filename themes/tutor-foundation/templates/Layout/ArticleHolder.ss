
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
						$Content
						$Form

						<% loop Children %>
					
							<h2>$Title</h2>
							$Content
							<p class="text-right"><small>Last updated: $LastEdited.NiceUS</small></p>
						<hr />
						<% end_loop %>
					</article>
				</div>
			</div>
			<div class="large-4 columns end" data-equalizer-watch>
					<% include SideNavArticleHolder %>
			</div>
		
		</div>
	</div>
</div>