<%--Login Modal--%>
	<div id="feedback-form-modal" class="reveal-modal medium" data-reveal>
		<div class="row">
			
			<div class="large-12 columns">
				<% with Page("feedback") %>
					$Content
				<% end_with %>
				$FeedbackForm
			</div>
		</div>
		<a class="close-reveal-modal">&#215;</a>
	</div>
