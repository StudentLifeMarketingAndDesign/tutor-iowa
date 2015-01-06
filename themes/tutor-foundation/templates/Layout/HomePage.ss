<div class="bg-container">
</div>
<div class="row main-content">
	<div class="large-8 columns">
		<ul class="tutor-card-list">
			<% loop ChildrenOf("private-tutors").Limit(3).Sort('RAND') %>
				<% include TutorCard %>
			<% end_loop %>
		</ul>
	</div>
	<div class="large-4 columns">
		<% include Announcements %>
								
	</div>
</div>