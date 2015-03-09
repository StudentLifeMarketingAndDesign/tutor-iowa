<div class="gradient">
	<div class="main typography" role="main">
		<div class="row" data-equalizer>
			<div class="large-8 columns" data-equalizer-watch>
				<div class="white-cover"></div>
				<div class="row">
					<article class="large-12 columns" >
						$Breadcrumbs
						<% if $Saved %>
						<div data-alert class="alert-box success">
						  Profile Saved.
						  <a href="#" class="close">&times;</a>
						</div>
						<% end_if %>
						$ClearSession
						<h1>$Title</h1>
						<p>Read the For Tutors page to learn more about tags and promoting yourself on Tutor Iowa!</p>
						$Content
						$EditProfileForm
					</article>
				</div>
			</div>
			<div class="large-4 columns end" data-equalizer-watch>
				<div class="side-nav">
				<ul class="button-group stack">
					<li><a href="$currentMemberPage.Link" target="_blank" class="button radius">View Profile</a></li>
				</ul>
				</div>
				<% include SideNav %>
			</div>
		
		</div>
	</div>
</div>