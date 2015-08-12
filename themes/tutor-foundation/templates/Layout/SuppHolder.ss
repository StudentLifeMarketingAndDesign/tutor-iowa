
<!--<div class="page-bg"></div>-->
<div class="gradient">

	<div class="main typography" role="main">
	
		<div class="row" data-equalizer>
			<div class="col-lg-8  content" data-equalizer-watch>
				<div class="white-cover"></div>
				<div class="row">
					<article class="col-lg-10  end">
						$Breadcrumbs
						<h1>$Title</h1>
						<% include FindHelpSearch %>
						$Content
						$Form
					</article>
				</div>
				<div class="row">
					<div class="col-lg-12 ">
						<ul class="resource-card-list">
						<% loop $Children.Sort("Title") %>
							<% include ResourceCard %>
						<% end_loop %>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-4  end" data-equalizer-watch>
					<% include SideNav %>
			</div>
		
		</div>
	</div>
</div>