<?php

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Convert;
use SilverStripe\Control\HTTPResponse;
use Colymba\BulkManager\BulkAction\Handler;
use Colymba\BulkTools\HTTPBulkToolsResponse;
/**
 * Bulk action handler for deleting records.
 * 
 * @author colymba
 * @package GridFieldBulkEditingTools
 * @subpackage BulkManager
 */
class GridFieldBulkActionMarkIneligibleHandler extends Handler
{	
 /**
     * URL segment used to call this handler
     * If none given, @BulkManager will fallback to the Unqualified class name
     * 
     * @var string
     */
    private static $url_segment = 'markIneligible';

    /**
     * RequestHandler allowed actions.
     *
     * @var array
     */
    private static $allowed_actions = array('markIneligible');

    /**
     * RequestHandler url => action map.
     *
     * @var array
     */
    private static $url_handlers = array(
        '' => 'markIneligible',
    );

    /**
     * Front-end label for this handler's action
     * 
     * @var string
     */
    protected $label = 'Mark as ineligible';

    /**
     * Front-end icon path for this handler's action.
     * 
     * @var string
     */
    protected $icon = '';

    /**
     * Extra classes to add to the bulk action button for this handler
     * Can also be used to set the button font-icon e.g. font-icon-trash
     * 
     * @var string
     */
    protected $buttonClasses = '';
    
    /**
     * Whether this handler should be called via an XHR from the front-end
     * 
     * @var boolean
     */
    protected $xhr = true;
    
    /**
     * Set to true is this handler will destroy any data.
     * A warning and confirmation will be shown on the front-end.
     * 
     * @var boolean
     */
    protected $destructive = false;

	/**
	 * Publish
	 * 
	 * @param SS_HTTPRequest $request
	 * @return SS_HTTPResponse List of deleted records ID
	 */
	public function markIneligible(HTTPRequest $request)
	{
		$records = $this->getRecords();
		$response = new HTTPBulkToolsResponse(true, $this->gridField);

		foreach ( $records as $record )
		{						

			$record->EligibleToTutor = 0;
			$record->write();
			$response->addSuccessRecord($record);
		}

		return $response;	
	}
}