<nav class="top-bar" role="navigation" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><a href="{$baseURL}"><img alt="Tutor Iowa Logo" src="{$ThemeDir}/images/logo.png" /></a></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href=""><span></span></a></li>
	</ul>
	<section class="top-bar-section">

		<%-- Main Nav Section --%>
		<ul class="left">
			<% loop Menu(1) %>
			<li class="<% if $LinkingMode == "current" || $LinkingMode == "section" %>active<% end_if %><% if $Children %> has-dropdown<% end_if %>">
				<a href="$Link" <% if $URLSegment == "feedback" %>data-reveal-id="{$URLSegment}-form-modal"<% end_if %> title="Go to the $Title.ATT">$MenuTitle</a>
				<% if $Children %>
				<ul class="dropdown">
					<li><label>$MenuTitle</label></li>
					<% loop $Children %>
					<li class="<% if $LinkingMode == "current" || $LinkingMode == "section" %>active<% end_if %><% if $Children %> has-dropdown<% end_if %>">
						<a href="$Link" title="Go to the $Title.ATT">$MenuTitle</a>
						<% if $Children %>
						<ul class="dropdown">
							<% loop $RandomChildren.Limit(5) %>
							<li class="<% if $LinkingMode == "current" || $LinkingMode == "section" %>active<% end_if %>"><a href="$Link" title="Go to the $Title.ATT">$MenuTitle.LimitCharacters(25)</a></li>
							<% end_loop %>
							<li><a href="$Link">See all &rarr;</a></li>
						</ul>
						<% end_if %>
					</li>
					<% end_loop %>
					<li><a href="$Link">See all &rarr;</a></li>
				</ul>
				<% end_if %>
			</li>
			<% end_loop %>
		</ul>
		<ul class="right">
			<% if $CurrentMember %> <%-- if logged in with hawkID --%>
				<% if $currentMemberPage %> <%-- if has a tutor page --%>
					<li><a href="inbox" id="inbox-link" title="Messages" class="<% if $CurrentMember.unreadMessageCount > 0 %>unread-messages<% end_if %>">
					<i class="fa fa-comments fa-lg" aria-hidden="true"></i><% if $CurrentMember.unreadMessageCount > 0 %><span data-messagecount="$CurrentMember.allMessageCount" data-unreadcount="$CurrentMember.unreadMessageCount" class="inboxCount  ">({$CurrentMember.unreadMessageCount})</span><% end_if %></a></li>
				<% else %> <%-- if does not have a tutor page in Stage or Live (i.e. is not a tutor at all) --%>
					<% if not $currentMemberPage %>
					<li class="register"><a href="register">Become a Tutor</a></li>
					<% end_if %>
				<% end_if %>

					<li class="has-dropdown">
						<a href="edit-profile/" id="memberInfo" title="User Profile" data-id="$CurrentMember.ID"><i class="fa fa-user fa-lg" aria-hidden="true"></i></a>
						<ul class="dropdown">
							<li><a href="edit-profile/">Edit Profile</a></li>
							<% if $approvedTutor %><li><a href="$approvedTutor.Link">View Profile</a></li><% end_if %>
							<li><a class="alert" href="$LogoutLink">Logout</a></li>
						</ul>
					</li>

				<% if $SiteAdmin || $MemberHelpLabs %>
					<li class="has-dropdown">
					<a href="admin/">Admin</a>
						<ul class="dropdown">
						<% if $SiteAdmin %>
							<li><a href="stats-page/">Statistics</a></li>
							<li><a href="admin/">SilverStripe</a></li>
						<% end_if %>
						<% if MemberHelpLabs %>
							<li><a href="personal-help-labs/">Help Labs</a></li>
						<% end_if %>
						</ul>
					</li>
					

				<% end_if %>
					
	
			<% else %> <%-- if not logged in with hawkID --%>
				<li class="log-in"><a href="Security/login">Log In</a></li>
				<li class="register"><a href="register">Become a Tutor</a></li>
			<% end_if %>
		</ul>
	</section>
</nav>