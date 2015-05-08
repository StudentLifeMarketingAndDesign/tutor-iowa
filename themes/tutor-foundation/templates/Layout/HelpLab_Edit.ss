<div class="gradient">
	<div class="main typography" role="main">
			
			<div class="row" data-equalizer>
				<%--<div class="page-bg" id="labmap"></div>--%>
				<div class="large-8 columns content" data-equalizer-watch>
					<div class="white-cover"></div>
					<article>
					<% if HelpLabSaved %>
					<p class="alert">Your changes have been saved!</p>
					<% end_if %>
						$Breadcrumbs
						<h1>$Title</h1>
						$HelpEditProfileForm
					</article>
				</div>
				<div class="large-4 columns end" data-equalizer-watch>
					<% include HelpLabSideNav %>
				</div>
			
			</div>
	
	</div>
</div>
							