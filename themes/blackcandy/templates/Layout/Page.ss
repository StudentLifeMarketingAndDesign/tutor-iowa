<div class="typography">
	Rendered with Page.ss in Layout
	<% if Menu(2) %>
		<% include SideBar %>
		<div id="Content">
	<% end_if %>
			
	<% if Level(2) %>
	  	<% include BreadCrumbs %>
	<% end_if %>
	
		<h2>$Title</h2>
	
		$Content
		$Form
		 <% if CurrentMember %>
		 
		 <% else %>
		 	<a href="/registration-page" title="Register">Register</a>
		 <% end_if %>
		$PageComments
	<% if Menu(2) %>
		</div>
	<% end_if %>
</div>

	
	
	