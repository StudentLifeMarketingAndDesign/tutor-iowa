<?php
use SilverStripe\Assets\Image;
use SilverStripe\Forms\LiteralField;
use SilverStripe\ORM\FieldType\DBDatetime;
class StatsPageController extends PageController {

	public function RequestsSinceYesterday() {
		$today = DBDatetime::Now()->Format('Y-m-d');
		$days_ago = date('Y-m-d', strtotime('-1 days', strtotime($today)));

		$messageCount = $this->getMessagesByDateRange($days_ago, $today)->Count();
		return $messageCount;
	}

	public function RequestsSinceLastWeek() {
		$today = DBDatetime::Now()->Format('Y-m-d');
		$days_ago = date('Y-m-d', strtotime('-7 days', strtotime($today)));

		$messageCount = $this->getMessagesByDateRange($days_ago, $today)->Count();
		return $messageCount;
	}

	public function RequestsSinceLastMonth() {
		$today = DBDatetime::Now()->Format('Y-m-d');
		$days_ago = date('Y-m-d', strtotime('-1 months', strtotime($today)));

		$messageCount = $this->getMessagesByDateRange($days_ago, $today)->Count();
		return $messageCount;
	}

	public function RequestsSinceLastSemester() {
		$today = DBDatetime::Now()->Format('Y-m-d');
		$days_ago = date('Y-m-d', strtotime('-6 months', strtotime($today)));

		$messageCount = $this->getMessagesByDateRange($days_ago, $today)->Count();
		return $messageCount;
	}

	public function RequestsSinceBeginningOfYear() {
		$today = DBDatetime::Now()->Format('Y-m-d');
		$days_ago = date('Y-m-d', strtotime('-1 years', strtotime($today)));

		$messageCount = $this->getMessagesByDateRange($days_ago, $today)->Count();
		return $messageCount;
	}

	public function RequestsTotal() {
		$requests = Message::get();
		return $requests->Count();
	}

//In template: Yesterday's messages: $RequestsSinceYesterday

	function getMessagesByDateRange($startDate, $endDate) {
		$requests = Message::get()->filter(array(
			"Created:GreaterThanOrEqual" => $startDate,
			"Created:LessThanOrEqual" => $endDate,
		));
		return $requests;
	}

	function getTopSearchTerms() {

		$searchTerms = SearchTerm::get();
		return $searchTerms;
	}
}