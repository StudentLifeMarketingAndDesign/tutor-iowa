<?php
class TutorIowaAdmin extends ModelAdmin {
	static $managed_models = array(
	'TutorPage',
	'SupplementalInstruction',
	'HelpLab',
	'StudyGroup',
	'MemberManagement'
		
	);
	
	static $url_segment = 'approval';
}