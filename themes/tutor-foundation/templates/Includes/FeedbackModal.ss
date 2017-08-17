<%--Login Modal--%>
	<div id="feedback-form-modal" class="reveal-modal medium" data-reveal>
		<div class="row">
			
			<div class="large-12 columns">
				<% with Page("feedback") %>
					$Content
				<% end_with %>
				<% if $CurrentMember %>
					$FeedbackForm
				<% else %>
					<a href="$Link("hawkcheck")" class="button button--hawkid">Log in with your HawkID to give feedback</a>
				<% end_if %>
			
				
			</div>
		</div>
		<a class="close-reveal-modal">&#215;</a>
	</div>
