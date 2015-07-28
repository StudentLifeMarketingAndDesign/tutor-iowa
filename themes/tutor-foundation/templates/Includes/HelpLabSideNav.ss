<div class="side-nav">
	<ul class="button-group stack">

		<% if $Action != "Edit" %>
			<% if canUserEditHelpLab %>
				<li><a href="$Link("Edit")" class="button radius success" >Edit this Help Lab</a></a></li>
			<% else %>

	  		<% end_if %>

	  	<% else %>

	  		<li><a href="$Link" class="button radius" target="_blank" >Show This Help Lab</a></a></li>
	  		
  		<% end_if %>
	</ul>

	<% include RelatedResources %>
</div>