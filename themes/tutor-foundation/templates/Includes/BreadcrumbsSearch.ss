
<ul class="breadcrumbs">
	<li><a href="">Home</a></li>
	<% if $Query %>
	<li class="current"><span>Search results for: $Query.LimitCharacters(20)</span></li>
	<% else %>
		<li class="current"><span>Search Tutor Iowa</span></li>
	<% end_if %>
</ul>
