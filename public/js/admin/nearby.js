$(document).ready(function(){
    initialization() 
});

function initialization() {
    
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 5,
        center: {"lat": 39.317779, "lng": -101.459656},
        mapTypeId: 'roadmap',
      });
      map.setTilt(45);

      for(var i=0;i<locations.length;i++){
        var data=locations[i];
        var marker = new google.maps.Marker({
          position: {lat: data.lat, lng: data.lng},
          map : map
        });
        
        attachSecretMessage(marker, i);
        
      }
        
      function attachSecretMessage(marker, i) {
        var data = locations[i];
       
          secretMessage = `${data.code} 
            <br/>${data.PIN} 
            <br/><b>STOCKNO:</b>${data.No}
            <br/><b>STATUS:</b>${data.Status}`;
          
          var infowindow = new google.maps.InfoWindow({
            content: secretMessage
          });

          marker.addListener('click', function() {
            infowindow.open(marker.get('map'), marker);
          });
      }
      
      /*var markerCluster = new MarkerClusterer(map, marker,
              {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});*/

}

     
var locations = [
             
                     {
                       "No": 67000052704,
                      "PIN": "JF2FH327573",
                        "Status": "Not Available",
                       "lat": 32.8781453358752,
                       "lng": -97.3715011598119,
                       "code": "Gate6"
                     },
                     {
                       "No": 6700064837,
                       "PIN": "WBA53050",
                        "Status": "Available",
                       "lat": 34.0026085052726,
                       "lng": -83.7873632217882,
                       "code": "Gate2"
                     },
                     {
                       "No": 2000544837,
                       "PIN": "WBA53EVW530",
                        "Status": "Available",
                       "lat": 34.0026085052726,
                       "lng": -83.7873632217882,
                       "code": "Gate1"
                     }
                     ]
