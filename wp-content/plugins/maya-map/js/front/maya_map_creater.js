var marker=[];
var content=[];
function initMap(all) {
     var latLng = new google.maps.LatLng(parseFloat(maya_maps_plugin_vars.map_glob_center_lat), parseFloat(maya_maps_plugin_vars.map_glob_center_long));
     var homeLatLng = new google.maps.LatLng(parseFloat(maya_maps_plugin_vars.map_glob_center_lat), parseFloat(maya_maps_plugin_vars.map_glob_center_long));

     var map = new google.maps.Map(document.getElementById('maya_map_canvas'), {
       zoom: parseInt(maya_maps_plugin_vars.map_set_zoom),
       center: latLng,
       mapTypeId: google.maps.MapTypeId.ROADMAP
     });
     for (var i in all) {
	 var name 	= all[i][0];
            var address = all[i][1];
            var city 	= all[i][2];
            var state 	= all[i][3];
            var zip 	= all[i][4];
            var lat 	= all[i][5];
            var lng 	= all[i][6];
	    var label   =all[i][7];
	    var iconImg=(all[i][8]) ? all[i][8] : maya_maps_plugin_vars.map_marker_image;
	    
	  marker[i] = new MarkerWithLabel({
	  position: new google.maps.LatLng(lat,lng),
	  draggable: false,
	  raiseOnDrag: true,
	  map: map,
	  labelContent: label,
	  labelAnchor: new google.maps.Point(22, 0),
	  labelClass: "maya_map_marker_labels", // the CSS class for the label
	  labelStyle: {opacity: 1.0},
	  icon: iconImg, 
	});
     content[i] = '<div class="map-content"><h3>' + name + '</h3>' + address + '<br />' + city + ', ' + state + ' ' + zip + '<br /><a href="http://maps.google.com/?daddr=' + address + ' ' + city + ', ' + state + ' ' + zip + '" target="_blank">Get Directions</a></div>';
	
     }
    
     var infowindow = new google.maps.InfoWindow();
     for (var a=0;a<marker.length;  a++) {
     google.maps.event.addListener(marker[a], 'click', (function(marker, a) {
        return function() {
          infowindow.setContent(content[a]);
          infowindow.open(map, marker[a]);
        }
      })(marker, a));
     }
     

   }
        
   jQuery(document).ready(function(){
          jQuery('#maya_map_categories .maya_map_category').first().addClass('current');
          
          loadMapCategory(jQuery('#maya_map_categories .maya_map_category').first());
          
        jQuery('#maya_map_categories .maya_map_category').click(function(){
           loadMapCategory(jQuery(this));
          
      });
        
    });
      
      
      function loadMapCategory(obj){
          var category_name=jQuery(obj).attr('rel');
           jQuery('#maya_map_categories .maya_map_category').removeClass('current');  
          jQuery(obj).addClass('current');
      
             jQuery.ajax({     
                              url: maya_maps_plugin_vars.map_creater_url,
                              type: "POST",
                              data:  {
                              category_name : category_name,
                              },
                              success: function(result) {
				 jQuery('#maya_map_canvas').fadeIn(400);
                                  if (!(result==='no-location')) {
                                 // console.log(jQuery.parseJSON(result));
                                         initMap(jQuery.parseJSON(result)); 
                                  }else{
				     initMap(); 
                                  }
                             },
                             error:function(){
                              // console.log('err');
                             },
                             complete: function(){
                                 
                             }
                    });//end ajax request

      }