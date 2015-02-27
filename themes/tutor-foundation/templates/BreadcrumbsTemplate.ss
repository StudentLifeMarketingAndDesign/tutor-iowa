<% if $Pages %>
<ul class="breadcrumbs">
	<% if not $InSection(home) %><li><a href="{$baseUrl}">Home</a></li><% end_if %>
	<% loop $Pages %>
		<% if $Last %>
			<li class="current" title="Go to the $Title.ATT"><span>$MenuTitle</span></li>
		<% else %>
			<li><a href="$Link" title="Go to the $Title.ATT">$MenuTitle</a></li>
		<% end_if %>
	<% end_loop %>
</ul>
<% end_if %>