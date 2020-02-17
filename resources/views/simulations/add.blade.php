@extends($layout)
@section('stylesheets')

	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard.css">
	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard_theme_arrows.css">
	<link rel="stylesheet" href="/AdminLTE-3.0.0/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<link rel="stylesheet" href="/assets/css/simulations/index.css?26">

@stop
@section('scripts')
	<script src="/SmartWizard-master/src/js/jquery.smartWizard.js?1"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
	<script src="/AdminLTE-3.0.0/plugins/sweetalert2/sweetalert2.min.js"></script>
	<script src="/assets/js/simulations/index.js?34"></script>
@stop

@section('content')


	<style>
		
		td.titles{
			background-color: gray;
    		color: white;
    		font-weight: bold;
		}
		.swal2-icon.swal2-error.swal2-animate-error-icon{
			margin-right: 10px
		}
	</style>

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

					        <div class="card card-solid mb-0" style="border: 5px solid #5cb85c">

					            <div class="card-body p-0">


							        <!-- SmartWizard html -->
							        <div id="smartwizard" style="border: 0">
							            <ul>
							                <li><a href="#step-1">Step 1<br /><big>Location&nbsp;&nbsp;<i class="fas fa-map-marked-alt"></i></big></a></li>
							                <li><a href="#step-2">Step 2<br /><big>Population Group&nbsp;&nbsp;<i class="fas fa-users"></i></big></a></li>
							                <li><a href="#step-3">Step 3<br /><big>Event&nbsp;&nbsp;<i class="fas fa-project-diagram"></i></big></a></li>
							                <li><a href="#step-4">Step 4<br /><big>Transition Probability&nbsp;&nbsp;<i class="fas fa-percent"></i></big></a></li>
							                <li><a href="#step-5">Step 5<br /><big>Parameters&nbsp;&nbsp;<i class="fas fa-sliders-h"></i></big></a></li>
							            </ul>

							            <div style="padding-top: 15px">

							                <div id="step-1" class="">


							                	<div class="row">


									                <div class="col-md-12">
														<div class="form-group">
										                	<label for="inputName">Location (Address or latitute, longitude):</label>
										                	<div id="locationField"></div>
										                	<input autocomplete="off" id="autocomplete" placeholder="Enter a city" name="location" type="text" class="form-control border-primary">
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
										                	<label for="inputName">Population group of simulation (comma separated):</label>
										                	<br>
										                	<small>Here you can set the population group and count that exist in your simulation. Population title/name does not effect the simulation outcome.</small>
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

										                	<label for="inputName">Select between the provided events:</label>
										                	<br>
										                	<small>Events are grouped into facilities and states.</small>
										                	<small><ul>
										                			<li>Facilities: Places and amenities provided for individuals to stay.</li>
										                			<li>States: Particular condition of individuals such as the state of Homelessness or Rehabilitation</li>
										                		</ul></small>
										                	
														  	<div class="form-inline">
															  	<select class="form-control col-md-4" id="stateresselect">
															  		<option selected disabled id="title">Select One</option>
																	<optgroup label="Facilities">
																		<option id="Hospital" type="res">Hospital</option>
																		<option id="Shelter" type="res">Shelter</option>
																		<option id="Street" type="res">Street</option>
																		<option id="TransitionalHousing" type="res">Transitional Housing</option>
																	</optgroup>
																	<optgroup label="State">
																		<option id="HiddenHomeless" type="state">Hidden Homeless</option>
																		<option id="NotHomeless" type="state">Not Homeless</option>
																		<option id="Rehabilitation" type="state">Rehabilitation</option>
																	</optgroup>
												                </select>
														    	<button id="stateresourcebtn" type="button" class="btn btn-info btn-flat" style="margin-left: 10px">Add</button>
														    </div>

										              	</div>
										            </div>

												</div>

												<div class="row">

													<div class="col-lg-12">

														<div id="stateresource_table">

															<div class="table-responsive row-scroll" style="border: 1px solid gray;">
																<table class="table table-bordered" id="staterestable" style="margin-bottom: 0">
																	<thead>
																		<tr>

																			<th>Name</th><th>Asset Type</th><th>Properties</th><th>Action</th>

																		</tr>
																	</thead>
																	<tbody>
																		<tr><td></td><td></td><td></td><td></td></tr>
																	</tbody>
																</table>
															</div>

														</div>

													</div>

												</div>

							                </div>

							                <div id="step-4" class="">

							                	<div class="row" style="margin-left: 0;margin-right: 0;">

									                <div class="col-md-12">
														
														<div id="transitiontable"></div>

										            </div>

									        	</div>

							                </div>

							                <div id="step-5" class="">

							                	<div class="row" style="margin-left: 0;margin-right: 0;">

									                <div class="col-md-4">
														<div class="form-group">
										                	<label for="inputName">Simulation name:</label>
										                	<input autocomplete="off" name="simulation_name" type="text" id="simname" class="form-control">
										              	</div>
														<div class="form-group">
										                	<label for="inputName">Number of weeks:</label>
										                	<input  autocomplete="off" name="numberofweeks" type="text" id="simweeks" class="form-control">
										              	</div>
														<div class="form-group">
										                	<label for="inputName">Number of simulations:</label>
										                	<input  autocomplete="off" name="numberofsims" type="text" id="simnum" class="form-control">
										              	</div>

										            </div>

									        	</div>

							                </div>

							            </div>
							            
							        </div>

					            </div>

					            <div class="card-footer" style="text-align: right;">
							
									<button type="button" class="btn btn-default" id="prev" disabled="">Back</button>
									<button type="button" class="btn bg-gradient-primary" id="next">Next Step</button>

				              	</div>

					        </div>

					    </div><!-- /.card -->

					{!! Form::close() !!}

				</div>

				<div class="col-lg-2">
					
						<div class="card card-primary card-outline">

					        <div class="card card-solid mb-0" style="border: 5px solid #c3c3c3;min-height: 710px">

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
									<p>Event: <span id="stateres-overview" class="text-danger">Not set</span></p>
									<p>Transition Probabilities: <span id="transprob-overview" class="text-danger">Not set</span></p>
									<p>Parameters: <span id="params-overview" class="text-danger">Not set</span></p>


					            </div>

				            	<div class="card-footer" style="text-align: right;">
							
									<button type="text" class="btn btn-default" id="runsimulation" disabled="">Run simulation</button>

				              	</div>

					        </div>

				    	</div><!-- /.card -->

				</div>

	        </div>
	        <!-- /.row -->

	    </div><!-- /.container-fluid -->

	</div>

@stop



