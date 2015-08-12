
<!--<div class="page-bg"></div>-->
<div class="gradient">

	<div class="main typography" role="main">
	
		<div class="row" data-equalizer>
			<div class="col-lg-8  content" data-equalizer-watch>
				<div class="white-cover"></div>
				<div class="row">
					<article class="col-lg-10  end">
						$Breadcrumbs
						$Content
						$Form
						<% loop Children %>
						<article>
							<h2>$Title</h2>
							$Content
						</article>
						<hr />
						<% end_loop %>
					</article>
				</div>
			</div>
			<div class="col-lg-4  end" data-equalizer-watch>
					<% include SideNavArticleHolder %>
			</div>
		
		</div>
	</div>
</div>