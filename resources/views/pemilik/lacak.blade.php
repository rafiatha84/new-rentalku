@extends('user.layouts.pemilik')
<link href="{{ asset('css/user/lacak.css') }}" rel="stylesheet">
@section('css')

@endsection

@section('content')
<div id="map"></div>
@endsection

@section('js') 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCY3pxEXVMMycamj5ImFQW2D2yhfZ2eR3A&callback=initMap&v=weekly" async></script>
<script>
    let map, infoWindow, marker, address;
    let surabaya;
    surabaya = { lat: -7.2974336, lng: 112.7448576 };
    address = "Jl. Surabaya";
    let contentString =
    '<div id="content">' +
    '<div id="siteNotice">' +
    "</div>" +
    '<h5 id="firstHeading" class="firstHeading">Avanza Veloz</h5>' +
    '<div id="bodyContent">' +
    "<p>Plat Nomor: L 8979 RX</p>"+
    "<p>Alamat saat ini: </p>"+
    address+
    "</div>" +
    "</div>";
function marker_change(){
  myVar = setInterval(change, 500);
}
function change(){
  surabaya['lat'] += 0.00010;
  surabaya['lng'] -= 0.00010;
  map.setCenter(surabaya);
  marker.setPosition(surabaya);
  change_address(surabaya['lat'],surabaya['lng']);
  infoWindow.setContent(contentString);
}

function change_address(lat,long){
  link = "https://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+long+"&key=AIzaSyCY3pxEXVMMycamj5ImFQW2D2yhfZ2eR3A";
  $.get(link,function(data){
     address = data['results'][0]['formatted_address'];
     contentString =
    '<div id="content">' +
    '<div id="siteNotice">' +
    "</div>" +
    '<h5 id="firstHeading" class="firstHeading">Avanza Veloz</h5>' +
    '<div id="bodyContent">' +
    "<p>Plat Nomor: L 8979 RX</p>"+
    "<p>Alamat saat ini: </p>"+
    data['results'][0]['formatted_address']+
    "</div>" +
    "</div>";
  });
}
$(document).ready(function(){
  marker_change();
});
function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -7.2974336, lng: 112.7448576 },
    zoom: 12,
  });
  const image = "{{ asset('image/car-icon-maps.png') }}";
  infoWindow = new google.maps.InfoWindow({
    content: contentString,
  });
  marker = new google.maps.Marker({
    position: surabaya,
    map,
    icon: image,
    title: "L 6767 gh",
  });
  marker.addListener("click", () => {
    infoWindow.open({
      anchor: marker,
      map,
      shouldFocus: false,
    });
  });

  // const locationButton = document.createElement("button");

  // locationButton.textContent = "Pan to Current Location";
  // locationButton.classList.add("custom-map-control-button");
  // map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
  // locationButton.addEventListener("click", () => {
  //   // Try HTML5 geolocation.
  //   if (navigator.geolocation) {
  //     navigator.geolocation.getCurrentPosition(
  //       (position) => {
  //         const pos = {
  //           lat: position.coords.latitude,
  //           lng: position.coords.longitude,
  //         };

  //         infoWindow.setPosition(pos);
  //         infoWindow.setContent("Kendaraan L 7679 RY");
  //         infoWindow.open(map);
  //         map.setCenter(pos);
  //       },
  //       () => {
  //         handleLocationError(true, infoWindow, map.getCenter());
  //       }
  //     );
  //   } else {
  //     // Browser doesn't support Geolocation
  //     handleLocationError(false, infoWindow, map.getCenter());
  //   }
  // });
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation."
  );
  infoWindow.open(map);
}
</script>
@endsection
