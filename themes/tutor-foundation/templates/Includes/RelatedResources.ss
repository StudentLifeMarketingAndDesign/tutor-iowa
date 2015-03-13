<h3><span>Related Campus Resources:</span></h3>

<p><strong>Help Labs:</strong> <% loop ChildrenOf("help-labs").Limit(5) %><a href="$Link">$Title</a><% if not $Last %>, <% end_if %><% end_loop %>
    <hr />
    <strong>Supplemental Instruction:</strong> <% loop ChildrenOf("supplemental-instruction").Limit(5) %><a href="$Link">$Title</a><% if not $Last %>, <% end_if %><% end_loop %>
</p>
<hr />
<h3><span>Similar Tutors</span></h3>
<ul class="tutor-card-list small">
<% loop ChildrenOf("private-tutors").Limit(4) %><% include TutorCard %><% end_loop %>
</ul>