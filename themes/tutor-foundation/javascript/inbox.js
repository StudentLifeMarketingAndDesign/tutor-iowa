(function () {

    "use strict";

    /*
    * inbox inits
    */

    $("#main-content .noUnread").hide(); // hiding with jQuery b/c the foundation '.hide' class sets visibility: invisible
    $("#unreadInbox").hide();
    var memberID = $("#memberInfo").data('id');
    var markAsReadURL = $(location).attr('href') + "/markAsRead";
    var markAsDeletedURL = $(location).attr('href') + "/markAsDeleted";
    var unreadMessages;

    /*
    * inbox navigation
    */

    $(".unread-messages").click(function () {

        $.get( location.href + "/unread", {}, 
        function(data) {
            unreadMessages = data;

            $(".inbox-message").each(function () {
                $(this).hide();
            });	
            $(".moreMessages").remove();

            $("#unreadInbox").append(unreadMessages);
            $("#unreadInbox").show();
            // if all messages unread and div hasn't been appended already, append message
            if ( noUnreadMessages() ) {
                $("#main-content .noUnread").show(); // what is a better way to only show .noUnread in .unread-messages?
            } 
        },
        "html" 
        );

    });

    $(".all-messages").click(function () {
        $("#unreadInbox").hide();
        $(".inbox-message").each(function() {
            $(this).show();
            $("#main-content .noUnread").hide(); 
        });	
    });

    $(".unreplied-messages").click(function () {
        $(".replied").each(function() {
            $(this).hide();
            $("#main-content .noUnread").hide(); 
        });	
    });

    /*
    * inbox "controller"
    */

    $(".inbox-message").each( function () {
        //var message = $(this).children('.inbox-message-body').text();
        //var wordCount = message.split(" ");
        //console.log(message);
    });

    function markAsRead() {
        $(".mark-read").each(function () {
            if ($(this).data("loaded") != 'true') {
                $(this).data("loaded", "true");
                $(this).click(function() {
                    var message = $(this).closest(".inbox-message");
                    var messageID = message.data('id');
                    if (!message.data('read')) {

                        var jqXHR = $.post(
                        markAsReadURL,
                        {
                            MemberID: memberID,
                            MessageID: messageID
                        }, 
                        function(data, textStatus, jqXHR) {	
                            message.data("read", data.DateReadTime);
                            updateDOM(message, "markAsRead");
                        }).fail(function( jqXHR, status, error) {
                            console.log(status);
                        });
                    }
                });				
            } else {
                // nada
            }
        });
    }

    function markAsDeleted() {
        $(".mark-delete").each(function () {
            if ($(this).data("loaded") != 'true') {
                $(this).data("loaded", "true");
                $(this).click(function() {
                    if (window.confirm("Deleting Messages is permanent. Click OK to delete message")) {
                        var message = $(this).closest(".inbox-message");
                        var messageID = message.data('id');
                        var jqXHR = $.post(
                            markAsDeletedURL,
                            {
                                MemberID: memberID,
                                MessageID: messageID
                            }, 
                            function(data, textStatus, jqXHR) { 
                                updateDOM(message, "markAsDeleted");
                            },
                            "json"
                        ).fail(function(data, status, error) {
                            console.log(error);
                            console.log(data);
                        });                       
                    } else {
                        event.preventDefault();
                    }
                });             
            } 
        });
    }

    function updateDOM(message, action) {
        // dynamically reduce inbox count on header and topbar
        if (action == "markAsRead") {
            message.addClass("read");
        } else if (action == "markAsDeleted") {
            message.remove();
        }
        // dynamically reduce inbox count on header and topbar
        $.get( location.href + "/unreadCount", {}, function(data) {
                var unreadCount = $.parseJSON(data);
                
                if (unreadCount > 0) {
                    $(".inboxCount").html("(" + unreadCount + ")").data("unreadcount", unreadCount );
                } else {
                    $(".inboxCount").html("").data("unreadcount", unreadCount);
                }
                // if all messages unread and div hasn't been appended already, append message
            },
            "json" 
        );

        if ( noUnreadMessages() ) {
             $("#main-content .noUnread").show(); // what is a better way to only show .noUnread in .unread-messages?
        } 
    }

    function noUnreadMessages() {
        // determines if inbox has unread messages or nah
        var count = $(".inboxCount").data("unreadcount"); 
        if (count < 1 || typeof(count) == "undefined") {
            return true;
        } else {
            return false;
        }

    }

    function attachHandlers() {
        markAsRead();
        markAsDeleted();
    }

    /*
    * inbox pagination
    * using the waypoints.js jquery plugin to make this nice and succinct
    */

    var infinite = new Waypoint.Infinite({
        element: $('#main-content')[0],
        items: '.inbox-message',
        more: '.moreMessages',
        onAfterPageLoad: attachHandlers, 
    })

    /*
    * inbox initalize 
    *
    */

    $( document ).ready(function () {
        markAsRead();
        markAsDeleted();  
    });

})();
