<h3 class="uppercase tiny">Announcements</h3>
<ul class="announcements small">
	<% loop $LatestNews %>
		<% include AnnouncementCard %>
	<% end_loop %>
	<li class="announcement-card card last">
		<a href="news/">
			<h4>See all announcements</h4>
		</a>
	</li>

</ul>