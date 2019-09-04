var map;
$(document).ready(function(){
    geoLocationInit();
    function geoLocationInit(){
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(success,fail);
        }else{
            alert('Browser not support!');
        }
    }

    function success(position){ 
    
        var latval=position.coords.latitude;
        var lngval=position.coords.longitude;
        console.log(latval);
        console.log(lngval);
        var myLatLng=new google.maps.LatLng(latval,lngval);
        createMap(myLatLng);
    }

    function fail(position){
        alert('Fail');
    }

    function createMap(myLatLng){
        map=new google.maps.Map(document.getElementById('map'));
        center:myLatLng;
        zoom:12;

        var marker=new google.maps.Marker({
            position:myLatLng,
            map:map
            
        });
    }

    function createMarker(latlng, icn,name){
        var marker=new google.maps.Marker({
            position:latlng,
            map:map,
            icon:icn
        })
    }

    function nearBySearch(myLatLng,type){
        var request={
            location:myLatLng,
            radius:'2500',
            type:['school']
        };
        service=new google.maps.places.PlaceService(map);
        service.nearBySearch(request,callback);

        function callback(results,status){
            if(status ==google.maps.places.PlaceServiceStatus.OK){
                for(var i=0;i< results.length; i++){
                    var place=results[i];
                    console.log(place);

                    latlng=place.geometry.location;
                    name=place.name;
                    createMarker(latlng, icn,name);
                }
                
            }
        }
    }
});