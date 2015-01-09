<?php
class Inbox_Controller extends Page_Controller {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */

	private static $allowed_actions = array('show', 'feed');

	private static $url_handlers = array(
        'show//$ID' => 'show',
        'feed//$ID' => 'feed'
    );
	public function init() {
		parent::init();

	}
	public function show($request){
		$tagURLSegment = addslashes( $this->urlParams['ID'] );
		$tag = Tag::get()->Filter(array("URLSegment" => $tagURLSegment))->First();

		if(isset($tag)){
			$Data = array (
				'Title' =>$tag->Title,
				'Tag' => $tag
			);
			return $this->customise($Data)->renderWith(array('Page', 'Page'));
		}
	}

	public function feed(){
		$tagURLSegment = addslashes( $this->urlParams['ID'] );
		$tag = Tag::get()->Filter(array("URLSegment" => $tagURLSegment))->First();

		if(isset($tag)){
			$Data = array (
				'Title' =>$tag->Title,
				'Tag' => $tag
			);

			$feed['className'] = $tag->ClassName;
			$feed['title'] = $tag->Title;
			$feed['body'] = $this->customise($Data)->renderWith(array('TagController'))->getValue();
			$feed['section'] = $this->Level(1)->URLSegment;

			$json = Convert::array2json($feed);
			return $json;
		}
	}

}
