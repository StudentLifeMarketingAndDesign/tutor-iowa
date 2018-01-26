<%--<li>
	<a href="$Link" class="profile-image"><img src="http://lorempixel.com/500/500/" /></a>
	<h3><a href="$Link">$Title</a></h3>
	$Content.Summary(10)
</li>--%>
<li class="card $FirstLast">
	<a href="$Link" class="profile-image">
		<div class="row">
			<% if $Image %>
			<div class="small-3 columns push-9">
				<img class="b-lazy" src="{$ThemeDir}/images/placeholder.jpg" data-src="http://lorempixel.com/300/300/" data-src-small="http://lorempixel.com/300/300/" />
			</div>
			<% end_if %>
			<div class="<% if $Image %>small-9 columns pull-3<% else %>large-12 columns<% end_if %>">
				<% if $isCertified %>
					<h4 class="tutor-name" href="$Link">$Title <p class="fa fa-star"></p></h4><p>$Content.Summary(20)
				<% else %>
					<h4 class="tutor-name" href="$Link">$Title</h4><p>$Content.Summary(20)
				<% end_if %>
				<%--<% loop $SplitKeywords.Sort('RAND').Limit(8) %>
					$Keyword<% if not $Last %>, <% end_if %>
				<% end_loop %>--%>
			</div>
		</div>
	</a>
</li>