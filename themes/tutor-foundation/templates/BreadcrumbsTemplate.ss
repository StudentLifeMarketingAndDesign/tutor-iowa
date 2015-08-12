<% if $Pages %>
<ul class="breadcrumbs">
	<% if not $InSection(home) %><li><a href="{$baseUrl}">Home</a></li><% end_if %>
	<% loop $Pages %>

			<% if $Last %>
				<li class="current show-for-col-md-up" title="Go to the $Title.ATT">
					<span>
						<menutitle class="show-for-col-sm-only">$MenuTitle.LimitCharacters(10)</menutitle>
						<menutitle class="show-for-col-md-up">$MenuTitle</menutitle>
					</span>

				</li>
			<% else %>
				<li>
					<a href="$Link" title="Go to the $Title.ATT">
						<menutitle class="show-for-col-sm-only">$MenuTitle.LimitCharacters(10)</menutitle>
						<menutitle class="show-for-col-md-up">$MenuTitle</menutitle>
					</a>
				</li>
			<% end_if %>

	<% end_loop %>
</ul>
<% end_if %>