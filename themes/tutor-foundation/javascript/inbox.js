/*
* inbox inits
*/

$("#main-content .noUnread").hide(); // hiding with jQuery b/c the foundation '.hide' class sets visibility: invisible
$("#unreadInbox").hide();
var memberID = $("#memberInfo").data('id');
var markAsRead = $(location).attr('href') + "/markAsRead"; //if href ends in "#" this url will not work
var unreadMessages;

$.get( location.href + "/unread", {}, 
	function(data) {
		unreadMessages = data;
		console.log(unreadMessages);
	},
	"html" 
);


/*
* inbox navigation
*/

$(".unread-messages").click(function() {
	console.log('hello');
	$(".inbox-message").each(function() {
		$(this).hide();
	});	
	$(".moreMessages").hide();
	
	$("#unreadInbox").append(unreadMessages);
	$("#unreadInbox").show();
	// if all messages unread and div hasn't been appended already, append message
	if ( noUnreadMessages() ) {
		$("#main-content .noUnread").show(); // what is a better way to only show .noUnread in .unread-messages?
	} 
});

$(".all-messages").click(function() {
	$("#unreadInbox").hide();
	$(".inbox-message").each(function() {
		$(this).show();
		$("#main-content .noUnread").hide(); 
	});	
});

$(".unreplied-messages").click(function() {
	$(".replied").each(function() {
		$(this).hide();
		$("#main-content .noUnread").hide(); 

	});	
});

/*
* inbox "controller"
*/

$(".inbox-message").each( function() {
	//var message = $(this).children('.inbox-message-body').text();
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
				//console.log(textStatus);
				//console.log(jqXHR);
				//console.log(data);
				
				message.addClass("read");

				// dynamically reduce inbox count on header and topbar
				inboxCount = $(".inboxCount").data("unreadcount");
				inboxCount--;
				if (inboxCount > 0) {
					$(".inboxCount").html("(" + inboxCount + ")").data("unreadcount", inboxCount );
				} else {
					$(".inboxCount").html("").data("unreadcount", inboxCount);
				}

			}
		).fail(function( jqXHR, status, error) {
			//console.log(jqXHR);
			console.log(status);
			console.log(error);
		});
	}
});

function noUnreadMessages() {
	// determines if inbox has unread messages or nah
	count = $(".inboxCount").data("unreadcount"); 
	if (count < 1 || typeof(count) == "undefined") {
		return true;
	} else {
		return false;
	}

}

/*
* inbox pagination
*/

// using the waypoints.js jquery plugin to make this nice and succinct
var infinite = new Waypoint.Infinite({
  element: $('#main-content')[0],
  items: '.inbox-message',
  more: '.moreMessages'
})



