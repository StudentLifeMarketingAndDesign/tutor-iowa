
<!--<div class="page-bg"></div>-->
<div class="gradient">

	<div class="main typography" role="main">
	
		<div class="row" data-equalizer>
			<div class="large-8 columns content" data-equalizer-watch>
				<div class="white-cover"></div>
				<div class="row">
					<article class="large-10 columns end">
						$Breadcrumbs
						<h1>$Title</h1>
						$Content
						<% loop HelpLabs %>
							<a href="$Link" target="_blank">$Name</a>:   <a href="{$Link}Edit" >Edit</a> / <a href="$Link" target="_blank">View</a> <br>
						<% end_loop %>
					</article>
				</div>
			</div>
			<div class="large-4 columns end" data-equalizer-watch>
					<% include SideNav %>
			</div>
		
		</div>
	</div>
</div>