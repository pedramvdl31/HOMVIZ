@extends($layout)
@section('stylesheets')

	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard.css">
	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard_theme_circles.css">
	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard_theme_arrows.css">
	<link rel="stylesheet" href="/SmartWizard-master/src/css/smart_wizard_theme_dots.css">

@stop
@section('scripts')

	<script src="/SmartWizard-master/src/js/jquery.smartWizard.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
	<script src="/assets/js/simulations/edit.js?7"></script>

@stop

@section('content')

	<script>    
	    window._table = "{!! $tablestring !!}";
	</script>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper" style="margin-left: 0">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
			  <div class="col-sm-6">
			    <h1 class="m-0 text-dark">Simulations</h1>
			  </div><!-- /.col -->
			  <div class="col-sm-6">
			    <ol class="breadcrumb float-sm-right">
			      <li class="breadcrumb-item"><a href="#">Home</a></li>
			      <li class="breadcrumb-item active">Starter Page</li>
			    </ol>
			  </div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<div class="content">

	    <div class="container-fluid">

	        <div class="row">

	          <div class="col-lg-12">

	          	{!! Form::open(array('action' => 'SimulationsController@postEdit','role'=>"form")) !!}

	          		

      		        @if(isset($project_id))
      		        	<input type="hidden" name="project_id" value="{{$project_id}}">
                    @endif
      		        @if(isset($sim_id))
      		        	<input type="hidden" name="sim_id" value="{{$sim_id}}">
                    @endif

		            <div class="card card-primary card-outline">

		                <div class="card card-solid" style="margin-bottom: 0;padding-bottom: 25px">
		                    <div class="card-body pb-0">


						        <!-- SmartWizard html -->
						        <div id="smartwizard">
						            <ul>
						                <li><a href="#step-1">Step 1<br /><big>Resources</big></a></li>
						                <li><a href="#step-2">Step 2<br /><big>States</big></a></li>
						                <li><a href="#step-4">Step 4<br /><big>Parameters</big></a></li>
						            </ul>

						            <div style="padding-top: 15px">

						                <div id="step-1" class="">


						                	<div class="row" style="margin-left: 0;margin-right: 0;">

								                <div class="col-md-4">
													<div class="form-group">
									                	<label for="inputName">Location (Address or latitute, longitude):</label>
									                	<input name="location" type="text" id="inputName" class="form-control" value="{{$location}}">
									              	</div>
									            </div>

								        	</div>


								            <div class="row" style="margin-left: 0;margin-right: 0;">


								            	<?php 

								            		$poskey= 0;
								            		$poskey2= 1;
								            		$key2=0;

								            	?>

								            	@foreach ($resources as $k => $res)



						                            <div count="{{$poskey}}" class="resources col-12 col-sm-6 col-md-4 d-flex align-items-stretch">

														<div class="card bg-light" style="width: 100%">

															<div class="card-header text-muted border-bottom-0">

															  	Resource {{$poskey2}} &nbsp;&nbsp;&nbsp;<i class="fas fa-trash table-danger deleteresource" style="cursor: pointer;"></i>

															</div>

															<div class="card-body pt-0">

															  <div class="row">

															    <div class="col-12">

																	<div class="form-group">
																		<label for="inputName">Name</label>
																		<input name="resource[{{$poskey}}][name]" type="text" id="inputName" class="form-control" value="{{$res->name}}">
																	</div>
																	<div class="form-group">
																		<label for="inputName">Capacity</label>
																		<input name="resource[{{$poskey}}][capacity]" type="text" id="inputName" class="form-control" value="{{$res->capacity}}">
																	</div>
																	<div class="form-group">
																		<label for="inputName">Max Length (days) <small>optional</small></label>
																		<input name="resource[{{$poskey}}][maxlength]" type="text" id="inputName" class="form-control" value="{{$res->maxlength}}">
																	</div>

																	<div class="row subresroucewrapper">

																		@if(isset($subresources))

																			@foreach ($subresources as $j => $subresinner)

																				@if($j==$k)

																					@foreach ($subresinner as $i => $subres)

																						<div class="col-6 col-sm-6 col-md-6 d-flex subresource">
																							<div class="card bg-light">
																								<div class="card-header text-muted border-bottom-0">Sub-Resource  &nbsp;&nbsp;&nbsp;<i class="fas fa-trash table-danger deletesubresource" style="cursor: pointer;"></i>
																								</div>
																								<div class="card-body pt-0"> 
																									<div class="row"> 
																										<div class="col-12">
																											<div class="form-group">
																												<label for="inputName">Name</label>
																												<input name="subresource[{{$poskey}}][{{$key2}}][name]" type="text" id="inputName" class="form-control" value="{{$subres->name}}">
																											</div>
																											<div class="form-group">
																												<label for="inputName">Capacity</label>
																												<input name="subresource[{{$poskey}}][{{$key2}}][capacity]" type="text" id="inputName" class="form-control" value="{{$subres->capacity}}">
																											</div>

																										</div>
																									</div>
																								</div>
																							</div>
																						</div>

																						<?php

																							$key2++;

																						?>

																					@endforeach

																				@endif

																			@endforeach
																			
																		@endif

																	</div>

															    </div>

															  </div>

															</div>

															<div class="card-footer">
											                  <div class="text-right">
											                    <a id="addsubresource" class="btn btn-sm btn-primary" style="color: white;cursor: pointer;">
											                      <i class="fas fa-plus"></i> Add Sub-resource
											                    </a>
											                  </div>
											                </div>

														</div>

						                            </div>


						                            <?php
								            		
								            			$key2 = 0;
								            			$poskey++;
								            			$poskey2++;

								            		?>

					                            @endforeach


					                            <a id="addresourcewrapper" class="col-12 col-sm-6 col-md-4">
					                                <div class="info-box" id="addresource"  style="cursor: pointer;">
					                                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-plus"></i></span>

					                                  <div class="info-box-content">
					                                    <span class="info-box-text">Add Resource</span>
					                                    <span class="info-box-number">
					                                  </div>
					                                  <!-- /.info-box-content -->
					                                </div>
					                                <!-- /.info-box -->
					                            </a>

				                        	</div>

						                </div>

						                <div id="step-2" class="">

						                	<style type="text/css">
						                		div {
												  position: relative;
												  overflow: hidden;
												}
												.inputx {
												  position: absolute;
												  font-size: 50px;
												  opacity: 0;
												  right: 0;
												  top: 0;
												}
												.hide{
													display: none;
												}
												.show{
													display: block;
												}
						                	</style>

						                	<div class="row" style="margin-left: 0;margin-right: 0;">

								                <div class="col-md-4">
													<div class="form-group">
									                	<label for="inputName">States:</label>
										                <div class="input-group mb-3">
														  <input name="states" id="statetext" type="text" class="form-control rounded-0" value="{{$states}}">
														  <span class="input-group-append">
														    <button id="statebtn" type="button" class="btn btn-info btn-flat">Generate table</button>
														  </span>
														</div>

														
									              	</div>
									            </div>

											</div>

											<div class="row">

												<div class="col-lg-12">

													<div id="_table">
														<small>This table represents the probability of moving from one state to another. Absorbing states where the movement to other states is not allowed will have a probability of 0.</small>



													</div>

												</div>

												<div class="col-lg-12">

													<a class="hide" style="cursor: pointer;" id="adddataanchor">Add data manually <i class="fas fa-plus"></i></a>

													<p>&nbsp;&nbsp;</p>

													<div id="uploadwrapper" class="hide">

														<div id="dvExcel"></div>
														
														<div class="row" style="margin-left: 0;margin-right: 0;">

											                <div class="col-md-4">
																<div class="form-group">
												                	<label for="inputName">Export excel sheeet:&nbsp;&nbsp;&nbsp;&nbsp;</label>
												                	<button id="toexcel" type="button" class="btn bg-gradient-primary">Download</button>
												              	</div>
												            </div>

											        	</div>
											        	<div class="row" style="margin-left: 0;margin-right: 0;">

											                <div class="col-md-4">
																<div class="form-group">
												                	<label for="inputName">Import excel sheeet:&nbsp;&nbsp;&nbsp;&nbsp;</label>
																    <div class="file btn bg-gradient-primary">
																    	<span class="txt">Upload</span>
																		<input class="inputx" id="fileinput" type="file" name="file"/>
																	</div>
												              	</div>
												            </div>

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
									                	<input name="simulation_name" type="text" id="inputName" class="form-control" value="{{$simname}}">
									              	</div>
													<div class="form-group">
									                	<label for="inputName">Number of weeks:</label>
									                	<input name="numberofweeks" type="text" id="inputName" class="form-control" value="{{$simweeks}}">
									              	</div>
													<div class="form-group">
									                	<label for="inputName">Number of simulations:</label>
									                	<input name="numberofsims" type="text" id="inputName" class="form-control" value="{{$simnum}}">
									              	</div>

									            	<button type="submit" class="btn bg-gradient-primary">Edit</button>

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



