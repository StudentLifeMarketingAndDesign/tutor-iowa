<div class="main typography" role="main">
  <div class="row">
    <div class="large-12 columns">
      <h1>Search Results</h1>
      <% if Query %>
      <p>Your results for <strong>'{$Query}'</strong></p>
      <% else %>
      <p>Please enter a search term.</p>
      <% end_if %> <%-- end if Query --%>
    </div>
  </div>
  <div class="row">
    <% if HelpLabs %>
      <div class = "large-6 columns">
        <h2>Help Labs</h2>
        <ul class="resource-card-list large">
          <% loop HelpLabs %>
          <% include ResourceCard %>
          <% end_loop %><%-- end loop HelpLabs --%>
        </ul>
      </div>
    <% end_if %><%-- end if HelpLabs --%>
    <% if SupplementalInstructions %>
    <div class = "large-6 columns">
      <h2>Supplemental Instruction</h2>
      <ul class="resource-card-list large">
        <% loop SupplementalInstructions %>
        <% include ResourceCard %>
        <% end_loop %><%-- end loop SuppInstructions --%>
      </ul>
      
    </div>
  </div>
  <% end_if %><%-- end if SuppInstructions --%>

  <div class = "row">
    <div class = "large-12 columns">
      <% if Tutors %>
      <h2>Tutors</h2>
      <ul class="tutor-card-list large">
        <% loop Tutors %>
        <% include TutorCard %>
        <% end_loop %>
      </ul>
      <% end_if %><%-- end if Tutors --%>
    </div>
    
  </div>
</div>