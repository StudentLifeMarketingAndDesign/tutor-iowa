<!--Not in use-->

<div class="board_content">
<div id="page-content">
<div id="breadcrumbs"><a href="{$BaseHref}">Home</a> > <a href="$getHelpLab.Link">Your help labs</a> > <span class="current">Edit help lab profile</span></div>
<div class="typography">
     
    <h2>Help Lab Edit Profile Page</h2>
    <p><a href="$Lab.Link" target="_blank">View the Help Lab</a></p>
 
  <% if Saved %>
             
       <p class="savedMessage">The help lab profile has been saved!</p>
         
  <% end_if %>  
         
   $HelpEditProfileForm
   <br><br>  
</div>
</div>    
</div>