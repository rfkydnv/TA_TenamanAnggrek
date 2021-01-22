(function(window){
    /**
     * PsMaps Library Made by Eric Ariyanto <mail@ericariyanto.com>
     */
    'use strict';
    function define_PsMaps(){
        var PsMaps = {};
        var about = {            
            name    : 'Eric Ariyanto',
            email   : 'mail@ericariyanto.com',
            version : 1.0,
            createDate : '2017-10-11',
            lastUpdate : '2017-10-11'
        };
        // default variable
        // default variable
        PsMaps.gmapsjs       = null;
        PsMaps.maps         = null;
        PsMaps.mapsOptions  = {
            div: '#psmaps',
            lat : 0.120777,
            lng : 110.5916657,
            mapTypeId: google.maps.MapTypeId.ROADMAP,            
            zoomControl: true,
            zoom: 17,
            // minZoom : 6,
            zoomControl: true,
            zoomControlOptions: {
                position: google.maps.ControlPosition.TOP_RIGHT
            },
            mapTypeControl: true,
            mapTypeControlOptions: {
                position: google.maps.ControlPosition.TOP_RIGHT,
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain', 'styled_map']
            },
            fullscreenControl : true,
            fullscreenControlOptions: {
                position: google.maps.ControlPosition.TOP_RIGHT
            },
            streetViewControl : false
        };

        // init maps with gmapsjs
        PsMaps.init = function(options) {
            // override default options
            if ( options !== undefined ) {
                if (typeof options === 'object') {
                    var settings = $.extend(true, PsMaps.mapsOptions, options); 
                    PsMaps.mapsOptions = settings;   
                }                
            }

            // init gmaps js with options
            PsMaps.setGmapsjs(PsMaps.mapsOptions);
            // init infowindows
            PsMaps.infoWindow = new google.maps.InfoWindow({
                content : '- no description found -'
            });

            return PsMaps;
        }

        // setter gmapsjs
        PsMaps.setGmapsjs = function(options) {
            PsMaps.gmapsjs = new GMaps(options);
            PsMaps.maps = PsMaps.gmapsjs.map;

            // init event on maps
            google.maps.event.addListener(PsMaps.maps, 'bounds_changed', function() {
                PsMaps.setViewable();
            });
            google.maps.event.addListener(PsMaps.maps, 'tilesloaded', function() {
                PsMaps.setViewable();
            });
        }

        PsMaps.onReady = function(callback) {
            google.maps.event.addListener(PsMaps.maps, 'tilesloaded', callback);   
        }

        PsMaps.onClick = function(callback) {
            google.maps.event.addListener(PsMaps.maps, 'click', callback);   
        }

        PsMaps.onIdle = function(callback) {
            google.maps.event.addListener(PsMaps.maps, 'idle', callback);   
        }

        // set viewable maps area
        PsMaps.setViewable = function() {
            PsMaps.mapsBounds = PsMaps.maps.getBounds();
            PsMaps.mapsCenter = PsMaps.maps.getCenter();

            if ( PsMaps.mapsBounds && PsMaps.mapsCenter ) {
                var ne              = PsMaps.mapsBounds.getNorthEast();
                PsMaps.mapsRadius   = google.maps.geometry.spherical.computeDistanceBetween(PsMaps.mapsCenter, ne);                    
            }
        }

        // getter gmapsjs
        PsMaps.getGmapsjs = function() {
            return PsMaps.gmapsjs;
        }

        // getter maps
        PsMaps.getMaps = function() {
            return PsMaps.maps;
        }

        // setter maps radius
        PsMaps.setMapsRadius = function(radius) {
            PsMaps.mapsRadius = radius;
        }

        // getter maps radius
        PsMaps.getMapsRadius = function() {
            return PsMaps.mapsRadius;
        }

        return PsMaps;
    }
    //define globally if it doesn't already exist
    if(typeof(PsMaps) === 'undefined'){
        window.PsMaps = define_PsMaps();
    }
    else{
        console.log("PsMaps already defined.");
    }
})(window);