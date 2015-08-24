<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand"href="{$baseUrl}"><img alt="Tutor Iowa Wordmark" src="{$ThemeDir}/images/logo.png" /></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

	<%-- Main Nav Section --%>
		<ul class="nav navbar-nav">
			<% loop Menu(1) %>
			<li class="<% if $LinkingMode == "current" || $LinkingMode == "section" %>active<% end_if %><% if $Children %>dropdown<% end_if %>">
				<a href="$Link" <% if $URLSegment == "feedback" %>data-reveal-id="{$URLSegment}-form-modal"<% end_if %> title="Go to the $Title.ATT">$MenuTitle</a>
				<% if $Children %>
				<ul class="dropdown-menu">
					<li><label>$MenuTitle</label></li>
					<% loop $Children %>
					<li class="<% if $LinkingMode == "current" || $LinkingMode == "section" %>active<% end_if %><% if $Children %> dropdown<% end_if %>">
						<a href="$Link" title="Go to the $Title.ATT">$MenuTitle</a>
						<% if $Children %>
						<ul class="dropdown-menu">
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

      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->



  </div><!-- /.container-fluid -->
</nav>

<%--

<nav class="top-bar" role="navigation" data-topbar>
	<ul class="title-area">
		<li class="name">

		</li>
		<li class="toggle-topbar menu-icon"><a href=""><span></span></a></li>
	</ul>
	<section class="top-bar-section">


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
			<% if $CurrentMember %>
			<li><a href="inbox" id="inbox-link" class="<% if $CurrentMember.unreadMessageCount > 0 %>unread-messages<% end_if %>">Inbox <% if $CurrentMember.unreadMessageCount > 0 %><span data-messagecount="$CurrentMember.allMessageCount" data-unreadcount="$CurrentMember.unreadMessageCount" class="inboxCount  ">({$CurrentMember.unreadMessageCount})</span><% end_if %></a></li>
			<li class="has-dropdown">
				<a href="edit-profile/" id="memberInfo" data-id="$CurrentMember.ID">$CurrentMember.FirstName</a>
				<ul class="dropdown">
					<li><a href="edit-profile/">Edit Profile</a></li>
				<% if $currentMemberPage %>
					
					<li><a href="$currentMemberPage.Link">View Profile</a></li>
				<% end_if %>
					
						
						<% if MemberHelpLabs %>
						<li><a href="personal-help-labs/">Edit Help Labs</a></li>
						<% end_if %>

					<% if $SiteAdmin %><li><a href="admin/">Admin</a></li><li><a href="stats-page/">Statistics</a></li><% end_if %>
					<li><a class="alert" href="Security/logout">Logout</a></li>
				</ul>
			</li>

			<% else %>
				<li class="log-in"><a href="Security/login?BackURL=%2Fadmin" data-reveal-id="login-form-modal">Log In</a></li>
				<li class="register"><a href="register">Become a Tutor</a></li>
			<% end_if %>
		</ul>
	</section>
</nav>

--%>