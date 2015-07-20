<% with $RelatedResources %>
    <% if $HelpLabs || $SupplementalInstructions %><p><% end_if %>
    <% if $HelpLabs %>
    <h3 class="banner"><span>Related Help Labs</span></h3> 
        <ul class="side-nav">
        <% loop HelpLabs.Limit(5).Sort('Title ASC') %>
            <li><a href="$Link">$Title</a></li>
        <% end_loop %>
        </ul>
        <p><a href="help-labs/">Learn more about help labs on campus &rarr;</a></p>
    <% end_if %>
    <% if $SupplementalInstructions %>
    <h3 class="banner"><span>Related Supplemental Instruction</span></h3> 
        <ul class="side-nav">
        <% loop SupplementalInstructions.Limit(5).Sort('Title ASC') %>
            <li><a href="$Link">$Title</a></li>
        <% end_loop %>
        </ul>
        <a href="find-help/supplemental-instructions/">Learn more about supplemental instruction &rarr;</a>
    <% end_if %>
    <% if $HelpLabs || $SupplementalInstructions %></p><% end_if %>
    <% if $Tutors %>
        <h3 class="banner"><span>Similar Private Tutors</span></h3>
        <ul class="tutor-card-list small">
        <% loop $Tutors.Limit(4) %><% include TutorCard %><% end_loop %>
        </ul>
    <% end_if %>

<% end_with %>