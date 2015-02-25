<div id="search_help"><p>Popular Searches:</p>
<% loop PopularSearches.Limit(25) %>
	<a class="tag" href="SearchForm?Search=$Title&action_results=Find+Tutors">$Title</a>
<% end_loop %>
</div>

