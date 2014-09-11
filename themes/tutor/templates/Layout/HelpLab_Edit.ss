<div class="board_content">
	<div id="page-content">
		<div id="breadcrumbs"><a href="{$BaseHref}">Home</a> > <a href="personal-help-labs/">Your help labs</a> > <span class="current">Edit help lab profile</span></div>
		<div class="typography">
			
			<h2>$Title</h2>
			<% if HelpLabSaved %>
			<p class="savedMessage">Your changes have been saved!</p>
			<% end_if %>
			<p><a href="$Link" target="_blank">Preview this page</a></p>
			$HelpEditProfileForm
			
		</div>
	</div>
</div>