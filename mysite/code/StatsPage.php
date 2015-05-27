<?php
class StatsPage extends Page {

	private static $db = array(
		'TutorRequestCount' => 'Int',
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldFromTab('Root.Main', "Content");
		$fields->removeFieldFromTab('Root.Main', "Image");
		$fields->removeFieldFromTab('Root.Main', "BackgroundImage");
		$fields->addFieldToTab('Root.Main', $tutorCount = new LiteralField('StatsLinkField', '<a href="stats-page/" target="_blank">Tutor request counts and other statistics can now be found here.</a>'));

		return $fields;
	}
}
class StatsPage_Controller extends Page_Controller {

	public function RequestsSinceYesterday() {
		$today = ss_datetime::Now()->Format('Y-m-d');
		$days_ago = date('Y-m-d', strtotime('-1 days', strtotime($today)));

		$messageCount = $this->getMessagesByDateRange($days_ago, $today)->Count();
		return $messageCount;
	}

	public function RequestsSinceLastWeek() {
		$today = ss_datetime::Now()->Format('Y-m-d');
		$days_ago = date('Y-m-d', strtotime('-7 days', strtotime($today)));

		$messageCount = $this->getMessagesByDateRange($days_ago, $today)->Count();
		return $messageCount;
	}

	public function RequestsSinceLastMonth() {
		$today = ss_datetime::Now()->Format('Y-m-d');
		$days_ago = date('Y-m-d', strtotime('-1 months', strtotime($today)));

		$messageCount = $this->getMessagesByDateRange($days_ago, $today)->Count();
		return $messageCount;
	}

	public function RequestsSinceLastSemester() {
		$today = ss_datetime::Now()->Format('Y-m-d');
		$days_ago = date('Y-m-d', strtotime('-6 months', strtotime($today)));

		$messageCount = $this->getMessagesByDateRange($days_ago, $today)->Count();
		return $messageCount;
	}

	public function RequestsSinceBeginningOfYear() {
		$today = ss_datetime::Now()->Format('Y-m-d');
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