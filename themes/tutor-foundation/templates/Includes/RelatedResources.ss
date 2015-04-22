<<<<<<< HEAD
<% if $RelatedResources.HelpLabs || $RelatedResources.SupplementalInstruction %>
<h3><span>Related Campus Resources</span></h3>
<% end_if %>

<% with $RelatedResources %>
    <% if $HelpLabs || $SupplementalInstructions %><p><% end_if %>
    <% if $HelpLabs %>
    <strong>Help Labs:</strong> <% loop HelpLabs.Limit(5) %><a href="$Link">$Title</a><% if not $Last %>, <% end_if %><% end_loop %>
        <hr />
    <% end_if %>
    <% if $SupplementalInstructions %>
        <strong>Supplemental Instruction:</strong> <% loop SupplementalInstructions.Limit(5) %><a href="$Link">$Title</a><% if not $Last %>, <% end_if %><% end_loop %>
    <% end_if %>
    <% if $HelpLabs || $SupplementalInstructions %></p><% end_if %>
    <% if $Tutors %>
        <h3><span>Similar Tutors</span></h3>
=======
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
>>>>>>> 2.0
        <ul class="tutor-card-list small">
        <% loop $Tutors.Limit(4) %><% include TutorCard %><% end_loop %>
        </ul>
    <% end_if %>

<% end_with %>