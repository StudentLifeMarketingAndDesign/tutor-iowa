<div class="side-nav">
	<ul class="button-group stack">
		<% if $currentMemberPage.ID == $ID %>
			<li><a href="edit-profile/" class="button success radius">Edit Your Profile</a></li>
		<% else %>
  			<li><a href="{$getFeedbackLink}" class="button radius" target="_blank">Give Feedback About $FirstName</a></li>
  		<% end_if %>
	</ul>
	<hr />
	<% include RelatedResources %>
		<% if $SiteAdmin %>

			<h3><span>Site Administration Options</span></h3>
			<ul class="button-group round even-3">
		  		<li><a href="mailto:address@address.com" class="button">Email</a></li>
		  		<li><a href="#" class="button success">Edit</a></li>
		  		<li><a href="#" class="button alert">Disable</a></li>
			</ul>
		<% end_if %>
</div>