				<div class="board_content">
					<!--<div id="breadcrumbs"><a href="index_test.html">Home</a> > <a href="search_test.html">Find a Tutor</a> > <span class="current">Phil McTutor</span></div>-->
					<div id="page-content">
						
						<% if CurrentMember %>
							<div id="breadcrumbs"><a href="{$BaseHref}">Home</a> > <a href="$currentMemberPage.Link">Your profile</a> > <span class="current">Edit your profile</span></div>
						
						    
						     
						    <h1>$Title</h1>
						 
						    <% if $Success %>
						     
						        <p class="savedMessage">You have successfully registered!  <br><br>
						        
						        You will become visible on the Tutor Iowa website after you receive your confirmation email. You must wait for a confirmation email to edit your profile.  </p>
						        
						    <% else_if $Enable %>
						    
						    	We have sent a request to the administrator to enable your account.
						         
						     
						    <% else %>
						    
						    	 $EditProfileForm
						     
						        <% if $Saved %>
						          <script type="text/javascript">
						             $('<p class="savedMessage">Your profile has been saved! </p>').insertBefore('#FirstName');
						           </script>

						         <% else_if $notSaved %>
						            <script type="text/javascript">
							            
							            $('<span class="message validation">There was an error with your changes (see below). </span>').insertBefore('#FirstName');
							          
						            </script>


						           
						            <!--<span class="message validation">There was an error with your changes (see below). </span>-->
						         
						        <% end_if %>  
						         
						  
						       
						    <% end_if %>
						    
						     $ClearSession
						 <% else %>
						 	You must be <a href='{$BaseHref}Security/login'>logged</a> in to edit your profile.  If you do not have an account, register <a href='{$BaseHref}registration-page'>here.</a>
						 <% end_if %>
					 
					</div>
					<div class="clearfix"></div>
					
					
					
</div>
					
  
							           
							        