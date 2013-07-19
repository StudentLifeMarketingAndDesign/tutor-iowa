				<div class="board_content">
					<!--<div id="breadcrumbs"><a href="index_test.html">Home</a> > <a href="search_test.html">Find a Tutor</a> > <span class="current">Phil McTutor</span></div>-->
					<div id="page-content">
						<h1>$Title</h1>
						<% include SearchForm %>
						$Content
						<% if Children %>
						
						<h2>Currently available supplemental instructions :</h2>
						<ul>
							<% loop Children %>
								<li><a href="$Link">$Title</a></li>
							<% end_loop %>
						</ul>
						<% end_if %>
					</div>
						
						<div class="clearfix"></div>
					
					</div>
					