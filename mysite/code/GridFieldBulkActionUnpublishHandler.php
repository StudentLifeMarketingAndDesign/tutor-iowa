<?php
/**
 * Bulk action handler for deleting records.
 * 
 * @author colymba
 * @package GridFieldBulkEditingTools
 * @subpackage BulkManager
 */
class GridFieldBulkActionUnpublishHandler extends GridFieldBulkActionHandler
{	
	/**
	 * RequestHandler allowed actions
	 * @var array
	 */
	private static $allowed_actions = array('unPublish');


	/**
	 * RequestHandler url => action map
	 * @var array
	 */
	private static $url_handlers = array(
		'unPublish' => 'unPublish'
	);
	

	/**
	 * Publish
	 * 
	 * @param SS_HTTPRequest $request
	 * @return SS_HTTPResponse List of deleted records ID
	 */
	public function unPublish(SS_HTTPRequest $request)
	{
		$ids = array();
		
		foreach ( $this->getRecords() as $record )
		{						
			array_push($ids, $record->ID);
			$record->doUnpublish();
		}

		$response = new SS_HTTPResponse(Convert::raw2json(array(
			'done' => true,
			'records' => $ids
		)));
		$response->addHeader('Content-Type', 'text/json');
		return $response;	
	}
}