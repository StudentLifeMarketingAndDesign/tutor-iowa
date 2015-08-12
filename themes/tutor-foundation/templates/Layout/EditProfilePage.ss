
<!--<div class="page-bg"></div>-->
<div class="gradient">

	<div class="main typography" role="main">
	
		<div class="row" data-equalizer>
			<div class="col-lg-8  content" data-equalizer-watch>
				<div class="white-cover"></div>
				<div class="row">
					<article class="col-lg-10  end">
						$Breadcrumbs
						
						<% if CurrentMember %>
						    <h1>$Title</h1>
						    <% if $Success %>
						   
						        <p class="savedMessage">You have successfully registered!  <br><br>
						        
						        You will become visible on the Tutor Iowa website after you receive your confirmation email. You must wait for a confirmation email to edit your profile.  </p>
						        
						    <% else_if $Enable %>
						    
						    	<p>We have sent a request to the administrator to enable your account.</p>
						         
						  	<% else %>

						  		<p>You're logged in but your profile is currently inactive.</p>
						  		<p>This might be because:</p>
						  		<ul>
						  			<li>You've just signed up and haven't been through the Tutor Iowa orientation process yet.</li>
						  			<li>It's the beginning of a new semester and we haven't activated all profiles yet.</li>
						  			<li>You've requested your account to be disabled.</li>
						  		</ul>


						  		<p>If you feel this is an error and would like your profile activated, please let us know by emailing <a href="mailto:tutoriowa@uiowa.edu">tutoriowa@uiowa.edu</a>. Please include your full name.</p>
						       
						    <% end_if %>
						    
						     $ClearSession
						 <% else %>
						 	<p>You must be <a href='{$BaseHref}Security/login'>logged</a> in to edit your profile.  If you do not have an account, register <a href='{$BaseHref}registration-page'>here.</a></p>
						 <% end_if %>
					</article>
				</div>
			</div>
			<div class="col-lg-4  end" data-equalizer-watch>
					<% include SideNav %>
			</div>
		
		</div>
	</div>
</div>