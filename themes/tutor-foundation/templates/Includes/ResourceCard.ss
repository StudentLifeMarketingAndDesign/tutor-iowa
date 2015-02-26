<li class="resource-card">
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
		<% end_if %>
		<span>Continue reading...</span>
		</p>
	</a>
</li>
