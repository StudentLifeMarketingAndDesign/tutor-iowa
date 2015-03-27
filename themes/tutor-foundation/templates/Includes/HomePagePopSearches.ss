<div id="search_help"><p>Popular Searches:</p>

<% cached %>
	<% loop getTagsCollection %>
		<a class="tag" href="home/SearchForm?Search=$Title&action_results=Find+Tutors">$Title</a>
	<% end_loop %>
<% end_cached %>

	<%--<p><% include HomePageDemoSearches %></p>--%>

</div>

