
    <div class="main typography" role="main">
        
            <div class = "row">
                <div class = "large-8 columns">
                    <h1>Search Results</h1>
                    

                    <% if Query %>
                    <p>Your results for <strong>'{$Query}'</strong></p> 
                    
                        <% if Tutors %>
                            <ul class="tutor-card-list">
                                <% loop Tutors %>
                                     <% include TutorCard %>
                                <% end_loop %>
                            </ul>
                        <% end_if %><%-- end if Tutors --%>

                    <% else %>
                        <p>Please enter a search query.</p>
                    <% end_if %> <%-- end if Query --%> 
                </div>

                <div class = "large-4 columns">
                    <% if HelpLabs %>
                        <h2>Help Labs</h2>
                       <ul class="resource-card-list small">
                        <% loop HelpLabs %>
                           <% include ResourceCard %>
                        <% end_loop %><%-- end loop HelpLabs --%>
                       </ul>
                    <% end_if %><%-- end if HelpLabs --%>

                    <% if SupplementalInstructions %>
                         <h2>Supplemental Instructions</h2> 
                          <ul class="resource-card-list small">                   
                         <% loop SupplementalInstructions %>
                              <% include ResourceCard %>
                        <% end_loop %><%-- end loop SuppInstructions --%>  
                        </ul>     
                    <% end_if %><%-- end if SuppInstructions --%>
                </div>
            
        </div>  
    </div>            
