;
(function ($) {

	var map;
	var markers;
	//console.log(myajax.template_url);
	var iconUrl = myajax.template_url+'/images/';
	var icons = {
		industrial: {
			icon: iconUrl + 'map-red.png'
		},
		land: {
			icon: iconUrl + 'map-yellow.png'
		},
		office: {
			icon: iconUrl + 'map-dark.png'
		},
		retail: {
			icon: iconUrl + 'map-blue.png'
		},
		empty: {
			icon: iconUrl + 'map-red.png'
		}
	};

	function new_map( $el ) {
		// var
		markers = $el.find('.marker');
		var originalMapCenter = new google.maps.LatLng(40.526129, -74.337690);
		// vars
		var args = {
			center		: originalMapCenter,
			mapTypeId	: google.maps.MapTypeId.ROADMAP,
			scaleControl: true,
			scrollwheel: false
		};
		// create map
		map = new google.maps.Map( $el[0], args);
		// add a markers reference
		map.markers = [];
		// add markers
		markers.each(function(){
			add_marker( $(this), map, $(this).attr('data-type') );
		});
		center_map( map );

		google.maps.event.addListenerOnce(map, 'idle', function(){
			google.maps.event.trigger(map, 'resize');
			$('.acf-map-container').addClass('ready');
			center_map(map);
		});

		return map;
	}

	function add_marker( $marker, map, icon_type ) {
		// var
		var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
		// create marker
		var marker = new google.maps.Marker({
			position	: latlng,
			map			: map,
			icon        : icons[icon_type].icon
		});
		// add to array
		map.markers.push( marker );
		// if marker contains HTML, add it to an infoWindow
		if( $marker.html() ) {
			var infowindow = new google.maps.InfoWindow({
				content		: $marker.html()
			});
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open( map, marker );
			});
		}
	}

	function center_map( map ) {
		var bounds = new google.maps.LatLngBounds();
		$.each( map.markers, function( i, marker ){
			var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
			bounds.extend( latlng );
		});
		// only 1 marker?
		if( map.markers.length == 1 ) {
			// set center of map
			map.setCenter( bounds.getCenter() );
		} else {
			//map.setCenter( 40.0583,74.4057 );
			//console.log(bounds);
			//map.fitBounds( bounds );
			bounds.getCenter();
		}
		map.setZoom( 9 );
	}
	// global var
	var map = null;

	function setMapOnAll(map) {
		for (var i = 0; i < $markers.length; i++) {
			$markers[i].setMap(map);
		}
	}

	function clearMarkers() {
		setMapOnAll(null);
	}

	// Sticky Footer
	var bumpIt = function() {
			//$('body').css('padding-bottom', $('.footer').outerHeight(true));
			$('.footer').addClass('sticky-footer');
		},
		didResize = false;

	$(window).resize(function() {
		didResize = true;
	});
	setInterval(function() {
		if(didResize) {
			didResize = false;
			bumpIt();
		}
	}, 250);


	// Scripts which runs after DOM load

	$(document).ready(function () {
		//smooth scroll
		$('a[href^="#"]').on('click',function (e) {
			if($(this).hasClass('map_it')){
				e.preventDefault();
				var target = this.hash;
				var $target = $(target);

				$('html, body').stop().animate({
					'scrollTop': $target.offset().top
				}, 900, 'swing', function () {
					window.location.hash = target;
				});
			}
		});
		//acf map
		$('.acf-map').each(function(){
			map = new_map( $(this) );
		});
		//sliders
		$('.updates').slick({
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: false,
			arrows : true,
			nextArrow: '.updates-next',
			prevArrow: '.updates-prev'
		});

		$('.news-slider').slick({
			infinite: true,
			slidesToShow: 4,
			slidesToScroll: 4,
			dots: false,
			arrows : true,
			nextArrow: '.news-next',
			prevArrow: '.news-prev',
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				},
				{
					breakpoint: 640,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]
		});
		$('.news-big-slider').slick({
			infinite: true,
			slidesPerRow: 4,
			rows: 2,
			dots: false,
			arrows : true,
			nextArrow: '.news-next',
			prevArrow: '.news-prev',
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesPerRow: 2
					}
				},
				{
					breakpoint: 640,
					settings: {
						slidesPerRow: 1
					}
				}
			]
		});

		$('.funnel-slider').slick({
			infinite: false,
			slidesToShow: 4,
			slidesToScroll: 4,
			dots: false,
			arrows : true,
			nextArrow: '.funnel-next',
			prevArrow: '.funnel-prev',
			vertical : true,
			verticalSwiping : true,
			adaptiveHeight: true
		});

		$('.global-slider').slick({
			infinite: false,
			slidesToShow: 4,
			slidesToScroll: 4,
			dots: true,
			arrows : false,
			vertical : true,
			verticalSwiping : true
		});

		$('.property-big-slider').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: false,
			arrows : true,
			fade: true,
			nextArrow: '.property-next',
			prevArrow: '.property-prev',
			asNavFor: '.property-small-slider'
		});

		$('.property-small-slider').slick({
			slidesToShow: 5,
			slidesToScroll: 5,
			dots: false,
			arrows : false,
			asNavFor: '.property-big-slider',
			focusOnSelect: true,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 4
					}
				},
				{
					breakpoint: 640,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3
					}
				}
			]
		});

		//acf map it property
		$(document).on('click','.map_it',function(){
			var lat = $(this).attr('data-lat'),
				lon = $(this).attr('data-lon'),
				type = $(this).attr('data-type');
			while(map.markers.length) {
				map.markers.pop().setMap(null);
			}
			var latlng = new google.maps.LatLng( lat, lon );
			// create marker
			var marker = new google.maps.Marker({
				position	: latlng,
				map			: map,
				icon        : icons[type].icon
			});
			map.markers.push( marker );
			map.panTo(marker.getPosition());
			map.setZoom(9);
		});

		//filter properties
		function filter_properties(paged){
			var status = [],
				pr_type = [];
			$('input:radio:checked.property_status').map(function () {
				return status.push(this.value ? $(this).attr('id') : '0');
			}).get();
			// check if we need filters
			$('input:checkbox:checked.property_type').map(function () {
				return pr_type.push(this.value ? $(this).attr('name') : '0');
			}).get();
			var country = $('.property-country').val(),
				city = $('.property-city').val(),
				data = {
					action: 'properties',
					status: status,
					pr_type: pr_type,
					country: country,
					city: city,
					cur_page: +paged
				};
			$.ajax({
				type: "POST",
				dataType: 'html',
				data: data,
				url: myajax.url,
				success: function (res) {
					//display properties
					if( res.length > 100 ){
						$('.properties').html('').html(res);
						$('.matchHeight').matchHeight();
						//display filtered properties on map
						refresh_markers();
					} else{
						$('.properties').html('').html('<h3 class="no-results">No properties match your search criteria. Please try a new search.</h3>');
					}
					//scroll to top
					$('html, body').stop().animate({
						'scrollTop': $("#single-property").offset().top
					}, 900, 'swing', function () {
						window.location.hash = '#single-property';
					});
				},
				error: function () {
					console.log('Something Goes Wrong...');
				}
			});
		}


		$(document).on('click','.property_status',function(){
			localStorage.setItem("status", $(this).attr('id'));
			$('.property_status_submit').click();
		});

		//clear storage when click to properties menu item
		$(document).on('click','.pr-page a',function(){
			localStorage.setItem("status", "active");
			localStorage.setItem("type", "");
			//localStorage.setItem("type", "industrial,land,office,retail");
		});

		//insert values to local storage
		function storage_params(pr_type,country,city){
			localStorage.setItem("type", pr_type);
			//if(country == undefined){
			//	country = 0;
			//}
			//if(city == undefined){
			//	city = 0;
			//}
			//localStorage.setItem("country", country);
			//localStorage.setItem("city", city);
		}

		//update markers on map
		function refresh_markers(){
			var filtered_markers = [];
			$('.map_it').map(function () {
				if( $(this).parents('.property').is(":visible") ){
					var one_marker = [
						$(this).attr('data-lat'),
						$(this).attr('data-lon'),$(this).attr('data-type'),
						$(this).attr('data-address'),
						$(this).attr('data-city'),
						$(this).attr('data-country'),
						$(this).attr('data-link')
					];
					return filtered_markers.push(one_marker);
				}
			}).get();
			if( filtered_markers ){
				while(map.markers.length) {
					map.markers.pop().setMap(null);
				}
				filtered_markers.forEach(setMarker);
				function setMarker(item, index) {
					var latlng = new google.maps.LatLng( item[0], item[1] );
					// create marker
					var marker = new google.maps.Marker({
						position	: latlng,
						map			: map,
						icon        : icons[item[2]].icon
					});
					map.markers.push( marker );
					var infowindow = new google.maps.InfoWindow({
						content		: '<h6>'+item[3]+'</h6><h6>'+item[4]+', '+item[5]+'</h6><a class="acf-map-link" href="'+item[6]+'" >Click here for more details</a>'
					});
					google.maps.event.addListener(marker, 'click', function() {
						infowindow.open( map, marker );
					});
					center_map(map);
				}
			}
		}

		//filter page DOM properties
		function page_filter(pr_type,country,city){
			var one_check = true,
				visible_counter = 0;
			$(".property").each(function () {
				$one_property = $(this);
				//check for type
				if(pr_type){
					var one_type = $one_property.find('.map_it').attr('data-type');
					if(jQuery.inArray(one_type, pr_type) == -1){
						one_check = false;
					} else{
						one_check = true;
					}
				}
				//check for country
				if( +country != 0 && country != undefined ){
					var one_country = $one_property.find('.map_it').attr('data-country');
					if(one_country != country){
						one_check = false;
					}
				}
				//check for city
				if( +city != 0 && city != undefined ){
					var one_city = $one_property.find('.map_it').attr('data-city');
					if(one_city != city){
						one_check = false;
					}
				}
				//show or hide property on page
				if(one_check){
					$one_property.show();
					visible_counter++;
					$one_property.matchHeight();
				} else{
					$one_property.hide();
				}
				//if($one_property.is(":visible"))
			});

			//refresh matchHeight and no results block
			if( visible_counter == 0 ){
				$('.no-results').show();
				$('.properties-pagination').hide();
			} else{
				$('.no-results').hide();
				$('.properties-pagination').show();
			}
			refresh_markers();
			$('.matchHeight').matchHeight();
		}

		function check_checkboxex(load){
			var check_status,
				check_type =[],
				check_country,
				check_city;
			//check for storage if page load
			if( load ){
				check_status = localStorage.getItem("status");
				check_type = localStorage.getItem("type");
				//check_country = localStorage.getItem("country");
				//check_city = localStorage.getItem("city");
				if(check_status) {
					$('.property_status').removeAttr('checked');
					$('#'+check_status).prop('checked', true);
				} else{
					$('#active').prop('checked', true);
				}
				if(check_type) {
					check_type = check_type.split(",");
					$('.property_type').removeAttr('checked');
					check_type.forEach(function (item) {
						$('#'+item).prop('checked', true);
					});
				} else{
					$('.property_type').each(function () {
						$(this).prop('checked', true);
					});
				}
				$('.property-country').val('0');
				$('.property-city').val('0');

				//if(check_country){
				//	$('.property-country').val(check_country);
				//}
				//if(check_city){
				//	$('.property-city').val(check_city);
				//}
			} else {
				$('input:checkbox:checked.property_type').map(function () {
					return check_type.push(this.value ? $(this).attr('name') : '0');
				}).get();
				check_country = $('.property-country').val();
				check_city = $('.property-city').val();
			}
			//update storage and filter properties on page
			storage_params(check_type,check_country,check_city);
			page_filter(check_type,check_country,check_city);
		}

		//if we are on properties page run filters
		if( $('.properties').length ){
			check_checkboxex(1);
		}
		//filter properties
		$(document).on('click','.filter-properties',function(){
			check_checkboxex(0);
		});
		$(document).on('change', '.filter-select', function() {
			check_checkboxex(0);
		});
		//$(document).on('click', '.properties-pagination a.pagination', function(e){
		//	e.preventDefault();
		//	var paged = $(this).html();
		//	filter_properties(paged);
		//});
		////properties pagination
		//$('.properties-pagination a.pagination').click(function(e){
		//	e.preventDefault();
		//	var paged = $(this).html();
		//	filter_properties(paged);
		//});


		//$('.sign_up_widget .gform_footer .button').attr('value','>');

		//Remove placeholder on click
		$("input,textarea").each(function () {
			$(this).data('holder', $(this).attr('placeholder'));

			$(this).focusin(function () {
				$(this).attr('placeholder', '');
			});

			$(this).focusout(function () {
				$(this).attr('placeholder', $(this).data('holder'));
			});
		});

		//Make elements equal height
		$('.matchHeight').matchHeight();
		$('.submenu li').matchHeight();


		// Add fancybox to images
		$('.gallery-item a').attr('rel', 'gallery');
		$('a[rel*="album"], .gallery-item a, .fancybox,  a[href$="jpg"], a[href$="png"], a[href$="gif"]').fancybox({
			minHeight: 0,
			helpers: {
				overlay: {
					locked: false
				}
			}
		});

		$('a.iframe').on('click', function(event) {
			event.preventDefault();
			$.fancybox({
				'type' : 'iframe',
				'href' : this.href.replace(new RegExp('watch\\?v=', 'i'), 'embed/') + '?rel=0&autoplay=1',
				'overlayShow' : true,
				'centerOnScroll' : true,
				'speedIn' : 100,
				'speedOut' : 50
			});
		});

		// Sticky footer
		bumpIt();


	});


	// Scripts which runs after all elements load

	$(window).load(function () {

		//jQuery code goes here


	});

	// Scripts which runs at window resize

	$(window).resize(function () {

		//jQuery code goes here


	});

}(jQuery));
