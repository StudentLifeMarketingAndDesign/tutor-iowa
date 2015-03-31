<?php
class CoverImage extends PendingImage {
    
    private static $db = array(
        'Top' => 'Percentage'
    );

    public static $belongs_to = array(
        'TutorPage' => "TutorPage"
    );
        
    private static $summary_fields = array();
    private static $field_labels = array();
    
    protected function onBeforeWrite() {
        // This sets the the foreign key ID for Tutorpage in the DB to give us a handle on the Tutorpage from the CoverImage object
		$member = Member::currentUser();
        $associatedTutorPage = TutorPage::get()->where("MemberID =" . $member->ID)->first(); 
        $this->TutorPageID = $associatedTutorPage->ID;

        parent::onBeforeWrite();
    }
    
    // couldn't get the build in Nice() function to work, so I overload it here. 
    public function NiceTop() {
        $topPercentage = (string)$this->Top * 100;
        return $topPercentage . "%";
    }
}
