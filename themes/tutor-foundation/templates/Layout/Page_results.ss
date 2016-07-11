<div class="main typography" role="main">
  <div class="row">
        <div class="large-8 large-centered columns">
          <% include BreadcrumbsSearch %>
          <h1>Search Tutor Iowa</h1>
          <% include FindHelpSearch %>
        </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
          <% if Query %>
          <p>Your search results for <strong>{$Query}</strong>:</p>
          <% else %> 
            <% with Page("find-help") %>
              $Content
            <% end_with %>
          <% end_if %> <%-- end if Query --%>
          <% if $Query && not $HasResults %>
            <p>No results for this search term were found.</p>
          <% end_if %>
    </div>
    <hr />
  </div>

  <div class="row">
    <% if HelpLabs %>
      <div class = "<% if $SupplementalInstructions %>large-6<% else %>large-12<% end_if %> columns">
        <h2 class="banner">Help Labs</h2>
        <ul class="resource-card-list large">
          <% loop HelpLabs %>
          <% include ResourceCard %>
          <% end_loop %><%-- end loop HelpLabs --%>
        </ul>
      </div>
    <% end_if %><%-- end if HelpLabs --%>
    <% if SupplementalInstructions %>
    <div class = "<% if $HelpLabs %>large-6<% else %>large-12<% end_if %> columns">
      <h2 class="banner">Supplemental Instruction</h2>
      <ul class="resource-card-list large">
        <% loop SupplementalInstructions %>
        <% include ResourceCard %>
        <% end_loop %><%-- end loop SuppInstructions --%>
      </ul>
      
    </div>
  <% end_if %><%-- end if SuppInstructions --%>
  </div>
  <div class="row">
    <div class="large-12 columns">
      <% if Tutors %>
      <h2 class="banner">Tutors</h2>
      <ul class="tutor-card-list">
        <% loop Tutors %>
        <% include TutorCard %>
        <% end_loop %>
      </ul>
      <% end_if %><%-- end if Tutors --%>
    </div>

  </div>
</div>