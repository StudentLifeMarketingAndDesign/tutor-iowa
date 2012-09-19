<div class="board_content">
<div id="page-content">

<% if CurrentMember %>	
	<% if Saved %>
		Your account will be disabled by our administrator as soon as possible.
	<% else_if notPublished %>
		You don't have a Tutor page on TutorIowa to disable.  If you have not yet registered, click here to register.  If you have registered and not received a confirmation email yet, please wait for that email to arrive.
	<% else %>
		Selecting the disable account option will send a request to our administrator to remove you from the Tutor Iowa site.  To be approved again, you will have to send an email requesting that your account be restored.  Restoration can take up to 72 hours. <br><br>
	
		Are you sure you want to disable your account? <br>
		
		$DisableForm<br>
	<% end_if %>
<% else %>
	You must be <a href='/security/login'>logged in</a> to request to disable your tutor page. 
<% end_if %>

	
</div>
</div>


	