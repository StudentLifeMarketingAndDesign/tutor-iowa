(function() {
    /* UNCOMMENT TO ENABLE COVER/PROFILE IMAGE EDITING */
   /* 
    
   "use strict";

    removeCoverPhotoURL

    var coverBox = $(".page-bg"); 
    var baseURL = $(location).attr('href');
    var repositionCoverPhotoURL = baseURL + "/repositionCoverImage";
    var removeCoverPhotoURL = baseURL + "/removeCoverImage";
    var removeProfilePhotoURL = baseURL + "/removeProfileImage";

    // TODO: ensure image is ready before grabbing this height; 
    window.coverImageHeight = $("#profile-cover-photo-move").height();

    var pageBgMaxHeight = 333;

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
                $(this).draggable.disable();
            } 
            if (ui.position.top <= (pageBgMaxHeight - $("#profile-cover-photo-move").height())) {
                $(this).draggable.disable();
            }
        },
        stop: function(event, ui) {
            console.log($("#profile-cover-photo-move").position()); 
        },
        create: function(event, ui) {
            $("#repositionCoverPhoto").click( function () {
                $("#profile-cover-photo").hide();
                $(".page-bg").css("overflow", "hidden");
                $("#profile-cover-photo-move").removeClass('hide');
                $("#profile-cover-photo-move").draggable("enable");
                $(this).text("Save New Position");
                $(this).click( function () {
                    savePosition($("#profile-cover-photo-move").position());
                    $("#profile-cover-photo-move").addClass('hide');
                    $("#profile-cover-photo-move").draggable("disable");
                    $("#profile-cover-photo").show();
                });
                console.log('begin moving!');
            });
        }
    });


    function savePosition(positionObject) {
        var top = Math.abs(positionObject.top);
        var coverHeight = $("#profile-cover-photo-move").height();
        var topPercentage = top / (coverHeight - pageBgMaxHeight);
        console.log(coverHeight);
        console.log(topPercentage);
        console.log(pageBgMaxHeight);

        console.log(top);
        $("#profile-cover-photo-move").draggable("disable");
            var jqXHR = $.post(
                repositionCoverPhotoURL,
                {
                    Top: topPercentage
                }, 
                function(data, textStatus, jqXHR) { 
                    console.log(data)
                    //updateDOM(message, "markAsRead");
                }).fail(function( jqXHR, status, error ) {
                    console.log(status);
            });

    }

    $("#removeCoverPhoto").click(function() {
         var jqXHR = $.post(
                removeCoverPhotoURL,
                {
                    Test: "test"
                }, 
                function(data, textStatus, jqXHR) { 
                    console.log(data)
                    //updateDOM(message, "markAsRead");
                }).fail(function( jqXHR, status, error ) {
                    console.log(status);
            });
    });

    $("#removeProfilePhoto").click(function() {
         var jqXHR = $.post(
                removeProfilePhotoURL,
                {
                    Test: "test"
                }, 
                function(data, textStatus, jqXHR) { 
                    console.log(data)
                    //updateDOM(message, "markAsRead");
                }).fail(function( jqXHR, status, error ) {
                    console.log(status);
            });
    });

*/

})();
