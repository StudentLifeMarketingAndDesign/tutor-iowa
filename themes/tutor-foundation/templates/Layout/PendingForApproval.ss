<div class="gradient">

	<div class="main typography" role="main">
	
		<div class="row" data-equalizer>
			<div class="large-8 columns content" data-equalizer-watch>
				<div class="white-cover"></div>
				<div class="row">
					<article class="large-10 large-centered columns end">
						$Breadcrumbs
						<h1>$Title</h1>
						<% loop $PendingProfileImages %>
							$ProfileImage
						<% end_loop %>
						<% loop $PendingCoverImages %>
							$CoverImage
						<% end_loop %>
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