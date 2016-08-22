<li class="resource-card card">
	<div class="worksheet-card">
		<a href="$Worksheet.URL">
		<h2>$Title</h2>
		<% if $Content %>
			$Content.Summary(50)
		<% end_if %>
		<% if $Worksheet %>
			<p class="text-center"><span class="button small">Download worksheet <i class=" fa fa-cloud-download fa-md"></i></a></span>
		<% end_if %>
		</p>
	</div>
</li>