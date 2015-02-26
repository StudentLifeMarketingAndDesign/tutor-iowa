<nav class="top-bar" role="navigation" data-topbar>
	<ul class="title-area">
		<li>
			<div class="row">
				<div class="large-12 columns">
					<h1><a href="{$baseUrl}"><img src="{$ThemeDir}/images/logo.png" /></a></h1>
				</div>
			</div>
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
			<% if not $Last %><li class="divider"></li><% end_if %>
			<% end_loop %>
			<% if $CurrentMember %>
			<li><a href="inbox">Inbox <% if $CurrentMember.unreadMessageCount > 0 %>({$CurrentMember.unreadMessageCount})<% end_if %></a></li>
			<li class="has-dropdown">
				<a href="$currentMemberPage.Link">$CurrentMember.FirstName</a>
				<ul class="dropdown">
					
					<li><a href="edit-profile/">Edit Profile</a></li>
					<% if $SiteAdmin %><li><a href="admin/">Admin</a></li><% end_if %>
					<li><a class="alert" href="Security/logout">Logout</a></li>
				</ul>
			</li>

			<% else %>
				<li class="has-form"><a href="Security/login?BackURL=%2Fadmin" data-reveal-id="login-form-modal" class="button radius">Login</a></li>
				<li><a href="Security/login?BackURL=%2Fadmin" class="button radius">Register as a Tutor</a></li>
			<% end_if %>
		</ul>
	</section>
</nav>
