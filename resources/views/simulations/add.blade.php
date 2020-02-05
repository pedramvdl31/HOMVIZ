@extends($layout)
@section('stylesheets')

	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard.css">
	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard_theme_circles.css">
	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard_theme_arrows.css">
	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard_theme_dots.css">
	<link rel="stylesheet" href="/assets/css/simulations/index.css?21">

@stop
@section('scripts')
	<script src="/SmartWizard-master/src/js/jquery.smartWizard.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
	<script src="/assets/js/simulations/index.js?27"></script>

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

	<div id="mcontent" class="content" style="display: none">

	    <div class="container-fluid">

	        <div class="row">

		        <div class="col-lg-10">

					{!! Form::open(array('action' => 'SimulationsController@postAdd','role'=>"form", 'id'=>"myform", 'autocomplete'=>"off")) !!}

				        @if(isset($project_id))
					        	<input type="hidden" name="project_id" value="{{$project_id}}">
					    @endif

					    <div class="card card-primary card-outline">

					        <div class="card card-solid mb-0" style="border: 5px solid #3f9bff;">

					            <div class="card-body p-0">


							        <!-- SmartWizard html -->
							        <div id="smartwizard" style="border: 0">
							            <ul>
							                <li><a href="#step-1">Step 1<br /><big>Location</big></a></li>
							                <li><a href="#step-2">Step 2<br /><big>Population</big></a></li>
							                <li><a href="#step-3">Step 3<br /><big>Resources and States</big></a></li>
							                <li><a href="#step-4">Step 5<br /><big>Parameters</big></a></li>
							            </ul>

							            <div style="padding-top: 15px">

							                <div id="step-1" class="">


							                	<div class="row">


									                <div class="col-md-12">
														<div class="form-group">
										                	<label for="inputName">Location (Address or latitute, longitude):</label>
										                	<div id="locationField"></div>
										                	<input autocomplete="off" id="autocomplete" placeholder="Enter a city" name="location" type="text" class="form-control">
										              	</div>
										            </div>

										            <div class="col-md-12">

													    <div id="map"></div>

													    <script>

													      var map, map2, places, infoWindow;
													      var markers = [];
													      var autocomplete;
													      var countryRestrict = {'country': 'ca'};
													      var MARKER_PATH = 'https://developers.google.com/maps/documentation/javascript/images/marker_green';
													      var hostnameRegexp = new RegExp('^https?://.+?/');

													      var countries = {
													        'ca': {
													          center: {lat: 62, lng: -110.0},
													          zoom: 3
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

													        map2 = new google.maps.Map(document.getElementById('map2'), {
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
													        places2 = new google.maps.places.PlacesService(map2);

													        autocomplete.addListener('place_changed', onPlaceChanged);

													      }

													      // When the user selects a city, get the place details for the city and
													      // zoom the map in on the city.
													      function onPlaceChanged() {
													        var place = autocomplete.getPlace();
													        if (place.geometry) {
													          map.panTo(place.geometry.location);
													          map.setZoom(15);
													          map2.panTo(place.geometry.location);
													          map2.setZoom(10);

													        } else {
													          document.getElementById('autocomplete').placeholder = 'Enter a city';
													        }
													        window.loc=1;checkLoc()
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
													          map2.setCenter({lat: 15, lng: 0});
													          map2.setZoom(2);
													        } else {
													          autocomplete.setComponentRestrictions({'country': country});
													          map.setCenter(countries[country].center);
													          map.setZoom(countries[country].zoom);
													          map2.setCenter(countries[country].center);
													          map2.setZoom(countries[country].zoom);
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

									                <div class="col-md-12">
														<div class="form-group">
										                	<label for="inputName">Population type for simulation (for example: male, female, etc. comma separated):</label>
											                <div class="input-group mb-3">
															  <input placeholder="Male, Female, Other, ..." autocomplete="off" name="states" id="populationtext" type="text" class="form-control rounded-0">
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

									                <div class="col-md-12">

														<div class="form-group">

										                	<label for="inputName">Resources and States (comma separated):</label>
														  	<div class="form-inline">
															  	<select class="form-control" id="stateresselect">
															  		<option selected disabled id="title">Select One</option>
															  		<option id="Street" type="res">Street</option>
															  		<option id="Shelter" type="res">Shelter</option>
												                	<option id="HiddenHomeless" type="state">Hidden Homeless</option>
												                	<option id="NotHomeless" type="state">Not Homeless</option>
												                	<option id="TransitionalHousing" type="res">Transitional Housing</option>
												                	<option id="Hospital" type="res">Hospital</option>
												                	<option id="Rehabilitation" type="state">Rehabilitation</option>
												                </select>
														    	<button id="stateresourcebtn" type="button" class="btn btn-info btn-flat" style="margin-left: 10px">Add</button>
														    </div>

										              	</div>
										            </div>

												</div>

												<div class="row">

													<div class="col-lg-12">

														<div id="stateresource_table">

															<div class="table-responsive row-scroll">
																<table class="table table-bordered" id="staterestable">
																	<thead>
																		<tr>
																			<th>Type</th><th>Name</th><th>Resources / States</th><th>Properties</th><th>Action</th>
																		</tr>
																	</thead>
																	<tbody>
																		<tr><td></td><td></td><td></td><td></td><td></td></tr>
																	</tbody>
																</table>
															</div>

														</div>

													</div>

												</div>

							                </div>

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

				<div class="col-lg-2">
					
						<div class="card card-primary card-outline">

					        <div class="card card-solid mb-0" style="border: 5px solid #abd3ff;min-height: 710px">

								<div class="card-header">
									<h3 class="card-title">
										<strong>Overview</strong>
									</h3>
								</div>

        						<div class="card-body">


									<p>Location: <span id="loc-overview" class="text-danger">Not set</span></p>
									<div class="col-lg-12 hide" id="loc-div">
										<div id="map2"></div>
										<p>&nbsp;</p>
									</div>
									<p>Population: <span id="population-overview" class="text-danger">Not set</span></p>
									<p>Resources and States: <span id="stateres-overview" class="text-danger">Not set</span></p>
									<p>Parameters: <span id="parameters-overview" class="text-danger">Not set</span></p>


					            </div>

				            	<div class="card-footer" style="text-align: right;">
							
									<button type="submit" class="btn bg-gradient-primary" id="runsimulation" disabled="">Run simulation</button>

				              	</div>

					        </div>

				    	</div><!-- /.card -->

				</div>

	        </div>
	        <!-- /.row -->

	    </div><!-- /.container-fluid -->

	</div>

@stop



