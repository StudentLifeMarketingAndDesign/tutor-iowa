<?php
//Change title at far-right of statement to change group that gets notifications of users registering

//old queries: for reference purposes

//$emailArray = DataObject::get('Member', "ID in (select MemberID from Group_Members where GroupID = (select ID from `Group` where title='Content Authors'))");

//$emailArray = DataObject::get('Member', "ID in (select MemberID from Group_Members where GroupID = (select GroupID from Group_Roles where PermissionRoleID = (select ID from `PermissionRole` where title='GetsUserEmails')))");

//select * from member where ID in (select MemberID from Group_Members where GroupID = (select GroupID from Group_Roles where PermissionRoleID = (select ID from `PermissionRole` where title='GetsUserEmails')))

//$emailArray = DataObject::get('Member', "ID in (select MemberID from Group_Members where GroupID = (select ID from `Group` where title='Tutor Managers'))");
$emailArray = Member::get()->where("ID in (select MemberID from Group_Members where GroupID = (select ID from `Group` where title='Tutor Managers'))");

//$group = Group::get()->filter(array('Title' => 'Tutor Managers'))->First();
//$groupID = $group->ID;
//$emailArray = Member::get()->addFilter(array('Groups.Title' => 'Tutor Managers'))
?>
