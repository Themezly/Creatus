(function ($, _) {
    var isNotEmptyString = function (str) {
        if (_.isString(str)) {
            return str.trim().length;
        }
        return 0;
    }

    var init = function ($mapWrapper) {
        var $mapCanvas = $mapWrapper.find('.fw-map-canvas'),
            mapCanvasOY = isNaN(parseInt($mapWrapper.data('map-height'))) ? parseInt($mapCanvas.width() * 0.29) : parseInt($mapWrapper.data('map-height')),
            maxZoom = isNaN(parseInt($mapWrapper.data('map-zoom'))) ? 15 : parseInt($mapWrapper.data('map-zoom')),
            locations = $mapWrapper.data('locations'),
            mapType = $mapWrapper.data('map-type'),
            mapStyle = $mapWrapper.data('map-style'),
            mapPin = $mapWrapper.data('map-pin'),
			mapBg = $mapWrapper.data('map-bg'),
			mapZoomControl= $mapWrapper.data('map-zoomcontrol'),
			mapStreetViewControl= $mapWrapper.data('map-streetviewcontrol'),
			mapPanControl= $mapWrapper.data('map-pancontrol'),
			mapTypeControl= $mapWrapper.data('map-typecontrol'),
            mapOptions = {
                scrollwheel: false,
                center: ( 'undefined' !== locations && locations.length) ? calculateCenter(locations) : new google.maps.LatLng(-34, 150),
                mapTypeId: google.maps.MapTypeId[mapType],
                styles: mapStyle,
				backgroundColor:mapBg,
				zoomControl: mapZoomControl == 'show' ? true: false,
				streetViewControl:mapStreetViewControl == 'show' ? true: false,
				panControl:mapPanControl == 'show' ? true: false,
				mapTypeControl:mapTypeControl == 'show' ? true: false,
				
            },
            markerBounds = new google.maps.LatLngBounds(),
            map = new google.maps.Map($mapCanvas.get(0), mapOptions);

        if ('undefined' !== locations && locations.length) {
            locations.forEach(function (location) {
                gMapsCoords = new google.maps.LatLng(location.coordinates.lat, location.coordinates.lng);

                var marker = new google.maps.Marker({
                    position: gMapsCoords,
                    map: map,
                    icon: mapPin.url
                });

                markerBounds.extend(gMapsCoords);

                //set content InfoWindow template
                if (isNotEmptyString(location.description) || isNotEmptyString(location.title) || isNotEmptyString(location.url) || isNotEmptyString(location.thumb)) {

                    var template = _.template(
                        "<% function isNotEmptyString(str) { if (_.isString(str)) {	return str.trim().length;} return 0; }  %>" +

                        "<div class='infowindow'>" +

                        "<% if (isNotEmptyString(location.thumb)) { %>" +
                        "<div class='infowindow-thumb'>" +
                        "<img src='<%= location.thumb %>' >" +
                        "</div> " +
                        "<% } %>" +

                        "<div class='infowindow-content'>" +
                        "<% if ( isNotEmptyString(location.url) || isNotEmptyString(location.title) ) { %>" +
                        "<div class='infowindow-title'>" +
                        "<a href='<%- location.url %>'><%- isNotEmptyString(location.title) ?  location.title : location.url  %></a>" +
                        "</div>" +
                        "<% } %>" +
                        "<% if ( isNotEmptyString(location.description) ) { %>" +
                        "<div class='infowindow-description'>" +
                        "<%= location.description %>" +
                        "</div>" +
                        "<% } %>" +
                        "</div>" +

                        "</div>");

                    var infowindow = new google.maps.InfoWindow({
                        content: template({location: location}),
                    });

                    google.maps.event.addListener(marker, 'click', function () {
                        infowindow.open(map, marker);
                    });
                }

                if (jQuery('.fw-contact-form-absolute').length > 0) {
                    // for set different position of marker (default is centered)
                    google.maps.event.addListenerOnce(map, 'tilesloaded', function () {
                        map_recenter(map, locations, 0, 300);
                    });
                }
            });
        }


        //change "zoom"
        map.fitBounds(markerBounds);

        //change zoom to max zoom
        var listener = google.maps.event.addListenerOnce(map, 'zoom_changed', function () {
            if (map.getZoom() > maxZoom) map.setZoom(maxZoom);
            google.maps.event.removeListener(listener);
        });

        $mapCanvas.height(mapCanvasOY);
        $mapCanvas.data('map', map);
    }

    var calculateCenter = function (locations) {
        var Lng, Hyp, Lat,
            total = locations.length,
            X = 0,
            Y = 0,
            Z = 0;

        locations.forEach(function (location) {
            var lat = location.coordinates.lat * Math.PI / 180,
                lng = location.coordinates.lng * Math.PI / 180,
                x = Math.cos(lat) * Math.cos(lng),
                y = Math.cos(lat) * Math.sin(lng),
                z = Math.sin(lat);

            X += x;
            Y += y;
            Z += z;
        });

        X /= total;
        Y /= total;
        Z /= total;

        Lng = Math.atan2(Y, X);
        Hyp = Math.sqrt(X * X + Y * Y);
        Lat = Math.atan2(Z, Hyp);

        return {lng: (Lng * 180 / Math.PI), lat: (Lat * 180 / Math.PI)}
    }

    // for different position of marker
    function map_recenter(map, latlng, offsetx, offsety) {
        var point1 = map.getProjection().fromLatLngToPoint(
            (latlng instanceof google.maps.LatLng) ? latlng : map.getCenter()
        );
        var point2 = new google.maps.Point(
            ( (typeof(offsetx) == 'number' ? offsetx : 0) / Math.pow(2, map.getZoom()) ) || 0,
            ( (typeof(offsety) == 'number' ? offsety : 0) / Math.pow(2, map.getZoom()) ) || 0
        );
        map.setCenter(map.getProjection().fromPointToLatLng(new google.maps.Point(
            point1.x - point2.x,
            point1.y + point2.y
        )));
    }

    $(document).ready(function () {
        $('.fw-map').each(function () {
            init($(this));
        });
    });

}(jQuery, _));
