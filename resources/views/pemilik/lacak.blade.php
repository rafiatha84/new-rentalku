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
  let surabaya,kendaraan,nopol;
  surabaya = { lat: -7.2974336, lng: 112.7448576 };
  address = "Jl. Surabaya";
  kendaraan = "{{ $kendaraan->name }}";
  nopol = "{{ $kendaraan->nopol }}";
  let contentString =
  `<div id="content">
  <div id="siteNotice">
  </div>
  <h5 id="firstHeading" class="firstHeading">${kendaraan}</h5>
  <div id="bodyContent">
  <p>Plat Nomor: ${nopol}</p>
  <p>Alamat saat ini: </p>
  ${address}
  </div>
  </div>`;
  function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }
  function marker_change(){
    myVar = setInterval(change, 10000);
  }
  function change(){
    $.ajax({
        url: "https://api.orin.id/api/orin/device/355087090163914",
        type: "GET", //send it through get method
        headers:{
          "Authorization": "orin e8J8yKH1TgaJdmqIWOHG9NHf2itMLIFaLyLncn2WSdDU1nYw"
        },
        success: function(response, textStatus, xhr) {
            // console.log(xhr.status);
            // console.log(response);
            // console.log(response['data']['last_data']['lat']);
            // console.log(response['data']['last_data']['lng']);
            surabaya['lat'] = parseFloat(response['data']['last_data']['lat']);
            surabaya['lng'] = parseFloat(response['data']['last_data']['lng']);
            map.setCenter(surabaya);
            marker.setPosition(surabaya);
            change_address(surabaya['lat'],surabaya['lng']);
            infoWindow.setContent(contentString);
        },
        error: function(xhr) {
            // alert('error');
            // console.log(xhr);
            if(xhr.status === 429){
              sleep(60000);
            }
            //Do Something to handle error
        }
    });
  }

  function change_address(lat,long){
    link = "https://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+long+"&key=AIzaSyCY3pxEXVMMycamj5ImFQW2D2yhfZ2eR3A";
    $.get(link,function(data){
      address = data['results'][0]['formatted_address'];
      contentString =`
      <div id="content">
        <div id="siteNotice">
        </div>
        <h5 id="firstHeading" class="firstHeading">${kendaraan}</h5>
        <div id="bodyContent">
          <p>Plat Nomor: ${nopol}</p>
          <p>Alamat saat ini: </p>
          ${data['results'][0]['formatted_address']}
        </div>
      </div>`;
    });
  }
  $(document).ready(function(){
    marker_change();
    change();
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
      title: "{{ $kendaraan->name }}",
    });
    marker.addListener("click", () => {
      infoWindow.open({
        anchor: marker,
        map,
        shouldFocus: false,
      });
    });
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
