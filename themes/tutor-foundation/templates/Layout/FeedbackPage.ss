<div class="gradient">
<div class="main typography" role="main">
	<div class="row" data-equalizer>
		<div class="large-8 columns" data-equalizer-watch>
			<div class="white-cover"></div>
			<div class="row">
				<article class="large-10 columns">
				$Breadcrumbs
					<% if $Saved %>
						<script type="text/javascript">
					    	$('<p class="savedMessage">Your feedback has been submitted! </p>').insertBefore('#Name');
					    </script>
					<% end_if %>
					$ClearSession
					<h1>$Title</h1>
					$Content
				<% if $CurrentMember %>
					$FeedbackForm
				<% else %>
					<a href="$Link("hawkcheck")" class="button button--hawkid">Log in with your HawkID to give feedback</a>
				<% end_if %>
				</article>
			</div>
		</div>
		<div class="large-4 columns end" data-equalizer-watch>
				<% include SideNav %>
		</div>
	
	</div>
</div>
</div>
