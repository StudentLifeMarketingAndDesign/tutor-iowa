<div class="side-nav">
	<ul class="button-group stack">
		<% if $currentMemberPage.ID == $ID %>
			<li><a href="edit-profile/" class="button success radius">Edit Your Profile</a></li>
		<% else %>
  			<li><a href="{$getFeedbackLink}" class="button radius" target="_blank">Give Feedback About $FirstName</a></li>
  		<% end_if %>
	</ul>
	<hr />
	<h3><span>Related Campus Resources:</span></h3>

	<p><strong>Help Labs:</strong> <% loop ChildrenOf("help-labs").Limit(5) %><a href="$Link">$Title</a><% if not $Last %>, <% end_if %><% end_loop %>
		<hr />
		<strong>Supplemental Instruction:</strong> <% loop ChildrenOf("supplemental-instruction").Limit(5) %><a href="$Link">$Title</a><% if not $Last %>, <% end_if %><% end_loop %>
	</p>
	<hr />
 	<h3><span>Similar Tutors</span></h3>
 	<ul class="tutor-card-list small">
	<% loop ChildrenOf("private-tutors").Limit(4) %><% include TutorCard %><% end_loop %>
	</ul>
	<% if $Member %>
		<h3><span>Site Administration Options</span></h3>
		<ul class="button-group round even-3">
	  		<li><a href="mailto:address@address.com" class="button">Email</a></li>
	  		<li><a href="#" class="button success">Edit</a></li>
	  		<li><a href="#" class="button alert">Disable</a></li>
		</ul>
	<% end_if %>
</div>