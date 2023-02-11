@extends('admin.layouts.app')

@section('page_title', 'Categories')

@section('page_styles')

@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{ $item->id ? 'Edit' : 'Create' }} Property</h4>
                </div>
            </div>
            <div class="card-body">
                <form method="POST"
                    action="{{ $item->id == null ? route('properties.store') : route('properties.update', ['property' => $item->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @if ($item->id != null)
                        @method('PATCH')
                    @endif
                    <div class="row">
                        <div class="col-md-7 col-12 order-md-1 order-2">
                            <div class="row">
                                <div class="col-md-6 col-12 mb-2">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ isset($item->name) ? $item->name : old('name') }}">
                                        @error('name')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 mb-2">
                                    <div class="form-group">
                                        <label for="aed_value">AED Value</label>
                                        <input type="number" step="any" class="form-control" id="aed_value" name="aed_value"
                                            value="{{ isset($item->aed_value) ? $item->aed_value : old('aed_value') }}">
                                        @error('aed_value')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 mb-2">
                                    <div class="form-group">
                                        <label for="pma_contract_start_date">PMA Contract Start Date</label>
                                        <input type="date" step="any" class="form-control" id="pma_contract_start_date" name="pma_contract_start_date"
                                            value="{{ isset($item->pma_contract_start_date) ? $item->pma_contract_start_date : old('pma_contract_start_date') }}">
                                        @error('pma_contract_start_date')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 mb-2">
                                    <div class="form-group">
                                        <label for="pma_contract_end_date">PMA Contract End Date</label>
                                        <input type="date" step="any" class="form-control" id="pma_contract_end_date" name="pma_contract_end_date"
                                            value="{{ isset($item->pma_contract_end_date) ? $item->pma_contract_end_date : old('pma_contract_end_date') }}">
                                        @error('pma_contract_end_date')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 mb-2">
                                    <div class="form-group">
                                        <label for="sqft_size">Sqft Size</label>
                                        <input type="number" step="any" class="form-control" id="sqft_size" name="sqft_size"
                                            value="{{ isset($item->sqft_size) ? $item->sqft_size : old('sqft_size') }}">
                                        @error('sqft_size')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 mb-2">
                                    <div class="form-group">
                                        <label for="private_units">Private Units</label>
                                            <select class="form-control mb-3" name ="private_units">
                                               <option value="1" {{$item->private_units == 1 ? 'selected': ''}}>One</option>
                                               <option value="2" {{$item->private_units == 2 ? 'selected': ''}}>Two</option>
                                               <option value="3" {{$item->private_units == 3 ? 'selected': ''}}>Three</option>
                                            </select>
                                        @error('private_units')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label for="coworking_spaces">Coworking Spaces</label>
                                            <select class="form-control mb-3" name ="coworking_spaces">
                                               <option value="1" {{$item->coworking_spaces == 1 ? 'selected': ''}}>One</option>
                                               <option value="2" {{$item->coworking_spaces == 2 ? 'selected': ''}}>Two</option>
                                               <option value="3" {{$item->coworking_spaces == 3 ? 'selected': ''}}>Three</option>
                                            </select>
                                        @error('coworking_spaces')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-12 mb-3 mt-2 order-md-2 order-1">
                            <input id="pac-input" name="location" class="controls form-control w-50" style="margin-top: 60px" type="text" placeholder="Location" value="{{ isset($item->location) ? $item->location : '' }}">
                            <div class="container w-100" id="map-canvas" style="height:390px;"></div>
                            <input type="hidden" name="lat" id="lat">
                            <input type="hidden" name="lng" id="lng">
                            @error('lat')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                            @error('location')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12 mb-2 order-3">
                            <div class="form-group">
                                <label>Meeting Room</label><br>
                                <div class="custom-control custom-radio custom-radio-color custom-control-inline">
                                    <input type="radio" id="meeting_room1" name="meeting_room" class="custom-control-input" {{$item->meeting_room == 1 ? 'checked' : ''}} value="1">
                                    <label class="custom-control-label" for="meeting_room1"> Yes </label>
                                 </div>
                                 <div class="custom-control custom-radio custom-radio-color custom-control-inline">
                                    <input type="radio" id="meeting_room2" name="meeting_room" class="custom-control-input" {{$item->meeting_room == 0 ? 'checked' : ''}} value="0">
                                    <label class="custom-control-label" for="meeting_room2"> No </label>
                                 </div>
                                @error('meeting_room')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2 order-4">
                            <div class="form-group">
                                <label>Conference Room</label><br>
                                <div class="custom-control custom-radio custom-radio-color custom-control-inline">
                                    <input type="radio" id="conference_room1" name="conference_room" class="custom-control-input" {{$item->conference_room == 1 ? 'checked' : ''}} value="1">
                                    <label class="custom-control-label" for="conference_room1" > Yes </label>
                                 </div>
                                 <div class="custom-control custom-radio custom-radio-color custom-control-inline">
                                    <input type="radio" id="conference_room2" name="conference_room" class="custom-control-input" {{$item->conference_room == 0 ? 'checked' : ''}} value="0">
                                    <label class="custom-control-label" for="conference_room2" > No </label>
                                 </div>
                                @error('conference_room')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2 order-5">
                            <div class="form-group">
                                <label>Fully Furnished</label><br>
                                <div class="custom-control custom-radio custom-radio-color custom-control-inline">
                                    <input type="radio" id="fully_furnished1" name="fully_furnished" class="custom-control-input" {{$item->fully_furnished == 1 ? 'checked' : ''}} value="1">
                                    <label class="custom-control-label" for="fully_furnished1"> Yes </label>
                                 </div>
                                 <div class="custom-control custom-radio custom-radio-color custom-control-inline">
                                    <input type="radio" id="fully_furnished2" name="fully_furnished" class="custom-control-input" {{$item->fully_furnished == 0 ? 'checked' : ''}} value="0">
                                    <label class="custom-control-label" for="fully_furnished2"> No </label>
                                 </div>
                                @error('fully_furnished')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mb-2 order-6">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" placeholder="" name="address">{{$item->address}}</textarea>
                            @error('address')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-12 mb-2 order-7">
                            <label for="address">PMA Agreement   @if($item->pma_agreement != null)
                                <a href="{{$item->pma_agreement}}" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="30" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                                   </svg></a>
                                @endif</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="pma_agreement" name="pma_agreement" accept="application/pdf">
                                <label class="custom-file-label" for="pma_agreement">Choose file</label>
                             </div>
                            @error('pma_agreement')
                              <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mt-2 order-8">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
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
