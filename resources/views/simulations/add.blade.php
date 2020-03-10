@extends($layout)
@section('stylesheets')
	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard.css?1">
	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard_theme_arrows.css?1">
	<link rel="stylesheet" href="/assets/css/sweetalert2.min.css?1">
	<link rel="stylesheet" href="/assets/css/simulations/index.css?31">
@stop
@section('scripts')
	<script src="/SmartWizard-master/src/js/jquery.smartWizard.js?22"></script>
	<script src="/assets/js/sweetalert2.min.js?1"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
	<script src="/assets/js/simulations/index.js?109"></script>
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

		#_table{
			max-height: 700px;
    		overflow-y: auto;
		}

	</style>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper" style="margin-left: 0">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
			  <div class="col-sm-6">
			    <h1 class="m-0 text-dark">New Simulation</h1>
			  </div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<div id="mcontent" class="content" style="display: none">

	    <div class="container-fluid">

	        <div class="row">

		        <div class="col-lg-9" id="main-window">

					{!! Form::open(array('action' => 'SimulationsController@postAdd','role'=>"form", 'id'=>"myform", 'autocomplete'=>"off")) !!}

				        @if(isset($project_id))
					        	<input type="hidden" name="project_id" value="{{$project_id}}">
					    @endif

							
						<!-- Popoovers are going to be here -->
					    <div style="display: none" id="popoverhtmls"> 

					    </div>

					    <div class="card card-primary card-outline">

					        <div class="card card-solid mb-0">

					            <div class="card-body p-0">


							        <!-- SmartWizard html -->
							        <div id="smartwizard" style="border: 0">
							            <ul>
							                <li><a href="#step-1">Step 1<br /><big>Location&nbsp;&nbsp;<i class="fas fa-map-marked-alt"></i></big></a></li>
							                <li><a href="#step-2">Step 2<br /><big>Population Group&nbsp;&nbsp;<i class="fas fa-users"></i></big></a></li>
							                <li><a href="#step-3">Step 3<br /><big>Resources&nbsp;&nbsp;<i class="fas fa-shapes"></i></big></a></li>
							                <li><a href="#step-4">Step 4<br /><big>States&nbsp;&nbsp;<i class="fas fa-project-diagram"></i></big></a></li>
							                <li><a href="#step-5">Step 5<br /><big>Transition Probability&nbsp;&nbsp;<i class="fas fa-percent"></i></big></a></li>
							                <li><a href="#step-6">Step 6<br /><big>Parameters&nbsp;&nbsp;<i class="fas fa-sliders-h"></i></big></a></li>
							            </ul>

							            <div style="padding-top: 15px">

							                <div id="step-1" class="">


							                	<div class="row">


									                <div class="col-md-12">
									                	<div class="row">
										                	<div class="col-md-6">
																<div class="form-group">
												                	<label for="inputName">Simulation Name:</label>
												                	<div id="locationField"></div>
												                	<input name="simulation_name" id="simulation-name" type="text" class="form-control border-primary" placeholder="Simulation 1">
												              	</div>
											              	</div>
										              	</div>
										            </div>

										            <div class="col-md-12">
									                	<div class="row">
										                	<div class="col-md-6">
																<div class="form-group">
												                	<label for="inputName">Enter a name of city in Canda:</label>
												                	<div id="locationField"></div>
												                	<input autocomplete="off" id="autocomplete" placeholder="City name" name="simulation_location" type="text" class="form-control border-primary">
													            </div>
											              	</div>
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
													          document.getElementById('autocomplete').placeholder = 'Enter a city in Canada';
													        }
													        window.loc=1;
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
										                	<label for="inputName">Population group for simulation (comma separated):</label>
										                	<br>
										                	<small>Here you can set the population group for your simulation. Population title/name does not effect the simulation outcome.</small>
											                <div class="input-group mb-3">
															  <input placeholder="Male, Female, Other, ..." autocomplete="off" id="populationtext" type="text" class="form-control rounded-0">
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

										                	<label for="inputName">Select between the provided resources:</label>
										                	<br>
										                	<small>Places and amenities provided by various services to individuals.</small>
										                	
														  	<div class="form-inline">
															  	<select class="form-control col-md-4" id="resselect">
															  		<option selected disabled id="title">Select One</option>
																	<option id="Hospital" type="res">Hospital</option>
																	<option id="Shelter" type="res">Shelter</option>
																	<option id="Street" type="res">Street</option>
																	<option id="TransitionalHousing" type="res">Transitional Housing</option>
												                </select>
														    	<button id="resourcebtn" type="button" class="btn btn-info btn-flat" style="margin-left: 10px">Add</button>
														    </div>

										              	</div>
										            </div>

												</div>

												<div class="row">

													<div class="col-lg-12">

														<div id="resource_table">

															<div class="table-responsive row-scroll" style="border: 1px solid gray;">
																<table class="table table-bordered staterestable" id="restable" style="margin-bottom: 0">
																	<thead>
																		<tr>

																			<th>Type</th><th>Name</th><th>Properties</th><th>Action</th>

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

							                	<div class="row">

									                <div class="col-md-12">

														<div class="form-group">

										                	<label for="inputName">Select between the provided states:</label>
										                	<br>
										                	<small>State: Particular condition of individuals such as the state of Homelessness or Rehabilitation.</small>
										                	
														  	<div class="form-inline">
															  	<select class="form-control col-md-4" id="stateselect">
															  		<option selected disabled id="title">Select One</option>
																	<option id="HiddenHomeless" type="state">Hidden Homeless</option>
																	<option id="NotHomeless" type="state">Not Homeless</option>
																	<option id="Rehabilitation" type="state">Rehabilitation</option>
												                </select>
														    	<button id="statebtn" type="button" class="btn btn-info btn-flat" style="margin-left: 10px">Add</button>
														    </div>

										              	</div>
										            </div>

												</div>

												<div class="row">

													<div class="col-lg-12">

														<div id="state_table">

															<div class="table-responsive row-scroll" style="border: 1px solid gray;">
																<table class="table table-bordered staterestable" id="statetable" style="margin-bottom: 0">
																	<thead>
																		<tr>

																			<th>Type</th><th>Name</th><th>Properties</th><th>Action</th>

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

							                <div id="step-5" class="">

							                	<div class="row" style="margin-left: 0;margin-right: 0;">

									                <div class="col-md-12">
														
														<div id="transitiontable"></div>

										            </div>

									        	</div>

							                </div>

							                <div id="step-6" class="">

							                	<div class="row" style="margin-left: 0;margin-right: 0;">

									                <div class="col-md-4">

														<div class="form-group">
										                	<label for="inputName">Created by:</label>
										                	<input placeholder="Creator's first name" type="text" autocomplete="off" name="creatorname"  id="cname" class="form-control">
										              	</div>

														<div class="form-group">
										                	<label for="inputName">Number of weeks:</label>
										                	<input type="number" min="1" max="999" autocomplete="off" name="numberofweeks" id="simweeks" class="form-control">
										              	</div>
														<div class="form-group">
										                	<label for="inputName">Number of simulations:</label>
										                	<input type="number" min="1" max="999"  autocomplete="off" name="numberofsims" type="text" id="simnum" class="form-control">
										              	</div>

										            </div>

									        	</div>

							                </div>

							            </div>
							            
							        </div>

					            </div>

					            <div class="card-footer" style="text-align: right;">
							
									<button type="button" class="btn btn-default" id="prev" disabledx="">Back</button>
									<button type="button" class="btn bg-gradient-primary" id="next">Next Step</button>

				              	</div>

					        </div>

					    </div><!-- /.card -->

					{!! Form::close() !!}

				</div>

				<div class="col-lg-3" id="side-window">
					
						<div class="card card-primary card-outline">

					        <div class="card card-solid mb-0" >

								<div class="card-header">
									<h3 class="card-title">
										<strong>Overview</strong>
									</h3>
								</div>

        						<div class="card-body">

									<div class="row">
										<p><strong>Step 1:</strong> <span id="loc-overview" class="text-danger">Incomplete</span></p>
										<div class="col-lg-12 hide" id="loc-div">
											<p><strong>Simulation Name: <small id="simname-side"></small></strong></p>
											<p><strong>City Name: <small id="cityname-side"></small></strong></p>
											<div id="map2"></div>
										</div>
									</div>

									<hr>

									<div class="row">
										<p><strong>Step 2:</strong> <span id="population-overview" class="text-danger">Incomplete</span></p>
									</div>

									<hr>

									<div class="row">
										<p><strong>Step 3:</strong> <span id="resources-overview" class="text-danger">Incomplete</span></p>
									</div>

									<hr>

									<div class="row">
										<p><strong>Step 4:</strong> <span id="states-overview" class="text-danger">Incomplete</span></p>
									</div>

									<hr>

									<div class="row">
										<p><strong>Step 5:</strong> <span id="transitions-overview" class="text-danger">Incomplete</span></p>
									</div>

									<hr>

									<div class="row">
										<p><strong>Step 6:</strong> <span id="parameters-overview" class="text-danger">Incomplete</span></p>
									</div>


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



