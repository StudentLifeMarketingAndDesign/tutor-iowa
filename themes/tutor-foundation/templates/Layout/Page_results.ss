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
    <div class = "large-6 columns">
      <% if HelpLabs %>
      <h2>Help Labs</h2>
      <ul class="resource-card-list large">
        <% loop HelpLabs %>
        <% include ResourceCard %>
        <% end_loop %><%-- end loop HelpLabs --%>
      </ul>
      <% end_if %><%-- end if HelpLabs --%>
    </div>
    <div class = "large-6 columns">
      <% if SupplementalInstructions %>
      <h2>Supplemental Instructions</h2>
      <ul class="resource-card-list large">
        <% loop SupplementalInstructions %>
        <% include ResourceCard %>
        <% end_loop %><%-- end loop SuppInstructions --%>
      </ul>
      <% end_if %><%-- end if SuppInstructions --%>
    </div>
  </div>

  <div class = "row">
    <div class = "large-12 columns">
      <% if Tutors %>
      <hr />
      <h2>Tutors</h2>
      <ul class="tutor-card-list">
        <% loop Tutors %>
        <% include TutorCard %>
        <% end_loop %>
      </ul>
      <% end_if %><%-- end if Tutors --%>
    </div>
    
  </div>
</div>