				<div class="board_content">
					<!--<div id="breadcrumbs"><a href="index_test.html">Home</a> > <a href="search_test.html">Find a Tutor</a> > <span class="current">Phil McTutor</span></div>-->
					<div id="page-content">
						<h1>$Title</h1>
						<% include SearchForm %>
						<ul>
						
						<% control ChildrenOf(help-labs) %>
						  	<% if ExtrnlLink %>
								<li><a href="{$ExtrnlLink}">$Name</a>
							<% else %>
								<li>$Name
							<% end_if %>
							<li>$Location
						    <% if PhoneNo %>
								<li>$PhoneNo
							<% end_if %>
							<br><br>
						<% end_control %>
						
					</div>
						
						<div class="clearfix"></div>
					
					</div>
					