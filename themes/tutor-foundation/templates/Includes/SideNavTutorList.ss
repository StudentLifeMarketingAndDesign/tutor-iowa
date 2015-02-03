<h3 class="uppercase tiny">Featured Tutors</h3>
<ul class="tutor-card-list small">
<% loop ChildrenOf("private-tutors").Limit(3) %>
	<% include TutorCard %>
<% end_loop %>
</ul>