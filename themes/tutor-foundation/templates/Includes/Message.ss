<article class="<% if $ReadDateTime %>read<% end_if %> <% if $RepliedDateTime %>replied<% end_if %> inbox-message" data-id="$ID" data-read="$ReadDateTime">
	<section class="message-box">
		<header class="message-details"><span class="text-left"> $SenderName <a href="mailto:{$SenderEmail}"><small>{$SenderEmail}</small></a></span> 
			<small class="right">
				<% if not $Created.isToday %>
					$Created.NiceUS
				<% else %>
					 Today
				<% end_if %>
				 <small>$Created.Format("g:i a")</small>
			</small>
		</header>
		<div class="message-body">
			<p> $MessageBody </p>
		</div>
	
		<ul class="button-group message-options">
			<li><button class="small mark-read" data-loaded >Mark as Read</a></button>
			<li><button class="button small mark-delete" data-loaded >Delete</a></li>
			<li><a href="mailto:$SenderEmail" class="button reply small" data-loaded>Reply Via Email</a></li>
		</ul>
	</section>
</article>