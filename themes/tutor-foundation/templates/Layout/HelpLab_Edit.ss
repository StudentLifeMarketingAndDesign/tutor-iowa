<div class="gradient">
	<div class="main container typography" role="main">
			
			<div class="row" data-equalizer>
				<%--<div class="page-bg" id="labmap"></div>--%>
				<div class="col-lg-8  content" data-equalizer-watch>
					<div class="white-cover"></div>
					<article>
						$Breadcrumbs
						<h1>$Title</h1>
						<% if HelpLabSaved %>

						<div data-alert class="alert-box success">
							  Your changes have been saved!
							  <a href="#" class="close">&times;</a>
						</div>
						<% end_if %>
						$HelpEditProfileForm
					</article>
				</div>
				<div class="col-lg-4  end" data-equalizer-watch>
					<% include HelpLabSideNav %>
				</div>
			
			</div>
	
	</div>
</div>
							