<%--Login Modal--%>
<div id="login-form-modal" class="reveal-modal large" data-reveal>
	<div class="row">
		<div class="<% if $SiteConfig.LoginContent %>large-6<% else %>large-12<% end_if %> columns">
			<h2>Login</h2>
			<p>Not registered yet? <a href="tutor-application">Learn more about becoming a tutor.</a></p>
			$LoginForm
		</div>
		<% if $SiteConfig.LoginContent %>
			<div class="large-6 columns">
				$SiteConfig.LoginContent
			</div>
		<% end_if %>
	</div>
	<a class="close-reveal-modal">&#215;</a>
</div>