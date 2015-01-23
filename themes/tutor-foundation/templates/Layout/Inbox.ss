<div class="gradient">
	<div class="main typography" role="main">

		<div class="row" data-equalizer>
			<div class="page-bg"></div>
			<div class="large-8 columns content" data-equalizer-watch>
				<div class="white-cover"></div>
				<article class="main-article">
					<div class="row">
						<div class="medium-12 columns" id="main-content">
							<h1>Your Inbox</h1>
							<% if $CurrentMember.Messages %>
							<div>
								<ul class="inbox-nav button-group">
									<li><button id="unread-messages" class="small button" >Unread</button></li>
									<li><button id="all-messages" class="small primary button" >All</button></li>
									<li><button id="unreplied-messages" class="small button" >Unreplied</button></li>
								</ul>
							</div>
							<% loop $CurrentMember.Messages.Sort(Created).Reverse %>
								<div class="<% if $ReadDateTime %>read<% end_if %> <% if $RepliedDateTime %>replied<% end_if %> message row" data-id="$ID" data-read="$ReadDateTime">
									<div class="small-12 columns">
										<section class="message-box">
											<div class="message-details"><span class="text-left"> $SenderName</span> <small class="right">$Created.NiceUS</small></div>
											<div class="message-summary">									
												<p class="truncate"> $MessageBody.FirstSentence</p>
											</div>
											<div class="message-body" style="display: none;">
												<p> $MessageBody </p>
											</div>
										

										</section>
									</div>
								</div>
							<% end_loop %>
							<% else %>
								<div class="panel callout radius">
									<h3> You don't have any messages yet. </h3>
								</div>

							<% end_if %>
							$Content
							$Form
						</div>
					</div>
				</article>
			</div>

			<div class="large-4 columns end" data-equalizer-watch>

				<aside id="memberInfo" class="side-nav" data-id="$CurrentMember.ID">
					<%-- <h2>$CurrentMember.Name, you have $CurrentMember.Messages.ReadDateTime.Count</h2> --%>
					<div id="messagePanel"></div>
					<% include Announcements %>
				</aside>
			</div>
		</div>
				

				
	</div>
</div>