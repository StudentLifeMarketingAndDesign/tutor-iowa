<?php
//Change title at far-right of statement to change group that gets notifications of users registering

//$emailArray = DataObject::get('Member', "ID in (select MemberID from Group_Members where GroupID = (select ID from `Group` where title='Content Authors'))");

$emailArray = DataObject::get('Member', "ID in (select MemberID from Group_Members where GroupID = (select GroupID from Group_Roles where PermissionRoleID = (select ID from `PermissionRole` where title='GetsUserEmails')))");
?>
