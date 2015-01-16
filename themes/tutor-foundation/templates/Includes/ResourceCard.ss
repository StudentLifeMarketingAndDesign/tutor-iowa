<li>


<div class="row">
	<% if $Image %>
	<div class="small-3 columns push-9">
		<a href="$Link" class="resource-image">
		<%--<img src="{$ThemeDir}/images/placeholder.jpg" /> --%>
		$Image
		
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

