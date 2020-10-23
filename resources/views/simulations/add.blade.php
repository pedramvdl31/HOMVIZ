@extends($layout)
@section('stylesheets')
	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard.css?1">
	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard_theme_arrows.css?1">
	<link rel="stylesheet" href="/assets/css/sweetalert2.min.css?1">
	<link rel="stylesheet" href="/assets/css/simulations/index.css?32">
	<link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
@stop
@section('scripts')
	<script src="/SmartWizard-master/src/js/jquery.smartWizard.js?22"></script>
	<script src="/assets/js/sweetalert2.min.js?1"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
	<script src="/assets/js/simulations/index.js?123"></script>
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

		.myrow {
		  display: flex; /* equal height of the children */
		}

		.mycol {
		  flex: 1; /* additionally, equal width */
		  padding-bottom: 1em;
		}

		.btn-success {
		    border-color: #5cb85c !important;
		    color: #fff !important;
		    background: #5cb85c !important;
		}

		.dismisspopover{
			cursor: pointer;
		}

		.swal2-popup {
		    position: relative !important;
		    box-sizing: border-box !important;
		    flex-direction: column !important;
		    justify-content: center !important;
		    width: 32em !important;
		    max-width: 100% !important;
		    padding: 1.25em !important;
		    border: none !important;
		    border-radius: .3125em !important;
		    background: #fff !important;
		    font-family: inherit !important;
		    font-size: 1rem !important;
		}

		.swal2-header {
		    display: flex !important;
		    flex-direction: column !important;
		    align-items: center !important;
		    padding: 0 1.8em !important;
		}
		.swal2-title {
		    position: relative !important;
		    max-width: 100% !important;
		    margin: 0 0 .4em !important;
		    padding: 0 !important;
		    color: #595959 !important;
		    font-size: 1.875em !important;
		    font-weight: 600 !important;
		    text-align: center !important;
		    text-transform: none !important;
		    word-wrap: break-word !important;
		}
		.swal2-content {
		    z-index: 1 !important;
		    justify-content: center !important;
		    margin: 0 !important;
		    padding: 0 1.6em !important;
		    color: #545454 !important;
		    font-size: 1.125em !important;
		    font-weight: 400 !important;
		    line-height: normal !important;
		    text-align: center !important;
		    word-wrap: break-word !important;
		}
		[class^=swal2] {
		    -webkit-tap-highlight-color: transparent !important;
		}
		.swal2-actions {
		    display: flex !important;
		    z-index: 1 !important;
		    flex-wrap: wrap !important;
		    align-items: center !important;
		    justify-content: center !important;
		    width: 100% !important;
		    margin: 1.25em auto 0 !important;
		}
		.swal2-styled.swal2-confirm {
		    border: 0 !important;
		    border-radius: .25em !important;
		    background: initial !important;
		    background-color: #3085d6 !important;
		    color: #fff !important;
		    font-size: 1.0625em !important;
		}
		.swal2-styled:not([disabled]) {
		    cursor: pointer !important;
		}
		.swal2-styled.swal2-cancel {
		    border: 0;
		    border-radius: .25em;
		    background: initial;
		    background-color: #aaa;
		    color: #fff;
		    font-size: 1.0625em;
		}
		.swal2-styled {
		    margin: .3125em !important;
		    padding: .625em 2em !important;
		    box-shadow: none !important;
		    font-weight: 500 !important;
		}
		.swal2-icon {
		    position: relative;
		    box-sizing: content-box;
		    justify-content: center;
		    width: 5em;
		    height: 5em;
		    margin: 1.25em auto 1.875em;
		    border: .25em solid transparent;
		    border-radius: 50%;
		    font-family: inherit;
		    line-height: 5em;
		    cursor: default;
		    -webkit-user-select: none;
		    -moz-user-select: none;
		    -ms-user-select: none;
		    user-select: none;
		}
		option:disabled {
		    color: #d0d0d0 !important;
			text-decoration: line-through;
		}
		.disabled {
		    color:gray !important;
		    cursor: no-drop;
		}

		.text-left{
			text-align: left !important;
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

	        <div class="row myrow">

		        <div class="col-lg-9 mycol" id="main-window">

					{!! Form::open(array('action' => 'SimulationsController@postAdd','role'=>"form", 'id'=>"myform", 'autocomplete'=>"off")) !!}

				        @if(isset($project_id))
					        	<input type="hidden" name="project_id" value="{{$project_id}}">
					    @endif

					    <input type="hidden" name="stopwatch" id="stopwatch" value="0">

							
						<!-- Popoovers are going to be here -->
					    <div style="display: none" id="popoverhtmls"> 

					    </div>

					    <div class="card card-primary card-outline" style="height: 100%;margin-bottom: 0">

				            <div class="card-body" id="smartwizard"	>

					            <ul>
					                <li><a href="#step-1">Step 1<br /><big>Location&nbsp;&nbsp;<i class="fas fa-map-marked-alt"></i></big></a></li>
					                <li><a href="#step-2">Step 2<br /><big>Population Group&nbsp;&nbsp;<i class="fas fa-users"></i></big></a></li>
					                <li><a href="#step-3">Step 3<br /><big>Resources&nbsp;&nbsp;<i class="fas fa-shapes"></i></big></a></li>
					                <li><a href="#step-4">Step 4<br /><big>Living Situations&nbsp;&nbsp;<i class="fas fa-project-diagram"></i></big></a></li>
					                <!-- <li><a href="#step-5">Step 5<br /><big>Transition Probability&nbsp;&nbsp;<i class="fas fa-percent"></i></big></a></li> -->
					                <li><a href="#step-5">Step 5<br /><big>Parameters&nbsp;&nbsp;<i class="fas fa-sliders-h"></i></big></a></li>
					            </ul>

					            <div style="padding-top: 15px">

					                <div id="step-1" class="">

					                	<div class="row">

							                <div class="col-md-12">
							                	<div class="row">
								                	<div class="col-md-6">
														<div class="form-group">
										                	<label for="inputName">Simulation Name&nbsp;

															<a class='show-info pointer'>
															<span msg="Name your simulation. This is for your recollection and does not affect the outcome of your simulation."></span>
															<i class='text-info fas fa-info-circle'></i>
															</a>

										                	&nbsp;</label>
										                	<div id="locationField"></div>
										                	<input name="simulation_name" id="simulation-name" type="text" class="form-control border-primary" placeholder="Simulation 1" value='' onpaste="return false" maxlength="20">
										                	<span class="text-danger" id="simname-error">Simulation name is required. No special characters are permitted.</span>
										              	</div>
									              	</div>
								              	</div>
								            </div>

								            <div class="col-md-12">
							                	<div class="row">
								                	<div class="col-md-6">
														<div class="form-group">
										                	<label for="inputName">Enter a name and select a city from the dropdown list&nbsp;

																<a class='show-info pointer'>
																<span msg="Select the city that your data is representing. This is for your recollection and does not affect the outcome of your simulation."></span>
																<i class='text-info fas fa-info-circle'></i>
																</a>

										                	&nbsp;</label>
										                	<div id="locationField"></div>
										                	<input autocomplete="off" id="autocomplete" placeholder="City name" name="simulation_location" type="text" class="form-control border-primary">
										                	<span class="text-danger" id="cityname-error">City name is required.</span>
											            </div>
									              	</div>
								              	</div>
								            </div>

								            <div class="col-md-6">

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
											          document.getElementById('autocomplete').placeholder = 'City name';
											        }

											        window.loc=1;
											      
											        step1HandleErrors();

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

								                	<label for="inputName">Select population type&nbsp;
													<!-- <a class='show-info pointer'>
													<span msg="The name of population types can be based on your labeling system. For example, you can use Male, Female, and Other. In the later stages, you can use the defined population types to customize your simulation."></span>
													<i class='text-info fas fa-info-circle'></i>
													</a> -->
								                	&nbsp;</label>
								                	<br>
								                	
												  	<div class="form-inline">
													  	<select class="form-control col-md-6" id="populationselect">
													  		<option selected disabled id="title" value="0">Select One</option>
															<option id="u30hl1m" >under 30, homeless less than 1 year, male</option>
															<option id="u30hm1m" >under 30, homeless more than 1 year, male</option>
															<option id="u30hl1f" >under 30, homeless less than 1 year, female</option>
															<option id="u30hm1f" >under 30, homeless more than 1 year, female</option>
															<option id="b30t50hl1m" >30-50 years, homeless less than 1 year, male</option>
															<option id="b30t50hm1m" >30-50 years, homeless more than 1 year, male</option>
															<option id="b30t50hl1f" >30-50 years, homeless less than 1 year, female</option>
															<option id="b30t50hm1f" >30-50 years, homeless more than 1 year, female</option>
															<option id="g50hl1m" >greater than 50 years, homeless less than 1 year, male</option>
															<option id="g50hm1m" >greater than 50 years, homeless more than 1 year, male</option>
															<option id="g50hl1f" >greater than 50 years, homeless less than 1 year, female</option>
															<option id="g50hm1f" >greater than 50 years, homeless more than 1 year, female</option>
										                </select>
												    	<button id="populationbtn" type="button" class="btn btn-primary btn-flat" style="margin-left: 10px">Add</button>
												    </div>

								              	</div>
								            </div>

										</div>

										<div class="row">

											<div class="col-lg-12" style="margin-bottom: 50px;">

												<div id="populationtable">

													<div class="table-responsive row-scroll" style="border: 1px solid gray;">
														<table class="table table-bordered" style="margin-bottom: 0">
															<thead>
																<tr>

																	<th>Name</th>
																	<th>Population count<span id="pop-count-info">&nbsp;
																	<a class='show-info pointer'>
																	<span msg="Enter the total population of each population type."></span>
																	<i class='text-info fas fa-info-circle'></i>
																	</a>
																	&nbsp;</span></th>
																	<th>Action</th>

																</tr>
															</thead>
															<tbody>
																<tr><td></td><td></td><td></td></tr>
															</tbody>
														</table>
													</div>

												</div>

											</div>

										</div>

					                </div>


					<!--                 <div id="step-2" class="">

					                	<div class="row">

							                <div class="col-md-12">
												<div class="form-group">
								                	<label for="inputName">Population group for simulation (comma separated)</label>
								                	<br>
								                	<p>Set your population type/types and click on the <span class="text-primary">Generate table</span> button to create a population table&nbsp;

													<a class='show-info pointer'>
													<span msg="The name of population types can be based on your labeling system. For example, you can use Male, Female, and Other. In the later stages, you can use the defined population types to customize your simulation."></span>
													<i class='text-info fas fa-info-circle'></i>
													</a>

								                	&nbsp;</p>
									                <div class="input-group mb-3">
													  <input placeholder="Male, Female, Other, ..." autocomplete="off" id="populationtext" type="text" class="form-control rounded-0">
													  <span class="input-group-append">
													    <button id="populationbtn" type="button" class="btn btn-primary btn-flat">Generate table</button>
													  </span>
													</div>
													<p class="text-danger" id="pop-spchrter-error" style="display: none">Special characters aren't permitted in population types.</p>
								              	</div>
								            </div>

										</div>

										<div class="row">

											<div class="col-lg-12">

												<div id="_table">

													<div id="populationtable" class="table-responsive">
														<table class="table table-bordered ">
														<thead>
														<tr>
														<th>Population Type</th><th>Population Count<span id="pop-count-info" style="display: none">&nbsp;

														<a class='show-info pointer'>
														<span msg="Enter the total population of each population type"></span>
														<i class='text-info fas fa-info-circle'></i>
														</a>

														&nbsp;</span></th>
														</tr>
														</thead>
														<tbody>
															<tr>
											                    <td></td>
											                    <td></td>
										                	</tr>
														</tbody>
														</table>
													</div>

												</div>

											</div>

										</div>

					                </div> -->

					                <div id="step-3" class="">

					                	<div class="row">

							                <div class="col-md-12">

												<div class="form-group">

								                	<label for="inputName">Select between the provided resources&nbsp;
														<a class='show-info pointer'>
														<span msg="A resource is a place or a type of facility where people experiencing homelessness can spend the night."></span>
														<i class='text-info fas fa-info-circle'></i>
														</a>
													&nbsp;</label>
												  	<div class="form-inline">
													  	<select class="form-control col-md-4" id="resselect">
													  		<option selected disabled id="title">Select</option>
															<option id="Hospital" type="res">Hospital</option>
															<option id="Shelter" type="res">Shelter</option>
															<option id="TransitionalHousing" type="res">Transitional Housing</option>
															<option id="Rehabilitation" type="res">Addiction / Rehabilitation Center</option>	
										                </select>
												    	<button id="resourcebtn" type="button" class="btn btn-primary btn-flat" style="margin-left: 10px">Add</button>
												    </div>

								              	</div>
								            </div>

										</div>

										<div class="row">

											<div class="col-lg-12" style="margin-bottom: 50px;">

												<div id="resource_table">

													<div class="table-responsive row-scroll" style="border: 1px solid gray;">
														<table class="table table-bordered" id="restable" style="margin-bottom: 0">
															<thead>
																<tr>

																	<th>Type</th><th>Name</th><th>Action</th><th>Properties</th><th>Delete</th>

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

					                	<div class="row">

							                <div class="col-md-12">

												<div class="form-group">

								                	<label for="inputName">Select between the provided living situations&nbsp;
														<a class='show-info pointer'>
														<span msg="A particular living condition such as hidden homelessness"></span>
														<i class='text-info fas fa-info-circle'></i>
														</a>
								                	&nbsp;</label>
								                	<br>
								                	
												  	<div class="form-inline">
													  	<select class="form-control col-md-4" id="stateselect">
													  		<option selected disabled id="title">Select</option>
															<option id="HiddenHomeless" type="state">Hidden Homeless</option>
															<option id="NotHomeless" type="state">Not Homeless</option>
															<option id="Street" type="state">Street</option>
										                </select>
												    	<button id="statebtn" type="button" class="btn btn-primary btn-flat" style="margin-left: 10px">Add</button>
												    </div>

								              	</div>
								            </div>

										</div>

										<div class="row">

											<div class="col-lg-12" style="margin-bottom: 50px;">

												<div id="state_table">

													<div class="table-responsive row-scroll" style="border: 1px solid gray;">
														<table class="table table-bordered" id="statetable" style="margin-bottom: 0">
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

							                <div class="col-md-4">

												<div class="form-group">
								                	<label for="inputName">Created by&nbsp;
							                			<a class='show-info pointer'>
														<span msg="This is for your recollection and does not affect the outcome of your simulation."></span>
														<i class='text-info fas fa-info-circle'></i>
														</a>
								                	&nbsp;</label>
								                	<input placeholder="Creator's first name" type="text" autocomplete="off" name="creatorname"  id="cname" class="form-control" maxlength="20">
								                	<span class="text-danger" id="personname-error">This input is required. No special characters are permitted.</span>
								              	</div>

												<div class="form-group">
								                	<label for="inputName">Number of weeks&nbsp;
							                			<a class='show-info pointer'>
														<span msg="The total number of weeks to run the simulation."></span>
														<i class='text-info fas fa-info-circle'></i>
														</a>
								                	&nbsp;</label>
								                	<input type="number" min="1" max="520" step="1" autocomplete="off" name="numberofweeks" id="simweeks" class="form-control">
								                	<span class="text-danger" id="weeks-error">This input is required. The value must be a numeric value between 1 to 520.</span>
								              	</div>

												<div class="form-group">
								                	<label for="inputName">Number of simulations&nbsp;
							                			<a class='show-info pointer'>
														<span msg="The total number of separate simulation runs. In the end, the results of the simulations will be averaged."></span>
														<i class='text-info fas fa-info-circle'></i>
														</a>
								                	&nbsp;</label>
								                	<input type="number" min="1" max="10" step="1" autocomplete="off" name="numberofsims" type="text" id="simnum" class="form-control">
								                	<span class="text-danger" id="simnum-error">This input is required. The value must be a numeric value between 1 to 10.</span>
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

					    </div><!-- /.card -->

					{!! Form::close() !!}

				</div>

				<div class="col-lg-3 mycol" id="side-window">
					
					<div class="card card-primary card-outline" style="height: 100%">

						<div class="card-header" style="height: 73px;background:#f5f5f5;border: 1px solid #ddd;">
							<h3 class="card-title" style="line-height: 48px;">
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
								
								<div class="table-responsive table-bordered row-scroll" id="population-info-table" style="max-height: 162px;overflow: auto;display: none;margin-top: 10px">
									<table class="table" style="margin-bottom: 0">
										<thead>
											<tr>

												<th>Population</th><th>Count</th>

											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>

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
								<p><strong>Step 5:</strong> <span id="parameters-overview" class="text-danger">Incomplete</span></p>
							</div>


					    </div>

					</div><!-- /.card -->

				</div>

	        </div>
	        <!-- /.row -->

	    </div><!-- /.container-fluid -->

	</div>

@stop



