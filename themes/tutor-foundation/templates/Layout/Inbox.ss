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
									<strong>Inbox</strong> <span class="inboxCount" data-messagecount="$CurrentMember.allMessageCount" data-unreadcount="$CurrentMember.unreadMessageCount">({$CurrentMember.unreadMessageCount})</span>
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

							<%-- this panel shows if script doesn't find any unread messages if .unread is clicked --%>
							<div class='panel callout noUnread'>No unread messages here!</div>
							<div id="unreadInbox"></div>
							<% if $CurrentMember.Messages %>

								<% loop paginatedMessages %>
										<%-- NOTE: paginatedMessages filters out messages MarkedAsDeleted --%>
										<% include Message %>
								<% end_loop %>
							
								<% if $paginatedMessages.NotLastPage %>
									<a hidden class="next right moreMessages" href="$paginatedMessages.NextLink">Next</a>
								<% end_if %>

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
							<% if $SiteAdmin %>
								<h2> Hello Admin </h2>
								<h3>Pending Profile Image </h3>
								<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-4">
									<% loop $pendingProfileImages %>
										<% include PendingImageCard %>
									<% end_loop %>
								</ul>
								<h3>Pending Cover Images </h3>
								<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-4">
									<% loop $pendingCoverImages %>
										<% include PendingImageCard %>
									<% end_loop %>
								</ul>
							<% end_if %>

						</div>
					</div>
				</article>
			</div>

			<div class="large-4 columns end" >

				<aside class="side-nav">
					<%-- <h2>$CurrentMember.Name, you have $CurrentMember.Messages.ReadDateTime.Count</h2> --%>
					<div id="messagePanel"></div>
					<% include AnnouncementCardList %>
				</aside>
			</div>
		</div>
				

				
	</div>
</div>