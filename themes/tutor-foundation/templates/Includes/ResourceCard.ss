
<li class="resource-card card $FirstLast">
	<a href="$Link">
		<h4>$Title</h4>
		<p>

		<% if $Location %>
			<strong>Location:</strong> $Location <br />
		<% end_if %>
		<% if $SessionLeader %>
			<strong>Led by:</strong> $SessionLeader<br />
		<% end_if %>		
		<% if ClassName == "SupplementalInstruction" %>
			<% if $Schedule %>
				<strong>Schedule:</strong> $Schedule.Summary(15)<br />
			<% end_if %>
		<% end_if %>
		<% if $Description %>
			<strong>Description:</strong> $Description.Summary(15)<br />
		<% else_if $Content %>
			<strong>Description:</strong> $Content.Summary(15)
		<% end_if %>
		</p>
	</a>
	<% if canUserEditHelpLab %>
		<p><a href="{$Link}Edit" class="button success">Edit</a></p>
	<% end_if %>
</li>