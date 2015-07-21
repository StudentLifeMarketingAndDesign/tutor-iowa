
<!--<div class="page-bg"></div>-->
<div class="gradient">

	<div class="main typography" role="main">
	
		<div class="row" data-equalizer>
			<div class="large-8 columns content" data-equalizer-watch>
				<div class="white-cover"></div>
				<div class="row">
					<article class="large-10 columns end">
						$Breadcrumbs
						
						<% if CurrentMember %>
						    <h1>$Title</h1>
						    <% if $Success %>
						   
						        <p class="savedMessage">You have successfully registered!  <br><br>
						        
						        You will become visible on the Tutor Iowa website after you receive your confirmation email. You must wait for a confirmation email to edit your profile.  </p>
						        
						    <% else_if $Enable %>
						    
						    	<p>We have sent a request to the administrator to enable your account.</p>
						         
						  	<% else %>
						       
						    <% end_if %>
						    
						     $ClearSession
						 <% else %>
						 	<p>You must be <a href='{$BaseHref}Security/login'>logged</a> in to edit your profile.  If you do not have an account, register <a href='{$BaseHref}registration-page'>here.</a></p>
						 <% end_if %>
					</article>
				</div>
			</div>
			<div class="large-4 columns end" data-equalizer-watch>
					<% include SideNav %>
			</div>
		
		</div>
	</div>
</div>