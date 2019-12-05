<?php

use SilverStripe\Control\Email\Email;
use SilverStripe\Security\Member;
use SilverStripe\View\ArrayData;
use SilverStripe\Dev\BuildTask;
class EmailAdmins extends BuildTask {

	protected $title = 'Email Administrators about Pending Images for Approval';
	protected $description = 'Sends a daily email digest with details about Tutor Iowa, primarily to inform them about images pending approval, but can be expanded to include other useful information';
	protected $enabled = true;

	public function run($request) {
        /* Daily Stats */
        $DailyStats = self::gatherStats();
        $DailyStatsMap = $DailyStats->toMap();
        extract($DailyStatsMap);
        echo ("<br> Gathering Stats from yesterday...<br><br>");
        
        foreach ($DailyStatsMap as $key => $stat) {
            echo $key . " => " . $stat . "\n <br>";
        }
        
        $subject = $YesterdayDate . "report for TutorIowa";
    	$body = "Yesterday," . $YesterdayDate . "," . $NumOfTutorsOnlineYesterday . " logged into TutorIowa, " . $NumOfNewTutorRequestsYesterday . " people registered for TutorIowa, " . $NumOfNewFeedbacksYesterday . " feedback messages were sent, and " . $NumOfNewMessagesYesterday . " messages were sent to Tutors by inquiring students. There are currently" . $NumOfPendingImages . " images pending administrative approval. The oldest one was uploaded " . $TimeSinceOldestUpload;
    	
    	$emailTo = Email::getAdminEmail();
    	
    	$email = new Email("TutorIowa", "athaax@gmail.com", $subject, $body); 
        return $email->send(); // returns boolean

	}
	
	public static function gatherStats() {
        $actualPendingImages = PendingImage::actualPendingImages(true);
        
    	$yesterdayDate = date('Y-m-d', strtotime("-1 days"));
        $yesterdayStart = $yesterdayDate . " 00:00:00";
        $yesterdayEnd = $yesterdayDate . " 23:59:59";

        $result = array(
            //"ActualPendingImages" => $actualPendingImages,
            "YesterdayDate" => $yesterdayDate,
            "YesterdayStart" => $yesterdayStart,
            "YesterdayEnd" => $yesterdayEnd,
            "NumOfTutorsOnlineYesterday" => Member::get()->where("LastVisited BETWEEN '" . $yesterdayStart . "' AND '" . $yesterdayEnd . "'" )->count(),
            "NumOfNewTutorRequestsYesterday" => Member::get()->where("Created BETWEEN '" . $yesterdayStart . "' AND '" . $yesterdayEnd. "'" )->count(),
            "NumOfNewFeedbacksYesterday" => FeedbackItem::get()->where("Created BETWEEN '" . $yesterdayStart . "' AND '" . $yesterdayEnd . "'")->count(),
            "NumOfNewMessagesYesterday" => Message::get()->where("Created BETWEEN '" . $yesterdayStart . "' AND '" . $yesterdayEnd . "'")->count(),
            "NumOfPendingImages" => $actualPendingImages->count()
        );
        
        $result["TimeSinceOldestUpload"] = $actualPendingImages->exists() ? $actualPendingImages->sort("Created ASC")->first()->Created : NULL;
        
        return new ArrayData($result);
    }
}