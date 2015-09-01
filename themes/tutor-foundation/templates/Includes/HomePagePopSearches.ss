<div id="search_help">
<% cached %>
	<% loop getTagsCollection %>
		<a class="tag" href="home/SearchForm?Search=$Title&action_results=Find+Tutors">$Title.LimitCharacters(50)</a>
	<% end_loop %>
<% end_cached %>
</div>

