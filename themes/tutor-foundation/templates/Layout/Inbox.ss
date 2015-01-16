<div class="gradient">
	<div class="main typography" role="main">

		<div class="row" data-equalizer>
			<div class="page-bg"></div>
			<div class="large-12 columns content" data-equalizer-watch>
				<div class="white-cover"></div>
				<article class="main-article">
					<div class="row">
						<div class="medium-12 columns" id="main-content">
							<h1>Your Inbox</h1>
							<div class="inbox-nav">
								<ul class="inline-list">
									<li>Unread</li>
									<li>All</li>
									<li>Unreplied</li>
								</ul>
							</div>
							<% loop $CurrentMember.Messages.Sort(Created).Reverse %>
								<div class="message <% if $ReadDateTime %> read <% end_if %> row">
									<div class="small-12 columns">
										<section class="message-box truncate">
											<div style="margin-bottom: .5em;"><span class="text-left"> $SenderName</span> <small class="right">$Created.NiceUS</small> </div>
											<div><p class="truncate"> $MessageBody </p></div>
										</section>
									</div>
								</div>

							<% end_loop %>




							<%--
							<table role="grid" id="inbox">
								<thead>
									<tr>
										<th>From</th>
										<th>Date</th>
										<th>Message</th>
									</tr>
								</thead>
								<tbody >
								<% loop $CurrentMember.Messages %>
								<tr class="message <% if not $ReadDateTime %>not-read<% end_if %>" data-id="$ID" data-read="$ReadDateTime">
									<td class="message-info">
										<p>$SenderName at $SenderEmail</p>
									</td>
									<td>
										<p><time>$Created.NiceUS</time></p>
									</td>
									<td >
										<div class="message-body">
											<p>$MessageBody</p>
											<div class="reply-form hide">
												$Top.ReplyForm($ID)
											</div>
										</div>
									</td>
								</tr>
								<% end_loop %>
								</tbody>
							</table>
							--%>
							$Content
							$Form
						</div>
					</div>
				</article>
			</div>
		</div>
				<%--
				<div class="large-4 columns end" data-equalizer-watch>

							<aside id="memberInfo" class="side-nav" data-id="$CurrentMember.ID">
								<h2>$CurrentMember.Name, you have $CurrentMember.Messages.ReadDateTime.Count</h2>
								<div id="messagePanel"></div>
								<% include Announcements %>
							</aside>
				</div>
				--%>
	</div>
</div>