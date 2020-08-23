@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>
        {{__('Location')}}
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
        <li class="active">{{__('Add Location')}}</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('Add Locations')}}</h3> 
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="city-form" method="POST" action="{{route('admin.addCity')}}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">






                            <div class="form-group">
                                <label for="exampleInputEmail1">{{__('Name')}}</label>
                                <div class="input text">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"  name="name" id="autocomplete" placeholder="Name" required>
                                    <input id="lat" name="lat" type="hidden"/>
                                    <input id="lng" name="lng" type="hidden"/>
                                    <input id="locality" name="locality" type="hidden"/>   
                                    <input id="country" name="country" type="hidden"/>
                                    <input id="postal_code" name="postal_code" type="hidden"/>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror 
                                </div>
                            </div>


                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-success" type="submit">{{__('Submit')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    $().ready(function () {
        $("#city-form").validate({
            rules: {
                name: "required"
            },
            messages: {
                name: "Please enter name"
            }
        });
    });
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAE9pX_5yg7jdN9YWoEsYTDJR4qiOHZFPo&libraries=places&callback=initAutocomplete"
async defer></script>   
<script>
// This sample uses the Autocomplete widget to help the user select a
// place, then it retrieves the address components associated with that
// place, and then it populates the form fields with those details.
// This sample requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script
// src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

var placeSearch, autocomplete;

var componentForm = {
  locality: 'long_name',
  country: 'long_name',
  postal_code: 'short_name'
};  



function initAutocomplete() {
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
          document.getElementById('autocomplete'),
          {types: ['geocode']}
  );


  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete.setFields(['address_component', 'geometry']);


  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);

}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();
  $('#lat').val(place.geometry.location.lat());
  $('#lng').val(place.geometry.location.lng());
  for (var component in componentForm) {
       console.log(component);     
      document.getElementById(component).value = '';
      document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.


  for (var i = 0; i < place.address_components.length; i++) {
      console.log(place.address_components);

      var addressType = place.address_components[i].types[0];
      if (componentForm[addressType]) {
          var val = place.address_components[i][componentForm[addressType]];
          document.getElementById(addressType).value = val;
      }
  }
}

</script>
@endsection
