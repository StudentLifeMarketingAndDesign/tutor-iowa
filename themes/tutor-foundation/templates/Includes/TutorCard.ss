<%--<li>
	<a href="$Link" class="profile-image"><img src="http://lorempixel.com/500/500/" /></a>
	<h3><a href="$Link">$Title</a></h3>
	$Content.Summary(10)
</li>--%>
<li class="card $FirstLast">
<a href="$Link" class="profile-image">
	<div class="row">
		<div class="small-3 columns push-9">
			
			<%--<img src="{$ThemeDir}/images/placeholder.jpg" /> --%>
			<img src="http://lorempixel.com/300/300/" />
			
			
		</div>
		<div class="small-9 columns pull-3">
			<h4 class="tutor-name" href="$Link">$Title</h4><p>$Content.Summary(20) <strong>...</strong></p>
			<%--<% loop $SplitKeywords.Sort('RAND').Limit(8) %>
				$Keyword<% if not $Last %>, <% end_if %>
			<% end_loop %>--%>
		</div>
	</div>
</a>
</li>