<?php
class TutorIowaAdmin extends ModelAdmin {
	static $managed_models = array(
	'TutorPage',
	'SupplementalInstruction',
	'HelpLab'

		
	);
	
	static $url_segment = 'approval';
}