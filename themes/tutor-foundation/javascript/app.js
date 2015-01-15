// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

// trigger for joyride demo in KitchenSink demo
$('#start-jr').on('click', function() {
	$(document).foundation('joyride','start');
});


var memberID = $("#memberInfo").data('id');
var markAsRead = $(location).attr('href') + "/markAsRead";
var initInboxHeight = $("#inbox").height();
var openMessage;
//var getFullMessage = $(location).attr('href') + "/getFullMessage";


$(".message").each( function() {
	var message = $(this).children('.message-body').text();
	var wordCount = message.split(" ");
	//console.log(message);
	
	
	
}).click(function() {
	var messageID = $(this).data('id');
	
	if ($(this).data('read')) {
		//something? nothing?
		console.log('marked as read');
		/*
		$.get(
			getFullMessage,
			{},
			function(data, textStatus, jqXHR) {
				$("#messagePanel").append(data);
			},
			"json"
		);
		*/
	} else {
		//console.log(messageID);
		//console.log(memberID);
		$.post(
			markAsRead,
			{
				MemberID: memberID,
				MessageID: messageID
			}, 
			function(data, textStatus, jqXHR) {
				console.log(textStatus);
				//console.log(jqXHR);
				console.log(data);
			},
			"json"
		).fail(function() {
			console.log('fail');
		});
	}


	messageBody = $(this).find('.message-body').first();
	messageBody.toggleClass("open-message");
	replyForm = messageBody.find('.reply-form').first();
	replyForm.toggleClass('hide');


	openMessage = messageBody;
	
	heightFix = ($("#inbox").height() - initInboxHeight);
	$(".footer").css("margin-top", heightFix);
	
	/*
		
	$(".message-body").each(function() {
		if ($(this).hasClass("open-message")) {
			$(this).removeClass("open-message");
		}
	});
	
	messageBody.height( function() {
		if ($(this).height() > 120) {
			$(this).height(120);
		} else {
			$(this).height("auto");
			console.log("hello");
		}

		var balanceHeight = $(this).height();
		$(".footer").css("margin-top", balanceHeight);
		
	}); 
	*/
	//expand div

});
