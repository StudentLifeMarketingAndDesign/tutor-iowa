<h3 class="uppercase tiny">Announcements</h3>
<ul class="announcements small">
	<% loop $LatestNews %>
		<% include AnnouncementCard %>
	<% end_loop %>
</ul>