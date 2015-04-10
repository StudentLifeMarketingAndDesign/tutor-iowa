(function() {
    "use strict";

    /* variables local to the scope of this script */
    var coverBox = $(".page-bg"); 
    var baseURL = $(location).attr('href');
    var repositionCoverPhotoURL = baseURL + "/repositionCoverImage";
    var removeCoverPhotoURL = baseURL + "/removeCoverImage";
    var removeProfilePhotoURL = baseURL + "/removeProfileImage";
    var easingOptions = { duration: 600, ease: "easeInElastic" };

    // TODO: ensure image is ready before grabbing this height; 
    window.coverImageHeight = $("#profile-cover-photo-move").height();
    var pageBgMaxHeight = (parseInt($(".page-bg").first().css("maxHeight")) || 333); // this value needs to reflect .page-bg max height 

    /* this initilizes the jQuery UI draggable functionality */
    window.reposition = $("#profile-cover-photo-move").draggable({
        axis: "y",
        disabled: true,
        //containment: coverBox,
        cursor: "grabbing",
        zIndex: "0",
        grid: false,
        scrollSpeed: 100,
        drag: function(event, ui) {
            if (ui.position.top >= 0) {
                $(this).draggable.disable(); // prevents image from scrolling past containment box. 
            } 
            if (ui.position.top <= (pageBgMaxHeight - $("#profile-cover-photo-move").height())) {
                $(this).draggable.disable(); // prevents image from scrolling past containment box. 
            }
        },
        stop: function(event, ui) {
            //console.log($("#profile-cover-photo-move").position()); 
        },
        create: function(event, ui) {
            attachSaveHandler($("#repositionCoverPhoto"));
        }
    });

    function attachSaveHandler($objectToAttachHandler) {
        //console.log($objectToAttachHandler);
        $objectToAttachHandler.click( function() {
            var actionData = $(this).data("action");
            var self = this;
            console.log(actionData);
            if ($(this).data("action") == "save") {
                console.log(actionData);
                savePosition($("#profile-cover-photo-move").position(), function(){
                    $("#profile-cover-photo-move").addClass('hide');
                    $("#profile-cover-photo-move").draggable("disable");
                    $("#profile-cover-photo").show();
                    $(self).text("Reposition Cover Photo");
                    $(self).addClass("success");
                    $(self).data("action", "reposition"); // reset action
                }); 
            } else if ($(this).data("action") == "reposition" || null) {
                console.log("action: " + actionData);
                $("#profile-cover-photo").hide();
                $(".page-bg").css("overflow", "hidden");
                $("#profile-cover-photo-move").removeClass('hide');
                $("#profile-cover-photo-move").draggable("enable");
                $(this).text("Save New Position");
                $(this).data("action", "save"); // reset action
            }   
        }); 
    }

    function savePosition(positionObject, callback) {
        var top = Math.abs(positionObject.top);
        var coverHeight = $("#profile-cover-photo-move").height();
        var topPercentage = top / (coverHeight - pageBgMaxHeight);
        //console.log("top: " + topPercentage);
        $("#profile-cover-photo-move").draggable("disable");
        /* HTTP post request that saves the position of the image */
        var jqXHR = $.post(
            repositionCoverPhotoURL,
            {
                Top: topPercentage
            }, 
            function(data, textStatus, jqXHR) { 
                data = jQuery.parseJSON(data);
                var $newPosition = Number((Number(data["Top"]) * 100)).toFixed(2) + "%";
                $("#profile-cover-photo").css("background-position-y", $newPosition);
                callback();
            }).fail(function( jqXHR, status, error ) {
                console.log(status);
        });

    }

    $("#removeCoverPhoto").click(function() {
         if (confirm("This will delete your current photo. You can upload another photo.")) {
            var jqXHR = $.post(
                removeCoverPhotoURL,
                {
                    Example: "This data is sent to the controller!"               
                }, 
                function(data, textStatus, jqXHR) { 
                    //console.log(data)
                    $("#profile-cover-photo").hide(easingOptions);
                    $("#profile-cover-photo-move").hide(easingOptions);
                    $("#coverImageButtons").hide(easingOptions);
                }).fail(function( jqXHR, status, error ) {
                    console.log(status);
            });
         }
    });

    $("#removeProfilePhoto").click(function() {
        if (confirm("This will delete your current photo. You can upload another photo.")) {
            var jqXHR = $.post(
                removeProfilePhotoURL,
                {
                    Example: "This data is sent to the controller!"
                }, 
                function(data, textStatus, jqXHR) { 
                    //console.log(data);
                    $("#profileImage").hide(easingOptions);
                }).fail(function( jqXHR, status, error ) {
                    console.log(status);
            });
        }
    });



})();
