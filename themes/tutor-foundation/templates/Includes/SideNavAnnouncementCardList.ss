<% if $LatestNews %>
<h3 class="uppercase banner tiny">Announcements</h3>
<ul class="announcements small">
	<% loop $LatestNews %>
		<% include AnnouncementCard %>
	<% end_loop %>
	<li class="announcement-card card last">
		<a href="news/" class="learn-more-link" style="color: #222">
			See more&nbsp;&rarr;
		</a>
	</li>

</ul>
<% end_if %>