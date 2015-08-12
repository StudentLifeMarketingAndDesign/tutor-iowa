<div class="gradient">

	<div class="main typography" role="main">
	
		<div class="row" data-equalizer>
			<div class="col-lg-8  content" data-equalizer-watch>
				<div class="white-cover"></div>
				<div class="row">
					<article class="col-lg-10  end">
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
			<div class="col-lg-4  end" data-equalizer-watch>
					<% include SideNav %>
			</div>
		
		</div>
	</div>
</div>