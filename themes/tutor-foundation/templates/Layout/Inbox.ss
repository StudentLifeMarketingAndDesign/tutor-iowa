<div class="gradient">
	<div class="main typography" role="main">

		<div class="row" data-equalizer>
			<div class="large-8 columns content" >
				<div class="white-cover"></div>
				<article class="main-article">
					<div class="row inbox-nav">
						<div class="medium-3 columns show-for-medium-up">
							<span class="button inbox-head small all-messages">
								<% if $CurrentMember.unreadMessageCount > 0 %> 
									<strong>Inbox</strong> <span class="inboxCount" data-unreadcount="$CurrentMember.unreadMessageCount">({$CurrentMember.unreadMessageCount})</span>
								<% else %>
									Inbox
								<% end_if %>
							</span>
						</div>
						<div class="small-12 medium-9 columns">
							<div>
								<ul class="button-group">
									<li><button class="unread-messages small button" >Unread</button></li>
									<li><button class="all-messages small primary button" >All</button></li>
									<li><button class="unreplied-messages small button" >Unreplied</button></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="medium-12" id="main-content">

							<div class='panel callout noUnread'>No unread messages here!</div>

							<% if $CurrentMember.Messages %>
							<% loop $CurrentMember.Messages.Sort(Created).Reverse.Limit(5) %>
								<div class="<% if $ReadDateTime %>read<% end_if %> <% if $RepliedDateTime %>replied<% end_if %> message" data-id="$ID" data-read="$ReadDateTime">
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
							<% end_loop %>
							<% else %>
								<div class="panel callout radius">
									<h3>You don't have any messages yet.</h3>
								</div>
							<% end_if %>
							<%--
							<div class="no-unread-messages">
								<p>You have no unread messages.</p>
							</div>
							--%>
							$Content
							$Form
						</div>
					</div>
				</article>
			</div>

			<div class="large-4 columns end" >

				<aside class="side-nav">
					<%-- <h2>$CurrentMember.Name, you have $CurrentMember.Messages.ReadDateTime.Count</h2> --%>
					<div id="messagePanel"></div>
					<% include Announcements %>
				</aside>
			</div>
		</div>
				

				
	</div>
</div>