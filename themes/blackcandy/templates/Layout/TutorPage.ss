<div id="something">Rendered with TutorPage.ss</div>
<br><br>

ID: $ID <br>
FirstName: $FirstName <br>
LastName: $LastName	<br>
Bio: $Content <br>
Hours: $Hours <br>
Phone: $PhoneNo <br>
Tags: $MetaKeywords <br> 
StartDate: $StartDate.format(m)/$StartDate.format(d)/$StartDate.format(y)<br>
EndDate: $EndDate<br>

<% if Saved %>
	Your Tutor has been emailed!
<% else %>
	$ContactTutor
<% end_if %>
	

	
<br><br>
$PageComments