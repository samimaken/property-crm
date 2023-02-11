@extends('admin.layouts.app')

@section('page_title', 'Categories')

@section('page_styles')

@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Property</h4>
                </div>
            </div>
            <div class="card-body">

                    <div class="row">
                        <div class="col-md-7 col-12 order-md-1 order-2">
                            <p class="m-0"><strong>{{$item->name}}</strong></p>
                            <div class="d-flex mt-2" style="column-gap: 1rem">
                                <span><i class="fa-regular fa-calendar-days"></i> {{$item->pma_contract_start_date}}</span>
                                <span><i class="fa-regular fa-calendar-days"></i> {{$item->pma_contract_end_date}}</span>
                            </div>
                            <div class="mt-2 d-flex flex-wrap" style="column-gap: 2rem">
                                <span><strong>AED Value: </strong> {{$item->aed_value}}</span>
                                <span><strong>Sqft Size: </strong> {{$item->sqft_size}}</span>
                                <span><strong>Private Units: </strong> {{$item->private_units}}</span>
                                <span><strong>Coworking Spaces: </strong> {{$item->coworking_spaces}}</span>
                            </div>
                            <div class="mt-2">
                                <p>Meeting Room <span class="badge {{$item->meeting_room == 1 ? 'badge-success' : 'badge-danger'}}">{{$item->meeting_room == 1 ? 'Yes' : 'No'}}</span></p>
                                <p>Conference Room <span class="badge {{$item->conference_room == 1 ? 'badge-success' : 'badge-danger'}}">{{$item->conference_room == 1 ? 'Yes' : 'No'}}</span></p>
                                <p>Fully Furnished <span class="badge {{$item->fully_furnished == 1 ? 'badge-success' : 'badge-danger'}}">{{$item->fully_furnished == 1 ? 'Yes' : 'No'}}</span></p>
                            </div>
                            <div class="mt-2">
                                <p class="m-0">PMA Agreement <a href="{{$item->pma_agreement}}" target="_blank"><i class="fa-solid fa-file-pdf"></i></a></p>
                            </div>
                            <div class="mt-2">
                                <span><i class="fa-solid fa-location-dot"></i> {{$item->location}}</span>
                            </div>
                            <div class="mt-2">
                                <p class="m-0"><strong>Address</strong></p>
                                <p class="m-0">{{$item->address}}</p>
                            </div>
                        </div>
                        <div class="col-md-5 col-12 mb-3 mt-2 order-md-2 order-1">
                            <div class="container w-100" id="map-canvas" style="height:390px;"></div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection

@section('page_scripts')
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcdMtunw36JDWfU_yL7cbqlG3ehufI-QQ&sensor=false&libraries=places&callback=initMap"></script>
<script>
    var lat = {{$item->lat != null ? $item->lat : 51.509865}}
    var lng = {{$item->lng != null ? $item->lng : -0.118092}}
     function initMap() {
   var map = new google.maps.Map(document.getElementById('map-canvas'), {
     center: {
       lat: lat,
       lng: lng
     },
     zoom: 12
   });
   @if ($item->lat != null && $item->lng != null)

   var marker = new google.maps.Marker({
                    position: new google.maps.LatLng( {{$item->lat}}, {{$item->lng}}),
                    map: map,
    });
    marker.setMap(map);

    @endif

   var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));
   map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('pac-input'));
   google.maps.event.addListener(searchBox, 'places_changed', function() {
     searchBox.set('map', null);


     var places = searchBox.getPlaces();
     var bounds = new google.maps.LatLngBounds();
     var i, place;
     for (i = 0; place = places[i]; i++) {

       (function(place) {
         var marker = new google.maps.Marker({

           position: place.geometry.location
         });
         marker.bindTo('map', searchBox, 'map');
         google.maps.event.addListener(marker, 'map_changed', function() {
           if (!this.getMap()) {
             this.unbindAll();
           }
         });
         bounds.extend(place.geometry.location);



       }(place));
        $('#lat').val(place.geometry.location.lat())
        $('#lng').val(place.geometry.location.lng())
     }
     map.fitBounds(bounds);
     searchBox.set('map', map);
     map.setZoom(Math.min(map.getZoom(),12));

   });
 }
 google.maps.event.addDomListener(window, 'load', initMap);

</script>

@endsection
