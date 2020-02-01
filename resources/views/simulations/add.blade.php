@extends($layout)
@section('stylesheets')

	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard.css">
	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard_theme_circles.css">
	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard_theme_arrows.css">
	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard_theme_dots.css">

	<link rel="stylesheet" href="/assets/css/simulations/index.css?13">

@stop
@section('scripts')
	<script src="/SmartWizard-master/src/js/jquery.smartWizard.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
	<script src="/assets/js/simulations/index.js?20"></script>

@stop

@section('content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper" style="margin-left: 0">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
			  <div class="col-sm-6">
			    <h1 class="m-0 text-dark">Simulations</h1>
			  </div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<div class="content">

	    <div class="container-fluid">

	        <div class="row">

	          <div class="col-lg-12">

	          	{!! Form::open(array('action' => 'SimulationsController@postAdd','role'=>"form", 'id'=>"myform", 'autocomplete'=>"off")) !!}

	          		

      		        @if(isset($project_id))
      		        	<input type="hidden" name="project_id" value="{{$project_id}}">
                    @endif

		            <div class="card card-primary card-outline">

		                <div class="card card-solid" style="margin-bottom: 0;padding-bottom: 25px">
		                    <div class="card-body pb-0">


						        <!-- SmartWizard html -->
						        <div id="smartwizard">
						            <ul>
						                <li><a href="#step-1">Step 1<br /><big>Location</big></a></li>
						                <li><a href="#step-2">Step 2<br /><big>Population</big></a></li>
						                <li><a href="#step-3">Step 3<br /><big>Resources and States</big></a></li>
						                <!-- <li><a href="#step-5">Step 4<br /><big>State Transition</big></a></li> -->
						                <li><a href="#step-4">Step 5<br /><big>Parameters</big></a></li>
						            </ul>

						            <div style="padding-top: 15px">

						                <div id="step-1" class="">


						                	<div class="row">


								                <div class="col-md-4">
													<div class="form-group">
									                	<label for="inputName">Location (Address or latitute, longitude):</label>
									                	<div id="locationField"></div>
									                	<input autocomplete="off" id="autocomplete" placeholder="Enter a city" name="location" type="text" id="inputName" class="form-control">
									              	</div>
									            </div>

									            <div class="col-md-8">

												    <div id="map"></div>

												    <script>

												      var map, places, infoWindow;
												      var markers = [];
												      var autocomplete;
												      var countryRestrict = {'country': 'ca'};
												      var MARKER_PATH = 'https://developers.google.com/maps/documentation/javascript/images/marker_green';
												      var hostnameRegexp = new RegExp('^https?://.+?/');

												      var countries = {
												        'au': {
												          center: {lat: -25.3, lng: 133.8},
												          zoom: 4
												        },
												        'br': {
												          center: {lat: -14.2, lng: -51.9},
												          zoom: 3
												        },
												        'ca': {
												          center: {lat: 62, lng: -110.0},
												          zoom: 3
												        },
												        'fr': {
												          center: {lat: 46.2, lng: 2.2},
												          zoom: 5
												        },
												        'de': {
												          center: {lat: 51.2, lng: 10.4},
												          zoom: 5
												        },
												        'mx': {
												          center: {lat: 23.6, lng: -102.5},
												          zoom: 4
												        },
												        'nz': {
												          center: {lat: -40.9, lng: 174.9},
												          zoom: 5
												        },
												        'it': {
												          center: {lat: 41.9, lng: 12.6},
												          zoom: 5
												        },
												        'za': {
												          center: {lat: -30.6, lng: 22.9},
												          zoom: 5
												        },
												        'es': {
												          center: {lat: 40.5, lng: -3.7},
												          zoom: 5
												        },
												        'pt': {
												          center: {lat: 39.4, lng: -8.2},
												          zoom: 6
												        },
												        'us': {
												          center: {lat: 37.1, lng: -95.7},
												          zoom: 3
												        },
												        'uk': {
												          center: {lat: 54.8, lng: -4.6},
												          zoom: 5
												        }
												      };

												      function initMap() {
												        map = new google.maps.Map(document.getElementById('map'), {
												          zoom: countries['ca'].zoom,
												          center: countries['ca'].center,
												          mapTypeControl: false,
												          panControl: false,
												          zoomControl: false,
												          streetViewControl: false
												        });

												        infoWindow = new google.maps.InfoWindow({
												          content: document.getElementById('info-content')
												        });

												        // Create the autocomplete object and associate it with the UI input control.
												        // Restrict the search to the default country, and to place type "cities".
												        autocomplete = new google.maps.places.Autocomplete(
												            /** @type {!HTMLInputElement} */ (
												                document.getElementById('autocomplete')), {
												              types: ['(cities)'],
												              componentRestrictions: countryRestrict
												            });
												        places = new google.maps.places.PlacesService(map);

												        autocomplete.addListener('place_changed', onPlaceChanged);

												      }

												      // When the user selects a city, get the place details for the city and
												      // zoom the map in on the city.
												      function onPlaceChanged() {
												        var place = autocomplete.getPlace();
												        if (place.geometry) {
												          map.panTo(place.geometry.location);
												          map.setZoom(15);
												        } else {
												          document.getElementById('autocomplete').placeholder = 'Enter a city';
												        }
												      }

												      function clearMarkers() {
												        for (var i = 0; i < markers.length; i++) {
												          if (markers[i]) {
												            markers[i].setMap(null);
												          }
												        }
												        markers = [];
												      }

												      // Set the country restriction based on user input.
												      // Also center and zoom the map on the given country.
												      function setAutocompleteCountry() {
												        var country = 'ca';
												        if (country == 'all') {
												          autocomplete.setComponentRestrictions({'country': []});
												          map.setCenter({lat: 15, lng: 0});
												          map.setZoom(2);
												        } else {
												          autocomplete.setComponentRestrictions({'country': country});
												          map.setCenter(countries[country].center);
												          map.setZoom(countries[country].zoom);
												        }
												        clearResults();
												        clearMarkers();
												      }

												    </script>
												    
												    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjSc4Dogy851gGnXKKWcypMufL4ASk3RM&libraries=places&callback=initMap" async defer></script>

									            </div>

								        	</div>

						                </div>

						                <div id="step-2" class="">

						                	<div class="row">

								                <div class="col-md-4">
													<div class="form-group">
									                	<label for="inputName">Population type (comma separated):</label>
										                <div class="input-group mb-3">
														  <input autocomplete="off" name="states" id="populationtext" type="text" class="form-control rounded-0">
														  <span class="input-group-append">
														    <button id="populationbtn" type="button" class="btn btn-info btn-flat">Generate table</button>
														  </span>
														</div>
									              	</div>
									            </div>

											</div>

											<div class="row">

												<div class="col-lg-12">

													<div id="_table"></div>

												</div>

											</div>

						                </div>


						                <div id="step-3" class="">

						                	<div class="row">

								                <div class="col-md-4">

													<div class="form-group">

									                	<label for="inputName">Resources and States (comma separated):</label>
										                <div class="input-group mb-3">
														  <input autocomplete="off" name="res" id="stateresourcetext" type="text" class="form-control rounded-0">
														  <span class="input-group-append">
														    <button id="stateresourcebtn" type="button" class="btn btn-info btn-flat">Generate table</button>
														  </span>
														</div>

									              	</div>
									            </div>

											</div>

											<div class="row">

												<div class="col-lg-12">

													<div id="stateresource_table"></div>

												</div>

											</div>

						                </div>

<!-- 						                <div id="step-5" class="">

											<div class="row">

												<div class="col-lg-12">

													<div id="statetransition_table"></div>

												</div>

											</div>

						                </div> -->

						                <div id="step-4" class="">

						                	<div class="row" style="margin-left: 0;margin-right: 0;">

								                <div class="col-md-4">
													<div class="form-group">
									                	<label for="inputName">Simulation name:</label>
									                	<input autocomplete="off" name="simulation_name" type="text" id="inputName" class="form-control">
									              	</div>
													<div class="form-group">
									                	<label for="inputName">Number of weeks:</label>
									                	<input  autocomplete="off" name="numberofweeks" type="text" id="inputName" class="form-control">
									              	</div>
													<div class="form-group">
									                	<label for="inputName">Number of simulations:</label>
									                	<input  autocomplete="off" name="numberofsims" type="text" id="inputName" class="form-control">
									              	</div>

									            	<button type="submit" class="btn bg-gradient-primary">Save</button>
									            	<button type="submit" class="btn bg-gradient-primary" id="runsimulation">Save and run simulation</button>

									            </div>

								        	</div>

						                </div>

						            </div>
						            
						        </div>

		                    </div>

		                </div>

		            </div><!-- /.card -->

	            {!! Form::close() !!}

	          </div>

	        </div>
	        <!-- /.row -->

	    </div><!-- /.container-fluid -->

	</div>

@stop



