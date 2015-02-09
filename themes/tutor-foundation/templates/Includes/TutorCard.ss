<%--<li>
	<a href="$Link" class="profile-image"><img src="http://lorempixel.com/500/500/" /></a>
	<h3><a href="$Link">$Title</a></h3>
	$Content.Summary(10)
</li>--%>
<li>
<a href="$Link" class="profile-image">
	<div class="row">
		<div class="small-3 columns push-9">
			
			<%--<img src="{$ThemeDir}/images/placeholder.jpg" /> --%>
			<img class="b-lazy" src="{$ThemeDir}/images/placeholder.jpg" data-src="http://lorempixel.com/300/300/" data-src-small="http://lorempixel.com/300/300/" />
			
			
		</div>
		<div class="small-9 columns pull-3">
			<h4 class="tutor-name" href="$Link">$Title</h4>$Content.Summary(10)

		</div>
	</div>
</a>
</li>