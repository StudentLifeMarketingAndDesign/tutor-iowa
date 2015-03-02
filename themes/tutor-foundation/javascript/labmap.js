if (typeof google !== "undefined") {

	/* Global Variables */
	var markerArray = [];
	var infowindow = new google.maps.InfoWindow({
		content: "holding...",
		maxWidth: 310
		});	
	var iowaCity = new google.maps.LatLng(41.661736, -91.540017);
	//var venueCount = $("#venuesWithEvents section").length;
	//var countVenue = 0;
	var venueFromUser = {};
	var userInitPosition;

	/* Helper Functions */

	function handleNoGeolocation(errorFlag) {   	
		var userInitPosition = iowaCity;
	    $('#status').text("Your location couldn't be detected. Showing events in Iowa City.");
	    return userInitPosition;
	}  

	function findLab(callback) {
		var address = $("#address").text();
		var venueLatLng;
		console.log(address);
		
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode( {'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
			//Geocoder returns array of information, first indice is lat/lng
			venueLatLng = results[0].geometry.location;
			callback(venueLatLng);
			} else {
				console.log('geocoder failed');
			}				
		});
	}

	function genMapCanvas(lab) {
		// generates map styles, objects, DOM objects

	    var mapcanvas = document.createElement('div');	
		 mapcanvas.id = 'mapcanvas';
		 //mapcanvas.class = 'map-canvas';
		 mapcanvas.style.width = '100%';	
		 mapcanvas.style.height = '300px';
		$('#labmap').append(mapcanvas);

		//var findCenter = findLab();
		console.log(lab);
		//new google.maps.LatLng(41.661736, -91.540017);
	 
		//afterclassMap styles located in MapStyles.js
		//var afterclassMap = new google.maps.StyledMapType(styles, {name: "AfterClass Style Map"});
		var MapOptions = {
		    zoom: 17,
		    center: lab,
		    panControl: false,
		    zoomControl: true,
		    scrollwheel:false,
		    scaleControl: false,
		    mapTypeControl: false,
		    navigationControlOptions: {style: google.maps.NavigationControlStyle.HORIZONTAL_BAR, 
			    position: google.maps.ControlPosition.RIGHT_BOTTOM
		    },
		    disableDefaultUI: false,
		    mapTypeId: google.maps.MapTypeId.ROADMAP,
		    streetViewControl: true
		};

		var map = new google.maps.Map(document.getElementById("mapcanvas"), MapOptions);
		 //map.mapTypes.set('map_style', afterclassMap);
		 //map.setMapTypeId('map_style');
		
		//getInitLocal();
		
		var marker = new google.maps.Marker({
			position: lab,
			map: map
		});	
	}

	$(window).load(function() {
		if( $("#labmap").length ){
			//var lab = findLab();
			//genMapCanvas(lab);
			findLab(genMapCanvas);
		}
	});
}
