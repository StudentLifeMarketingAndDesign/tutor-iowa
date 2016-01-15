
<!--<div class="page-bg"></div>-->
<div class="gradient">

	<div class="main typography" role="main">
	
		<div class="row" data-equalizer>
			<div class="large-8 columns content" data-equalizer-watch>
				<div class="white-cover"></div>
				<div class="row">
					<article class="large-10 large-centered columns end">
						<% include Breadcrumbs %>
						<h1>$Title</h1>
						<% if $RegistrationForm.MessageFromSession %>
							<span class="message validation">$RegistrationForm.MessageFromSession</span>
						<% end_if %>
						<% if $ValidationErrorResponse %>
							<span class="message validation">$ValidationErrorResponse</span>
						<% end_if %>

						
						$Content
						<div class="panel">
							$RegistrationForm
						</div>
					</article>
				</div>
			</div>
			<div class="large-4 columns end" data-equalizer-watch>
					<% include SideNav %>
			</div>
		
		</div>
	</div>
</div>