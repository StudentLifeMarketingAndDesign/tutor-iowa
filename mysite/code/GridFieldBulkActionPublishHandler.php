<?php

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Convert;
use SilverStripe\Control\HTTPResponse;
use Colymba\BulkManager\BulkAction\Handler;
/**
 * Bulk action handler for deleting records.
 * 
 * @author colymba
 * @package GridFieldBulkEditingTools
 * @subpackage BulkManager
 */
class GridFieldBulkActionPublishHandler extends Handler
{	
	/**
	 * RequestHandler allowed actions
	 * @var array
	 */
	private static $allowed_actions = array('publish');


	/**
	 * RequestHandler url => action map
	 * @var array
	 */
	private static $url_handlers = array(
		'publish' => 'publish'
	);
	

	/**
	 * Publish
	 * 
	 * @param SS_HTTPRequest $request
	 * @return SS_HTTPResponse List of deleted records ID
	 */
	public function publish(HTTPRequest $request)
	{
		$ids = array();
		
		foreach ( $this->getRecords() as $record )
		{						
			array_push($ids, $record->ID);
			$record->write();
			$record->doPublish('Stage', 'Live');
		

		}

		$response = new HTTPResponse(Convert::raw2json(array(
			'done' => true,
			'records' => $ids
		)));
		$response->addHeader('Content-Type', 'text/json');
		return $response;	
	}
}