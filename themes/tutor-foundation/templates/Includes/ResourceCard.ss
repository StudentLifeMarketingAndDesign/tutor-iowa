
<li class="resource-card card $FirstLast">
	<a href="$Link">
		<h4>$Title</h4>
		<p>
		<% if ClassName == "HelpLab" %>
			<% if $Location %>
				<strong>Location:</strong> $Location <br />
			<% end_if %>
		<% end_if %>

		<% if ClassName == "SupplementalInstruction" %>
			<% if $SessionLeader %>
				<strong>Led by:</strong> $SessionLeader<br />
			<% end_if %>		
		<% end_if %>

		<% if $Description %>
			$Description.Summary(20)<br />
		<% else_if $Content %>
			$Content.Summary(20)
		<% end_if %>
		</p>
	</a>
	<% if canUserEditHelpLab %>
		<p><a href="{$Link}Edit" class="button success">Edit</a></p>
	<% end_if %>
</li>