

<div class="typography">
     
    <h2>$Title</h2>
 
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