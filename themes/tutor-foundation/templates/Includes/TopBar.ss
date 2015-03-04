<nav class="top-bar" role="navigation" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><a href="{$baseUrl}"><img alt="Tutor Iowa Wordmark" src="{$ThemeDir}/images/logo.png" /></a></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href=""><span></span></a></li>
	</ul>
	<section class="top-bar-section">

		<%-- Main Nav Section --%>
		<ul class="right">
			<% loop Menu(1) %>
			<li class="<% if $LinkingMode == "current" || $LinkingMode == "section" %>active<% end_if %><% if $Children %> has-dropdown<% end_if %>">
				<a href="$Link" title="Go to the $Title.ATT">$MenuTitle</a>
				<% if $Children %>
				<ul class="dropdown">
					<li><label>$MenuTitle</label></li>
					<% loop $Children %>
					<li class="<% if $LinkingMode == "current" || $LinkingMode == "section" %>active<% end_if %><% if $Children %> has-dropdown<% end_if %>">
						<a href="$Link" title="Go to the $Title.ATT">$MenuTitle</a>
						<% if $Children %>
						<ul class="dropdown">
							<% loop $Children %>
							<li class="<% if $LinkingMode == "current" || $LinkingMode == "section" %>active<% end_if %>"><a href="$Link" title="Go to the $Title.ATT">$MenuTitle</a></li>
							<% end_loop %>
						</ul>
						<% end_if %>
					</li>
					<% end_loop %>
					<li><a href="$Link">See all &rarr;</a></li>
				</ul>
				<% end_if %>
			</li>
			<% end_loop %>
			<% if $CurrentMember %>
			
			<li class="has-dropdown">
				<a href="$CurrentMemberPage.Link" id="memberInfo" data-id="$CurrentMember.ID">$CurrentMember.FirstName</a>
				<ul class="dropdown">
					<li><a href="$CurrentMember.Link()">View Profile</a></li>
					<li><a href="edit-profile/">Edit Profile</a></li>
					<% if $SiteAdmin %><li><a href="admin/">Admin</a></li><% end_if %>
					<li><a class="alert" href="Security/logout">Logout</a></li>
				</ul>
			</li>
			<li><a href="inbox">Inbox <% if $CurrentMember.unreadMessageCount > 0 %><span data-messagecount="$CurrentMember.allMessageCount" data-unreadcount="$CurrentMember.unreadMessageCount" class="inboxCount">({$CurrentMember.unreadMessageCount})</span><% end_if %></a></li>
			<% else %>
				<li class="has-form"><a href="Security/login?BackURL=%2Fadmin" data-reveal-id="login-form-modal" class="button radius success">Login</a></li>
				<li class="has-form"><a href="Security/login?BackURL=%2Fadmin" class="button radius">Register as a Tutor</a></li>
			<% end_if %>
		</ul>
	</section>
</nav>
