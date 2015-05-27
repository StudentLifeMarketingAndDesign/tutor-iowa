<div class="side-nav">
	<ul class="button-group stack">

		<% if $Action != "Edit" %>
			<% if canUserEditHelpLab %>
				<li><a href="$Link("Edit")" class="button radius success" >Edit this Help Lab</a></a></li>
			<% else %>
	  			<li><a href="feedback/" class="button radius" data-reveal-id="feedback-form-modal" >Give Feedback About This Lab</a></li>
	  		<% end_if %>

	  	<% else %>

	  		<li><a href="$Link" class="button radius" target="_blank" >Show This Help Lab</a></a></li>

  		<% end_if %>
	</ul>
	<hr />
	<% include RelatedResources %>
</div>