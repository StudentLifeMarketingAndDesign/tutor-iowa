(function() {

    "use strict";

    /*
    * inbox inits
    */

    $("#main-content .noUnread").hide(); // hiding with jQuery b/c the foundation '.hide' class sets visibility: invisible
    $("#unreadInbox").hide();
    var memberID = $("#memberInfo").data('id');
    var baseURL = $(location).attr('href');
    var markAsReadURL = baseURL + "/markAsRead";
    var markAsDeletedURL = baseURL + "/markAsDeleted";
    var processImageURL = baseURL + "/processImage"

    /*
    * inbox navigation
    */

    $(".unread-messages").click(function () {

        $.get( location.href + "/unread", {}, 
        function(data) {
            var unreadMessages = data;

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
                            //console.log(status);
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
                            //console.log(error);
                            //console.log(data);
                        });                       
                    } else {
                        event.preventDefault();
                    }
                });             
            } 
        });
    }

    function getBaseHref(){
        var bases = document.getElementsByTagName('base');
        var baseHref = null;

        if (bases.length > 0) {
            baseHref = bases[0].href;
        }

        return baseHref;
    }

    function updateDOM(message, action, $object) {

        var baseHref = getBaseHref();

        // dynamically reduce inbox count on header and topbar
        //console.log('updating dom');
        if (action == "markAsRead") {
            message.addClass("read");
        } else if (action == "markAsDeleted") {
            message.remove();
        } else if (action == "withdrawImage") {
            //console.log(message);
            //console.log(action);
            //console.log($object);
            //$object.remove();
        }
        // dynamically reduce inbox count on header and topbar
        $.get( baseHref + "/inbox/unreadCount", {}, function(data) {
                var unreadCount = $.parseJSON(data);
                
                if (unreadCount > 0) {
                    $(".inboxCount").html("(" + unreadCount + ")").data("unreadcount", unreadCount );
                } else {
                    $(".inboxCount").html("").data("unreadcount", unreadCount);
                    $("#inbox-link").removeClass("unread-messages");
                    $(".inbox-head").removeClass("unread-messages");
                }
                // if all messages unread and div hasn't been appended already, append message
            },
            "json" 
        );

        if ( noUnreadMessages() ) {
             $("#main-content .noUnread").show(); // what is a better way to only show .noUnread in .unread-messages?
        } 
    }

 
    /*
    * Image approval function
    */

    $(".processImage button").click(function () {
        console.log('processing image');
        var $pendingImage = $(this).closest(".pending-image");
        var imageID = $pendingImage.data("imageid");
        var processCode = $(this).data("process");
        console.log(imageID, processCode);
        
        if (processCode !== 3 ) {
            if (processCode == 2) {
                var unapprovedMessage = $pendingImage.find(".reasonBox").val();
                console.log(unapprovedMessage);
            }
            var processImage = $.post(
                processImageURL,
                {
                    ProcessCode: processCode,
                    ImageID: imageID,
                    UnapprovedMessage: unapprovedMessage
                }, 
                function(data, textStatus, jqXHR) { 
                    //console.log(data);
                    data = $.parseJSON(data);
                    updateDOM(data, "withdrawImage", $pendingImage);

                },
                "json"
            ).fail(function(data, status, error) {
                console.log(error);
                console.log(data);
            });  
        } else if (processCode == 3) {
            console.log('not approved :(');
            var element = document.createElement("textarea");
            element.className += "reasonBox";
            $pendingImage.append(element);
            $(this).addClass("alert-confirm");
            $(this).text("Confirm ");
            $(this).data("process", 2);
        }

    });  

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
        attachHandlers();

        //Refresh every twenty seconds if user is logged in (has an inbox)
        if($("#inbox-link").length > 0 ){
            setInterval(updateDOM, 20000); 
        }
    });

/*
    function InboxViewModel() {

    }
    ko.applyBindings(new InboxViewModel());
   */

})();
