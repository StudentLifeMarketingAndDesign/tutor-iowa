				<div class="board_content">
					<!--<div id="breadcrumbs"><a href="index_test.html">Home</a> > <a href="search_test.html">Find a Tutor</a> > <span class="current">Phil McTutor</span></div>-->
					<div id="page-content">
						<h1>$Title</h1>
						<% include SearchForm %>
						$Content
						<ul class="help-labs">
						
						<% control ChildrenOf(help-labs) %>
						<li>
						  	
						<h2><a href="$Link" target="_blank">$Name</a></h2>
						<p>$Location</p>
						    <% if PhoneNo %>
								<p>$PhoneNo</p>
							<% end_if %>
							<!--
							<% if ExtrnlLink %>
							<p><a href="$ExtrnlLink" class="external-link">visit website</a></p>
							<% end_if %>-->
						</li>
						<% end_control %>
						
					</div>
						
						<div class="clearfix"></div>
					
					</div>
					