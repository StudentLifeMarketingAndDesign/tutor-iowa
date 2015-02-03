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
