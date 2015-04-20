<% with $RelatedResources %>
    <% if $HelpLabs || $SupplementalInstructions %><p><% end_if %>
    <% if $HelpLabs %>
    <h3><span>Related Help Labs</span></h3> 
        <ul class="side-nav">
        <% loop HelpLabs.Limit(5).Sort('Title ASC') %>
            <li><strong><a href="$Link">$Title</a></strong></li>
        <% end_loop %>
            <li><a href="help-labs/">Learn more about help labs on campus</a></li>
        </ul>
    <% end_if %>
    <% if $SupplementalInstructions %>
    <h3><span>Related Supplemental Instruction</span></h3> 
        <ul class="side-nav">
        <% loop SupplementalInstructions.Limit(5).Sort('Title ASC') %>
            <li><strong><a href="$Link">$Title</a></strong></li>
        <% end_loop %>
            <li><a href="supplemental-instruction/">Learn more about supplemental instruction</a></li>
        </ul>
    <% end_if %>
    <% if $HelpLabs || $SupplementalInstructions %></p><% end_if %>
    <% if $Tutors %>
        <h3><span>Similar Private Tutors</span></h3>
        <ul class="tutor-card-list small">
        <% loop $Tutors.Limit(4) %><% include TutorCard %><% end_loop %>
        </ul>
    <% end_if %>

<% end_with %>