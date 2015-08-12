<div class="gradient">
<div class="main container typography" role="main">
	<div class="row" data-equalizer>
		<div class="col-lg-8 " data-equalizer-watch>
			<div class="white-cover"></div>
			<div class="row">
				<article class="col-lg-10 ">
				$Breadcrumbs
					<% if $Saved %>
						<script type="text/javascript">
					    	$('<p class="savedMessage">Your feedback has been submitted! </p>').insertBefore('#Name');
					    </script>
					<% end_if %>
					$ClearSession
					<h1>$Title</h1>
					$Content
					$FeedbackForm
				</article>
			</div>
		</div>
		<div class="col-lg-4  end" data-equalizer-watch>
				<% include SideNav %>
		</div>
	
	</div>
</div>
</div>
