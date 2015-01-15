<div class="gradient">
	<div class="main typography" role="main">
			
			<div class="row" data-equalizer>
				<div class="page-bg"></div>
				<div class="large-9 columns content" data-equalizer-watch>
					<div class="white-cover"></div>
					<article>
						<div class="row">
							<div class="medium-12 columns">
								<h1>Your Inbox</h1>
								<table role="grid">
									<thead>
										<tr>
											<th>From</th>
											<th>Date</th>
											<th>Message</th>
										</tr>
									</thead>
									<tbody id="inbox">
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
													$Top.ReplyForm
												</div>
											</div>
										</td>
									</tr>
									<% end_loop %>
									</tbody>
								</table>
								$Content
								$Form
							</div>
						</div>
					</article>
				</div>
				
				<div class="large-3 columns" data-equalizer-watch>
					<div class="row">
						<div class="medium-12 columns">
							<div class="row">
								<div class="medium-12 columns">
									<aside id="memberInfo" data-id="$CurrentMember.ID">
										<h2>$CurrentMember.Name, you have $CurrentMember.Messages.ReadDateTime.Count</h2>
										<div id="messagePanel"></div>
									</aside>
								</div>
							</div>
						</div>
				
					<%-- include TutorSideNav --%>
				</div>
			
			</div>
	
	</div>
</div>