				<div class="board_content">
					<!--<div id="breadcrumbs"><a href="index_test.html">Home</a> > <a href="search_test.html">Find a Tutor</a> > <span class="current">Phil McTutor</span></div>-->
					<div id="page-content">
						<h1>$Title</h1>
						<% include SearchForm %>
						$Content
						
						<h2>About Supplemental Instruction:</h2>
						<ul>
							<% control Children %>
								<li><a href="$Link">$Title</a></li>
							<% end_control %>
						</ul>
						
					</div>
						
						<div class="clearfix"></div>
					
					</div>
					