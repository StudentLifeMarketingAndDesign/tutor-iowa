				<div class="board_content">
					<!--<div id="breadcrumbs"><a href="index_test.html">Home</a> > <a href="search_test.html">Find a Tutor</a> > <span class="current">Phil McTutor</span></div>-->
					<div id="page-content">
						<div id="breadcrumbs"><a href="{$BaseHref}">Home</a> > <a href="$currentMemberPage.Link">Your profile</a> > <span class="current">Edit your profile</span></div>
					
					     
					    <h1>$Title</h1>
					 
					    <% if Success %>
					     
					        <p class="savedMessage">You have successfully registered!  <br><br>
					        
					        You will become visible on the Tutor Iowa website after you receive your confirmation email. You must wait for a confirmation email to edit your profile.  </p>
					        
					    <% else_if Enable %>
					    
					    	We have sent a request to the administrator to enable your account.
					         
					     
					    <% else %>
					     
					        <% if Saved %>
					             
					            <p class="savedMessage">Your profile has been saved!</p>
					         
					        <% end_if %>  
					         
					        $EditProfileForm
					     
					    <% end_if %>
					 
					</div>
					<div class="clearfix"></div>
					
</div>
					