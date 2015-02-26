<div class="gradient">
	<div class="main typography" role="main">

		<div class="row" data-equalizer>
			<div class="large-8 columns content" >
				<div class="white-cover"></div>
				<article class="main-article">
					<div class="row">
						<div class="medium-3 columns"><h1>Inbox</h1></div>
						<div class="medium-9 columns">
							<div>
								<ul class="inbox-nav button-group">
									<li><button id="unread-messages" class="small button" >Unread</button></li>
									<li><button id="all-messages" class="small primary button" >All</button></li>
									<li><button id="unreplied-messages" class="small button" >Unreplied</button></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="medium-12 columns" id="main-content">
							
							<% if $CurrentMember.Messages %>
							<% loop $CurrentMember.Messages.Sort(Created).Reverse %>
								<div class="<% if $ReadDateTime %>read<% end_if %> <% if $RepliedDateTime %>replied<% end_if %> message" data-id="$ID" data-read="$ReadDateTime">
									<div>
										<section class="message-box">
											<div class="message-details"><span class="text-left"> $SenderName</span> <small class="right">$Created.NiceUS</small></div>
											<div class="message-body">
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

			<div class="large-4 columns end" >

				<aside id="memberInfo" class="side-nav" data-id="$CurrentMember.ID">
					<%-- <h2>$CurrentMember.Name, you have $CurrentMember.Messages.ReadDateTime.Count</h2> --%>
					<div id="messagePanel"></div>
					<% include Announcements %>
				</aside>
			</div>
		</div>
				

				
	</div>
</div>