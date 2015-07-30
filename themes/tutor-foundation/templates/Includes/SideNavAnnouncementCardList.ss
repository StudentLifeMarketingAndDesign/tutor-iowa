<h3 class="uppercase banner tiny">Announcements</h3>
<ul class="announcements small">
	<% loop $LatestNews %>
		<% include AnnouncementCard %>
	<% end_loop %>
	<li class="announcement-card card last">
		<a href="news/">
			<h4>See all announcements &rarr;</h4>
		</a>
	</li>

</ul>