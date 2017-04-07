jQuery(document).ready(function($) {
	/**
	 * Init colorpicker
	 *
	 * @since 0.1
	 */
	$('#owm-color').wpColorPicker();
	$('#owm-font-color').wpColorPicker();
	$('#owm-icons-color').wpColorPicker();
	$('#owm-bg-color').wpColorPicker();
	$('#owm-border-color').wpColorPicker();

	/**
	 * Init Google Maps
	 *
	 * @since 0.1
	 */
	if ($('#owm-city').length) {
		var map;
		var marker;

		google.maps.event.addDomListener(window, 'load', initialize);

		function initialize() {
			var mapProp = {
				center: new google.maps.LatLng(14.777667, -17.260091),
				zoom: 2
			};

			map = new google.maps.Map(document.getElementById("owm-city"), mapProp);
			if ($('form#owm-font-icons input#owm-city-lat').val().length || $('form#owm-font-icons input#owm-city-lng').val().length) {
				var location = new google.maps.LatLng($('form#owm-font-icons input#owm-city-lat').val(), $('form#owm-font-icons input#owm-city-lng').val());
				var marker = new google.maps.Marker({
					position: location,
					map: map,
				});
				map.setZoom(7);
				map.setCenter(location);
			}
			google.maps.event.addListener(map, 'click', function(event) {
				if (marker) marker.setMap(null);
				placeMarker(event.latLng);
			});
		}


		function placeMarker(location) {
			if (!marker || !marker.setPosition) {
				marker = new google.maps.Marker({
					position: location,
					map: map,
				});
			} else {
				marker.setPosition(location);
			}
			map.setZoom(7);
			map.setCenter(location);
			$('input#owm-city-lat').val((location.lat()).toFixed(2));
			$('input#owm-city-lng').val((location.lng()).toFixed(2));
			$('form#owm-font-icons p.error').remove();
		}
	}

	/**
	 * Form validation
	 *
	 * @since 0.1
	 */
	$(document).on('click', 'form#owm-font-icons input[type="submit"]', function(e) {
		e.preventDefault();
		var formValid = true;
		var form = $(this).closest('form');
		if (form.find('input#owm-title').val().length === 0) {
			formValid = false;
			form.find('input#owm-title').addClass('error');
			form.find('input#owm-title').attr("placeholder", form.find('input#owm-title').data('msg'));
		}
		if (form.find('input#owm-city-lat').val().length === 0 || form.find('input#owm-city-lng').val().length === 0) {
			formValid = false;
			if ($('form#owm-font-icons p.error').length === 0) {
				$('<p class="error">' + form.find('#owm-city').data('msg') + '</p>').insertBefore(form.find('#owm-city'));
			}
		}
		if (formValid == true) {
			form.submit();
		} else {
			$('html, body').animate({
				scrollTop: $("h1").offset().top
			}, 200);
		}
	});

	$('form#owm-font-icons input').focus(function() {
		if ($(this).hasClass('error')) {
			$(this).removeClass('error');
			$(this).attr("placeholder", "");
		}
	});

	/**
	 * Confirm remove element
	 *
	 * @since 0.1
	 */
	$(document).on('click', 'table#owm-font-icons-informers .trash a', function(e) {
		return window.confirm("Are you sure?");
	});
});
