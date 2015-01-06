<aside>
	<ul class="button-group even-1">
  		<li><a href="{$getFeedbackLink}" class="button secondary">Give Feedback About $FirstName</a></li>
	</ul>
	<h3>Related Campus Resources:</h3>
	
	<ul class="no-bullet">
		<li><strong>Help Labs:</strong> <% loop ChildrenOf("help-labs").Limit(5) %><a href="$Link">$Title</a><% if not $Last %>, <% end_if %><% end_loop %>
		</li>
		<li>
			<strong>Supplemental Instruction:</strong> <% loop ChildrenOf("supplemental-instruction").Limit(5) %><li><a href="$Link">$Title</a><% if not $Last %>, <% end_if %><% end_loop %>
		</li>
	</ul>
	<hr />
 	<h3>Similar Tutors</h3>
		<ul class="tutor-card-list small">
			<% loop ChildrenOf("private-tutors").Limit(4) %><% include TutorCardSmall %><% end_loop %>
		</ul>
	<% if $Member %>
		<hr />
		<h3>Site Administrator Menu</h3>
		<ul class="stack button-group">
	  		<li><a href="mailto:address@address.com" class="button">Email $FirstName Directly</a></li>
	  		<li><a href="#" class="button">Edit in SilverStripe</a></li>
	  		<li><a href="#" class="button alert">Unpublish (Deactivate)</a></li>
		</ul>
	<% end_if %>
</aside>