<?php
class CoverImage extends PendingImage {
    
    private static $db = array(
        'Top' => 'Percentage'
    );

    private static $belongs_to = array(
        'TutorPage' => "TutorPage"
    );
        
    private static $summary_fields = array();
    private static $field_labels = array();
    
    protected function onBeforeWrite() {
        parent::onBeforeWrite();
    }
    
    // couldn't get the build in Nice() function to work, so I overload it here. 
    public function NiceTop() {
        $topPercentage = (string)$this->Top * 100;
        return $topPercentage . "%";
    }
    
	/**
    * Construct a datalist of CoverImages marked 'Pending' by first finding TutorPages with a PendingCoverImage relation that is set,
    * Then loop those relations, adding them to ArrayList. We do this to ensure that everyone only sees PendingImages that 
    * can be worked with, i.e approved, unapproved. Note: the ajax upload field on TutorPage can create PendingImages before
    * the relation is set. This gets around that. 
    * @return ArrayList	
    */
	public static function getPending() {
        $tutorsWithPI = TutorPage::get()->where("PendingCoverImageID != 0");
        $realTutorsWithPI = new ArrayList($tutorsWithPI->toArray());
        $realPendingCoverImages = new ArrayList();
        foreach ($realTutorsWithPI as $index => $TP) {
            $realPendingCoverImages->push($TP->PendingCoverImage());
        }
		return $realPendingCoverImages;
	}
	
}
