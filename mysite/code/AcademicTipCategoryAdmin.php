<?php

class AcademicTipCategoryAdmin extends ModelAdmin {

	private static $menu_title = 'Worksheet Categories';

	private static $managed_models = array(
		'AcademicTipCategory'
	); 

	private static $url_segment = 'academic-tip-categories';

    public function getEditForm($id = null, $fields = null) {
        $form=parent::getEditForm($id, $fields);

        //This check is simply to ensure you are on the managed model you want adjust accordingly
        if($this->modelClass=='AcademicTipCategory' && $gridField=$form->Fields()->dataFieldByName($this->sanitiseClassName($this->modelClass))) {
            //This is just a precaution to ensure we got a GridField from dataFieldByName() which you should have
            if($gridField instanceof GridField) {
                $gridField->getConfig()->addComponent(new GridFieldSortableRows('SortOrder'));
            }
        }

        return $form;
    }	

}