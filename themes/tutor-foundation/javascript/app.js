// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

// trigger for joyride demo in KitchenSink demo
$('#start-jr').on('click', function() {
	$(document).foundation('joyride','start');
});


// For small screens - show/hide the search on-click
$('.search-toggle').click(function() {
    $(this).toggleClass('active');
    $('.division-search').slideToggle();
    return false;
});    


<<<<<<< HEAD
    var bLazy = new Blazy({
        breakpoints: [{
            width: 420 // max-width
            ,
            src: 'data-src-small'
        }
       ]
    });
=======
var memberID = $("#memberInfo").data('id');
var markAsRead = $(location).attr('href') + "/markAsRead";
//if href ends in "#" this url will not work

var initInboxHeight = $("#inbox").height();
var openMessage;
//var getFullMessage = $(location).attr('href') + "/getFullMessage";

$(".message").each( function() {
	//var message = $(this).children('.message-body').text();
	//var wordCount = message.split(" ");
	//console.log(message);
}).click(function() {
	var message = $(this);
	var messageID = $(this).data('id');
	
	if (!$(this).data('read')) {
		console.log('not read...yet');
		console.log(messageID);
		console.log(memberID);
		jqXHR = $.post(
			markAsRead,
			{
				MemberID: memberID,
				MessageID: messageID
			}, 
			function(data, textStatus, jqXHR) {
				console.log(textStatus);
				//console.log(jqXHR);
				console.log(data);
				message.addClass("read");
			}
		).fail(function( jqXHR, status, error) {
			//console.log(jqXHR);
			console.log(status);
			console.log(error);
		});
	}

	/*
	if ($(event.target).parents(".reply-form")) {
		console.log($(event.target).parents(".reply-form"));
		
	} */
	
	/*
	
	clickedOn = ($(".reply-form").has($(event.target)));
	if (clickedOn["length"] > 0) {
		//console.log($(".reply-form").has($(event.target)));
	} else {
		messageBody = $(this).find('.message-body').first();
		messageBody.toggleClass("open-message");
		replyForm = messageBody.find('.reply-form').first();
		replyForm.toggleClass('hide');
	
		openMessage = messageBody;
		inboxHeight = $("#inbox").height();
		whiteCoverHeight = $(".white-cover").height();
		articleHeight = $(".main-article").outerHeight();
		
		heightFix = inboxHeight - initInboxHeight;
		$(".white-cover").css("height", articleHeight);
		$(".footer").css("margin-top", heightFix);
	}
	*/
});

$(".unread-messages").click(function() {
	$(".read").each(function() {
		$(this).hide();
	});	
});

$(".all-messages").click(function() {
	$(".message").each(function() {
		$(this).show();
	});	
});

$(".unreplied-messages").click(function() {
	$(".replied").each(function() {
		$(this).hide();
	});	
});
>>>>>>> 2.0
