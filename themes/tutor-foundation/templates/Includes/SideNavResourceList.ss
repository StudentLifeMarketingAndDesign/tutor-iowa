<h3 class="uppercase tiny">Featured Resources</h3>
<ul class="tutor-card-list small">
<% loop $RandomHelpLabs.Limit(8) %>
	<% include TutorCard %>
<% end_loop %>
</ul>