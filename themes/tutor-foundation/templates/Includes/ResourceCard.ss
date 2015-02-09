<li>


<div class="row">
	<% if $Image %>
	<div class="small-3 columns push-9">
		<a href="$Link" class="resource-image">
		<class="b-lazy" src="{$ThemeDir}/images/placeholder.jpg" data-src="http://lorempixel.com/300/300/" data-src-small="http://lorempixel.com/300/300/"/> 
		
		
		</a>
	</div>
	<div class="small-9 columns pull-3">
		<h4><a href="$Link">$Title</a></h4>$Description.Summary(10)

	</div>
	<% else %>

	<div class="small-12">
		<h4><a href="$Link">$Title</a></h4>$Description.Summary(10)

	</div>
	<% end_if %>


</div>
</li>

