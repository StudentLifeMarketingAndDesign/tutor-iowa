<% if $RelatedResources.HelpLabs || $RelatedResources.Tutors %>
<h3><span>Related Campus Resources</span></h3>
<% end_if %>

<% with $RelatedResources %>
    <p>
    <% if $HelpLabs %>
    <strong>Help Labs:</strong> <% loop HelpLabs.Limit(5) %><a href="$Link">$Title</a><% if not $Last %>, <% end_if %><% end_loop %>
        <hr />
    <% end_if %>
    <% if $SupplementalInstructions %>
        <strong>Supplemental Instruction</strong> <% loop SupplementalInstructions.Limit(5) %><a href="$Link">$Title</a><% if not $Last %>, <% end_if %><% end_loop %>
        <hr />
    <% end_if %>
    
    </p>
    <% if $Tutors %>
        <h3><span>Similar Tutors</span></h3>
        <ul class="tutor-card-list small">
        <% loop Tutors.Limit(4) %><% include TutorCard %><% end_loop %>
        </ul>
    <% end_if %>
<% end_with %>