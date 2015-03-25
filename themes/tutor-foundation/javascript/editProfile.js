(function() {
    "use strict";

    var coverBox = $(".page-bg");

    // TODO: ensure image is ready before grabbing this height; 
    window.coverImageHeight = $("#profile-cover-photo").height();


    $("img#profile-cover-photo").draggable({
        axis: "y",
        //containment: coverBox,
        cursor: "grabbing",
        zIndex: "0",
        grid: false,
        scrollSpeed: 100,
        drag: function(event, ui) {
            if (ui.position.top >= 0) {
                this.disable();
            } 
            if (ui.position.top <= (300 - $("#profile-cover-photo").height())) {
                this.disable();
            }
        },
        stop: function(event, ui) {
            console.log($("#profile-cover-photo").position());
        }
    });

    function savePosition(event, ui) {
        //enter coordiantes into the EditProfileCoverForm that returns coords to use in db?
    }

})();
