<div class="<% if $ReadDateTime %>read<% end_if %> <% if $RepliedDateTime %>replied<% end_if %> inbox-message" data-id="$ID" data-read="$ReadDateTime">
	<div>
		<section class="message-box">
			<div class="message-details"><span class="text-left"> $SenderName <a href="mailto:{$SenderEmail}"><small>{$SenderEmail}</small></a></span> 
				<small class="right">
					<% if not $Created.isToday %>
						$Created.NiceUS
					<% else %>
						 Today
					<% end_if %>
					 <small>$Created.Format("g:i a")</small>
				</small>
			</div>
			<div class="message-body">
				<p> $MessageBody </p>
			</div>
		
			<ul class="button-group message-options">
				<li><button class="small mark-read">Mark as Read</a></button>
				<li><button class="button small">Delete</a></li>
				<li><a href="mailto:$SenderEmail" class="button reply small">Reply Via Email</a></li>
			</ul>
		</section>
	</div>
</div>